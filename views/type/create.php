<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\materialsystem\models\MatsysMaterialType */

$this->title = 'Create Matsys Material Type';
$this->params['breadcrumbs'][] = ['label' => 'Matsys Material Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matsys-material-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
