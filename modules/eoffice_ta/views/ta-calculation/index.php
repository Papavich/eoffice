<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\eoffice_ta\models\TaRuleApproach;
use yii\widgets\Menu;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaCalculationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Calculations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-calculation-index">


    <div class="panel-body">
    <div class="navbar navbar-default">
        <div class="navbar-header">
    <?= Menu::widget([
        'items' => [
            ['label' => 'ตั้งค่าสูตรคำนวณ', 'url' => ['site/index']],
            ['label' => 'ตั้งค่าสมการ', 'url' => ['ta-calculation/index']],
            ['label' => 'ตั้งค่าประเภทสูตร', 'url' => ['ta-type-rule/index']],
            ['label' => 'ตั้งค่าตัวแปร', 'url' => ['ta-variable/index']],
            ['label' => 'ตั้งค่าเครื่องหมาย', 'url' => ['ta-operator/index']],
        ],
        'options' => [
            'class' => 'navbar-nav nav',
            'id'=>'navbar-id',
            'style'=>'font-size: 14px;',
            'data-tag'=>'yii2-menu',
        ],
    ]);
    ?>
        </div></div>

    <?php
   /*  $model = TaRuleApproach::find()->all();
    foreach ($model as $item){
      $id =   $item->ta_rule_approach_id
        ?>
        <?php
        echo Menu::widget([
            'items' => [
                ['label' => $item->ta_rule_approach_name, 'url' => ['index', ['model' => $id]]],
            ],
            'options' => [
                'class' => 'navbar-nav nav',
                'id'=>'navbar-id',
                'style'=>'font-size: 14px;',
                'data-tag'=>'yii2-menu',
            ],
        ]);
   */
        ?>
    <?php  //}?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Calculation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'ta_calculate_id',
            'symbol',
            'symbol_value',
            'status_symbol',
            'ta_rule_id',
            //'order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
 </div>
</div>
