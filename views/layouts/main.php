<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAssetPerson;

\app\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
   // if( !Yii::$app->user->isGuest) {
      //  if (Yii::$app->user->identity->username == 'admin') {
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                   Yii::$app->user->isGuest ?
                        ['label' => 'Sign in', 'url' => ['/user/security/login']] :

                        ['label' => 'Account(' . Yii::$app->user->identity->username . ')',
                            'items' => [
                                Yii::$app->user->identity->username == 'admin' ?
                                ['label' => 'Admin', 'url' => ['/user/admin/index']] :
                                ['label' => 'Profile', 'url' => ['/user/settings/profile']],
                                ['label' => 'Account', 'url' => ['/user/settings/account']],
                                ['label' => 'Logout', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
                            ]

                        ],
                   ///user/settings/profile
                   // ['label' => 'Register', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest],

                   // Yii::$app->user->isGuest ? (
                  //  ['label' => 'Login', 'url' => ['/user/security/login']]
                  //  ) : (
                     //   '<li>'
                     //   . Html::beginForm(['/site/logout'], 'post')
                     //   . Html::submitButton(
                     //       'Log out (' . Yii::$app->user->identity->username . ')',
                     //       ['class' => 'btn btn-link logout']
                     //   )
                      //  . Html::endForm()
                    //    . '</li>'
                 //   )
                ],
            ]);
       // }
   // }

    NavBar::end();
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>


    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<script type="text/javascript">var plugin_path = '<?= Yii::getAlias('@web') ?>/plugins/';</script>
<?php $this->endBody() ?>


</body>
</html>
<?php $this->endPage() ?>
