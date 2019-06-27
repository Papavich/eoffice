<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use app\modules\eoffice_ta\models\Kku30Subject;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaWorkloadTeacher */

$title = controllers::t('label','Manage Workload');
$wload = controllers::t('label','Workload');
$create = controllers::t('label','Create');
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index','s'=>$s,'ver'=>$ver,'t'=>$t,'y'=>$y]];
$this->params['breadcrumbs'][] = $create;
?>
<div class="ta-workload-teacher-create">
<div class="panel-body">
    <?php
    $subj = EofficeCentralRegCourse::findOne(['COURSECODE'=>$s,'REVISIONCODE'=>$ver]);
    ?>
    <h4 class="alert alert-info"> <strong><?=$create.$wload?></strong>
                <strong>: วิชา </strong>
                <?=$subj->COURSECODE.' '.$subj->COURSENAME?>
                <strong>หน่วยกิต : </strong> <?=$subj->COURSEUNIT?>
                <strong>Section : </strong> <?=$sec?>
                <strong>ภาคเรียน: </strong> <?=$t.'/'.$y?></h4>
    <?= $this->render('_form', [
        'model' => $model,'s'=>$s,
        'ver'=>$ver,'t'=>$t,'y'=>$y,'sec'=>$sec
    ]) ?>
</div>
</div>

