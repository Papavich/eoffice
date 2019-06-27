
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\modules\scholar_b\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbScholarshipTypeHasYear */
$data = \app\modules\scholar_b\models\ScbScholarshipType::find()->where(['scholarship_id' => $model->scholarship_id])->one();
$this->title = $data->scholarship_name;
$this->params['breadcrumbs'][] = ['label' => controllers::t('label', 'Scholarship each Year'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- page title -->
<header id="page-header">
    <h1>รายละเอียดของทุนช้างเผือก</h1>
</header>
<!-- /page title -->

<!-- Pagination -->
<div id="content" class="padding-20">
    <div id="content" class="padding-20">
        <div class="panel-body">
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span>
                                <b><?php echo controllers::t('label', 'Scholarship'); ?></b>
                            </div>
                            <div class="panel-body" style="height: 120px;">
                                <label> <?php echo controllers::t('label', 'Scholarship Name'); ?>
                                    :</label> <?php $data = \app\modules\scholar_b\models\ScbScholarshipType::find()->where(['scholarship_id' => $model->scholarship_id])->one();
                                echo $data->scholarship_name;
                                ?>
                                <br> <label><?php echo controllers::t('label', 'Year'); ?> : </label>
                                <?php echo $model->scholarship_year; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
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
                <div class="panel-heading"><span class="glyphicon glyphicon-inbox"></span>
                    <b><?php echo controllers::t('label', 'Download Document'); ?></b></div>
                <div class="panel-body">


                    <?php echo Html::a(' ' . controllers::t('label', 'Click for Download', ['class' => 'btn btn-primary']), '@web/web_scb/uploads/scb_detail/files/' . $model->scholarship_file, ['class' => 'glyphicon glyphicon-download-alt btn btn-default btn-sm']) ?>

                </div>
            </div>
        </div>
    </div>


    <div class="padding-20" align="right">
        <a class="btn btn-success btn-reveal pull-left"
           href="../login/login-success">กลับสู่หน้าหลัก</a>
        <a class="btn btn-success" href="../scholarship/register1">ถัดไป</a>

    </div>


</div>
<!-- /panel content -->
<!-- /Pagination -->

