<?php

use yii\helpers\Html;
use app\modules\scholar_b\controllers;


?>
<!-- /page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Create Main Scholarship') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li><a href="../manage-sc-main/index"><?= controllers::t('label', 'Main Scholarship') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Create Main Scholarship') ?></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-scholarship-type-create">
    <div id="content" class="padding-20">
        <div class="panel-body">
            <div class="col-md-12">
                <div class="group">
                    <div class="row">
                        <h3><?= Html::encode($this->title) ?></h3>
                    </div>

                    <div class="row">
                        <?= $this->render('_form', [
                            'model' => $model,
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
