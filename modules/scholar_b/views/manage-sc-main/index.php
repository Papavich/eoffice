<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\scholar_b\controllers;

?>
<?= Html::csrfMetaTags() ?>

<!-- /page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Main Scholarship') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Main Scholarship') ?></li>
    </ol>
</header>
<!-- /page title -->

<div class="scb-scholarship-type-index">
    <div id="content" class="padding-20">
        <div class="panel-body">
            <div class="col-md-12">
                <div class="group">
                    <div class="row">
                        <h3><?= Html::encode($this->title) ?></h3>
                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    </div>

                    <div class="row">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'scholarship_id',
                                'scholarship_name',

                                ['class' => 'yii\grid\ActionColumn',
                                    'options' => ['style' => 'width:90px;'],
                                    'buttonOptions' => ['class' => 'btn btn-default'],
                                    'template' => '<div class="btn-group btn-group-sm text-center" role="group">{update}{delete}</div>',
                                    'contentOptions'=>['noWrap'=>true]
                                ],
                            ],
                        ]); ?>

                    </div>

                    <div class="row">
                        <p>
                            <?= Html::a(controllers::t('label', 'Create Main Scholarship'), ['create'], ['class' => 'btn btn-success']) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




