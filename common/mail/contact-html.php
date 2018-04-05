<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<div class="password-reset">
    <p><?= Html::encode($model['name']) ?>,</p>

    <h4><?= $model['email']?> Пишет: </h4>

    <p><?= $model['body']?></p>

</div>
