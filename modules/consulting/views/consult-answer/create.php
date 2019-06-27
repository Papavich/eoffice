<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultAnswer */

$this->title = 'Create Consult Answer';
$this->params['breadcrumbs'][] = ['label' => 'Consult Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
