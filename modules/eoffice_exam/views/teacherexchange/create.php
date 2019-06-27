<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\ExamTeacherExchange */

$this->title = 'ขอเปลี่ยนแปลงการคุมสอบ';
$this->params['breadcrumbs'][] = ['label' => 'Exam Teacher Exchanges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-teacher-exchange-create">

    <blockquote>
    <h3><?= Html::encode($this->title) ?></h3>
    </blockquote>

    <?= GridView::widget([
         'dataProvider' => $dataProvider,
         //'filterModel' => $searchModel,
         'columns' => [
             ['class' => 'yii\grid\SerialColumn'],
             ['class' => 'yii\grid\CheckboxColumn'],

             'exam_date',
             'person_id',
             'name.person_name',
             'name.person_surname',
            // 'examdate.exam_date',
             'examstart_time',
             'exam_end_time',
             'rooms_id',

             [
                        'format' => 'raw',
                        'value' => function($model, $key, $index, $column) {
                            return Html::a('แลกเปลี่ยน', ['form',
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



    <br><br>


</div>
