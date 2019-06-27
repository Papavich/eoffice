<?php

namespace app\modules\eoffice_materialsys\assets;

use yii\web\AssetBundle;

class AssetTheme extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //FONT GOORLE,
        '//fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700',

        //CORE CSS,
        'plugins/bootstrap/css/bootstrap.css',

        //THEME CSS,
        'css/essentials.css',
        'css/layout.css',

    ];
    public $js = [

        //DROP ZONE
//        'assets/js/dropzone.js',

        //JAVASCRIPT FILES,
//        'plugins/jquery/jquery-2.1.4.min.js',
        'js/app.js',

        //MY JAVASCRIPT
        //'js/my-js.js',

        //BOOTSTRAP
//        'assets/plugins/bootstrap/js/bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}