<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\ExamTeacherExchange */
$this->title = 'แลกเปลี่ยนวันคุมสอบ';
$this->params['breadcrumbs'][] = ['label' => 'Exam Teacher Exchanges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$session = Yii::$app->session;
?>

<div class="exam-teacher-exchange-form-exhang">

  <blockquote>
  <h4><?= Html::encode($this->title) ?></h4>
  </blockquote>

  <!-- หน้าตารางวิว -->
<div class="col-sm-12 col-md-12"><br>
  <h4><span class="label label-info">ส่วนที่ 2 </span></h4>


  <?php $form = ActiveForm::begin(); ?>

    <div class="col-sm-12 col-md-12"><br>

    <label>วัน/เดือน/ปี </label>
    <input type="text" name="date" id="date" class="form-control datepicker"
    value=<?php echo $exam_date; ?> data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
    </div>

    <div class=" col-md-6"><br>
    <?= $form->field($model2, 'examstart_time')->textInput(['value'=>$examstart_time,'maxlength' => true]) ?>
    </div>
    <div class=" col-md-6"><br>
    <?= $form->field($model2, 'exam_end_time')->textInput(['value'=>$exam_end_time,'maxlength' => true]) ?>
    </div>

    <div class="col-sm-12 col-md-12">
    <?= $form->field($model, 'person_id')->textInput(['value' =>$person_id,'maxlength' => true]) ?>

    <?= $form->field($model4, 'exam_per_exchange')->textInput(['value'=> $person_id,'maxlength' => true]) ?>

    <?= $form->field($model, 'exam_exchange_status')->textInput(['value'=>"pending",'maxlength' => true]) ?>
    </div>


<div class="form-group col-sm-12 col-md-12 " style="margin-left: 400px;">
    <?= Html::a('ยืนยันการแลกเปลี่ยน', ['insertexchang'], ['class' => 'btn btn-success btn-3d' ,'data-method' => 'post']) ?>
</div>

<?php ActiveForm::end(); ?>


 </div>
