<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title =controllers::t( 'label', 'Add News' );
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'News' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
