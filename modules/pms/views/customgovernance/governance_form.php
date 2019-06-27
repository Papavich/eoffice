<?php
use yii\widgets\ActiveForm;

?>
<div class="panel-body">
    <?php $form = ActiveForm::begin();?>
        <div class="row">
            <div class="col-md-3 col-sm-3">
            <label>กรอกชื่อหลักธรรมาภิบาล</label>

            <?= $form->field($modelgovernance,'governance_name')->textInput()->label(false)?>
            </div>
            <div class="col-md-12 col-sm-12">
                <button type="submit" class="btn btn-sm btn-success btn-3d"><i class="glyphicon glyphicon-plus"> บันทึก</i></button>
            <a class="btn btn-sm btn-blue btn-3d" href="../customgovernance/governance-show"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
</div>
</div>
