<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use mdm\admin\components\MenuHelper;

AppAsset::register($this);
$this->title = 'ระบบทุนการศึกษา';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous">

    </script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- WRAPPER -->
<div id="wrapper">
    <aside id="aside">
        <nav id="sideNav"><!-- MAIN MENU -->
            <ul class="nav nav-list menubox">
                <!-- นักศึกษา -->
                <li><!-- Demo -->
                    <?= Html::a("<i class=\"main-icon fa fa-home\"></i> <span>หน้าหลัก</span>",
                        ['login/login-success'], ['class' => 'main']) ?>
                <li>
                <li>
                    <?= Html::a("<i class=\"main-icon fa fa-user-plus\"></i><span>สมัครทุนการศึกษา</span>",
                        ['scholarship/indexscb'], ['class' => 'main']) ?>
                </li>
                <li>
                    <?= Html::a("<i class=\"main-icon fa fa-refresh\"></i> <span>แก้ไขข้อมูลส่วนตัว</span>",
                        ['candidate/account-scb']) ?>
                </li>
                <li>
                    <?= Html::a("<i class=\"main-icon fa fa-lock\"></i><span>ออกจากระบบ</span>",
                        ['site/logout']) ?>
                </li>
            </ul>

            <!--Main System -->
            <h3>ระบบหลัก</h3>
            <ul class="nav nav-list menubox">
                <li>
                    <?= Html::a("<i class=\"main-icon glyphicon glyphicon-log-out\"></i><span>กลับสู่เมนูหลัก</span>",
                        ['../']) ?>
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
					<img src="<?= Yii::$app->homeUrl ?>web_scb/images/logo_scb_light.png" alt="admin panel"
                         height="35"/>
				</span>
        <nav>

            <!-- OPTIONS LIST -->
            <ul class="nav pull-right menubox">

                <!-- USER OPTIONS -->
                <li class="dropdown pull-left">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <img class="user-avatar" alt=""
                             src="<?= Yii::$app->homeUrl ?>web_scb/images/images/noavatar.jpg"
                             height="34"/>
                        <span class="user-name">
									<span class="hidden-xs">
                                        สวัสดี
                                        <?php
                                        $session = Yii::$app->session;
                                        $session->open();

                                        echo $session['firstname'];
                                        ?>
                                        <i class="fa fa-angle-down"></i>

									</span>
								</span>
                    </a>
                    <ul class="dropdown-menu hold-on-click">
                        <li><!-- Account -->
                            <a href="../candidate/view?"><i class="fa fa-user"></i> ข้อมูลส่วนตัว</a>
                        </li>
                        <li class="divider"></li>
                        <form action="../site/logout" method="post">
                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                            <button type="submit" class="btn btn-link logout">Log Out</button>
                        </form>
                    </ul>
                </li>
                <!-- /USER OPTIONS -->

            </ul>
            <!-- /OPTIONS LIST -->

        </nav>
    </header>

    <section id="middle">
        <?= $content ?>
    </section>
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

    <script type="text/javascript">var plugin_path = '<?= Yii::$app->homeUrl ?>assets/plugins/'</script>

    <!-- var plugin_path =<?= Yii::$app->homeUrl ?>'assets/plugins/';  -->

    <!-- /HEADER -->
    <script type="text/javascript">
        /* Calendar Data main*/
        var date = new Date()
        var d = date.getDate()
        var m = date.getMonth()
        var y = date.getFullYear()

        var _calendarEvents = [
          {
            title: 'All Day Event',
            start: new Date(y, m, 1),
            allDay: false,
            className: ['bg-primary'],
            description: 'some description...',
            icon: 'fa-clock-o'
          },
          {
            title: 'Long Event',
            start: new Date(y, m, d - 5),
            end: new Date(y, m, d - 2),
            allDay: false,
            className: ['bg-primary'],
            description: '',
            icon: 'fa-check'
          },
          {
            id: 999,
            title: 'Repeating Event',
            start: new Date(y, m, d - 3, 16, 0),
            allDay: false,
            className: ['bg-warning'],
            description: '',
            icon: 'fa-clock-o'
          },
          {
            id: 999,
            title: 'Repeating Event',
            start: new Date(y, m, d + 4, 16, 0),
            allDay: false,
            className: ['bg-primary'],
            description: '',
            icon: 'fa-clock-o'
          },
          {
            title: 'Meeting',
            start: new Date(y, m, d, 10, 30),
            allDay: false,
            className: ['bg-primary'],
            description: '',
            icon: 'fa-lock'
          },
          {
            title: 'Lunch',
            start: new Date(y, m, d, 12, 0),
            end: new Date(y, m, d, 14, 0),
            allDay: false,
            className: ['bg-success'],
            description: '',
            icon: 'fa-clock-o'
          },
          {
            title: 'Birthday Party',
            start: new Date(y, m, d + 1, 19, 0),
            end: new Date(y, m, d + 1, 22, 30),
            allDay: false,
            className: ['bg-danger'],
            description: '',
            icon: ''
          },
          {
            title: 'Click for Google',
            start: new Date(y, m, 28),
            end: new Date(y, m, 29),
            url: 'http://google.com/',
            className: ['bg-info'],
            description: '',
            icon: 'fa-clock-o'
          }
        ]

    </script>

    <?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
