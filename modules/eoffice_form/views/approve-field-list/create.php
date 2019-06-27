<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveFieldList */

$this->title = 'Create Approve Field List';
$this->params['breadcrumbs'][] = ['label' => 'Approve Field Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approve-field-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
