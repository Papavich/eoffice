<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


use app\modules\eoffice_asset\assets\AppAssetAsset;
AppAssetAsset::register($this);
use app\modules\eoffice_asset\models;
use app\modules\eoffice_asset\models\AssetDetail;
use  app\modules\eoffice_asset\models\Asset;
use  app\modules\eoffice_asset\models\AssetGet;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\Asset */


/*$this->params['breadcrumbs'][] = ['label' => 'Assets', 'url' => ['index']]; **/
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
        <!--content-->
        <div class="asset-detail-view">

            <div id="panel-misc-portlet-color-l1" class="panel panel-default">
                <div class="panel-heading">
		<span class="elipsis"><!-- panel title -->
			<strong>รายละเอียดรายการครุภัณฑ์</strong>
		</span>

                    <!-- /right options -->
                </div>

                <!-- ปุ่ม -->
                <div class="panel-body">

                    <p>
                        <?= Html::a('แก้ไข', ['asset/update', 'id' => $modelAsset->asset_id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('พิมพ์QR Code', ['asset/qrcode', 'id' => $modelAsset->asset_id], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('ลบกลุ่มครุภัณฑ์', ['delete', 'id' => $modelAsset->asset_id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>

                    <!--asset-->
                    <div id="panel-misc-portlet-color-r2" class="panel panel-info">
                        <div class="panel-heading">
                        <span class="elipsis"><!-- panel title -->
                            <strong>กลุ่มครุภัณฑ์ (ส่วนที่ 1)</strong>
                        </span>
                        </div>
                        <div class="panel-body">
                            <div class="panel-body">

                                <table id="user" class="table table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <td width="35%">รหัสกลุ่มครุภัณฑ์</td>
                                        <td width="65%"><?php  echo  $modelAsset['asset_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="35%">วันที่นำเข้า</td>
                                        <td width="65%"><?php  echo  $modelAsset['asset_date']; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="35%">ปีงบประมาณ</td>
                                        <td width="65%"><?php  echo  $modelAsset['asset_year']; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="35%">วิธีการที่ได้มา</td>
                                        <td width="65%"><?php echo \app\modules\eoffice_asset\models\AssetGet::findOne($modelAsset['asset_get'])->asset_get_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="35%">จำนวนเงินงบประมาณ (บาท)</td>
                                        <td width="65%"><?php  echo  $modelAsset['asset_budget']; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="35%">ผู้ขาย/บริษัท</td>
                                        <td width="65%"><?php echo \app\modules\eoffice_asset\models\AssetCompany::findOne($modelAsset['asset_company'])->asset_company_name; ?></td>
                                    </tr>



                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    <!--asset detail--->
                    <div id="panel-misc-portlet-color-r2" class="panel panel-warning">
                        <div class="panel-heading">
                        <span class="elipsis"><!-- panel title -->
                            <strong>รายการครุภัณฑ์ (ส่วนที่ 2)</strong>
                        </span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover nomargin">
                                    <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>รหัสครุภัณฑ์ภาควิชา</th>
                                        <th>รหัสครุภัณฑ์มหาวิทยาลัย</th>
                                        <th>ชื่อรายการครุภัณฑ์</th>
                                        <th>ประเภทครุภัณฑ์</th>

                                    </tr>
                                    </thead>
                                    <tbody><?php $showasset = AssetDetail::find()->where(['asset_asset_id' => $modelAsset['asset_id']])->all(); ?>
                                    <?php  $x=1;  foreach ($showasset as $value):?>
                                        <tr>
                                            <td><?php  echo $x++; ?></td>
                                            <td><?php  echo  $value['asset_dept_code_start']; ?></td>
                                            <td><?php  echo  $value['asset_univ_code_start']; ?></td>
                                            <td><?php  echo  $value['asset_detail_name']; ?></td>
                                            <td><?php  echo   \app\modules\eoffice_asset\models\AssetTypeDepartment::findOne($value['asset_dept_type'])->asset_type_dept_name; ?></td>
                                            <td> <?= Html::a('แสดงข้อมูล', ['asset-detail/view', 'id' => $value['asset_detail_id']], ['class' => 'btn btn-info']) ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>



            </div>
            <!--end content-->
        </div>
    </div>



