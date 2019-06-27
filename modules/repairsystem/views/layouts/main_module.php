<?php
use app\modules\onlinerequest\assets\AppAsset;
AppAsset::register($this);
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;
use mdm\admin\components\MenuHelper;

$this->title = 'Req';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบแจ้งซ่อมออนไลน์นะจ๊ะ คิคิ</title>
    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <?php $this->head() ?>


</head>
<body>

    <?php $this->beginBody() ?>
    <div id="wrapper" class="clearfix">
        <!-- ASIDE -->
        <aside id="aside">


    <nav id="sideNav"><!-- MAIN MENU -->
        <ul class="nav nav-list ">
            <li class=""><!-- dashboard -->
                 <?= Html::a(' <i class="main-icon fa fa-home"></i> <span>หน้าหลัก</span>', ['/repair'], ['class' => '']) ?>
            </li>
            <?php
            echo Nav::widget([
                'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id),

            ]);
            ?>
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
      <img src="<?= Yii::getAlias('@web') ?>/images/logo_light.png" alt="admin panel" height="35" />
    </span>

  <!--  <form method="get" action="page-search.html" class="search pull-left hidden-xs">
        <input type="text" class="form-control" name="k" placeholder="Search for something..." />
    </form> -->

    <nav>

        <!-- OPTIONS LIST -->
        <ul class="nav pull-right">

            <!-- USER OPTIONS -->
            <li class="dropdown pull-left">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <img class="user-avatar" alt="" src="<?= Yii::getAlias('@web') ?>/images/noavatar.jpg" height="34" />
                    <span class="user-name">
              <span class="hidden-xs">
                 <?php
                                     if( !Yii::$app->user->isGuest) {
                                         if (Yii::$app->user->identity->username == 'admin') {
                                             print('Account('.Yii::$app->user->identity->username.')');
                                         } else {
                                             print('Account('.Yii::$app->user->identity->username.')');
                                         }
                                     }else{
                                         print "ยังไม่ได้เข้าสู่ระบบ";
                                     }


                                     ?>
              </span>
            </span>
                </a>
                <ul class="dropdown-menu hold-on-click">
                    <?php
                    if( !Yii::$app->user->isGuest) {
                        if (Yii::$app->user->identity->username == 'admin') {
                            // print(Yii::$app->user->identity->id);
                            ?>
                            <li><!-- my calendar -->
                                <a href="<?= Yii::getAlias('@web') ?>/user/admin/index"> Admin</a>
                            </li>
                            <?php
                        } else {

                        }

                        ?>

                        <li><!-- my inbox -->
                            <a href="<?= Yii::getAlias('@web') ?>/user/settings/profile">Profile</a>
                        </li>
                        <li><!-- settings -->
                            <a href="<?= Yii::getAlias('@web') ?>/user/settings/account"> Account</a>
                        </li>
                    <?php } ?>

                    <li class="divider"></li>
                    <li><!-- logout -->

                        <!--    <form action="<?= Yii::getAlias('@web') ?>/site/logout" method="post">
                            <button type="submit" class="btn btn-link logout">Log Out</button>
                        </form> -->

                        <a href="<?= Yii::getAlias('@web') ?>/site/logout">Log Out</a>
                    </li>
                </ul>
            </li>
            <!-- /USER OPTIONS -->
                </ul>
            </li>
            <!-- /USER OPTIONS -->

        </ul>
        <!-- /OPTIONS LIST -->

    </nav>

</header>
<!-- /HEADER -->

<!-- MIDDLE -->
<section id="middle">
  <div id="content" class="dashboard padding-20">

      <!--
          PANEL CLASSES:
              panel-default
              panel-danger
              panel-warning
              panel-info
              panel-success

          INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
                  All pannels should have an unique ID or the panel collapse status will not be stored!
      -->
      <div id="panel-1" class="panel panel-default">
        <div id="panel-1" class="panel panel-default">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>Repair System</strong> <!-- panel title -->
                  </span>

                <!-- right options -->
                <ul class="options pull-right list-inline">
                    <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                    <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                </ul>
                <!-- /right options -->

            </div>

            <!-- panel content -->
            <div class="panel-body">

              <?= $content ?>
            </div>
            <!-- /panel content -->

        </div>
        <!-- /PANEL -->


  </div>

</div>
    </section>
    <!-- /MIDDLE -->
</div>
<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = '<?= Yii::$app->homeUrl; ?>assets/plugins/';</script>
<?php $this->registerJs("");?>

  <!-- MY JS -->
  <!-- <script type="text/javascript" src="assets/js/my-js.js"></script> -->
  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
