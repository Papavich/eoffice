<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_consult\controllers;
use app\modules\eoffice_consult\models\EofficeCentralViewPisPerson;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_consult\models\ConsultPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consult-post-form">

    <?php $form = ActiveForm::begin(); ?>
  <div class="panel-body">
    <fieldset>
      <div class="row">
          <div class="form-group">
              <div class="col-md-12 col-sm-3">

                    <?php
                    $ReqCategory = app\modules\eoffice_consult\models\EofficeCentralViewPisPerson::find()->all();
                    $listData=ArrayHelper::map($ReqCategory,'person_card_id','person_name');
                    ?>

                    <?= $form->field($model, 'respon_id')->dropDownList($listData,['prompt'=>'-- เลือกประเภท --']) ?>
              </div>
            </div>
      </div>
        <div class="form-group">

            <?= Html::submitButton($model->isNewRecord ?
                '<i class="glyphicon glyphicon-floppy-disk"></i>'
                .controllers::t('label','บันทึก'):
                '<i class="glyphicon glyphicon-floppy-disk"></i>'
                .controllers::t('label','บันทึก'),
                ['class' => $model->isNewRecord ?
                    'btn btn-success pull-right' : 'btn btn-success pull-right'])
            ?>

    <?php ActiveForm::end(); ?>

</div>
