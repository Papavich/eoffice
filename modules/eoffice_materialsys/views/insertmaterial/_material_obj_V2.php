<?php

use yii\widgets\ActiveForm;

?>
<div class="panel panel-default setmargin-0">
    <div class="panel-heading">
                                <span class="title elipsis">
                                <!-- panel title -->
                                    <strong style="font-size: 18px">
                                        <?= $model['material_name'] ?>
                                        <span style="font-size: 14px;color: #868585;">(<?= $model['material_id'] ?>)</span>
                                    </strong>
                                </span>
        <ul class="options pull-right list-inline">
            <li data-toggle="tooltip" data-placement="bottom" title="แก้ไขรายละเอียด"><a
                        class="glyphicon glyphicon-wrench"
                        style="margin-top: 4px;height: 30px;color: #9c9e9e;">

                </a></li>
            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                   data-placement="bottom"></a></li>

        </ul>
    </div>
    <div class="panel-body">
        <div class="row">
            <input type="hidden" id="mat_id" value="<?= $model['material_id'] ?>">
            <?php
            $form = ActiveForm::begin([
                'options' => ['action' => 'form'],
            ]) ?>
            <div class="form-group col-md-2">
                <label>จำนวนที่เหลือ</label>
                <input class="form-control" name="amount" type="number" min="1" value="10" disabled>
                <div class="help-block"></div>
            </div>
            <?= $form->field(
                $model_stock,
                'material_has_amount',
                ['options' => ['class' => 'form-group col-md-2']]
            )->textInput([
                'type' => 'number',
            ])->label(
                'จำนวนที่เพิ่ม<span class="require">*</span>'
            ) ?>
            <?= $form->field(
                $model,
                'material_detail',
                ['options' => ['class' => 'form-group col-md-8']]
            )->textarea([
                'disabled' => 'disabled',
            ])->label(
                'รายละเอียด'
            ) ?>
            <?= $form->field(
                $model_stock,
                'material_has_price_per_unit',
                ['options' => ['class' => 'form-group col-md-4']]
            )->textInput([
                'type' => 'text'
            ])->label(
                'ราคาต่อหน่วย(บาท)<span class="require">*</span>'
            ) ?>
            <?= $form->field(
                $model_stock,
                'material_has_name_price_per_unit',
                ['options' => ['class' => 'form-group col-md-4']]
            )->textInput([
                'type' => 'text'
            ])->label(
                'หน่วยนับ<span class="require">*</span>'
            ) ?>
            <?= $form->field(
                $model_stock,
                'material_has_annotation',
                ['options' => ['class' => 'form-group col-md-4']]
            )->textarea([
            ])->label(
                'หมายเหตุ<span class="require">*</span>'
            ) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>