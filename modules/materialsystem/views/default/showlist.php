<!-- page title -->
<header id="page-header">
    <h1>รายการใบเบิกวัสดุ</h1>
</header>
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

    <div id="panel-3" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>รายการรับเข้าทั้งหมด</strong> <!-- panel title -->
							</span>

            <!-- right options -->
            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                       data-placement="bottom"></a></li>
                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen"
                       data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                <li><a href="#" class="opt panel_close" data-confirm-title="Confirm"
                       data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip"
                       title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
            </ul>
            <!-- /right options -->

        </div>

        <!-- panel content -->
        <div class="panel-body">
            <h3 align="center">รายการนำเข้าวัสดุผ่านระบบ KKUFMIS</h3>
            <span class="col-md-3"></span>
            <span class="col-md-4"></span>
            <p class="col-md-5">
                <b>เลขที่เอกสาร : </b>01xxxxxxx/00041<br><br>
                <b>วันที่</b> 23 มิถุนายน 2560
            </p>
            <p>
                <b>่บันทึกที</b> ศธ 0514.2.9/400<br><br>
                ทำการตรวจรับวัสดุของ บริษัท _ _ _ _ _ _ _ _ _ _ _<br><br>
                วัตถุประสงค์ _ _ _ _ _ _ _ _ _<br><br>
                ใบเสร็จรับเงิน เล่มที่ _ _ _ _ _ _ _ _ _ _ _ _ _ เลขที่ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ลงวันที่ _ _ _ _ _ _ _ _ _ _ _ _ ตามรายการข้างล่างนี้
            </p>
            </span>
            </span>
            </span>
            <br>
            <table class="table table-striped table-bordered table-hover" id="sample_3">
                <thead>
                <tr>
                    <th width="5%">ลำดับ</th>
                    <th>ชื่อรายการ</th>
                    <th width="25%">ชื่อวัสดุ</th>
                    <th width="15%">จำนวน</th>
                    <th width="15%">ราคาต่อหน่วย</th>
                    <th width="15%">จำนวนเงิน</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td align="center">1</td>
                    <td>ปากกา</td>
                    <td>
                        <div>
                            <div id="btnDetail0">
                                <i class="fa fa-pencil"></i>
                                <label>เพิ่มรายละเอียด</label>
                            </div>
                            <input type="text" id="detail0" name="detail0" style="display:none">
                        </div>
                    </td>
                    <td>12 ด้าม</td>
                    <td>7.00</td>
                    <td>84.00</td>
                </tr>
                <tr>
                    <td align="center">2</td>
                    <td>กาแฟ 3 in 1</td>
                    <td>
                        <div>
                            <div id="btnDetail1">
                                <i class="fa fa-pencil"></i>
                                <label>เพิ่มรายละเอียด</label>
                            </div>
                            <input type="text" id="detail1" name="detail1" style="display:none">
                        </div>
                    </td>
                    <td>10 ถุง</td>
                    <td>169.00</td>
                    <td>1690.00</td>
                </tr>
                <tr>
                    <td align="center">3</td>
                    <td>กาแฟ 3 in 1</td>
                    <td>
                        <div>
                            <div id="btnDetail2">
                                <i class="fa fa-pencil"></i>
                                <label>เพิ่มรายละเอียด</label>
                            </div>
                            <input type="text" id="detail2" name="detail2" style="display:none">
                        </div>
                    </td>
                    <td>7 ถุง</td>
                    <td>197.00</td>
                    <td>1379.00</td>
                </tr>
                </tr>
                <tr>
                    <td align="center">4</td>
                    <td>กระดาษ A4</td>
                    <td>
                        <div>
                            <div id="btnDetail3">
                                <i class="fa fa-pencil"></i>
                                <label>เพิ่มรายละเอียด</label>
                            </div>
                            <input type="text" id="detail3" name="detail3" style="display:none">
                        </div>
                    </td>
                    <td>15</td>
                    <td>100.00</td>
                    <td>150.00</td>
                </tr>
                <tr>
                    <td align="center">5</td>
                    <td>ยางลบ</td>
                    <td>
                        <div>
                            <div id="btnDetail4">
                                <i class="fa fa-pencil"></i>
                                <label>เพิ่มรายละเอียด</label>
                            </div>
                            <input type="text" id="detail4" name="detail4" style="display:none">
                        </div>
                    </td>
                    <td>18 ก้อน</td>
                    <td>2.00</td>
                    <td>36.00</td>
                </tr>
                <tr>
                    <td></td>
                    <td>รวม</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>2355.00</td>
                </tr>

                <tr>
                    <td></td>
                    <td>ราคาก่อนหักส่วนลด (ไม่รวมภาษีมูลค่าเพิ่ม)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>2355.00</td>
                </tr>
                <tr>
                    <td></td>
                    <td>ราคาทั้งหมด (่รวมภาษีมูลค่าเพิ่ม)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>4520.00</td>
                </tr>

                </tbody>
            </table>

            <span class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <a href="#" class="btn btn-3d btn-success btn-xl btn-block margin-top-30">
                    <i class="glyphicon glyphicon-edit" aria-hidden="false"></i>บันทึก
                </a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <a href="#" class="btn  btn-warning btn-xl btn-block margin-top-30" data-toggle="modal" data-target="myDetail">
                    <i class="glyphicon glyphicon-alert" aria-hidden="false"></i>บันทึกเป็นวัสดุผ่านมือ
                </a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <a href="#" class="btn btn-danger btn-xl btn-block margin-top-30">
                    <i class="glyphicon glyphicon-remove" aria-hidden="false"></i>ยกเลิก
                </a>
            </div>

        </span>

        </div>
        <!-- /panel content -->

    </div>
    <!-- /PANEL -->
    <!-- ============================= modal ====================================-->
    <div id="myDetail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">รายละเอียด</h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p><img src="noavata"></p>
                    <p>ชื่อวัสดุ : ปากกา
                        <br> : ดินสอ
                        <br> : กระดาษ A4
                        <br> : หมึกสีดำ
                    </p>
                    <p>วัตถุประสงค์ : ใช้เพื่อประกอบการเรียนการสอน ภายในภาควิชาวิทยาการคอมพิวเตอร์</p>
                    <p>หมวดหมู่ : วัสดุทั่วไป</p>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================= modal ====================================-->
</div>