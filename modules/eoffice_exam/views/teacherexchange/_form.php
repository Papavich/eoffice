<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamInvigilate */

$this->title = 'ฟอร์มขอแลกเปลี่ยนวันคุมสอบ';

?>
<div class="exam-teacher-exchange-form">


    <div class="col-sm-12 col-md-12"><br>
      <center><h3><?= Html::encode($this->title) ?></h3></center>

      <h4><span class="label label-default">ส่วนที่ 1 </span></h4>
      <span class="label label-warning"><ins>หมายเหตุ</ins> หากท่านมีความประสงค์ขอแลกเปลี่ยนการคุมสอบ
        กรุณากรอกข้อมูลให้ครบตามแบบฟอร์มด้านล่าง ในส่วนที่ 2 เพื่อทำการแลกเปลี่ยนการคุมสอบ</span>
    </div>

      <?php $form = ActiveForm::begin(); ?>

        <div class="col-sm-12 col-md-12"><br>

        <label>วัน/เดือน/ปี </label>
        <input type="text" name="date" id="date" class="form-control datepicker"
        value=<?php echo $exam_date; ?> data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
        </div>

        <div class=" col-md-6"><br>
        <?= $form->field($model, 'examstart_time')->textInput(['value'=>$examstart_time,'maxlength' => true]) ?>
        </div>
        <div class=" col-md-6"><br>
        <?= $form->field($model, 'exam_end_time')->textInput(['value'=>$exam_end_time,'maxlength' => true]) ?>
        </div>

        <div class="col-sm-12 col-md-12">
        <?= $form->field($model, 'person_id')->textInput(['value' => $person_id]) ?>

        <?= $form->field($model, 'rooms_id')->textInput(['value'=>$rooms_id,'maxlength' => true]) ?>
        </div>


      <div class="col-sm-6 col-md-6">
        <h4><span class="label label-default">ส่วนที่ 2 </span></h4><br>

        <?= $form->field($model2, 'exam_type_namethai')->dropDownList(
          ['' => '--กรุณาเลือกประเภทการสอบ--', 'สอบกลางภาค' => 'สอบกลางภาค', 'สอบปลายภาค' => 'สอบปลายภาค']);?>
      </div>
      <div class="col-sm-6 col-md-6"><br><br><br>
        <?= $form->field($model2, 'subopen_year')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-sm-12 col-md-12">
        <?= $form->field($model2, 'subopen_semester')->dropDownList(['' => '--กรุณาเลือกภาคการศึกษา--', '1' => 'ต้น', '2' => 'ปลาย']);?>
      </div>

      <div class="col-sm-12 col-md-12">
      <?= $form->field($model2, 'eaxm_exchange_tel')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model2, 'exam_exchange_note')->textarea(['maxlength' => 300, 'rows' => 6, 'cols' => 50]) ?>
      </div>

    <div class="form-group col-sm-12 col-md-12 " style="margin-left: 400px;">
        <?= Html::a('ยืนยันการแลกเปลี่ยน', ['insert'], ['class' => 'btn btn-success btn-3d' ,'data-method' => 'post']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
