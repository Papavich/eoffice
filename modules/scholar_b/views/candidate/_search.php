<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbCandidateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scb-candidate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_card') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'prefix') ?>

    <?= $form->field($model, 'firstname') ?>

    <?= $form->field($model, 'lastname') ?>

    <?php // echo $form->field($model, 'blood_type') ?>

    <?php // echo $form->field($model, 'birth_date') ?>

    <?php // echo $form->field($model, 'origin') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'religion') ?>

    <?php // echo $form->field($model, 'place_of_birth') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'schoolname') ?>

    <?php // echo $form->field($model, 'school_status') ?>

    <?php // echo $form->field($model, 'total_brethren') ?>

    <?php // echo $form->field($model, 'number_of_sister') ?>

    <?php // echo $form->field($model, 'number_of_brother') ?>

    <?php // echo $form->field($model, 'crby') ?>

    <?php // echo $form->field($model, 'crtime') ?>

    <?php // echo $form->field($model, 'udby') ?>

    <?php // echo $form->field($model, 'udtime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
