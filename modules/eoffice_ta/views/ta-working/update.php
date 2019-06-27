<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaWorking */

$title_main = 'บันทึกการปฏิบัติงาน';
$title = controllers::t( 'label', 'Working Hours');
$edit = controllers::t( 'label', 'Edit');
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => $title_main, 'url' => ['work-ta2',
    'sec' => $model->section,'s'=>$model->subject_id
    ,'t'=>$model->term_id,'y'=>$model->year_id,]];

$this->params['breadcrumbs'][] = $edit;
?>
<div class="ta-working-update">
    <div class="panel-body">
        <h4 class="alert alert-info"><?=$title?> :
            Sec.<?=$model->section?>
            วิชา : <?=$model->subject_id?> ภาคเรียน : <?=$model->term_id?>  ปีการศึกษา : <?=$model->year_id?>
        </h4>
    <?= $this->render('_form', [
        'model' => $model,'t_wload'=>$t_wload,
    ]) ?>
    </div>
</div>
