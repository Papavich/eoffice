<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\requestform\models\ReqFlowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Req Forms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="req-form-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'รหัสใบคำร้อง',
                'value'=>'form_id',
            ],
            //'form_value:ntext',
            //'form_layout:ntext',
            [
                'attribute'=>'ชื่อแบบฟอร์มคำร้อง',
                'value'=>'reqTemplateTemplate.template_name',
            ],
            [
                'attribute'=>'ชื่อ-นามสกุล',
                'value'=>'user.username',
            ],
            [
                'attribute'=>'สถานะคำร้อง',
                'value'=>'reqFlows.flow_status',
                'options' => array('class' => 'red','color'=>'red'),
            ],
           /* [
                'attribute'=>'สถานะคำร้อง',
                'options' => array('class' => 'btn btn-primary','color'=>'red'),
                'value'=>
                function($model){
                $status = $model->reqFlows->flow_status;
                if($status == 'ผ่านการพิจารณา'){
                    $status = '1';
                    return $status;
                }else{
                    $status = '0';
                    return $status;
                }
            }
            ],*/
            //'req_formcol',
            // 'crdate',
            // 'cryear',
            // 'crterm',
            // 'req_template_template_id',

            [
                'format' => 'raw',
                'value' => function($model, $key, $index, $column) {
                    return Html::a('ตรวจสอบ', ['view', 'form_id' => $model->form_id ], ['class'=>'btn btn-primary']);

                }
            ]
        ],
    ]);


    ?>
</div>
