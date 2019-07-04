

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetDetail */

?>

<div>
    <!-- page title -->
    <header id="page-header">
        <h1>ข้อมูลครุภัณฑ์</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>
            <li><a href="#">รายการครุภัณฑ์</a></li>
            <li class="active">แก้ไขข้อมูลครุภัณฑ์</li>
        </ol>
    </header>
    <!-- /page title -->


    <div id="content" class="padding-20">
        <!--content-->
        <div class="asset-detail-view">
        <h1><?= Html::encode($this->title) ?></h1>
            <?= $this->render('_form2', [
                'modelAsset' => $modelAsset,
                'modelsAssetDetail' =>  $modelsAssetDetail
            ]) ?>

        </div>
        <!--end content-->
    </div>
</div>




