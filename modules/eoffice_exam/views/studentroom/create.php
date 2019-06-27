<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamExaminationItem */

$this->title = 'Create Eoffice Exam Examination Item';
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Exam Examination Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-exam-examination-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
