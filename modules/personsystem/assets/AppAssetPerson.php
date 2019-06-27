<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\personsystem\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAssetPerson extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/smart_wizard.css',
        'css/smart_wizard_theme_dots.css',
        'css/site.css',
        '//fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext',
        'plugins/bootstrap/css/bootstrap.min.css',
        'css/essentials.css',
        'css/layout.css',
        'css/color_scheme/green.css',
        'css/report.css',
        'plugins/fullcalendar/fullcalendar.css',

    ];
    public $js = [
        'web_eproject/js/app.js',
        'https://unpkg.com/sweetalert/dist/sweetalert.min.js',
        'js/jquery.smartWizard.min.js',
       // 'js/yii_overrides.js',
        'js/Chart.min.js',
        'js/app.js',
        'js/list.js',
        'js/report.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
