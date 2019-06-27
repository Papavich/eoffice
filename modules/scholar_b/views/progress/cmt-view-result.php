<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 8/5/2561
 * Time: 22:27
 */

use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;

$this->registerJsFile('@web/ckeditor/ckeditor.js');
?>
<?php $form = ActiveForm::begin(); ?>
<div class="scb-progress-report-select">
    <div id="content" class="padding-20">
        <div class="panel-body">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <center>
                                    <h4>รายงานผลโครงงาน
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
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">1. สรุปเกี่ยวกับความก้าวหน้าโดยภาพรวมของโครงงานทั้งหมด
                                </div>
                                <div class="panel-body slimscroll" data-always-visible="true" data-rail-visible="true"
                                     data-railOpacity="1"
                                     data-height="180">
                                    <?= \yii\helpers\HtmlPurifier::process($model_progress->proj_summary) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">2.
                                    กิจกรรมโครงงานที่ทำในภาคการศึกษานี้รวมทั้งการเข้าพบอาจารย์ที่ปรึกษา
                                    และงานที่สำเร็จอย่างเป็นรูปธรรมของภาคการศึกษานี้
                                </div>
                                <div class="panel-body slimscroll" data-always-visible="true" data-rail-visible="true"
                                     data-railOpacity="1"
                                     data-height="180">
                                    <?= \yii\helpers\HtmlPurifier::process($model_progress->proj_activity) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">3. งานที่สำเร็จอย่างเป็นรูปธรรมของภาคการศึกษานี้
                                </div>
                                <div class="panel-body slimscroll" data-always-visible="true" data-rail-visible="true"
                                     data-railOpacity="1"
                                     data-height="180">
                                    <?= \yii\helpers\HtmlPurifier::process($model_progress->proj_factual) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">4. ปัญหาและอุปสรรคในการทำโครงงาน
                                </div>
                                <div class="panel-body slimscroll" data-always-visible="true" data-rail-visible="true"
                                     data-railOpacity="1"
                                     data-height="180">
                                    <?= \yii\helpers\HtmlPurifier::process($model_progress->proj_problem) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">5. แผนงานที่จะทำในภาคการศึกษาต่อไป
                                </div>
                                <div class="panel-body slimscroll" data-always-visible="true" data-rail-visible="true"
                                     data-railOpacity="1"
                                     data-height="180">
                                    <?= \yii\helpers\HtmlPurifier::process($model_progress->proj_plan_next_year) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <center><h4>แผนการเข้าร่วมประกวดหรือแข่งขัน ตลอดจนสำเร็จการศึกษา</h4></center>
                                <br>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">แผนการเข้าร่วมประกวดหรือแข่งขัน ปี 1
                                </div>
                                <div class="panel-body slimscroll" data-always-visible="true" data-rail-visible="true"
                                     data-railOpacity="1"
                                     data-height="180">
                                    <?= \yii\helpers\HtmlPurifier::process($model_progress->plan_year1) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">แผนการเข้าร่วมประกวดหรือแข่งขัน ปี 2
                                </div>
                                <div class="panel-body slimscroll" data-always-visible="true" data-rail-visible="true"
                                     data-railOpacity="1"
                                     data-height="180">
                                    <?= \yii\helpers\HtmlPurifier::process($model_progress->plan_year2) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">แผนการเข้าร่วมประกวดหรือแข่งขัน ปี 3
                                </div>
                                <div class="panel-body slimscroll" data-always-visible="true" data-rail-visible="true"
                                     data-railOpacity="1"
                                     data-height="180">
                                    <?= \yii\helpers\HtmlPurifier::process($model_progress->plan_year3) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">แผนการเข้าร่วมประกวดหรือแข่งขัน ปี 4
                                </div>
                                <div class="panel-body slimscroll" data-always-visible="true" data-rail-visible="true"
                                     data-railOpacity="1"
                                     data-height="180">
                                    <?= \yii\helpers\HtmlPurifier::process($model_progress->plan_year4) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
