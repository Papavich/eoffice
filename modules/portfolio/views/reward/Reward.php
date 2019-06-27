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
            <h1>รางวัล</h1>
            <ol class="breadcrumb">
                <li><a href="#">กิจกรรม</a></li>
                <li class="active">รางวัล</li>
            </ol>
        </header>
        <!-- /page title -->

        <div id="content" class="padding-20">



            <div id="panel-1" class="panel panel-default">

                <div class="panel-heading">
							<span class="title elipsis">
								<strong>รางวัล</strong> <!-- panel title -->
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
                    <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">เพิ่มผลงานรางวัล</button>
                        <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- header modal -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myLargeModalLabel">บันทึก</h4>
                                    </div>

                                    <!-- body modal -->
                                    <div class="modal-body">
                                        <div class="panel panel-default">
                                            <div class="panel-heading panel-heading-transparent">
                                                <strong>บันทึกผลงานรางวัล</strong>
                                            </div>

                                            <div class="panel-body">

                                                <div<form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                    <fieldset>
                                                        <!-- required [php action request] -->
                                                        <input type="hidden" name="action" value="contact_send" />

                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ชื่องาน (ไทย) </label>
                                                                    <input type="text" name="contact[last_name]" value="" placeholder="นายทองปาน" class="form-control2 required">
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ชื่องาน(อังกฤษ)</label>
                                                                    <input type="text" name="contact[last_name]" value="" placeholder="ปริวัตร" class="form-control2 required">
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ประเภทผลงานรางวัล</label>

                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="eng">รางวัลการแข่งขันพัฒนาโปรแกรมคอมพิวเตอร์แห่งประเทศไทย</option>
                                                                        <option value="thai">รางวัลการประชุมวิชาการ</option>
                                                                        <option value="thai">รางวัลการผลงานตีพิมพ์</option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-5 col-sm-6">
                                                                    <label>รางวัลที่ได้รับ : ชื่อ</label>
                                                                    <input type="text" name="contact[website]" placeholder="" class="form-control2"><br>
                                                                    <input type="text" name="contact[website]" placeholder="" class="form-control2"><br>
                                                                    <button type="button" class="btn btn-info btn-3d">เพิ่มรางวัลที่ได้รับ</button>

                                                                </div>
                                                            </div>
                                                            <a href="#" class="btn btn-3d btn-yellow"><i class="icon-beaker"></i>ค้นหา</a>
                                                            <button type="button" class="btn btn-danger btn-3d">ลบ</button><br><br>
                                                            <a href="#" class="btn btn-3d btn-yellow"><i class="icon-beaker"></i>ค้นหา</a>
                                                            <button type="button" class="btn btn-danger btn-3d">ลบ</button>
                                                        </div>




                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ผู้ที่ได้รับรางวัล : ชื่อ</label>
                                                                    <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2"><br>
                                                                    <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2"><br>
                                                                    <button type="button" class="btn btn-info btn-3d">เพิ่มรางวัลที่ได้รับ</button>
                                                                </div>

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>นามสกุล</label>
                                                                    <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2"><br>
                                                                    <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2"><br>
                                                                </div>

                                                            </div>
                                                            <button type="button" class="btn btn-default">อ.ภายใน</button>
                                                            <button type="button" class="btn btn-default">นักศึกษา</button>
                                                            <button type="button" class="btn btn-danger btn-3d">ลบ</button><br>
                                                            <button type="button" class="btn btn-default">อ.ภายใน</button>
                                                            <button type="button" class="btn btn-default">นักศึกษา</button>
                                                            <button type="button" class="btn btn-danger btn-3d">ลบ</button>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>อาจารย์ที่ควมคุม : ชื่อ</label>

                                                                    <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2"><br>
                                                                    <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2"><br>
                                                                    <button type="button" class="btn btn-info btn-3d">เพิ่มอาจารย์ที่ควมคุม</button>
                                                                </div>

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>นามสกุล</label>

                                                                    <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2"><br>
                                                                    <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2"><br>

                                                                </div>

                                                            </div>
                                                            <button type="button" class="btn btn-default">อ.ภายใน</button>
                                                            <button type="button" class="btn btn-default">อ.ภายนอก</button>
                                                            <button type="button" class="btn btn-danger btn-3d">ลบ</button><br>
                                                            <button type="button" class="btn btn-default">อ.ภายใน</button>
                                                            <button type="button" class="btn btn-default">อ.ภายนอก</button>
                                                            <button type="button" class="btn btn-danger btn-3d">ลบ</button>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>อาจารย์ที่ปรึกษา : ชื่อ</label>

                                                                    <input type="text" name="contact[website]" placeholder="ชผศ.ดร.พุธษดี " class="form-control2"><br>
                                                                    <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2"><br>
                                                                    <button type="button" class="btn btn-info btn-3d">เพิ่มอาจารย์ที่ปรึกษา</button>
                                                                </div>

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>นามสกุล</label>

                                                                    <input type="text" name="contact[website]" placeholder=" ศิริแสงตระกูล" class="form-control2"><br>
                                                                    <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2"><br>

                                                                </div>

                                                            </div>
                                                            <button type="button" class="btn btn-default">อ.ภายใน</button>
                                                            <button type="button" class="btn btn-default">อ.ภายนอก</button>
                                                            <button type="button" class="btn btn-danger btn-3d">ลบ</button><br>
                                                            <button type="button" class="btn btn-default">อ.ภายใน</button>
                                                            <button type="button" class="btn btn-default">อ.ภายนอก</button>
                                                            <button type="button" class="btn btn-danger btn-3d">ลบ</button>
                                                        </div>


                                                        <div class="row">
                                                            <div class="form-group">



                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>วันที่จัดการแข่งขัน : </label>
                                                                    <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">

                                                                    </select>
                                                                </div>

                                                                <div class="col-md-3 col-sm-9">

                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>วันที่ได้รับรางวัล : </label>
                                                                    <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">

                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-5 col-sm-6">
                                                                    <label>สถานที่จัดแข่งขัน : </label>
                                                                    <input type="text" name="contact[website]" placeholder="" class="form-control2"><br>

                                                                </div>
                                                            </div>
                                                            <a href="#" class="btn btn-3d btn-yellow"><i class="icon-beaker"></i>ค้นหา</a>
                                                            <button type="button" class="btn btn-danger btn-3d">ลบ</button><br><br>
                                                        </div>


                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-5 col-sm-6">
                                                                    <label>ประเทศที่จัดแข่งขัน : </label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- Select ---</option>
                                                                        <option value="">ไทย</option>
                                                                        <option value="">สหรัฐอเมริกา</option>
                                                                        <option value="">จีน</option>
                                                                        <option value="">ญี่ปุ่น</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-5 col-sm-6">
                                                                    <label>สถานที่ได้รับรางวัล : </label>
                                                                    <input type="text" name="contact[website]" placeholder="" class="form-control2"><br>

                                                                </div>
                                                            </div>
                                                            <a href="#" class="btn btn-3d btn-yellow"><i class="icon-beaker"></i>ค้นหา</a>
                                                            <button type="button" class="btn btn-danger btn-3d">ลบ</button><br><br>
                                                        </div>


                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-5 col-sm-6">
                                                                    <label>ประเทศที่ได้รับรางวัล : </label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- Select ---</option>
                                                                        <option value="">ไทย</option>
                                                                        <option value="">สหรัฐอเมริกา</option>
                                                                        <option value="">จีน</option>
                                                                        <option value="">ญี่ปุ่น</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-5 col-sm-6">
                                                                    <label>สถาบัน/หน่วยงานที่ให้รางวัล : ชื่อ </label>
                                                                    <input type="text" name="contact[website]" placeholder="" class="form-control2"><br>
                                                                    <input type="text" name="contact[website]" placeholder="" class="form-control2"><br>
                                                                    <button type="button" class="btn btn-info btn-3d">เพิ่มสถาบัน/หน่วยงานที่ให้รางวัล</button>
                                                                </div>
                                                            </div>
                                                            <a href="#" class="btn btn-3d btn-yellow"><i class="icon-beaker"></i>ค้นหา</a>
                                                            <button type="button" class="btn btn-danger btn-3d">ลบ</button><br><br>
                                                            <a href="#" class="btn btn-3d btn-yellow"><i class="icon-beaker"></i>ค้นหา</a>
                                                            <button type="button" class="btn btn-danger btn-3d">ลบ</button><br><br>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-5 col-sm-6">
                                                                    <label>รูปภาพ : ชื่อ</label>

                                                                    <button type="button" class="btn btn-info btn-3d">เพิ่มรูปภาพ</button>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-12 col-sm-12">
                                                                    <label>รายละเอียดอื่นๆ : </label>
                                                                    <textarea name="contact[experience]" rows="4" class="form-control required"  ></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-5 col-sm-6">
                                                                    <label>อยู่ภายใต้โครงการวิจัย : </label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- Select ---</option>
                                                                        <option value="">อยู่ภายใต้โครงการวิจัย</option>
                                                                        <option value="">ไม่อยู่ภายใต้โครงการวิจัย</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>


                                                    </fieldset>







                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <center><button type="button" class="btn btn-success">บันทึก</button>&nbsp;&nbsp;
                                                                <button type="button" class="btn btn-danger">ยกเลิก</button></center>
                                                        </div>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </center><br><br>


                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อผู้ขอทุน</th>
                            <th>รหัสนักศึกษา</th>
                            <th>สาขา</th>
                            <th>ระดับ</th>
                            <th>อาจารย์ที่ปรึกษา</th>
                            <th>ชื่อเรื่อง</th>
                            <th>ชื่องานประชุม</th>
                            <th>สถานที่จัด</th>
                            <th>วันที่จัด</th>
                            <th>เงินทุนที่ใช้</th>
                            <th>งานประชุมระดับ</th>
                            <th>รางวัล</th>


                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>
                                1
                            </td>
                            <td>
                                <a href="graphs-flot-namestd.html">นายทองปาน ปริวัตร</a>
                            </td>
                            <td>
                                <a href="graphs-flot-std-id.html">545020159-7</a>
                            </td>
                            <td>
                                IT
                            </td>
                            <td>
                                ป.โท
                            </td>
                            <td>
                                <a href="graphs-flot-teacher1.html">ผศ.ดร.พุธษดี ศิริแสงตระกูล</a>
                            </td>
                            <td>
                                <a href="graphs-flot-std.html">Thai Machine</a>
                            </td>
                            <td>
                                International
                            </td>
                            <td>
                                ชลบุรี
                            </td>
                            <td>
                                1-4 กุมภาพันธ์ 60
                            </td>
                            <td>
                                11,500
                            </td>
                            <td>
                                นานาชาติ
                            </td>

                            <td>
                                <!-- Large Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">เพิ่มผลงานรางวัล</button>
                                <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- header modal -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel">บันทึก</h4>
                                            </div>

                                            <!-- body modal -->
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panel-heading-transparent">
                                                        <strong>บันทึกผลงานรางวัล</strong>
                                                    </div>

                                                    <div class="panel-body">

                                                        <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                            <fieldset>
                                                                <!-- required [php action request] -->
                                                                <input type="hidden" name="action" value="contact_send" />

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ชื่องาน (ไทย) </label>
                                                                            <input type="text" name="contact[last_name]" value="" placeholder="นายทองปาน" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ชื่องาน(อังกฤษ)</label>
                                                                            <input type="text" name="contact[last_name]" value="" placeholder="ปริวัตร" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ประเภทผลงานรางวัล</label>

                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- เลือก ---</option>
                                                                                <option value="eng">รางวัลการแข่งขันพัฒนาโปรแกรมคอมพิวเตอร์แห่งประเทศไทย</option>
                                                                                <option value="thai">รางวัลการประชุมวิชาการ</option>
                                                                                <option value="thai">รางวัลการผลงานตีพิมพ์</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-5 col-sm-6">
                                                                            <label>รางวัลที่ได้รับ : ชื่อ</label>
                                                                            <input type="text" name="contact[website]" placeholder="" class="form-control2"><br>
                                                                            <input type="text" name="contact[website]" placeholder="" class="form-control2"><br>
                                                                            <button type="button" class="btn btn-info btn-3d">เพิ่มรางวัลที่ได้รับ</button>

                                                                        </div>
                                                                    </div>
                                                                    <a href="#" class="btn btn-3d btn-yellow"><i class="icon-beaker"></i>ค้นหา</a>
                                                                    <button type="button" class="btn btn-danger btn-3d">ลบ</button><br><br>
                                                                    <a href="#" class="btn btn-3d btn-yellow"><i class="icon-beaker"></i>ค้นหา</a>
                                                                    <button type="button" class="btn btn-danger btn-3d">ลบ</button>
                                                                </div>




                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ผู้ที่ได้รับรางวัล : ชื่อ</label>
                                                                            <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2"><br>
                                                                            <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2"><br>
                                                                            <button type="button" class="btn btn-info btn-3d">เพิ่มรางวัลที่ได้รับ</button>
                                                                        </div>

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>นามสกุล</label>
                                                                            <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2"><br>
                                                                            <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2"><br>
                                                                        </div>

                                                                    </div>
                                                                    <button type="button" class="btn btn-default">อ.ภายใน</button>
                                                                    <button type="button" class="btn btn-default">นักศึกษา</button>
                                                                    <button type="button" class="btn btn-danger btn-3d">ลบ</button><br>
                                                                    <button type="button" class="btn btn-default">อ.ภายใน</button>
                                                                    <button type="button" class="btn btn-default">นักศึกษา</button>
                                                                    <button type="button" class="btn btn-danger btn-3d">ลบ</button>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>อาจารย์ที่ควมคุม : ชื่อ</label>

                                                                            <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2"><br>
                                                                            <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2"><br>
                                                                            <button type="button" class="btn btn-info btn-3d">เพิ่มอาจารย์ที่ควมคุม</button>
                                                                        </div>

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>นามสกุล</label>

                                                                            <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2"><br>
                                                                            <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2"><br>

                                                                        </div>

                                                                    </div>
                                                                    <button type="button" class="btn btn-default">อ.ภายใน</button>
                                                                    <button type="button" class="btn btn-default">อ.ภายนอก</button>
                                                                    <button type="button" class="btn btn-danger btn-3d">ลบ</button><br>
                                                                    <button type="button" class="btn btn-default">อ.ภายใน</button>
                                                                    <button type="button" class="btn btn-default">อ.ภายนอก</button>
                                                                    <button type="button" class="btn btn-danger btn-3d">ลบ</button>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>อาจารย์ที่ปรึกษา : ชื่อ</label>

                                                                            <input type="text" name="contact[website]" placeholder="ชผศ.ดร.พุธษดี " class="form-control2"><br>
                                                                            <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2"><br>
                                                                            <button type="button" class="btn btn-info btn-3d">เพิ่มอาจารย์ที่ปรึกษา</button>
                                                                        </div>

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>นามสกุล</label>

                                                                            <input type="text" name="contact[website]" placeholder=" ศิริแสงตระกูล" class="form-control2"><br>
                                                                            <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2"><br>

                                                                        </div>

                                                                    </div>
                                                                    <button type="button" class="btn btn-default">อ.ภายใน</button>
                                                                    <button type="button" class="btn btn-default">อ.ภายนอก</button>
                                                                    <button type="button" class="btn btn-danger btn-3d">ลบ</button><br>
                                                                    <button type="button" class="btn btn-default">อ.ภายใน</button>
                                                                    <button type="button" class="btn btn-default">อ.ภายนอก</button>
                                                                    <button type="button" class="btn btn-danger btn-3d">ลบ</button>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="form-group">



                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>วันที่จัดการแข่งขัน : </label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">

                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-3 col-sm-9">

                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>วันที่ได้รับรางวัล : </label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">

                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-5 col-sm-6">
                                                                            <label>สถานที่จัดแข่งขัน : </label>
                                                                            <input type="text" name="contact[website]" placeholder="" class="form-control2"><br>

                                                                        </div>
                                                                    </div>
                                                                    <a href="#" class="btn btn-3d btn-yellow"><i class="icon-beaker"></i>ค้นหา</a>
                                                                    <button type="button" class="btn btn-danger btn-3d">ลบ</button><br><br>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-5 col-sm-6">
                                                                            <label>ประเทศที่จัดแข่งขัน : </label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="">ไทย</option>
                                                                                <option value="">สหรัฐอเมริกา</option>
                                                                                <option value="">จีน</option>
                                                                                <option value="">ญี่ปุ่น</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-5 col-sm-6">
                                                                            <label>สถานที่ได้รับรางวัล : </label>
                                                                            <input type="text" name="contact[website]" placeholder="" class="form-control2"><br>

                                                                        </div>
                                                                    </div>
                                                                    <a href="#" class="btn btn-3d btn-yellow"><i class="icon-beaker"></i>ค้นหา</a>
                                                                    <button type="button" class="btn btn-danger btn-3d">ลบ</button><br><br>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-5 col-sm-6">
                                                                            <label>ประเทศที่ได้รับรางวัล : </label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="">ไทย</option>
                                                                                <option value="">สหรัฐอเมริกา</option>
                                                                                <option value="">จีน</option>
                                                                                <option value="">ญี่ปุ่น</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-5 col-sm-6">
                                                                            <label>สถาบัน/หน่วยงานที่ให้รางวัล : ชื่อ </label>
                                                                            <input type="text" name="contact[website]" placeholder="" class="form-control2"><br>
                                                                            <input type="text" name="contact[website]" placeholder="" class="form-control2"><br>
                                                                            <button type="button" class="btn btn-info btn-3d">เพิ่มสถาบัน/หน่วยงานที่ให้รางวัล</button>
                                                                        </div>
                                                                    </div>
                                                                    <a href="#" class="btn btn-3d btn-yellow"><i class="icon-beaker"></i>ค้นหา</a>
                                                                    <button type="button" class="btn btn-danger btn-3d">ลบ</button><br><br>
                                                                    <a href="#" class="btn btn-3d btn-yellow"><i class="icon-beaker"></i>ค้นหา</a>
                                                                    <button type="button" class="btn btn-danger btn-3d">ลบ</button><br><br>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-5 col-sm-6">
                                                                            <label>รูปภาพ : ชื่อ</label>

                                                                            <button type="button" class="btn btn-info btn-3d">เพิ่มรูปภาพ</button>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>รายละเอียดอื่นๆ : </label>
                                                                            <textarea name="contact[experience]" rows="4" class="form-control required"  ></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-5 col-sm-6">
                                                                            <label>อยู่ภายใต้โครงการวิจัย : </label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="">อยู่ภายใต้โครงการวิจัย</option>
                                                                                <option value="">ไม่อยู่ภายใต้โครงการวิจัย</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                            </fieldset><br><br>








                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <center><button type="button" class="btn btn-success">บันทึก</button>&nbsp;&nbsp;
                                                                        <button type="button" class="btn btn-danger">ยกเลิก</button></center>
                                                                </div>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                            </td>

                        </tr>
                        <tr>
                            <td>
                                2
                            </td>
                            <td>
                                <a href="graphs-flot-namestd.html">นายวุฒิชัย บุญศรี</a>
                            </td>
                            <td>
                                <a href="graphs-flot-std-id.html">565020159-7</a>
                            </td>
                            <td>
                                GIS
                            </td>
                            <td>
                                ป.โท
                            </td>
                            <td>
                                <a href="graphs-flot-teacher1.html">ผศ.ดร.พุธษดี ศิริแสงตระกูล</a>
                            </td>
                            <td>
                                <a href="graphs-flot-std.html">Thai Machine</a>
                            </td>
                            <td>
                                International
                            </td>
                            <td>
                                ชลบุรี
                            </td>
                            <td>
                                1-4 กุมภาพันธ์ 60
                            </td>
                            <td>
                                11,500
                            </td>
                            <td>
                                นานาชาติ
                            </td>

                            <td>
                                <!-- Large Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">เพิ่มผลงานรางวัล</button>
                                <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- header modal -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel">บันทึก</h4>
                                            </div>

                                            <!-- body modal -->
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panel-heading-transparent">
                                                        <strong>FORM VALIDATION</strong>
                                                    </div>

                                                    <div class="panel-body">

                                                        <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                            <fieldset>
                                                                <!-- required [php action request] -->
                                                                <input type="hidden" name="action" value="contact_send" />

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>First Name *</label>
                                                                            <input type="text" name="contact[first_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Last Name *</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Last Name *</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Email *</label>
                                                                            <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Phone *</label>
                                                                            <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Phone *</label>
                                                                            <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>Position *</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">PR &amp; Marketing</option>
                                                                                <option value="Developer">Web Developer</option>
                                                                                <option value="php">PHP Programmer</option>
                                                                                <option value="Javascript">Javascript Programmer</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Expected Salary *</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Start Date *</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>Experience *</label>
                                                                            <textarea name="contact[experience]" rows="4" class="form-control2 required"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>
                                                                                Website
                                                                                <small class="text-muted">- optional</small>
                                                                            </label>
                                                                            <input type="text" name="contact[website]" placeholder="http://" class="form-control2">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label>
                                                                                File Attachment
                                                                                <small class="text-muted">Curriculum Vitae - optional</small>
                                                                            </label>

                                                                            <!-- custom file upload -->
                                                                            <div class="fancy-file-upload fancy-file-primary">
                                                                                <i class="fa fa-upload"></i>
                                                                                <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                                <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                                <span class="button">Choose File</span>
                                                                            </div>
                                                                            <small class="text-muted block">Max file size: 10Mb (zip/pdf/jpg/png)</small>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>Position *</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">PR &amp; Marketing</option>
                                                                                <option value="Developer">Web Developer</option>
                                                                                <option value="php">PHP Programmer</option>
                                                                                <option value="Javascript">Javascript Programmer</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                            </fieldset>


                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
                                                                        SEND APPLICATION
                                                                        <span class="block font-lato">We'll get back to you within 48 hours</span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                            </td>

                        </tr>
                        <tr>
                            <td>
                                3
                            </td>
                            <td>
                                <a href="graphs-flot-namestd.html"> นายวุฒิศักดิ์ บุญมี</a>
                            </td>
                            <td>
                                <a href="graphs-flot-std-id.html">565020155-3</a>
                            </td>
                            <td>
                                IT
                            </td>
                            <td>
                                ป.โท
                            </td>
                            <td>
                                <a href="graphs-flot-teacher1.html">ผศ.ดร.พุธษดี ศิริแสงตระกูล</a>
                            </td>
                            <td>
                                <a href="graphs-flot-std.html">Thai Machine</a>
                            </td>
                            <td>
                                International
                            </td>
                            <td>
                                ชลบุรี
                            </td>
                            <td>
                                1-4 กุมภาพันธ์ 60
                            </td>
                            <td>
                                11,500
                            </td>
                            <td>
                                นานาชาติ
                            </td>

                            <td>
                                <!-- Large Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">เพิ่มผลงานรางวัล</button>
                                <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- header modal -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel">บันทึก</h4>
                                            </div>

                                            <!-- body modal -->
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panel-heading-transparent">
                                                        <strong>FORM VALIDATION</strong>
                                                    </div>

                                                    <div class="panel-body">

                                                        <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                            <fieldset>
                                                                <!-- required [php action request] -->
                                                                <input type="hidden" name="action" value="contact_send" />

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>First Name *</label>
                                                                            <input type="text" name="contact[first_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Last Name *</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Last Name *</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Email *</label>
                                                                            <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Phone *</label>
                                                                            <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Expected Salary *</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Start Date *</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>Experience *</label>
                                                                            <textarea name="contact[experience]" rows="4" class="form-control2 required"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>
                                                                                Website
                                                                                <small class="text-muted">- optional</small>
                                                                            </label>
                                                                            <input type="text" name="contact[website]" placeholder="http://" class="form-control2">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label>
                                                                                File Attachment
                                                                                <small class="text-muted">Curriculum Vitae - optional</small>
                                                                            </label>

                                                                            <!-- custom file upload -->
                                                                            <div class="fancy-file-upload fancy-file-primary">
                                                                                <i class="fa fa-upload"></i>
                                                                                <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                                <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                                <span class="button">Choose File</span>
                                                                            </div>
                                                                            <small class="text-muted block">Max file size: 10Mb (zip/pdf/jpg/png)</small>

                                                                        </div>
                                                                    </div>
                                                                </div>





                                                            </fieldset>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
                                                                        SEND APPLICATION
                                                                        <span class="block font-lato">We'll get back to you within 48 hours</span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                            </td>

                        </tr>
                        <tr>
                            <td>
                                4
                            </td>
                            <td>
                                <a href="graphs-flot-namestd.html">นางสาวบงกช คำภักดึ</a>
                            </td>
                            <td>
                                <a href="graphs-flot-std-id.html">512564953-9</a>
                            </td>
                            <td>
                                CS
                            </td>
                            <td>
                                ป.โท
                            </td>
                            <td>
                                <a href="graphs-flot-teacher1.html">ผศ.ดร.พุธษดี ศิริแสงตระกูล</a>
                            </td>
                            <td>
                                <a href="graphs-flot-std.html">Thai Machine</a>
                            </td>
                            <td>
                                International
                            </td>
                            <td>
                                ชลบุรี
                            </td>
                            <td>
                                1-4 กุมภาพันธ์ 60
                            </td>
                            <td>
                                11,500
                            </td>
                            <td>
                                นานาชาติ
                            </td>

                            <td>
                                <!-- Large Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">เพิ่มผลงานรางวัล</button>
                                <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- header modal -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel">บันทึก</h4>
                                            </div>

                                            <!-- body modal -->
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panel-heading-transparent">
                                                        <strong>FORM VALIDATION</strong>
                                                    </div>

                                                    <div class="panel-body">

                                                        <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                            <fieldset>
                                                                <!-- required [php action request] -->
                                                                <input type="hidden" name="action" value="contact_send" />

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>First Name *</label>
                                                                            <input type="text" name="contact[first_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Last Name *</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Last Name *</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Email *</label>
                                                                            <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Phone *</label>
                                                                            <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>Position *</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">PR &amp; Marketing</option>
                                                                                <option value="Developer">Web Developer</option>
                                                                                <option value="php">PHP Programmer</option>
                                                                                <option value="Javascript">Javascript Programmer</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Expected Salary *</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Start Date *</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>Experience *</label>
                                                                            <textarea name="contact[experience]" rows="4" class="form-control2 required"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>
                                                                                Website
                                                                                <small class="text-muted">- optional</small>
                                                                            </label>
                                                                            <input type="text" name="contact[website]" placeholder="http://" class="form-control2">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label>
                                                                                File Attachment
                                                                                <small class="text-muted">Curriculum Vitae - optional</small>
                                                                            </label>

                                                                            <!-- custom file upload -->
                                                                            <div class="fancy-file-upload fancy-file-primary">
                                                                                <i class="fa fa-upload"></i>
                                                                                <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                                <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                                <span class="button">Choose File</span>
                                                                            </div>
                                                                            <small class="text-muted block">Max file size: 10Mb (zip/pdf/jpg/png)</small>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </fieldset>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
                                                                        SEND APPLICATION
                                                                        <span class="block font-lato">We'll get back to you within 48 hours</span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                            </td>

                        </tr>
                        <tr>
                            <td>
                                5
                            </td>
                            <td>
                                <a href="graphs-flot-namestd.html">นางสาวกสิกร รักษา</a>
                            </td>
                            <td>
                                <a href="graphs-flot-std-id.html">545320214-9</a>
                            </td>
                            <td>
                                CS
                            </td>
                            <td>
                                ป.โท
                            </td>
                            <td>
                                <a href="graphs-flot-teacher1.html">ผศ.ดร.พุธษดี ศิริแสงตระกูล</a>
                            </td>
                            <td>
                                <a href="graphs-flot-std.html">Thai Machine</a>
                            </td>
                            <td>
                                International
                            </td>
                            <td>
                                ชลบุรี
                            </td>
                            <td>
                                1-4 กุมภาพันธ์ 60
                            </td>
                            <td>
                                11,500
                            </td>
                            <td>
                                นานาชาติ
                            </td>

                            <td>
                                <!-- Large Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">เพิ่มผลงานรางวัล</button>
                                <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- header modal -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel">บันทึก</h4>
                                            </div>

                                            <!-- body modal -->
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panel-heading-transparent">
                                                        <strong>FORM VALIDATION</strong>
                                                    </div>

                                                    <div class="panel-body">

                                                        <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                            <fieldset>
                                                                <!-- required [php action request] -->
                                                                <input type="hidden" name="action" value="contact_send" />

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>First Name *</label>
                                                                            <input type="text" name="contact[first_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Last Name *</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Last Name *</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Email *</label>
                                                                            <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Phone *</label>
                                                                            <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>Position *</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">PR &amp; Marketing</option>
                                                                                <option value="Developer">Web Developer</option>
                                                                                <option value="php">PHP Programmer</option>
                                                                                <option value="Javascript">Javascript Programmer</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Expected Salary *</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Start Date *</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>Experience *</label>
                                                                            <textarea name="contact[experience]" rows="4" class="form-control2 required"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>
                                                                                Website
                                                                                <small class="text-muted">- optional</small>
                                                                            </label>
                                                                            <input type="text" name="contact[website]" placeholder="http://" class="form-control2">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label>
                                                                                File Attachment
                                                                                <small class="text-muted">Curriculum Vitae - optional</small>
                                                                            </label>

                                                                            <!-- custom file upload -->
                                                                            <div class="fancy-file-upload fancy-file-primary">
                                                                                <i class="fa fa-upload"></i>
                                                                                <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                                <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                                <span class="button">Choose File</span>
                                                                            </div>
                                                                            <small class="text-muted block">Max file size: 10Mb (zip/pdf/jpg/png)</small>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </fieldset>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
                                                                        SEND APPLICATION
                                                                        <span class="block font-lato">We'll get back to you within 48 hours</span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                            </td>

                        </tr>


                        </tbody>
                    </table>

                </div>
                <!-- /panel content -->

            </div>

        </div>



    </section>
    <!-- /MIDDLE -->

</div>

<!--00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000-->








<!--00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000-->
<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>

<!-- PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
    loadScript(plugin_path + "chart.flot/jquery.flot.min.js", function(){
        loadScript(plugin_path + "chart.flot/jquery.flot.resize.min.js", function(){
            loadScript(plugin_path + "chart.flot/jquery.flot.time.min.js", function(){
                loadScript(plugin_path + "chart.flot/jquery.flot.fillbetween.min.js", function(){
                    loadScript(plugin_path + "chart.flot/jquery.flot.orderBars.min.js", function(){
                        loadScript(plugin_path + "chart.flot/jquery.flot.pie.min.js", function(){
                            loadScript(plugin_path + "chart.flot/jquery.flot.tooltip.min.js", function(){

                                // demo js script
                                loadScript("assets/js/view/demo.graphs.flot.js");

                            });
                        });
                    });
                });
            });
        });
    });
</script>

</body>
</html>