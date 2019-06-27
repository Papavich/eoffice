<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\BoardOfDirectors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="board-of-directors-form">
    <?php $form = ActiveForm::begin(); ?>
    <?php
    foreach ($modelPerson as $value){
        $arrayT[$value->person_id]=$value->person_name."  ".$value->person_surname;
    }
    foreach ($modelDirector as $value){
        $arrayH[$value->director_id]=$value->position_name;
    }
    foreach ($modelPeriod as $value){
        $arrayG[$value->period_id]=$value->period_describe;
    }
    ?>
    <?= $form->field($model, 'board_id')->textInput( ['disabled' => 'disabled']) ?>
    <?= $form->field($model, 'person_id')->dropDownList($arrayT) ?>
    <?= $form->field($model, 'director_id')->dropDownList($arrayH) ?>
    <?= $form->field($model, 'period_id')->dropDownList($arrayG) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>