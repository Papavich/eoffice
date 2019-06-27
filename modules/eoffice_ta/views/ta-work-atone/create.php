<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaWorkAtone */

$this->title = 'Create Ta Work Atone';
$this->params['breadcrumbs'][] = ['label' => 'Ta Work Atones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-work-atone-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
