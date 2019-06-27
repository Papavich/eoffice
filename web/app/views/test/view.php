<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RegStudentbio */

$this->title = $model->STUDENTBIO;
$this->params['breadcrumbs'][] = ['label' => 'Reg Studentbios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg-studentbio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'STUDENTBIO' => $model->STUDENTBIO, 'STUDENTID' => $model->STUDENTID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'STUDENTBIO' => $model->STUDENTBIO, 'STUDENTID' => $model->STUDENTID], [
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
            'STUDENTBIO',
            'STUDENTID',
            'NATIONID',
            'RELIGIONID',
            'SCHOOLID',
            'ENTRYTYPE',
            'ENTRYDEGREE',
            'BIRTHDATE',
            'STUDENTFATHERNAME',
            'STUDENTMOTHERNAME',
            'STUDENTSEX',
            'ADMITACADYEAR',
            'ADMITSEMESTER',
            'ENTRYGPA',
            'CITIZENID',
            'PARENTNAME',
            'PARENTRELATION',
            'CONTACTPERSON',
            'STUDENTMOBILE',
        ],
    ]) ?>

</div>
