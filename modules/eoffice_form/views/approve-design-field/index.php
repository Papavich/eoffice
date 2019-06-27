<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\ApproveDesignFieldSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Approve Design Fields';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approve-design-field-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Approve Design Field', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'approve_field_ref',
            'approve_field_name',
            'approve_field_order',
            'approve_design_id',
            'attribute_type_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
