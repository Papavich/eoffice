<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\DocumentTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>
    <?php // echo $form->field($model, 'udtime') ?>

    <div class="form-group">
        <?= Html::submitButton(\app\modules\eproject\controllers::t('label','Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(\app\modules\eproject\controllers::t('label','Save'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
