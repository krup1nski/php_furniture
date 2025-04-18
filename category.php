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
//tt($_POST);
//tt($_SESSION);

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_article'])){

    if(isset($_SESSION['cart']['product_'.$_POST['product_article']])){
        echo "<script>alert('Товар уже в корзине!');</script>";
    }else{
        $_SESSION['cart']['product_'.$_POST['product_article']] = [
            'id' => $_POST['product_id'],
            'title' => $_POST['product_title'],
            'sale' => $_POST['product_sale'],
            'price' => $_POST['product_price'],
            'count' => 1,
            'image_path' => $_POST['image_path'],
            'options' => [],
            'accessories' => [],
        ];
        echo "<script>alert('Товар добавлен!');</script>";
    }
}

?>

<?php include 'layouts/header.php'; ?>

<?php $page_category = select_one('categories', $_GET['id_category']) ?>


<div class="breadcrumbs">
    <div class="container">
        <ul class="breadcrumbs__list">
            <li class="breadcrumbs__item">
                <a href="<?=BASE_URL?>home.php" class="breadcrumbs__el">
                    <i class="fa-solid fa-house"></i>
                    Главная</a>
            </li>
            <li class="breadcrumbs__item">
                <span class="breadcrumbs__el"><?=$page_category['title']?></span>
            </li>
        </ul>
    </div>
</div>



    <div class="container">
        <h1 class="page-title"><?=$page_category['title']?></h1>
    </div>




<div class="page-category">
    <div class="container">
        <form action="" method="POST" class="pc-filter">
            <input type="hidden" name="order_by" value="">
            <div class="pc-filter__top">
                <div class="pc-filter__title">Фильтр</div>
                <div class="pc-filter__icon">
                    <i class="fa-solid fa-filter"></i>
                </div>
            </div>
            <div class="pc-filter-price">
                <div class="pc-filter-price__inputs">
                    <?php if (isset($_POST['price_from']) && $_POST['price_to']):?>
                    <input type="text" id="filter-price-slider-from" class="pc-filter-price__input"
                           name="price_from" placeholder="от 0" value="<?=$_POST['price_from']?>">
                    <input type="text" id="filter-price-slider-to" class="pc-filter-price__input" name="price_to"
                           placeholder="до 1999" value="<?=$_POST['price_to']?>">
                    <?php else: ?>
                    <input type="text" id="filter-price-slider-from" class="pc-filter-price__input"
                           name="price_from" placeholder="от 0">
                    <input type="text" id="filter-price-slider-to" class="pc-filter-price__input" name="price_to"
                           placeholder="до 1999">
                    <?php endif; ?>
                </div>
                <div id="filter-price-slider" class="pc-filter-price__slider"></div>
            </div>
            <div class="pc-filter__item">
                <div class="pc-filter__item_top">
                    <span class="pc-filter__item_title">Кошечки мурмявочки</span>
                    <div class="pc-filter__item_icon">
                        <i class="fa-solid fa-angle-up"></i>
                    </div>
                </div>
                <div class="pc-filter__item_cont">
                    <label class="pc-filter-checkbox">
                        <input type="checkbox" class="pc-filter-checkbox__checkbox" name="filters[{{$f->id }}]">
                        <div class="pc-filter-checkbox__box">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <span class="pc-filter-checkbox__value">Мышка</span>
                    </label>
                    <label class="pc-filter-checkbox">
                        <input type="checkbox" class="pc-filter-checkbox__checkbox" name="filters[{{$f->id }}]">
                        <div class="pc-filter-checkbox__box">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <span class="pc-filter-checkbox__value">Бубка</span>
                    </label>
                </div>
            </div>

