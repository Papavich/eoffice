<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaSchedule */

$create = controllers::t( 'label', 'Create');
$main_title = controllers::t('label','Manage Schedules');
$title = controllers::t( 'label', 'Schedules');
$this->title = $main_title;
$this->params['breadcrumbs'][] = ['label' => $main_title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $create;
$time = time();
?>
<div class="ta-schedule-create">

<div class="panel-body">
    <h4 class="alert alert-info"><?= $create.$title ?> </h4>
    ขณะนี้เวลา : <?= Yii::$app->formatter->asTime($time, 'medium');?><br>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
