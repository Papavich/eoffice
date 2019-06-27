<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_eolmv2\models\EolmRepaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eolm Repays';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-repay-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eolm Repay', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'eolm_app_id',
            'eolm_repay_date',
            'eolm_repay',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
