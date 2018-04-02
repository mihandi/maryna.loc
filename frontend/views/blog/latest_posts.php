<div class="list-widget blog-popular-widget m-b-60">
    <h4 class="lw-title">ПОПУЛЯРНЫЕ СТАТЬИ</h4>
    <ul class="blog-sm-list v-list">
        <?php foreach ($popular_articles as $article):?>
            <li class="box-blog-sm">
            <a class="box-image" href="<?= '/blog/article?id='.$article['id']?>">
                <img src="<?= '/elfinder/global/article_'.$article['id'].'/'.$article['image']?>" alt="Популярные статьи">
            </a>
            <div class="box-content">
                <h3 class="box-title">
                    <a href="<?= '/blog/article?id='.$article['id']?>"><?= $article['title']?></a>
                </h3>
                <span class="blog-post-time"><?php $article['created_at']?></span>
            </div>
        </li>
        <?php endforeach;?>
    </ul>
</div>