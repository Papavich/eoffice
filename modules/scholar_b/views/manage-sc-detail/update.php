<?php

use yii\helpers\Html;
use app\modules\scholar_b\controllers;

?>
<!-- /page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Edit Scholarship') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li><a href="../manage-sc-detail/index"><?= controllers::t('label', 'Manage Scholarships Detail') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Edit Scholarship') ?></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-scholarship-type-has-year-update">
    <div id="content" class="padding-20">
        <div class="panel-body">
            <div class="col-md-12">
                <div class="group">
                    <h1><?= Html::encode($this->title) ?></h1>

                    <?= $this->render('_form', [
                        'model_sc_detail' => $model_sc_detail,
                        'sc_main' => $sc_main,
                        'sc_year' => $sc_year,
                        'model_conditions' => $model_conditions,

                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>
