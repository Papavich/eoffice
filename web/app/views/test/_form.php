<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegStudentbio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-studentbio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'STUDENTBIO')->textInput() ?>

    <?= $form->field($model, 'STUDENTID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NATIONID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RELIGIONID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SCHOOLID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ENTRYTYPE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ENTRYDEGREE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BIRTHDATE')->textInput() ?>

    <?= $form->field($model, 'STUDENTFATHERNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STUDENTMOTHERNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STUDENTSEX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADMITACADYEAR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADMITSEMESTER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ENTRYGPA')->textInput() ?>

    <?= $form->field($model, 'CITIZENID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PARENTNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PARENTRELATION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CONTACTPERSON')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STUDENTMOBILE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
