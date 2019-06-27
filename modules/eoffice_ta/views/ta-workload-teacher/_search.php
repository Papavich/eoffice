<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaWorkloadTeacherSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-workload-teacher-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ta_wload_teacher_id') ?>

    <?= $form->field($model, 'section') ?>

    <?= $form->field($model, 'subject_id') ?>

    <?= $form->field($model, 'subject_version') ?>

    <?= $form->field($model, 'term') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'ta_type_work_id') ?>

    <?php // echo $form->field($model, 'ta_status_id') ?>

    <?php // echo $form->field($model, 'time_start') ?>

    <?php // echo $form->field($model, 'time_end') ?>

    <?php // echo $form->field($model, 'lec_inspect') ?>

    <?php // echo $form->field($model, 'lect_check_list_std') ?>

    <?php // echo $form->field($model, 'lec_other') ?>

    <?php // echo $form->field($model, 'lab_hr') ?>

    <?php // echo $form->field($model, 'crby') ?>

    <?php // echo $form->field($model, 'crtime') ?>

    <?php // echo $form->field($model, 'udby') ?>

    <?php // echo $form->field($model, 'udtime') ?>

    <?php // echo $form->field($model, 'time_start_lab') ?>

    <?php // echo $form->field($model, 'time_end_lab') ?>

    <?php // echo $form->field($model, 'day_lect') ?>

    <?php // echo $form->field($model, 'day_lab') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
