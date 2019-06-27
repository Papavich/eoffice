<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\RepDes */

$this->title = 'แก้ไขสถานะของรายการแจ้งซ่อมที่: ' . $model->rep_des_id;
$this->params['breadcrumbs'][] = ['label' => 'Rep Des', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rep_des_id, 'url' => ['view', 'id' => $model->rep_des_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rep-des-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formde', [
        'model' => $model,
    ]) ?>

</div>
