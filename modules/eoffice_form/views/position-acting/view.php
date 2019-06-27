<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\PositionActing */

$this->title = 'รักษาการในตำแหน่ง '.$model->position->position_name;
$this->params['breadcrumbs'][] = ['label' => 'รักษาการแทน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
                  <span class="title elipsis">
                  </span>
        </div>
        <div class="panel-body">
            <div class="position-acting-view">

                <p>
                    <?= Html::a('Update', ['update', 'position_id' => $model->position_id, 'user_id' => $model->user_id, 'acting_startDate' => $model->acting_startDate, 'acting_endDate' => $model->acting_endDate], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'position_id' => $model->position_id, 'user_id' => $model->user_id, 'acting_startDate' => $model->acting_startDate, 'acting_endDate' => $model->acting_endDate], [
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
                        'acting_startDate',
                        'acting_endDate',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>