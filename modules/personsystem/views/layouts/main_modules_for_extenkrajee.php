<?php
use app\assets\AppAsset2;
use yii\widgets\Menu;
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;
use app\modules\personsystem\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Json;
use app\modules\personsystem\controllers\FunctionController;
use app\modules\personsystem\assets;
$userType =0;
//AppAsset2::register($this);
assets\AppAssetPerson3::register($this);
$this->beginPage() ?>

<?php $this->beginPage() ?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

    <title></title>
    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<style>
    .line {
        border-bottom: solid 1px;
        border-color: #e8e8e8;
    }
</style>
    <!-- WEB FONTS -->
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php // $function = new \app\components\MyManager(); ?>
<!-- WRAPPER -->
<div id="wrapper" class="clearfix">
    <aside id="aside">
        <nav id="sideNav"><!-- MAIN MENU -->
            <?php $function = new \app\components\MyManager(); ?>
            <ul class="nav nav-list">
                <?php $fakedModel = (object)['title'=> 'A Product', 'image' => '']; ?>
                <?= \app\components\Mywidget::widget(['model' => $fakedModel]); ?>
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
                                    <a href="<?= Yii::getAlias('@web') ?>/admin/user"> Admin(mdmsoft)</a>
                                </li>
                                <li>
                                    <a href="<?= Yii::getAlias('@web') ?>/user/admin/index"> Admin(rbac)</a>
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
        </nav>
        <div class="pull-right" style="padding-top: 4px">
            <?= \yii\helpers\Html::a('<img src="'. Yii::$app->homeUrl .'images/th.png" height="14"/>', ['language/change?lang=th']) ?><br>
            <?= \yii\helpers\Html::a('<img src="'. Yii::$app->homeUrl .'images/en.png" height="14"/>', ['language/change?lang=en']) ?>
        </div>
    </header>
    <section id="middle">

        <?= $content ?>
    </section>
</div>

<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = '<?= Yii::getAlias('@web') ?>/plugins/';</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>