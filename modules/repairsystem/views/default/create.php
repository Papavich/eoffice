<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\RepDes */

$this->title = 'Create Rep Des';
$this->params['breadcrumbs'][] = ['label' => 'Rep Des', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rep-des-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formdes', [
        'model' => $model,
    ]) ?>

</div>
