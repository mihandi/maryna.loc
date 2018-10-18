<main class="page-two-col bg-white">
    <section class="section-blog-md-list p-t-105 p-b-130">
        <div class="container">
            <div class="row">
                <?php foreach ($photos as $photo): ?>

                    <div class="col-lg-2 col-md-3">
                        <article class="box-primary box-blog">
                            <figure class="box-figure">
                                <a href="<?= '/admin/elfinder/global/gallery/'.$gallery['dir_name'].'/'.$photo?>" data-fancybox="gallery" class="image">
                                    <img class="box-image blog-image" src="<?= '/admin/timthumb.php?src=/elfinder/global/gallery/'.$gallery['dir_name'].'/'.$photo.'&w=274&h=275'?>" alt="MOBILE FIRST &amp; RESPONSIVE"  />
                                </a>
                            </figure>
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