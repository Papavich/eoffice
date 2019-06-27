<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\scholar_b\controllers;

?>
<?= Html::csrfMetaTags() ?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Funded Grant') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Funded Grant') ?></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-funded-index">
    <div id="content" class="padding-20">
        <div class="panel-body">
            <div class="col-md-12">
                <div class="group">
                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <p>
                        <?= Html::a(controllers::t('label', 'Add Funded Grant'), ['create'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a(controllers::t('label', 'รายงานข้อมูลรายบุคคล'), ['funded-grant-by-person'], ['class' => 'btn btn-info']) ?>
                    </p>


                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'student_id',
                            [
                                'attribute' => 'funded_type_id',
                                'label' => controllers::t('label', 'Funded Grant'),
                                'filter' => \yii\helpers\ArrayHelper::map(\app\modules\scholar_b\models\ScbFundedType::find()->all(), 'funded_type_id', 'funded_type_name'),
                                'value' => function ($model) {
                                    return $model->fundedname->funded_type_name;
                                }
                            ],
                            'funded_date:date',
                            'year',
                            'semester',
                            //'funded_amount',
                            //'crby',
                            //'crtime',
                            //'udby',
                            //'udtime',

                            ['class' => 'yii\grid\ActionColumn',
                                'options' => ['style' => 'width:120px;'],
                                'buttonOptions' => ['class' => 'btn btn-default'],
                                'template' => '<div class="btn-group btn-group-sm text-center" role="group">  {view} {update} {delete} </div>'
                            ],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
