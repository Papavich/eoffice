<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\models\Kku30Subject;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaWorkloadTeacher */

$wload = controllers::t('label','Workload');
$edit = controllers::t('label','Modify');
$this->title = 'แก้ไขภาระงาน';
$this->params['breadcrumbs'][] = ['label' => 'Ta Workload Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'รายละเอียด', 'url' => ['view', 'ta_wload_teacher_id' => $model->ta_wload_teacher_id, 'section' => $model->section, 'subject_id' => $model->subject_id, 'subject_version' => $model->subject_version, 'term' => $model->term, 'year' => $model->year]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-workload-teacher-update">
<div class="panel-body">
    <?php
    $subj = EofficeCentralRegCourse::findOne(['COURSECODE'=>$s,'REVISIONCODE'=>$ver]);
    ?>
    <h4 class="alert alert-info"><strong><?=$edit.$wload?> : วิชา </strong>
        <?=$subj->COURSECODE.' '.$subj->COURSENAME?>
        <strong> หน่วยกิต : </strong> <?=$subj->COURSEUNIT?>
        <strong> Section : </strong> <?=$model->section?>
        <strong>ภาคเรียน: </strong><?=$t.'/'.$y?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div>
