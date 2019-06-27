

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(['action' => ['datainsertelective']]); ?>
<div id="content" class="padding-20">
    <div class="panel-body">
        <?= $form->field($model, 'program_id')->textInput([  'class' => 'form-control' ,'value'=>$sub_student, 'readOnly' => true])->label('สาขา'); ?>
        <?= $form->field($model, 'subject_id')->textInput(['data-placeholder' => "-", 'placeholder' => "รหัสวิชา", 'class' => 'form-control '])->label('รหัสวิชา'); ?>
        <?= $form->field($model, 'subject_version')->textInput(['placeholder' => "ปีหลักสูตร", 'class' => 'form-control' , 'id' => 'sub_thainame'])->label('subject_version'); ?>
        <?= $form->field($model, 'student_year')->textInput([ 'class' => 'form-control' , 'id' => 'sub_engname','value'=>$sub_stdyear,'readOnly' => true])->label('ชั้นปีที่'); ?>
        <?= $form->field($model, 'subopen_semester')->textInput(['placeholder' => "ภาคการศึกษา", 'class' => 'form-control' , 'value'=>$plan_semester,'readOnly' => true])->label('ภาคการศึกษาที่'); ?>
        <?= $form->field($model, 'subopen_year')->textInput([ 'class' => 'form-control' , 'value'=>$sub_year,'readOnly' => true])->label('ปีการศึกษา'); ?>
        <div class="form-group" align="center">
            <?= Html::submitButton($model->isNewRecord ? 'เพิ่มวิชาเรียน' : 'บันทึกวิชาเรียน', ['class' => $model->isNewRecord ? 'btn btn-reveal btn-success' : 'btn btn-reveal btn-success']) ?>
        </div>
    </div>
</div>
</div>
<?php $form = ActiveForm::end(); ?>


