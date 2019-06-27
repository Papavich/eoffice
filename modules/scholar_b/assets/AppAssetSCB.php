<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\scholar_b\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAssetSCB extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/web_scb';
    public $css = [
        'css/option/box.css',
        'css/option/layout-datatables.css',
        'css/option/register.css',
        'css/option/scb_login.css',

        'css/boxslide.css',
        'css/custom.css',
        'css/pdf.css',
        'css/stepbyscb.css',
        'css/stepbystep',
        'css/timeline.css',

        '../plugins/fullcalendar/fullcalendar.css',

        '../plugins/dataTable/dataTables.bootstrap.min.css',
        //'plugins/dataTable/dataTables.bootstrap.min.css',
        '../assets/css/layout-datatables.css',



    ];
    public $js = [
        'js/add-del-box.js',
        'js/app.js',
        'js/box.js',
        'js/contact.js',
        'js/custom.js',
        'js/datatable.js',
        'js/find-student-funded.js',
        'js/full_calendar',
        'js/list-status',
        'js/listname.js',
        'js/main',
        'js/score',
        'js/step',
        'js/step_scb',
        'js/stepbystep',
        'js/tabmenu',
        'js/scripts.js',
        'js/zoom.js',
        'js/sweetalert.min.js',

//        //dataTable
//        'plugins/dataTable/jquery.dataTables.min.js',
//        'plugins/dataTable/dataTables.bootstrap.min.js',
        '../assets/plugins/jquery/jquery-2.1.4.min.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
