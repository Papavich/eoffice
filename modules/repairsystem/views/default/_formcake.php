<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\Json;

use app\modules\repairsystem\models\Building;
use app\modules\repairsystem\models\RepDes;
use app\modules\repairsystem\models\AssetTypeDepartment;
use app\modules\repairsystem\models\Room;
use app\modules\repairsystem\models\RepairPhoto;
use app\modules\repairsystem\models\RepairStatus;




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
          
            'fname',
            'lname',
            'email:email',
            'tel',
            'rep_date',

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
          <?= $form->field($modeldes, 'asset_code')->textInput(['maxlength' => true]) ?>
</div></div></div>
<div class="row">
  <div class="form-group">

    <div class="col-md-4 col-sm-4">
          <?= $form->field($modeldes, 'asset_type_dept_id')->dropDownList(ArrayHelper::map(AssetTypeDepartment::find()->all(),'asset_type_dept_id','asset_type_dept_name'),['prompt'=>'-- เลือกชื่อครุภัณฑ์ --']) ?>
</div></div></div>
<div class="row">
  <div class="form-group">

    <div class="col-md-4 col-sm-4">
          <?= $form->field($modeldes, 'building_id')->dropDownList(ArrayHelper::map(Building::find()->all(),'building_id','building_name'),['prompt'=>'-- เลือกอาคาร --']) ?>
</div>
  <div class="col-md-4 col-sm-4">
          <?= $form->field($modeldes, 'room_id')->dropDownList(ArrayHelper::map(Room::find()->all(),'room_id','room_name'),['prompt'=>'-- เลือกห้อง --']) ?>
        </div></div></div>

          <?= $form->field($modeldes, 'rep_des_detail')->textInput(['maxlength' => true]) ?>



        <div class="form-group">
          <?= Html::submitButton($modeldes->isNewRecord ? 'ส่งข้อมูล' : 'Update', ['class' => $modeldes->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

      </div>
    </div>
</div>
