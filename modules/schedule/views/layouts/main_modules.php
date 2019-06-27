<?php
use app\assets\AppAsset2;
use yii\widgets\Menu;
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;
$userType =0;
AppAsset2::register($this);
$this->beginPage() ?>

<?php $this->beginPage() ?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title></title>
    <meta name="description" content="" />
    <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />

    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

    <!-- WEB FONTS -->
    <?php $this->head() ?>
</head>
<!--
    .boxed = boxed version
-->
<body>
<?php $this->beginBody() ?>

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
           <?php $function = new \app\components\MyManager(); ?>
            <?php

            echo Menu::widget([
                'items' => [
                    ['label' => '<i class="main-icon fa fa-home"></i> <span>หน้าหลัก</span>', 'url' => ['../']],
                ],
                'encodeLabels' => false,
                'activateParents' => true,
                'options' => [
                    'class' => 'nav nav-list',
                ]

            ]);

            echo Menu::widget([
                'items'  => $function->getmenuParentModule("schedule"),

                'encodeLabels' => false,
                'activateParents' => true,
                'options' => [
                    'class' => 'nav nav-list',
                ]
            ]);


            ?>




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

        <form method="get" action="page-search.html" class="search pull-left hidden-xs">
            <input type="text" class="form-control" name="k" placeholder="Search for something..." />
        </form>

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




<!-- STYLESWITCHER - REMOVE -->
<?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>