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
                <!-- Navbar Brand --><a href="/" class="navbar-brand animsition-link">Bootstrap Blog</a>
                <!-- Toggle Button-->
                <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
            </div>
            <!-- Navbar Menu -->
            <div id="navbarcollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <!-- Search-->
                    <li class="nav-item"><a href="/" class="nav-link animsition-link active">Home</a></li>
                    <li class="nav-item"><a href="/blog/index" class="nav-link animsition-link">Blog</a></li>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <li class="nav-item"><a href="/site/login" class="nav-link animsition-link">Login</a></li>
                        <li class="nav-item"><a href="/site/signup" class="nav-link animsition-link">Sign up</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a href="/site/logout" class="nav-link animsition-link active">Logout <?=Yii::$app->user->identity->login?></a></li>
                    <?php endif;?>
<!--                    <li class="nav-item"><a href="#" class="nav-link animsition-link">About </a></li>-->
<!--                    <li class="nav-item"><a href="blog.html" class="nav-link animsition-link">Contact</a></li>-->
                </ul>
                <div class="navbar-text"><a href="#" class="search-btn"><i class="icon-search-1"></i></a></div>
                <ul class="langs navbar-text"><a href="#" class="active">EN</a><span></span><a href="#">ES</a></ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
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
                    <p>Phone: (020) 123 456 789</p>
                    <p>Email: <a href="mailto:info@company.com">Info@Company.com</a></p>
                    <ul class="social-menu">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
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
                        <li> <a href="#">My Account</a></li>
                        <li> <a href="#">Add Listing</a></li>
                        <li> <a href="#">Pricing</a></li>
                        <li> <a href="#">Privacy &amp; Policy</a></li>
                    </ul>
                    <ul class="list-unstyled">
                        <li> <a href="#">Our Partners</a></li>
                        <li> <a href="#">FAQ</a></li>
                        <li> <a href="#">How It Works</a></li>
                        <li> <a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="latest-posts"><a href="#">
                        <div class="post d-flex align-items-center">
                            <div class="image"><img src="/img/small-thumbnail-1.jpg" alt="..." class="img-fluid"></div>
                            <div class="title"><strong>Hotels for all budgets</strong><span class="date last-meta">October 26, 2016</span></div>
                        </div></a><a href="#">
                        <div class="post d-flex align-items-center">
                            <div class="image"><img src="/img/small-thumbnail-2.jpg" alt="..." class="img-fluid"></div>
                            <div class="title"><strong>Great street atrs in London</strong><span class="date last-meta">October 26, 2016</span></div>
                        </div></a><a href="#">
                        <div class="post d-flex align-items-center">
                            <div class="image"><img src="/img/small-thumbnail-3.jpg" alt="..." class="img-fluid"></div>
                            <div class="title"><strong>Best coffee shops in Sydney</strong><span class="date last-meta">October 26, 2016</span></div>
                        </div></a></div>
            </div>
        </div>
    </div>
    <div class="copyrights">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2017. All rights reserved. Your great site.</p>
                </div>
                <div class="col-md-6 text-right">
                    <p>Template By <a href="https://bootstraptemple.com" class="text-white">Bootstrap Temple</a>
                        <!-- Please do not remove the backlink to Bootstrap Temple unless you purchase an attribution-free license @ Bootstrap Temple or support us at http://bootstrapious.com/donate. It is part of the license conditions. Thanks for understanding :)                         -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
