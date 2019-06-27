<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\eoffice_consult\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_consult\models\ConsultFaq */
//$create = controllers::t( 'label', 'ดู');
$main_title = controllers::t('label','Create FAQ');
$title = controllers::t( 'label', 'FAQ');
$this->title = 'สร้าง FAQ';
$this->params['breadcrumbs'][] = ['label' => 'Consult Faqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-faq-view">
  <div class="panel-body">
    <h4 class="alert alert-info"><?=$title ?> </h4>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'faq_id',
            'faq_ark',
            'faq_ans:ntext',
            'faq_crby',
            'faq_crtime',
            'faq_upby',
            'faq_uptime',
            //'user_id',
        ],
    ]) ?>
</div>
</div>
