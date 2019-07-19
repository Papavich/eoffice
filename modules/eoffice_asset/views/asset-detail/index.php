<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\eoffice_asset\assets\AppAssetAsset;
AppAssetAsset::register($this);
use yii\widgets\ActiveForm;
use app\modules\eoffice_asset\models\AssetTypeDepartment;

use yii\helpers\ArrayHelper;
use yii\db\ActiveQuery;
use app\modules\eoffice_asset\models\AssetGet;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_asset\models\AssetdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>

<!-- page title -->
<header id="page-header">
    <h1>รายการครุภัณฑ์</h1>
    <ol class="breadcrumb">
        <li><a href="index_admin.html">หน้าหลัก</a></li>
        <li class="active">รายการครุภัณฑ์</li>
    </ol>
</header>
<!-- /page title -->


<div id="content" class="padding-20">

    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>รายการครุภัณฑ์</strong> <!-- panel title -->
							</span>

            <!-- /right options -->

        </div>




        <!-- panel content -->
        <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'GET',
            ]); ?>
            <div class="row">
                <div class="form-group">

                        <div class="col-md-3 col-sm-3">
                        <?= $form->field($searchModel, 'asset_dept_code_start') ?>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <?php  echo $form->field($searchModel, 'asset_detail_name') ?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?php echo $form->field($searchModel, 'asset_dept_type')->dropDownList(ArrayHelper::map(AssetTypeDepartment::find()->all(), 'asset_type_dept_id', 'asset_type_dept_name'),['prompt'=>'เลือกประเภทครุภัณฑ์ภาควิชา']) ?>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;</label>
                        <div class="form-group">
                            <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-3d btn-dirtygreen']) ?>
                        </div>
                    </div>
                </div>

            </div>
            <?= Html::a('EXCEL', ['excel'], ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end(); ?>
            <hr />
            <center><h2>ผลการค้นหา</h2></center>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,

               // 'name1' => $name1,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    

                    //'asset_detail_id',
                   // 'asset_univ_code_start',
                   // 'asset_univ_type',
                    'asset_dept_code_start',
                  //  'asset_dept_type',
                    'asset_detail_name',
                    // 'asset_detail_brand',
                   // 'asset_dept_type',
                    // 'asset_detail_age',
                    // 'asset_detail_price',
                    // 'asset_detail_price_wreck',
                    // 'asset_detail_insurance',
                    // 'asset_detail_building',
                    // 'asset_detail_room',
                    // 'asset_asset_id',
                    //'asset_detail_image',

                    ['class' => 'yii\grid\ActionColumn',
                    'buttonOptions'=>['class'=>'btn btn-default'],
                    'template'=>'{view} {update} {delete}',
                ],
                    
                ],
            ]); ?>

        </div>

    </div>
    


</div>
<!-- /PANEL -->


