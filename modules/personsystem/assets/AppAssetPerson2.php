<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/9/2018
 * Time: 12:27 AM
 */

namespace app\modules\personsystem\assets;
use yii\web\AssetBundle;

class AppAssetPerson2 extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/smart_wizard.css',
        'css/smart_wizard_theme_dots.css',
        'css/site.css',
        '//fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext',
        'plugins/bootstrap/css/bootstrap.min.css',
        'css/color_scheme/green.css',
        'css/report.css',
        'css/essentials_edit.css',
        'plugins/datatables/css/dataTables.bootstrap.min.css',
    ];
    public $js = [
        'js/app.js',
        'web_eproject/js/app.js',
        'js/report2.js',
        'https://unpkg.com/sweetalert/dist/sweetalert.min.js',
        'web_personal/js/data_table.js',
        'plugins/datatables/js/jquery.dataTables.min.js',
        'plugins/datatables/js/dataTables.bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}