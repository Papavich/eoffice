<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 26/10/2560
 * Time: 17:21
 */

namespace app\modules\eproject\components;


use Yii;

class AuthHelper
{
    const TYPE_ADMIN = 0;
    const TYPE_TEACHER = 1;
    const TYPE_STUDENT = 2;
    const TYPE_GUEST = 3;
    public static function getUserType(){
        if(!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can( 'Permit_Eproject_Admin' )) {
                $userType = self::TYPE_ADMIN;
            } else if (Yii::$app->user->can( 'Permit_EProject_Student' )) {
                $userType = self::TYPE_STUDENT;
            } else if (Yii::$app->user->can( 'Permit_EProject_Teacher' )) {
                $userType = self::TYPE_TEACHER;
            } else {
                $userType = self::TYPE_GUEST;
            }
        }else {
            $userType = self::TYPE_GUEST;
        }
        return $userType;
    }
    public static function isStudent(){
        if (Yii::$app->user->can( 'Permit_EProject_Student' )) {
            return true;
        }else{
            return false;
        }
    }
    public static function isTeacher(){
        if (Yii::$app->user->can( 'Permit_EProject_Teacher' )) {
            return true;
        }else{
            return false;
        }
    }
    public static function isAdmin(){
        if (Yii::$app->user->can( 'Permit_Eproject_Admin' )) {
            return true;
        }else{
            return false;
        }
    }
}