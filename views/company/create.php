<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\materialsystem\models\MatsysCompany */

$this->title = 'Create Matsys Company';
$this->params['breadcrumbs'][] = ['label' => 'Matsys Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matsys-company-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
