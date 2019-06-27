<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\AdvisorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Advisors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advisors-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Advisors', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'advisors_id',
            'person_id',
            'department_id',
            'prefix_id',
            'acadmic_positions_id',
            //'expertise_id',
            //'areward_order_areward_order_id',
            //'project_member_pro_member_id',
            //'publication_order_pub_order_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
