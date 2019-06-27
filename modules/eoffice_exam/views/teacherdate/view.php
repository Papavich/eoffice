<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamInvigilate */

$this->title = $model->person_id;
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Exam Invigilates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-exam-invigilate-view">



    <p>

    <strong><?= Html::a('ย้อนกลับ', ['/eoffice_exam/teacherdate/index'], ['class'=>'btn btn-3d btn-blue grid-button']) ?></strong>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name.academic_positions_abb_thai',
            'name.person_name',
            'surname.person_surname',
            'exam_date:date',
            'examstart_time',
            'exam_end_time',
            'subject_id',
            'section_no',
            'rooms_id',
        ],
    ]) ?>

</div>
