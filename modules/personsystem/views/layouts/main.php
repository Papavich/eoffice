<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

\app\modules\personsystem\assets\AppAssetPerson2::register($this);
list(,$url) = Yii::$app->assetManager->publish('@mdm/admin/assets');
$this->registerCssFile($url.'/main.css');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body style="background: white">
        <?php $this->beginBody() ?>
        <nav id="w1" class="navbar-inverse navbar-fixed-top navbar"><div class="container"><div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w1-collapse"><span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span></button></div><div id="w1-collapse" class="collapse navbar-collapse"><ul id="w2" class="nav navbar-nav navbar-right">
                        <li><a href="<?= Yii::getAlias('@web').'/admin/default/index' ?>">ช่วยเหลือ</a></li>
                        <li><a href="<?= Yii::getAlias('@web').'/site/index' ?>">แอพพลิเคชั่น</a></li></ul></div></div></nav>
            <?= $content ?>
        </div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
