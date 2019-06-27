<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\consulting\controllers;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultFaq */
/* @var $form yii\widgets\ActiveForm */

?>



<div class="consult-faq-form">

    <?php $form = ActiveForm::begin(); ?>

    <fieldset>
        <div class="row">
            <div class="form-group">
                <div class="col-md-12 col-sm-3">
                    <?= $form->field($model, 'faq_ark')->textInput(['maxlength' => true]) ?>
                    </select>
                </div>
              </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-12 col-sm-3">
                    <?= $form->field($model, 'faq_ans')->textarea(['rows' => 6]) ?>
                    </select>
                </div>
              </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-6 col-sm-3">
                    <?= $form->field($model, 'faq_crby')->textInput(['maxlength' => true]) ?>
                    </select>
                </div>
                <div class="col-md-6 col-sm-3">
                    <?= $form->field($model, 'faq_crtime')->
                   input('date', ['placeholder'=>'Enter a valid date-time...']); ?>
                    </select>
                </div>
              </div>

        </div>

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
  </fieldset>
    <?php ActiveForm::end(); ?>

</div>
