<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\Tool */

$this->title =controllers::t( 'label', 'Create Tools' );
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Tools' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tool-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
