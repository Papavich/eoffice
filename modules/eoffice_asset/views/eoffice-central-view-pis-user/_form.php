<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\EofficeCentralViewPisUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eoffice-central-view-pis-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_type_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department_id')->textInput() ?>

    <?= $form->field($model, 'student_fname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_lname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_fname_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_lname_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_fname_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_lname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_lname_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prefix_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'academic_positions_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'academic_positions_abb_thai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'academic_positions_eng')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'academic_positions')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'academic_positions_abb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PREFIXNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'major_id')->textInput() ?>

    <?= $form->field($model, 'major_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'major_name_eng')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'major_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_fname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_current_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AMPHUR_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROVINCE_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ZIPCODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DISTRICT_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_id')->textInput() ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STUDENTMOBILE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STUDENTEMAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
