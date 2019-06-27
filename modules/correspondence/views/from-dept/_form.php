<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>


<section id="middle" style="padding: 0px 3% 0px 3%">
    <br><br>
    <div class="container">
        <div class="panel-body col-sm-6">
            <!-- tabs content -->
            <?php $form = ActiveForm::begin(['action' => 'update?doc_from_dept_id=' . $_GET['doc_from_dept_id'].'&doc_id='.$_GET['doc_id'], 'method' => 'post'], ['options' => ['id' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']]); ?>
            <div class="form-group">
                <?= $form->field($model, 'doc_from_dept_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? controllers::t('menu', 'Create') : controllers::t('menu', 'Edit'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <!-- /tabs content -->


</section>