<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Level */

// $this->title = 'Create Level';
$this->params['breadcrumbs'][] = ['label' => 'Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="level-create">
    <header id="page-header">
        <h1>สร้างอันดับรางวัล</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>
            <li><a href="#">สร้างอันดับรางวัล</a></li>
            <li class="active">อันดับรางวัล</li>
        </ol>
    </header>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
