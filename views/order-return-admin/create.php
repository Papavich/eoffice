<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\materialsystem\models\MatsysOrder */

$this->title = 'Create Matsys Order';
$this->params['breadcrumbs'][] = ['label' => 'Matsys Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matsys-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
