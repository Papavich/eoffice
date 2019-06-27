<div class="modal-header margin-bot-10">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><i class="fa fa-tags" aria-hidden="true"></i> <?= $material['material_name'] ?>
    </h4>
</div>
<div class="row">
    <form id="formedit">
        <input type="hidden" name="mat_id_edit" value="<?= $material['material_id'] ?>">
        <input type="hidden" name="stock_id_edit" value="ST0001">
        <input type="hidden" name="count_edit" value="<?= $count ?>">
        <div class="form-group col-md-2">
            <label>จำนวนที่เหลือ</label>
            <input class="form-control" name="amount_use_edit" id="amount_use_edit" type="number" min="1"
                   value="<?php if ($amount_use != null) {
                       echo $amount_use;
                   } else {
                       echo "0";
                   } ?>"
                   disabled>
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-2">
            <label>จำนวนที่เพิ่ม<span class="require">*</span></label>
            <input class="form-control" name="amount_edit" id="amount_edit" type="number" min="1"
                   value="<?= $model_material['bill_detaill_amount'] ?>">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-4">
            <label>หน่วยนับ<span class="require">*</span></label>
            <input class="form-control" name="unit_edit" id="unit_edit" type="text"
                   value="<?= $material['material_unit_name'] ?>" disabled>
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-4">
            <label>ราคาต่อหน่วย(บาท)<span class="require">*</span></label>
            <input class="form-control" name="price_unit_edit" id="price_unit_edit" type="number" min="1"
                   value="<?= $model_material['bill_detail_price_per_unit'] ?>">
            <div class="help-block"></div>
        </div>
    </form>
</div>