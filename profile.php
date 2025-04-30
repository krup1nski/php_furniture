<?php include "db/db.php"; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Home</title>

    <meta name="description" content="">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-ui-slider@1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/main.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

</head>
<body>

<?php
global $pdo;
$sql = "SELECT * FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$profile = $stmt->fetch();
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    global $pdo;

    if (isset($_POST['delete'])) {
        $sql = "UPDATE users SET image = NULL WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $_SESSION['user_id']);
        $stmt->execute();

        // удалить файл с сервера
        if (!empty($profile['image'])) {
            $filePath = "images/avatar/".$_SESSION['user_id']."/".$profile['image'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

    if (isset($_POST['load']) && isset($_FILES['avatar'])) {
        $imagename = time()."_".$_FILES['avatar']['name'];
        $filetmoname = $_FILES['avatar']['tmp_name'];
        $filetype = $_FILES['avatar']['type'];

        // Создаем путь
        $userDir = "images/avatar".DIRECTORY_SEPARATOR.$_SESSION['user_id'];
        $destination = $userDir.DIRECTORY_SEPARATOR.$imagename;

        if(strpos($filetype, "image") === false) {
            die('Только изображения доступны для загрузки');
        }

        // Создаем директорию если ее нет
        if (!file_exists($userDir)) {
            if (!mkdir($userDir, 0777, true)) {
                die('Не удалось создать директорию для загрузки');
            }
        }

        // Пытаемся загрузить файл
        if(move_uploaded_file($filetmoname, $destination)) {
            $_POST['avatar'] = $imagename;
        } else {
            $errorMessage = "Ошибка загрузки изображения. Проверьте права доступа к папке.";
            // Для отладки
            error_log("Upload error: ".print_r(error_get_last(), true));
        }

        $sql = "UPDATE users SET image = :avatar WHERE id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':avatar', $imagename);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->execute();

    } else {
        $errorMessage = "Файл не был отправлен через форму";
    }
    header("Location: profile.php");
}
?>


<?php include 'layouts/header.php'; ?>

<div class="container">
    <div class="profile">
        <form action="" method="post" class="profile_avatar" enctype="multipart/form-data">
            <h2>Изображение профиля</h2>
            <div class="profile_image">
                <?php if(!$profile['image']):?>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg" alt="Аватар профиля">
                <?php else:?>
                    <img src="<?=BASE_URL?>images/avatar/<?=$_SESSION['user_id']?>/<?=$profile['image']?>" alt="Аватар профиля">
                <?php endif;?>
                <label for="file-path"><i class="fa-solid fa-camera"></i></label>
                <input type="file" accept="image/jpeg, image/jpg, image/png" id="file-path" name="avatar">
            </div>
            <div class="profile_avatar_btns">

                <?php if(!$profile['image']):?>
                    <button type="submit" class="profile_avatar_submit" name="load">Загрузить фото</button>
                <?php else:?>
                    <button type="submit" class="profile_avatar_submit" name="load">Загрузить фото</button>
                    <button type="submit" class="profile_avatar_delete" name="delete">Удалить фото</button>
                <?php endif;?>
            </div>
        </form>

        <div class="profile_info">
            данные + поля для заполнения адресса
            заказы по телефону
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>

<!--Просмотри загруженного изображения профиля-->
<script>
    document.getElementById('file-path').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.querySelector('.profile_image img').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

</body>
</html>

