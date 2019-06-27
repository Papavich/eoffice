<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\materialsystem\models\MatsysMaterialType */

$this->title = 'Update Matsys Material Type: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Matsys Material Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->material_type_id, 'url' => ['view', 'id' => $model->material_type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="matsys-material-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
