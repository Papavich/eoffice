<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaVariable */

$variables = controllers::t( 'label', 'Variables Setting' );
$update = controllers::t( 'label', 'Modify' );
$variable = controllers::t( 'label', 'Variable' );
$detail = controllers::t( 'label', 'Detail' );
$this->title = $update.$variable.' : '.$model->ta_variable_name;
$this->params['breadcrumbs'][] = ['label' => $variables, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $detail, 'url' => ['view', 'id' => $model->ta_variable_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-variable-update">

<div class="panel-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
