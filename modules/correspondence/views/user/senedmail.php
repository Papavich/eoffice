<?php
use yii\helpers\Html;

$this->title = Html::encode($this->title) . 'จดหมายที่ส่งแล้ว';
$this->registerCss("
table tbody tr td a {
  display: block;
  width: 100%;
  color: black;
}
tr.hover {
  cursor: pointer;
}
a:hover{
  color: black;
}
");
?>


<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <!-- Menu mail  -->
            <!-- --><?php
            /*            include "menumail.php";
                        */ ?>
            <!-- /.col -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 style="color: black">จดหมายที่ส่งแล้ว</h3>

                        <div class="box-tools pull-right">
                            <div class="has-feedback">
                                <input type="text" class="form-control input-sm" placeholder="Search Mail">
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                        class="fa fa-square-o"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i>
                                </button>
                            </div>
                            <!-- /.btn-group -->
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i>
                            </button>
                            <div class="pull-right" style="color: black">
                                1-10/1
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm"><i
                                                class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btn-default btn-sm"><i
                                                class="fa fa-chevron-right"></i></button>
                                </div>
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.pull-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover">
                                <tbody>
                                <?php for ($i = 0; $i < 5; $i++) { ?>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a>
                                        </td>
                                        <div onclick="location.href='readmail'">
                                            <td class="mailbox-name">
                                                <?= Html::a("<b>ศูนย์สรรหาและเลือกสรร กลุ่มบริหารการสอบและระบบทุน</b>", ['user/readmail1']) ?>
                                            </td>
                                            <td class="mailbox-subject">
                                                <?= Html::a(iconv_substr("<b>รับสมัครคัดเลือดบุคคลเพื่อรับทุนรัญบาล ประจำปีงบประมาณ พ.ศ.2553</b><span style='font-size: 12px; color: black;'> ประเภท:หนังสือภายนอก | ชั้นความเร็ว:ปกติ | ชั้นความลับ: ปกติ</span>", 0, 140,'UTF-8') . '...', ['user/readmail1']); ?>
                                            </td>
                                            <td class="mailbox-attachment"></td>
                                            <td class="mailbox-date" style="color: black"><b>15:30 &nbsp;&nbsp;&nbsp;&nbsp;
                                                    28 เมษายน 2553 </b></td>
                                        </div>
                                    </tr>
                                <?php } ?>
                                <?php for ($i = 0; $i < 5; $i++) { ?>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td class="mailbox-star"><a href="#"><i
                                                        class="fa fa-star-o text-yellow"></i></a>
                                        </td>
                                        <div onclick="location.href='readmail'">
                                            <td class="mailbox-name">
                                                <?= Html::a("<b>สำนักงานอธิการบดี ฝ่ายยิจัยและการถ่ายทอดเทคโนโลยี</b>", ['user/readmail']) ?>
                                            </td>
                                            <td class="mailbox-subject">
                                                <?= Html::a(iconv_substr("<b>ประกาศการรับสมัครทุนการศึกษา ตามโครงการมหาวิทยาลัยวิจัยแห่งชาติ มหาวิทยาลัยขอนแก่น ประจำปี2553</b>
                                                <span style='font-size: 12px; color: black;'> ประเภท: หนังสือภายใน | ชั้นความเร็ว:ปกติ | ชั้นความลับ : ปกติ</span>", 0, 80,'UTF-8') . '...', ['user/readmail']) ?>
                                            </td>
                                            <td class="mailbox-attachment"></td>
                                            <td class="mailbox-date" style="color: black"><b>14:05 &nbsp;&nbsp;&nbsp;&nbsp;
                                                    28 เมษายน 2553 </b></td>
                                        </div>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                        class="fa fa-square-o"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i>
                                </button>
                            </div>
                            <!-- /.btn-group -->
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i>
                            </button>
                            <div class="pull-right" style="color: black">
                                1-10/1
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm"><i
                                                class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btn-default btn-sm"><i
                                                class="fa fa-chevron-right"></i></button>
                                </div>
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.pull-right -->
                        </div>
                    </div>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-user bg-yellow"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                            <p>New phone +1(800)555-1234</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                            <p>nora@example.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-file-code-o bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                            <p>Execution time 5 seconds</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="label label-danger pull-right">70%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Update Resume
                            <span class="label label-success pull-right">95%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Laravel Integration
                            <span class="label label-warning pull-right">50%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Back End Framework
                            <span class="label label-primary pull-right">68%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Allow mail redirect
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Other sets of options are available
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Expose author name in posts
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Allow the user to show his name in blog posts
                    </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Show me as online
                        <input type="checkbox" class="pull-right" checked>
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Turn off notifications
                        <input type="checkbox" class="pull-right">
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Delete chat history
                        <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                    </label>
                </div>

                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>


<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<!-- Page Script -->
<?php

$this->registerJs(<<<JS
 $(document).ready(function(){
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
                //Check all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      console.log("click");
      //detect type glyphicon-star
      var x= $(this).find("a > i");
      var glyph = $(this).hasClass("glyphicon");
      var fa = $(this).hasClass("fa");
      //Switch states
        x.toggleClass("fa-star");
        x.toggleClass("fa-star-o");

    });

    });
JS
);
$this->registerJsFile("@web/assets/plugins/bootstrap/js/bootstrap.min.js", [
]);
?>
