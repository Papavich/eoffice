<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use kartik\widgets\Select2;
use app\modules\eoffice_repair\controllers;
use app\modules\eoffice_repair\models\EofficeCentrViewPisUser;
//use app\modules\personsystem\controllers\FunctionController;
use app\modules\eoffice_repair\controllers\Site2Controller;
// use kartik\widgets\DepDrop;

use yii\helpers\Url;
use yii\helpers\Json;
//use yii\bootstrap\ActiveField;

use app\modules\eoffice_repair\models\EofficeAssetViewAsset;
use app\modules\eoffice_repair\models\EofficeCentralViewPisRoom;
use app\modules\eoffice_repair\models\RepairDescription;
use app\modules\eoffice_repair\models\RepairImage;
use app\modules\eoffice_repair\models\RepairStatus;
use app\modules\eoffice_repair\models\RepairTracking;
use app\modules\eoffice_repair\models\FunDate;




$this->registerJsFile('cs-e-office/modules/eoffice_repair/assets/repair.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\Company */
/* @var $form yii\widgets\ActiveForm */

// $print = controllers::t( 'label', 'Print');
// $this->title = 'แบบฟอร์มการแจ้งซ่อม';
// $this->params['breadcrumbs'][] = $this->title;

?>
<!-- Head -->
<header id="page-header" style="margin-bottom: 20px">
    <h1>แบบฟอร์มการแจ้งซ่อม</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#">เพิ่มวัสดุ</a></li>
        <li class="active">สร้างรายการ</li>
    </ol> -->
</header>
<!-- <header id="page-header"> -->
  <!-- <h1>แบบฟอร์มการแจ้งซ่อม</h1> -->

<!-- <h1>แบบฟอร์มการแจ้งซ่อม</h1> -->



<!-- <div id="panel-1" class="panel panel-clean">
    <div class="panel panel-primary">
    <div class="panel-heading panel-heading-transparent">
      <strong>ข้อมูลผู้แจ้งซ่อม</strong>
    </div> -->

    <div id="panel-info" class="panel panel-default cs-remargin" style="margin-top: 20px">
        <div class="panel-body">
            <div class="content-info">
                <!--            <h3><i class="glyphicon glyphicon-file"></i>ทำรายการเบิกวัสดุ<span class="pull-right widen_id"><b>รหัสใบเบิกวัสดุ : </b>6589/21</span>-->
                <!--            </h3>-->
                <h3>
                    <i class="glyphicon glyphicon-user"></i>ข้อมูลผู้แจ้งซ่อม

                </h3>
              </h3>
              <span class="pull-right">

                      <span><b>วันท</b>ี่</span> : <?= date("Y-m-d"); ?>
    <br/>    <br/>

              </span>
                  <br/>    <br/>
                <div>
                    <span><b>ชื่อ-นามสกุล</b></span>     <b>:</b>   <span><?= Site2Controller::getNameuser(Yii::$app->user->identity->id).' '.Site2Controller::getLnameuser(Yii::$app->user->identity->id); ?></span>
                </div>

                <div>
                    <span><b>อีเมลล์</b></span>    <b>:</b>   <span><?= Site2Controller::getEmailuser(Yii::$app->user->identity->id) ; ?></span>
                </div>

                <div>
                    <span><b>เบอร์โทรศัพท์</b></span>  <b>:</b>   <span><?= Site2Controller::getTeluser(Yii::$app->user->identity->id) ; ?></span>
                </div>
                <br/>

            </div>

  </div>
  </div>













  <div id="panel-info" class="panel panel-primary cs-remargin" style="margin-top: 20px">
      <div class="panel-heading">
  <span class="title elipsis">

  <strong class="size-18"><i class="glyphicon glyphicon-edit"></i> ข้อมูลอุปกรณ์</strong> <!-- panel title -->
  </span>
      </div>






        <div class="panel-body">
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-4 col-sm-4">




                    <form action="">
                      <input type="radio" name="choice" value="1" checked> มีหมายเลขครุภัณฑ์
                      <input type="radio" name="choice" value="2"> ไม่มีหมายเลขครุภัณฑ์<br><br><br><br>
                    </form>
                    </div>
                  </div>
                </div>


<?php $form = ActiveForm::begin(['action'=>'form']); ?>
    <div id="show">
        <div class="row">
            <div class="form-group">
                <div class="col-md-4 col-sm-4">

                    <?=$form->field($modeldes, 'asset_detail_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(EofficeAssetViewAsset::find()->asArray()->all(),'asset_detail_id','asset_dept_code_start'),
                        'language' => 'th',
                        'options' => ['placeholder' => 'ค้นหาหมายเลขครุภัณฑ์...','id'=>'positions'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('หมายเลขครุภัณฑ์') ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($modeldes, 'asset_detail_name')->textInput(['maxlength' => true, 'id'=>'assetname','readonly'=> true])->label('ชื่อคุรุภัณฑ์') ?>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-4 col-sm-4">
                    <!-- $form->field($modeldes, 'rep_location')->textInput(['maxlength' => true,'readonly'=> true, 'id'=>'building'])->label('อาคาร')  -->
                    <?= Html::label('อาคาร', 'xxx') ?>
                    <?= Html::textInput('building', '', ['class' => 'form-control','maxlength' => true,'readonly'=> true, 'id'=>'building']); ?>
                </div>
                <div class="col-md-4 col-sm-4">
                  <?= $form->field($modeldes, 'rep_location')->textInput(['maxlength' => true,'readonly'=> true, 'id'=>'room'])->label('ห้อง') ?>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-12 col-sm-12">
                    <?= $form->field($modeldes, 'rep_desc_detail')->textarea(['rows' => '4']) ?>
                </div>
            </div>
        </div>
        <div class="form-group">
          <?= Html::submitButton($modeldes->isNewRecord ? 'ส่งข้อมูล' : 'ส่งข้อมูล', ['class' => $modeldes->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary']) ?>
        </div>
    </div>



<?php ActiveForm::end(); ?>


<?php $form = ActiveForm::begin(['action'=>'form2']); ?>
    <div id="hide">
          <div class="row">

              <div class="form-group">
                  <div class="col-md-4 col-sm-4">
                      <?= $form->field($modeldes, 'asset_detail_name')->textInput(['maxlength' => true, 'id'=>'assetname'])->label('ชื่อคุรุภัณฑ์') ?>

                  </div>
              </div>
          </div>

          <div class="row">
              <div id="hide">
                  <div class="form-group">

                      <div class="col-md-4 col-sm-4">
                          <?= $form->field($modeldes, 'rep_location')->textInput(['maxlength' => true, 'id'=>'building'])->label('สถานที่') ?>

                      </div>

                  </div>
              </div>
          </div>

          <div class="row">
              <div class="form-group">
                  <div class="col-md-12 col-sm-12">
                      <?= $form->field($modeldes, 'rep_desc_detail')->textarea(['rows' => '4']) ?>
                  </div>
              </div>
          </div>

          <div class="form-group">
            <?= Html::submitButton($modeldes->isNewRecord ? 'ส่งข้อมูล' : 'ส่งข้อมูล', ['class' => $modeldes->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary']) ?>
          </div>
      </div>




                  <?php ActiveForm::end(); ?>


                  </div>
              </div>
            </div>



<?php
     $script = <<< JS
     $('#positions').change(function(){
	var positionId = $(this).val();

	// $.get('test',{ positionId : positionId },function(data){
	// 	var data = $.parseJSON(data);
	// 	$('#assetname').attr('value',data.asset_detail_name);
	// });
$.get('get-rate',{ positionId : positionId },function(data){
  var data = $.parseJSON(data);

  $('#assetname').attr('value',data.room_type_id);
  $('#building').attr('value',data.buildings_id);
  $('#room').attr('value',data.rooms_name);
});
});
JS;
$this->registerJS($script);
?>
