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
tt($_POST);
tt($_SESSION);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_article'])) {

    // Создаем уникальный ключ для корзины с учетом артикула, цвета и размера
    $color = isset($_POST['color']) ? trim($_POST['color']) : '';
    $size = isset($_POST['size']) ? trim($_POST['size']) : '';
    $productKey = 'product_' . $_POST['product_article'] .
        (!empty($color) ? '_' . $color : '') .
        (!empty($size) ? '_' . $size : '');

// Проверяем наличие товара в корзине
    if (isset($_SESSION['cart'][$productKey])) {
        echo "<script>alert('Товар уже в корзине!');</script>";
    } else {
        // Добавляем товар в корзину
        $_SESSION['cart'][$productKey] = [
            'id' => htmlspecialchars($_POST['product_id']),
            'title' => htmlspecialchars($_POST['product_title']),
            'sale' => isset($_POST['product_sale']) ? floatval($_POST['product_sale']) : 0,
            'price' => floatval($_POST['product_price']),
            'count' => $_POST['count'],
            'image_path' => htmlspecialchars($_POST['image_path']),
            'options' => [
                'color' => $color,
                'size' => $size
            ],
            'accessories' => isset($_POST['accessories']) ? $_POST['accessories'] : '',
        ];

        echo "<script>alert('Товар успешно добавлен в корзину!');</script>";
    }

}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['feedback_send'])) {
    $user_id = filter_var($_POST['user_id'], FILTER_VALIDATE_INT);
    $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
    $rate = filter_var($_POST['rate'], FILTER_VALIDATE_INT, [
        'options' => [
            'min_range' => 1,
            'max_range' => 5,
        ],
    ]);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    global $pdo;
    $sql = "INSERT INTO `feedback`(user_id, product_id, rate, message) VALUES(?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $product_id, $rate, $message]);
}
?>

<?php include 'layouts/header.php'; ?>

<?php $product = select_one('products', $_GET['product_id']) ?>

<?php
global $pdo;
$sql = "SELECT * FROM feedback WHERE product_id = :product_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':product_id', $product['id']);
$stmt->execute();
$feedbacks = $stmt->fetchAll();
?>


<!--Модальное окно для отправки отзыва-->
<div class="modal-container" id="modal_container_feedback">
    <div class="modal">
        <h1>Оставить отзыв на <?= $product['title'] ?></h1>
        <?php if(isset($_SESSION['user_id'])): ?>
        <form action="" method="post" class="modal-inputs">
            <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <fieldset class="feedback_rates">
                <div class="feedback_rate">
                    <input type="radio" id="1" name="rate" value="1" />
                    <label for="louie">1</label>
                </div>

                <div class="feedback_rate">
                    <input type="radio" id="2" name="rate" value="2" />
                    <label for="2">2</label>
                </div>

                <div class="feedback_rate">
                    <input type="radio" id="3" name="rate" value="3" />
                    <label for="3">3</label>
                </div>

                <div class="feedback_rate">
                    <input type="radio" id="4" name="rate" value="4" />
                    <label for="4">4</label>
                </div>

                <div class="feedback_rate">
                    <input type="radio" id="5" name="rate" value="5" />
                    <label for="5">5</label>
                </div>

            </fieldset>
            <textarea id="story" name="message" rows="5" cols="33" placeholder="Ваш отзыв"></textarea>

            <button type="submit" name="feedback_send" class="pcart-main-order__buy">Отправить</button>
        </form>
        <?php else:?>
        <p>Для того, чтобы оставить отзыв, вы должны войти в аккаунт:</p>
            <a href="<?= BASE_URL ?>login.php">Войти</a>
        <?php endif;?>

        <button id="close_modal_feedback" class="close_model">x</button>
    </div>
</div>

<div class="breadcrumbs">
    <div class="container">
        <ul class="breadcrumbs__list">
            <li class="breadcrumbs__item">
                <a href="<?= BASE_URL ?>home.php" class="breadcrumbs__el">
                    <i class="fa-solid fa-house"></i>
                    Главная</a>
            </li>
            <li class="breadcrumbs__item">
                <span class="breadcrumbs__el"><?= $product['title'] ?></span>
            </li>
        </ul>
    </div>
