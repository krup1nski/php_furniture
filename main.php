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


                    <!--                    @foreach($categories as $category)-->
                    <!--                    @if(empty($category->top))-->
                    <li class="list-cat__list_item">
                        <a href="" class="list-cat__list_link">категория1</a>
                        <a href="" class="list-cat__list_link">категория2</a>
                        <a href="" class="list-cat__list_link">категория3</a>
                        <a href="" class="list-cat__list_link">категория4</a>
                        <!--                        {{--                            Если в категории имеется подкатегория--}}-->
                        <!--                        @foreach($categories as $cat)-->
                        <!--                        @if($cat->top == $category->id)-->
                        <!--                        <a href="{{route('category',$cat->hash)}}" class="list-cat__list_link">- {{ $cat->title }}</a>-->
                        <!--                        @endif-->
                        <!--                        @endforeach-->
                    </li>
                    <!--                    @endif-->
                    <!--                    @endforeach-->
                </ul>
            </div>
        </div>

        <ul class="main-menu__list">
            <li class="main-menu__item"><a href="" class="main-menu__link">Акции</a></li>
            <li class="main-menu__item"><a href="" class="main-menu__link">О фабрике</a></li>
            <li class="main-menu__item"><a href="" class="main-menu__link">Оплата</a></li>
            <li class="main-menu__item"><a href="{{route('accessories')}}" class="main-menu__link">Аксессуары</a></li>
            <li class="main-menu__item"><a href="" class="main-menu__link">Сборка</a></li>
            <li class="main-menu__item"><a href="" class="main-menu__link">Доставка</a></li>
            <li class="main-menu__item"><a href="" class="main-menu__link">Контакты</a></li>
        </ul>
    </div>
</nav>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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

    window.addToCart = (product) => {
        let result
        let cart = JSON.parse(localStorage.getItem('cart'))

        if(cart == null){
            result = [product]
        }else{
            let match = false
            let options_ids = product.product_options.map(item => item.option_id)
            cart.map(cart_item =>{
                if(cart_item.product_id == product.product_id){
                    if(cart_item.product_options.length || product.product_options.length){
                        let cart_item_options_ids = []
                        cart_item.product_options.forEach(cart_item_option =>{
                            cart_item_options_ids.push(cart_item_option.option_id)
                        })
                        let option_math = false;
                        if(cart_item_options_ids.length && options_ids.length && cart_item_options_ids.toSorted() === options_ids.toSorted()) option_math = true

                        if(option_math){
                            match = true
                            return cart_item.count = Number(cart_item.count) + Number(product.count)
                        }
                    }else{
                        match = true
                        return cart_item.count = Number(cart_item.count) + Number(product.count)
                    }
                }
            })
            if(match){
                result = cart
            }else{
                result = [...cart, product]
            }
        }


        $('.ml-action_cart__count').text(result.length)


        window.addNotification(product.product_title, '{{ route('cart') }}')

        localStorage.setItem('cart', JSON.stringify(result));
    }

    window.toggleToLike = (product) => {
        let result
        let wishlist = JSON.parse(localStorage.getItem('wishlist'))

        if(wishlist == null){
            result = [product]
        }else{
            if(wishlist.filter(item => item.product_id == product.product_id).length){
                result = wishlist.filter(item => {
                    if(item.product_id != product.product_id){
                        return item
                    }
                })
            }else{
                result = [...wishlist, product]
            }
        }
        $('.ml-action__like_count').text(result.length)
        localStorage.setItem('wishlist', JSON.stringify(result));
    }

    window.toggleToCompare = (product) => {
        let result
        let compare = JSON.parse(localStorage.getItem('compare'))

        if(compare == null){
            result = [product]
        }else{
            if(compare.filter(item => item.product_id == product.product_id).length){
                result = compare.filter(item => {
                    if(item.product_id != product.product_id){
                        return item
                    }
                })
            }else{
                result = [...compare, product]
            }
        }
        localStorage.setItem('compare', JSON.stringify(result));
    }

    window.miniProductBuyHandler = (_this) => {
        let id = _this.parents('.mini-product').find('input[name="product_id"]').val();
        let title = _this.parents('.mini-product').find('input[name="product_title"]').val();
        let price = _this.parents('.mini-product').find('input[name="product_price"]').val();
        let sale = _this.parents('.mini-product').find('input[name="product_sale"]').val();
        let img_path = _this.parents('.mini-product').find('input[name="product_img"]').val();
        let hash = _this.parents('.mini-product').find('input[name="product_hash"]').val();

        let product = {
            id: Number(id),
            product_id: id,
            product_title: title,
            product_img: img_path,
            product_price: price,
            product_sale: sale,
            product_hash: hash,
            count: 1,
            product_options: [],
            accessories: []
        }
        _this.addClass('active')
        window.addToCart(product)
    }
    window.miniProductLikeHandler = (_this) => {
        let id = _this.parents('.mini-product').find('input[name="product_id"]').val();
        let title = _this.parents('.mini-product').find('input[name="product_title"]').val();
        let price = _this.parents('.mini-product').find('input[name="product_price"]').val();
        let sale = _this.parents('.mini-product').find('input[name="product_sale"]').val();
        let img_path = _this.parents('.mini-product').find('input[name="product_img"]').val();
        let hash = _this.parents('.mini-product').find('input[name="product_hash"]').val();

        let product = {
            id: Number(id),
            product_id: id,
            product_title: title,
            product_img: img_path,
            product_price: price,
            product_sale: sale,
            product_hash: hash,
            count: 1,
            product_options: [],
            accessories: []
        }
        _this.toggleClass('active')
        window.toggleToLike(product)
    }

    window.addClassElsMiniProduct = () => {
        let cart = JSON.parse(localStorage.getItem('cart')) || []
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || []
        let compare = JSON.parse(localStorage.getItem('compare')) || []

// Для всех товаров в корзине добавляем класс active
        $('.mini-product').each(function (){
            let id = $(this).find('input[name="product_id"]').val()
            if(wishlist && wishlist.filter(item => item.product_id == id).length){
                $(this).find('.mini-product__like').addClass('active')
            }
            if(cart && cart.filter(item => item.product_id == id).length){
                $(this).find('.mini-product__buy').addClass('active')
            }
            if(compare && compare.filter(item => item.product_id == id).length){
                $(this).find('.mini-product__compare').addClass('active')
            }
        })
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

        // Устанавливаем количество товаров в корзине
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        $('.ml-action_cart__count').text(cart.length);

        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        $('.ml-action__like_count').text(wishlist.length);
    });

</script>
