<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\modules\correspondence\controllers;
app\assets\AppAsset::register($this);

\app\modules\correspondence\assets\AppAsset2::register($this);
$userType = 0;
//0 admin
//1 teachers
//2 student
//3 guest

$this->registerCss("
/*Clearing Floats*/
.cf:before, .cf:after {
    content:\"\";
    display:table;
}

.cf:after {
    clear:both;
}

.cf {
    zoom:1;
}    
/* Form wrapper styling */
.form-wrapper {
    width: 450px;
    padding: 15px;
    margin: 150px auto 50px auto;
    background: #444;
    background: rgba(0,0,0,.2);
    border-radius: 10px;
    box-shadow: 0 1px 1px rgba(0,0,0,.4) inset, 0 1px 0 rgba(255,255,255,.2);
}

/* Form text input */

.form-wrapper input {
    width: 330px;
    height: 20px;
    padding: 10px 5px;
    float: left;   
    font: bold 15px 'lucida sans', 'trebuchet MS', 'Tahoma';
    border: 0;
    background: #eee;
    border-radius: 3px 0 0 3px;     
}
");
?>
<?php $this->beginPage() ?>
    <!doctype html>
    <html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />

        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <!-- WRAPPER -->
    <div id="wrapper" class="clearfix">
        <aside id="aside">

            <nav id="sideNav"><!-- MAIN MENU -->
                <?php $function = new \app\components\MyManager(); ?>
                <ul class="nav nav-list">

                    <?php $fakedModel = (object)['title'=> 'A Product', 'image' => 'http://placehold.it/350x150']; ?>
                    <?= \app\components\Mywidget::widget(['model' => $fakedModel]); ?>
                </ul>
            </nav>

            <span id="asidebg"><!-- aside fixed background --></span>
        </aside>

        <header id="header">


            <button id="mobileMenuBtn"></button>

            <span class="logo pull-left">
					<img src="<?= Yii::getAlias('@web/../modules/correspondence/style/images') ?>/logo.png" alt="admin panel" height="40" />
				</span>

            <form method="get" action="page-search.html" class="search pull-left hidden-xs">
                <input type="text" class="form-control" name="k" placeholder="Search for something..." />
            </form>

            <nav>

                <ul class="nav pull-right">
                    <li class="dropdown pull-left">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img class="user-avatar" alt="" src="<?= Yii::getAlias('@web') ?>/images/noavatar.jpg" height="34" />
                            <span class="user-name">
									<span class="hidden-xs">
										 <?php
                                         /*if( !Yii::$app->user->isGuest) {
                                             if (Yii::$app->user->identity->username == 'admin') {
                                                 print('Account('.Yii::$app->user->identity->username.')');
                                             } else {
                                                 print('Account('.Yii::$app->user->identity->username.')');
                                             }
                                         }else{
                                             print "ยังไม่ได้เข้าสู่ระบบ";
                                         }*/
                                         if( !Yii::$app->user->isGuest) {
                                             if (\yii\helpers\Json::encode(\Yii::$app->authManager->isAdmin()) == 'true') {
                                                 print('Account( '.controllers::getNameuser(Yii::$app->user->identity->id).' )');
                                             } else {
                                                 print('Account( '.controllers::getNameuser(Yii::$app->user->identity->id).' )');
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
                                    ?>
                                    <li>
                                        <a href="<?= Yii::getAlias('@web') ?>/admin/user"> Admin</a>
                                    </li>
                                    <?php
                                } else {
                                }
                                ?>

                                <li>
                                    <a href="<?= Yii::getAlias('@web') ?>/personsystem/site/profileuser">Profile</a>
                                </li>
                                <li class="divider"></li>
                                <form action="<?= Yii::getAlias('@web') ?>/site/logout" method="post">
                                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                                    <button type="submit" class="btn btn-link logout" >Log Out</button>
                                </form>
                            <?php }?>


                        </ul>
                    </li>
                </ul>
            </nav>
            <?php Pjax::begin(["id"=>"mail-progress-container"]); ?>
            <div class="pull-right">
                <!-- Bottom Right -->
                <div id="toast-container" class="toast-bottom-right" aria-live="polite" role="alert"  style="display: none">
                    <div class="toast toast-primary" style="display: block;">
                        <div class="toast-progress" style="width: 58.14%;"></div>
                        <div class="toast-message">Bottom Right Notification</div>
                    </div>
                </div>
            </div>
            <?php Pjax::end() ?>
        </header>
        <?= $content ?>
    </div>

    <!-- JAVASCRIPT FILES -->
    <script type="text/javascript">var plugin_path = '<?= Yii::getAlias('@web') ?>/plugins/';</script>
    <script>
        const titleSwal = "<?=controllers::t('menu','Do you want to delete it?')?>";
        const textSwal = "<?=controllers::t('menu','You can not recover if you confirm.')?>";
        const buttonCancelSwal = "<?=controllers::t('menu','No I do not want')?>";
        const buttonConfirmSwal = "<?=controllers::t('menu','Yes I need' )?>";
        const successSwal = "<?=controllers::t('menu','Done' )?>";

    </script>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>