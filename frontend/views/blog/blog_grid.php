<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\widgets\LinkPager;

$this->title = 'Новости';

$articles_image_path = '/elfinder/global/article_';

$articles_path = '/blog/article?id=';

?>


<main class="page-two-col bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <section class="section-blog-wide-list page-col-one">
                    <div class="blog-wide-list p-t-100 p-b-135">
                        <?php if(!$articles):?>
                        <h4 class="lw-title">По вашему запросу ничего не найдено. Попробуйте еще раз.</h4>
                        <?php endif;?>
                        <?php foreach ($articles as $article): ?>
                             <article class="box-blog-wide">
                            <header class="bw-header m-b-30">
                                <h3 class="bw-title">
                                    <a href="<?= $articles_path.$article['id']?>"><?= $article['title']?></a>
                                </h3>
                                <ul class="bw-cates h-list">
                                    <li>
                                        <a href="<?= '/blog/index?category_id='.$article['category_id']?>"><?= $article['category']?></a>
                                    </li>
                                </ul>
                            </header>
                            <figure class="bw-image img-radius img-hv-zoomIn">
                                <a href="<?= $articles_path.$article['id']?>">
                                    <img class="img-fluid" src="<?= $articles_image_path = '/elfinder/global/article_'.$article['id'].'/'.$article['image'] ?>" alt="<?= $article['title']?>">
                                </a>
                            </figure>
                            <div class="bw-body m-b-30">
                                <p class="bw-text"><?= substr($article['description'],0,600)?></p>
                                <a class="read-more" href="<?= $articles_path.$article['id']?>">ПРОДОЛЖИТЬ ЧТЕНИЕ</a>
                            </div>
                            <div class="bw-footer">
                                <ul class="bw-infos h-list">
                                    <li>BY
                                        <a href="#"><?= $article['login']?></a>
                                    </li>
                                    <li><?= date('Y-m-d', $article['created_at'])?></li>
                                    <li>
                                        <?= $article['comment_count']?> Комментариев
                                    </li>
                                </ul>
                            </div>
                        </article>
                        <?php endforeach; ?>

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
            </div>



            <div class="col-lg-3">
                <aside class="page-col-two p-t-100">
                    <?php require_once ('search_bar.php');?>
                    <!-- Widget [Categories Widget]-->
                    <?php require_once ('categories.php');?>
                    <!-- Widget [Latest Posts Widget]        -->
                    <?php require_once ('latest_posts.php');?>

                    <?php require_once ('../views/archive.php');?>

                    <?php require_once ('../views/contacts.php');?>
                </aside>
            </div>
        </div>
    </div>
</main>
