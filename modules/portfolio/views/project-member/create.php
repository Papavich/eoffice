<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectOrder */

$this->title = 'Create Project Order';
$this->params['breadcrumbs'][] = ['label' => 'Project Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
