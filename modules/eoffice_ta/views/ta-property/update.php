<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaProperty */
$main_title = controllers::t( 'label', 'Manage Property' );
$title = controllers::t( 'label', 'Property TA' );
$this->title = $main_title;
$edit =controllers::t( 'label', 'Modify');
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $edit;
?>
<div class="ta-property-update">

            <div class="panel-body">
                <h4 class="alert alert-info"><?=$edit.' : '.$title ?> </h4>
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
