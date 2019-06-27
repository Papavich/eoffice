<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmHotel */

use app\modules\eoffice_eolm\controllers;
$this->title = controllers::t( 'menu','Update a accommodation');
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'menu','Search accommodation'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-hotel-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
