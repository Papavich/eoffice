<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\scholar_b\controllers;
use app\modules\scholar_b\components\AuthHelper;
use app\modules\scholar_b\models\model_main\EofficeCentralViewPisPerson;

?>
<?= Html::csrfMetaTags() ?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'View News') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class=""><a href="../news/index"><?= controllers::t('label', 'News Main') ?></a></li>
        <li class=""><a href="../news/addnews"><?= controllers::t('label', 'Add News') ?></a></li>
        <li class="active"><?= controllers::t('label', 'View News') ?></li>
    </ol>
</header>
<!-- /page title -->

<div class="scb-news-view">
    <div id="content" class="padding-20">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2><b><?= \yii\helpers\HtmlPurifier::process($model->news_name) ?></b></h2>
                        <hr>
                        <small>
                            <span class="fa fa-clock-o"></span>
                            <?= Yii::$app->formatter->asDatetime($model->crtime, 'short') ?><br>
                            <?php foreach ($model_news as $item) { ?>
                                <strong><?= controllers::t('label', 'By') ?>
                                    <?php $data = EofficeCentralViewPisPerson::find()->where(['person_card_id' => $item->staff_id_card])->one();
                                    if ($data) {
                                        echo $data->PREFIXABB . '' . $data->person_name . ' ' . $data->person_surname;
                                    } ?>
                                </strong>
                            <?php } ?>

                            <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Staff) { ?>
                                <div align="right">
                                    <?= Html::a('<i class="fa fa-edit"></i> ' . controllers::t('label', 'Edit'), ['update', 'id' => $model->news_id], ['class' => '']) ?>
                                    <?= Html::a('<i class="fa fa-trash"></i> ' . controllers::t('label', 'Delete'), ['deleteone', 'id' => $model->news_id], [
                                        'style' => 'color:red;',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </div>
                            <?php } ?>
                        </small>


                        <div class="panel-body">

                            <center><?php echo Html::img('@web/web_scb/uploads/news/' . $model->news_image, ['width' => 400]) ?></center>
                            <br><?= \yii\helpers\HtmlPurifier::process($model->news_detail) ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Get all flash messages and loop through them -->
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>
