<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_asset\models\EofficeCentralViewPisUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eoffice Central View Pis Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-central-view-pis-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eoffice Central View Pis User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            'user_type_id',
            'department_id',
            //'student_fname_th',
            //'student_lname_th',
            //'student_fname_en',
            //'student_lname_en',
            //'person_fname_en',
            //'person_lname_th',
            //'person_lname_en',
            //'prefix_en',
            //'user_id',
            //'academic_positions_id',
            //'academic_positions_abb_thai',
            //'academic_positions_eng',
            //'academic_positions',
            //'academic_positions_abb',
            //'PREFIXNAME',
            //'major_id',
            //'major_name',
            //'major_name_eng',
            //'major_code',
            //'person_fname_th',
            //'person_mobile',
            //'person_current_address',
            //'AMPHUR_NAME',
            //'PROVINCE_NAME',
            //'ZIPCODE',
            //'DISTRICT_NAME',
            //'person_id',
            //'password_hash',
            //'STUDENTMOBILE',
            //'student_img',
            //'person_img',
            //'STUDENTEMAIL:email',
            //'person_email:email',
            //'branch_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
