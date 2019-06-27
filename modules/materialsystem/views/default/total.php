<!-- page title -->
<header id="page-header">
    <h1>รายการรับเข้า</h1>
</header>
<!-- /page title -->


<div id="content" class="padding-20">


    <!--
                PANEL CLASSES:a
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

            <table class="table table-striped table-bordered table-hover" id="sample_3">
                <thead>
                <a href="material-insert-admin.html" class="btn btn-success btn-3d">
                    <i class="glyphicon glyphicon-pencil" aria-hidden="false"></i> เพิ่มรายการ</a>
                <tr>
                    <th width="10%">ภาพประกอบ</th>
                    <th>รหัส</th>
                    <th width="5%">วันที่</th>
                    <th width="30%">ชื่อรายการ</th>
                    <th>จำนวน</th>
                    <th class="hidden-xs">ราคา/หน่วย</th>
                    <th class="hidden-xs">หน่วยนับ</th>
                    <th width="17%">จัดการข้อมูล</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>A001</td>
                    <td>21/06/60</td>
                    <td>ปากกา</td>
                    <td>20</td>
                    <td>5</td>
                    <td>บาท</td>
                    <td>
                                <span>
                                    <a href="#" class="btn btn-xs btn-warning btn-3d">
                                        <i class="glyphicon glyphicon-edit" aria-hidden="false"></i>แก้ไข</a>
                                </span>
                        <span>
                                    <a href="#" class="btn btn-xs btn-danger btn-3d">
                                        <i class="glyphicon glyphicon-trash" aria-hidden="false"></i>ลบ</a>
                                </span>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>A002</td>
                    <td>22/06/60</td>
                    <td>กระดาษ A4</td>
                    <td>100</td>
                    <td>80</td>
                    <td>บาท</td>
                    <td>
                                <span>
                                    <a href="#" class="btn btn-xs btn-warning btn-3d">
                                        <i class="glyphicon glyphicon-edit" aria-hidden="false"></i>แก้ไข</a>
                                </span>
                        <span>
                                    <a href="#" class="btn btn-xs btn-danger btn-3d">
                                        <i class="glyphicon glyphicon-trash" aria-hidden="false"></i>ลบ</a>
                                </span>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <!-- /panel content -->

    </div>
    <!-- /PANEL -->
</div>