<?php

/* @var $this \yii\web\View */

/* @var $content string */


use app\assets\AppAsset;
use yii\helpers\Html;


\app\modules\kku30\assets\AppAsset::register($this);

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <title>KKU 30</title>
    <meta name="description" content=""/>
    <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]"/>
    <?= Html::csrfMetaTags() ?>
    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>

    <!-- WEB FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext"
          rel="stylesheet" type="text/css"/>

    <?php $this->head() ?>
</head>
<body style="background-color: #FFFAFA;">
<?php $this->beginBody() ?>
<!-- WRAPPER -->
<div id="wrapper" class="clearfix">
    <aside id="aside">
        <nav id="sideNav"><!-- MAIN MENU -->
            <?php echo \yii\widgets\Menu::widget([
                "items" => [
                    //Create Schedule
                    ["label" => " <span><h3>ADMIN</h3></span> ", "url" => ["#"]],
                    ["label" => "	<i class=\"main-icon fa fa fa-table\"></i> <span>จัดตารางเรียน</span> ", "url" => ["table/createtable"]],
                    ["label" => "	<i class=\"fa fa-menu-arrow pull-right\"></i><i class=\"main-icon fa fa-pencil-square-o \"></i> <span>เตรียมข้อมูลก่อนจัดตาราง</span> ", "url" => ["#"],
                        'template' => '<a href="#">{label}</a>',
                        'items' => [
                            ['label' => "	<i class=\"main-icon fa fa-list-alt\"></i> <span>แสดงวิชาที่เปิดสอน</span> ", "url" => ["adder/showsubject"]],
                            ['label' => "	<i class=\"main-icon fa fa fa-plus-square-o\"></i> <span>เพิ่มเงื่อนไข</span> ", "url" => ["condition/rendercondition"]],
//
                        ]
                    ],
                    ["label" => "	<i class=\"main-icon fa fa-cogs\"></i> <span>แก้ไขผลการจัดตาราง</span> ", "url" => ["table/edittable"]],
                    ["label" => " <i class=\"main-icon fa fa-database\"></i> <span>จัดการข้อมูล</span> ", "url" => ["condition/showdatamanagements"]],
                    ["label" => " <i class=\"main-icon glyphicon glyphicon-remove\" style='color: red'></i> <span style='color: red'>ลบผลการจัดตาราง</span> ", "url" => ["condition/showdeletetimetable"]],
                    ["label" => " <span><h3>USERS</h3></span> ", "url" => ["#"]],
                    ["label" => "	<i class=\"main-icon fa fa-mortar-board\"></i> <span>ตารางเรียน</span> ", "url" => ["table/timetable"]],
                    ["label" => "	<i class=\"main-icon fa fa fa-edit\"></i> <span>ตารางสอน</span> ", "url" => ["table/teachtable"]],
                    ["label" => "	<i class=\"main-icon fa fa fa-university\"></i> <span>ตารางการใช้ห้องเรียน</span> ", "url" => ["table/roomtable"]],
                    ["label" => "	<i class=\"main-icon fa fa fa-balance-scale\"></i> <span>เปรียบเทียบตาราง</span> ", "url" => ["table/comparetable"]],

                ],
                'encodeLabels' => false,
                'activateParents' => true,
                'options' => [
                    'class' => 'nav nav-list',
                ]
            ])
            ?>
        </nav>
        <span id="asidebg"><!-- aside fixed background --></span>
    </aside>
    <!-- /ASIDE -->
    <!-- HEADER -->
    <header id="header">
        <!-- Mobile Button -->
        <button id="mobileMenuBtn"></button>
        <!--        = Yii::$app->basePath?><!--/assets/images/logo_light.png-->
        <!-- Logo jaa-->
        <span class="logo pull-left">
					<img src="<?= Yii::$app->homeUrl ?>web_kku30/images/logo_kku30.png" alt="admin panel" height="35"/>
				</span>
        <form method="get" action="page-search.html" class="search pull-left hidden-xs">
            <input type="text" class="form-control" name="k" placeholder="Search for something..."/>
        </form>
        <nav>
            <!-- OPTIONS LIST -->
            <ul class="nav pull-right">
                <!-- USER OPTIONS -->
                <li class="dropdown pull-left">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <img class="user-avatar" alt="" src="<?= Yii::$app->homeUrl ?>web_eproject/images/noavatar.jpg"
                             height="34"/>
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
    <!--    content-->
    <section id="middle">
        <?= $content ?>
    </section>
    <!--    content-->
</div>
<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = '<?=Yii::getAlias("@web")?>/plugins/';</script>
<!-- PAGE LEVEL SCRIPT -->
<script type="text/javascript">
    _toastr("Welcome, you have 2 new orders", "top-right", "success", false);
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
