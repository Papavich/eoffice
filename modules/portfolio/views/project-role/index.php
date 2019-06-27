<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\ProjectRoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Project Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-role-index">
    <header id="page-header">
        <h1>บทบาทของสมาชิกในโครงการ</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>

            <li class="active">บทบาทของสมาชิกในโครงการ</li>
        </ol>
    </header>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <center><?= Html::a('สร้างบทบาทของสมาชิกในโครงการ', ['create'], ['class' => 'btn btn-success']) ?></center>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'project_role_id',
            'project_role_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
