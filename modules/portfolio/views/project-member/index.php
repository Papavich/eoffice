<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\ProjectOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'project_order_id',
            'project_role_project_role_id',
            'project_member_pro_member_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
