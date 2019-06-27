<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectMember */

$this->title = 'Create Project Member';
$this->params['breadcrumbs'][] = ['label' => 'Project Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-member-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
