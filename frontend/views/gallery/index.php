<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\widgets\LinkPager;

$this->title = 'Галерея';

$articles_path = '/blog/article?id=';
$photos = [1,2,3,4,5,6,7,8,9,10,11,12,13,14]

?>
<main class="page-two-col bg-white">
    <section class="section-blog-md-list p-t-105 p-b-130">
        <div class="container">
            <div class="row">
                <?php foreach ($photos as $photo):?>
                    <div class="col-lg-4 col-md-6">
                    <article class="box-primary box-blog">
                        <figure class="box-figure">
                            <a href="<?= ''?>">
                                <img class="box-image blog-image" src="<?= '' ?>" alt="<?= ''?>" />
                            </a>
                        </figure>
                        <header class="box-header">
                            <h3 class="box-title blog-title">
                                <a href="<?= ''?>"><?= ''?></a>
                            </h3>
                        </header>
                        <p class="box-text"><?= ''?></p>
                        <footer class="box-footer">
                            <a class="blog-link" href="<?= ''?>">ПРОДОЛЖИТЬ ЧТЕНИЕ</a>
                        </footer>
                    </article>
                </div>
                <?php endforeach; ?>
            </div>
<!--            <nav aria-label="Page navigation example">-->
<!--                <ul class="pagination pagination-template d-flex justify-content-center">-->
<!--                    --><?php
//                    echo LinkPager::widget([
//                        'pagination' => $pagination,
//                    ]);
//                    ?>
<!--                </ul>-->
<!--            </nav>-->
        </div>
    </section>
</main>
