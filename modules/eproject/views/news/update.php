<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\News */


$this->title =controllers::t( 'label', 'Update News' );
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'News' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = controllers::t( 'label', 'Modify:' );
?>
<div class="news-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
