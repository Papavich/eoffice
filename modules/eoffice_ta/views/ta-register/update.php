<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRegister */


$edit = controllers::t( 'label', 'Update');
$main_title = controllers::t('label','Register TA');
$title = controllers::t( 'label', 'Update Register');
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => $main_title, 'url' => ['index']];

$this->params['breadcrumbs'][] = ['label' => $model->subject_id, 'url' => ['view', 'subject_id' => $model->subject_id, 'person_id' => $model->person_id, 'term' => $model->term, 'year' => $model->year]];
$this->params['breadcrumbs'][] = $title;
?>
<div class="ta-register-update">


    <div class="panel-body">
        <h4 class="alert alert-info"><?= $title ?> &nbsp;  วิชา<?= $id?> ภาคเรียนที่ <?=$t?> ปีการศึกษา <?=$y?></h4>


        <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
