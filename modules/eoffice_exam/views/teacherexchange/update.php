<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\ExamTeacherExchange */

$this->title = 'แลกเปลี่ยนวันคุมสอบ';
$this->params['breadcrumbs'][] = ['label' => 'Exam Teacher Exchanges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->exam_exchange_date, 'url' => ['view', 'exam_exchange_date' => $model->exam_exchange_date, 'exam_exchange_start_time' => $model->exam_exchange_start_time, 'exam_exchange_end_time' => $model->exam_exchange_end_time, 'person_id' => $model->person_id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<?php   $session = Yii::$app->session;

?>
<div class="exam-teacher-exchange-update">


      <blockquote><h3><?= Html::encode($this->title) ?></h3></blockquote>
          <h4><span class="label label-default">ส่วนที่ 1 กรุณาเลือกวันที่ต้องการแลกเปลี่ยน</span></h4><br><br>

  <?= GridView::widget([
       'dataProvider' => $dataProvider,
           //'filterModel' => $searchModel,
       'columns' => [
           ['class' => 'yii\grid\SerialColumn'],
           //['class' => 'yii\grid\CheckboxColumn'],

           'exam_date',
           //'person_id',
           // 'examdate.exam_date',
           'examstart_time',
           'exam_end_time',
           'rooms_id',
           'name.person_name',
           'surname.person_surname',
           //'exam_per_exchange',
           [
                      'format' => 'raw',
                      'value' => function($model, $key, $index, $column) {
                          return Html::a('แลกเปลี่ยน', ['test',
                              'exam_date' => $model->exam_date,
                              'person_id' => $model->person_id,
                              'examstart_time' => $model->examstart_time,
                              'exam_end_time' => $model->exam_end_time,
                              'rooms_id' => $model->rooms_id,
                              ['class'=>'']]
                            );
                      },
                  ]],

   ]); ?>



</div>
