<?php include "db/db.php"; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Home</title>

    <meta name="description" content="">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-ui-slider@1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="<?=BASE_URL?>css/main.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

</head>
<body>

<?php include 'layouts/header.php'; ?>


<div class="breadcrumbs">
    <div class="container">
        <ul class="breadcrumbs__list">
            <li class="breadcrumbs__item">
                <a href="<?=BASE_URL?>home.php" class="breadcrumbs__el">
                    <i class="fa-solid fa-house"></i>
                    Главная</a>
            </li>
            <li class="breadcrumbs__item">
                <span class="breadcrumbs__el">Аксессуары</span>
            </li>
        </ul>
    </div>
</div>



<div class="page-accessories">
    <div class="container">
        <h1 class="page-title">Аксессуары</h1>
        <span class="page-desc">Доступные аксессуары</span>
        <div class="page-accessories__items">
            <?php
            global $pdo;
            $sql = "SELECT * FROM `accessories`";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $accessories = $stmt->fetchAll();
            ?>

            <?php foreach ($accessories as $accessory): ?>
            <div class="page-accessories__item">
                <div class="page-accessories__item_img">
                    <img src="<?=$accessory['image']?>" alt="">
                </div>
                <div class="page-accessories__item_info">
                    <div class="page-accessories__item_title"><?=$accessory['name']?></div>
                    <div class="page-accessories__item_price"><?=$accessory['price']?> BYN</div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>


</body>
</html>


