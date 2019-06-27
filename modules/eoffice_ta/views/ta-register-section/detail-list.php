<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaRegisterSectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Register Sections';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-register-section-index">

    <div class="panel-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Register Section', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'section',
            'ta_type_work_id',
            'subject_id',
            //'subject_version',
            //'person_id',
            'term',
            //'year',
            'ta_status',
            //'ta_payment_sec',
            //'ta_pay_max_sec',
            //'crby',
            //'crtime',
            //'udby',
            //'udtime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
</div>
