<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\AuthorLevel */

// $this->title = 'Create Author Level';
$this->params['breadcrumbs'][] = ['label' => 'Author Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-level-create">
    <header id="page-header">
        <h1>สร้างลำดับผู้เขียน</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>
            <li><a href="#">ลำดับผู้เขียน</a></li>
            <li class="active">สร้างลำดับผู้เขียน</li>
        </ol>
    </header>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
