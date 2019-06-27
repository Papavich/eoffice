<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_materialsys\models\MatsysBillDetail */

$this->title = 'Create Matsys Bill Detail';
$this->params['breadcrumbs'][] = ['label' => 'Matsys Bill Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matsys-bill-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
