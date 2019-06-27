<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Leave */

$this->title = 'รหัส ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'การลา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-view">


    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-body">
                   

                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'label' => 'ชื่อ-สกุล',
                                'value' => $model->person->fullname,
                            ],
                            'leave_year',
                            'leave_type',
                            'leave_date_start',
                            'leave_date_end',
                            'leave_num',
                            'leave_reason',
                          //  'leave_status',
                             [
                                'label' => 'สถานะ',
                                'value' => $model->statuslabel,
                            ],
                        ],
                    ])
                    ?>

                </div>
            </div>
        </div>
    </div>

</div>
