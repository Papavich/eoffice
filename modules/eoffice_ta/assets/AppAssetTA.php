<?php

/**
 * Created by PhpStorm.
 * User: Pink
 * Date: 7/19/2017
 * Time: 10:14 PM
 */

namespace app\modules\eoffice_ta\assets;
use yii\web\AssetBundle;

class AppAssetTA extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        //'assets/plugins/bootstrap/css/bootstrap.css',

        '//fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700',
        'assets/css/essentials.css',
        'assets/css/layout.css',

        'assets/css/color_scheme/green.css',
       // 'assets/plugins/slider.revolution/css/extralayers.css',
        'assets/plugins/slider.revolution/css/settings.css',
        'assets/plugins/bootstrap/css/bootstrap.min.css',

    ];
    public $js = [
        'assets/plugins/jquery/jquery-2.1.4.min.js',
        'assets/js/app.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
