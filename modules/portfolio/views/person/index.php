<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'People';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Person', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'person_id',
            'prefix_id',
            'person_firstname',
            'person_lastname',
            'person_date_work_start',
             'position_id',
             'department_id',
            'person_address',
             'person_tel',
            'person_picture',
             'person_work_status',
             'user_id',
             'publication_pub_id',
             'project_project_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
