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


<header class="header">
    <div class="swiper header-carousel">
        <div class="swiper-wrapper">
            <div class="swiper-slide header-carousel__slide" style="background-image: url('images/banner1.png')">
                <div class="container">
                    <h3 class="header-carousel__title">Бери больше -<br> плати меньше</h3>
                    <div class="header-carousel__desc">
                        <p>При покупке одного и более изделий скидка на последующие - 20 byn</p>
                    </div>
                    <a href="" class="bnt-border">Подробнее</a>
                </div>
            </div>


            <div class="swiper-slide header-carousel__slide" style="background-image: url('images/banner2.png')">
                <div class="container">
                    <h3 class="header-carousel__title">Кровать в <br>скандинавском<br> стиле со скидкой 50%</h3>
                    <div class="header-carousel__desc">
                        <p>До 1 августа</p>
                    </div>
                    <a href="" class="bnt-border">Подробнее</a>
                </div>
            </div>

        </div>
        <div class="header-carousel-pagination-wrap">
            <div class="container">
                <div class="header-carousel-pagination"></div>
            </div>
        </div>
    </div>
</header>

<section class="categories">
    <div class="container">
        <h2 class="categories__title">Более 30 000 позиций ждут вас</h2>
        <span class="categories__desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span>
        <div class="categories__items">
            <?php $categories = select_all('categories'); ?>
            <?php foreach ($categories as $category): ?>
                <?php if(empty($category['top'])): ?>
                    <div class="categories__item">
                        <div class="categories__item_icon">
                            <img src="<?=$category['icon']?>" alt="">
                        </div>
                        <h4 class="categories__item_title">
                            <a href=""><?=$category['title']?></a>
                        </h4>
                        <div class="categories__item_count">12 шт.</div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="adv">
    <div class="container">
        <div class="adv__item">
            <div class="adv__item_icon">
                <img src="<?=BASE_URL?>images/discount.svg" alt="">
            </div>
            <span class="adv__item_title">Выгодные акции и честные скидки</span>
        </div>
        <div class="adv__item">
            <div class="adv__item_icon">
                <img src="<?=BASE_URL?>images/certificate.svg" alt="">
            </div>
            <span class="adv__item_title">Сертифицированные продукции</span>
        </div>
        <div class="adv__item">
            <div class="adv__item_icon">
                <img src="<?=BASE_URL?>images/sell-product.svg" alt="">
            </div>
            <span class="adv__item_title">Широкий ассортимент товаров</span>
        </div>
        <div class="adv__item">
            <div class="adv__item_icon">
                <img src="<?=BASE_URL?>images/delivery.svg" alt="">
            </div>
            <span class="adv__item_title">Быстрая и удобная доставка в срок</span>
        </div>
    </div>
</section>

<section class="sale">
    <div class="container">
        <h3 class="sale__title">Специальные предложения</h3>
        <div class="swiper sale-carousel">
            <div class="swiper-wrapper">
                <?php $sales = select_all('products', ["sale >" => 0]); ?>
                <?php foreach ($sales as $product): ?>

                <div class="swiper-slide mini-product">
                    <input type="hidden" name="product_id" value="<?=$product['id']?>">
                    <input type="hidden" name="product_hash" value="<?=$product['hash']?>">

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
    </div>
</section>

<section class="info">
    <div class="container">
        <div class="info_desc">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.</p>
            <a href="" class="info__link">Подробнее</a>
        </div>
    </div>
</section>
<!---->
<!---->
<!---->
<!--@include('partials.footer')-->


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const header_carousel = new Swiper('.header-carousel', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
        },
    });


    const sale_carousel = new Swiper('.sale-carousel', {
        loop: true,
        slidesPerView: 3,
        spaceBetween:0,
        pagination: {
            el: '.swiper-wrapper-pagination',
        },
    });
</script>

<script>

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

