<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\eoffice_asset\assets\AppAssetAsset;
use app\modules\eoffice_asset\models\EofficeCentralViewPisRoom;
AppAssetAsset::register($this);

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
            <li><a href="#">รายการครุภัณฑ์</a></li>
            <li class="active">ข้อมูลครุภัณฑ์</li>
        </ol>
    </header>
    <!-- /page title -->


    <div id="content" class="padding-20">

        <div class="asset-detail-view">

            <div id="panel-misc-portlet-color-r2" class="panel panel-info">
                <div class="panel-heading">
                    <strong><span>ข้อมูลครุภัณฑ์</span></strong>
                </div>
                <div class="panel-body">
                    <div class="panel-body">

                        <table id="user" class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <td width="20%">รหัสประเภทครุภัณฑ์ภาควิชา</td>
                                <td width="80%"><?php  echo  $model['asset_dept_code_start']; ?></td>
                            </tr>
                            <tr>
                                <td width="20%">รหัสครุภัณฑ์มหาวิทยาลัย</td>
                                <td width="65%"><?php  echo  $model['asset_univ_code_start']; ?></td>
                            </tr>
                            <tr>
                                <td width="35%">ชื่อรายการครุภัณฑ์</td>
                                <td width="65%"><?php  echo  $model['asset_detail_name']; ?></td>
                            </tr>
                            <tr>
                                <td width="20%">ประเภทครุภัณฑ์ (ภาควิชา)</td>
                                <td width="65%"><?php  echo   \app\modules\eoffice_asset\models\AssetTypeDepartment::findOne($model['asset_dept_type'])->asset_type_dept_name;  ?></td>
                            </tr>
                            <tr>
                                <td width="20%">ประเภทครุภัณฑ์ (มหาวิทยาลัย)</td>
                                <td width="65%"><?php  echo    \app\modules\eoffice_asset\models\AssetTypeUniversity::findOne($model['asset_univ_type'])->asset_type_univ_name; ?></td>
                            </tr>
                            <tr>
                                <td width="20%">ยี่ห้อ/ลักษณะ</td>
                                <td width="65%"><?php  echo  $model['asset_detail_brand']; ?></td>
                            </tr>
                            <tr>
                                <td width="20%">อายุการใช้งาน(ปี)</td>
                                <td width="65%"><?php  echo  $model['asset_detail_age']; ?></td>
                            </tr>
                            <tr>
                                <td width="20%">ราคาต่อหน่วย</td>
                                <td width="65%"><?php  echo  $model['asset_detail_price']; ?></td>
                            </tr>
                            <tr>
                                <td width="20%">ระยะประกัน (ปี)</td>
                                <td width="65%"><?php  echo  $model['asset_detail_insurance']; ?></td>
                            </tr>
                            <tr>
                                <td width="20%">อาคาร</td>
                                <td width="65%"><?php echo \app\modules\eoffice_asset\models\EofficeCentralViewPisRoom::findOne($model['asset_detail_building'])->buildings_id; ?></td>
                            </tr>
                         <tr>
                                <td width="20%">ห้อง</td>
                                <td width="65%"><?php echo \app\modules\eoffice_asset\models\EofficeCentralViewPisRoom::findOne($model['asset_detail_room'])->rooms_name; ?></td>
                            </tr>
                            </tbody>
                        </table>
                        <p>
                            <?= Html::a('แก้ไขครุภัณฑ์', ['update', 'id' => $model->asset_detail_id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Create QR Code', ['../eoffice_asset/barcode/', 'asset_detail_id' => $model->asset_detail_id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('ลบรายการ', ['delete', 'id' => $model->asset_detail_id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'get',
                                ],
                            ]) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>