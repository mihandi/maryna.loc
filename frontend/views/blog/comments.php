<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<div id="comments">
<div class="comment-pane m-b-45">
    <div class="comment-pane-header">
        <h3 class="comment-pane-title"><?= $comments['count']?> Комментариев</h3>
    </div>
    <div class="comment-pane-body">
        <ul class="comment-pane-list">
            <?php if (isset($comments['comments']))foreach ($comments['comments'] as $comment):?>
                <?php
                $user_image_path = Yii::getAlias( '@backend' ).'/web/elfinder/global/users/user_'.$comment['user_id'].'/user_logo.jpg'
                    ?'/elfinder/global/users/user_'.$comment['user_id'].'/user_logo.jpg'
                    :'/images/user.svg';
                ?>
                <li class="list-item has-comment-children">
                <div class="comment-item">

                    <div class="comment-author-avatar">
                        <a href="<?= ''?>">
                            <img src="<?= $user_image_path?>" alt="<?= $comment['login']?>">
                        </a>
                    </div>
                    <div class="comment-text">
                        <p class="comment-paragraph">
                           <?= $comment['text']?>
                        </p>
                        <div class="comment-info">
                            <a href="#"><?= $comment['login']?> &nbsp;</a>
                            <span>-<?= date('Y-m-d', $comment['created_at'])?>&nbsp;</span>
                            <a class="comment-reply" onclick="sample_click(<?= $comment['id']?>)" >
                                <i class="fa fa-share"></i>Ответить
                            </a>

                        </div>
                    </div>
                    <a class="comment-remove" href="" onclick="removeComment(<?=$article['id']?>,<?= $comment['id']?>)">
                        <i class="fa fa-remove"></i>
                    </a>
                </div>
                    <?php foreach ($comment['answers'] as $answer):?>

                    <ul class="comment-pane-list-children">
                    <li class="list-item">
                        <div class="comment-item">
                            <div class="comment-author-avatar">
                                <a href="<?= ''?>">
                                    <img src="<?= $user_image_path?>" alt="<?= $comment['login']?>">
                                </a>
                            </div>
                            <div class="comment-text">
                                <p class="comment-paragraph"><?= $answer['text']?></p>
                                <div class="comment-info">
                                    <a href="<?= ''?>"><?= $answer['login']?> &nbsp;</a>- <?= date('Y-m-d', $answer['created_at'])?> &nbsp;
                                    <a class="comment-reply" onclick="sample_click(<?= $answer['parent_id']?>)" >
                                        <i class="fa fa-share"></i>Ответить за базар
                                    </a>
                                </div>

                            </div>
                            <a class="comment-remove" href="" onclick="removeComment(<?=$article['id']?>,<?= $answer['id']?>)">
                                <i class="fa fa-remove"></i>
                            </a>

                        </div>
                    </li>
                </ul>
                    <?php endforeach; ?>

            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<div class="leave-comment-pane">
    <div class="leave-comment-pane-header">
        <h3 class="leave-comment-pane-title">ОСТАВИТЬ КОММЕНТАРИЙ</h3>
        <p class="leave-comment-pane-notify">You must be logged in to post a comment.</p>
    </div>
    <div class="leave-comment-pane-body">
        <form class="leave-comment-pane-form" method="post" id="leave_comment">
            <div class="form-group input-item">
                <input type="hidden" name="Comment[parent_id]" id="parent_id" value="">
                <input type="hidden" name="Comment[article_id]"  value="<?= $article['id']?>">
                <input type="hidden" name="Comment[user_id]" value="<?= YII::$app->user->id?>">
                <textarea class="au-input au-input-border au-input-radius" name="Comment[text]" id="comment_form" placeholder="Ваш комментарий..."></textarea>
            </div>
            <div class="input-submit">
                <input class="au-btn au-btn-primary au-btn-pill au-btn-shadow" type="submit"  value="Опубликовать">
            </div>
        </form>
    </div>
</div>

<script>
    // A $( document ).ready() block.
    $( document ).ready(function() {
        $( "leave_comment" ).submit(function( event ) {
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
    function sample_click(parent_id) {
      var form =  document.getElementById('comment_form');
        document.getElementById('parent_id').value = parent_id;
      form.focus();
    }

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
</div>