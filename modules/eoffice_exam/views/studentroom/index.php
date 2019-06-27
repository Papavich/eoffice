<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_exam\models\EofficeExamExaminationItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ประกาศที่นั่งสอบประจำภาคการศึกษา';
$this->params['breadcrumbs'][] = $this->title;
?>

<header id="page-header">
<h4><?= Html::encode($this->title) ?></h4>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
</header>

<div class="eoffice-exam-examination-item-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'exam_date',
            'exam_start_time',
            'exam_end_time',
            'subject_id',
            'rooms_id',
            'exam_seat',
            'STUDENTID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
