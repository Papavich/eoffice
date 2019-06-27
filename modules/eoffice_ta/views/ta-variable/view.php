<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\eoffice_ta\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaVariable */

//Variables Setting
$variables_setting = controllers::t( 'label', 'Variables Setting' );
$detail = controllers::t( 'label', 'Detail' );
$variables = controllers::t( 'label', 'Variable' );
$this->title = $detail.$variables;
$this->params['breadcrumbs'][] = ['label' => $variables, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-variable-view">



<div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ta_variable_id',
            'ta_variable_name',
            'ta_variable_value',
            'ta_variable_detail:ntext',
            'status',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>

        <?php
          if ($model->status== 'fig') {
              ?>
              <p>
              <?= Html::a('Update', ['update', 'id' => $model->ta_variable_id], ['class' => 'btn btn-warning pull-right']) ?>
              </p>
              <?php
          }
        ?>

</div>
</div>