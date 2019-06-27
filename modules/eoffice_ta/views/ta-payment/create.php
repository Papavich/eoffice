<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaPayment */

$this->title = 'Create Ta Payment';
$this->params['breadcrumbs'][] = ['label' => 'Ta Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
