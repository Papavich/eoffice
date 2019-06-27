<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_consult\controllers;
use dosamigos\datepicker\DatePicker;
use app\modules\eoffice_consult\models\ConsultStatus;
use app\modules\eoffice_consult\models\ConsultTopicOwner;

use app\modules\eoffice_consult\controllers\ConsultPostController;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_consult\models\ConsultPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="panel-info" class="panel panel-default cs-remargin" style="margin-top: 20px">
        <div class="panel-body">
            <div class="content-info">
                <!--            <h3><i class="glyphicon glyphicon-file"></i>ทำรายการเบิกวัสดุ<span class="pull-right widen_id"><b>รหัสใบเบิกวัสดุ : </b>6589/21</span>-->
                <!--            </h3>-->
                <h3>
                    <i class="glyphicon glyphicon-user"></i> &nbsp; ข้อมูลผู้ขอคำปรึกษา

                </h3>



                <div>
                    <span><b>ชื่อ-นามสกุล</b></span>     <b>:</b>   <span><?= ConsultPostController::getNameuser(Yii::$app->user->identity->id).' '.ConsultPostController::getLnameuser(Yii::$app->user->identity->id); ?></span>
                </div>

                <div>
                    <span><b>รหัสนักศึกษา</b></span>    <b>:</b>   <span><?= Yii::$app->user->identity->username; ?></span>
                </div>

                <div>
                    <span><b>เบอร์โทรศัพท์</b></span>  <b>:</b>   <span><?= ConsultPostController::getTeluser(Yii::$app->user->identity->id) ; ?></span>
                </div>
                <br/>

            </div>

  </div>
  </div>


<div class="consult-post-form">

    <?php $form = ActiveForm::begin(); ?>

    <fieldset>

      <!-- <div class="row">
          <div class="form-group">
              <div class="col-md-12 col-sm-3">
                        <?= $form->field($model, 'user_id')->textInput(['disabled' => true,'value' => Yii::$app->user->identity->id]) ?>
                  </select>
              </div>
            </div>
      </div> -->

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

                  <?php
                  $ReqCategory = app\modules\eoffice_consult\models\ConsultTopicOwner::find()->all();
                  $listData=ArrayHelper::map($ReqCategory,'topic_owner_id','topic_owner_name');
                  ?>
                  <?= $form->field($model, 'topic_owner_id')->dropDownList($listData,['prompt'=>'-- เลือกประเภท --']) ?>
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
                .controllers::t('label','บันทึก'):
                '<i class="glyphicon glyphicon-floppy-disk"></i>'
                .controllers::t('label','Update'),
                ['class' => $model->isNewRecord ?
                    'btn btn-success pull-right' : 'btn btn-success pull-right'])
            ?>
        </div>
  </fieldset>

    <?php ActiveForm::end(); ?>

</div>
