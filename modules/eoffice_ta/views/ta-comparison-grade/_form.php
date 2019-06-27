<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaComparisonGrade */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
//$subject = EofficeCentralRegCourse::findOne(['COURSEID'=>$s]);
?>
<div class="ta-comparison-grade-form">
    <div class="panel-body">
        <div class="alert alert-mini alert-warning margin-bottom-30"><!-- WARNING -->
            <strong class="size-15">หมายเหตุ : </strong> <span class="size-15">
            เนื่องจากท่านยังไม่เคยผ่านการเรียนรายวิชา <?php //echo $s?> กรุณาแนบหลักฐานความสามารถพิเศษเกี่ยวกับรายวิชานี้
        </span>
        </div>

    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-6">
    <?= $form->field($model, 'subject_id_compar')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'subject_name_compar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grade_name')->dropDownList(
        [ 'A'=>'A','B+'=> 'B+','B'=> 'B','C+'=>'C+','C'=>'C','D+'=>'D+','D'=>'D' ],
        ['prompt' => '--- เลือกเกรดรายวิชาที่ได้ ---']) ?>
    <?= $form->field($model, 'grade_value')->textInput(['maxlength' => true]) ?>
            </div><div class="col-lg-6">


    <?= $form->field($model, 'doc_ref')->fileInput() ?>


    <?= $form->field($model, 'compar_detail')->textarea(['rows' => 6]) ?>

            </div></div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
