<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRequest*/


$label_req = controllers::t( 'label', 'Request');
$title = controllers::t( 'label', 'Request TA');
$create = controllers::t( 'label', 'Create');
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['teacher/request-ta']];
$this->params['breadcrumbs'][] = $create;
?>
<div class="ta-request-create">

    <div class="panel-body">
        <h4 class="alert alert-info"><?= $title ?> วิชา <?=$s_id?> ภาคเรียนที่ <?=$t?> ปีการศึกษา <?=$y?></h4>
    <?= $this->render('_form', [
        'model' => $model,
        's'=>$s_id,'t'=>$t,'y'=>$y,
    ]) ?>
    </div>
</div>
