<div class="widget latest-posts">
    <header>
        <h3 class="h6">Последние статьи</h3>
    </header>
    <div class="blog-posts">
        <?php foreach ($recent as $latest):?>
            <a href="<?= '/blog/article?id='.$latest['id']?>">
                <div class="item d-flex align-items-center">
                    <div class="image"><img src="<?= '/elfinder/global/article_'.$latest['id'].'/'.$latest['image']?>" alt="..." class="img-fluid"></div>
                    <div class="title"><strong><?= $latest['title']?></strong>
                        <div class="d-flex align-items-center">
                            <div class="views"><i class="icon-eye"></i><?= (int)$latest['viewed']?></div>
                            <div class="comments"><i class="icon-comment"></i><?= $latest['count']?></div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>

    </div>
</div>