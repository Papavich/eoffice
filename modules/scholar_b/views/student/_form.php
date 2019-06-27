<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\model_main\EofficeMainStudent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eoffice-main-student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'STUDENTID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adviser_id')->textInput() ?>

    <?= $form->field($model, 'student_card_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_blood_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_underlying_disease')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_marital_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_mobile_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_facebook_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_line_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_working_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_working_place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_working_salary')->textInput() ?>

    <?= $form->field($model, 'student_current_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_current_district_id')->textInput() ?>

    <?= $form->field($model, 'student_current_amphur_id')->textInput() ?>

    <?= $form->field($model, 'student_current_province_id')->textInput() ?>

    <?= $form->field($model, 'student_current_zipcode_id')->textInput() ?>

    <?= $form->field($model, 'student_home_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_home_district_id')->textInput() ?>

    <?= $form->field($model, 'student_home_amphur_id')->textInput() ?>

    <?= $form->field($model, 'student_home_province_id')->textInput() ?>

    <?= $form->field($model, 'student_home_zipcode_id')->textInput() ?>

    <?= $form->field($model, 'father_birthday')->textInput() ?>

    <?= $form->field($model, 'father_highest_qualification')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_career')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_work_place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_district_id')->textInput() ?>

    <?= $form->field($model, 'father_amphur_id')->textInput() ?>

    <?= $form->field($model, 'father_province_id')->textInput() ?>

    <?= $form->field($model, 'father_zipcode_id')->textInput() ?>

    <?= $form->field($model, 'father_religion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_nationality')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_income_per_month')->textInput() ?>

    <?= $form->field($model, 'mother_birthday')->textInput() ?>

    <?= $form->field($model, 'mother_highest_qualification')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_career')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_work_place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_district_id')->textInput() ?>

    <?= $form->field($model, 'mother_amphur_id')->textInput() ?>

    <?= $form->field($model, 'mother_province_id')->textInput() ?>

    <?= $form->field($model, 'mother_zipcode_id')->textInput() ?>

    <?= $form->field($model, 'mother_religion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_nationality')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_income_permonth')->textInput() ?>

    <?= $form->field($model, 'marital_status_parents')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_career')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_district_id')->textInput() ?>

    <?= $form->field($model, 'parent_amphur_id')->textInput() ?>

    <?= $form->field($model, 'parent_province_id')->textInput() ?>

    <?= $form->field($model, 'parent_zipcode_id')->textInput() ?>

    <?= $form->field($model, 'parent_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_religion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_nationality')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_relation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_district_id')->textInput() ?>

    <?= $form->field($model, 'contact_amphur_id')->textInput() ?>

    <?= $form->field($model, 'contact_province_id')->textInput() ?>

    <?= $form->field($model, 'contact_zipcode_id')->textInput() ?>

    <?= $form->field($model, 'contact_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_religion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_nationality')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
