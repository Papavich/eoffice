<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 28/1/2561
 * Time: 16:11
 */

use yii\widgets\ActiveForm;

?>
<header id="page-header">
    <h1><strong>รายงานประจำปีงบประมาณ</strong></h1>
    </header>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php $form = ActiveForm::begin();?>
                        <div class="row" align="center">
                            <div class="col-md-3">
                                <select class="form-control" name="year">
                                    <option disabled="disabled" selected="selected">เลือกปีงบประมาณ</option>
                                    <?php
                                    $date  = date("Y")+545;
                                        for ($i = 2560;$i < $date;$i++){
                                            echo "<option value='".$i."'>".$i."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info" href="" target="_blank"><i
                                            class="fa fa-search"></i> ค้นหา</button>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                    <div class="row margin-top-20">
                        <div class="col-md-12">
                            <table id="table_report" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th width="35%">ชื่อโครงการ</th>
                                    <th>สถานะ</th>
                                    <th width="15%">ผู้รับผิดชอบโครงการ</th>
                                    <th>เงินที่ได้รับ</th>
                                    <th>เงินที่ใช้จ่าย</th>
                                    <th>ยอดคงเหลือ</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>โครงการ Comp สีอิฐ</td>
                                    <td>เสร็จสิ้น</td>
                                    <td>นางสาววิจิตรา  ขจร</td>
                                    <td>50000</td>
                                    <td>50000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>โครงการคืนสู่เหย้าภาควิชาวิทยาการคอมพิวเตอร์</td>
                                    <td>เสร็จสิ้น</td>
                                    <td>นางสาววิจิตรา  ขจร</td>
                                    <td>200000</td>
                                    <td>150000</td>
                                    <td>50000</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>โครงการส่งเสริมให้มีการสอดแทรกคุณธรรม จริยธรรม ทักษะการใช้ชีวิต ภาควิชาวิทยาการคอมพิวเตอร์</td>
                                    <td>เสร็จสิ้น</td>
                                    <td>นางสาววิจิตรา  ขจร</td>
                                    <td>200000</td>
                                    <td>200000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>โครงการฝึกอบรมการป้องกันและบรรเทาอัคคีภัยเบื้องต้น</td>
                                    <td>เสร็จสิ้น</td>
                                    <td>นางสาววิจิตรา  ขจร</td>
                                    <td>50000</td>
                                    <td>30000</td>
                                    <td>20000</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>โครงการประชุมวิชาการภาควิชาวิทยาการคอมพิวเตอร์</td>
                                    <td>เสร็จสิ้น</td>
                                    <td>นางสาววิจิตรา  ขจร</td>
                                    <td>50000</td>
                                    <td>50000</td>
                                    <td>0</td>
                                </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4">รวม</td>
                                    <td>550000</td>
                                    <td>480000</td>
                                    <td>70000</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row margin-top-10">
                        <div class="col-md-2 pull-right">
                            <a class="btn btn-success word-export" href="" target="_blank">
                                <i class="glyphicon glyphicon-circle-arrow-down"></i> ดาวโหลดเอกสาร
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

