<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Functions;
use common\models\Gallery;
use yii\web\Controller;

class GalleryController extends Controller
{
    public function actionIndex(){
        $categories = Category::find()->all();

        $galleries = Gallery::getGalleries();
        shuffle($galleries);


        return $this->render('index',
            ['galleries' => $galleries,
            'categories' => $categories]);
    }
    
    public function actionSingle(){
        $gallery_id = (int)$_GET['gallery_id'];

//        $this->layout = 'test.php';
        $gallery = Gallery::findOne($gallery_id);
        $photos = Gallery::getImages($gallery->dir_name);

        return $this->render('single',['photos' => $photos,
        'gallery' => $gallery]);
    }
}