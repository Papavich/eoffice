<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\correspondence\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */

\Yii::setAlias('@web2', '@web/../modules/correspondence/style');

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web2';
    public $css = [
        //process bar
        'assets/css/register.css',

        //Mail box
        'dist/css/AdminLTE.min.css',
        'dist/css/skins/_all-skins.min.css',
        'plugins/iCheck/flat/blue.css',
        'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        'assets/css/layout-datatables.css',
        'assets/css/register.css',
        //Hover menu
        'assets/css/hover.css',
        //Alert
        'dist/sweetalert.css',
        //Timeline
        'assets/css/timeline.css',
        //Style New
        'edit.css',

        //datetimepicker
        'jquerydatepicker/jquery-ui.css',
        'jquerydatepicker/jquery-ui-timepicker-addon.css',
        //loading
        'js/jquery.loading.css',

        //dataTable
        // '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
        'plugins/dataTable/dataTables.bootstrap.min.css',
        //NProgress
        'nprogress.css'

    ];
    public $js = [

        //'assets/js/app2.js',
        //'assets/plugins/bootstrap/js/bootstrap.min.js',
        //Alert
        'dist/sweetalert.min.js',
        'js/cms-progress.js',
        //'plugins/alert.js',
        'plugins/slimScroll/jquery.slimscroll.min.js',
        'plugins/fastclick/fastclick.js',
        'plugins/iCheck/icheck.min.js',
        'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment.min.js',
        'assets/js/add-del-box.js',
        'dist/js/demo.js',
        //datetimepickerataTables.bootstrap.min.css
        /* 'jquerydatepicker/jquery-1.10.2.min.js',*/
        //datePicker
        'jquerydatepicker/jquery-ui.min.js',
        'jquerydatepicker/jquery-ui-timepicker-addon.js',
        'jquerydatepicker/jquery-ui-sliderAccess.js',
        //loading
        'js/jquery.loading.js',
        //dataTable
        'plugins/dataTable/jquery.dataTables.min.js',
        'plugins/dataTable/dataTables.bootstrap.min.js',
        //NProgress
        'js/nprogress.js',
        //Read more
        'readmore-js/readmore.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
