<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 6/8/2560
 * Time: 18:56
 */
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaNewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<?php
$title = controllers::t('label','Manage News');
$create = controllers::t( 'label', 'Create' );
$back = controllers::t( 'label', 'Back' );
$search = controllers::t( 'label', 'Search' );
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;


?>
    <!--content news -->
<div class="ta-news-index">


        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    // ['class' => 'yii\grid\SerialColumn'],
                    [
                        'options'=>['style'=>'width:150px;'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                        'format'=>'raw',
                        'attribute'=>'ta_news_img',
                        'value'=>function($model){
                            return Html::tag('div','',[
                                'style'=>'width:150px;height:95px;
                          border-top: 10px solid rgba(255, 255, 255, .46);
                          background-image:url('.$model->photoViewer.');
                          background-size: cover;
                          background-position:center center;
                          background-repeat:no-repeat;
                          ']);
                        }
                    ],
                    // 'ta_news_id',
                    [
                        'attribute' => 'ta_news_name',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],

                    ],

                    //'ta_news_detail',
                    //'ta_news_img',
                    // 'ta_news_url:url',
                    //'ta_documents_id',
                  /*  [ 'attribute'=>'ta_documents_id',
                          'label' => 'ta_documents_name',
                          'filter'=>\yii\helpers\ArrayHelper::map(\app\modules\eoffice_ta\models\TaDocuments::find()->all(),'ta_documents_id','ta_documents_name'),
                       'value'=>function($model){
                           return $model->ta_documents->ta_documents_name;
                       }
                      ],*/
                    //'crby',

                    [
                        'attribute' => 'crtime',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],

                    ],
                    [
                        'attribute' => 'udtime',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],

                    ],
                    [

                        'class' => 'yii\grid\ActionColumn',
                        'header' => '<center>'.Html::a(Html::tag('i', '',
                                    ['class' => 'glyphicon glyphicon-plus']) . $create, ['create'],
                                ['class' => 'btn btn-sm btn-green']).'</center>',
                        'options'=>['style'=>'width:140px;'],
                        'template'=>'<div class="btn-group btn-group-sm" role="group" aria-label="...">{view}{update}{delete}</div>',
                        'buttons'=>[
                            'view'=>function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                                    $url,['class'=>'btn btn-sm btn-default']);
                            },
                            'update'=>function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                                    $url,['class'=>'btn btn-sm btn-default']);
                            },
                            'delete'=>function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url,[
                                    'title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                    'class'=>'btn btn-sm btn-default'
                                ]);
                            }
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>


