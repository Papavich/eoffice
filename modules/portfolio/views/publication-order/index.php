<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\PublicationOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Publication Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Publication Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model,$key,$index,$column){
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function($model,$key,$index,$column){
                    $searchModel = new PublicationOrder();
                    $searchModel->pub_order_id  = $model->publication_pub_id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    return Yii::$app->controller->renderPartial('_spipment-details',[
                        '$searchModel' => $searchModel ,
                        'dataProvider' => $dataProvider,
                    ]);
                },

            ],

            'pub_order_id',
            'publication_pub_id',
            'author_level_auth_level_id',
            'project_member_pro_member_id',
            'publications_type_pub_type_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
