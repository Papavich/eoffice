<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $material_model app\modules\material_management\models\MatsysMaterial */
Yii::$app->controller->enableCsrfValidation = false;
$model_type = $material_model['matrerialType'];
$model_location = $material_model['location'];

?>
<div id="insertmaterial" class="insertab">
    <?php
    $form = ActiveForm::begin([
        'options' => ['action' => 'form'],
    ]) ?>
    <!-- Start Material Detail -->
    <div class="panel panel-default">
        <div class="panel-heading">
                <span class="title elipsis">
                    <!-- panel title -->
                    <strong style="font-size: 19px"><?= $material_model['material_name'] ?> <?= $amount ?></strong>
                </span>
            <ul class="options pull-right list-inline">
                <li data-toggle="tooltip" data-placement="bottom" title="แก้ไขรายละเอียด"><a
                            class="btn btn-warning glyphicon glyphicon-wrench" style="margin: 0;height: 30px;">

                    </a></li>
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                       data-placement="bottom"></a></li>

            </ul>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="form-group col-md-2">
                    <label>จำนวนที่เหลือ</label>
                    <input class="form-control" name="amount" type="number" value="<?= $amount ?>" min="1" disabled>
                    <div class="help-block"></div>
                </div>
<!--                <?//= $form->field(
//                    $material_model,
//                    'material_amount_all',
//                    ['options' => ['class' => 'form-group col-md-2']]
//                )->textInput([
//                    'type' => 'number',
//                ])->label(
//                    'จำนวนที่เพิ่ม'
//                ) ?>
-->
                <?= $form->field(
                    $model_stock,
                    'material_has_amount',
                    ['options' => ['class' => 'form-group col-md-2']]
                )->textInput([
                    'type' => 'number',
                ])->label(
                    'จำนวนที่เพิ่ม'
                ) ?>

                <?= $form->field(
                    $model_stock,
                    'material_has_price_per_unit',
                    ['options' => ['class' => 'form-group col-md-2']]
                )->textInput([
                    'type' => 'number',
                ])->label(
                    'ราคาต่อหน่วย'
                ) ?>

                <?= $form->field(
                    $model_stock,
                    'material_has_name_price_per_unit',
                    ['options' => ['class' => 'form-group col-md-2']]
                )->textInput([
                    'type' => 'text',
                ])->label(
                    'หน่วยนับ'
                ) ?>
                <?= $form->field(
                    $model_type,
                    'matrerial_type_name',
                    ['options' => ['class' => 'form-group col-md-4']]
                )->textInput([
                    'disabled' => 'disabled',
                ])->label(
                    'หมวดหมู่'
                ) ?>
                <?= $form->field(
                    $model_location,
                    'location_name',
                    ['options' => ['class' => 'form-group col-md-4']]
                )->textInput([
                    'disabled' => 'disabled',
                ])->label(
                    'สถานที่จัดเก็บ'
                ) ?>
                <div class="form-group col-md-4">
                    <label>รายละเอียด</label>
                    <textarea class="form-control" rows="3" disabled><?= $material_model['material_detail'] ?></textarea>
                    <div class="help-block"></div>
                </div>
                <?= $form->field(
                    $model_stock,
                    'material_has_annotation',
                    ['options' => ['class' => 'form-group col-md-4']]
                )->textarea([
                    'rows' => 3
                ])->label(
                    'หมายเหตุ'
                ) ?>
                <?= $form->field(
                    $model_stock,
                    'material_id',
                    ['options' => ['class' => 'form-group col-md-4']]
                )->textInput([
                    'type' => 'hidden',
                    'value' => $material_model['material_id']
                ])->label(
                    'หมายเหตุ'
                ) ?>
            </div>
        </div>
    </div>
    <div id="insertmaterial" class="insertab">
        <!-- Start Material Detail -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="title elipsis">
                    <!-- panel title -->
                    <strong style="font-size: 19px">รายละเอียด</strong>
                </span>
                <ul class="options pull-right list-inline">
                    <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                           data-placement="bottom"></a></li>

                </ul>
            </div>
            <div class="panel-body">
                <form style="margin: 0">
                    <div class="row">
                        <?= $form->field(
                            $model_stock,
                            'stock_id',
                            ['options' => ['class' => 'form-group col-md-4']]
                        )->textInput([
                                'placeholder' => 'ศธ0514.2.9./0116'
                        ])->label(
                            'รหัสใบสั่งซื้อ'
                        ) ?>
                        <div class="form-group col-md-3">
                            <label>วันที่</label>
                            <input type="text" name="date" placeholder="yyyy-mm-dd" class="form-control datepicker" data-format="yyyy-mm-dd">
                        </div>
                        <div class="form-group col-md-5">
                            <label>บริษัท</label>
                            <select name="company" class="select2" style="width: 100%">
                                <option value="">ค้นหาวัสดุ</option>
                                <option value="1">โลตัส</option>
                            </select>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    <!-- Btn -->
    <div align="center">
<!--        <input type="submit" class="btn btn-success cs-btn-insert" onclick="location.href='insertmaterial/success'" value="ยืนยัน">-->
        <?= Html::submitButton('ยืนยัน', ['class' => 'btn btn-success cs-btn-insert']) ?>
        <button class="btn btn-danger cs-btn-insert">ยกเลิก</button>
    </div>
    <?php ActiveForm::end() ?>
</div>