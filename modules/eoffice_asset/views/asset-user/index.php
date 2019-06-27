<?php


use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\eoffice_asset\assets\AppAssetAsset;
AppAssetAsset::register($this);
use yii\widgets\ActiveForm;
use app\modules\eoffice_asset\models\AssetTypeDepartment;
use app\modules\eoffice_asset\models\AssetDetailStatus;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\eoffice_asset\models\AssetDetail;
use yii\db\ActiveQuery;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_asset\models\AssetdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvi der */

$this->params['breadcrumbs'][] = $this->title;
?>

    <!-- page title -->
    <header id="page-header">
        <h1>รายการครุภัณฑ์</h1>
        <ol class="breadcrumb">
            <li><a href=" ">หน้าหลัก</a></li>
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
                    'method' => 'get',
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
                <?php ActiveForm::end(); ?>
                <hr />
                <center><h2>ผลการค้นหา</h2></center>


                <div class="panel-body">
                    <div class="panel-body">

                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>รูปครุภัณฑ์</th>
                                <th>รหัสครุภัณฑ์</th>
                                <th>ชื่อรายการครุภัณฑ์</th>
                                <th>สถานะครุภัณฑ์</th>
                                <th>ทำรายการ</th>
                            </tr>
                            </thead>
                            <?php Pjax::begin(['id'=>'asset_detail_id']); ?>
                            <?php
                            $connection = Yii::$app->get('db_asset');
                            $query = $connection->createCommand("SELECT * FROM asset_detail WHERE asset_detail_status ='2'");
                            $modelA = $query->queryAll();
                            $x=1;  foreach ($modelA as $value):?>
                            <tbody>

                            <tr>
                                <td>
                                    <?php echo $x++; ?>
                                </td>
                                <td>
                                    <?php echo Html::img('@web/web_asset/images/upload_images_asset/'.$value['asset_detail_image'],["width"=>"80px"]) ;
                                    ?>
                                </td>
                                <td>
                                    <?php echo  $value['asset_dept_code_start']; ?>
                                </td>
                                <td>
                                    <?php echo  $value['asset_detail_name']; ?>
                                </td>
                                <td>
                                    <?php
                                        if($value['asset_detail_status'] == 1){
                                            echo '<button type="button" class="btn btn-warning btn-xs">'.'ถูกยืม'.'</button>';
                                        }
                                        elseif ($value['asset_detail_status'] == 2){
                                            echo '<button type="button" class="btn btn-success btn-xs">'.'ยังไม่ถูกยืม'.'</button>';
                                        }else
                                            echo '<button type="button" class="btn btn-danger btn-xs">'.'ไม่สามารถยืมได้'.'</button>';

                                    ?>

                                </td>
                                <td>


                                    <?= Html::a('ดูรายละเอียด', ['view', 'id' => $value['asset_detail_id']], [
                                        'class' => 'btn btn-default btn-sm btn-3d',
                                        'id' => 'modalDetail',
                                    ]) ?>

                                   <?php echo'<button type="button" class="btn btn-info btn-sm btn-3d" datasrc="view" href="/cart/index.php">'.'ยืมครุภัณฑ์'.'</button>'; ?>

                                    <?php




                                       // $connection = Yii::$app->get('db_asset');
                                      //  $query = $connection->createCommand("SELECT * FROM asset_detail");
                                      //  $modelA = $query->queryAll();
                                    //   echo  Html::a('ยืมครุภัณฑ์', ['addcart'],['class' => 'btn btn-info btn-sm btn-3d']) ;
                                       //  echo'<button type="button" class="btn btn-info btn-sm btn-3d" datasrc="view" href="/cart/index.php">'.'ยืมครุภัณฑ์'.'</button>';

                                    ?>


                                </td>


                            </tr>

                            <?php endforeach; ?>
                            </tbody>
                            <?php Pjax::end() ?>
                        </table>
                    </div>
                </div>
