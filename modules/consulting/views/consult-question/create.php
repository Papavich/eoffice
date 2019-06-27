<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultQuestion */

$this->title = 'Create Consult Question';
$this->params['breadcrumbs'][] = ['label' => 'Consult Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
