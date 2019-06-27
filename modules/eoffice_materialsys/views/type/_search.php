<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_materialsys\models\TypeSearch */
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
            <?= Html::activeTextInput($model, 'stype', ['class' => 'form-control', 'placeholder' => '']) ?>
        </div>
        <div class="col-md-2">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i> ค้นหา</button>
            </span>
        </div>
    </div>
    <div class="pull-right">
        <button type="button" class="glyphicon glyphicon-plus btn-success btn-3 btn-sm btn-3d" data-toggle="modal" data-target="#myAdd"> เพิ่มหมวดหมู่</button>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<!-- ============================= modal add ====================================-->
<div id="myAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="col-md-12">

                <!-- ------ -->
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>เพิ่มหมวดหมู่</strong>
                    </div>

                    <div class="panel-body">

                        <?php $form1 = ActiveForm::begin(['action'=>['type/create'],]) ?>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>รหัสหมวดหมู่</label>
                                    <input type="text" class="form-control" id="type_id" name="type_id" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <label>ชื่อหมวดหมู่</label>
                                    <input type="text" name="type_name" value="" class="form-control required">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input class="btn btn-success btn-small margin-top-30" type="submit" value="บันทึก">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <a href="#" class="btn btn-danger  btn-small margin-top-30" data-dismiss="modal">ยกเลิก</a>
                            </div>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================= modal add ====================================-->