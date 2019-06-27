<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\Theory */

$this->title =controllers::t( 'label', 'Create Theory' );
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Theory' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="theory-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
