<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title =controllers::t( 'label', 'Edit' ).' '. $model->title;
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Document' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
?>
<div class="news-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
