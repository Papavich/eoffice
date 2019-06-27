<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reg Studentbios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-studentbio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Reg Studentbio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'STUDENTBIO',
            'STUDENTID',
            'NATIONID',
            'RELIGIONID',
            'SCHOOLID',
            // 'ENTRYTYPE',
            // 'ENTRYDEGREE',
            // 'BIRTHDATE',
            // 'STUDENTFATHERNAME',
            // 'STUDENTMOTHERNAME',
            // 'STUDENTSEX',
            // 'ADMITACADYEAR',
            // 'ADMITSEMESTER',
            // 'ENTRYGPA',
            // 'CITIZENID',
            // 'PARENTNAME',
            // 'PARENTRELATION',
            // 'CONTACTPERSON',
            // 'STUDENTMOBILE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
