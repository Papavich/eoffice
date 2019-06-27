<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 28/2/2561
 * Time: 22:47
 */

namespace app\modules\pfc\components;

use Yii;

class AuthHelper
{
    const TYPE_Staff = 3;
    const TYPE_Teacher = 1;  // อาจารย์ที่ปรึกษาทุน
    const TYPE_Student = 2;
    const TYPE_Admin = 4; // อาจารย์ที่ปรึกษาโปรเจค
    const TYPE_Committee = 5; // กรรมการทุน
    const TYPE_Guest = 6;
    const TYPE_SubAdvisor = 7; // อาจารย์ที่ปรึกษาโปรเจครอง


    public static function getUserType()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('Permit_PFC_staff')) {
                $userType = self::TYPE_Staff;
            } else if (Yii::$app->user->can('Permit_PFC_student')) {
                $userType = self::TYPE_Student;
            } else if (Yii::$app->user->can('Permit_PFC_teacher')) {
                $userType = self::TYPE_Teacher;
            } else if (Yii::$app->user->can('Permit_scb_Committee')) {
                $userType = self::TYPE_Admin;
            } else if (Yii::$app->user->can('Permit_scb_SubAdvisor')) {
                $userType = self::TYPE_SubAdvisor;
            } else {
                $userType = self::TYPE_Guest;
            }
        } else {
            $userType = self::TYPE_Guest;
        }
        return $userType;
    }

    public static function isStudent()
    {
        if (Yii::$app->user->can('Permit_PFC_student')) {
            return true;
        } else {
            return false;
        }
    }

    public static function isTeacher()
    {
        if (Yii::$app->user->can('Permit_PFC_teacher')) {
            return true;
        } else {
            return false;
        }
    }

    public static function isCommittee()
    {
        if (Yii::$app->user->can('Permit_scb_Committee')) {
            return true;
        } else {
            return false;
        }
    }

    public static function isAdvisor()
    {
        if (Yii::$app->user->can('Permit_scb_Advisor')) {
            return true;
        } else {
            return false;
        }
    }

    public static function isSubAdvisor()
    {
        if (Yii::$app->user->can('Permit_scb_SubAdvisor')) {
            return true;
        } else {
            return false;
        }
    }

    public static function isStaff()
    {
        if (Yii::$app->user->can('Permit_PFC_staff')) {
            return true;
        } else {
            return false;
        }
    }
}