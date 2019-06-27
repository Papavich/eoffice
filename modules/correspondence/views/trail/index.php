<?php

use bedezign\yii2\audit\Audit;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

use bedezign\yii2\audit\models\AuditTrailSearch;
use \app\modules\correspondence\controllers;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = controllers::t('menu', 'Log');
$this->params['breadcrumbs'][] = ['label' => Yii::t('audit', 'Audit'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="middle" style="padding: 0px 1% 0px 1%">
    <div class="wizard" style="padding-bottom: 10px">
        <div class="padding-20">
            <h2><?= Html::encode($this->title) ?></h2>

            <?= GridView::widget([
                'tableOptions' => [
                    'class' => 'table table-hover table-bordered',
                    'cellspacing' => '0',
                    'style' => 'width: 100%'
                ],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'label' => controllers::t('menu', 'Doc Subject'),
                        'attribute' => 'model_id',

                        'value' => function ($model) {
                            if (\app\modules\correspondence\models\CmsDocument::findOne($model->model_id)
                            ) {
                                return
                                    \app\modules\correspondence\models\CmsDocument::findOne($model->model_id)
                                        ->doc_subject;
                            }
                            // return print $model->model_id;
                        },
                        'format' => 'raw',

                    ],
                    /*                    [
                                            'attribute' => 'entry_id',
                                        ],*/
                    [
                        'attribute' => 'user_id',
                        'label' => controllers::t('menu', 'Username'),
                        'class' => 'yii\grid\DataColumn',
                        'contentOptions'=>['style' => 'width:250px;'],
                        'value' => function ($data) {
                            if($data->user->PREFIXNAME){
                                return $data->user->PREFIXNAME.$data->user->person_fname_th . " " . $data->user->person_lname_th;
                            }else{
                                return "admin";
                            }

                        },
                        'filter' => false,
                        'format' => 'raw',
                    ],
                    /*                    [
                                            'attribute' => 'action',
                                            'filter' => AuditTrailSearch::actionFilter(),
                                        ],*/

                    /*                    'field',
                                        [
                                            'label' => Yii::t('audit', 'Diff'),
                                            'value' => function ($model) {
                                                return $model->getDiffHtml();
                                            },
                                            'format' => 'raw',
                                        ],*/
                    [
                        'attribute' => 'created',
                        'options' => ['width' => 'auto'],
                        'contentOptions'=>['style' => 'width:200px;font-size:18px'],
                        'filter' => false
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {     // render your custom button
                                return Html::a("<i class=\"fa fa-eye\"></i>
                                            <span>" . controllers::t('menu', 'See more log') . "</span>",
                                    ['trail/view?id=' . $model->model_id],
                                    ['class' => 'btn btn-3d btn-reveal btn-teal']);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</section>

