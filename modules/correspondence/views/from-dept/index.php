<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cms Doc From Depts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-doc-from-dept-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cms Doc From Dept'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'doc_from_dept_id',
            'doc_from_dept_name',
            'doc_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
