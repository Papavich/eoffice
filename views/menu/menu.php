<?php
/**
 * Created by PhpStorm.
 * User: comsc
 * Date: 7/9/2017 AD
 * Time: 1:52 PM
 */

use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)
]);

echo '';