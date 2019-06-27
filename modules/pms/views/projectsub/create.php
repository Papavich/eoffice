<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\pms\models\PmsProjectSub */

$this->title = 'Create Pms Project Sub';
$this->params['breadcrumbs'][] = ['label' => 'Pms Project Subs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pms-project-sub-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
