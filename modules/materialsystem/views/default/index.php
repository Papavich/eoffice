<!-- page title -->
<header id="page-header">
    <h1>รายการรับเข้า</h1>
</header>

<div id="content" class="padding-20">



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

            <!-- Seacrch Page -->

            <div class="row">

                <!-- LEFT -->
                <div class="col-md-12">

                    <!-- Panel Tabs -->
                    <div id="panel-ui-tan-l1" class="panel panel-default">

                        <div class="panel-heading">
                            <!-- tabs nav -->
                            <ul class="nav nav-tabs pull-left">
                                <li class="active"><!-- TAB 1 -->
                                    <a href="#search_page1" data-toggle="tab">ค้นหาจากชื่อ หรือรหัส </a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#search_page2" data-toggle="tab">ค้นหาตามหมวดหมู่</a>
                                </li>
                            </ul>
                            <!-- /tabs nav -->

                        </div>

                        <!-- panel content -->
                        <div class="panel-body">

                            <!-- tabs content -->
                            <div class="tab-content transparent">

                                <div id="search_page1" class="tab-pane active"><!-- TAB 1 CONTENT -->
                                    <div class="col-md-3 col-sm-3">
                                        <select class="form-control select2" style="width: 230px;">                                    <option value=""></option>>
                                            <option value="1">ปากกา</option>
                                            <option value="2">กระดาษ A4</option>
                                            <option value="3">ลวดเย็บกระดาษ</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-white">
                                        <i class="fa fa-search"> ค้นหา</i>
                                    </button>

                                </div><!-- /TAB 1 CONTENT -->

                                <div id="search_page2" class="tab-pane"><!-- TAB 1 CONTENT -->
                                    <div class="col-md-3 col-sm-3">
                                        <select class="form-control select2" style="width: 230px;">
                                            <option value=""></option>>
                                            <option value="1">วัสดุใช้สอย</option>
                                            <option value="2">วัสดุสำนักงาน</option>
                                            <option value="3">วัสดุคงทนถาวร</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-white">
                                        <i class="fa fa-search"> ค้นหา</i>
                                    </button>

                                </div><!-- /TAB 1 CONTENT -->

                            </div>
                            <!-- /tabs content -->

                        </div>
                        <!-- /panel content -->

                        <!-- Seacrch Page -->

                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>

                            <tr>
                                <th width="3%">รูปภาพ</th>
                                <th width="30%">รายการ</th>
                                <th width="10%">ราคา/บาท</th>
                                <th width="9%">หน่วยนับ</th>
                                <th>เข้า</th>
                                <th>จ่าย</th>
                                <th width="8%">คงเหลือ</th>
                                <th>รายละเอียด</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- data table -->
                            <tr>
                                <td>
                                    <div class="w3-container">
                                        <img src="<?= Yii::$app->homeUrl?>assets/images/pen.jpg" width="80" height="80" onclick="document.getElementById('modal01').style.display='block'">
                                        <div id="modal01" class="modal" onclick="this.style.display='none'">
                                            <div class="w3-modal-content w3-animate-zoom" align="center">
                                                <img src="<?= Yii::$app->homeUrl?>assets/images/pen.jpg" style="width:40%">
                                            </div>
                                        </div>
                                        <div align="center">
                                            <label align="center">A001</label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <label>ชื่อวัสดุ : ปากกา<br><br>
                                        หมวดหมู่ : วัสดุใช้สอย <br>
                                    </label>
                                </td>
                                <td><label>120</label></td>
                                <td><label>ด้าม</label></td>
                                <td>150</td>
                                <td><label>20</label></td>
                                <td><label>130</label></td>
                                <td>
                                    <!-- Modal Ajax Lightbox >-->
                                    <a class="btn btn-leaf btn-xs btn-3d lightbox" data-toggle="modal" data-target="#myDetail">
                                        <i class="glyphicon glyphicon-zoom-in" aria-hidden="false"></i>รายละเอียด</a>
                                    </a>
                                </td>
                            </tr>
                            <!-- data table -->


                            </tbody>
                        </table>

                    </div>
                    <!-- /panel content -->

                </div>
                <!-- /PANEL -->
            </div>

            <!-- ============================= modal ====================================-->
            <div id="myDetail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">รายละเอียด</h4>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <p>โครงการ : วัสดุภาควิชาวิทยาการคอมพิวเคอร์</p>
                            <p>วัตถุประสงค์ : ใช้เพื่อประกอบการเรียนการสอน ภายในภาควิชาวิทยาการคอมพิวเตอร์</p>
                            <p>รายละเอียด : กระดาษ A4 สีขาว ขนาด 4x4 นิ้ว สามารถไปทำงานเอกสารได้หลากหลาย</p>
                            <p>สถานที่จัดเก็บ : คลังวัสดุ SC.05</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================= modal ====================================-->
