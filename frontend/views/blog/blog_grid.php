<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\widgets\LinkPager;

$this->title = 'Blog';
?>
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-8">
            <div class="container">
                <div class="row">
                    <?php foreach($articles as $article):?>
                    <!-- post -->
                    <div class="post col-xl-6">
                        <div class="post-thumbnail"><a href="/blog/article?id=<?=$article['id']?>" class="animsition-link">
                                <img src="<?= '/uploads/article_'.$article  ['id'].'/'.$article['image']?>" alt="..." class="img-fluid"></a></div>
                        <div class="post-details">
                            <div class="post-meta d-flex justify-content-between">
                                <div class="date meta-last"><?= date('Y-m-d', $article['created_at'])?></div>
                                <div class="comments meta-last"><i class="icon-comment"></i>12</div>
                                <div class="category"><a href="#"><?= $article['category']['title']?></a></div>
                            </div>
                            <a href="/blog/article?id=<?=$article['id']?>" class="animsition-link">
                                <h3 class="h4"><?= $article['title']?></h3></a>
                            <p class="text-muted"><?= substr($article['content'],0,300)."..."?></p>
                        </div>
                    </div>
                    <?php endforeach;?>
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
        </main>
        <aside class="col-lg-4">
            <!-- Widget [Search Bar Widget]-->
            <?php require_once ('search_bar.php');?>
            <!-- Widget [Latest Posts Widget]        -->
            <?php require_once ('latest_posts.php');?>
            <!-- Widget [Categories Widget]-->
            <?php require_once ('categories.php');?>
        </aside>
    </div>
</div>