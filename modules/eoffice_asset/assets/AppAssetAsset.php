<?php



namespace app\modules\eoffice_asset\assets;
use yii\web\AssetBundle;

class AppAssetAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        '/fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext',
        'plugins/bootstrap/css/bootstrap.min.css',
        'css/essentials.css',
        'css/layout.css',
        'css/color_scheme/green.css',
        'mtstyle.css',
        'plugins/footable/css/footable.core.min.css',
        'plugins/footable/css/footable.standalone.css'

    ];
    public $js = [
        'js/app.js',
        'js/list.js',
        'js/main.js',
        'footable/dist/footable.min.js',
        'footable/dist/footable.sort.min.js',
        'footable/dist/footable.paginate.min.js'

    ];
    public $depends = [

        'yii\bootstrap\BootstrapAsset',
        //'yii\web\YiiAsset',
        'yii\web\YiiAsset',
    ];
}
