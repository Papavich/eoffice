<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\modules\eproject\components\AuthHelper;
use app\modules\eproject\controllers;
use app\modules\eproject\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$userType = AuthHelper::getUserType();
AppAsset::register( $this );
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode( $this->title ) ?></title>
    <?php $this->head() ?>
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>
</head>
<body class="smoothscroll enable-animation">
<?php $this->beginBody() ?>


<!--  ASIDE -->
<aside id="aside">
    <nav id="sideNav"><!-- MAIN MENU -->
        <!-- USER MENU-->
        <?php echo Menu::widget( [
            'items' => [
                ['label' => '<i class="main-icon fa fa-home"></i> <span>' . controllers::t( 'menu', 'Home' ) . '</span>', 'url' => ['site/index']],
                ['label' => '<i class="main-icon fa fa-newspaper-o"></i> <span>' . controllers::t( 'menu', 'News' ) . '</span>', 'url' => ['news/index'],
                    'visible' => $userType >= AuthHelper::TYPE_TEACHER],
                ['label' => '<i class="fa fa-menu-arrow pull-right"></i><i class="main-icon fa fa-newspaper-o"></i> <span>' . controllers::t( 'menu', 'News' ) . '</span>',
                    'template' => '<a href="#">{label}</a>',
                    'url' => ['#'], 'visible' => $userType == AuthHelper::TYPE_ADMIN, 'items' => [
                    ['label' => controllers::t( 'menu', 'Feeds' ), 'url' => ['news/index']],
                    ['label' => controllers::t( 'menu', 'Add' ), 'url' => ['news/create']],
                    ['label' => controllers::t( 'menu', 'Approve' ), 'url' => ['news/status']],
                ]],
                ['label' => '<i class="fa fa-menu-arrow pull-right"></i><i class="main-icon fa fa-file-text-o"></i> <span>' . controllers::t( 'menu', 'Projects' ) . '</span>',
                    'template' => '<a href="#">{label}</a>',
                    'url' => ['#'], 'items' => [
                    ['label' => controllers::t( 'menu', 'Search' ), 'url' => ['project/index']],
                    ['label' => controllers::t( 'menu', 'Not Submit Document Group' ), 'url' => ['project/unsent-document-std'],
                        'visible' => $userType == AuthHelper::TYPE_STUDENT || $userType == AuthHelper::TYPE_TEACHER || $userType == AuthHelper::TYPE_ADMIN],
                    ['label' => controllers::t( 'menu', 'Edit Project' ), 'url' => ['project/create'], 'visible' => $userType == AuthHelper::TYPE_STUDENT],
//                    ['label' => controllers::t( 'menu', 'Edit Project' ), 'url' => ['project/edit'], 'visible' => $userType == AuthHelper::TYPE_STUDENT],
                    ['label' => controllers::t( 'menu', 'Upload Project Document' ), 'url' => ['project-document/index'], 'visible' => $userType == AuthHelper::TYPE_STUDENT],
                    ['label' => controllers::t( 'menu', 'Change Topic Request' ), 'url' => ['project/change-topic'], 'visible' => $userType == AuthHelper::TYPE_STUDENT],
                    ['label' => controllers::t( 'menu', 'Change Member Request' ), 'url' => ['project/change-member'], 'visible' => $userType == AuthHelper::TYPE_STUDENT],
                ]], ['label' => '<i class="fa fa-menu-arrow pull-right"></i><i class="main-icon fa fa-user"></i> <span>' . controllers::t( 'menu', 'Project Adviser' ) . '</span>',
                    'template' => '<a href="#">{label}</a>', 'items' => [
                        ['label' => controllers::t( 'menu', 'Request Adviser' ), 'url' => ['adviser/request'], 'visible' => $userType == AuthHelper::TYPE_STUDENT],
//                        ['label' => controllers::t( 'menu', 'Requesting Adviser' ), 'url' => ['adviser/requested'], 'visible' => $userType == AuthHelper::TYPE_TEACHER],
                        ['label' => controllers::t( 'menu', 'Student Do Not Have Adviser' ), 'url' => ['adviser/no-adviser-std']],
                        ['label' => controllers::t( 'menu', 'Adviser Broadcast' ), 'url' => ['adviser/broadcast'], 'visible' => $userType == AuthHelper::TYPE_TEACHER],
                        ['label' => controllers::t( 'menu', 'Work Load' ), 'url' => ['adviser/work-load'], 'visible' => $userType == AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_ADMIN],
                        ['label' => controllers::t( 'menu', 'Student Status' ), 'url' => ['adviser/student-status'], 'visible' => $userType == AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_ADMIN],
                        ['label' => controllers::t( 'menu', 'Advisee Management' ), 'url' => ['adviser/management'], 'visible' => $userType == AuthHelper::TYPE_TEACHER],
                        ['label' => controllers::t( 'menu', 'Change Adviser' ), 'url' => ['adviser/change-adviser'], 'visible' => $userType == AuthHelper::TYPE_STUDENT],
                        ['label' => controllers::t( 'menu', 'Adviser Status' ), 'url' => ['adviser/student-per-adviser'],
                            'visible' => $userType == AuthHelper::TYPE_STUDENT || $userType == AuthHelper::TYPE_TEACHER || $userType == AuthHelper::TYPE_ADMIN],
                    ], 'visible' => $userType == AuthHelper::TYPE_STUDENT || $userType == AuthHelper::TYPE_TEACHER || $userType == AuthHelper::TYPE_ADMIN],
                ['label' => '<i class="fa fa-menu-arrow pull-right"></i><i class="main-icon fa fa-users"></i> <span>' . controllers::t( 'menu', 'Exam Group' ) . '</span>',
                    'template' => '<a href="#">{label}</a>', 'items' => [

                    ['label' => controllers::t( 'menu', 'Exam Committee' ), 'url' => ['examination/board']],
                ], 'visible' => $userType <= $userType == AuthHelper::TYPE_STUDENT || $userType == AuthHelper::TYPE_TEACHER || $userType == AuthHelper::TYPE_ADMIN],
                ['label' => '<i class="main-icon fa fa-list-alt"></i> <span>' . controllers::t( 'menu', 'Requesting' ) . '</span>', 'url' => [(AuthHelper::getUserType()==AuthHelper::TYPE_STUDENT) ? 'requesting/out' : 'requesting/in'],
                    'visible' => $userType == AuthHelper::TYPE_STUDENT || $userType == AuthHelper::TYPE_TEACHER],
                ['label' => '<i class="main-icon fa fa-calendar-minus-o"></i> <span>' . controllers::t( 'menu', 'Calendars' ) . '</span>', 'url' => ['calendar/index']],
                ['label' => '<i class="main-icon fa fa-download"></i>  <span>' . controllers::t( 'menu', 'Documents' ) . '</span>', 'url' => ['document/index']],
            ],
            'encodeLabels' => false,
            'activateParents' => true,
            'options' => [
                'class' => 'nav nav-list',
            ]
        ] );
        ?>
        <!-- END USER MENU -->
        <!-- ADMIIN MENU -->
        <?php
        if ($userType == AuthHelper::TYPE_ADMIN) {
            ?>
            <h3><?= controllers::t( 'menu', 'Administration' ) ?></h3>
            <?php
            echo Menu::widget( [
                'items' => [
//                    ['label' => '<i class="main-icon fa fa-unlock-alt"></i> <span>การจัดการสิทธิ์</span>', 'url' => ['admin-permission/index']],
//                    ['label' => '<i class="fa fa-menu-arrow pull-right"></i><i class="main-icon fa fa-male"></i> <span>' . controllers::t( 'menu', 'Students' ) . '</span>',
//                        'template' => '<a href="#">{label}</a>',
//                        'url' => ['#'], 'items' => [
//                        ['label' => controllers::t( 'menu', 'Import' ), 'url' => ['admin-std/add']],
//                    ]],
                    ['label' => '<i class="fa fa-menu-arrow pull-right"></i><i class="main-icon fa fa-sticky-note-o"></i> <span>' . controllers::t( 'menu', 'Subjects' ) . '</span>',
                        'template' => '<a href="#">{label}</a>',
                        'url' => ['#'], 'items' => [
                        ['label' => controllers::t( 'menu', 'Required Documents' ), 'url' => ['admin-subject/document-type']],
                        ['label' => controllers::t( 'menu', 'Dashboard' ), 'url' => ['admin-dashboard/index']],
                    ]],
                    ['label' => '<i class="fa fa-menu-arrow pull-right"></i><i class="main-icon fa fa fa-tasks"></i> <span>' . controllers::t( 'menu', 'Projects' ) . '</span>',
                        'template' => '<a href="#">{label}</a>',
                        'url' => ['#'], 'items' => [
                        //                        ['label' => 'โครงงานต่อเนื่อง', 'url' => ['admin-project-continuous/index']],
                        ['label' => controllers::t( 'menu', 'Assign Exam Group' ), 'url' => ['admin-project-exam-group/index']],
                        ['label' => controllers::t( 'menu', 'Running Project Number' ), 'url' => ['admin-project-running/index']],
                        ['label' => controllers::t( 'menu', 'Document Type' ), 'url' => ['document-type/index']],
                        ['label' => controllers::t( 'menu', 'Publications Type' ), 'url' => ['admin-public-type/index']],
                        ['label' => controllers::t( 'menu', 'Tools' ), 'url' => ['tool/index']],
                        ['label' => controllers::t( 'menu', 'Theory' ), 'url' => ['theory/index']],
                        ['label' => controllers::t( 'menu', 'Project Type' ), 'url' => ['admin-project-type/index']],

                    ]],
                    ['label' => '<i class="fa fa-menu-arrow pull-right"></i><i class="main-icon fa fa-sticky-note"></i> <span>' . controllers::t( 'menu', 'Reporting' ) . '</span>',
                        'template' => '<a href="#">{label}</a>',
                        'url' => ['#'], 'items' => [
                        ['label' => controllers::t( 'menu', 'Topic' ), 'url' => ['admin-reporting/topic']],
                        ['label' => controllers::t( 'menu', 'Exam Group' ), 'url' => ['admin-reporting/group']],
//                        ['label' => 'โครงงานตามกลุ่มสอบ', 'url' => ['admin-reporting/group']],
//                        ['label' => 'โครงงานตามที่ปรึกษา', 'url' => ['admin-reporting/adviser']],
//                        ['label' => 'โครงงานตามสาขา', 'url' => ['admin-reporting/branch']],
                        ['label' => controllers::t( 'menu', 'Score Table' ), 'url' => ['admin-reporting/score-table']],
//                        ['label' => controllers::t( 'menu', 'Student Status' ), 'url' => ['admin-reporting/student-status']],
                        ['label' => controllers::t( 'menu', 'Projects Per Adviser' ), 'url' => ['admin-reporting/project-per-adviser']],
                        ['label' => controllers::t( 'menu', 'Unsent Project Student' ), 'url' => ['admin-reporting/unsent-topic']],
                        ['label' => controllers::t( 'menu', 'Not Submit Document Group' ), 'url' => ['admin-reporting/unsent-document']],
                    ]]
//                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ],
                'encodeLabels' => false,
                'activateParents' => true,
                'options' => [
                    'class' => 'nav nav-list',
                ]
            ] );
        } ?>
        <!-- END ADMIN MENU -->
        <?php

        ?>
        <h3><?= controllers::t( 'menu', 'Main System' ) ?></h3>
        <?php
        echo Menu::widget( [
            'items' => [
//                     'items' => [
                ['label' => '<i class="main-icon glyphicon glyphicon-log-out"></i> <span>' . controllers::t( 'menu', 'Back To Main System' ) . '</span>', 'url' => ['/']],
            ],
            'encodeLabels' => false,
            'activateParents' => true,
            'options' => [
                'class' => 'nav nav-list',
            ]
        ] );
        ?>
    </nav>
    <span id="asidebg"><!-- aside fixed background --></span>
</aside>
<!-- END ASIDE -->


<div id="wrapper">
    <!-- HEADER -->
    <header id="header">

        <!-- Mobile Button -->
        <button id="mobileMenuBtn"></button>

        <!-- Logo -->
        <span class="logo pull-left" style="font-size:x-large;color: lightgoldenrodyellow">

            <?=Html::img(Yii::getAlias('@web/web_eproject/images/logo1.png'),['height'=>'28','style'=>'margin-top:5px'])?>
            <!--					<img src="/images/logo_light.png" alt="admin panel" height="35"/>-->
        </span>
        <!-- SEARCH -->
<!--        <form method="get" action="page-search.html" class="search pull-left hidden-xs">-->
<!--            <input type="text" class="form-control" name="k" placeholder="Search for something..."/>-->
<!--        </form>-->
        <!-- END SEARCH -->

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
										<?php
                                        if (!Yii::$app->user->isGuest) {

                                                print( User::findOne(Yii::$app->user->identity->getId())->name);

                                        } else {
                                            print controllers::t('label','Not Login');
                                        }
                                        ?> <i class="fa fa-angle-down"></i>
									</span>
								</span>
                    </a>
                    <ul class="dropdown-menu hold-on-click">
                        <li><!-- my calendar -->
                            <a href="calendar.html"><i
                                        class="fa fa-calendar"></i> <?= controllers::t( 'menu', 'Schedules' ) ?></a>
                        </li>
                        <li><!-- my inbox -->
                            <a href="#"><i class="fa fa-envelope"></i> <?= controllers::t( 'menu', 'Notifications' ) ?>
                                <span class="pull-right label label-default">0</span>
                            </a>
                        </li>
                        <li><!-- settings -->
                            <a href="page-user-profile.html"><i
                                        class="fa fa-cogs"></i> <?= controllers::t( 'menu', 'Edit User Profile' ) ?></a>
                        </li>


                        <li><!-- logout -->
                            <a href="page-login.html"></a>
                        </li>
                        <li>
                            <?php
                            if (!Yii::$app->user->isGuest) { ?>
                        <li class="divider"></li>
                                <form action="<?= Yii::getAlias( '@web' ) ?>/site/logout" method="post" style="margin:0">
                                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                                    <button type="submit" class="btn btn-link "><i
                                                class="fa fa-power-off"></i> <?= controllers::t( 'menu', 'Logout' ) ?></button>
                                </form>
                        <?php } else {
                            ?>
                        <li class="divider"></li>
                            <li>
                                <a href="<?= Yii::getAlias( '@web' ) ?>/user/security/login"><i
                                            class="fa fa-power-off"></i> <?= controllers::t( 'menu', 'Login' ) ?></a>
                            </li>
                        <?php } ?>
                        </li>
                    </ul>
                </li>
                <!-- /USER OPTIONS -->
            </ul>
            <!-- /OPTIONS LIST -->
        </nav>
        <div class="pull-right" style="padding-top: 4px">
            <?= Html::a( '<img src="' . Yii::$app->homeUrl . 'images/th.png" height="14"/>', ['language/change?lang=th'] ) ?>
            <br>
            <?= Html::a( '<img src="' . Yii::$app->homeUrl . 'images/en.png" height="14"/>', ['language/change?lang=en'] ) ?>
        </div>
    </header>
    <!-- /HEADER -->

    <!-- MIDDLE -->
    <section id="middle">
        <!-- page title -->
        <header id="page-header">
            <?php if (Yii::$app->session->hasFlash( 'alert' )&&false): ?>
                <?= \yii\bootstrap\Alert::widget( [
                    'body' => ArrayHelper::getValue( Yii::$app->session->getFlash( 'alert' ), 'body' ),
                    'options' => ArrayHelper::getValue( Yii::$app->session->getFlash( 'alert' ), 'options' ),
                ] ) ?>

            <?php endif; ?>

            <?php echo \yii2mod\alert\Alert::widget()?>
            <h1><?= Html::encode( $this->title ) ?></h1>
            <?= Breadcrumbs::widget( [
                //'itemTemplate'=>"<li><i>{link}</i></li>\n",
                'homeLink' => [
                    'label' => controllers::t( 'menu', 'Home' ),
                    'url' => ['site/index'],
                ],
                'links' => isset( $this->params['breadcrumbs'] ) ? $this->params['breadcrumbs'] : [[
                    'label' => '',
                    'url' => ['site/index'],
                    'template' => "<li><b>{link}</b></li>\n", // template for this link only
                ]]
            ] ) ?>

        </header>
        <div id="content" class="padding-20">


            <div class="panel-body">

                <div class="row">
                    <?php $this->render( '/layouts/alert' ) ?>
                    <!-- LEFT -->
                    <div class="col-md-12">

                        <?= $content ?>


                    </div>
                </div>
                <!-- END RIGHT -->
            </div>

        </div>

    </section>
    <!-- END MIDDLE -->

</div>

<script type="text/javascript">var plugin_path = "<?=Yii::getAlias( "@web/plugins/" )?>";</script>
<script type="text/javascript">var epro_path = "<?=Yii::getAlias( "@web" )?>";</script>
<?php $this->registerJsFile( Yii::getAlias( "@web/web_eproject/js/app.js" ));?>
<?php $this->registerJsFile( Yii::getAlias( "@web/web_eproject/js/sweetalert.min.js" ));?>
<?php $this->registerCssFile(Yii::getAlias( "@web/web_eproject/css/app.css" ));?>
<?php $this->endBody() ?>
<!-- JAVASCRIPT FILES -->

</body>
</html>
<?php $this->endPage() ?>
