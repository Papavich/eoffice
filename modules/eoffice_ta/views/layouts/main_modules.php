<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\Breadcrumbs;
use app\modules\eoffice_ta\controllers;
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;
use yii\widgets\Menu;
use app\modules\personsystem\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\Json;
use app\modules\personsystem\controllers\FunctionController;



AppAsset::register($this);

$title = controllers::t( 'label', 'TA SYSTEM' );
$MainPage = controllers::t( 'label', 'Home Page' );
?>

<?php $this->beginPage() ?>
    <!doctype html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode( $this->title ) ?></title>
        <meta name="description" content="" />
        <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />

        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <style>
            .line {
                border-bottom: solid 1px;
            }
        </style>

        <!-- WEB FONTS -->
        <?php $this->head() ?>
    </head>

    <body >
    <?php $this->beginBody() ?>
    <?php // $function = new \app\components\MyManager(); ?>
    <!-- WRAPPER -->
    <div id="wrapper" class="clearfix">
        <aside id="aside">
            <?php /* Menu::widget( [
                'items' => [
                    ['label' => '<i class="main-icon glyphicon glyphicon-log-out"></i> <span>' . controllers::t( 'menu', 'Back To Main System' )
                        . '</span>', 'url' => ['site/index'] ],
                ],
                'encodeLabels' => false,
                'activateParents' => true,
                'options' => [
                    'class' => 'nav nav-list',
                ]
            ] );
 */
            ?>
            <nav id="sideNav"><!-- MAIN MENU -->
                <?php $function = new \app\components\MyManager(); ?>
                <ul class="nav nav-list">

                    <?php $fakedModel = (object)['title'=> 'A Product', 'image' => 'http://placehold.it/350x150']; ?>
                    <?= \app\components\Mywidget::widget(['model' => $fakedModel]); ?>
                    <h3><?php //echo controllers::t( 'menu', 'Main System' ) ?></h3>

                    <?php
                    /*
                    echo  Menu::widget( [
                        'items' => [
                            ['label' => '<i class="main-icon glyphicon glyphicon-log-out"></i> <span>' . controllers::t( 'menu', 'Back To Main System' )
                                . '</span>', 'url' => ['/']],
                        ],
                        'encodeLabels' => false,
                        'activateParents' => true,
                        'options' => [
                            'class' => 'nav nav-list',
                        ]
                    ] );
                    */
                    ?>
            </nav>
            <span id="asidebg"><!-- aside fixed background --></span>
        </aside>
        <header id="header">
            <button id="mobileMenuBtn"></button>
            <span class="logo pull-left">
					<img src="<?= Yii::getAlias('@web') ?>/web_ta/images/logo_ta1.png" alt="admin panel" height="35" />
				</span>
            <nav>
                <ul class="nav pull-right">
                    <li class="dropdown pull-left">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img class="user-avatar" alt="" src="<?= Yii::getAlias('@web') ?>/images/noavatar.jpg" height="34" />
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
                                if (Json::encode(\Yii::$app->authManager->isAdmin()) == 'true') { ?>
                                    <li>
                                        <a href="<?= Yii::getAlias('@web') ?>/admin/user"> Admin</a>
                                    </li>
                                <?php } else {} ?>
                                <li>
                                    <?php $modelUser = User::findOne(Yii::$app->user->identity->id);
                                    if($modelUser->type!=null){
                                        if($modelUser->type == 1){
                                            $modelUser->type = "teacher";
                                        }else if($modelUser->type == 2){
                                            $modelUser->type = "staff";
                                        }else if($modelUser->type == 0){
                                            $modelUser->type = "student";
                                        }else{
                                            $modelUser->type = "guest";
                                        }
                                    }
                                    ?>
                                    <a href="<?= Yii::getAlias('@web') ?>/personsystem/profile/<?= $modelUser->type ?>">Profile</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <?php $form = ActiveForm::begin(['action' => Yii::getAlias('@web').'/site/logout',
                                        'options' => [
                                            'class' => 'userform'
                                        ],'method' => 'post']); ?>
                                    <?= Html::csrfMetaTags();?>
                                    <?= Html::submitButton(Yii::t('app', 'Log Out'), ['class' => 'btn btn-link']) ?>
                                    <?php  ActiveForm::end(); ?>
                                </li>
                            <?php }?>
                        </ul>
                    </li>
                </ul>
                </li>
                </ul>
                </li>
                </ul>
            </nav>
            <div class="pull-right" style="padding-top: 4px">
                <?= Html::a( '<img src="' . Yii::$app->homeUrl . 'images/th.png" height="14"/>', ['language/change?lang=th'] ) ?>
                <br>
                <?= Html::a( '<img src="' . Yii::$app->homeUrl . 'images/en.png" height="14"/>', ['language/change?lang=en'] ) ?> </div>
        </header>
        <section id="middle">
            <!-- page title -->
            <header id="page-header">
                <h1><?= Html::encode( $this->title ) ?></h1>
                <ol class="breadcrumb">
                    <li> <?= Breadcrumbs::widget([
                            'homeLink' => [ 'label' => $MainPage,'url' => ['site/index'] ] ,
                            'links' => isset( $this->params['breadcrumbs'] ) ? $this->params['breadcrumbs'] : [[
                                'label' => '',
                                'url' => ['site/index'],
                                'template' => "<li><b>{link}</b></li>\n", // template for this link only
                            ]]
                        ] ) ?>
                    </li>

                </ol>

            </header>
            <!-- /page title -->
            <div id="content" class="padding-3">

                <?= $content ?>

            </div>
        </section>
    </div>
    <footer class="footer">
        <div class="container">
            <p class="pull-right">&copy; My Company <?= date('Y') ?></p>

        </div>
    </footer>

    <!-- JAVASCRIPT FILES -->
    <script type="text/javascript">var plugin_path = "<?=Yii::getAlias( "@web" )?>/plugins/";</script>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>