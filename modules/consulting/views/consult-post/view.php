<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\consulting\controllers;
use yii\base\web;
use yii\helpers\ArrayHelper;
use app\modules\consulting\models\ViewPisUser;
use app\modules\consulting\models\ConsultStatus;
use app\modules\consulting\models\ConsultTopic;
use app\modules\consulting\models\ConsultTopicOwner;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultFaq */
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
                 'attribute'=>'user_id',
                 'filter'=>ArrayHelper::map(ViewPisUser::find()->all(),'user_id','user_fname'),
                 'value'=>function($model){
                   return $model->user->user_fname;
                 }
               ],

            [
                 'attribute'=>'status_id',
                 'filter'=>ArrayHelper::map(ConsultStatus::find()->all(),'status_id','status_name'),
                 'value'=>function($model){
                   return $model->status->status_name;
                 }
               ],

            'post_ans',
            [
                 'attribute'=>'topic_owner_id',
                 'filter'=>ArrayHelper::map(ConsultTopicOwner::find()->all(),'topic_owner_id','topic_owner_name'),
                 'value'=>function($model){
                   return $model->topicOwner->topic_owner_name;
                 }
               ],
            'respon_id',
        ],
    ]) ?>

</div>
</div>
