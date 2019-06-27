<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\portfolio\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = array(
        'css/site.css',
        '//fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext',
        'plugins/bootstrap/css/bootstrap.min.css',
        'css/essentials.css',
        'css/layout.css',
        'css/color_scheme/green.css',
        'mtstyle.css',
        'plugins/footable/css/footable.standalone.css',
        'plugins/footable/css/footable.core.min.css',
        'css/layout-datatable.css',
    );
    public $js = [
        'js/app.js',
        'js/list.js',
        'jquery.js',
        //'js/ajax-modal-popup.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