<!--            @foreach($data['filters'] as $key => $filter)-->
<!--            <div class="pc-filter__item">-->
<!--                <div class="pc-filter__item_top">-->
<!--                    <span class="pc-filter__item_title">{{ $key }}</span>-->
<!--                    <div class="pc-filter__item_icon">-->
<!--                        <i class="fa-solid fa-angle-up"></i>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="pc-filter__item_cont">-->
<!--                    @foreach($filter as $f)-->
<!--                    <label class="pc-filter-checkbox">-->
<!--                        <input type="checkbox" class="pc-filter-checkbox__checkbox" name="filters[{{$f->id }}]" @if(in_array($f->id,  $data['select_filters'])) checked @endif>-->
<!--                        <div class="pc-filter-checkbox__box">-->
<!--                            <i class="fa-solid fa-check"></i>-->
<!--                        </div>-->
<!--                        <span class="pc-filter-checkbox__value">{{$f['title']}}</span>-->
<!--                    </label>-->
<!--                    @endforeach-->
<!--                </div>-->
<!--            </div>-->
<!--            @endforeach-->


            <div class="pc-filter__action">
                <button class="pc-filter__btn">Применить</button>
                <a href="{{ route('category', $data['category']->hash) }}" class="pc-filter__reset">Сбросить</a>
            </div>

        </form>
        <div class="page-category-main">
            <div class="page-category__content">
                <div class="page-category__sort">
                    <div class="pc-select">
                        <span class="pc-selector__title">Сортировка:</span>
                        <select name="order_by" id="" class="pc-selector__val">
                            <option value="">По умолчанию</option>
                            <option value="price_increase" <?php if(isset($_POST['sort_by']) && $_POST['sort_by'] == 'price_increase'): ?> selected <?php endif; ?>>По возрастанию</option>

                            <option value="price_decrease" <?php if(isset($_POST['sort_by']) && $_POST['sort_by'] == 'price_decrease'): ?> selected <?php endif; ?>>По убыванию</option>
                        </select>
                    </div>
                    <div class="pc-view">

                    </div>
                </div>
                <div class="page-category__products">


                    <?php $products = select_all('products', ['categories_id'=>$_GET['id_category']]);?>
                    <?php foreach ($products as $product): ?>
                    <form action="" method="POST" class="mini-product">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="product_title" value="<?= $product['title'] ?>">
                        <input type="hidden" name="product_article" value="<?= $product['article'] ?>">
                        <input type="hidden" name="product_sale" value="<?= $product['sale'] ?>">
                        <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                        <input type="hidden" name="image_path" value="<?= $product['image_path'] ?>">


                        <div class="mini-product__top">
                            <div class="mini-product__stock">
                                <?php if(!empty($product['quantity'])): ?>
                                    <?=$product['quantity']?> шт.
                                <?php else: ?>
                                    Нет в наличии
                                <?php endif; ?>
                            </div>
                            <div class="mini-product__action">
                                <div class="mini-product__compare">
                                    <i class="fa-solid fa-equals"></i>
                                </div>
                                <div class="mini-product__like">
                                    <i class="fa-solid fa-heart"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mini-product__img">
                            <img src="<?=$product['image_path']?>" alt="">
                        </div>

                        <?php if(!empty($product['quantity'])): ?>
                            <a href="product.php?product_id=<?=$product['id']?>" class="mini-product__title"><?=$product['title']?></a>
                        <?php else: ?>
                            <a href="" class="mini-product__title_out"><?=$product['title']?></a>
                        <?php endif; ?>

                        <div class="mini-product__rating">
                            <div class="mini-product__rating_icon">
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <span class="mini-product__rating_text">4.7</span>
                        </div>
                        <div class="mini-product__price">
                            <?php if(!empty($product['sale'])): ?>
                                <div class="mini-product__price_main">
                                    <span class="mini-product__price_old"><?=$product['price']?> BYN</span>
                                    <span class="mini-product__price_current"><?= ceil($product['price'] - ($product['price'] * $product['sale'] / 100)) ?> BYN</span>
                                </div>
                                <div class="mini-product__price_sale">
                                    <div class="mini-product__price_sale-count">-<?=$product['sale']?>%</div>
                                </div>
                            <?php else: ?>
                                <div class="mini-product__price_main">
                                    <span class="mini-product__price_old"></span>
                                    <span class="mini-product__price_current"><?=$product['price']?> BYN</span>
                                </div>
                            <?php endif;?>

                        </div>
                        <?php if(!empty($product['quantity'])): ?>
                            <button type="submit" class="mini-product__buy">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </button>
                        <?php else: ?>
                            <div class="mini-product__not-buy">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                        <?php endif; ?>

                    </form>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="page-category__pagination">
                {{ $data['products']->links() }}
            </div>
        </div>
    </div>

</div>


<?php include 'layouts/footer.php'; ?>

<script>

    $(document).ready(function (){
        // поле с выбором цены и ползунки
        $("#filter-price-slider").slider({
            range: true,
            min: 0,
            max: 1999,
            values: [<?= isset($_POST['price_from']) ? $_POST['price_from'] : 0 ?>, <?= isset($_POST['price_to']) ? $_POST['price_to'] : 1999 ?>],
            slide: function (event, ui) {
                $("#filter-price-slider-from").val(ui.values[0]);
                $("#filter-price-slider-to").val(ui.values[1]);
            }
        });
    });
</script>

</body>
</html>

