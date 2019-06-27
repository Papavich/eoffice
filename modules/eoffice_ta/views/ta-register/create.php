<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRegister */

$create = controllers::t( 'label', 'Create');
$main_title = controllers::t('label','Register TA');
$title = controllers::t( 'label', 'Register');
$this->title = $main_title;
$this->params['breadcrumbs'][] = ['label' => $main_title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $title ;
?>
<div class="ta-register-create">

    <div class="panel-body">
    <h4 class="alert alert-info"><?= $main_title ?> &nbsp;  วิชา<?= $id?> ภาคเรียนที่ <?=$t?> ปีการศึกษา <?=$y?></h4>

    <?= $this->render('_form', [
        'model' => $model,
        'id'=>$id,
        't'=>$t,
        'y'=>$y,
    ]) ?>
    </div>

</div>
