<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\base\web;
use yii\helpers\ArrayHelper;
use app\modules\consulting\models\ViewPisUser;
use app\modules\consulting\models\ConsultStatus;
use app\modules\consulting\models\ConsultAnswer;
use app\modules\consulting\models\ConsultTopicOwner;
use app\modules\consulting\controllers;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\consulting\models\ConsultPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$create = controllers::t( 'label', 'ปัญหาที่ปรึกษาทั้งหมด');
$main_title = controllers::t('label','Create FAQ');
$title = controllers::t( 'label', 'ทั้งหมด');
$this->title = 'ปัญหาที่ปรึกษาทั้งหมด';
$this->params['breadcrumbs'][] = ['label' => 'ปัญหาทั้งหมด', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-post-index">

  <div class="panel-body">
        <h4 class="alert alert-warning"><?= $create ?> </h4>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'post_id',
            'post_ark_detail',
            'post_ark_date',
          //  'user_id',
            [
                'attribute'=>'consult_user_id',
                'filter'=>ArrayHelper::map(ViewPisUser::find()->all(),'user_id','user_fname'),
                'value'=>function($model){
                    return $model->user->user_fname;
                }
            ],
          //  'status_id',

            [
                 'attribute'=>'status_id',
                 'filter'=>ArrayHelper::map(ConsultStatus::find()->all(),'status_id','status_name'),
                 'value'=>function($model){
                   return $model->status->status_name;
                 }
               ],

            'post_ans',
          //  'topic_owner_id',

            [
                 'attribute'=>'topic_owner_id',
                 'filter'=>ArrayHelper::map(ConsultTopicOwner::find()->all(),'topic_owner_id','topic_owner_name'),
                 'value'=>function($model){
                   return $model->topicOwner->topic_owner_name;
                 }
               ],

            //'respon_id',

  //           [
  //     'class' => 'yii\grid\ActionColumn',
  //     'header'=>'ดูรายละเอียด',
  //     'buttonOptions'=>['class'=>'btn btn-default'],
  //     'template'=>'<div class="btn-group mr-2 text-center" role="group">{view}</div>'
  // ],

  [
        'class' => 'yii\grid\ActionColumn',
        'buttonOptions'=>['class'=>'btn btn-default'],
        'header'=>'',
        'template'=>'{view}',
        'contentOptions'=>[
            'noWrap' => true],
        //'options'=> ['style'=>'width:250px;'],
        'buttons'=>[
            'view' => function($url,$model,$key){
                return  Html::a('<i class="fa fa-pencil-square-o"></i>ดูรายละเอียด',$url,['class'=>'btn btn-block btn-social btn-warning']);
            },

        ],],
        ],
    ]); ?>
</div>
</div>
