<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\ExamTeacherExchange */
$this->title = 'ขอแลกเปลี่ยนวันคุมสอบ';
$this->params['breadcrumbs'][] = ['label' => 'Exam Teacher Exchanges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="exam-teacher-exchange-selectdate">

  <blockquote>
  <h3><?= Html::encode($this->title) ?></h3>
  </blockquote>

  <!-- หน้าตารางวิว -->
  <div class="col-sm-12 col-md-12"><br>
      <p>ส่วนที่ 1 เลือกวันที่ต้องการเปลี่ยนการคุมสอบ</p>


      <?php $form = ActiveForm::begin(); ?>

        <div class="col-sm-12 col-md-12"><br>

        <label>วัน/เดือน/ปี </label>
        <input type="text" name="date" id="date" class="form-control datepicker"
        value=<?php echo $exam_exchange_date; ?> data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
        </div>

        <div class=" col-md-6"><br>
        <?= $form->field($model, 'exam_exchange_start_time')->textInput(['value'=>$exam_exchange_start_time,'maxlength' => true]) ?>
        </div>
        <div class=" col-md-6"><br>
        <?= $form->field($model, 'exam_exchange_end_time')->textInput(['value'=>$exam_exchange_end_time,'maxlength' => true]) ?>
        </div>

        <div class="col-sm-12 col-md-12">
        <?= $form->field($model, 'person_id')->textInput(['value' => $person_id]) ?>

        <?= $form->field($model, 'rooms_id')->textInput(['value'=>$rooms_id,'maxlength' => true]) ?>
        <?= $form->field($model, 'exam_per_exchange')->textInput(['value'=>Yii::$app->user->identity->person_id])?>

        </div>


      <div class="col-sm-6 col-md-6">
        <h4><span class="label label-default">ส่วนที่ 2 </span></h4><br>
        <?= $form->field($model, 'exam_exchange_note')->textInput(['value'=>$exam_exchange_note,'maxlength' => true])?>
        <?= $form->field($model, 'exam_type_namethai')->textInput(['value'=>$exam_type_namethai,'maxlength' => true])?>
      </div>
      <div class="col-sm-6 col-md-6"><br><br><br>
        <?= $form->field($model, 'subopen_year')->textInput(['value' =>$subopen_year, 'maxlength' => true]) ?>
      </div>

      <div class="col-sm-12 col-md-12">
        <?= $form->field($model, 'subopen_semester')->textInput(['value'=>$subopen_semester,'maxlength' => true])?>
      </div>

      <div class="col-sm-12 col-md-12">
      <?= $form->field($model, 'eaxm_exchange_tel')->textInput(['value'=>$eaxm_exchange_tel,'maxlength' => true]) ?>



    <div class="form-group col-sm-12 col-md-12 " style="margin-left: 400px;">
        <?= Html::a('ยืนยันการแลกเปลี่ยน', ['insert'], ['class' => 'btn btn-success btn-3d' ,'data-method' => 'post']) ?>
    </div>

    <?php ActiveForm::end(); ?>

 </div>
