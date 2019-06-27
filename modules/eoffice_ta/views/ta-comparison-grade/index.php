<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaComparisonGradeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Comparison Grades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-comparison-grade-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Comparison Grade', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ta_comparison_grade_id',
            'person_id',
            'subject_id',
            'subject_version',
            'term',
            //'year',
            //'ta_status_id',
            //'grade_name',
            //'grade_value',
            //'doc_ref',
            //'crby',
            //'crtime',
            //'udby',
            //'udtime',
            //'subject_id_compar',
            //'subject_name_compar',
            //'compar_detail:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
