<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaWorkAtoneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Work Atones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-work-atone-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Work Atone', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ta_work_atone_id',
            'ta_work_plan_id',
            'atone_date',
            'atone_note',
            'ta_status_id',
            // 'crby',
            // 'crtime',
            // 'udby',
            // 'udtime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
