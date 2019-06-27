<?php

use yii\helpers\Html;
use app\modules\eoffice_consult\controllers;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_consult\models\ConsultPost */

$create = controllers::t( 'label', 'ปรึกษา');
$main_title = controllers::t('label','Create FAQ');
$title = controllers::t( 'label', 'ปัญหา');
$this->title = 'ปรึกษาปัญหา';
$this->params['breadcrumbs'][] = ['label' => 'Consult Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="consult-post-create">

      <div class="panel-body">
    <h4 class="alert alert-warning"><?= $create.$title ?> </h4>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
