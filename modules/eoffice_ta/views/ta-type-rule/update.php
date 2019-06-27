<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaTypeRule */

$type_rule = controllers::t( 'label', 'Type Rule');
$update = controllers::t( 'label', 'Modify');
$this->title = $update.$type_rule .' : '.$model->ta_type_rule_name;


?>
<div class="ta-type-rule-update">

    <div class="panel-body">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>