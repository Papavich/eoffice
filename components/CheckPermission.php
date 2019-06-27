<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/12/2017
 * Time: 12:50 PM
 */
namespace app\components;
use Yii;

class CheckPermission
{
static function check($String){
    foreach (Yii::$app->getAuthManager()->getPermissionsByUserAndModule(Yii::$app->user->identity->id,"eproject") as $name => $value) {
        if($String==$name ){
        return "ture";
        }
    }
    return "false";
}
}