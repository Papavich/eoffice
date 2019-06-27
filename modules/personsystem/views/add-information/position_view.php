<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\PositionDirectors */

$this->title = $model->director_id;
$this->params['breadcrumbs'][] = ['label' => 'Position Directors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- page title -->

<header id="page-header">
    <h1>View Infomation</h1>
    <ol class="breadcrumb">
        <li><a href="#">Add Information</a></li>
        <li class="active">View Position Director</li>
    </ol><br>
    <a href="add-directors?active=2" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a><br>
</header>
<div id="content" class="padding-20">

    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">
                <p>
                    <?= Html::a('Update', ['position-update', 'id' => $model->director_id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['position-delete', 'id' => $model->director_id], [
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
                        'director_id',
                        'position_name',
                        'position_name_eng',
                    ],
                ]) ?>


            </div>
        </div>
    </div>
</div>
