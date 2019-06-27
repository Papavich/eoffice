<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaVariable */



$create = controllers::t( 'label', 'Create' );
$variable = controllers::t( 'label', 'Variable' );
$this->title = $create.$variable;
$this->params['breadcrumbs'][] = ['label' => 'Ta Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-variable-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
