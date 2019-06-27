<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\eoffice_eolmv2\assets;

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
        'css/site.css',
        '//fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext',
        'plugins/bootstrap/css/bootstrap.min.css',
        'css/essentials.css',
        'css/layout.css',
        'css/color_scheme/green.css',

    ];
    public $js = [
        '../modules/eoffice_eolmv2/assets/script-toggle.js',
        'js/app.js',
        'js/list.js',
        'web_eproject/js/autoTag.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',

    ];
}

