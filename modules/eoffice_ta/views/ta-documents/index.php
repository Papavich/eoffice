<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaDocuments */
/* @var $searchModel app\modules\eoffice_ta\models\TaDocumentsSearch */
?>

<?php
$title = controllers::t('label','Document TA');
$back = controllers::t( 'label', 'Back' );
$create = controllers::t( 'label', 'Create' );
$download = controllers::t( 'label', 'Download' );
$search = controllers::t( 'label', 'Search' );
$this->title = $title;
//$this->title = $title_main;
//$this->params['breadcrumbs'][] = ['label' => $title_main, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- page title -->

<div class="ta-documents-index">
    <!--content doc -->

        <!-- panel content -->
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' =>  $searchModel,
                'layout' => "{summary}\n{items}\n<div align='right'>{pager}</div>",
                'summary'=>'',
                'showFooter'=>false,
                'showHeader' => true,
                //'options'=>['class'=> 'info'],
                // 'options' => ['style' => 'background-color:#ccf8fe'],
                'columns' => [

                    ['class' => 'yii\grid\SerialColumn',

                    ],
                    [
                        'attribute' => 'ta_documents_name',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],

                    ],
                    [
                        'attribute' => 'ta_documents_path',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'attribute' => 'ta_doc_detail',
                        //'contentOptions' => ['class' => 'text-center'],
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