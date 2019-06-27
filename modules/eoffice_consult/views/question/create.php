<?php

use yii\helpers\Html;
use app\modules\eoffice_consult\controllers;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_consult\models\ConsultPost */

$create = controllers::t( 'label', 'ประเมิน');
$main_title = controllers::t('label','Rateing');
$title = controllers::t( 'label', 'ความพึงพอใจ');
$this->title = 'ประเมิน';
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-create">

  <div class="panel-body">
<h4 class="alert alert-warning"><?= $create.$title ?> </h4>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
