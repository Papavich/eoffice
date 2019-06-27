<?php

use yii\helpers\Html;
use app\modules\scholar_b\controllers;


?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Create Portfolio') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li><a href="../portfolio/index"><?= controllers::t('label', 'Upload Portfolio') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Create Portfolio') ?></a></li>
    </ol>
</header>
<!-- /page title -->

<div class="scb-portfolio-create">


    <?= $this->render('_form', [
        'model' => $model,
        'model_std' => $model_std,
    ]) ?>

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