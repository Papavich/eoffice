<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaTypeRule */

$detail = controllers::t( 'label', 'Detail' );
$Rule = controllers::t( 'label', 'Type Rule' );
$this->title = $detail.$Rule;
$this->params['breadcrumbs'][] = ['label' => 'Ta Type Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-type-rule-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ta_type_rule_id',
            'ta_type_rule_name',
            'ta_type_detail',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ta_type_rule_id], ['class' => 'btn btn-primary pull-right']) ?>

    </p>

</div>
