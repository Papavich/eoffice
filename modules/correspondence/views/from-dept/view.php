<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsDocFromDept */

$this->title = $model->doc_from_dept_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms Doc From Depts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-doc-from-dept-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'doc_from_dept_id' => $model->doc_from_dept_id, 'doc_id' => $model->doc_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'doc_from_dept_id' => $model->doc_from_dept_id, 'doc_id' => $model->doc_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'doc_from_dept_id',
            'doc_from_dept_name',
            'doc_id',
        ],
    ]) ?>

</div>
