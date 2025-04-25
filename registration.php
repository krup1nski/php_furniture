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
    <title>Регистрация</title>

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

<?php include 'layouts/header.php'; ?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }

    //register
    if(isset($_POST['registration'])){
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $phone = $_POST['phone'];
        $phone = filter_var($phone, FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        $cpass = $_POST['cpass'];
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

        global $pdo;
        $select_user = $pdo->prepare("SELECT * FROM `users` WHERE `phone` = ?");
        $select_user->execute([$phone]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if($select_user->rowCount() > 0){
            $message[] = 'Пользователь с таким номером телефона уже зарегистрирован';
        }else{
            if($pass != $cpass){
                $message[] = 'Пароли не совпадают';
            }else{
                $insert_user = $pdo->prepare("INSERT INTO `users`(`fio`, `phone`, `password`) VALUES (?,?,?)");
                $insert_user->execute([$name, $phone, $pass]);

                $select_user = $pdo->prepare("SELECT * FROM `users` WHERE `phone` = ? AND `password` = ?");
                $select_user->execute([$phone, $cpass]);
                $row = $select_user->fetch(PDO::FETCH_ASSOC);
                if($select_user->rowCount() > 0){
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['name'] = $row['fio'];
                    $_SESSION['phone'] = $row['phone'];
                }
                heade r( "location: home.php");
            }
        }
    }
}
?>

<div class="container">
    <div class="log-form">
        <div class="log-form__title">Регистрация</div>
        <form action="" method="post" class="log-form__inputs">
            <input type="text" name="name" placeholder="Ваше имя" maxlength="50" required >
            <input type="text" name="phone" placeholder="+375 (__) ___-__-__" maxlength="50" required>
            <input type="text" name="pass" placeholder="Пароль" maxlength="50" required>
            <input type="text" name="cpass" placeholder="Подтвердить пароль" maxlength="50" required>

            <button type="submit" name="registration" class="pcart-main-order__buy">Принять</button>
        </form>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>

</body>
</html>

