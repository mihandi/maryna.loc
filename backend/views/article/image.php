<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */

use budyaga\cropper\Widget;
//$route = '/article/uploadPhoto?id='.$article_id;
//var_dump($route);die();
$route = '/article/upload-photo?id='.$article_id;

?>


<?php $form = ActiveForm::begin(); ?>
<?php echo $form->field($model, 'image')->widget(Widget::className(), [
    'uploadUrl' => Url::toRoute($route),
    'width' => 400,
    'height'=> 200
]) ?>
<?php ActiveForm::end(); ?>