<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultPoint */

$this->title = 'Create Consult Point';
$this->params['breadcrumbs'][] = ['label' => 'Consult Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-point-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
