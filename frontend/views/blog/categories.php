<div class="widget categories">
    <header>
        <h3 class="h6">Categories</h3>
    </header>
    <?php foreach ($categories as $category):?>
        <div class="item d-flex justify-content-between">
            <a href="#"><?= $category['title']?></a>
            <span><?= $category['count']?></span>
        </div>
    <?php endforeach; ?>
</div>