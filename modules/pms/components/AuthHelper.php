<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 26/10/2560
 * Time: 17:21
 */

namespace app\modules\pms\components;


use Yii;

class AuthHelper
{
    const TYPE_RESPONSIBLE = 0;
    const TYPE_STAFF = 1;
    const TYPE_MANAGER = 2;
    const TYPE_PLANNER = 3;
    const TYPE_FINANCE = 4;
    const TYPE_Guest = 5;
    public static function getUserType(){
        if(!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can( 'Permit_Pms_Responsible' )) {
                $userType = self::TYPE_RESPONSIBLE;
            } else if (Yii::$app->user->can( 'Permit_Pms_Staff' )) {
                $userType = self::TYPE_STAFF;
            } else if (Yii::$app->user->can( 'Permit_Pms_Manager' )) {
                $userType = self::TYPE_MANAGER;
            }else if (Yii::$app->user->can( 'Permit_Pms_Planner' )) {
                $userType = self::TYPE_PLANNER;
            }else if (Yii::$app->user->can( 'Permit_Pms_Finance' )) {
                $userType = self::TYPE_FINANCE;
            } else {
                $userType = self::TYPE_Guest;
            }
        }else {
            $userType = self::TYPE_Guest;
        }
        return $userType;
    }
    public static function isResponsible(){
        if (Yii::$app->user->can( 'Permit_Pms_Responsible' )) {
            return true;
        }else{
            return false;
        }
    }
    public static function isStaff(){
        if (Yii::$app->user->can( 'Permit_Pms_Staff' )) {
            return true;
        }else{
            return false;
        }
    }
    public static function isManager(){
        if (Yii::$app->user->can( 'Permit_Pms_Manager' )) {
            return true;
        }else{
            return false;
        }
    }
    public static function isPlanner(){
        if (Yii::$app->user->can( 'Permit_Pms_Planner' )) {
            return true;
        }else{
            return false;
        }
    }
    public static function isFinance(){
        if (Yii::$app->user->can( 'Permit_Pms_Finance' )) {
            return true;
        }else{
            return false;
        }
    }

}