<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\ProjectMemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="#"></i> รายการครุภัณฑ์
    </div>

    <div class="panel-body">

        <div class="row">
            <div class="col-md-12 col-sm-12">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

        <?php echo Html::a('เพิ่มรายการครุภัณฑ์', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'project_id',
            'project_name_thai',
            'project_name_eng',
            'budget',
            'sponsor_sponsor_id',
            //'project_start',
            //'project_end',
            //'project_duration',
            //'project_budget',
            //'repayment',
            //'project_url:url',
            //'year_start',
            //'year_end',
            //'website',
            //'participation_project_participation_project_id',
            //'advisors_advisors_id',
            //'institution_ag_award_id',
            'pro_member_id',
            'member_name',
            'project_role_id',
            'member_lname',
            'person_person_id',
            //'project_project_id',
            'score',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div></div></div></div>
