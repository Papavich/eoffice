<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Person */

$this->title = 'สร้างใหม่';
$this->params['breadcrumbs'][] = ['label' => 'บุคลากร', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
