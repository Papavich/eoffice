<?php

use yii\helpers\Html;
use app\modules\scholar_b\controllers;

?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Add Funded Grant') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li><a href="../funded-grant/index"><?= controllers::t('label', 'Funded Grant') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Add Funded Grant') ?></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-funded-create">
    <div id="content" class="padding-20">
        <div class="panel-body">
            <div class="col-md-12">
                <div class="group">

                    <?= $this->render('_form', [
                            'model_funded' => $model_funded,
                            'funded_type' => $funded_type,
                            'year_semester' => $year_semester
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
