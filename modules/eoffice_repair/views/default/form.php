<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use kartik\widgets\Select2;


// use kartik\widgets\DepDrop;

use yii\helpers\Url;
use yii\helpers\Json;
//use yii\bootstrap\ActiveField;

use app\modules\eoffice_repair\models\EofficeAssetViewAsset;
// use app\modules\eoffice_repair\models\EofficeMainViewPisPerson;
use app\modules\eoffice_repair\models\EofficeCentralViewPisRoom;
use app\modules\eoffice_repair\models\RepairDescription;
use app\modules\eoffice_repair\models\RepairImage;
use app\modules\eoffice_repair\models\RepairStatus;
use app\modules\eoffice_repair\models\RepairTracking;




// $this->registerJsFile('@path_assetmodule/repair.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<header id="page-header">
  <h1>แบบฟอร์มการแจ้งซ่อม</h1>

</header>
</div>
<div>
  <?php $form = ActiveForm::begin(); ?>

  <div class="panel panel-primary">
    <div class="panel-heading panel-heading-transparent">
      <strong>ข้อมูลผู้แจ้งซ่อม</strong>
    </div>

    <?= DetailView::widget([
      'model' => $modeldes,
      'attributes' => [

        // 'fname',
        // 'lname',
        [
          'attribute'=>'rep_desc_fname',

          'value'=>function($model){
            return $model->rep_desc_fname.' '.$model->rep_desc_lname;
          }
        ],

        'rep_desc_email',
        'rep_desc_tel',
      //  'rep_desc_request_date',

      ],
      ]) ?>

    </div>




    <div class="panel panel-primary">
      <div class="panel-heading panel-heading-transparent">
        <strong>ข้อมูลอุปกรณ์</strong>
      </div>




      <div class="panel-body">


        <div class="row">
          <div class="form-group">
            <div class="col-md-4 col-sm-4">


            </div>
          </div>
        </div>


        <?= $form->field(modeldes, "[{$RepairDescription}]rep_location")->dropDownList(ArrayHelper::map(EofficeCentralViewPisRoom::find()->groupBy('buildings_id')->all(), 'rooms_id', 'buildings_id'),['prompt'=>'เลือกอาคาร']) ?>
    </div>
    <div class="col-md-6 col-sm-6">
        <?= $form->field(modeldes, "[{$RepairDescription}]rep_location")->dropDownList(ArrayHelper::map(EofficeCentralViewPisRoom::find()->all(), 'rooms_id', 'rooms_name'),['prompt'=>'เลือกห้อง/สถานที่']) ?>
    </div>

        <?= $form->field($modeldes, 'rep_desc_detail')->textarea(['rows' => '4']) ?>


        <div class="form-group">
          <?= Html::submitButton($modeldes->isNewRecord ? 'ส่งข้อมูล' : 'ส่งข้อมูล', ['class' => $modeldes->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

      </div>
    </div>
  </div>
</div>
