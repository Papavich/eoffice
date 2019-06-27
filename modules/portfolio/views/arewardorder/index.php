<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\ArewardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Arewards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="areward-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Areward', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'areward_id',
            'areward_name',
            'date_areward',
            'level_level_id',
            'institution_ag_award_id',
            //'data_detail',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($model){
                    return Html::img('@web/web_pfo/areward/'.$model->image, ['class' => 'thumbnail', 'width'=>80]);
                }
            ],

            //'cities_id',
            //'member_member_id',
            //'std_id',
            //'person_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
