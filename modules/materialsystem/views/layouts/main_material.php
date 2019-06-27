<?php

use app\assets\AssetTheme;
use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ระบบจัดการวัสดุModule</title>
    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>
    <?= Html::csrfMetaTags() ?>
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <?php $this->head() ?>
    <script src="<?= Yii::getAlias('@web') ?>/plugins/jquery/jquery-2.1.4.min.js"></script>
    <script src="<?= Yii::getAlias('@web') ?>/web_mat/js/chart.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
<div id="wrapper" class="clearfix">
    <!-- ASIDE -->
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
        <!-- ================================ คำสั่งแสดงเมนู ====================================== -->
                <nav id="sideNav"><!-- MAIN MENU -->
                    <?php $function = new \app\components\MyManager(); ?>
                    <ul class="nav nav-list">
                        <?php $fakedModel = (object)['title'=> 'A Product', 'image' => 'http://placehold.it/350x150']; ?>
                        <?= \app\components\Mywidget::widget(['model' => $fakedModel]); ?>
                </nav>
        <!-- ================================ คำสั่งแสดงเมนู ====================================== -->

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
        <!-- End Logo -->


        <nav>
            <ul class="nav pull-left cs-toppic">
                <li><h2>ระบบจัดการวัสดุ</h2></li>
            </ul>
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

                            <a href="<?= Yii::getAlias('@web') ?>/materialsystem/site/logout">Log Out</a>
                        </li>
                    </ul>
                </li>
                <!-- /USER OPTIONS -->

            </ul>
            <!-- /OPTIONS LIST -->
        </nav>
        <div class="pull-right" style="padding-top: 4px">
            <?= \yii\helpers\Html::a('<img src="'. Yii::$app->homeUrl .'images/th.png" height="14"/>', ['../language/change?lang=th']) ?><br>
            <?= \yii\helpers\Html::a('<img src="'. Yii::$app->homeUrl .'images/en.png" height="14"/>', ['../language/change?lang=en']) ?>
        </div>
    </header>
    <!-- /HEADER -->

    <!-- MIDDLE -->
    <section id="middle">
        <?= $content ?>
    </section>
    <!-- /MIDDLE -->

</div>

<?php // Alert::widget() ?>
<?php //$this->render('/layouts/alert')?>
<?=\yii2mod\alert\Alert::widget()?>

<!-- JAVASCRIPT FILES -->

<script type="text/javascript">var plugin_path = '<?= Yii::getAlias('@web') ?>/plugins/';</script>
<script type="text/javascript">var plugin_path2 = '<?= Yii::$app->homeUrl ?>/plugins/';</script>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
