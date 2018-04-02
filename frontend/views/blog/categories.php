<div class="list-widget cates-widget m-b-60">
    <h4 class="lw-title">КАТЕГОРИИ</h4>
    <ul class="lw-list v-list">
        <?php foreach ($categories as $category):?>
            <li>
                <a href="<?= '/blog/index?category_id='.$category['id']?>"><?= $category['title']?></a>
            </li>
        <?php endforeach; ?>

    </ul>
</div>
