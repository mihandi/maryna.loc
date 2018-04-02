<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\widgets\LinkPager;

$this->title = 'Новости';

$articles_path = '/blog/article?id=';

?>
<main class="page-two-col bg-white">
    <section class="section-blog-md-list p-t-105 p-b-130">
        <div class="container">
            <div class="row">
                <?php foreach ($articles as $article):?>
                    <div class="col-lg-4 col-md-6">
                    <article class="box-primary box-blog">
                        <figure class="box-figure">
                            <a href="<?= $articles_path.$article['id']?>">
                                <img class="box-image blog-image" src="<?= $articles_image_path = '/elfinder/global/article_'.$article['id'].'/'.$article['image'] ?>" alt="<?= $article['title']?>" />
                            </a>
                        </figure>
                        <header class="box-header">
                            <h3 class="box-title blog-title">
                                <a href="<?= $articles_path.$article['id']?>"><?= $article['title']?></a>
                            </h3>
                        </header>
                        <p class="box-text"><?= substr($article['description'],0,250)?></p>
                        <footer class="box-footer">
                            <a class="blog-link" href="<?= $articles_path.$article['id']?>">ПРОДОЛЖИТЬ ЧТЕНИЕ</a>
                        </footer>
                    </article>
                </div>
                <?php endforeach; ?>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-template d-flex justify-content-center">
                    <?php
                    echo LinkPager::widget([
                        'pagination' => $pagination,
                    ]);
                    ?>
                </ul>
            </nav>
        </div>
    </section>
</main>
