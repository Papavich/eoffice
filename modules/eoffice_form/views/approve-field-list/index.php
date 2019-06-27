<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\ApproveFieldListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Approve Field Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approve-field-list-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Approve Field List', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'approve_field_list_id',
            'approve_field_list_name',
            'approve_field_list_order',
            'approve_field_ref',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
