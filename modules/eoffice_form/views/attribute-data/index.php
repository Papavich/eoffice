<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\AttributeDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attribute Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Attribute Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'attribute_data_id',
            'attribute_data',
            'attribute_order',
            'attribute_ref',
            'design_section_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
