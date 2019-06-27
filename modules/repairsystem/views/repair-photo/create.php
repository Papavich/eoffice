<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\RepairPhoto */

$this->title = 'Create Repair Photo';
$this->params['breadcrumbs'][] = ['label' => 'Repair Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repair-photo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
