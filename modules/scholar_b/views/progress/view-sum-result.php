<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor;

?>

<?php $form = ActiveForm::begin(); ?>
    <div id="content" class="padding-20">
        <div class="panel-body">

            <div class="alert alert-bordered-dashed margin-bottom-30 ">
                <center><h5><strong>ผลการพิจารณาจากคณะกรรมการพัฒนานักศึกษาเพื่อการแข่งขันภาควิชา</strong>
                    </h5></center>

                <?php $countP = 0;
                $countF = 0;
                foreach ($progress_comment_all

                         as $rows) { ?>
                    <div class="toggle transparent">
                        <div class="toggle">
                            <label> <?php
                                $central_view = \app\modules\scholar_b\models\model_main\EofficeCentralViewPisPerson::find()->where(['person_card_id' => $rows->teacher_id_card])->one();

                                if ($rows->result == 1) {
                                    $countP++;
                                    ?>
                                    <div class="col-md-2">
                                        <center><strong class="text-green">ผ่าน</strong></center>
                                    </div>
                                <?php } else if ($rows->result == 0) {
                                    $countF++; ?>
                                    <div class="col-md-2">
                                        <center><strong class="text-red">ไม่ผ่าน</strong></center>
                                    </div>

                                <?php } ?>
                                <span>ความเห็นโดย </span><?= $central_view->PREFIXABB . $central_view->person_name . "  " . $central_view->person_surname ?>
                                <span>( <?= Yii::$app->thaiFormatter->asDate($rows->udtime, 'short') ?> )</span>
                            </label>
                            <div class="toggle-content" style="display: none;">
                                <p><?= \yii\helpers\HtmlPurifier::process($rows->comment) ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <br>
                <center><h4>ผ่าน <?= $countP ?></h4></center>
                <center><h4>ไม่ผ่าน <?= $countF ?></h4></center>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-bordered-dashed margin-bottom-30" style="height: 250px !important;"><!-- DASHED --></span>
                        <center><h5><strong>ข้อมูลนักศึกษา</strong></h5></center>
                        <div class="col-md-12">
                            <label>ความก้าวหน้าครั้งที่ <?= $seq ?> ภาคการศึกษาที่ <?= $sem ?>
                                ประจำปีการศึกษา <?= $year_select ?></label>
                            <label>ชื่อ-สกุล
                                : <?= $student_central->PREFIXNAME ?>  <?= $student_central->STUDENTNAME ?>  <?= $student_central->STUDENTSURNAME ?></label>
                            </br><label>เลขประจำตัว นศ. : <?php echo $student_id ?> / ชั้นปีที่
                                : <?= $student_central->STUDENTYEAR ?></label>
                            <?php $major = \app\modules\scholar_b\models\model_main\EofficeCentralViewPisMajor::find()->where(['id' => $student_central->major_id])->one(); ?>

                            </br><label>สาขาวิชา : <?= $major->name_th ?></label>
                            <?php $student_sc = \app\modules\scholar_b\models\ScbStudent::find()->where(['student_id' => $student_id])->one();
                            ?>

                            </br><label>ประเภททุน
                                : <?= $student_sc->scholarship->scname->scholarship_name . " พ.ศ. " . $student_sc->scholarship->scholarship_year; ?></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="alert alert-bordered-dashed margin-bottom-30" style="height: 250px !important;"><!-- DASHED --></span>
                        <center><h5><strong>ผลการประเมินโดยรวม</strong></h5></center>
                        <?php if($progress_find->sum_result == 1){
                            ?>
                            <div class="alert alert-success">
                                <center><strong>ผ่าน</strong></center>
                            </div>
                        <?php } else if ($progress_find->sum_result == 0){?>
                            <div class="alert alert-danger">
                                <center><strong>ไม่ผ่าน</strong></center>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>


        </div>
    </div>


<?php ActiveForm::end(); ?>