</div>


<div class="container">
    <h1 class="page-title"><?= $product['title'] ?></h1>
</div>


<div class="page-product">
    <div class="page-product-wrap">
        <div class="container">
            <div class="page-product-gallery">
                <?php if ($product['image_path']): ?>
                    <div class="page-product-gallery__thumbs">
                        <div class="page-product-gallery__thumbs__item active">
                            <img src="<?= $product['image_path'] ?>" alt="">
                        </div>
                        <?php $images = select_all('product_image', ['product_id' => $product['id']]); ?>
                        <?php if (!empty($images)): ?>
                            <?php foreach ($images as $img): ?>
                                <div class="page-product-gallery__thumbs__item">
                                    <img src="<?= $img['path'] ?>" alt="">
                                </div>
                            <?php endforeach ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="page-product-gallery__main">
                    <img src="<?= $product['image_path'] ?>" alt="">
                </div>
            </div>
            <form action="" method="post" class="page-product-main">


                <div class="page-product-main-top">
                    <div class="page-product-main-top__reviews">
                        <div class="page-product-main-top__rating">
                            <div class="page-product-main-top__rating_icon">
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <?php
                            $sql = "SELECT AVG(rate) AS average_rate FROM feedback WHERE product_id = :product_id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':product_id', $product['id']);
                            $stmt->execute();
                            $rate = $stmt->fetch();
                            ?>
                            <span class="mini-product__rating_text">
                                <?php echo isset($rate['average_rate']) ? round($rate['average_rate'], 1) : 0; ?>
                            </span>
                            </span>
                        </div>
                        <div class="page-product-main-top__link"><?=count($feedbacks)?> отзывов</div>
                    </div>
                    <div class="page-product-main-top__actions">
                        <div class=page-product-main-top__actions_compare">
                            <i class="fa-solid fa-equals"></i>
                        </div>
                        <div class="page-product-main-top__actions_like">
                            <i class="fa-solid fa-heart"></i>
                        </div>
                    </div>
                </div>
                <?php
                global $pdo;

                $sql = 'SELECT * FROM `option_groups`';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $option_groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <?php foreach ($option_groups as $group): ?>
                    <div class="page-product-main-options">
                        <div class="page-product-main-options-item">
                            <span class="page-product-main-options__title"><?= $group['title'] ?></span>
                            <div class="page-product-main-options__items">
                                <?php
                                global $pdo;

                                $sql = 'SELECT * FROM `options` WHERE group_id = :group_id';
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindParam(':group_id', $group['id'], PDO::PARAM_INT);
                                $stmt->execute();
                                $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                ?>

                                <?php foreach ($options as $option): ?>
                                    <label class="page-product-main-options__item <?php if (!empty($option['image_path'])) echo 'with_img'; ?>"
                                           data-option-group-id="123" data-option-id="<?=$option['id']?>"
                                           data-option-title="<?=$option['title']?>">
                                        <input type="radio" name="<?= $group['title'] ?>" value="<?=$option['id']?>__<?=$option['title']?>" style="display: none;">
                                        <?php if (!empty($option['image_path'])): ?>
                                            <img src="<?=$option['image_path'] ?>" alt="<?=$option['title']?>">
                                        <?php else: ?>
                                            <span class="without_img"><?=$option['title']?></span>
                                        <?php endif; ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


                <div class="page-product-main-dop">
                    <span class="page-product-main-dop__title">Аксессуары</span>
                    <div class="swiper page-product-main-dop__items">
                        <div class="swiper-wrapper">
                            <?php
                            global $pdo;

                            // Получаем все аксессуары для текущего продукта
                            $sql = 'SELECT a.* FROM `accessory_product` ap 
                                        JOIN `accessories` a ON ap.accessory_id = a.id 
                                        WHERE ap.product_id = :product_id';
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':product_id', $product['id'], PDO::PARAM_INT);
                            $stmt->execute();
                            $accessories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            ?>

                            <?php foreach ($accessories as $accessory): ?>
                                <div class="swiper-slide page-product-main-dop__item"
                                     data-accessory-id="<?= $accessory['id'] ?>">
                                    <div class="page-product-main-dop__img">
                                        <img src="<?= $accessory['image'] ?>"
                                             alt="<?= htmlspecialchars($accessory['name']) ?>">
                                    </div>
                                    <div class="page-product-main-dop__info">
                                        <span class="page-product-main-dop_item_title"><?= htmlspecialchars($accessory['name']) ?></span>
                                        <div class="page-product-main-dop__action">
                                            <span class="page-product-main-dop__price">
                                                <span><?= number_format($accessory['price'], 2) ?></span> byn
                                            </span>
                                            <label class="page-product-main-dop__add">
                                                <input type="checkbox"
                                                       name="accessories[]"
                                                       value="<?= $accessory['id'] ?>"
                                                       style="display: none;">
                                                <span>+</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="page-product-main-action">

                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="product_title" value="<?= $product['title'] ?>">
                    <input type="hidden" name="product_article" value="<?= $product['article'] ?>">
                    <input type="hidden" name="product_sale" value="<?= $product['sale'] ?>">
                    <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                    <input type="hidden" name="image_path" value="<?= $product['image_path'] ?>">


                    <div class="page-product-main-action__price">
                        <?php if (!empty($product['sale'])): ?>
                            <div class="mini-product__price_main">
                                <span class="mini-product__price_old"><?= $product['price'] ?> BYN</span>
                                <span class="mini-product__price_current"><?= ceil($product['price'] - ($product['price'] * $product['sale'] / 100)) ?> BYN</span>
                            </div>
                            <div class="mini-product__price_sale">
                                <div class="mini-product__price_sale-count">-<?= $product['sale'] ?>%</div>
                            </div>
                        <?php else: ?>
                            <div class="mini-product__price_main">
                                <span class="mini-product__price_old"></span>
                                <span class="mini-product__price_current"><?= $product['price'] ?> BYN</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="page-product-main-action__wrap">
                        <div class="page-product-main-action__count">
                            <span class="page-product-main-action__count_minus">-</span>
                            <input type="text" name="count" value="1">
                            <span class="page-product-main-action__count_plus">+</span>
                        </div>
                        <button type="submit" class="page-product-main-action__buy">
                            <div class="page-product-main-action__buy_icon"><i class="fa-solid fa-cart-shopping"></i>
                            </div>
                            <span class="page-product-main-action__buy_text">В корзину</span>
                        </button>

                    </div>
                </div>
                <div class="page-product-main-bottom">
                    <span class="page-product-main-bottom__title">Способы получения</span>
                    <div class="page-product-main-bottom__items">
                        <span class="page-product-main-bottom__item"><a
                                    href="">Самовывоз</a> через 30 мин, бесплатно</span>
                        <span class="page-product-main-bottom__item"><a
                                    href="">Доставка</a> в течении 1-3 дней</span>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="page-product-info">
        <div class="container">
            <div class="page-product-info__tabs">
                <a href="" class="page-product-info__tabs_item active" data-tab="1">Описание товара</a>
                <a href="" class="page-product-info__tabs_item" data-tab="2">Характеристики</a>
                <a href="" class="page-product-info__tabs_item" data-tab="3">Отзывы о товаре</a>
                <a href="" class="page-product-info__tabs_item" data-tab="4">Гарантия</a>
            </div>
            <div class="page-product-info__content">
                <div class="page-product-info__content_tab active" data-tab="1"><?= $product['description'] ?></div>
                <div class="page-product-info__content_tab" data-tab="2">
                    <div class="page-product-filters">
                        Характеристики
                    </div>
                </div>
                <div class="page-product-info__content_tab" data-tab="3">
                    <div class="feedbacks">
                        <div class="feedback_btn">
                            <button id="feedback_btn_send" class="send_feedback_btn">Оставить отзыв</button>
                        </div>
                        <div class="all_feedbacks">

                            <?php if(!empty($feedbacks)): ?>
                                <?php foreach ($feedbacks as $feedback): ?>
                                    <div class="feedback">
                                        <div class="feedback__icon">
                                            <img src="https://media.istockphoto.com/id/1451587807/vector/user-profile-icon-vector-avatar-or-person-icon-profile-picture-portrait-symbol-vector.jpg?s=612x612&w=0&k=20&c=yDJ4ITX1cHMh25Lt1vI1zBn2cAKKAlByHBvPJ8gEiIg=" alt="">
                                        </div>
                                        <div class="feedback__details">
                                            <div class="feedback__details_up">
                                                <div class="feedback__details_up_name_rating">
                                                    <div class="feedback__details_up_name">
                                                        Alex
                                                    </div>
                                                    <div class="feedback__details_up_rating"><?=$feedback['rate']?></div>
                                                </div>
                                                <div class="feedback__details_up_date">
                                                    <?php
                                                    $originalDate = $feedback['created_at'];
                                                    $dateObject = DateTime::createFromFormat('Y-m-d H:i:s', $originalDate);
                                                    $formattedDate = $dateObject->format('d/m/Y');
                                                    ?>
                                                    <?=$formattedDate?>
                                                </div>
                                            </div>
                                            <div class="feedback__details_message">
                                                <p><?=$feedback['message']?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else:?>
                            <p>Отзывов пока нет :(</p>
                            <?php endif;?>
                        </div>
                    </div>

                </div>
                <div class="page-product-info__content_tab" data-tab="4">Гарантия</div>
            </div>
        </div>
    </div>
</div>




<?php include 'layouts/footer.php'; ?>


<script>
    $(document).ready(function () {
        // клик на картинки сбоку и отобранежение их как главную
        $('.page-product-gallery__thumbs__item').on('click', function () {

            let path = $(this).find('img').attr('src')
            $('.page-product-gallery__main img').attr('src', path)

            $('.page-product-gallery__thumbs__item').removeClass('active')
            $(this).addClass('active')
        })

        // Plus
        $('.page-product-main-action__count_plus').on('click', function () {
            let count = $(this).siblings('input[name="count"]').val();
            $(this).siblings('input[name="count"]').val(Number(count) + 1);
        })
        // Minus
        $('.page-product-main-action__count_minus').on('click', function () {
            let count = $(this).siblings('input[name="count"]').val();
            if (count > 1) {
                $(this).siblings('input[name="count"]').val(Number(count) - 1);
            }
        })

        //Описание-Характеристики-Отзывы-Гарантия
        $('.page-product-info__tabs_item').on('click', function (e){
            e.preventDefault()
            $('.page-product-info__tabs_item').removeClass('active')
            $('.page-product-info__content_tab').removeClass('active')
            $(this).addClass('active')
            $('.page-product-info__content_tab[data-tab="' + $(this).attr('data-tab') + '"]').addClass('active')
        })

        //выбор цвета

        $('.page-product-main-options__item').on('click', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active')
            } else {
                $(this).parents('.page-product-main-options__items').find('.page-product-main-options__item').removeClass('active')
                $(this).addClass('active')
            }

        })

    });
</script>


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const acc_carousel = new Swiper('.page-product-main-dop__items', {
        loop: false,
        slidesPerView: 3,
        spaceBetween: 0,
        pagination: {
            el: '.swiper-wrapper-pagination',
        },
    });
</script>

<!--Modal-->
<script>
    const feedback_btn_send = document.getElementById('feedback_btn_send')
    const modal_container_feedback = document.getElementById('modal_container_feedback')
    const close_modal_feedback = document.getElementById('close_modal_feedback')

    feedback_btn_send.addEventListener('click', ()=> {
        modal_container_feedback.classList.add('show');
    });
    close_modal_feedback.addEventListener('click', ()=> {
        modal_container_feedback.classList.remove('show');
    });
</script>

</body>
</html>


