<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\correspondence\controllers;

?>


<section id="middle" style="padding: 0px 3% 0px 3%">
    <br><br>
    <div class="container">
        <div class="panel-body col-sm-6">
            <!-- tabs content -->
            <?php $form = ActiveForm::begin(['action' => 'update?id=' . $_GET['id'], 'method' => 'post'], ['options' => ['id' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']]); ?>
            <div class="form-group">
                <?= $form->field($model, 'sub_type_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? controllers::t('menu', 'Create') : controllers::t('menu', 'Edit'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
    <!-- /tabs content -->


</section>