<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\eoffice_consult\controllers;
use yii\base\web;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_consult\models\ViewPisUser;
use app\modules\eoffice_consult\models\ConsultStatus;
use app\modules\eoffice_consult\models\ConsultTopic;
use app\modules\eoffice_consult\models\ConsultTopicOwner;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_consult\models\ConsultFaq */
//$create = controllers::t( 'label', 'ดู');
$main_title = controllers::t('label','ดูรายละเอียด');
$title = controllers::t( 'label', 'ดูรายละเอียดปัญหา');
$this->title = 'ดูรายละเอียดปัญหา';
$this->params['breadcrumbs'][] = ['label' => 'Consult Faqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-post-view">

  <div class="panel-body">
    <h4 class="alert alert-warning"><?=$title ?> </h4>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'post_id',
            'post_ark_detail',
            'post_ark_date',


            [
                 'attribute'=>'status_id',
                 'filter'=>ArrayHelper::map(ConsultStatus::find()->all(),'status_id','status_name'),
                 'value'=>function($model){
                   return $model->status->status_name;
                 }
               ],

            'post_ans',
            // [
            //      'attribute'=>'topic_owner_id',
            //      'filter'=>ArrayHelper::map(ConsultTopicOwner::find()->all(),'topic_owner_id','topic_owner_name'),
            //      'value'=>function($model){
            //        return $model->topicOwner->topic_owner_name;
            //      }
            //    ],


   'topicOwner.topic_owner_name',
   'staff.person_name',
            // 'respon_id',
            // [
            //        'attribute'=>'username.person_name',
            //        'label' => 'ผู้รับผิดชอบ',
            //        'value'=>function($model){
            //        return $model->username->person_name.' '. $model->username->person_surname;}
            //      ],
                 'post_ans_date',


// 'username.person_surname',

        ],
    ]) ?>
    <div class="form-group">
        <?= Html::a('ประเมินความพึงพอใจ', ['/eoffice_consult/question/create'], ['class'=>'btn btn-primary pull-right']) ?>
        </div>
</div>
</div>
