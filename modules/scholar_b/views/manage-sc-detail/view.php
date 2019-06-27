<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\modules\scholar_b\controllers;

?>
<?= Html::csrfMetaTags() ?>
<!-- /page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Detail Scholarship') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li><a href="../manage-sc-detail/index"><?= controllers::t('label', 'Manage Scholarships Detail') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Detail Scholarship') ?></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-scholarship-type-has-year-view">
    <div id="content" class="padding-20">
        <div class="panel-body">
            <div class="row">
                <div class="form-group">
                    <div class="col-md-8">
                        <div class="panel panel-info">
                            <div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span>
                                <b><?php echo controllers::t('label', 'Scholarship'); ?></b>
                            </div>
                            <div class="panel-body" style="height: 120px;">
                                <label><?php echo controllers::t('label', 'Scholarship ID'); ?>
                                    :</label> <?php echo $model->scholarship_id; ?>
                                <br> <label> <?php echo controllers::t('label', 'Scholarship Name'); ?>
                                    :</label> <?php $data = \app\modules\scholar_b\models\ScbScholarshipType::find()->where(['scholarship_id' => $model->scholarship_id])->one();
                                echo $data->scholarship_name;
                                ?>
                                <br> <label><?php echo controllers::t('label', 'Year'); ?> : </label>
                                <?php echo $model->scholarship_year; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading"><span class="glyphicon glyphicon-calendar"></span>
                                <b><?php echo controllers::t('label', 'Application Period'); ?></b></div>
                            <div class="panel-body" style="height: 120px;">
                                <label><?php echo controllers::t('label', 'Registration Date'); ?>
                                    :</label> <?php echo Yii::$app->thaiFormatter->asDate($model->date_start, 'long') . "<br>"; ?>
                                <label><?php echo controllers::t('label', 'Registration Closing Date'); ?>
                                    : </label> <?php echo Yii::$app->thaiFormatter->asDate($model->date_end, 'long') . "<br>"; ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span>
                    <b><?php echo controllers::t('label', 'Detail'); ?></b></div>
                <div class="panel-body">
                    <center><?php echo Html::img('@web/web_scb/uploads/scb_detail/images/' . $model->scholarship_image, ['width' => 400]) ?></center>
                    <br><?= \yii\helpers\HtmlPurifier::process($model->scholarship_condition) ?>
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span>
                    <b><?php echo controllers::t('label', 'Terms and Conditions'); ?></b></div>
                <div class="panel-body">
                    <?php $count = 1;
                    foreach ($model_conditions as $item) { ?>
                    <p><?php echo $count ?>. <?php
                            if($item->condi_name == 1){
                                echo "ผลการศึกษาแต่ละเทอมไม่ต่ำกว่า";
                            }else if($item->condi_name == 2){
                                echo "ผลการศึกษาแต่ละปีการศึกษาไม่ต่ำกว่า";
                            }else if($item->condi_name == 3){
                                echo "เข้าร่วมการประกวด-แข่งขันหรือบทความวิชาการระดับภูมิภาคอย่างน้อย";
                            }else if($item->condi_name == 4){
                                echo "เข้าร่วมการประกวด-แข่งขันอย่างน้อย";
                            }else{
                                echo $item->condi_name;
                            }
                        ?> <?php if($item->condi_value !=null ) echo $item->condi_value; ?></p>
                        <?php $count++;
                    }
                    ?>
                </div>
            </div>


            <div class="panel panel-info">
                <div class="panel-heading"><span class="glyphicon glyphicon-inbox"></span>
                    <b><?php echo controllers::t('label', 'Download Document'); ?></b></div>
                <div class="panel-body">
                    <?php echo Html::a(' ' . controllers::t('label', 'Click for Download', ['class' => 'btn btn-primary']), '@web/web_scb/uploads/scb_detail/files/' . $model->scholarship_file, ['class' => 'glyphicon glyphicon-download-alt btn btn-default btn-sm']) ?>
                </div>
            </div>

            <center><p>
                    <?= Html::a('Update', ['update', 'scholarship_id' => $model->scholarship_id, 'scholarship_year' => $model->scholarship_year], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'scholarship_id' => $model->scholarship_id, 'scholarship_year' => $model->scholarship_year,], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ]
                    ]) ?>
                </p></center>

        </div>
    </div>

</div>

