<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 2/5/2561
 * Time: 17:53
 */


use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use app\modules\scholar_b\controllers;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
$this->registerJsFile('@web/ckeditor/ckeditor.js')
?>
<?= Html::csrfMetaTags() ?>

<div id="content" class="padding-20">
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
        <div id="panel-1" class="panel panel-default ">
            <div class="panel-heading">
                <span class="title elipsis"><strong>เพิ่มโครงงาน</strong> <!-- panel title --></span>
            </div>

            <div class="padding-20">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-8 col-sm-8">
                            <?= $form->field($model_project, 'project_name')->textInput()->label('ชื่อโครงงาน') ?>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <?php
                            foreach ($proj_type as $rows) {
                                $array_type[$rows->type_id] = $rows->type_name;
                            } ?>
                            <?= $form->field($model_project, 'project_type_id')->dropDownList($array_type, [
                                'prompt' => 'เลือกประเภทโครงงาน', [
                                    'disabled' => true,
                                ]
                            ])->label('ประเภทโครงงาน') ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-2 col-sm-2">
                            <?php
                            foreach ($semes_year as $rows) {
                                $array_year[$rows->year] = $rows->year;
                                $array_sems[$rows->semester] = $rows->semester;
                            } ?>
                            <?= $form->field($student_project, 'semester')->dropDownList($array_sems, [
                                'prompt' => 'เลือกเทอม', [
                                    'disabled' => true,
                                ]
                            ])->label('ภาคการศึกษา') ?>
                            <?= $form->field($student_project, 'student_id')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false) ?>
                        </div>

                        <div class="col-md-2 col-sm-2">
                            <?= $form->field($student_project, 'year')->dropDownList($array_year, [
                                'prompt' => 'ปีการศึกษา', [
                                    'disabled' => true,
                                ]
                            ])->label('ปีการศึกษา') ?>
                        </div>

                        <div class="col-md-2 col-sm-2">
                            <?= $form->field($model_project, 'project_date')->widget(DatePicker::classname(), [
                                'language' => 'th',
                                'dateFormat' => 'yyyy-MM-dd',
                                'clientOptions' => [
                                    'changeMonth' => true,
                                    'changeYear' => true,
                                ],
                                'options' => ['class' => 'form-control'],
                            ])->label('วันที่เริ่มโครงงาน') ?>
                        </div>

                        <div class="col-md-2 col-sm-2">
                            <?= $form->field($model_project, 'project_status')->textInput()->label('% ความก้าวหน้า') ?>
                        </div>

                        <div class="col-md-4 col-sm-4">


                            <label>อาจารย์ที่ปรึกษาหลัก</label>
                            <select name="adviser_main" class="form-control">
                                <option selected="selected" disabled="disabled">
                                    เลือกอาจารย์ที่ปรึกษาหลัก
                                </option>
                                <?php
                                foreach ($adviser_central as $rows) {
                                    if($adviser_main == $rows->person_card_id){
                                        echo "<option selected='selected' value='" . $rows->person_card_id . "'>" . $rows->PREFIXABB . $rows->person_name . "  " . $rows->person_surname . "</option>";

                                    }else{
                                        echo "<option value='" . $rows->person_card_id . "'>" . $rows->PREFIXABB . $rows->person_name . "  " . $rows->person_surname . "</option>";

                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($model_project, 'project_file')->fileInput() ?>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($model_project, 'project_image')->fileInput() ?>
                        </div>
                        <div class="col-md-4 col-sm-4 pull-right">
                            <label>อาจารย์ที่ปรึกษาร่วม</label>
                            <select name="adviser_co" class="form-control">
                                <option selected="selected" disabled="disabled">
                                    เลือกอาจารย์ที่ปรึกษาร่วม
                                </option>
                                <?php
                                foreach ($adviser_central as $rows) {
                                    if($adviser_co == $rows->person_card_id){
                                        echo "<option selected='selected' value='" . $rows->person_card_id . "'>" . $rows->PREFIXABB . $rows->person_name . "  " . $rows->person_surname . "</option>";

                                    }else{
                                        echo "<option value='" . $rows->person_card_id . "'>" . $rows->PREFIXABB . $rows->person_name . "  " . $rows->person_surname . "</option>";

                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                            <?= $form->field($model_project, 'project_detail')->widget(CKEditor::className(), [
                                'options' => ['rows' => 6],
                                'preset' => 'standard',
//        'clientOptions' => [
//            'filebrowserUploadUrl' => yii\helpers\Url::toRoute(['site/upload']),
//    ]
                            ])->label('รายละเอียดโครงงาน') ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2">
                                <?= \yii\helpers\Html::submitButton('<i class="fa fa-plus"></i>' . controllers::t('label', 'Save') . '', ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>

                    <br>

                </div>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
