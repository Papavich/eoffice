<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultTopic */

$this->title = 'Create Consult Topic';
$this->params['breadcrumbs'][] = ['label' => 'Consult Topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-topic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
