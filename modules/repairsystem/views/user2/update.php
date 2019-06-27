<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\User2 */

$this->title = 'Update User2: ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'User2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user2-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
