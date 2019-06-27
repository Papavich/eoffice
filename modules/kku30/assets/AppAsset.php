<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\kku30\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */

\Yii::$app->getModule('kku30')->basePath;
\Yii::setAlias('@web2','@web/web_kku30');
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/web_kku30';
    public $css = [
    'css/print.css',
    ];
    public $js = [
        'js/createtable.js',
        'js/timetable.js',
        'js/teachtable.js',
        'js/roomtable.js',
        'js/comparetable.js',
        'js/addsubject.js',
        'js/_formprintbutton.js',
        'js/jspdf.min.js',
        'js/html2canvas.js',



    ];
    public $depends = [

    ];
}
