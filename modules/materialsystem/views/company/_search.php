<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\materialsystem\models\CompanySearch*/
/* @var $company \app\modules\materialsystem\models\MatsysCompany*/
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel-body">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax' => true]
    ]); ?>
    <div class="input-group">
        <div class="col-md-10">
            <?= Html::activeTextInput($model, 'cSearch', ['class' => 'form-control', 'placeholder' => '']) ?>
        </div>
        <div class="col-md-2">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i> ค้นหา</button>
            </span>
        </div>
    </div>
    <div class="pull-right">
        <button type="button" class="glyphicon glyphicon-plus btn-success btn-3 btn-sm btn-3d" data-toggle="modal" data-target="#myAdd"> เพิ่มบริษัท</button>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<!-- ======================================= Modal Add =============================================== -->
<div id="myAdd" class="modal fade bs-example-modal-full" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="col-md-12">

            <!-- ------ -->
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>เพิ่มบริษัท</strong>
                </div>

                <div class="panel-body">
                    <?php $form1 = ActiveForm::begin(['action'=>['company/create'],]) ?>
                    <!-- required [php action request] -->
                    <input type="hidden" name="action" value="contact_send"/>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label>รหัสบริษัท</label>
                                <input type="text" name="mat_id" row="4" class="form-control required" placeholder="กรอกรหัสบริษัท เช่น company-001" value="" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <label>ชื่อบริษัท</label>
                                <input type="text" name="mat_name" value="" class="form-control " placeholder="กรอกชื่อบริษัท เช่น บริษัท A">
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <label>ที่อยู่</label>
                                <textarea name="mat_address" row="4" class="form-control " placeholder="กรอกที่อยู่ของบริษัท เช่น บริษัท A ตำบล B อำเภอ C จังหวัด D"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <label>ชื่อผู้ติดต่อ</label>
                                <input type="text" name="mat-sellman" value="" class="form-control " placeholder="กรอกชื่อผู้ติดต่อซื้อขาย เช่น คุณ A">
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12" >
                                <label>เบอร์โทรศัพท์</label>
                                <input type="text" name="mat_phone" class="form-control " placeholder="กรอกเบอร์โทรศัพท์">
                                <!--<input type="text" class="form-control masked" name="mat_phone" data-format="999-999?-9999" data-placeholder="X" placeholder="กรอกเบอร์โทรศัพท์" required>-->
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
<!-- ======================================= Modal Add =============================================== -->