<?php

use yii\helpers\Html;
use app\modules\eoffice_consult\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_consult\models\ConsultFaq */

// $this->title = 'Update Consult Faq: {nameAttribute}';
// $this->params['breadcrumbs'][] = ['label' => 'Consult Faqs', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->faq_id, 'url' => ['view', 'id' => $model->faq_id]];
// $this->params['breadcrumbs'][] = 'Update';

$create = controllers::t( 'label', 'จัดการ');
$main_title = controllers::t('label','Create FAQ');
$title = controllers::t( 'label', 'FAQ');
$this->title = 'จัดการ FAQ';
$this->params['breadcrumbs'][] = ['label' => 'Consult Faqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-faq-update">
    <div class="panel-body">
      <h4 class="alert alert-info"><?= $create.$title ?> </h4>
    <?= $this->render('_form0', [
        'model' => $model,
    ]) ?>
</div>
</div>
