<?php

/* @var $this yii\web\View */


$this->title = 'Личный кабинет';

$user_image = Yii::getAlias( '@backend' ).'/web/elfinder/users/user_'.yii::$app->user->id.'/user_logo.jpg'
    ?'/admin/elfinder/users/user_'.yii::$app->user->id.'/user_logo.jpg'
    :'/admin/elfinder/global/no-img.jpg';

?>
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-4">
            <div class="row" id="user-logo">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-center" id="user">
                                <img src="<?= $user_image ?>" style="width: 250px; height: 250px" id="img">
                                <div>
                                    <form id="ajax_form" enctype="multipart/form-data" method="post">
                                        <p>
                                            <input type="file" name="User[photo]" id="ajax_input">
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" id="submit"  class="btn btn-default btn-sm">Сохранить</button>
                                            </div>
                                        </div>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <main class="posts-listing col-lg-4">
            <div class="container">
                <div class="row">
                    <div class="form">
                          <form class="form-horizontal"  action="/site/personal" method="POST">
                              <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken()?>">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
                                            <div class="col-sm-8">
                                                <input type="hidden"  name="User[id]" value="<?= (int)$user['id']?>">
                                                <input type="text" class="form-control" placeholder="Логин" name="User[login]" value="<?=$user['login']?>">
                                                <?php if(isset($user->errors['login'])):?>
                                                    <?php err($user->errors['login']); ?>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" placeholder="Email" name="User[email]" value="<?=$user['email']??''?>">
                                                <?php if(isset($user->errors['email'])):?>
                                                    <?php err($user->errors['email']); ?>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label">Имя</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" placeholder="Имя" name="User[first_name]" value="<?=$user['first_name']??''?>">
                                                <?php if(isset($user->errors['first_name'])):?>
                                                    <?php err($user->errors['first_name']); ?>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label">Фамилия</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" placeholder="Фамилия" name="User[last_name]" value="<?=$user['last_name']??''?>">
                                                <?php if(isset($user->errors['last_name'])):?>
                                                    <?php err($user->errors['last_name']); ?>
                                                <?php endif;?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-default btn-sm">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                      </div><!-- form  -->
                </div>
            </div>
        </main>
        <aside class="col-lg-4">
            <?php require_once ('../views/blog/search_bar.php');?>
            <!-- Widget [Categories Widget]-->
            <?php require_once ('../views/blog/categories.php');?>
            <!-- Widget [Latest Posts Widget]        -->
            <?php require_once ('../views/blog/latest_posts.php');?>

            <?php require_once ('../views/archive.php');?>

            <?php require_once ('../views/contacts.php');?>
        </aside>
    </div>
</div>

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script>

    // A $( document ).ready() block.post-comments
    $( document ).ready(function() {
        $( '#ajax_form' ).submit(function( event ) {
            var file_data = $('#ajax_input').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);

            event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: '/site/personal',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(html){
                    $('#user-image').html(html);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object
        console.log(files);

        for (var i = 0, f; f = files[i]; i++) {

            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                    document.getElementById('img').src =  e.target.result;

                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
        // document.getElementById('img').src = 'asd';

    }

    document.getElementById('user').addEventListener('change', handleFileSelect, false);
</script>





