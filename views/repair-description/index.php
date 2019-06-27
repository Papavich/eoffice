<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_repair\models\RepairDescriptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Repair Descriptions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repair-description-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Repair Description', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'rep_desc_id',
            'rep_desc_fname',
            'rep_desc_lname',
            'rep_desc_email:email',
            'rep_desc_tel',
            //'rep_desc_detail',
            //'rep_desc_cost',
            //'rep_desc_comment',
            //'rep_desc_request_date',
            //'rep_image_id',
            //'rep_status_id',
            //'rep_location',
            //'asset_detail_id',
            //'asset_detail_name',
            //'staff',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
