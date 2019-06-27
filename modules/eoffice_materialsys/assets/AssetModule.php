<?php

namespace app\modules\eoffice_materialsys\assets;

use yii\web\AssetBundle;

\Yii::setAlias('@path_assetmodule','@web/../modules/eoffice_materialsys/assets');

class AssetModule extends AssetBundle
{
    public $baseUrl = '@path_assetmodule';
    public $css = [
        'css\edit-theme.css',
        'css\font-awesome.min.css'
    ];
    public $js = [
        'main-modules.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}