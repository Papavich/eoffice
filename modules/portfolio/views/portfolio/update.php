<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Person */

$this->title = 'แก้ไขข้อมูล: ' . ' ' . $model->person_firstname. ' ' .$model->person_lastname;
$this->params['breadcrumbs'][] = ['label' => 'บุคลากร', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->person_id, 'url' => ['view', 'id' => $model->person_id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="person-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
