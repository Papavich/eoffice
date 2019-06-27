<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\PublicationsType */

$this->title = 'Create Publications Type';
$this->params['breadcrumbs'][] = ['label' => 'Publications Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publications-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
