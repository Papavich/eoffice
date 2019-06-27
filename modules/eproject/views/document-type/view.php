<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\DocumentType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => \app\modules\eproject\controllers::t('label','Document Type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(\app\modules\eproject\controllers::t('label','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(\app\modules\eproject\controllers::t('label','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'crby',
            'udby',
            'crtime',
            'udtime',
        ],
    ]) ?>

</div>
