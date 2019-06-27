<?php

namespace app\modules\eoffice_materialsys\assets;

use yii\web\AssetBundle;


class AssetStepWizard extends AssetBundle
{
    public $baseUrl = '@mat_component';
    public $css = [
        'smartwizard-master/css/smart_wizard_theme_circles.css',
    ];
    public $js = [
        'smartwizard-master/js/jquery.smartWizard.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}