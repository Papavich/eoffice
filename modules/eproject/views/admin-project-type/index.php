<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title =controllers::t( 'label', 'Project Types' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-type-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
//            'crby',
//            'udby',
//            'crtime',
            // 'udtime',

            ['class' => 'yii\grid\ActionColumn', 'visibleButtons'=>[

                'view'=> false,
            ]],
        ],
    ]); ?>
    <p>
        <?= Html::a('<i class="fa fa-plus"></i>'.controllers::t( 'label', 'Add Project Type' ).'', ['create'], ['class' => 'btn btn-3d btn-teal pull-right']) ?>
    </p>
</div>
