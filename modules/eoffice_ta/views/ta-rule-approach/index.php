<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaRuleApproachSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Rule Approaches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-rule-approach-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Rule Approach', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ta_rule_approach_id',
            'ta_rule_approach_name',
            'ta_rule_approach_detail',
            'ta_type_rule_id',
            'active_statuss',
            // 'crby',
            // 'crtime',
            // 'udby',
            // 'udtime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
