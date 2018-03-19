<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/img/logos.ico">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <nav class="navbar navbar-toggleable-md">
        <div class="search-area">
            <div class="search-area-inner d-flex align-items-center justify-content-center">
                <div class="close-btn"><i class="icon-close"></i></div>
                <div class="row">
                    <div class="col-md-8 push-md-2">
                        <form action="#">
                            <div class="form-group">
                                <input type="search" name="search" id="search" placeholder="What are you looking for?">
                                <button type="submit" class="submit"><i class="icon-search-1"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- Navbar Brand -->
            <div class="navbar-header d-flex align-items-center justify-content-between">
                <a href="/"><img class="logo-light" src="/img/logos.ico" width="45"></a>
                <!-- Navbar Brand -->
                <!-- Toggle Button-->
                <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
            </div>
            <!-- Navbar Menu -->
            <div id="navbarcollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <!-- Search-->
                    <li class="nav-item"><a href="/" class="nav-link animsition-link">Главная</a></li>
                    <li class="nav-item"><a href="/blog/index" class="nav-link animsition-link">Статьи</a></li>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <li class="nav-item"><a href="/site/login" class="nav-link animsition-link">Войти</a></li>
                        <li class="nav-item"><a href="/site/signup" class="nav-link animsition-link">Регистрация</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a href="/site/personal" class="nav-link animsition-link">Личный Кабинет</a></li>
                        <li class="nav-item"><a href="/site/logout" class="nav-link animsition-link">Выйти</a></li>
                    <?php endif;?>
<!--                    <li class="nav-item"><a href="#" class="nav-link animsition-link">About </a></li>-->
<!--                    <li class="nav-item"><a href="blog.html" class="nav-link animsition-link">Contact</a></li>-->
                </ul>
                <div class="navbar-text"><a href="#" class="search-btn"><i class="icon-search-1"></i></a></div>
            </div>
        </div>
    </nav>

<!--    <div class="container">-->
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
<!--    </div>-->
</div>

<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="logo">
                    <h6 class="text-white">Bootstrap Blog</h6>
                </div>
                <div class="contact-details">
                    <p>53 Broadway, Broklyn, NY 11249</p>
                    <p>Телефон: (020) 123 456 789</p>
                    <p>Email: <a href="mailto:info@company.com">Info@Company.com</a></p>
                    <ul class="social-menu">
                        <li class="list-inline-item"><a target="_blank" href="https://www.facebook.com/neobmezheni.mozhlyvosti/"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-behance"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="menus d-flex">
                    <ul class="list-unstyled">
                        <li> <a href="#">Мой Аккаунт</a></li>
                        <li> <a href="/site/our-partners">Наши партнеры</a></li>
                        <li> <a href="/site/contact">Pricing</a></li>
                        <li> <a href="#">Privacy &amp; Policy</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <div class="copyrights">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; Murka 2018. All rights reserved.</p>
                </div>

            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
