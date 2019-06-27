<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LeaveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'การลา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-index">

    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-body">

                    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

                    <p>
                        <?= Html::a('เพิ่มใบลา', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                    <?php Pjax::begin(); ?>    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            [
                                'attribute' => 'ID',
                                'value' => 'id',
                                'options' => ['style' => 'width:50px;'],
                            ],
                            // 'person_id',
                            [
                                'attribute' => 'ชื่อ-สกุล ผู้ลา',
                                'value' => 'person.fullname',

                                'contentOptions' => [
                                    'noWrap' => true
                                ],
                            ],
                            'leave_year',
                            'leave_type',
                            'leave_date_start',
                            'leave_date_end',
                            [
                                'attribute' => 'จำนวนวัน',
                                'value' => 'leave_num',
                                'options' => ['style' => 'width:100px;'],
                            ],
                            // 'leave_reason',
                            [
                                'attribute' => 'สถานะ',
                                'value' => 'statuslabel',
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'เครื่องมือ',
                                'headerOptions' => ['width' => '100'],
                                'template' => '{view}',
                                'buttons' => [
                                    'view' => function($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-search"></span>', $url, ['title' => 'ดูรายละเอียด']);
                                    },
                                        ],
                                    ],
                                ],
                            ]);
                            ?>
                            <?php Pjax::end(); ?>


                </div>
            </div>

        </div>
    </div>

</div>


