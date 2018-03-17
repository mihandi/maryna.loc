
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="post blog-post col-lg-8">
            <div class="container">
                <div class="post-single">
                    <div class="post-thumbnail">
                        <img src="<?= '/uploads/article_'.$article['id'].'/'.$article['image']?>" alt="..." class="img-fluid"></div>
                    <div class="post-details">
                        <div class="post-meta d-flex justify-content-between">
                            <div class="category">
                                <a href="<?php //Todo?>"><?=$article['category']['title']?></a>
                            </div>
                        </div>
                        <h1><?= $article['title']?><a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
                        <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="#" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar"><img src="/img/avatar-1.jpg" alt="..." class="img-fluid"></div>
                                <div class="title"><span><?= $author['login'];?></span></div></a>
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="date"><i class="icon-clock"></i><?= date('Y-m-d', $article['created_at'])?></div>
                                <div class="views"><i class="icon-eye"></i><?= (int)$article['viewed']?></div>
                                <div class="comments meta-last"><i class="icon-comment"></i><?= $comments['count']?></div>
                            </div>
                        </div>
                        <div class="post-body">
                            <p><?= $article['content']?></p>
                        </div>
<!--                        <div class="post-tags"><a href="#" class="tag">#Business</a><a href="#" class="tag">#Tricks</a><a href="#" class="tag">#Financial</a><a href="#" class="tag">#Economy</a></div>-->
                        <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row">
                                <a href="<?= $nextprev['prev']['id']?'/blog/article?id='.$nextprev['prev']['id']:''?>" class="prev-post text-left d-flex align-items-center">
                                    <div class="icon prev"><i class="fa fa-angle-left"></i></div>
                                    <div class="text"><strong class="text-primary">Previous Post </strong>
                                        <h6><?= $nextprev['prev']['title']?></h6>
                                    </div>
                                </a>

                                <a href="<?= $nextprev['next']['id']?'/blog/article?id='.$nextprev['next']['id']:''?>" class="next-post text-right d-flex align-items-center justify-content-end">
                                    <div class="text"><strong class="text-primary">Next Post </strong>
                                        <h6><?= $nextprev['next']['title']?></h6>
                                    </div>
                                    <div class="icon next"><i class="fa fa-angle-right"></i></div>
                                </a>
                        </div>

                        <?php require_once ('comments.php');?>
                    </div>
                </div>
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

<script>

</script>
