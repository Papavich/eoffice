<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\requestform\models\ReqFlow;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\requestform\models\ReqApproveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Req Approves';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="req-approve-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'approve_running',
            //'approve_id',
            //'approve_name',
            //'approve_status',
            //'approve_comment',
            // 'approve_receivedate',
            // 'approve_date',
            [
            'attribute'=>'รหัสใบคำร้อง',
            'value'=>'reqFlowFlow.req_form_form_id',
            ],
            [
                'attribute'=>'รหัสนักศึกษา',
                'value'=>'reqFlowFlow.reqFormForm.user_id',
            ],
            [
                'attribute'=>'ชื่อ-นามสกุล',
                'value'=>'reqFlowFlow.reqFormForm.user.username',
            ],

            [
                'attribute'=>'ชื่อใบคำร้อง',
                'value'=>'reqFlowFlow.reqFormForm.reqTemplateTemplate.template_name',
            ],
             //'req_flow_flow_id',
            // 'approve_visible',
            // 'approve_queue',
            [
            'attribute'=>'สถานะ',
            'value'=>'reqFlowFlow.flow_status',
            ],
            [
                'format' => 'raw',
                'value' => function($model, $key, $index, $column) {
                    return Html::a('ตรวจสอบ', ['view', 'flow_id' => $model->req_flow_flow_id ], ['class'=>'btn btn-primary']);

                }
            ]
        ],
    ]); ?>
</div>
