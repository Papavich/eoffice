<?php
use app\assets\AppAsset2;
use yii\widgets\Menu;
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\helpers\Html;
$userType =0;
use app\modules\eoffice_asset\assets\AppAssetAsset;
AppAssetAsset::register($this);
//AppAsset2::register($this);
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
        <style>
            .line {
                border-bottom: solid 1px;
            }
        </style>

        <!-- WEB FONTS -->
        <?php $this->head() ?>
    </head>

    <?php $this->beginBody() ?>
    <?php // $function = new \app\components\MyManager(); ?>
    <!-- WRAPPER -->
    <div id="wrapper" class="clearfix">
        <aside id="aside">

            <nav id="sideNav"><!-- MAIN MENU -->
                <?php $function = new \app\components\MyManager(); ?>
                <ul class="nav nav-list">
                    <?php $fakedModel = (object)['title'=> 'A Product', 'image' => 'http://placehold.it/350x150']; ?>
                    <?= \app\components\Mywidget::widget(['model' => $fakedModel]); ?>
            </nav>

            <span id="asidebg"><!-- aside fixed background --></span>
        </aside>

        <header id="header">

            <button id="mobileMenuBtn"></button>
            <span class="logo pull-left">
                <?php echo Html::img('@web/web_asset/images/asset_logo.png') ;
                ?>
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
                </li>
                </ul>
            </nav>
        </header>
        <section id="middle">
            <?= $content ?>


        </section>
    </div>

        <div class="modal" tabindex="-1" role="dialog" id="modalborrow">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php $this->endBody() ?>
    <script>
        function addBorrow(id) {
          $('#modalborrow').modal();
        }
    </script>


    </html>
<?php $this->endPage() ?>