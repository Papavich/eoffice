<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\RegStudentbio */

$this->title = 'Create Reg Studentbio';
$this->params['breadcrumbs'][] = ['label' => 'Reg Studentbios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-studentbio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
