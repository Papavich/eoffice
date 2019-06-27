<?php
namespace app\modules\requestform\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    //WEB FONTS : use %7C instead of | (pipe)
    '//fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700',

    //CORE CSS -->
    'assets/plugins/bootstrap/css/bootstrap.min.css',

    //THEME CSS
    'assets/css/essentials.css',
    'assets/css/layout.css',

    //PAGE LEVEL SCRIPTS
    //'assets/css/header-1.css',
    'assets/css/color_scheme/green.css',


    //REVOLUTION SLIDER
    //'assets/plugins/slider.revolution/css/extralayers.css',
    //'assets/plugins/slider.revolution/css/settings.css',

    //AGE LEVEL STYLES
    'assets/css/layout-datatables.css',

    //MY CSS
    //'assets/css/my-style.css',
    ];
    public $js = [
        'assets/plugins/jquery/jquery-2.1.4.min.js',
        'assets/plugins/custom.fle_upload.js',
        'assets/plugins/dynamic-form.js',
        'assets/js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
