<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eproject\models\ToolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = controllers::t( 'label', 'Tools' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tool-index">



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'name',


            ['class' => 'yii\grid\ActionColumn','template' => '{update} {delete}',],
        ],
    ]); ?>
    <p>
        <?= Html::a('<i class="fa fa-plus"></i>'.controllers::t( 'label', 'Create Tools' ).'', ['create'], ['class' => 'btn btn-3d btn-teal pull-right']) ?>
    </p></div>
