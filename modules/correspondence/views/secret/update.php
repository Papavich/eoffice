<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsDocSecret */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cms Doc Secret',
]) . $model->secret_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms Doc Secrets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->secret_id, 'url' => ['view', 'id' => $model->secret_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cms-doc-secret-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
