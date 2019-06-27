<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRuleApproach */

//$this->title = 'สูตรคำนวณ: ' . $model->ta_rule_approach_id;
$edit = controllers::t( 'label', 'Edit');
$title = controllers::t( 'label', 'Rule Approaches');
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['staff/setting-calculate']];
$this->params['breadcrumbs'][] = $edit;
?>
<div class="ta-rule-approach-update">
            <div class="panel-body">
                <h4 class="alert alert-info"><?= $edit.$title.' : '.$model->ta_rule_approach_name ?></h4>
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>

