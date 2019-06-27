<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ArewardOrder */

$this->title = 'Create Areward Order';
$this->params['breadcrumbs'][] = ['label' => 'Areward Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="areward-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
