<?php

namespace app\modules\pms\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
\Yii::$app->getModule('pms')->basePath;
\Yii::setAlias('@web2','@web/../modules/pms');
class AppAsset extends AssetBundle
{
    //วิธีเปลี่ยนพาทเรียก assets
    //../modules/pms

    public $basePath = '@webroot';
    public $baseUrl = '@web/web_pms';
    public $css = [
        //'js/calendar/fullcalendar.min.css',
        //'js/calendar/fullcalendar.print.min.css',
        'css/popupSucces.css',
        'plugins/dataTable/dataTables.bootstrap.min.css',
        //'plugins/fullcalendar/fullcalendar.css',
        //datetimepicker
        'plugins/datepicker/datepicker3.css',
        'fonts/thsarabunnew.css',


    ];
    public $js = [
        'js/myJqueryAddPro.js',
        'js/myJqueryAddProSummary.js',
        'js/myjQuery.js',
//        'js/test.js',
        'js/select_data.js',
        //'js/find_report.js',
        //'js/calendar/lib/moment.min.js',
        //'js/calendar/fullcalendar.min.js',
        'js/myjqueryValidProCode.js',
        'js/myjqueryAddFormPro.js',
        'js/sweetalert.min.js',
        'js/popupSuccess.js',
        'js/addInput/addel.jquery.js',
       // 'js/jQuery-Word-Export-master/jquery.wordexport.js',
        'js/word/FileSaver.js',
        'js/word/jquery.wordexport.js',
        'js/data_table.js',
        'js/dynamicForm.js',
        'js/table_status.js',
        'plugins/dataTable/jquery.dataTables.min.js',
        'plugins/dataTable/dataTables.bootstrap.min.js',
        'js/rule.js',


    ];
    public $depends = [
    ];
}
