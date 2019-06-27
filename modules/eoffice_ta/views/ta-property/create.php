<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaProperty */
$main_title =  controllers::t( 'label', 'Manage Property' );
$this->title = $main_title;
$create = controllers::t( 'label', 'Create');
$title = controllers::t( 'label', 'Property TA');
$back = controllers::t( 'label', 'Back');
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $create;
?>

<div class="ta-property-create">
            <div class="panel-body">
                    <h4 class="alert alert-info"><?= $create.$title ?> </h4>
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
