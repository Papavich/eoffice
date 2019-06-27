<?php
use yii\helpers\Html;
use app\modules\scholar_b\controllers;

$this->registerJsFile('@web/ckeditor/ckeditor.js')
?>

<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Add News') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class=""><a href="../news/index"><?= controllers::t('label', 'News Main') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Add News') ?></li>
    </ol>
</header>
<!-- /page title -->

<div class="scb-news-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_file' => $model_file,
    ]) ?>

</div>
