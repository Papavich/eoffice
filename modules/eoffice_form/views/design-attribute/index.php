<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\DesignattributeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Design attributes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="design-attribute-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Design attribute', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'attribute_ref',
            'attribute_name',
            'attribute_order',
            'design_section_id',
            'attribute_function_id',
            //'attribute_type_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
