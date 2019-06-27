<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRegister */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-register-form">

    <?php $form = ActiveForm::begin(); ?>

    <br>

    <?= $form->field($model, 'doc_ref01')->fileInput() ?>

    <?= $form->field($model, 'doc_ref02')->fileInput() ?>

    <?= $form->field($model, 'doc_ref03')->fileInput() ?>

    <?= $form->field($model, 'doc_ref04')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            '<i class="glyphicon glyphicon-floppy-disk"></i>'
            .controllers::t('label','Save'):
            '<i class="glyphicon glyphicon-floppy-disk"></i>'
            .controllers::t('label','Update'),
            ['class' => $model->isNewRecord ?
                'btn btn-success pull-right' : 'btn btn-success pull-right'])
        ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
