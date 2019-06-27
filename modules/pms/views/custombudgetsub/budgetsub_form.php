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
                foreach ($modelBudgetmain as $key => $item) {
                    if($key == 2 ){
                        continue;
                    }else{
                        $array[$item->budget_id]=$item->budget_name;
                    }

                }
                ?>
                <?= $form->field($modelbudgetsub,'budget_main_budget_id')
                ->dropDownList($array)
                ->label(false)?>
            </div>
            <div class="col-md-4 col-sm-4">
                <label>กรอกชื่อกลยุทธ์</label>
                <?= $form->field($modelbudgetsub,'budget_name')->textInput()->label(false)?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <button type="submit" class="btn btn-sm btn-success btn-3d"><i class="glyphicon glyphicon-plus"> บันทึก</i></button>
                <a class="btn btn-sm btn-blue btn-3d" href="../custombudgetsub/budgetsub-show"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
</div>
</div>

