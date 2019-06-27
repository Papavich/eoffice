<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbEnrollScholarship */

$this->title = 'Create Scb Enroll Scholarship';
$this->params['breadcrumbs'][] = ['label' => 'Scb Enroll Scholarships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scb-enroll-scholarship-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
