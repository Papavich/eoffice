<!-- WRAPPER -->
<div id="wrapper" class="clearfix">

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
                <li class="active"><!-- dashboard -->
                    <a class="dashboard" href="#"><!-- warning - url used by default by ajax (if eneabled) -->
                        <i class="main-icon fa fa-home"></i> <span>หน้าแรก</span>
                    </a>
                </li>
                <li>
                    <a href="inbox.php">
                        <i class="pull-right"></i>
                        <i class="main-icon fa fa-envelope"></i> <span>กล่องข้อความ/ส่ง</span>
                        <span class="label label-danger pull-right">2</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa-book"></i> <span>หนังสือรับ</span>
                    </a>
                    <ul><!-- submenus -->

                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa-file"></i> <span>การออกรายงาน</span>
                    </a>
                    <ul><!-- submenus -->
                      <!--  <li><a href="graphs-flot.html">หนังสือรับภายนอก</a></li> -->
                    </ul>
                </li>
                <li>
                    <a href="history.php">
                        
                        <i class="main-icon glyphicon glyphicon-info-sign"></i> <span>ประวัติการเข้าใช้งาน</span>
                    </a>
                    <ul><!-- submenus -->
                      <!--  <li><a href="graphs-flot.html">หนังสือรับภายนอก</a></li> -->
                    </ul>
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
					<img src="../logo.png" alt="admin panel" height="40"/>
				</span>

        <form method="get" action="page-search.html" class="search pull-left hidden-xs">
            <input type="text" class="form-control" name="k" placeholder="ค้นหา ..."/>
        </form>

        <nav>
            <!-- OPTIONS LIST -->
            <ul class="nav pull-right">
                <!-- USER OPTIONS -->
                <li class="dropdown pull-left">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <img class="user-avatar" alt="" src="../assets/images/noavatar.jpg" height="34"/>
                        <span class="user-name">
									<span class="hidden-xs">
										นางสาวกนิษฐา  พูลลาภ <i class="fa fa-angle-down"></i>
									</span>
								</span>
                    </a>
                    <ul class="dropdown-menu hold-on-click">
                        <li><!-- my calendar -->
                            <a href="page-user-profile.php"><i class="fa fa-user"></i>โปรไฟล์</a>
                        </li>

                        <li class="divider"></li>
                        <li><!-- logout -->
                            <a href="page-login.php"><i class="fa fa-power-off"></i>ออกจากระบบ</a>
                        </li>
                    </ul>
                </li>
                <!-- /USER OPTIONS -->

            </ul>
            <!-- /OPTIONS LIST -->

        </nav>

    </header>
    <!-- /HEADER -->


    <!-- JAVASCRIPT FILES -->
    <script type="text/javascript" src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../assets/js/app.js"></script>

      

    <!-- STYLESWITCHER - REMOVE
    <script async type="text/javascript" src="assets/plugins/styleswitcher/styleswitcher.js"></script>-->
