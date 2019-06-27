<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsDocSpeed */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cms Doc Speed',
]) . $model->speed_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms Doc Speeds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->speed_id, 'url' => ['view', 'id' => $model->speed_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cms-doc-speed-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
