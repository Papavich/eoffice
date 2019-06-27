<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\ApproveGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Approve Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approve-group-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Approve Group', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'group_id',
            'group_name',
            'group_order',
            'template_id',
            'approve_type_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
