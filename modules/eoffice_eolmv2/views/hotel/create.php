<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmHotel */

use app\modules\eoffice_eolmv2\controllers;
$this->title = controllers::t( 'menu','Create a accommodation');
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'menu','Search accommodation'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-hotel-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
