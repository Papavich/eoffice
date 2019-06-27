<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsDocToDept */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-doc-to-dept-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'doc_to_dept_id')->textInput() ?>

    <?= $form->field($model, 'doc_to_dept_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doc_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
