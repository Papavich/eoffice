<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\EofficeCentralViewPisUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eoffice-central-view-pis-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'user_type_id') ?>

    <?= $form->field($model, 'department_id') ?>

    <?php // echo $form->field($model, 'student_fname_th') ?>

    <?php // echo $form->field($model, 'student_lname_th') ?>

    <?php // echo $form->field($model, 'student_fname_en') ?>

    <?php // echo $form->field($model, 'student_lname_en') ?>

    <?php // echo $form->field($model, 'person_fname_en') ?>

    <?php // echo $form->field($model, 'person_lname_th') ?>

    <?php // echo $form->field($model, 'person_lname_en') ?>

    <?php // echo $form->field($model, 'prefix_en') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'academic_positions_id') ?>

    <?php // echo $form->field($model, 'academic_positions_abb_thai') ?>

    <?php // echo $form->field($model, 'academic_positions_eng') ?>

    <?php // echo $form->field($model, 'academic_positions') ?>

    <?php // echo $form->field($model, 'academic_positions_abb') ?>

    <?php // echo $form->field($model, 'PREFIXNAME') ?>

    <?php // echo $form->field($model, 'major_id') ?>

    <?php // echo $form->field($model, 'major_name') ?>

    <?php // echo $form->field($model, 'major_name_eng') ?>

    <?php // echo $form->field($model, 'major_code') ?>

    <?php // echo $form->field($model, 'person_fname_th') ?>

    <?php // echo $form->field($model, 'person_mobile') ?>

    <?php // echo $form->field($model, 'person_current_address') ?>

    <?php // echo $form->field($model, 'AMPHUR_NAME') ?>

    <?php // echo $form->field($model, 'PROVINCE_NAME') ?>

    <?php // echo $form->field($model, 'ZIPCODE') ?>

    <?php // echo $form->field($model, 'DISTRICT_NAME') ?>

    <?php // echo $form->field($model, 'person_id') ?>

    <?php // echo $form->field($model, 'password_hash') ?>

    <?php // echo $form->field($model, 'STUDENTMOBILE') ?>

    <?php // echo $form->field($model, 'student_img') ?>

    <?php // echo $form->field($model, 'person_img') ?>

    <?php // echo $form->field($model, 'STUDENTEMAIL') ?>

    <?php // echo $form->field($model, 'person_email') ?>

    <?php // echo $form->field($model, 'branch_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
