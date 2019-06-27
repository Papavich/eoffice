<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaTypeRule */

$this->title = 'Create Ta Type Rule';
//$this->params['breadcrumbs'][] = ['label' => 'Ta Type Rules', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-type-rule-create">



            <div class="panel-body">

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>

