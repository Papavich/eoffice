<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\db\ActiveRecord;
use yii\db\QueryTrait;
use app\modules\eoffice_exam\models\ExamRoom;
use yii\grid\GridView;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_exam\models\EofficeExamEnrollSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$session = Yii::$app->session;
echo $firstDate. " to ".$seccondDate."</br>".$numberDays." days"."</br>";
 echo "<pre>"; print_r($session['date']); echo "</pre>";

 //echo $rooms_id;
 /*for ($i=0;$i<$numberDays;$i++){
     if ($session['date'][$i]==exam_enrolll_date){

 }
 }*/


//echo "<pre>"; print_r($dataProvider); echo "</pre>";

?>

<!--
<div class="exam-room-index"> -->

 <?= GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'subject_id',
        'section_no',
        'exam_enroll_seat',
        'exam_enrolll_date',


       // ['class' => 'yii\grid\ActionColumn'],
    ],
 ]); ?>
<!-- </div> -->
<?php $form = ActiveForm::begin(); ?>
<div class="panel-body">
    <div class="row">
        <div style="margin-left: 400px;">
            <?= Html::a('จัดห้องสอบ', ['viewroom'], ['class'=>'btn btn-success btn-lg','data-method' => 'post']) ?>
        </div>
<?php ActiveForm::end(); ?>