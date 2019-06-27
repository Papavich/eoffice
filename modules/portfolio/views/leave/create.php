<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Leave */

$this->title = 'เพิ่มใบลา';
$this->params['breadcrumbs'][] = ['label' => 'การลา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
