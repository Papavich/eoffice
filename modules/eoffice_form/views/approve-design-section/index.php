<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\ApproveDesignSectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Approve Design Sections';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approve-design-section-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Approve Design Section', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'approve_design_id',
            'approve_design_name',
            'approve_design_order',
            'approve_group_id',
            'section_type_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
