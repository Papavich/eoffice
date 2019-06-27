<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 17/9/2560
 * Time: 14:08
 */

namespace app\modules\eproject\components;

use app\modules\eproject\models\Enroll;
use app\modules\eproject\models\OpenSubject;
use app\modules\eproject\models\Subject;
use app\modules\eproject\models\Year;
use app\modules\eproject\models\YearSemester;
use Mpdf\Tag\Sub;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class ModelHelper
{
    public static function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'crtime',
                'updatedAtAttribute' => 'udtime',
                'value' => new Expression( 'NOW()' ),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'crby',
                'updatedByAttribute' => 'udby',
            ],
        ];
    }

//    public static function create($model)
//    {
//        $model->crby = Yii::$app->user->identity->getId();
//        $model->udby = Yii::$app->user->identity->getId();
//        $model->crtime = date( 'Y-m-d H:i:s' );
//        $model->udtime = date( 'Y-m-d H:i:s' );
//        return $model;
//    }
//
//    public static function update($model)
//    {
//        $model->udby = Yii::$app->user->identity->getId();
//        $model->udtime = date( 'Y-m-d H:i:s' );
//        return $model;
//    }

    public static function getNowSubject($studentId = true)
    {
        if ($studentId === true) {
            $studentId = Yii::$app->user->identity->getId();
        }
        $subjects = Subject::find()->select( 'id' );
        if ($enroll = Enroll::find()->where( ['year_id' => self::getNowYear()] )
            ->andWhere( ['semester_id' => self::getNowSemester()] )
            ->andWhere( ['student_id' => $studentId] )
            ->andWhere( ['in', 'subject_id', $subjects] )
            ->one()->subject_id) {
            return $enroll;
        } else {
            return false;
        }
    }

    public static function getNowYear()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        if (isset( $_SESSION['epro_year'] )) {
            return $_SESSION['epro_year'];
        } else {
            $year = Year::find()->orderBy( ['id' => SORT_DESC] )->one()->id;
            $session->set( 'epro_year', $year );
            return $year;
        }

    }

    public static function clearYearSemester()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        if (isset( $_SESSION['epro_year'] )) {
            $session->remove('epro_year');
        }
        if (isset( $_SESSION['epro_semester'] )) {
            $session->remove('epro_semester');
        }
        return 0;
    }

    public static function getNowSemester()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        if (isset( $_SESSION['epro_semester'] )) {
            return $_SESSION['epro_semester'];
        } else {
            $semester = YearSemester::find()->orderBy( ['year_id' => SORT_DESC, 'semester_id' => SORT_DESC] )->one()->semester_id;
            $session->set( 'epro_semester', $semester );
            return $semester;
        }
    }

    public static function getRecentlyYearSemester()
    {
        return YearSemester::find()->orderBy( ['year_id' => SORT_DESC, 'semester_id' => SORT_DESC] )->all()[1];
    }

    public static function getSubjectId($studentId = null)
    {
        $subjects = Subject::find()->select( 'id' );
        if ($studentId == null) {
            $enroll = Enroll::find()->where( ['student_id' => Yii::$app->user->identity->getId()] )
                ->andWhere( ['year_id' => self::getNowYear()] )
                ->andWhere( ['semester_id' => self::getNowSemester()] )
                ->andWhere( ['in', 'subject_id', $subjects] )
                ->one();
        } else {
            $enroll = Enroll::find()->where( ['student_id' => $studentId] )
                ->andWhere( ['year_id' => self::getNowYear()] )
                ->andWhere( ['semester_id' => self::getNowSemester()] )
                ->andWhere( ['in', 'subject_id', $subjects] )
                ->one();
        }

        if ($enroll) {
            return $enroll->subject_id;
        } else {
            return false;
        }
    }
}