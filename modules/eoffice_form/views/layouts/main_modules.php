<?php
use app\assets\AppAsset2;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
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
    <title>ระบบคำร้องออนไลน์</title>
    <meta name="description" content="" />
    <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />
    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    <style>
        .line {
            border-bottom: solid 1px;
        }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- WEB FONTS -->
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
               <img src="<?= Yii::getAlias('@web') ?>/images/logo_light.png" alt="admin panel" height="35" />
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
<!--            </li>-->
<!--            </ul>-->
        </nav>

    </header>

    <section id="middle">
        <div id="content" class="dashboard padding-20">
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
            <?= $content ?>
        </div>
    </section>

</div>

<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = '<?= Yii::getAlias('@web') ?>/plugins/';</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
