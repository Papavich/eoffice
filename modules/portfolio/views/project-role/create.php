<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectRole */

// $this->title = 'Create Project Role';
$this->params['breadcrumbs'][] = ['label' => 'Project Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-role-create">
    <header id="page-header">
        <h1>สร้างบทบาทของสมาชิกในโครงการ</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>
            <li><a href="#">บทบาทของสมาชิกในโครงการ</a></li>
            <li class="active">สร้างบทบาทของสมาชิกในโครงการ</li>
        </ol>
    </header>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
