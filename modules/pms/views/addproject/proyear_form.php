<?php
use yii\widgets\ActiveForm;

?>
<div class="panel-body">

<?php $form = ActiveForm::begin();?>
<?php
$year = date("Y");
$year = $year + 542;
for($i =0 ; $i < 5 ; $i++){
    $array[$year+$i]=$year+$i;
}
?>

    <div class="row">
        <div class="col-md-2 col-sm-2">
            <label>เลือกปีงบประมาณ</label>
            <?= $form->field($modelproject,'project_year')
                ->dropDownList($array)
                ->label(false)?>
        </div>
        <div class="col-md-3 col-sm-3">
            <label>กรอกรหัสโครงการหลัก</label>
            <?= $form->field($modelproject,'project_code')->textInput()->label(false)->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '99-99-99-99-99-99',
            ])?>
        </div>
        <div class="col-md-6 col-sm-6">
            <label>กรอกชื่อโครงการหลัก</label>
            <?= $form->field($modelproject,'project_name')->textInput()->label(false)?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <button type="submit" class="btn btn-sm btn-success btn-3d"><i class="glyphicon glyphicon-plus"> บันทึก</i></button>
            <a class="btn btn-sm btn-blue btn-3d" href="../addproject/projectyear-show"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
        </div>
    </div>
<?php ActiveForm::end(); ?>
    </div>
</div>
</div>
</div>
</div>

