<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_materialsys\models\MatsysMaterial */

$this->title = 'Create Matsys Material';
$this->params['breadcrumbs'][] = ['label' => 'Matsys Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matsys-material-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
