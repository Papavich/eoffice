<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\scholar_b\controllers;
use yii\helpers\Url;
use yii\timeago\TimeAgo;
use yii\widgets\LinkPager;
use app\modules\scholar_b\models\model_main\EofficeCentralViewPisPerson;

?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'News') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class="active"><?= controllers::t('label', 'News Main') ?></a></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-news-index">
    <div id="content" class="padding-20">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseOne">
                                    <i class="fa fa-newspaper-o"></i>
                                    <?= controllers::t('label', 'News') ?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                            <ul class="panel-body">
                                <?php
                                foreach ($model as $item) { ?>
                                    <a href="<?php echo Url::toRoute(['news/view', 'id' => $item->news_id]); ?>">
                                        <ul class="list-unstyled list-icons margin-bottom-10">
                                            <li class="margin-top-6"><i class="fa fa-angle-right"></i>
                                                <strong> <?php echo $item->news_name; ?> </strong>
                                                <span style="color: black">- <?= controllers::t('label', 'By') ?>
                                                    <?php $data = EofficeCentralViewPisPerson::find()->where(['person_card_id' => $item->staff_id_card])->one();
                                                    if ($data) {
                                                        echo $data->PREFIXABB . '' . $data->person_name . ' ' . $data->person_surname;
                                                    } ?>
                                                    ( <i><?php echo TimeAgo::widget(['timestamp' => $item->crtime . "GMT+7",]) ?></i> )</span>
                                        </ul>
                                    </a>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                    <!-- pagination -->
                    <div class="text-center">
                        <?php
                        echo LinkPager::widget([
                            'pagination' => $pages,
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>