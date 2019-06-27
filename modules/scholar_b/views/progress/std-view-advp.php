<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 8/5/2561
 * Time: 22:27
 */

use yii\bootstrap\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use app\modules\scholar_b\controllers;
$this->registerJsFile('@web/ckeditor/ckeditor.js');
?>
    <header id="page-header">
        <h1><?= controllers::t('label', 'ความคิดเห็นจากอาจารย์ที่ปรึกษาโครงงาน') ?></h1>
        <ol class="breadcrumb">
            <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
            <li class=""><a href="../progress/select"><?= controllers::t('label', 'ครั้งการรายงาน') ?></a></li>
            <li class="active"><a href="../progress/std-index?seq=<?=$progress_seq?>&sem=<?=$semester_select?>&year_select=<?=$year_select?>"><?= controllers::t('label', 'รายงานความก้าวหน้านักศึกษาทุน') ?></a></li>
            <li class="active"><?= controllers::t('label', 'ความคิดเห็นจากอาจารย์ที่ปรึกษาโครงงาน') ?></li>
        </ol>
    </header>
<?php $form = ActiveForm::begin(); ?>
    <div class="scb-progress-report-select">
        <div id="content" class="padding-20">
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <center>
                                                    <h4>ความคิดเห็นจากอาจารย์ที่ปรึกษาโครงงาน</h4>
                                                        <br>ในการรายงานความก้าวหน้านักศึกษาทุน ครั้งที่ <?= $progress_seq ?>
                                                        ภาคการศึกษาที่ <?= $semester_select ?>
                                                        ประจำปีการศึกษา <?= $year_select ?>
                                                        <br>โครงงาน<?= $project_student->projectCode->project_name ?>
                                                    </h4>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-bordered-dashed margin-bottom-30 slimscroll" style="height: 170px !important;" data-always-visible="true" data-rail-visible="true"
                                             data-railOpacity="1"
                                             data-height="220"></span>
                                            <center><h5><strong>ความเห็นอาจารย์ที่ปรึกษาโครงงาน</strong></h5></center>
                                            <?= \yii\helpers\HtmlPurifier::process($model_comment->comment) ?>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-bordered-dashed margin-bottom-30" style="height: 170px !important;"><!-- DASHED --></span>
                                <center><h5><strong>ผลการพิจารณา</strong></h5></center>
                                <?php if($model_comment->result == 1){
                                    ?>
                                <div class="alert alert-success">
                                    <center><strong>ผ่าน</strong></center>
                                </div>
                                    <?php } else if ($model_comment->result == 0){?>
                                <div class="alert alert-danger">
                                    <center><strong>ไม่ผ่าน</strong></center>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-bordered-dashed margin-bottom-30" style="height: 170px !important;"><!-- DASHED --></span>
                                <center><h5><strong>อาจารย์ที่ปรึกษาโครงงาน</strong></h5></center>
                                <p><center><h5>( <?= $central_person->PREFIXNAME. $central_person->person_name."  ".$central_person->person_surname ?> )</h5></center></p>
                                <p><center><h5>( <?php echo Yii::$app->thaiFormatter->asDate($model_comment->udtime, 'short'); ?> )</h5></center></p>
                            </div>
                        </div>

                    </div>


                </div>


            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>