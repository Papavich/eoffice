<?php

use yii\helpers\Html;
use app\modules\consulting\controllers;


/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultPost */

$create = controllers::t( 'label', 'ตอบกลับ');
$main_title = controllers::t('label','Create FAQ');
$title = controllers::t( 'label', 'ปัญหา');
$this->title = 'ตอบกลับปัญหา';
$this->params['breadcrumbs'][] = ['label' => 'Consult Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-post-update">

  <div class="panel-body">
<h4 class="alert alert-warning"><?= $create.$title ?> </h4>
    <?= $this->render('_form0', [
        'model' => $model,
    ]) ?>

</div>
</div>
