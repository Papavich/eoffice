<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $model app\modules\eoffice_materialsys\models\CompanySearch */
/* @var $company \app\modules\eoffice_materialsys\models\MatsysCompany */

?>

<div class="padding-20">

    <div class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong><h4>ตารางบริษัท</h4></strong> <!-- panel title -->
							</span>
        </div>
        <!-- Seacrch Page -->

        <div class="row">

            <!-- LEFT -->
            <div class="col-md-12">

                <!-- Panel Tabs -->
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <!-- tabs nav -->
                        <ul class="nav nav-tabs pull-left">
                            <li class="active"><!-- TAB 1 -->
                                <a href="#" data-toggle="tab">ค้นหาจากรหัส หรือ ชื่อหมวดหมู่</a>
                            </li>
                        </ul>
                        <!-- /tabs nav -->
                    </div>

                    <?php yii\widgets\Pjax::begin(['id' => 'grid-user-pjax', 'timeout' => 5000]) ?>

                    <!-- เรียก view _search.php -->
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                    <br>
                    <div class="panel-body">
                        <?= GridView::widget([
                            'id' => 'grid-user',
                            'dataProvider' => $dataProvider,
                            //'filterModel' => $searchModel,
                            'tableOptions' => [
                                'class' => 'table table-striped table-bordered table-hover',
                            ],
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'company_id',
                                'company_name',
                                'company_address',
                                'company_phone',
                                'company_sellman',
                                ['class' => 'yii\grid\ActionColumn', 'template' => '{custom_view}',
                                    'options' => ['style' => 'width:90px;'],
                                    'buttonOptions' => ['class' => 'btn btn-default'],
                                    'buttons' =>
                                        ['custom_view' => function ($url, $model) {
                                            /* @var $model \app\modules\eoffice_materialsys\models\MatsysCompany */
                                            // Html::a args: title, href, tag properties.
                                            return '<div class="btn-group btn-group-sm text-center" role="group">                                   
                                    <a class="glyphicon glyphicon-pencil btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#myEdit' . $model->company_id  . '"></a>
                                    <a class="glyphicon glyphicon-trash btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#myDel' . $model->company_id . '"></a>
                                        </div>';
                                        },
                                        ]
                                ],
                            ],
                        ]); ?>
                    </div>
                    <?php yii\widgets\Pjax::end() ?>

                </div>
            </div>
        </div>
    </div>
</div>

    <!-- ============================= modal detail ====================================-->
<?php foreach ($mat_company as $company) { ?>
    <div id="myDetail<?= $company->company_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><label>รายละเอียด</label></h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p>ชื่อบริษัท : <?= $company->company_name ?></p>
                    <p>ที่อยู่ : <?= $company->company_address ?></p>
                    <p>ชื่อผู้ติดต่อ : <?= $company->company_sellman ?></p>
                    <p>เบอร์โทรศัพท์ : <?= $company->company_phone ?></p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    <!-- ============================= modal detail ====================================-->

    <!-- ============================= modal delete ====================================-->
<?php foreach ($mat_company as $company) { ?>
    <div id="myDel<?= $company->company_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="col-md-12">

                    <!-- ------ -->
                    <div class="panel panel-default" align="center">
                        <div class="panel-heading panel-heading-transparent">
                            <h4 class="modal-title" id="myModalLabel">คุณต้องการลบใช่หรือไม่</h4>
                        </div>
                        <div class="panel-body">
                            <?php $form = ActiveForm::begin(['action'=>['company/deletecompany'],]) ?>
                            <div class="padding-20 " align="center">
                                <input type="hidden" class="form-control" name="mat_id[]" value="<?= $company->company_id ?>">
                                <input class="btn btn-success btn-3d" type="submit" value="ยืนยัน">
                                <a href="#" class="btn btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
                            </div>
                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    <!-- ============================= modal delete ====================================-->

    <!-- ======================================= Modal Edit =============================================== -->
<?php foreach ($mat_company as $company) { ?>
    <div id="myEdit<?= $company->company_id ?>" class="modal fade bs-example-modal-full" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full">
            <div class="col-md-12">

                <!-- ------ -->
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>แก้ไขบริษัท</strong>
                    </div>

                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(['action'=>['company/updatecompany'],])?>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>รหัสบริษัท</label>
                                    <input type="hidden" name="mat_id[]" value="<?= $company->company_id ?>">
                                    <input type="text" name="company_id[]" row="4" value="<?= $company->company_id ?>" class="form-control required" placeholder="กรอกรหัสบริษัท เช่น company-001" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <label>ชื่อบริษัท</label>
                                    <input type="text" name="mat_name[]" value="<?= $company->company_name ?>" class="form-control " placeholder="กรอกชื่อบริษัท เช่น บริษัท A">
                                </div>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <label>ที่อยู่</label>
                                    <textarea name="mat_address[]" row="4" class="form-control " placeholder="กรอกที่อยู่ของบริษัท เช่น บริษัท A ตำบล B อำเภอ C จังหวัด D"><?= $company->company_address ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <label>ชื่อผู้ติดต่อ</label>
                                    <input type="text" name="mat-sellman[]" value="<?= $company->company_sellman ?>" class="form-control " placeholder="กรอกชื่อผู้ติดต่อซื้อขาย เช่น คุณ A">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12" >
                                    <label>เบอร์โทรศัพท์</label>
                                    <input type="text" name="mat_phone[]"value="<?= $company->company_phone ?>" class="form-control " placeholder="กรอกเบอร์โทรศัพท์" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input onclick="myAlert()" class="btn btn-3d btn-success btn-sm btn-block margin-top-30" type="submit" value="บันทึก">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <a href="#" class="btn btn-danger btn-sm btn-block margin-top-30" data-dismiss="modal">ยกเลิก</a>
                            </div>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>

                </div>
                <!-- /----- -->

            </div>
        </div>
    </div>
    <!-- ======================================= Modal Edit =============================================== -->
<?php } ?>