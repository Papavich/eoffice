<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\AuthorLevel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="author-level-form">

    <div class="row">
        <div class="form-group">

            <?php $form = ActiveForm::begin(); ?>

            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'auth_level_name')->textInput(['maxlength' => true]) ?>
            </div><br/>
            <div class="col-md-4 col-sm-4">
                <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
            </div>


            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
