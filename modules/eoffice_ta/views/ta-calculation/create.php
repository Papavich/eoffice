<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaCalculation */
?>
<?php
$create = controllers::t( 'label', 'Create' );
$equation = controllers::t( 'label', 'Equation' );
$this->title = $create.$equation;
//$this->params['breadcrumbs'][] = ['label' => 'Ta Calculations', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-calculation-create">


</div>   <div id="content" class="padding-5">
    <div id="panel-1" class="panel panel-info">
        <div class="panel-heading">
                             <span class="title elipsis size-20">
                                 <strong><?= Html::encode($this->title) ?></strong><!-- panel title -->
                                   <ul class="options pull-right list-inline">
                                   <?= Html::a(Html::tag('i', '',

                                           ['class' => 'glyphicon glyphicon-share-alt']) .  '  กลับ',['index'],
                                       ['class' => 'btn btn-reveal btn-primary'])  ?>
                                </ul>
                             </span>
        </div>
        <div class="panel-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>

