<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsInboxLabel */

$this->title = 'Update Cms Inbox Label: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Cms Inbox Labels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->inbox_label_id, 'url' => ['view', 'inbox_label_id' => $model->inbox_label_id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cms-inbox-label-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
