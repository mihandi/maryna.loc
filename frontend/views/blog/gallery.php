<?php $i=0; /*?>
    <div class="mix col-lg-3 col-md-3 col-sm-5">
        <?php foreach($gallery as $photo): ++$i;?>
                <?php if ($i < 5): ?>
                    <div class="item">
                        <a href="<?= '/elfinder/global/article_'.$article['id'].'/'.$photo?>" data-fancybox="gallery" class="image">
                            <img src="<?= '/elfinder/global/article_'.$article['id'].'/'.$photo?>" alt="..." class="img-fluid">
                        </a>
                    </div>
                <?php else: ?>
                    <a href="<?= '/elfinder/global/article_'.$article['id'].'/'.$photo?>" data-fancybox="gallery" class="image"></a>
                <?php endif;?>
        <?php endforeach; ?>
    </div>
 */?>


<section class="gallery no-padding">
    <div class="row">
        <?php if(isset($gallery) && !empty($gallery)) :?>
            <?php foreach($gallery as $photo): ++$i;?>
                <?php if ($i < 5): ?>
                    <div class="mix col-lg-3 col-md-3 col-sm-5">
                        <div class="item">
                            <a href="<?= '/elfinder/global/article_'.$article['id'].'/'.$photo?>" data-fancybox="gallery" class="image">
                                <img src="<?= '/elfinder/global/article_'.$article['id'].'/'.$photo?>" alt="..." class="img-fluid">

                                <div class="overlay d-flex align-items-center justify-content-center">
                                    <i class="icon-search"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endif;?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
