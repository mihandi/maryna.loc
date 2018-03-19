<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<?php
use yii\widgets\LinkPager;
?>
<div id="comments">
    <div class="post-comments">
        <header>
            <h3 class="h6">Post Comments<span class="no-of-comments"><?= $comments['count']?></span></h3>
        </header>
        <?php foreach ($comments['comments'] as $comment):?>
            <div class="comment">
                <div class="comment-header d-flex justify-content-between">
                    <div class="user d-flex align-items-center">
                        <div class="image"><img src="/img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="title"><strong><?= $comment['login']?></strong><span class="date"><?= date('Y-m-d',$comment['created_at']);?></span></div>
                    </div>
                    <?php if ($comment['user_id'] == YII::$app->user->id):?>
                        <div class="reply">
                            <a class="comment-reply-link" href="" onclick="removeComment(<?=$article['id']?>,<?= $comment['id']?>)">x</a>
                        </div>
                    <?php endif;?>
<!--                    <div class="reply">-->
<!--                        <a class="comment-reply-link" >Reply</a>-->
<!--                    </div>-->
                </div>
                <div class="comment-body">
                    <p><?= $comment['text']?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-template d-flex justify-content-center">
            <?php
            echo LinkPager::widget([
                'pagination' => $comments['pagination'],
            ]);
            ?>
        </ul>
    </nav>

    <div class="add-comment">
        <header>
            <h3 class="h6">Leave a reply</h3>
        </header>
        <form  class="commenting-form" method="post">
            <div class="row">
                <div class="form-group col-md-12">
                    <input type="hidden" name="Comment[user_id]" value="<?= YII::$app->user->id?>">
                    <input type="hidden" name="Comment[article_id]" value="<?= $article['id']?>">
                    <input id="comment" name="Comment[text]" placeholder="Type your comment" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <?php if(!yii::$app->user->isGuest):?>
                     <button name="submit" type="submit" id="submit" class="submit">Опубликовать</button>
                    <?php else:?>
                    <p class="alert">Для того чтобы оставить комментарий войдите или зарегистрируйтесь</p>
                    <?php endif;?>
                </div>
            </div>
        </form>
    </div>
</div>
<script>

    // A $( document ).ready() block.post-comments
    $( document ).ready(function() {
        $( "form" ).submit(function( event ) {
            event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: '/blog/article?id=<?= $article['id']?>',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(html){
                    $('#comments').html(html);
                }
            });
        });
    });
</script>

<script>
    function removeComment(article_id,comment_id) {
        event.preventDefault();
        $.ajax({
            type: 'post',
            url: '/blog/article?id='+article_id+'&comment='+comment_id,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(html){
                $('#comments').html(html);
            }
        });
    }
</script>

<!--<script>-->
<!--    var anchors = document.getElementsByClassName('comment-reply-link');-->
<!--    for(var i = 0; i < anchors.length; i++) {-->
<!--        var anchor = anchors[i];-->
<!--        anchor.onclick = function() {-->
<!--            document.getElementById('parent_id').value = this.id;-->
<!--        }-->
<!--    }-->
<!--</script>-->