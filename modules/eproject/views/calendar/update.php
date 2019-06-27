<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\Calendar */


$this->title =controllers::t( 'label', 'Edit Schedule').' '. $model->detail ;
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Calendar' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->detail;
?>
<div class="calendar-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
