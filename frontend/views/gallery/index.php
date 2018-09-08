<?php
use common\models\Gallery;
use yii\widgets\LinkPager;
?>
<main class="page-two-col bg-white">
    <section class="section-blog-md-list p-t-105 p-b-130">
        <div class="container">
            <div class="row">
                <?php foreach ($galleries as $gallery): ?>

                <div class="col-lg-3 col-md-4">
                    <article class="box-primary box-blog">
                        <figure class="box-figure">
                            <a href="<?= Gallery::getLink($gallery['id'],$gallery['seo_url'])?>">
                                <img class="box-image blog-image" src="<?= Gallery::getMainImage($gallery['dir_name']);?>" alt="MOBILE FIRST &amp; RESPONSIVE" />
                            </a>
                        </figure>
                        <header class="box-header">
                            <h3 class="box-title blog-title">
                                <a href="<?= Gallery::getLink($gallery['id'],$gallery['seo_url'])?>"><?= $gallery['title'] ?></a>
                            </h3>
                        </header>

                    </article>
                </div>

                <?php endforeach;?>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-template d-flex justify-content-center">
                    <?php

//                    echo LinkPager::widget([
//                        'pagination' => $pagination,
//                    ]);
                    ?>
                </ul>
            </nav>
        </div>
    </section>
</main>