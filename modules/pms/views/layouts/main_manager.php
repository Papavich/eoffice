<?php

use yii\helpers\Html;
use app\modules\pms\assets\AppAssets;
use app\assets\AppAsset2;

AppAsset2::register($this);
\app\modules\pms\assets\AppAsset::register($this);
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
                            ['manager/index'])
                        ?>
                    </li>
                    <li <?php if ($this->params['page'] == 'addyearpro'){ ?>class="active"<?php } ?>>
                        <?= Html::a("<i class='main-icon fa fa-pencil-square-o' ></i> <span>เพิ่มโครงการหลัก</span>",
                            ['manager/pageaddproyear'])
                        ?>
                    </li>


                    <li  <?php if ($this->params['active'] == 'listactive'){ ?>class="active"<?php } ?>>
                        <a>
                            <i class="fa fa-menu-arrow pull-right"></i>
                            <i class="main-icon fa fa-table"></i> <span>โครงการ / กิจกรรม</span>
                        </a>
                        <ul>
                            <!-- submenus -->
                            <li <?php if ($this->params['page'] == 'totalpro'){ ?>class="active"<?php } ?>>
                                <?= Html::a(" <span>โครงการทั้งหมด</span>",
                                    ['manager/totalpro'])
                                ?>
                            </li>
                            <li <?php if ($this->params['page'] == 'perplan'){ ?>class="active"<?php } ?>>
                                <?= Html::a(" <span>ขออนุมัติจัดโครงการ</span>",
                                    ['manager/permisplan'])
                                ?>
                            </li>
                            <li <?php if ($this->params['page'] == 'perfinance'){ ?>class="active"<?php } ?>>
                                <?= Html::a(" <span>ขออนุมัติใช้งบประมาณ</span>",
                                    ['manager/permisfinance'])
                                ?>
                            </li>
                        </ul>
                    </li>

                    <li <?php if ($this->params['page'] == 'logout'){ ?>class="active"<?php } ?>>
                        <?= Html::a("<i class='main-icon fa fa-power-off' ></i> <span>กลับสู่ระบบหลัก</span>",
                            ['manager/logout'])
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
					<img src="<?= Yii::getAlias('@web') ?>/images/logo_light.png" alt="admin panel" height="35"/>
				</span>
            <nav>

                <!-- OPTIONS LIST -->
                <ul class="nav pull-right">

                    <!-- USER OPTIONS -->
                    <li class="dropdown pull-left">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <img class="user-avatar" alt="" src="<?= Yii::getAlias('@web') ?>/images/noavatar.jpg"
                                 height="34" width="34"/>
                            <span class="user-name">
									<span class="hidden-xs">
										หัวหน้าภาค  <i class="fa fa-angle-down"></i>
									</span>
								</span>
                        </a>
                        <ul class="dropdown-menu hold-on-click">
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

    <!-- JAVASCRIPT FILES -->
    <script type="text/javascript">var plugin_path = '<?= Yii::getAlias('@web') ?>/plugins/';</script>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>