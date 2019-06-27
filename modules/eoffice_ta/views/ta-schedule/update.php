<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaSchedule */

$main_title = controllers::t('label','Manage Schedules');
$title = controllers::t( 'label', 'Schedules');
$edit = controllers::t( 'label', 'Edit');
$this->title = $main_title;
$this->params['breadcrumbs'][] = ['label' => $main_title, 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->ta_schedule_id, 'url' => ['view', 'id' => $model->ta_schedule_id]];
$this->params['breadcrumbs'][] = $edit;
$time = time();
?>
<div class="ta-schedule-update">

    <div class="panel-body">
    <h4 class="alert alert-info"><?= $edit.$title ?> : <?=$model->ta_schedule_title?></h4>
        ขณะนี้เวลา : <?= Yii::$app->formatter->asTime($time, 'medium');?><br>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
