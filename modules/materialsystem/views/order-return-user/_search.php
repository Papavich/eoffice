<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\materialsystem\models\OrderReturnUserSearch*/
/* @var $company \app\modules\materialsystem\models\MatsysOrder*/
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel-body">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax' => true]
    ]); ?>
    <div class="input-group">
        <div class="col-md-10">
            <?= Html::activeTextInput($model, 'ouSearch', ['class' => 'form-control', 'placeholder' => '']) ?>
        </div>
        <div class="col-md-2">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i> ค้นหา</button>
            </span>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>