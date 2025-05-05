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


<?php
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["make_order"])){

    $fio = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $delivery_type = (int)$_POST["delivery"];
    $comment = trim($_POST["comment"]);
    $status = 'created';
    $price = trim($_POST["total_price"]);


    global $pdo;
    $insert_order = "INSERT INTO `orders`(fio, phone, email, delivery_type, comment, status, price) VALUES (?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($insert_order);
    $stmt->execute([$fio, $phone, $email, $delivery_type, $comment, $status, $price]);

    $order_id = $pdo->lastInsertId();
    // 2. Добавляем товары из корзины
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $item) {
            $insert_product = "INSERT INTO `order_products`
                                 (order_id, product_id, count, price)
                                 VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($insert_product);
            $stmt->execute([
                $order_id,
                $item['id'],
                $item['count'],
                $item['price']
            ]);

            // 3. Добавляем options в бд
            foreach($item['options'] as $key => $option_item) {
                tt($key);
                tt($option_item);
                $option_id = explode("__", $option_item);
                tt($option_id);
                $insert_product = "INSERT INTO `order_product_options`
                                 (order_id, product_id, option_id)
                                 VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($insert_product);
                $stmt->execute([
                    $order_id,
                    $item['id'],
                    $option_id[0]
                ]);
            }

            // 4. Добавляем accessories в бд
            foreach($item['accessories'] as $key => $access_item) {
                $insert_product = "INSERT INTO `order_product_accessories`
                                 (order_id, product_id, accessory_id)
                                 VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($insert_product);
                $stmt->execute([
                    $order_id,
                    $item['id'],
                    $access_item
                ]);
            }
        }
    }

    unset($_SESSION['cart']);
    header("Location: thanks.php?order_id={$order_id}");
}
?>

<?php
// Обработка изменения количества товаров
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"])){
    $product_id = $_POST["product_id"];

    if(isset($_POST["action"])) {
        if($_POST["action"] == "plus" && isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['count'] += 1;
        }
        elseif ($_POST["action"] == "minus" && isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id]['count'] > 1) {
            $_SESSION['cart'][$product_id]['count'] -= 1;
        }

        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}
?>

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
                <span class="breadcrumbs__el">Оформление заказа</span>
            </li>
        </ul>
    </div>
</div>

<!--Вывод ошибок-->

<!--<div class="container">-->
<!--    <h1 class="page-title">Оформление заказа</h1>-->
<!---->
<!--    @foreach($errors->all() as $message)-->
<!--    <div class="error">{{ $message }}</div>-->
<!--    @endforeach-->
<!--</div>-->




