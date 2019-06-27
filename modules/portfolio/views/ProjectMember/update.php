<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectMember */

$this->title = 'Update Project Member: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Project Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pro_member_id, 'url' => ['view', 'id' => $model->pro_member_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-member-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
