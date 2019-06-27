<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\PositionAssign */

$this->title = $model->position->position_name;
$this->params['breadcrumbs'][] = ['label' => 'การดำรงตำแหน่ง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">

        </div>
        <div class="panel-body">
            <div class="position-assign-view">
                <p>
                    <?= Html::a('Update', ['update', 'position_id' => $model->position_id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'position_id' => $model->position_id, 'user_id' => $model->user_id], [
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
                        'position.position_name',
                        ['label'=>'ชื่อ-นามสกุล',
                            'value' => function ($model){
                                return $model->username->PREFIXABB.' '.$model->username->person_name.' '.$model->username->person_surname;
                            }
                        ],
                        'cr_date',
                        'cr_by',
                        'ud_date',
                        'ud_by',
                    ],
                ]) ?>

            </div>

        </div>
    </div>
</div>
