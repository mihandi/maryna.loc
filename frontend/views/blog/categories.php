<div class="widget categories">
    <header>
        <h3 class="h6">Категории</h3>
    </header>
    <?php foreach ($categories as $category):?>
        <div class="item d-flex justify-content-between">
            <a href="<?= '/blog/index?category_id='.$category['id']?>"><?= $category['title']?></a>
            <span><?= $category['count']?></span>
        </div>
    <?php endforeach; ?>
</div>