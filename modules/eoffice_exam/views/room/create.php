<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamEnroll */

$this->title = 'Create Eoffice Exam Enroll';
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Exam Enrolls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-exam-enroll-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
