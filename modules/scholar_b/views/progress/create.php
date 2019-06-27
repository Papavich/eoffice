<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbProgressReport */

$this->title = 'Create Scb Progress Report';
$this->params['breadcrumbs'][] = ['label' => 'Scb Progress Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scb-progress-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
