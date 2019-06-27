<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_repair\models\RepairDescription */

$this->title = 'Create Repair Description';
$this->params['breadcrumbs'][] = ['label' => 'Repair Descriptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repair-description-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
