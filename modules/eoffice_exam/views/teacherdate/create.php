<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamInvigilate */

$this->title = 'Create Eoffice Exam Invigilate';
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Exam Invigilates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-exam-invigilate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
