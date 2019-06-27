<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaEquation */


$title = controllers::t( 'label', 'Equation Create');
$set_equation = controllers::t( 'label', 'Equation Setting');

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => $set_equation, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-equation-create">
<div class="panel-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
