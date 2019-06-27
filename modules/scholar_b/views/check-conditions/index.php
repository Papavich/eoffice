<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\scholar_b\models\ScbConditionHasStudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scb Condition Has Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scb-condition-has-student-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Scb Condition Has Student', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'condi_id',
            'scholarship_id',
            'scholarship_year',
            'student_id',
            'condition_pass',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
