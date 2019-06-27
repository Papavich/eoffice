<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\EofficeCentralViewPisUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Central View Pis Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-central-view-pis-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'username',
            'email:email',
            'user_type_id',
            'department_id',
            'student_fname_th',
            'student_lname_th',
            'student_fname_en',
            'student_lname_en',
            'person_fname_en',
            'person_lname_th',
            'person_lname_en',
            'prefix_en',
            'user_id',
            'academic_positions_id',
            'academic_positions_abb_thai',
            'academic_positions_eng',
            'academic_positions',
            'academic_positions_abb',
            'PREFIXNAME',
            'major_id',
            'major_name',
            'major_name_eng',
            'major_code',
            'person_fname_th',
            'person_mobile',
            'person_current_address',
            'AMPHUR_NAME',
            'PROVINCE_NAME',
            'ZIPCODE',
            'DISTRICT_NAME',
            'person_id',
            'password_hash',
            'STUDENTMOBILE',
            'student_img',
            'person_img',
            'STUDENTEMAIL:email',
            'person_email:email',
            'branch_id',
        ],
    ]) ?>

</div>
