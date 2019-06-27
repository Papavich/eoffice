<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 21/7/2560
 * Time: 11:16
 */

namespace app\assets;
use yii\web\AssetBundle;

\Yii::$app->getModule('personsystem')->basePath;
\Yii::setAlias('@web2','@web/../modules/personsystem/assets');
class AppAsset2 extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext',
        'plugins/bootstrap/css/bootstrap.min.css',
        'css/essentials.css',
        'css/layout.css',
        'css/color_scheme/green.css',
        'css/report.css',
        'plugins/fullcalendar/fullcalendar.css',
    ];
    public $js = [
        'js/app.js',
        'js/list.js',
      //  'jquery-2.1.4.min',
    ];
    public $depends = [

    ];
}