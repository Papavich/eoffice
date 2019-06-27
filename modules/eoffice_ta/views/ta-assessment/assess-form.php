<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 4/1/2561
 * Time: 15:13
 */
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaAssessmentOpen;
?>
<?php
$title = "จัดการประเมิน";
$back = controllers::t( 'label', 'Back' );
$this->title = $title;
?>
<!-- page title -->

<!-- /page title -->
<div id="content" class="padding-20">
    <!--
                      PANEL CLASSES:
                          panel-default
                          panel-danger
                          panel-warning
                          panel-info
                          panel-success

                      INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
                              All pannels should have an unique ID or the panel collapse status will not be stored!
                  -->
    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong></strong> <!-- panel title -->
							</span>

            <!-- right options -->
            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                <li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
            </ul>
            <!-- /right options -->

        </div>

        <!-- panel content -->


        <div class="panel-body">

            <button type="button" class="btn btn-3d btn-reveal btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> สร้างฟอร์มประเมิน</button>
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- header modal -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myLargeModalLabel">สร้างแบบฟอร์มการประเมิน</h4>
                        </div>
                        <!-- body modal -->
                        <div class="modal-body">

                            <div class="form-group">
                                <label>ชื่อแบบฟอร์มการประเมิน</label>
                                <input type="text" name="contact[first_name]" value="" class="form-control required">
                                <label>ผู้ประเมิน</label>
                                <input type="text" name="contact[last_name]" value="" class="form-control required">
                                <label>ภาคเรียน</label>
                                <input type="text" name="contact[last_name]" value="" class="form-control required">
                                <label>ปีการศึกษา</label>
                                <input type="text" name="contact[last_name]" value="" class="form-control required">
                                <label>หมายเหตุ</label>
                                <input type="text" name="contact[last_name]" value="" class="form-control required">

                            </div>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">บันทึก</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>

                        </div>
                    </div>
                </div>
            </div>
            <br></br>

            <table class="table table-striped table-hover table-bordered" id="sample_editable">
                <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อฟอร์ม</th>
                    <th>ผู้ประเมิน</th>
                    <th>ภาคเรียน</th>
                    <th>ช่วงประเมิน</th>
                    <th>ปีการศึกษา</th>
                    <th>หมายเหตุ</th>
                    <th>สถานะการประเมิน</th>
                    <th>วันที่สร้าง</th>
                </tr>
                </thead>
                <?php
                $n=1;
                foreach ($model as $row){

                ?>
                <tbody>
                <tr>
                    <td><?=$n?></td>
                    <td><?=$row->ta_assessment_id?></td>
                    <td><?=$row->ta_assessment_name?></td>
                    <td><?=$row->type_user?></td>
                    <td><?=$row->past?></td>

                    <td>
                        <?php
                        $modelassopen = TaAssessmentOpen::findOne(['ta_assessment_id' => $row->ta_assessment_id
                            ,'past' => $row->past]);
                        ?>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>


                </tbody>

                <?php
                    $n=$n+1;
                } ?>
            </table>
            <div  class="text-right">


                <a href="#" class="btn btn-warning"></i>กลับสู่หน้าหลัก</a>


            </div>

        </div>