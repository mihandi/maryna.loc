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

        foreach ($categories as $category){
            $galleries[] = Gallery::getGalleryByCategory($category);
        }

        return $this->render('index',
            ['category_galleries' => $galleries,
            'categories' => $categories]);
    }
}