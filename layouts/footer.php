<footer class="footer">
    <div class="container">
        <div class="footer-main">
            <div class="footer-logo">
                <a class="ml-logo" href="<?=BASE_URL?>home.php">
                    <img src="<?=BASE_URL?>images\logo.png" alt="">
                </a>
            </div>
            <div class="footer-main__info">Информация, предоставленная на этой странице не является публичной офертой.</div>
            <span class="footer-main__copy">© 2025</span>
        </div>
        <div class="footer-category">
            <span class="footer-category__title">Каталог</span>
            <ul class="footer-category__list">
                <?php $categories = select_all('categories'); ?>

                <?php foreach ($categories as $category): ?>
                    <?php if(empty($category['top'])): ?>
                        <li class="footer-category__item"><a href="category.php?id_category=<?= $category['id'] ?>" class="footer-category__link"><?=$category['title']?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="footer-menu">
            <span class="footer-menu__title">Компания</span>
            <ul class="footer-menu__list">
                <li class="footer-menu__item"><a href="" class="footer-menu__link">Наша продукция</a></li>
                <li class="footer-menu__item"><a href="" class="footer-menu__link">О нас</a></li>
                <li class="footer-menu__item"><a href="" class="footer-menu__link">Лицензия</a></li>
                <li class="footer-menu__item"><a href="" class="footer-menu__link">Доставка</a></li>
                <li class="footer-menu__item"><a href="" class="footer-menu__link">Контакты</a></li>
                <li class="footer-menu__item"><a href="" class="footer-menu__link">Политика конфиденциальности</a></li>
            </ul>
        </div>
        <div class="footer-contact">
            <span class="footer-contact__title">Компания</span>
            <div class="footer-contact__item">
                <div class="footer-contact__item_icon">
                    <i class="fa-solid fa-phone orange"></i>
                </div>
                <a href="tel:+375441234567" class="footer-contact__item_text">+375(44)123-45-67</a>
            </div>


            <div class="footer-contact__item">
                <div class="footer-contact__item_icon">
                    <i class="fa-solid fa-envelope orange"></i>
                </div>
                <a href="mailto:info-laravel@furniture.by" class="footer-contact__item_text">info-laravel@furniture.by</a>
            </div>



            <div class="footer-contact__item">
                <div class="footer-contact__item_icon">
                    <i class="fa-solid fa-clock orange"></i>
                </div>
                <span class="footer-contact__item_text">Пн.- Пт. c 9:00 до 21:00, Cб. с 10:00 до 20:00</span>
            </div>



            <div class="footer-contact__item">
                <div class="footer-contact__item_icon">
                    <i class="fa-solid fa-location-dot orange"></i>
                </div>
                <span class="footer-contact__item_text">г. Минск, ул. Победы, д.8</span>
            </div>
        </div>
    </div>
</footer>
