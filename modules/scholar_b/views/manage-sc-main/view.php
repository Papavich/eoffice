<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\scholar_b\controllers;

?>
<?= Html::csrfMetaTags() ?>
<!-- /page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'View Scholarship') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li><a href="../manage-sc-main/index"><?= controllers::t('label', 'Main Scholarship') ?></a></li>
        <li class="active"><?= controllers::t('label', 'View Scholarship') ?></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-scholarship-type-view">

    <div id="content" class="padding-20">
        <div class="panel-body">
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'scholarship_id',
                                'scholarship_name',
                            ],
                        ]) ?>
                        <p>
                            <?= Html::a('Update', ['update', 'id' => $model->scholarship_id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Delete', ['delete', 'id' => $model->scholarship_id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
