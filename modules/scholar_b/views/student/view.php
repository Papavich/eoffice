<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\model_main\EofficeMainStudent */

$this->title = $model->studentbio_id;
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Main Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-main-student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'studentbio_id' => $model->studentbio_id, 'STUDENTID' => $model->STUDENTID, 'adviser_id' => $model->adviser_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'studentbio_id' => $model->studentbio_id, 'STUDENTID' => $model->STUDENTID, 'adviser_id' => $model->adviser_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'studentbio_id',
            'STUDENTID',
            'adviser_id',
            'student_card_id',
            'student_email:email',
            'student_img',
            'student_nickname',
            'student_height',
            'student_weight',
            'student_blood_group',
            'student_underlying_disease',
            'student_marital_status',
            'student_mobile_phone',
            'student_facebook_url:url',
            'student_line_id',
            'student_working_status',
            'student_working_place',
            'student_working_salary',
            'student_current_address',
            'student_current_district_id',
            'student_current_amphur_id',
            'student_current_province_id',
            'student_current_zipcode_id',
            'student_home_address',
            'student_home_district_id',
            'student_home_amphur_id',
            'student_home_province_id',
            'student_home_zipcode_id',
            'father_birthday',
            'father_highest_qualification',
            'father_career',
            'father_work_place',
            'father_mobile',
            'father_address',
            'father_district_id',
            'father_amphur_id',
            'father_province_id',
            'father_zipcode_id',
            'father_religion',
            'father_nationality',
            'father_income_per_month',
            'mother_birthday',
            'mother_highest_qualification',
            'mother_career',
            'mother_work_place',
            'mother_mobile',
            'mother_address',
            'mother_district_id',
            'mother_amphur_id',
            'mother_province_id',
            'mother_zipcode_id',
            'mother_religion',
            'mother_nationality',
            'mother_income_permonth',
            'marital_status_parents',
            'parent_career',
            'parent_address',
            'parent_district_id',
            'parent_amphur_id',
            'parent_province_id',
            'parent_zipcode_id',
            'parent_mobile',
            'parent_religion',
            'parent_nationality',
            'contact_relation',
            'contact_address',
            'contact_district_id',
            'contact_amphur_id',
            'contact_province_id',
            'contact_zipcode_id',
            'contact_mobile',
            'contact_religion',
            'contact_nationality',
        ],
    ]) ?>

</div>
