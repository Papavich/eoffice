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
use app\modules\scholar_b\controllers;
$this->registerJsFile('@web/ckeditor/ckeditor.js');
?>
<?= Html::csrfMetaTags() ?>

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
                                                <h4>ลงความคิดเห็นโครงงาน
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
                                    <?= $form->field($model_comment, 'comment')->widget(CKEditor::className(), [
                                        'options' => ['rows' => 3],
                                        'preset' => 'basic',
//        'clientOptions' => [
//            'filebrowserUploadUrl' => yii\helpers\Url::toRoute(['site/upload']),
//    ]
                                    ])->label('ความเห็นของอาจารย์ที่ปรึกษาโครงงาน (ผลงาน/โครงงาน มีความก้าวหน้าเป็นที่น่าพอใจหรือไม่ อย่างไร นักศึกษาสามารถดำเนินการวิจัยให้ได้ผลตามที่เสนอไว้ได้ทันกำหนดเวลาหรือไม่ หรือความเห็นอื่นๆ)') ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-bordered-dashed margin-bottom-30"><!-- DASHED --></span>
                            <center><h5><strong>ผลการพิจารณา</strong></h5></center>
                            <?= $form->field($model_comment, 'result')->radio(['label' => 'ผ่าน', 'value' => 1, 'uncheck' => null])  ?>
                            <?= $form->field($model_comment, 'result')->radio(['label' => 'ไม่ผ่าน', 'value' => 0, 'uncheck' => null]) ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="alert alert-bordered-dashed margin-bottom-30"><!-- DASHED --></span>
                            <center><h5><strong>ลงชื่อ</strong></h5></center>
                            <p>
                            <center><h5>
                                    ( <?= $central_person->PREFIXNAME . $central_person->person_name . "  " . $central_person->person_surname ?>
                                    )</h5></center>
                            </p>
                            <p>
                            <center><h5>( <?php $time = time();
                                    echo Yii::$app->thaiFormatter->asDate($time, 'short'); ?> )</h5></center>
                            </p>
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
