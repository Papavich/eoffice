<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaEquation */

$edit = controllers::t( 'label', 'Edit');
$detail = controllers::t( 'label', 'Detail');
$EQ_edit = controllers::t( 'label', 'Equation Modify');
$set_equation = controllers::t( 'label', 'Equation Setting');
$this->title = $EQ_edit;
$this->params['breadcrumbs'][] = ['label' => $set_equation, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $detail,'url' => ['view', 'id' => $model->ta_equation_id]];
$this->params['breadcrumbs'][] = $edit;
?>
<div class="ta-equation-update">

    <div class="panel-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
