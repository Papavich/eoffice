<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRequest */

$req = controllers::t( 'label', 'Request');
$title = controllers::t( 'label', 'Request TA');
$edit = controllers::t( 'label', 'Edit');
$this->title = 'แก้ไขการ'.$title;
//$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['teacher/request-ta']];
$this->params['breadcrumbs'][] = $edit;
?>
<div class="ta-request-update">
    <div class="panel-body">
        <h4 class="alert alert-info">แก้ไขการ<?= $title ?> วิชา <?=$model->subject_id?></h4>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
