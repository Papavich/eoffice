<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<!--SHOW LIST SUBJECT TABLE-->
<div id="section-to-print">
    <div id="main_table" class="padding-20">
        <div id="panel-1" class="panel panel-default">
            <div align="right">
                <!-- page title -->
                <header id="page-header">
                    <?php $form = ActiveForm::begin(['action' => ['searchsubjectcondition']]) ?>
                    <div align="right " class="hidden-print">
                        <select id="sub_project" name="sub_project"
                                class="form-control pointer required valid inline-block"
                                style="width: 10% !important;">
                            <option disabled="disabled" selected="selected">- - ภาคการศึกษา - -</option>
                            <option value="1">โครงการปกติ</option>
                            <option value="2">โครงการพิเศษ</option>
                        </select>
                        <select id="sub_year" name="sub_year" class="form-control pointer required valid inline-block"
                                style="width: 10% !important;">
                            <option disabled="disabled" selected="selected">- - ปีการศึกษา - -</option>
                            <option value="2561">ปีการศึกษา 2561</option>
                        </select>
                        <button type="submit" class="btn btn-success btn-3d" style="display: inline;">Search</button>
                    </div>
                    <?php $form = ActiveForm::end(); ?>
                </header>
                <!-- /page title -->
            </div>
            <div align="left">
                <!-- page title -->
                <header id="page-header">
                    <strong>รายวิชาบังคับตามหลักสูตร</strong>
                </header>
                <!-- /page title -->
            </div>
            <!-- panel content -->
            <?php $form = ActiveForm::begin(['action' => ['test2']]) ?>
            <input name="nos" id="nos" type="text" value="123">
            <div id="conditionsection" style="margin-left: 50px ; display:">
                เลือกกลุ่มเรียนที่ต้องการ : <select id="section_no" name="section_no[]"
                                                    class="form-control pointer required valid inline-block"
                                                    style="width: 17% !important;" multiple>
                    <option disabled="disabled" selected="selected">เลือก Section</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                <button type="submit">คกลง</button>
            </div>
            <?php $form = ActiveForm::end(); ?>
        </div>
        <!--        </form>-->
    </div>
</div>


