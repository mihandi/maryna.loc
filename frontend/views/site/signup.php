<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */


$this->title = 'Регистрация';

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
            <form class="form-horizontal"  action="/site/signup" method="POST">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken()?>">
                <div class="form-group">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Логин" name="SignupForm[login]" value="<?= $model['login']??''?>">
                            <?php if(isset($model->errors['login'])):?>
                                <?php err($model->errors['login']); ?>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" placeholder="Email" name="SignupForm[email]" value="<?= $model['email']??''?>">
                            <?php if(isset($model->errors['email'])):?>
                                <?php err($model->errors['email']); ?>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" placeholder="Пароль" name="SignupForm[password]">
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