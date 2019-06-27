<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>


<section id="middle" style="padding: 0px 3% 0px 3%">
    <br><br>
    <div class="container">
        <div class="panel-body col-sm-6">
            <!-- tabs content -->
            <?php $form = ActiveForm::begin(['action' => 'create', 'method' => 'post'], ['options' => ['id' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']]); ?>
            <div class="form-group">
                <?= $form->field($model, 'address_id')->textInput() ?>
                <?= $form->field($model, 'address_name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'sub_type_id')->dropDownList(
                    \yii\helpers\ArrayHelper::map(\app\modules\correspondence\models\CmsDocSubType::find()->asArray()->all()
                        , 'sub_type_id', 'sub_type_name'), ['prompt' => '--- กรุณาเลือกหมวดหมู่ ---']);
                ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? controllers::t('menu', 'Create') : controllers::t('menu', 'Edit'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <!-- /tabs content -->


</section>