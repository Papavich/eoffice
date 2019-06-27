<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaRequest0Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'person_id',
            'subject_id',
            'term_id',
            'year',
            'degree_bachelor',
            //'degree_master',
            //'degree_doctorate',
            //'amount_ta_all',
            //'request_note',
            //'property_grade',
            //'property_text',
            //'ta_type_work_id',
            //'ta_status_id',
            //'crby',
            //'crtime',
            //'udby',
            //'udtime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
