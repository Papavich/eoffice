<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Areward */

// $this->title = 'Create Areward';
$this->params['breadcrumbs'][] = ['label' => 'Arewards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="areward-create">
    <header id="page-header">
        <h1>สร้างรางวัล</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>
            <li><a href="#">รางวัล</a></li>
            <li class="active">สร้างรางวัล</li>
        </ol>
    </header>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'persons' => $persons,
        'stds' => $stds,

    ]) ?>

</div>
