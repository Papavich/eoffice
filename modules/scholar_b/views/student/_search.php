<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\model_main\EofficeMainStudentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eoffice-main-student-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'studentbio_id') ?>

    <?= $form->field($model, 'STUDENTID') ?>

    <?= $form->field($model, 'adviser_id') ?>

    <?= $form->field($model, 'student_card_id') ?>

    <?= $form->field($model, 'student_email') ?>

    <?php // echo $form->field($model, 'student_img') ?>

    <?php // echo $form->field($model, 'student_nickname') ?>

    <?php // echo $form->field($model, 'student_height') ?>

    <?php // echo $form->field($model, 'student_weight') ?>

    <?php // echo $form->field($model, 'student_blood_group') ?>

    <?php // echo $form->field($model, 'student_underlying_disease') ?>

    <?php // echo $form->field($model, 'student_marital_status') ?>

    <?php // echo $form->field($model, 'student_mobile_phone') ?>

    <?php // echo $form->field($model, 'student_facebook_url') ?>

    <?php // echo $form->field($model, 'student_line_id') ?>

    <?php // echo $form->field($model, 'student_working_status') ?>

    <?php // echo $form->field($model, 'student_working_place') ?>

    <?php // echo $form->field($model, 'student_working_salary') ?>

    <?php // echo $form->field($model, 'student_current_address') ?>

    <?php // echo $form->field($model, 'student_current_district_id') ?>

    <?php // echo $form->field($model, 'student_current_amphur_id') ?>

    <?php // echo $form->field($model, 'student_current_province_id') ?>

    <?php // echo $form->field($model, 'student_current_zipcode_id') ?>

    <?php // echo $form->field($model, 'student_home_address') ?>

    <?php // echo $form->field($model, 'student_home_district_id') ?>

    <?php // echo $form->field($model, 'student_home_amphur_id') ?>

    <?php // echo $form->field($model, 'student_home_province_id') ?>

    <?php // echo $form->field($model, 'student_home_zipcode_id') ?>

    <?php // echo $form->field($model, 'father_birthday') ?>

    <?php // echo $form->field($model, 'father_highest_qualification') ?>

    <?php // echo $form->field($model, 'father_career') ?>

    <?php // echo $form->field($model, 'father_work_place') ?>

    <?php // echo $form->field($model, 'father_mobile') ?>

    <?php // echo $form->field($model, 'father_address') ?>

    <?php // echo $form->field($model, 'father_district_id') ?>

    <?php // echo $form->field($model, 'father_amphur_id') ?>

    <?php // echo $form->field($model, 'father_province_id') ?>

    <?php // echo $form->field($model, 'father_zipcode_id') ?>

    <?php // echo $form->field($model, 'father_religion') ?>

    <?php // echo $form->field($model, 'father_nationality') ?>

    <?php // echo $form->field($model, 'father_income_per_month') ?>

    <?php // echo $form->field($model, 'mother_birthday') ?>

    <?php // echo $form->field($model, 'mother_highest_qualification') ?>

    <?php // echo $form->field($model, 'mother_career') ?>

    <?php // echo $form->field($model, 'mother_work_place') ?>

    <?php // echo $form->field($model, 'mother_mobile') ?>

    <?php // echo $form->field($model, 'mother_address') ?>

    <?php // echo $form->field($model, 'mother_district_id') ?>

    <?php // echo $form->field($model, 'mother_amphur_id') ?>

    <?php // echo $form->field($model, 'mother_province_id') ?>

    <?php // echo $form->field($model, 'mother_zipcode_id') ?>

    <?php // echo $form->field($model, 'mother_religion') ?>

    <?php // echo $form->field($model, 'mother_nationality') ?>

    <?php // echo $form->field($model, 'mother_income_permonth') ?>

    <?php // echo $form->field($model, 'marital_status_parents') ?>

    <?php // echo $form->field($model, 'parent_career') ?>

    <?php // echo $form->field($model, 'parent_address') ?>

    <?php // echo $form->field($model, 'parent_district_id') ?>

    <?php // echo $form->field($model, 'parent_amphur_id') ?>

    <?php // echo $form->field($model, 'parent_province_id') ?>

    <?php // echo $form->field($model, 'parent_zipcode_id') ?>

    <?php // echo $form->field($model, 'parent_mobile') ?>

    <?php // echo $form->field($model, 'parent_religion') ?>

    <?php // echo $form->field($model, 'parent_nationality') ?>

    <?php // echo $form->field($model, 'contact_relation') ?>

    <?php // echo $form->field($model, 'contact_address') ?>

    <?php // echo $form->field($model, 'contact_district_id') ?>

    <?php // echo $form->field($model, 'contact_amphur_id') ?>

    <?php // echo $form->field($model, 'contact_province_id') ?>

    <?php // echo $form->field($model, 'contact_zipcode_id') ?>

    <?php // echo $form->field($model, 'contact_mobile') ?>

    <?php // echo $form->field($model, 'contact_religion') ?>

    <?php // echo $form->field($model, 'contact_nationality') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
