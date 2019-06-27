<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaEquation */

$this->title = 'รายละเอียดสูตรคำนวณ';
$this->params['breadcrumbs'][] = ['label' => 'Ta Equations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-equation-view">
    <div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ta_equation_id',
            'ta_equation_name',
            'ta_equation_detail:ntext',
            'ans',
            'ta_type_rule_id',
            'active_status',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ta_equation_id], ['class' => 'btn btn-primary pull-right']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ta_equation_id], [
            'class' => 'btn btn-danger pull-right',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    </div>
</div>