<div class="page-cart">

    <form action="" method="post" class="form-order">
        <div class="container">
            <div class="page-cart-main">
                <div class="page-cart-product-list">

                    <?php $total_order_price = 0; ?>

                    <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $sess_name => $product): ?>
                    <form method="post" action="">
                        <div class="page-cart-product-list-item">
                            <div class="page-cart-product-list-item__info_wrap">
                                <div class="page-cart-product-list-item__img">
                                    <img src="<?=$product['image_path']?>" alt="">
                                </div>
                                <div class="page-cart-product-list-item__info">
                                    <a href="product.php?product_id=<?=$product['id']?>" class="mini-product__title"><?=$product['title']?></a>

                                    <?php if(!empty($product['options'])):?>
                                        <?php foreach ($product['options'] as $key => $value): ?>
                                            <?php if($value):?>
                                                <?php $pieces = explode("__", $value);?>
                                                <div class="page-cart-product-list-item_options"><?=$pieces[1]?></div>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    <?php endif;?>



                                    <?php $total_accessories_price =  0;?>

                                    <?php if(!empty($product['accessories'])):?>
                                        <?php foreach ($product['accessories'] as $key => $value): ?>
                                            <?php
                                            global $pdo;
                                            $id = (int)$value;
                                            $sql = "SELECT * FROM `accessories` WHERE `id` = ?";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute([$id]);
                                            $accessory = $stmt->fetch();
                                            ?>
                                            <div class="page-cart-product-list-item_accessories cart-accessories">
                                                <div class="cart-accessories__item">
                                                    <div class="cart-accessories__img">
                                                        <img src="<?=$accessory['image']?>" alt="">
                                                    </div>
                                                    <div class="cart-accessories__info">
                                                        <div class="cart-accessories__title"><?=$accessory['name']?></div>
                                                        <div class="cart-accessories__price"><?=$accessory['price']?> byn</div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php $total_accessories_price += $accessory['price'];?>
                                        <?php endforeach;?>
                                    <?php endif;?>

                                </div>
                                <div class="page-cart-product-list-item__count">
                                    <form method="post" action="">
                                        <input type="hidden" name="product_id" value="<?=$sess_name?>">
                                        <button type="submit" name="action" value="minus" class="page-cart-product-list-item__count_minus">-</button>
                                        <input type="text" name="count" value="<?=$product['count']?>" readonly>
                                        <button type="submit" name="action" value="plus" class="page-cart-product-list-item__count_plus">+</button>
                                    </form>
                                </div>
                                <div class="page-cart-product-list-item__price">

                                    <?php if($product['sale']): ?>
                                    <div class="page-cart-product__price_main">
                                        <span class="page-cart-product__price_old"><?=$product['price']?> BYN</span>
                                        <div class="page-cart-product__price_sale-count">-<?=$product['sale']?>%</div>
                                    </div>
                                    <span class="page-cart-product__price_current"><span class="price"><?= $total_accessories_price + ceil($product['price'] - ($product['price'] * $product['sale'] / 100)) ?></span> BYN</span>
                                    <?php $total_order_price += $product['count'] * ($total_accessories_price + ceil($product['price'] - ($product['price'] * $product['sale'] / 100)))?>
                                    <?php else: ?>
                                    <div class="page-cart-product__price_main">
                                        <span class="page-cart-product__price_current"><span class="price"><?=$total_accessories_price + $product['price']?></span> BYN</span>
                                        <?php $total_order_price += ($product['count'] * $total_accessories_price + $product['price'])?>
                                    </div>
                                    <?php endif; ?>

                                </div>
                                <div class="page-cart-product-list-item__remove">
                                    <a href="<?= BASE_URL ?>delete.php?session_del_id=<?=$sess_name?>">
                                    <i class="fa-solid fa-xmark"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    <?php else:?>
                    <p>Корзина пуста</p>
                    <?php endif;?>

                </div>
                <div class="pcart-main-contact">
                    <span class="pcart-main-contact__title">1.Контактная информация</span>
                    <div class="pcart-main-contact__input-wrap">
                        <input type="text" name="name" placeholder="ФИО" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
                        <input type="text" name="email" placeholder="E-mail" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                    </div>
                    <div class="pcart-main-contact__input-wrap">
                        <input type="text" name="phone" placeholder="Телефон" value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>">
                    </div>
                </div>
                <div class="pcart-main-delivery">
                    <div class="pcart-main-delivery__title">2.Способ получения заказа</div>
                    <div class="pcart-main-delivery__items">

                        <?php
                        global $pdo;
                        $sql = "SELECT * FROM `delivery`";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $deliveries = $stmt->fetchAll();
                        ?>
                        <?php foreach ($deliveries as $delivery): ?>
                            <label class="pcart-main-delivery__item">
                                <input
                                        type="radio"
                                        name="delivery"
                                        value="<?= $delivery['id'] ?>"
                                    <?= (isset($_POST['delivery']) && $_POST['delivery'] == $delivery['id']) ? 'checked' : '' ?>
                                >
                                <div class="pcart-main-delivery__item_box"></div>
                                <div class="pcart-main-delivery__item_info">
                                    <span class="pcart-main-delivery__item_title"><?= $delivery['title'] ?></span>
                                    <span class="pcart-main-delivery__item_desc"><?= $delivery['description'] ?></span>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="pcart-main-comment">
                    <span class="pcart-main-comment__title">3.Комментарий</span>
                    <textarea name="comment" id="" cols="30" rows="10" placeholder="Комментарий к заказу"
                              class="pcart-main-comment__textarea"><?= isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : '' ?></textarea>
                </div>
            </div>
            <?php
            $total_count = 0;

            foreach ($_SESSION['cart'] as $key => $product):
                $total_count += $product['count'];
            endforeach;

            ?>



            <?php
            $promo = '';
            $promo_discount = 0;
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['promo'])){
                $promo = trim($_POST['code']);
                if(!empty($promo)) {
                    global $pdo;
                    $sql = "SELECT * FROM `promo_codes` WHERE code = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$promo]);
                    $result = $stmt->fetch();

                    if($result) {
                        $promo_discount = $result['discount'];
                    }
                }
            }
            ?>

            <div class="pcart-main-order">
                <div  class="pcart-main-order-promo">
                    <input type="text" name="code" class="pcart-main-order-promo__input" value="<?php echo $_POST['code'] ?? '' ?>"
                           placeholder="Промокод">
                    <button type="submit" name="promo" class="pcart-main-order-promo__btn">Применить</button>
                </div>
                <span class="pcart-main-order-promo__text"></span>
                <span class="pcart-main-order__title">Ваш заказ</span>

                <div class="pcart-main-order__info">
                    <div class="pcart-main-order__info-item result-product-count">
                        <div class="pcart-main-order__info-item_title">Всего товаров:</div>
                        <div class="pcart-main-order__info-item_val"><span class="num"><?=$total_count?></span> шт</div>
                    </div>
                    <div class="pcart-main-order__info-item result-product-sum">
                        <div class="pcart-main-order__info-item_title">Сумма заказа:</div>
                        <div class="pcart-main-order__info-item_val"><span class="num"><?=$total_order_price?></span> byn</div>
                    </div>
                    <div class="pcart-main-order__info-item result-product-itog">
                        <div class="pcart-main-order__info-item_title">К оплате:</div>
                        <?php if(isset($result['discount'])):?>
                            <div class="pcart-main-order__info-item_val result"><span class="num"><?=$total_order_price = ceil($total_order_price - ($total_order_price / 100 * $result['discount']))?></span> byn</div>
                        <?php else: ?>
                            <div class="pcart-main-order__info-item_val result"><span class="num"><?=$total_order_price?></span> byn</div>
                        <?php endif;?>
                        <input type="hidden" name="total_price" value="<?=$total_order_price?>">
                    </div>
                    <div class="pcart-main-order__buy-wrap">
                        <button type="submit" name="make_order" class="pcart-main-order__buy">Оформить заказ</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>


<?php include 'layouts/footer.php'; ?>

</body>
</html>
