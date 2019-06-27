<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\materialsystem\models\MatsysLocation */

$this->title = 'Create Matsys Location';
$this->params['breadcrumbs'][] = ['label' => 'Matsys Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matsys-location-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
