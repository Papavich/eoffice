<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\PublicType */

$this->title =controllers::t( 'label', 'Add Public Type' );
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Publications Type' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="public-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
