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
    </div>
    <div class="panel-body">
        <div class="row">
            <form id="formaddmat">
                <input type="hidden" name="mat_id" id="mat_id" value="<?= $model['material_id'] ?>">
                <div class="form-group col-md-2">
                    <label>จำนวนที่เหลือ</label>
                    <input class="form-control" name="amount_use" id="amount_use" type="number" min="1" value="<?php if($amount_use != null){ echo $amount_use; }else{ echo "0";} ?>"
                           disabled>
                    <div class="help-block"></div>
                </div>
                <div class="form-group col-md-2">
                    <label>จำนวนที่เพิ่ม<span class="require">*</span></label>
                    <input class="form-control" name="amount" id="amount" type="number" min="1">
                    <div class="help-block"></div>
                </div>
                <div class="form-group col-md-3">
                    <label>หน่วยนับ<span class="require"></span></label>
                    <input class="form-control" name="unit_name" id="unit_name" type="text" value="<?= $model['material_unit_name'] ?>" disabled>
                    <div class="help-block"></div>
                </div>
                <div class="form-group col-md-5">
                    <label>ราคาต่อหน่วย(บาท)<span class="require">*</span></label>
                    <input class="form-control" name="price_unit" id="price_unit" type="number" min="1">
                    <div class="help-block"></div>
                </div>
            </form>
        </div>
    </div>
</div>