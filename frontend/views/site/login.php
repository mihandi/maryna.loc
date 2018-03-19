<?php


$this->title = 'Вход';
function err($errors)
{
    foreach ($errors as $error){
        echo "<div class=\"help-block help-block-error \"> $error </div>";
    }
}
?>
<div class="row">
    <main class="posts-listing col-lg-8">
        <div class="form">
            <form class="form-horizontal"  action="/site/login" method="POST">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken()?>">
                <div class="form-group">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Логин" name="LoginForm[login]" value="<?=$model['login']??''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" placeholder="Пароль" name="LoginForm[password]">
                            <?php if(isset($model->errors['password'])):?>
                                <?php err($model->errors['password']); ?>
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default btn-sm">Войти</button>
                        </div>
                    </div>
            </form>
        </div><!-- form  -->
    </main>
    <aside class="col-lg-4">
        <!-- Widget [Search Bar Widget]-->
        <?php require_once ('../views/blog/search_bar.php');?>
        <!-- Widget [Latest Posts Widget]        -->
        <?php require_once ('../views/blog/latest_posts.php');?>
        <!-- Widget [Categories Widget]-->
        <?php require_once ('../views/blog/categories.php');?>
    </aside>
</div>