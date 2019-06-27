<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\ProjectOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Project Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-order-index">
    <header id="page-header">
        <h1>รายละเอียดผลงานตีพิมพ์</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>

            <li class="active">รายละเอียดผลงานตีพิมพ์</li>
        </ol>
    </header>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <center><?= Html::a('สร้างรายการผลงานตีพิมพ์', ['create'], ['class' => 'btn btn-success']) ?></center>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'project_order_id',
            'project_role_project_role_id',
            'project_member_pro_member_id',
            'project_project_id',
            'person_id',
            //'sponsor_sponsor_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
