<?php

use yii\helpers\Html;
use app\modules\scholar_b\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbStudentHasActivityMain */
?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Upload Activity') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li><a href="../activity/index#jtab2_nobg"><?= controllers::t('label', 'Activity Main') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Upload Activity') ?></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-student-has-activity-main-update">
        <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
