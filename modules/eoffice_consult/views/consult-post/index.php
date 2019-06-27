<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\base\web;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_consult\models\ViewPisUser;
use app\modules\eoffice_consult\models\ConsultStatus;
use app\modules\eoffice_consult\models\ConsultAnswer;
use app\modules\eoffice_consult\models\ConsultTopicOwner;
use app\modules\eoffice_consult\models\EofficeCentralViewPisUser;

use app\modules\eoffice_consult\controllers;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_consult\models\ConsultPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$create = controllers::t( 'label', 'การให้คำปรึกษาทั้งหมด');
$main_title = controllers::t('label','Create FAQ');
$title = controllers::t( 'label', 'ทั้งหมด');
$this->title = 'การให้คำปรึกษาทั้งหมด';
$this->params['breadcrumbs'][] = ['label' => 'ปัญหาทั้งหมด', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-post-index">

  <div class="panel-body">
        <h4 class="alert alert-warning"><?= $create ?> </h4>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'post_id',
            'post_ark_detail',
            'post_ark_date',
          //  'user_id',


          //  'status_id',

            [
                 'attribute'=>'status_id',
                 'filter'=>ArrayHelper::map(ConsultStatus::find()->all(),'status_id','status_name'),
                 'value'=>function($model){
                   return $model->status->status_name;
                 }
               ],

            // 'post_ans',
          //  'topic_owner_id',
   'topicOwner.topic_owner_name',
            // [
            //      'attribute'=>'topic_owner_id',
            //      'filter'=>ArrayHelper::map(ConsultTopicOwner::find()->all(),'topic_owner_id','topic_owner_name'),
            //      'value'=>function($model){
            //        return $model->topicOwner->topic_owner_name;
            //      }
            //    ],

            //'respon_id',
  //           [
  //                  'attribute'=>'username.person_name',
  //                  'label' => 'ผู้รับผิดชอบ',
  //                  'value'=>function($model){
  //                  return $model->username->person_name.' '. $model->username->person_surname;}
  //                ],
  // 'post_ans_date',
  //           [
  //     'class' => 'yii\grid\ActionColumn',
  //     'header'=>'ดูรายละเอียด',
  //     'buttonOptions'=>['class'=>'btn btn-default'],
  //     'template'=>'<div class="btn-group mr-2 text-center" role="group">{view}</div>'
  // ],
  'staff.person_name',

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
