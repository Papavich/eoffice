<?php

use yii\helpers\Html;
use yii\base\Model;
use app\modules\eoffice_asset\models\Asset;
use app\modules\eoffice_asset\models\AssetDetail;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetDetail */


$this->params['breadcrumbs'][] = ['label' => 'Asset Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <!-- page title -->
    <header id="page-header">
        <h1>ข้อมูลครุภัณฑ์</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>
            <li><a href="#">รายการครุภัณฑ์</a></li>
            <li class="active">นำเข้าครุภัณฑ์</li>
        </ol>
    </header>
    <!-- /page title -->


    <div id="content" class="padding-20">
        <!--content-->
        <div class="asset-detail-view">
            <?= $this->render('_form', [
                'modelAsset' => $modelAsset,
                'modelsAssetDetail' => $modelsAssetDetail
            ]) ?>

        </div>
        <!--end content-->
    </div>
</div>
