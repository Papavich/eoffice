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
<?= Html::csrfMetaTags() ?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'รายงานผลโครงงาน') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class=""><a href="../progress/select"><?= controllers::t('label', 'ครั้งการรายงาน') ?></a></li>
        <li class="active"><a href="../progress/std-index?seq=<?=$progress_seq?>&sem=<?=$semester_select?>&year_select=<?=$year_select?>"><?= controllers::t('label', 'รายงานความก้าวหน้าหนักศึกษาทุน') ?></a></li>
        <li class="active"><?= controllers::t('label', 'รายงานผลโครงงาน') ?></li>
    </ol>
</header>
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
                                    <br>ในการรายงานความก้าวหน้านักศึกษาทุน ครั้งที่ <?= $progress_seq ?> ภาคการศึกษาที่ <?= $semester_select ?>
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
                            <?= $form->field($model_progress, 'proj_summary')->widget(CKEditor::className(), [
                                'options' => ['rows' => 3],
                                'preset' => 'basic',
//        'clientOptions' => [
//            'filebrowserUploadUrl' => yii\helpers\Url::toRoute(['site/upload']),
//    ]
                            ])->label('1. ให้สรุปสั้นๆ ประมาณ 10-15 บรรทัดเกี่ยวกับความก้าวหน้าโดยภาพรวมของโครงงานทั้งหมด') ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <?= $form->field($model_progress, 'proj_activity')->widget(CKEditor::className(), [
                                'options' => ['rows' => 3],
                                'preset' => 'basic',
//        'clientOptions' => [
//            'filebrowserUploadUrl' => yii\helpers\Url::toRoute(['site/upload']),
//    ]
                            ])->label('2. ให้ระบุกิจกรรมโครงงานที่ทำในภาคการศึกษานี้รวมทั้งการเข้าพบอาจารย์ที่ปรึกษา และให้ระบุว่างานที่สำเร็จอย่างเป็นรูปธรรมของภาคการศึกษานี้คืออะไรบ้าง') ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <?= $form->field($model_progress, 'proj_factual')->widget(CKEditor::className(), [
                                'options' => ['rows' => 3],
                                'preset' => 'basic',
//        'clientOptions' => [
//            'filebrowserUploadUrl' => yii\helpers\Url::toRoute(['site/upload']),
//    ]
                            ])->label('3. ให้ระบุว่างานที่สำเร็จอย่างเป็นรูปธรรมของภาคการศึกษานี้คืออะไรบ้าง') ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <?= $form->field($model_progress, 'proj_problem')->widget(CKEditor::className(), [
                                'options' => ['rows' => 3],
                                'preset' => 'basic',
//        'clientOptions' => [
//            'filebrowserUploadUrl' => yii\helpers\Url::toRoute(['site/upload']),
//    ]
                            ])->label('4. ให้ระบุปัญหาและอุปสรรคในการทำโครงงาน') ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <?= $form->field($model_progress, 'proj_plan_next_year')->widget(CKEditor::className(), [
                                'options' => ['rows' => 3],
                                'preset' => 'basic',
//        'clientOptions' => [
//            'filebrowserUploadUrl' => yii\helpers\Url::toRoute(['site/upload']),
//    ]
                            ])->label('5. แผนงานที่จะทำในภาคการศึกษาต่อไป') ?>

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
                            <?= $form->field($model_progress, 'plan_year1')->widget(CKEditor::className(), [
                                'options' => ['rows' => 3],
                                'preset' => 'basic',
//        'clientOptions' => [
//            'filebrowserUploadUrl' => yii\helpers\Url::toRoute(['site/upload']),
//    ]
                            ])->label('แผนการเข้าร่วมประกวดหรือแข่งขัน ปี 1') ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <?= $form->field($model_progress, 'plan_year2')->widget(CKEditor::className(), [
                                'options' => ['rows' => 3],
                                'preset' => 'basic',
//        'clientOptions' => [
//            'filebrowserUploadUrl' => yii\helpers\Url::toRoute(['site/upload']),
//    ]
                            ])->label('แผนการเข้าร่วมประกวดหรือแข่งขัน ปี 2') ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <?= $form->field($model_progress, 'plan_year3')->widget(CKEditor::className(), [
                                'options' => ['rows' => 3],
                                'preset' => 'basic',
//        'clientOptions' => [
//            'filebrowserUploadUrl' => yii\helpers\Url::toRoute(['site/upload']),
//    ]
                            ])->label('แผนการเข้าร่วมประกวดหรือแข่งขัน ปี 3') ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <?= $form->field($model_progress, 'plan_year4')->widget(CKEditor::className(), [
                                'options' => ['rows' => 3],
                                'preset' => 'basic',
//        'clientOptions' => [
//            'filebrowserUploadUrl' => yii\helpers\Url::toRoute(['site/upload']),
//    ]
                            ])->label('แผนการเข้าร่วมประกวดหรือแข่งขัน ปี 4') ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group" align="center">
                        <div class="col-md-12">
                            <?= Html::submitButton('<i class="glyphicon glyphicon-save"></i>' . ' Save ', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
