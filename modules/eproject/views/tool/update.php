<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\Tool */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => controllers::t('label','Tools'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="tool-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
