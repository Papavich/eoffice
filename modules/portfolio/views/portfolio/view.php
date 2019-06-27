<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Person */

$this->title = 'แก้ไขรหัส '.$model->person_id;
$this->params['breadcrumbs'][] = ['label' => 'บุคลากร', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-body">
                    <p>
                        <?= Html::a('แก้ไข', ['update', 'id' => $model->person_id], ['class' => 'btn btn-primary']) ?>
                        <?=
                        Html::a('ลบ', ['delete', 'id' => $model->person_id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ])
                        ?>
                    </p>

                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'person_id',
                            'prefix_id',
                            'person_firstname',
                            'person_lastname',
                            'person_date_work_start',
                            'position_id',
                            'department_id',
                            'person_address',
                            'person_tel',
                            'person_picture',
                            'person_work_status',
                        ],
                    ])
                    ?>

                </div>
            </div>

        </div>
    </div>



</div>
