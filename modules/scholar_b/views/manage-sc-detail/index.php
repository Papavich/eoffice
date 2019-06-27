<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\scholar_b\controllers;

?>
<?= Html::csrfMetaTags() ?>
<!-- /page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Manage Scholarships Detail') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Manage Scholarships Detail') ?></li>
    </ol>
</header>
<!-- /page title -->

<div class="scb-scholarship-type-has-year-index">
    <div id="content" class="padding-20">
        <div class="panel-body">
            <div class="col-md-12">
                <div class="group">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <p>
                        <?= Html::a(controllers::t('label', 'Create Scholarship detail each Year'), ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?= GridView::widget(['dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [['class' => 'yii\grid\SerialColumn'],

                            [
                                'attribute' => 'scholarship_id',
                                'label' => controllers::t('label', 'Scholarship ID'),
                                'value' => function ($model) {
                                    return $model->scholarship_id;
                                }
                            ],
                            [
                                'attribute' => 'scholarship_id',
                                'label' => controllers::t('label', 'Scholarship Name'),
                                'filter' => \yii\helpers\ArrayHelper::map(\app\modules\scholar_b\models\ScbScholarshipType::find()->all(), 'scholarship_id', 'scholarship_name'),
                                'value' => function ($model) {
                                    return $model->scname->scholarship_name;
                                }
                            ],

                            [
                                'attribute' => 'scholarship_year',
                                'label' => controllers::t('label', 'Year'),
                                'value' => function ($model) {
                                    return $model->scholarship_year;
                                }
                            ],

                            [
                                'attribute' => 'scholarship_file',
                                'label' => 'Download File',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return Html::a('Download File', '@web/web_scb/uploads/scb_detail/files/' . $model->scholarship_file);
                                }
                            ],
                            'date_start:date',
                            'date_end:date',
                            ['class' => 'yii\grid\ActionColumn',
                                'options' => ['style' => 'width:120px;'],
                                'buttonOptions' => ['class' => 'btn btn-default'],
                                'template' => '<div class="btn-group btn-group-sm text-center" role="group"> {view} {update} {delete} </div>'
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
