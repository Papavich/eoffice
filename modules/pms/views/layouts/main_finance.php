<?php

use yii\helpers\Html;
use app\modules\eoffice\assets\AppAssets;
use app\assets\AppAsset;

AppAsset::register($this);
\app\modules\eoffice\assets\AppAsset::register($this);
$this->beginPage() ?>

    <!doctype html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <title>themelock.com - Smarty Admin</title>
        <meta name="description" content=""/>
        <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]"/>

        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>

        <?php $this->head() ?>
    </head>
    <!--
        .boxed = boxed version
    -->
    <body>
    <?php $this->beginBody() ?>

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
            <nav id="sideNav">
                <!-- MAIN MENU -->
                <h3>เมนู</h3>
                <ul class="nav nav-list menubox">

                    <li <?php if ($this->params['page'] == 'index'){ ?>class="active"<?php } ?>>
                        <?= Html::a("<i class='main-icon fa fa-home' ></i> <span>หน้าหลัก</span>",
                            ['head/index'])
                        ?>
                    </li>
                    <li>
                        <a>
                            <i class="fa fa-menu-arrow pull-right"></i>
                            <i class="main-icon fa fa-table"></i> <span>โครงการ / กิจกรรม</span>
                        </a>
                        <ul>
                            <!-- submenus -->
                            <li><a href="table_total_pro.html">โครงการทั้งหมด</a></li>
                            <li><a href="table_admin_offer.html">โครงการที่รอการอนุมัติ</a></li>
                            <li><a href="history_edit.html">ประวัติแก้ไขโครงการ</a></li>
                        </ul>
                    </li>

                    <li <?php if ($this->params['page'] == 'totalp'){ ?>class="active"<?php } ?>>
                        <?= Html::a("<i class='main-icon fa fa-table' ></i> <span>โครงการทั้งหมด</span>",
                            ['head/totalp'])
                        ?>
                    </li>

                    <li <?php if ($this->params['page'] == 'waitp'){ ?>class="active"<?php } ?>>
                        <?= Html::a("<i class='main-icon fa fa-table' ></i> <span>โครงการที่รอการอนุมัติ</span>",
                            ['head/waitp'])
                        ?>
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
					<img src="<?= Yii::$app->homeUrl; ?>assets/images/logo_light.png" alt="admin panel" height="35"/>
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
                            <img class="user-avatar" alt="" src="<?= Yii::$app->homeUrl; ?>assets/images/noavatar.jpg"
                                 height="34"/>
                            <span class="user-name">
									<span class="hidden-xs">
										หัวหน้าภาค <i class="fa fa-angle-down"></i>
									</span>
								</span>
                        </a>
                        <ul class="dropdown-menu hold-on-click">
                            <li><!-- my calendar -->
                                <a href="calendar.html"><i class="fa fa-calendar"></i> ปฏิทิน</a>
                            </li>
                            <li><!-- my inbox -->
                                <a href="#"><i class="fa fa-envelope"></i> กล่องข้อความ
                                    <span class="pull-right label label-default">0</span>
                                </a>
                            </li>
                            <li><!-- settings -->
                                <a href="page-user-profile.html"><i class="fa fa-cogs"></i> ตั้งค่า</a>
                            </li>

                            <li class="divider"></li>

                            <li><!-- logout -->
                                <a href="page-login.html"><i class="fa fa-power-off"></i> ออกจากระบบ</a>
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
            <?= $content ?>
        </section>
        <!-- /MIDDLE -->

    </div>
    <script type="text/javascript">
        var plugin_path = '<?= Yii::$app->homeUrl; ?>assets/plugins/';
    </script>
    <?php
    $this->registerJs(<<<JS
            $(document).ready(function(){
            
              var current_page_URL = window.location.href;               
              $( "a" ).each(function() {
                 if ($(this).attr("href") !== "#") { //get element tag a href
                   var target_URL = $(this).prop("href");
                   
                   if (target_URL == current_page_URL) {
                       //$('.menubox ul li').parent().css({"color": "red", "border": "2px solid red"});                      
                      $(this).parent('li').addClass('active');
                      $('.menubox li .active').parent().addClass('menu-open');
                      
                      return false;
                   }
                 }
                });
            
            });

JS
    );
    ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>