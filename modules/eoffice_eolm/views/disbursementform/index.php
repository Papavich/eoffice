<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_eolm\models\EolmDisbursementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eolm Disbursementforms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-disbursementform-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eolm Disbursementform', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'eolm_app_id',
            'eolm_dis_date',
            'eolm_dis_go_from',
            'eolm_dis_go_date',
            'eolm_dis_go_time',
            //'eolm_dis_back_to',
            //'eolm_dis_back_date',
            //'eolm_dis_back_time',
            //'eolm_dis_disburse_for',
            //'eolm_dis_allowance_type',
            //'eolm_dis_allowance_day',
            //'eolm_dis_hotal_type',
            //'eolm_dis_hotal_day',
            //'eolm_vehicletype',
            //'eolm_dis_vehicle_cost',
            //'eolm_dis_other_expenses',
            //'eolm_dis_other_expenses_cost',
            //'eolm_attach_doc_count',
            //'crby',
            //'crtime',
            //'udby',
            //'udtime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
