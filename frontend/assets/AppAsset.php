<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
     "css/bootstrap.min.css",
    "https://fonts.googleapis.com/css?family=Open+Sans:300,400,700",
    "css/jquery.fancybox.css",
    "css/animsition.min.css",
    "css/style.default.css",
   "css/custom.css",
    "css/fontastic.css",
        "https://use.fontawesome.com/99347ac47f.css",


    ];
    public $js = [
//        "https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js",
        "http://code.jquery.com/jquery-1.9.1.js",
        "https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js",
        "https://oss.maxcdn.com/respond/1.4.2/respond.min.js",
        "js/tether.min.js",
        "js/bootstrap.min.js",
        "js/jquery.cookie.js",
        "js/jquery.fancybox.min.js",
        "js/animsition.min.js",
        "js/front.js",
        "https://use.fontawesome.com/99347ac47f.js"
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',

    ];
}
