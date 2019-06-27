<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRuleApproach */

$create = controllers::t( 'label', 'Create');
$title = controllers::t( 'label', 'Rule Approaches');
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['staff/setting-calculate']];
$this->params['breadcrumbs'][] = $create;
?>
<div class="ta-rule-approach-create">

            <div class="panel-body">
                <h4 class="alert alert-info"><?= $create.' : '.$title ?></h4>
                    <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>

