<?php
use yii\widgets\ActiveForm;

?>

<div class="panel-body">
    <?php $form = ActiveForm::begin();?>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>กรอกลำดับประเด็นยุทธศาสตร์</label>
            <?= $form->field($modelstrategicissues,'strategic_issues_id')->textInput()->label(false)?>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>กรอกชื่อประเด็นยุทธศาสตร์</label>
            <?= $form->field($modelstrategicissues,'strategic_issues_name')->textInput()->label(false)?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <button type="submit" class="btn btn-sm btn-success btn-3d"><i class="glyphicon glyphicon-plus"> บันทึก</i></button>
            <a class="btn btn-sm btn-blue btn-3d" href="../customstrategicissues/strategicissues-show"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
        </div>
    </div>
            <?php ActiveForm::end(); ?>
</div>
</div>
</div>
</div>
</div>
