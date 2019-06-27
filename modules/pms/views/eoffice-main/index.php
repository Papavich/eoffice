<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pms\models\model_main\Serach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eoffice Mains';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-main-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eoffice Main', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'STUDENTID',
            'STUDENTCODE',
            'STUDENTNAME',
            'STUDENTSURNAME',
            'STUDENTNAMEENG',
            //'STUDENTSURNAMEENG',
            //'LEVELNAME',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
