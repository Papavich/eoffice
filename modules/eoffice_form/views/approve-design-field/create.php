<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveDesignField */

$this->title = 'Create Approve Design Field';
$this->params['breadcrumbs'][] = ['label' => 'Approve Design Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approve-design-field-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
