<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_eolmv2\models\EolmLoancontractinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eolm Loancontracts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-loancontract-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eolm Loancontract', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'eolm_app_id',
            'eolm_loa_date',
            /*'eolm_loa_use_date',
            'eolm_loa_refund_date',*/
            'eolm_loa_examiner',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
