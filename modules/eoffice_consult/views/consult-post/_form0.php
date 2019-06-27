<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_consult\controllers;
use dosamigos\datepicker\DatePicker;
use app\modules\eoffice_consult\models\ConsultStatus;
use app\modules\eoffice_consult\models\ConsultTopicOwner;
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
                        <?= $form->field($model, 'user_id')->textInput(['readonly'=> true]) ?>

              </div>
            </div>
      </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-12 col-sm-3">
                    <?= $form->field($model, 'post_ark_detail')->textarea(['rows' => 6,'readonly'=> true]) ?>

                </div>
              </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-6 col-sm-3">

                                    <?php
                                    $ReqCategory = app\modules\eoffice_consult\models\ConsultTopicOwner::find()->all();
                                    $listData=ArrayHelper::map($ReqCategory,'topic_owner_id','topic_owner_name');
                                    ?>
                                    <?= $form->field($model, 'topic_owner_id')->dropDownList($listData,['prompt'=>'-- เลือกประเภท --']) ?>

                </div>
                <div class="col-md-6 col-sm-3">
                    <?= $form->field($model, 'post_ark_date')->
                   input('date', ['placeholder'=>'Enter a valid date-time...','readonly'=> true]); ?>
                    </select>
                </div>
              </div>
        </div>
          </div>
          <div class="panel-body">
          <div class="row">
              <div class="form-group">
                  <div class="col-md-12 col-sm-3">
                            <?= $form->field($model, 'post_ans')->textarea(['rows' => 6]) ?>
                      </select>
                  </div>
                </div>
          </div>

          <div class="row">
              <div class="form-group">
                  <div class="col-md-12 col-sm-3">
                    <?=$form->field($model, 'status_id')
                          ->dropDownList(
                            ArrayHelper::map(ConsultStatus::find()->asArray()->all(), 'status_id', 'status_name')
                            )
                    ?>
                      </select>
                  </div>
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



        <?= Html::a('<i class="fa fa-reply"></i>โอนการรับผิดชอบ', ['transfer', 'post_id' => $model->post_id, 'topic_owner_id' => $model->topic_owner_id, 'respon_id' => $model->respon_id], ['class' => 'btn btn-primary pull-right']) ?>

        </div>
  </fieldset>










    <?php ActiveForm::end(); ?>

</div>
