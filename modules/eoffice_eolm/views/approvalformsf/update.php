<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmApprovalform */
use app\modules\eoffice_eolm\controllers;
$this->title = controllers::t( 'menu','Update approval form');
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'menu','Search approval form'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-approvalform-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>