<?php

/* @var $this yii\web\View */

use common\models\Category;
use yii\grid\GridView;
use yii\widgets\LinkPager;

$this->title = $article['title'];

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Громадська організація «Необмеженi можливостi». Харкiв'
]);

$article_image_path = '/elfinder/global/article_'.$article['id'].'/'.$article['image'];

$articles_path = '/blog/article?id=';
$user_path = '';
$category_path =  Category::getLink($article['category_id'],$article['seo_url']);

?>
<!-- main content-->
<main class="page-two-col bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="page-col-one p-t-35 p-b-60">
                    <article class="post-blog m-b-55">
                        <header class="post-header m-b-125">
                            <ul class="post-bre h-list">
                                <li>
                                    <a href="/">Головна</a>
                                </li>
                                <li>
                                    <a href="/blog/index">Статті</a>
                                </li>
                                <li>
                                    <a href="<?= $articles_path.$article['id']?>"><?= $article['title']?></a>
                                </li>
                            </ul>
                            <h3 class="post-title"><?= $article['title']?></h3>
                        </header>
                        <figure class="post-image img-radius m-b-45">
                            <img class="img-fluid" src="<?= $article_image_path?>" alt="<?= $article['title']?>">
                        </figure>
                        <div class="post-body">
                            <h3 class="post-title"><?= $article['title']?></h3>
                            <ul class="post-info h-list">
                                <li class="post-info-item">by
                                    <a href="<?= $user_path?>"><?= $article['login']?></a>
                                </li>
                                <li class="post-info-item"><?= date('Y-m-d', $article['created_at'])?></li>
                                <li class="post-info-item">
                                    <a href="<?= $category_path?>"><?= $article['category']?></a>
                                </li>
                                <li class="post-info-item">
                                        <span>
                                            <a href="#"><?= $article['comment_count']?> Коментарів</a>
                                        </span>
                                </li>
                            </ul>
                            <p class="post-paragraph">
                               <?= $article['content']?>
                            </p>
                            <?php require_once ('gallery.php');?>

                        </div>
                        <footer class="post-footer">
                            <div class="flex-bar d-md-flex align-items-start justify-content-lg-between m-b-40">
                                <ul class="post-tags h-list">
                                    <li class="post-tag-item">
                                        <a href="#">website</a>
                                    </li>
                                    <li class="post-tag-item">
                                        <a href="#">onepage</a>
                                    </li>
                                    <li class="post-tag-item">
                                        <a href="#">profesional</a>
                                    </li>
                                </ul>
                                <div class="post-socials">
                                    <span class="post-social-label">Поділитися</span>
                                    <ul class="h-list social-list">
                                        <li class="list-item" data-toggle="tooltip" title="Facebook">
                                            <a class="fa fa-facebook" href="#"></a>
                                        </li>
                                        <li class="list-item" data-toggle="tooltip" title="Twitter">
                                            <a class="fa fa-twitter" href="#"></a>
                                        </li>
                                        <li class="list-item" data-toggle="tooltip" title="Google Plus">
                                            <a class="fa fa-google-plus" href="#"></a>
                                        </li>
                                        <li class="list-item" data-toggle="tooltip" title="Linkedin">
                                            <a class="fa fa-linkedin" href="#"></a>
                                        </li>
                                        <li class="list-item" data-toggle="tooltip" title="Other">
                                            <a class="fa fa-plus" href="#"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </footer>
                    </article>
                    <?php require_once ('comments.php');?>
                </div>
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
<!-- end main content-->




<div id="up-to-top">
    <i class="fa fa-angle-up"></i>
</div>
