<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbConditionHasStudent */

$this->title = 'Create Scb Condition Has Student';
$this->params['breadcrumbs'][] = ['label' => 'Scb Condition Has Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scb-condition-has-student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
