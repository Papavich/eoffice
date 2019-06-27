<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\eoffice_consult\controllers;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_consult\models\ConsultFaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$create = controllers::t( 'label', 'FAQ');
$main_title = controllers::t('label','Create FAQ');
$title = controllers::t( 'label', 'ทั้งหมด');
$this->title = 'FAQ';
$this->params['breadcrumbs'][] = ['label' => 'Consult Faqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-faq-index">
<div class="panel-body">
      <h4 class="alert alert-info"><?= $create.$title ?> </h4>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'faq_id',
            'faq_ark',
            'faq_ans:ntext',
            //'faq_crby',
          //  'faq_crtime',
            //'faq_upby',
            //'faq_uptime',
            //'user_id',

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
    ]);




    ?>
</div>
</div>
