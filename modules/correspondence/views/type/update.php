<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsDocType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cms Doc Type',
]) . $model->type_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms Doc Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type_id, 'url' => ['view', 'id' => $model->type_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cms-doc-type-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
