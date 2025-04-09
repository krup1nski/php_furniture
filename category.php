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

<div class="top-line">
    <div class="container flex-center">
        <div class="top-line__main flex-center">
            <div class="select-city flex-center">
                <span class="select-city__text">Москва</span>
                <div class="select-city__icon">
                    <i class="fa-solid fa-angle-down"></i>
                </div>
            </div>

            <div class="pick-up-point flex-center">
                <span class="pick-up-point__text">Пункт выдачи</span>
                <div class="pick-up-point__icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
            </div>

            <div class="top-line-time flex-center"><span class="top-line-time__text"> Пн-Пт <span>c 9:00 до 21:00</span></span>
            </div>
        </div>
        <div class="user-account flex-center">
            <div class="user-account__icon">
                <i class="fa-solid fa-user"></i>
            </div>
            <span class="user-account__text">Личный кабинет</span>
        </div>
    </div>
</div>
<div class="middle-line">
    <div class="container flex-center">
        <a class="ml-logo" href="/">
            <img src="<?=BASE_URL?>images\logo.png" alt="">
        </a>
        <form action="" class="fast-search">
            <div class="fast-search__input">
                <input type="text" name="search" placeholder="Поиск товара">
                <div class="fast-search__icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <span class="fast-search__example">Например: Комод</span>
        </form>
        <div class="ml-callback">
            <a href="tel:+375441234567" class="ml-callback__phone">+375(44)12-34-567</a>
            <a href="" class="ml-callback__call">Заказать звонок</a>
        </div>
        <div class="ml-action flex-center">
            <div class="ml-action_compare">
                <div class="ml-action_cart_icon">
                    <span class="ml-action_cart__count">0</span>
                    <i class="fa-solid fa-equals"></i>
                </div>
            </div>
            <div class="ml-action_like">
                <div class="ml-action_like_icon">
                    <span class="ml-action__like_count">0</span>
                    <a href="">
                        <i class="fa-solid fa-heart"></i>
                    </a>
                </div>

            </div>
            <div class="ml-action_cart">
                <span class="ml-action_cart__count">0</span>
                <div class="ml-action_cart_icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div class="ml-action__cart_text">
                    <a href="">Корзина</a>
                </div>
            </div>

        </div>
    </div>
</div>

<nav class="main-menu">
    <div class="container">
        <div class="list-cat">
            <div class="list-cat__main flex-center">
                <div class="list-cat__main_icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <span class="list-cat__main_text">Все категории</span>
            </div>
            <div class="list-cat_drop">
                <ul class="list-cat__list">
                    <?php $categories = select_all('categories') ?>
                    <?php foreach ($categories as $category): ?>
                        <?php if(empty($category['top'])):?>
                            <li class="list-cat__list_item">
                                <a href="" class="list-cat__list_link"><?=$category['title']?></a>

                                <!--  Если в категории имеется подкатегория -->
                                <?php foreach ($categories as $cat): ?>
                                    <?php if($category['id'] == $cat['top']): ?>
                                        <a href="" class="list-cat__list_link">- <?=$cat['title']?></a>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </li>
                        <?php endif;?>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>

        <ul class="main-menu__list">
            <li class="main-menu__item"><a href="" class="main-menu__link">Акции</a></li>
            <li class="main-menu__item"><a href="" class="main-menu__link">О фабрике</a></li>
            <li class="main-menu__item"><a href="" class="main-menu__link">Оплата</a></li>
            <li class="main-menu__item"><a href="" class="main-menu__link">Аксессуары</a></li>
            <li class="main-menu__item"><a href="" class="main-menu__link">Сборка</a></li>
            <li class="main-menu__item"><a href="" class="main-menu__link">Доставка</a></li>
            <li class="main-menu__item"><a href="" class="main-menu__link">Контакты</a></li>
        </ul>
    </div>
</nav>


    <div class="notifications">

    </div>

    <div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumbs__list">

                <li class="breadcrumbs__item">
                    <a href="{{ $br['href'] }}" class="breadcrumbs__el">
                        <i class="fa-solid fa-house"></i>Главная
                    </a>
                    <span class="breadcrumbs__el">Категория -</span>
                </li>


            </ul>
        </div>
    </div>
    <div class="container">
        <h1 class="page-title">Категория - </h1>
    </div>


<div class="page-category">
    <div class="container">
        <form action="" method="post" class="pc-filter">
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


                    <?php $products = select_all('products');?>
                    <?php foreach ($products as $product): ?>
                    <div class="mini-product">
                        <input type="hidden" name="product_id" value="<?=$product['id']?>">
                        <input type="hidden" name="product_title" value="<?=$product['title']?>">
                        <input type="hidden" name="product_hash" value="<?=$product['hash']?>">
                        <input type="hidden" name="product_price" value="<?=$product['price']?>">
                        <input type="hidden" name="product_sale" value="<?=$product['sale']?>">
                        <input type="hidden" name="product_img" value="<?=$product['image_path']?>">


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
                            <a href="{{ route('product', $product->hash) }}" class="mini-product__title"><?=$product['title']?></a>
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

                            <div class="mini-product__price_main">
                                <span class="mini-product__price_old"><?=$product['price']?> BYN</span>
                                <span class="mini-product__price_current"><?= ceil($product['price'] - ($product['price'] * $product['sale'] / 100)) ?> BYN</span>
                            </div>
                            <div class="mini-product__price_sale">
                                <div class="mini-product__price_sale-count">-<?=$product['sale']?>%</div>
                            </div>

                        </div>
                        <?php if(!empty($product['quantity'])): ?>
                            <div class="mini-product__buy">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                        <?php else: ?>
                            <div class="mini-product__not-buy">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                        <?php endif; ?>

                    </div>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="page-category__pagination">
                {{ $data['products']->links() }}
            </div>
        </div>
    </div>

</div>



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

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

    window.addNotification = (title, link) => {
        let time = Date.now()
        let notification = `
                <div class="notifications__item hide" data-id="${time}">
                    <div class="notifications__item_close">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <div class="notifications__item_icon">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="notifications__item_info">
                        <span class="notifications__item_text"><strong>${title}</strong> добавлен в корзину</span>
                        <a href="${link}" class="notifications__item_link">Открыть корзину</a>
                    </div>
                </div>`
        $('.notifications').append(notification)
        setTimeout(function () {
            $('.notifications__item[data-id="'+ time +'"]').removeClass('hide')
        }, 10)

        setTimeout(function (){
            $('.notifications__item[data-id="'+ time +'"]').addClass('hide')
            setTimeout(function (){
                $('.notifications__item[data-id="'+ time +'"]').remove()
            }, 250)
        }, 5000)
    }



    //выпадающий список категорий
    $(document).ready(function () {
        let $menu = $('.list-cat_drop');
        let $toggleBtn = $('.list-cat__main_icon');

        // Скрываем меню, если не на главной
        if (window.location.pathname !== '/') {
            $menu.hide();
        }

        // Переключаем меню по клику
        $toggleBtn.on('click', function (e) {
            e.stopPropagation();
            $menu.slideToggle();
        });

        // Закрываем меню, если кликнули вне него
        $(document).on('click', function (e) {
            if (!$menu.is(e.target) && $menu.has(e.target).length === 0 && !$toggleBtn.is(e.target)) {
                $menu.slideUp();
            }
        });

    });




</script>

</body>
</html>

