<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 17/9/2560
 * Time: 14:08
 */

namespace app\modules\eoffice_ta\components;

use app\modules\eproject\models\Enroll;
use app\modules\eoffice_ta\models\Year;
use app\modules\eproject\models\YearSemester;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class ModelHelper
{
    public static function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'crtime',
                'updatedAtAttribute' => 'udtime',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'crby',
                'updatedByAttribute' => 'udby',
            ],
        ];
    }
    /**
     * @param object
     * @return object
     */



    public static function getNowSubject($studentId=true)
    {
        if ($studentId === true) {
            $studentId=Yii::$app->user->identity->getId();
        }
        if($enroll=Enroll::find()->where( ['year_id' => self::getNowYear()] )
            ->andWhere( ['semester_id' => self::getNowSemester()] )
            ->andWhere( ['student_id' => $studentId] )
            ->one()->subject_id){
            return $enroll;
        }else{
            return false;
        }
    }

    public static function getNowYear()
    {
        return Year::find()->orderBy( ['id' => SORT_DESC] )->one()->id;
    }

    public static function getNowSemester()
    {
        return  YearSemester::find()->orderBy(['year_id'=>SORT_DESC,'semester_id'=>SORT_DESC])->one()->semester_id;
    }
    public static function getRecentlyYearSemester()
    {
        return  YearSemester::find()->orderBy(['year_id'=>SORT_DESC,'semester_id'=>SORT_DESC])->all()[1];
    }

    public static function getSubjectId($studentId=null)
    {
        if($studentId==null){
            $enroll=Enroll::find()->where(['student_id'=>Yii::$app->user->identity->getId()])
                ->andWhere(['year_id'=>self::getNowYear()])
                ->andWhere(['semester_id'=>self::getNowSemester()])->one();
        }else{
            $enroll=Enroll::find()->where(['student_id'=>$studentId])
                ->andWhere(['year_id'=>self::getNowYear()])
                ->andWhere(['semester_id'=>self::getNowSemester()])->one();
        }

        if ($enroll){
            return $enroll->subject_id;
        }else{
            return false;
        }
    }
}