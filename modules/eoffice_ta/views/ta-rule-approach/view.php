<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRuleApproach */

$this->title = $model->ta_rule_approach_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Rule Approaches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-rule-approach-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ta_rule_approach_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ta_rule_approach_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ta_rule_approach_id',
            'ta_rule_approach_name',
            'ta_rule_approach_detail',
            'ta_type_rule_id',
            'active_statuss',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>

</div>
