<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\Position */

$this->title = 'Update Position: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'ตำแหน่ง', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->position_name, 'url' => ['view', 'id' => $model->position_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>Design Section</strong>
                  </span>
        </div>
        <div class="panel-body">
            <div class="position-form">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'position_name')->textInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>