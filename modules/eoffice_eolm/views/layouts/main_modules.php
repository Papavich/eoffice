<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\modules\eoffice_eolm\components\AuthHelper;
use app\modules\eoffice_eolm\controllers;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\modules\eoffice_eolm\assets;
use app\modules\personsystem\models\User;
use yii\helpers\Json;
use app\modules\personsystem\controllers\FunctionController;

$userType = AuthHelper::getUserType();
assets\AppAsset::register( $this );
assets\AppAssetEolm::register($this);

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
                ['label' => '<i class="fa fa-menu-arrow pull-right"></i><i class="main-icon fa fa-pencil-square-o"></i> <span>' . controllers::t( 'menu', 'Travel request' ) . '</span>',
                    'template' => '<a href="#">{label}</a>',
                    'url' => ['#'], 'visible' => $userType == AuthHelper::TYPE_ADMIN, 'items' => [
                    ['label' => controllers::t( 'menu', 'Create a travel request' ), 'url' => ['approvalformsf/create']],
                    ['label' => controllers::t( 'menu', 'Create a Loan' ), 'url' => ['approvalformsf/approvalsearch']],

                ]],
                ['label' => '<i class="fa fa-menu-arrow pull-right"></i><i class="main-icon fa fa-pencil-square-o"></i> <span>' . controllers::t( 'menu', 'Travel request' ) . '</span>',
                    'template' => '<a href="#">{label}</a>',
                    'url' => ['#'], 'visible' => $userType == AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS, 'items' => [
                    ['label' => controllers::t( 'menu', 'Create a travel request' ), 'url' => ['approvalformaj/create']],
                    ['label' => controllers::t( 'menu', 'Create a Loan' ), 'url' => ['approvalformaj/approvalajsearch']],

                ]],
                ['label' => '<i class="fa fa-menu-arrow pull-right"></i><i class="main-icon fa fa-money"></i> <span>' . controllers::t( 'menu', 'Disbursement form' ) . '</span>',
                    'template' => '<a href="#">{label}</a>',
                    'url' => ['#'], 'visible' => $userType == AuthHelper::TYPE_ADMIN, 'items' => [
                    ['label' => controllers::t( 'menu', 'Create a Disbursement form' ), 'url' => ['disbursementform/approvalsearch']],
                    ['label' => controllers::t( 'menu', 'Create receipt for student' ), 'url' => ['receiptstudent/approvalsearch']],
                    ['label' => controllers::t( 'menu', 'Create details for accommodation' ), 'url' => ['receipthotel/approvalsearch']],
                    ['label' => controllers::t( 'menu', 'Create a accommodation' ), 'url' => ['hotel/index']],

                ]],
                ['label' => '<i class="fa fa-menu-arrow pull-right"></i><i class="main-icon fa fa-money"></i> <span>' . controllers::t( 'menu', 'Disbursement form' ) . '</span>',
                    'template' => '<a href="#">{label}</a>',
                    'url' => ['#'], 'visible' => $userType == AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS, 'items' => [
                    ['label' => controllers::t( 'menu', 'Create a Disbursement form' ), 'url' => ['disbursementform/approvalajsearch']],
                    ['label' => controllers::t( 'menu', 'Create receipt for student' ), 'url' => ['receiptstudent/approvalajsearch']],
                    ['label' => controllers::t( 'menu', 'Create details for accommodation' ), 'url' => ['receipthotel/approvalajsearch']],
                    ['label' => controllers::t( 'menu', 'Create a accommodation' ), 'url' => ['hotel/index']],

                ]],
                ['label' => '<i class="main-icon glyphicon glyphicon-list-alt"></i> <span>' . controllers::t( 'menu', 'repay' ) . '</span>', 'url' => ['repayform/approvalsearch'], 'visible' => $userType == AuthHelper::TYPE_ADMIN],
                //['label' => '<i class="main-icon glyphicon glyphicon-list-alt"></i> <span>' . controllers::t( 'menu', 'repay' ) . '</span>', 'url' => ['repayform/approvalajsearch'], 'visible' => $userType == AuthHelper::TYPE_TEACHER],
                ['label' => '<i class="fa fa-menu-arrow pull-right"></i><i class="main-icon fa fa-file-pdf-o"></i> <span>' . controllers::t( 'menu', 'Reports and Documents' ) . '</span>',
                    'template' => '<a href="#">{label}</a>',
                    'url' => ['#'], 'visible' => $userType == AuthHelper::TYPE_ADMIN, 'items' => [
                    ['label' => controllers::t( 'menu', 'Download the document' ), 'url' => ['approvalformsf/document']],
                    ['label' => controllers::t( 'menu', 'Reports' ), 'url' => ['approvalformsf/report']],

                ]],
                ['label' => '<i class="main-icon fa fa-sticky-note"></i> <span>' . controllers::t( 'menu', 'Check a document' ) . '</span>', 'url' => ['approvalformsf/index'],
                    'visible' => $userType == AuthHelper::TYPE_ADMIN],
                ['label' => '<i class="main-icon fa fa-sticky-note"></i> <span>' . controllers::t( 'menu', 'Check a document' ) . '</span>', 'url' => ['approvalformaj/index'],
                    'visible' => $userType == AuthHelper::TYPE_TEACHER],
                ['label' => '<i class="fa fa-menu-arrow pull-right"></i><i class="main-icon fa fa-sticky-note"></i> <span>' . controllers::t( 'menu', 'Check a document' ) . '</span>',
                    'template' => '<a href="#">{label}</a>',
                    'url' => ['#'], 'visible' => $userType == AuthHelper::TYPE_APPROVERS, 'items' => [
                    ['label' => controllers::t( 'menu', 'Check a document' ), 'url' => ['approvalformaj/index']],
                    ['label' => controllers::t( 'menu', 'Consider approval' ), 'url' => ['approvalformaj/index2']],

                ]],

            ],
            'encodeLabels' => false,
            'activateParents' => true,
            'options' => [
                'class' => 'nav nav-list',
            ]
        ] );
        ?>
        <!-- END USER MENU -->

        <?php

        ?>
        <h3><?= controllers::t( 'menu', 'MORE' ) ?></h3>
        <?php
        echo Menu::widget( [
            'items' => [
                ['label' => '<i class="main-icon glyphicon glyphicon-cog"></i> <span>' . controllers::t( 'menu', 'Setting' ) . '</span>', 'url' => ['setting/index'],
                    'visible' => $userType == AuthHelper::TYPE_ADMIN ],
                ['label' => '<i class="main-icon glyphicon glyphicon-book"></i> <span>' . controllers::t( 'menu', 'User manual' ) . '</span>', 'url' => ['setting/download?url=web_eolm/files/Progress2_ICT3_Manual.pdf']],
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
        <span class="logo pull-left" style="font-size:x-large;color: #ffffff;">
            E-OLM
            <!--<img src="/images/logo_light.png" alt="admin panel" height="35"/>-->
        </span>
        <!-- SEARCH -->
        <form method="get" action="page-search.html" class="search pull-left hidden-xs">
            <input type="text" class="form-control" name="k" placeholder="Search for something..."/>
        </form>
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

                                         if( !Yii::$app->user->isGuest) {
                                             if (Json::encode(\Yii::$app->authManager->isAdmin()) == 'true') {
                                                 print('Account( '.FunctionController::getNameuser(Yii::$app->user->identity->id).' )');
                                             } else {
                                                 print('Account( '.FunctionController::getNameuser(Yii::$app->user->identity->id).' )');
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
                            <form action="<?= Yii::getAlias('@web') ?>/site/logout" method="post">
                                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                                <button type="submit" class="btn btn-link logout" >Log Out</button>
                            </form>
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
            <?php if (Yii::$app->session->hasFlash( 'alert' )): ?>
                <?= \yii\bootstrap\Alert::widget( [
                    'body' => ArrayHelper::getValue( Yii::$app->session->getFlash( 'alert' ), 'body' ),
                    'options' => ArrayHelper::getValue( Yii::$app->session->getFlash( 'alert' ), 'options' ),
                ] ) ?>
            <?php endif; ?>
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

<script type="text/javascript">var plugin_path = "<?=Yii::getAlias( "@web" )?>/plugins/";</script>
<?php $this->endBody() ?>
<!-- JAVASCRIPT FILES -->

</body>
</html>
<?php $this->endPage() ?>
