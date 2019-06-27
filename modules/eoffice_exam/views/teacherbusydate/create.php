<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamBusydate */

$this->title = 'เพิ่มข้อมูลุวันที่ไม่ว่างในการคุมสอบ';
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Exam Busydates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-exam-busydate-create">

    <blockquote>
      <h3><?= Html::encode($this->title) ?></h3>
    </blockquote>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
