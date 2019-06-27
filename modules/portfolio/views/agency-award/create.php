<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\AgencyAward */


$this->params['breadcrumbs'][] = ['label' => 'Agency Awards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agency-award-create">
    <header id="page-header">
        <h1>สร้างหน่วยงานที่ให้รางวัล </h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>
            <li><a href="#">หน่วยงานที่ให้รางวัล</a></li>
            <li class="active">สร้างหน่วยงานที่ให้รางวัล </li>
        </ol>
    </header>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
