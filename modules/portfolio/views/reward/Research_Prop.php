<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>themelock.com - Smarty Admin</title>
    <meta name="description" content="" />
    <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />

    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

    <!-- WEB FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />

    <!-- CORE CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- THEME CSS -->
    <link href="assets/css/essentials.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />

</head>
<!--
    .boxed = boxed version
-->
<body>


<!-- WRAPPER -->
<div id="wrapper">

    <!--
        ASIDE
        Keep it outside of #wrapper (responsive purpose)
    -->
    <aside id="aside">
        <!--
            Always open:
            <li class="active alays-open">

            LABELS:
                <span class="label label-danger pull-right">1</span>
                <span class="label label-default pull-right">1</span>
                <span class="label label-warning pull-right">1</span>
                <span class="label label-success pull-right">1</span>
                <span class="label label-info pull-right">1</span>
        -->
        <nav id="sideNav"><!-- MAIN MENU -->
            <ul class="nav nav-list">
                <li><!-- dashboard -->
                    <a class="dashboard" href="index.html"><!-- warning - url used by default by ajax (if eneabled) -->
                        <i class="main-icon fa fa-dashboard"></i> <span>หน้าหลัก</span>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa-cube"></i> <span>ผลงานรางวัล</span>
                    </a>
                    <ul><!-- submenus -->
                        <li><a href="graphs-compet.html">โครงการวิจัย </a></li>
                        <li><a href="graphs-rewards.html">รางวัล </a></li>


                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa-university"></i> <span>เผยแพร่ผลงาน</span>
                    </a>
                    <ul><!-- submenus -->

                        <li><a href="graphs-public.html">ผลงานตีพิมพ์ </a></li>
                        <li><a href="graphs-flot.html">การประชุมวิชาการ</a></li>


                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa-pencil-square-o"></i> <span>เพิ่มเติมผลงาน</span>
                    </a>
                    <ul><!-- submenus -->
                        <li><a href="graphs-f-Rewards.html">รางวัล </a></li>
                        <li><a href="graphs-f-Conference.html">การประชุมวิชาการ </a></li>
                        <li><a href="graphs-f-Publications.html">ผลงานตีพิมพ์ </a></li>
                        <li><a href="graphs-f-Research.html">โครงการวิจัย </a></li>
                        <li><a href="graphs-f-compet.html">การแข่งขัน </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa-bar-chart-o"></i> <span>สถิติ</span>
                    </a>
                    <ul><!-- submenus -->
                        <li><a href="tables-bootstrap.html">การประชุมวิชาการ </a></li>
                        <li><a href="tables-jqgrid.html">การแข่งขัน</a></li>
                        <li><a href="tables-footable.html">ค่าใช้จ่าย</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa-pencil-square-o"></i> <span>ค่าใช้จ่าย</span>
                    </a>
                    <ul><!-- submenus -->
                        <li><a href="Expenses.html">รายละเอียดค่าใช้จ่าย </a></li>
                        <li><a href="Expenses-Edit.html">บันทึกค่าใช้จ่าย </a></li>

                    </ul>

                </li>

                <li>
                    <a href="calendar.html">
                        <i class="main-icon fa fa-calendar"></i>
                        <span class="label label-warning pull-right">2</span> <span>Calendar</span>
                    </a>
                </li>



            </ul>

            <!-- SECOND MAIN LIST -->
            <h3>MORE</h3>
            <ul class="nav nav-list">

                <li>
                    <a href="../../HTML/start.html">
                        <i class="main-icon fa fa-link"></i>
                        <span class="label label-danger pull-right">PRO</span> <span>Frontend</span>
                    </a>
                </li>
            </ul>

        </nav>
        <span id="asidebg"><!-- aside fixed background --></span>
    </aside>
    <!-- /ASIDE -->


    <!-- HEADER -->
    <header id="header">

        <!-- Mobile Button -->
        <button id="mobileMenuBtn"></button>

        <!-- Logo -->
        <span class="logo pull-left">
					<img src="assets/images/logo_light.png" alt="admin panel" height="35" />
				</span>

        <form method="get" action="page-search.html" class="search pull-left hidden-xs">
            <input type="text" class="form-control" name="k" placeholder="Search for something..." />
        </form>

        <nav>

            <!-- OPTIONS LIST -->
            <ul class="nav pull-right">

                <!-- USER OPTIONS -->
                <li class="dropdown pull-left">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img class="user-avatar" alt="" src="assets/images/noavatar.jpg" height="34" />
                        <span class="user-name">
									<span class="hidden-xs">
										John Doe <i class="fa fa-angle-down"></i>
									</span>
								</span>
                    </a>
                    <ul class="dropdown-menu hold-on-click">
                        <li><!-- my calendar -->
                            <a href="calendar.html"><i class="fa fa-calendar"></i> Calendar</a>
                        </li>
                        <li><!-- my inbox -->
                            <a href="#"><i class="fa fa-envelope"></i> Inbox
                                <span class="pull-right label label-default">0</span>
                            </a>
                        </li>
                        <li><!-- settings -->
                            <a href="page-user-profile.html"><i class="fa fa-cogs"></i> Settings</a>
                        </li>

                        <li class="divider"></li>

                        <li><!-- lockscreen -->
                            <a href="page-lock.html"><i class="fa fa-lock"></i> Lock Screen</a>
                        </li>
                        <li><!-- logout -->
                            <a href="page-login.html"><i class="fa fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
                <!-- /USER OPTIONS -->

            </ul>
            <!-- /OPTIONS LIST -->

        </nav>

    </header>
    <!-- /HEADER -->


    <!--
        MIDDLE
    -->
    <section id="middle">


        <!-- page title -->
        <header id="page-header">
            <h1>โครงการวิจัย</h1>
            <ol class="breadcrumb">
                <li><a href="#">กิจกรรม</a></li>
                <li class="active">โครงการวิจัย</li>
            </ol>
        </header>
        <!-- /page title -->

        <div id="content" class="padding-20">



            <div id="panel-1" class="panel panel-default">

                <div class="panel-heading">
							<span class="title elipsis">
								<strong>โครงการวิจัย</strong> <!-- panel title -->
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

                    <!-- Large Modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">บันทึกโครงการวิจัย</button>
                        <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- header modal -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myLargeModalLabel">บันทึกโครงการวิจัย</h4>
                                    </div>

                                    <!-- body modal -->
                                    <div class="modal-body">
                                        <div class="panel panel-default">
                                            <div class="panel-heading panel-heading-transparent">
                                                <strong>โครงการวิจัย</strong>
                                            </div>

                                            <div class="panel-body">

                                                <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                    <fieldset>
                                                        <!-- required [php action request] -->
                                                        <input type="hidden" name="action" value="contact_send" />

                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ภาษาที่แสดงผล</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="eng">ภาษาอังกฤษ</option>
                                                                        <option value="thai">ภาษาไทย</option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ชื่อโครงการ(ไทย)</label>
                                                                    <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ชื่อโครงการ(อังกฤษ)</label>
                                                                    <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>หัวหน้าโครงการ</label>
                                                                    <input type="email" name="contact[email]" value="ชื่อ" class="form-control2 required">
                                                                </div>

                                                                <div class="col-md-4 col-sm-8">

                                                                    <input type="text" name="contact[phone]" value="นามสกุล" class="form-control2 required">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-8">
                                                                <label>แหล่งทุน</label>
                                                                <select name="contact[position]" class="form-control2 pointer required">
                                                                    <option value="">--- เลือก ---</option>
                                                                    <option value="Marketing">ภายใน</option>
                                                                    <option value="Developer">ภายนอก</option>

                                                                </select>
                                                            </div>
                                                        </div>



                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>ปี ที่เริ่มต้น</label>
                                                                    <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>ปี ที่สิ้นสุด</label>
                                                                    <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>ระยะเวลา</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>งบประมาณ </label>
                                                                    <input type="text" name="contact[start_date]" value="" class="form-control2  required" >
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ผู้ใช้ทุน</label>
                                                                    <input type="text" name="contact[start_date]" value="" class="form-control2 required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>เว็บไซต์</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">

                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>สมาชิกโครงการ </label>

                                                                    <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2"><br>
                                                                    <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2">
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label></label>

                                                                    <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2"><br>
                                                                    <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2">
                                                                </div>



                                                            </div>


                                                            <div class="col-md-4 col-sm-8">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">เลือก <span class="caret"></span></button>
                                                                    <ul class="dropdown-menu" role="menu">
                                                                        <li><i class="fa fa-edit" data-target="#modal2"></i> อาจารย์ภายใน</li>
                                                                        <li><a href="#"><i class="fa fa-question-circle"></i> อาจารย์ภายนอก</a></li>

                                                                        <li><a href="#"><i class="fa fa-question-circle"></i> นักศึกษา</a></li>

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button type="button" class="btn btn-primary">เพิ่มสมาชิก</button>

                                                    </fieldset><br><br>

                                                    <div class="row">
                                                        <button type="button" class="btn btn-success">บันทึก</button>&nbsp;&nbsp;
                                                        <button type="button" class="btn btn-danger">ยกเลิก</button>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>



                        </div><br>

                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                        <thead>
                        <tr>
                            <th>Project Name : ISO/TC211-ISO 19126: Profile-FACC Data Dictionary (การศึกษามาตรฐานระบบภูมิสารสนเทศตามมาตรฐานของ ISO 19126: Profile-FACC Data Dictionary)</th>
                        </tr>

                        </thead>

                    </table>

                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                        <tbody>
                        <tr>หัวหน้าโครงการ : รัศมี สุวรรณวีระกำธร</tr><br>
                        <tr>ระยะเวลา : 8 เดือน (2549-2550)</tr><br>
                        <tr>งบประมาณ : 340,000 บาท</tr><br>
                        <tr>ผู้ให้ทุน : GISTDA (ภายนอก)</tr><br>
                        <tr>เว็บไซต์ : -</tr><br>
                        <tr>อื่นๆ : ดร.ชรัตน์ มงคลสวัสดิ์ ที่ปรึกษาโครงการ</tr>

                        </tbody>

                    </table>


                    <table>
                        <tr>สมาชิกโครงการ</tr><br>
                        <th>1.ชรัตน์ มงคลสวัสดิ์</th>


                    </table>

                </div>
                <!-- /panel content -->

                <!-- panel content -->
                <div class="panel-body">

                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                        <thead>
                        <tr>
                            <th>Project Name : Speech Synthesis</th>
                        </tr>

                        </thead>

                    </table>

                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                        <tbody>
                        <tr>หัวหน้าโครงการ : tomio</tr><br>
                        <tr>ระยะเวลา : - (2544-2547)</tr><br>
                        <tr>งบประมาณ : 300,000 บาท</tr><br>
                        <tr>ผู้ให้ทุน : Japanese (ภายใน)</tr><br>
                        <tr>เว็บไซต์ : -</tr><br>
                        <tr>อื่นๆ : - </tr>

                        </tbody>

                    </table>


                    <table>
                        <tr>สมาชิกโครงการ</tr><br>
                        <th>1.พุธษดี ศิริเเสงตระกูล</th>


                    </table>

                </div>
                <!-- /panel content -->

            </div>

        </div>

    </section>
    <!-- /MIDDLE -->

</div>


<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>

<!-- PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
    loadScript(plugin_path + "raphael-min.js", function(){
        loadScript(plugin_path + "chart.morris/morris.min.js", function(){

            // demo js script
            loadScript("assets/js/view/demo.graphs.morris.js");

        });
    });
</script>

</body>
</html>