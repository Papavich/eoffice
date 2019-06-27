<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Sponsor */

// $this->title = 'Create Sponsor';
$this->params['breadcrumbs'][] = ['label' => 'Sponsors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sponsor-create">
    <header id="page-header">
        <h1>สร้างผู้สนับสนุน</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>
            <li><a href="#">ผู้สนับสนุน</a></li>
            <li class="active">สร้างผู้สนับสนุน</li>
        </ol>
    </header>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
