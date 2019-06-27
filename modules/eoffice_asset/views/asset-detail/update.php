<?php

use yii\helpers\Html;
use app\modules\eoffice_asset\assets\AppAssetAsset;
AppAssetAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetDetail */


$this->params['breadcrumbs'][] = ['label' => 'Asset Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->asset_detail_id, 'url' => ['view', 'id' => $model->asset_detail_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div>
    <!-- page title -->
    <header id="page-header">
        <h1>ข้อมูลครุภัณฑ์</h1>
        <ol class="breadcrumb">
            <li><a href="#">รายการครุภัณฑ์</a></li>
            <li><a href="#">ข้อมูลครุภัณฑ์</a></li>
            <li class="active">แก้ไขข้อมูลครุภัณฑ์</li>
        </ol>
    </header>
    <div id="content" class="padding-20">
        <!--content-->
        <div class="asset-detail-view">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
        <!--end content-->
    </div>
</div>


