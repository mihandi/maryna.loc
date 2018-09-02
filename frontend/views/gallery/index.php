<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\widgets\LinkPager;

$this->title = 'Галерея';

$articles_path = '/blog/article?id=';
$photos = [1,2,3,4,5,6,7,8,9,10,11,12,13,14]

?>
<main class="page-two-col bg-white">
    <!-- section portfolio-->
    <section class="section section-portfolio bg-white p-t-120 p-b-135">
        <div class="container">
            <div class="section-inner">
                <h3 class="section-heading m-b-40">PORTFOLIO</h3>
                <ul class="filter-bar h-list">
                    <?php foreach ($categories as $category): ?>
                        <li class="list-item <?= !prev($categories)?'active':'' ?>" data-filter="<?= $category->seo_url; ?>"><?= $category->title?></li>
                    <?php endforeach;?>
                </ul>
                <div class="row po-list isotope">
                    <?php foreach ($category_galleries as $galleries):  ?>
                        <?php foreach ($galleries as $gallery):?>
                            <div class="col-lg-6 col-md-6 isotope-item <?= $gallery['cTitle'] ?> wow fadeIn" data-wow-duration="0.5s">
                                <article class="card-primary card-portfolio">
                                    <a class="card-link-overlay" href="portfolio-details.html"></a>
                                    <div class="bg-overlay"></div>
                                    <figure class="card-figure">
                                        <img class="card-image" src="images/portfolio-01.jpg" alt="<?= $gallery['title'] ?>" />
                                    </figure>
                                    <div class="card-featured">
                                        <a class="portfolio-link fa fa-chain" href="portfolio-details.html"></a>
                                        <a class="portfolio-view fa fa-search" href="images/portfolio-01.jpg" data-lightbox="roadtrip" data-title="<?= $gallery['title'] ?>"></a>
                                    </div>
                                    <header class="card-header">
                                        <h3 class="card-title portfolio-title"><?= $gallery['title'] ?></h3>
                                    </header>
                                </article>
                            </div>
                        <?php endforeach;?>
                    <?php endforeach;?>
                </div>
                <div class="po-btn">
                    <a class="au-btn au-btn-lg au-btn-radius au-btn-border au-btn-block load-btn" href="#">LOAD MORE</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end section portfolio-->
</main>
