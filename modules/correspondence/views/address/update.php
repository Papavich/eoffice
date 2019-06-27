<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsAddress */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Cms Doc To Dept',
    ]) . $model->address_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms Doc To Depts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->address_id, 'url' => ['view', 'sub_type_id' => $model->address_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cms-doc-to-dept-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
