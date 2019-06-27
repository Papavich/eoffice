<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_exam\models\EofficeExamEnrollSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eoffice Exam Enrolls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-exam-enroll-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eoffice Exam Enroll', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'section_no',
            'subject_id',
            'subject_version',
            'subopen_semester',
            'subopen_year',
            //'program_id',
            //'program_class',
            //'teacher_id',
            //'section_size',
            //'exam_enroll_seat',
            //'exam_enroll_start_time',
            //'exam_enroll_end_time',
            //'exam_enrolll_date',
            //'LEVELID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
