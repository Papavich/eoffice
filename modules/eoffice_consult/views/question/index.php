<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\eoffice_consult\controllers;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_consult\models\ConsultPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$create = controllers::t( 'label', 'คะแนนความพึงพอใจ');
$main_title = controllers::t('label','Create FAQ');
$title = controllers::t( 'label', 'ทั้งหมด');
$this->title = 'การให้คำปรึกษาทั้งหมด';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">

  <div class="panel-body">
        <h4 class="alert alert-warning"><?= $create ?> </h4>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'question_id',
            'question_one',
            'question_two',
            'question_three',
            'question_four',
            'question_five',


        ],
    ]); ?>
</div>
