<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\ProjectMemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-member-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project Member', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pro_member_id',
            'member_name',
            'member_lname',
            'project_project_id',
            'project_role_project_role_id',
            //'person_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
