<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\scholar_b\models\ScbEnrollScholarshipSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scb Enroll Scholarships';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scb-enroll-scholarship-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Scb Enroll Scholarship', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'candidate_id_card',
            'scholarship_id',
            'scholarship_year',
            'gpax_4to5',
            'gpa_math4',
            //'gpa_math4to5',
            //'gpa_chem4',
            //'gpa_chem5',
            //'gpa_math5',
            //'gpa_physic4',
            //'gpa_physic5',
            //'gpa_sum_chem_physic_math_4to5',
            //'crby',
            //'crtime',
            //'udby',
            //'udtime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
