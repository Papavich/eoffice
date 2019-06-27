<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 30/4/2561
 * Time: 23:18
 */

use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use app\modules\scholar_b\controllers;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;


$this->registerJsFile('@web/ckeditor/ckeditor.js');
$this->registerJsFile('@web/web_scb/js/tabmenu.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?= Html::csrfMetaTags() ?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Project') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class="active"><?= controllers::t('label', 'List Project') ?></a></li>
    </ol>
</header>
<!-- /page title -->
<div id="content" class="padding-20">
    <div class="panel-body">
        <div class="tabs nomargin">
            <!-- tabs -->
            <ul class="nav nav-tabs nav-justified tabmenu">
                <li class="active">
                    <a href="#jtab1_nobg" data-toggle="tab" aria-expanded="false">
                        <i class="fa fa-bars"></i> รายชื่อโครงงาน
                    </a>
                </li>
                <li class="">
                    <a href="#jtab2_nobg" data-toggle="tab" aria-expanded="false">
                        <i class="fa fa-cogs"></i> เพิ่มโครงงาน
                    </a>
                </li>
            </ul>

            <!-- tabs content -->
            <div class="tab-content transparent">
                <div id="jtab1_nobg" class="tab-pane active">
                    <div class="panel-heading">
                     <span class="title elipsis">
                         <strong>รายชื่อโครงงาน</strong> <!-- panel title -->
                     </span>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="panel-body">
                                <div class="col-md-4">
                                    <label>ปีการศึกษา</label>
                                    <select name="contact[position]" class="form-control pointer required">
                                        <option disabled selected value>--- ปีการศึกษา ---</option>
                                        <option value="2560">2560</option>
                                        <option value="2559">2559</option>
                                        <option value="2558">2558</option>
                                        <option value="2557">2557</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="radio-inline"><input type="radio" name="optradio">โครงงานที่กำลังดำเนินการ</label>
                                    <br><label class="radio-inline"><input type="radio" name="optradio">โครงงานที่สำเร็จแล้ว</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- Scorbar -->
                        <div class="panel-body">
                            <div class="slimscroll" data-always-visible="true" data-rail-visible="true"
                                 data-railOpacity="1"
                                 data-height="300">
                                <table class="table table-striped table-hover table-bordered"
                                       id="sample_editable_1">
                                    <thead>
                                    <tr>
                                        <th width="50%">
                                            <center>ชื่อโครงงาน</center>
                                        </th>
                                        <th width="10%">ปีการศึกษา</th>
                                        <th width="10%">วันที่เริ่มต้น</th>
                                        <th width="15%">สถานะการดำเนินงาน</th>
                                        <th width="15%"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    foreach ($find_std_project as $row) {

                                        ?>

                                        <tr>
                                            <td><?php echo $row->projectCode->project_name; ?></td>
                                            <td><?php echo $row->year; ?></td>
                                            <td><?php echo $row->projectCode->project_date; ?></td>
                                            <td>

                                                <div class="progress" style="width: 150px">
                                                    <div class="progress-bar progress-bar-striped active"
                                                         role="progressbar"
                                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                                         style="width:<?php echo $row->projectCode->project_status;?>%"><?php echo $row->projectCode->project_status."%"; ?>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>
                                                <div style="text-align:center;">
                                                    <a href="../project/view?project_code=<?=$row->project_code?>"
                                                       class="btn btn-success btn-xs">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="../project/update?student_id=<?php echo $row->student_id ?>&year=<?php echo $row->year?>&semester=<?php echo $row->semester?>&project_code=<?php echo $row->project_code?>"
                                                       class="btn btn-xs btn-info white"><i
                                                                class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="../project/deleteone?project_code=<?=$row->project_code?>"
                                                            class="btn btn-google btn-xs">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <div>
                                            </td>
                                        </tr>

                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /panel content -->
                    </div>
                    <!-- Scorbar -->
                </div>

                <!-- Start TAB2 -->
                <div id="jtab2_nobg" class="tab-pane">
                    <div id="jtab2_nobg" class="tab-pane">
                        <?php $form = ActiveForm::begin([
                            'action' => '../project/create',
                            'method' => 'post',
                        ]); ?>
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
                                                    echo "<option value='" . $rows->person_card_id . "'>" . $rows->PREFIXABB . $rows->person_name . "  " . $rows->person_surname . "</option>";
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
                                                    echo "<option value='" . $rows->person_card_id . "'>" . $rows->PREFIXABB . $rows->person_name . "  " . $rows->person_surname . "</option>";
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

                                        <div class="form-group" align="right">
                                            <div class="col-md-12">
                                                <?= \yii\helpers\Html::submitButton('<i class="fa fa-plus"></i>' . controllers::t('label', 'Save') . '', ['class' => 'btn btn-success']) ?>
                                            </div>
                                        </div>

                                    <br>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>