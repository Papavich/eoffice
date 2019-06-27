<?php

use yii\helpers\Html;
use app\modules\consulting\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultFaq */
$create = controllers::t( 'label', 'สร้าง');
$main_title = controllers::t('label','Create FAQ');
$title = controllers::t( 'label', 'FAQ');
$this->title = 'สร้าง FAQ';
$this->params['breadcrumbs'][] = ['label' => 'Consult Faqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="consult-faq-create">
  <div class="panel-body">
    <h4 class="alert alert-info"><?= $create.$title ?> </h4>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
