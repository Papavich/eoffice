<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\base\web;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_consult\models\ViewPisUser;
use app\modules\eoffice_consult\models\ConsultStatus;
use app\modules\eoffice_consult\models\ConsultAnswer;
use app\modules\eoffice_consult\models\ConsultTopicOwner;
use app\modules\eoffice_consult\models\EofficeCentralViewPisPerson;

use app\modules\eoffice_consult\controllers;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_consult\models\ConsultPostSearch */
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
              // [
              //     'attribute'=>'consult_user_id',
              //     'filter'=>ArrayHelper::map(ViewPisUser::find()->all(),'user_id','user_fname'),
              //     'value'=>function($model){
              //         return $model->user->user_fname;
              //     }
              // ],

              [
                   'attribute'=>'status_id',
                   'filter'=>ArrayHelper::map(ConsultStatus::find()->all(),'status_id','status_name'),
                   'value'=>function($model){
                     return $model->status->status_name;
                   }
                 ],

              'post_ans',


         'topicOwner.topic_owner_name',



             //
            //  [
            //      'attribute'=>'person_card_id',
            //      'filter'=>ArrayHelper::map(EofficeCentralViewPisPerson::find()->all(),'person_card_id','person_name'),
            //      'value'=>function($model){
            //          return $model->person->person_name;
            //      }
            //  ],



          'student.STUDENTNAME',
          // [
          //      'attribute'=>'topic_owner_id',
          //      'filter'=>ArrayHelper::map(EofficeCentralViewPisPerson::find()->all(),'person_card_id','respon_id'),
          //      'value'=>function($model){
          //        return $model->username->person_name;
          //      }
          // ],








            [
                  'class' => 'yii\grid\ActionColumn',
                  'buttonOptions'=>['class'=>'btn btn-default'],
                  'header'=>'',
                  'template'=>'{update}',
                  'contentOptions'=>[
                      'noWrap' => true],
                  //'options'=> ['style'=>'width:250px;'],
                  'buttons'=>[
                      'update' => function($url,$model,$key){
                          return  Html::a('<i class="fa fa-pencil-square-o"></i>ตอบกลับปัญหา',$url,['class'=>'btn btn-block btn-social btn-warning']);
                      },

                  ],],
        ],
    ]); ?>
</div>
</div>
