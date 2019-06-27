<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\eoffice_asset\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/web_scb';
    public $css = [
        'css/option/box.css',
        'css/option/custom.css',
        'css/option/layout-datatables.css',
        'css/option/register.css',
        'css/option/scb_login.css',
        'css/option/timeline.css'


    ];
    public $js = [
        'js/app.js',
        'js/add-del-box.js',
        'js/box.js',
        'js/contact.js',
        'js/custom.js',
        'js/datatable.js',
        'js/listname.js',
        'js/scripts.js',
        'js/step',
        'js/sweetalert.min.js',
        'js/zoom.js',
        'js/main.js'



    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];




}
