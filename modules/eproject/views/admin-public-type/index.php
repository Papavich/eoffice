<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eproject\models\PublicTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title =controllers::t( 'label', 'Publications Type' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="public-type-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

             'name',

            ['class' => 'yii\grid\ActionColumn', 'visibleButtons'=>[

                'view'=> false,
            ]],
        ],
    ]); ?>
    <?= Html::a('<i class="fa fa-plus-square-o"></i>'.controllers::t( 'label', 'Add' ).'', ['create'], ['class' => 'btn btn-3d btn-teal pull-right']) ?>
</div>
