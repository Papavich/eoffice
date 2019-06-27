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
    public $baseUrl = '@web2';
    public $css = [
//        'js/calendar/fullcalendar.min.css',
//        'js/calendar/fullcalendar.print.min.css',
    ];
    public $js = [
        'js/myJqueryAddPro.js',
        'js/myJqueryAddProSummary.js',
        'js/myjQuery.js',
        'js/nextpage.js',
        'js/test.js',
//        'js/calendar/lib/moment.min.js',
//        'js/calendar/lib/jquery.min.js',
//        'js/calendar/fullcalendar.min.js',


    ];
    public $depends = [
    ];
}
