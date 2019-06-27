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
                  <h3>ระบบได้ส่งเรื่องไปยังผู้ที่มีส่วนเกี่ยวข้องเรียบร้อยแล้ว</h3>
              </div>
            </div>
      </div>
    </fieldset>
  </div>
</div>
