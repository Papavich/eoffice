<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eproject\models\DocumentTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =\app\modules\eproject\controllers::t('label','Document Type');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-type-index">

    <p>
        <?= Html::a(\app\modules\eproject\controllers::t('label','Create Document Type'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
