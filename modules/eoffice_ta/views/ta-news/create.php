<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaNews */

$title_main = controllers::t( 'label', 'Manage News' );
$create = controllers::t( 'label', 'Create');
$name = controllers::t( 'label', 'News');
$back = controllers::t( 'label', 'Back');
$this->title = $title_main;
$this->params['breadcrumbs'][] = ['label' => $title_main, 'url' => ['index']];
$this->params['breadcrumbs'][] = $create;
?>
<div class="ta-news-create">

    <div class="ta-property-create">
            <div class="panel-body">
                <h4 class="alert alert-info"><?= Html::encode($this->title) ?> : <?=$name?></h4>
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
        </div>
    </div>