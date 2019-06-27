<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

    <div class="panel-body">
    <?php $form = ActiveForm::begin();?>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <label>เลือกประเด็นยุทธศาสตร์</label>
                <?php
                foreach ($modelstrategicissues as $item) {
                    $array[$item->strategic_issues_id]=$item->strategic_issues_id.'. '.$item->strategic_issues_name;
                }
                ?>
                <?= $form->field($modelstrategic,'strategic_issues_strategic_issues_id')
                ->dropDownList($array)
                ->label(false)?>
            </div>
            <div class="col-md-4 col-sm-4">
                <label>กรอกลำดับกลยุทธ์</label>
                <?= $form->field($modelstrategic,'strategic_id')->textInput()->label(false)?>
            </div>
            <div class="col-md-4 col-sm-4">
                <label>กรอกชื่อกลยุทธ์</label>
                <?= $form->field($modelstrategic,'strategic_name')->textInput()->label(false)?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <button type="submit" class="btn btn-sm btn-success btn-3d"><i class="glyphicon glyphicon-plus"> บันทึก</i></button>
                <a class="btn btn-sm btn-blue btn-3d" href="../customstrategic/strategic-show"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
</div>
</div>

