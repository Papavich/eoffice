<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\consulting\controllers;
use dosamigos\datepicker\DatePicker;
use app\modules\consulting\models\ConsultStatus;
use app\modules\consulting\models\ConsultTopicOwner;


/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consult-post-form">

    <?php $form = ActiveForm::begin(); ?>

    <fieldset>
      <div class="row">
          <div class="form-group">
              <div class="col-md-12 col-sm-3">
                        <?= $form->field($model, 'user_id')->textInput() ?>
                  </select>
              </div>
            </div>
      </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-12 col-sm-3">
                    <?= $form->field($model, 'post_ark_detail')->textarea(['rows' => 6]) ?>

                </div>
              </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-6 col-sm-3">

  <?=$form->field($model, 'topic_owner_id')
                ->dropDownList(
                ArrayHelper::map(ConsultTopicOwner::find()->asArray()->all(), 'topic_owner_id', 'topic_owner_name')
                )
    ?>
                  
                </div>
                <div class="col-md-6 col-sm-3">
                    <?= $form->field($model, 'post_ark_date')->
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
