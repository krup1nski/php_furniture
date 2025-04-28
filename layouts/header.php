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
            <!--            <div class="user-account__icon">-->
            <!--                <i class="fa-solid fa-user"></i>-->
            <!--            </div>-->
            <?php if(isset($_SESSION['name'])):?>
                <span class="user-account__text"><?=$_SESSION['name']?></span>
                <a href="logout.php" class="user-account__text">Выйти</a>
            <?php else:?>
                <a href="login.php" class="user-account__text">Войти</a>
                <a href="registration.php" class="user-account__text">Регистрация</a>
            <?php endif;?>

        </div>
    </div>
</div>
<div class="middle-line">
    <div class="container flex-center">
        <a class="ml-logo" href="<?=BASE_URL?>home.php">
            <img src="<?=BASE_URL?>images\logo.png" alt="">
        </a>
        <form action="<?=BASE_URL?>search.php" method="get" class="fast-search">
            <div class="fast-search__input">
                <input type="text" name="search" placeholder="Поиск товара">
                <button type="submit" class="fast-search__icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <span class="fast-search__example">Например: Комод</span>
        </form>
        <div class="ml-callback">
            <a href="tel:+375441234567" class="ml-callback__phone">+375(44)12-34-567</a>
            <button id="order_call" class="ml-callback__call">Заказать звонок</button>
        </div>
        <div class="ml-action flex-center">
            <div class="ml-action_cart">
                <div class="ml-action_compare_icon">
                    <span class="ml-action_compare__count">0</span>
                    <i class="fa-solid fa-equals"></i>
                </div>
            </div>
            <div class="ml-action_like">
                <div class="ml-action_like_icon">
                    <span class="ml-action__like_count">0</span>
                    <a href="<?=BASE_URL?>wishlist.php">
                        <i class="fa-solid fa-heart"></i>
                    </a>
                </div>

            </div>

            <div class="ml-action_cart">
                <span class="ml-action_cart__count">
                    <?php if(isset($_SESSION['cart'])): ?>
                        <?=count($_SESSION['cart'])?>
                    <?php else:?>
                    0
                    <?php endif;?>
                </span>

                <div class="ml-action_cart_icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div class="ml-action__cart_text">
                    <a href="<?=BASE_URL?>cart.php">Корзина</a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modal_send'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $phone = $_POST['phone'];
    $phone = filter_var($phone, FILTER_SANITIZE_STRING);
    $message = $_POST['message'];
    $message = filter_var($message, FILTER_SANITIZE_STRING);

    global $pdo;
    $sql= $pdo->prepare("INSERT INTO `callback` (name, phone, message) VALUES (?,?,?)");
    $sql->execute([$name, $phone, $message]);
}
?>

<div class="modal-container" id="modal_container">
    <div class="modal">
        <h1>Заказать звонок</h1>
        <form action="" method="post" class="modal-inputs">
            <input type="text" name="name" placeholder="Ваше имя">
            <input type="text" name="phone" placeholder="+375(__)___-__-__">
            <textarea id="story" name="message" rows="5" cols="33" placeholder="Ваш вопрос"></textarea>

            <button type="submit" name="modal_send" class="pcart-main-order__buy">Отправить</button>
        </form>
        <button id="close_modal" class="close_model">x</button>
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
                                <a href="category.php?id_category=<?= $category['id'] ?>" class="list-cat__list_link"><?=$category['title']?></a>

                                <!--  Если в категории имеется подкатегория -->
                                <?php foreach ($categories as $cat): ?>
                                    <?php if($category['id'] == $cat['top']): ?>
                                        <a href="category.php?id_category=<?= $category['id'] ?>" class="list-cat__list_link">- <?=$cat['title']?></a>
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
            <li class="main-menu__item"><a href="<?=BASE_URL?>accessories.php" class="main-menu__link">Аксессуары</a></li>
            <li class="main-menu__item"><a href="" class="main-menu__link">Сборка</a></li>
            <li class="main-menu__item"><a href="" class="main-menu__link">Доставка</a></li>
            <li class="main-menu__item"><a href="" class="main-menu__link">Контакты</a></li>
        </ul>
    </div>
</nav>


<div class="notifications">
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!--Notification-->
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

<!--Modal-->
<script>
    const order_call = document.getElementById('order_call')
    const modal_container = document.getElementById('modal_container')
    const close_modal = document.getElementById('close_modal')

    order_call.addEventListener('click', ()=> {
        modal_container.classList.add('show');
    });
    close_modal.addEventListener('click', ()=> {
        modal_container.classList.remove('show');
    });
</script>