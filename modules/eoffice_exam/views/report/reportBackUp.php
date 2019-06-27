<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;

?>

<div id="panel-1" class="panel panel-default">
    <div class="panel-heading">
      <span class="title elipsis">
        <strong class="size-20">การจัดทำรายงาน</strong> <!-- panel title -->
      </span>


    </div>
    <?php $form = ActiveForm::begin(); ?>
    <!-- panel content -->
    <div class="panel-body">
          <strong>ประเภทรายงาน</strong>
          <div class="fancy-form fancy-form-select">
	           <select class="form-control">
		             <option value="">---เลือกประเภทรายงาน ---</option>
		             <option value="1">รายงานนักศึกษา</option>
		             <option value="2">รายงานห้องสอบ</option>
		             <option value="3">รายงานกรรมการคุมสอบ</option>
             </select>
             <i class="fancy-arrow"></i>
          </div>



          <div class="row">
            <div class="col-md-6">
          <div class="form-group">

              <?=$form->field($model, 'subject_id')->widget(Select2::classname(), [
                  'data' => ArrayHelper::map(app\modules\eoffice_exam\models\SubjectOpen::find()->asArray()->all(),'subject_id','subject_id'),
                  'language' => 'th',
                  'options' => ['placeholder' => 'ค้นหารหัสวิชา...','id'=>'subject_id'],
                  'pluginOptions' => [
                      'allowClear' => true,
                      'class' => 'form-control'
                  ],
              ])->label('รหัสวิชา') ?>

           </div>
         </div>


         <div class="row">
           <div class="col-md-6">
           <div class="form-group">
          <?= $form->field($model2, 'subject_namethai')->textInput(['maxlength' => true, 'id'=>'subname'])->label('ชื่อวิชา') ?>
          </div>
        </div>
        </div>
          <div style="padding-left: 18px;" >
          <strong>เลือกวันที่จัดห้องสอบ</strong><br/>
             <input type="text" class="form-control datepicker"  data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
          </div>
    <br/>
    </div>

  <div class="col-md-12" style="padding-left: 45%;">
      <?= Html::a('สร้างรายงาน', ['excel-room'], ['class' => 'btn btn-success']) ?>
</div>
        <?php ActiveForm::end(); ?>
    </body>

    </div>
</div>

<?php
$script = <<< JS
$('#subject_id').change(function(){
var subject = $(this).val();
$.get('get-rate',{ subject : subject },function(data){
var data = $.parseJSON(data);
$('#subname').attr('value',data.subject_namethai);
    });
 });
JS;
$this->registerJS($script);
?>