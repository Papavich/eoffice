<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Prefix */

$this->title = 'สร้างใหม่';
$this->params['breadcrumbs'][] = ['label' => 'Prefixes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prefix-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
