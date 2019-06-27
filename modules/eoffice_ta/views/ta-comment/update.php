<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaComment */

$this->title = 'Update Ta Comment: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Ta Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ta_comment_id, 'url' => ['view', 'id' => $model->ta_comment_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-comment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
