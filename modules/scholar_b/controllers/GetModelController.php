<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 26/2/2561
 * Time: 21:51
 */

namespace app\modules\scholar_b\controllers;


use app\modules\pms\models\Year;
use app\modules\scholar_b\controllers;
use app\modules\scholar_b\models\model_main\EofficeCentralViewPisPerson;
use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;
use app\modules\scholar_b\models\model_main\RegSysbytedes;
use app\modules\scholar_b\models\ScbActivityMain;
use app\modules\scholar_b\models\ScbActivityType;
use app\modules\scholar_b\models\ScbPortfolioType;
use app\modules\scholar_b\models\ScbProject;
use app\modules\scholar_b\models\ScbScholarshipType;
use app\modules\scholar_b\models\ScbStudent;
use app\modules\scholar_b\models\ScbStudentHasActivityMain;
use app\modules\scholar_b\models\ScbStudentHasProject;
use app\modules\scholar_b\models\ScbTeacher;
use app\modules\scholar_b\models\ScbTeacherType;
use app\modules\scholar_b\models\ScbYear;
use app\modules\scholar_b\models\ScbSemester;
use app\modules\scholar_b\models\ScbYearHasSemester;
use yii\helpers\ArrayHelper;

class GetModelController
{
    const CS = 1;
    const IT = 2;
    const GIS = 3;

    public static function itemsAlias($key)
    {

        $items = [
            'branch' => [
                self::CS => 'วิทยาการคอมพิวเตอร์',
                self::IT => 'เทคโนโลยีสารสนเทศศาสตร์',
                self::GIS => 'ภูมิสารสนเทศศาสตร์'
            ],
        ];
        return ArrayHelper::getValue($items, $key, []);
        //return array_key_exists($key, $items) ? $items[$key] : [];
    }

    public function getItemBranch()
    {
        return self::itemsAlias('branch');
    }


    public static function getYear()
    {
        $modelYear = ScbYear::find()->all();
        $item = ArrayHelper::map($modelYear, 'year', 'year');
        return $item;
    }

    public static function getSemester()
    {
        $modelSemester = ScbSemester::find()->all();
        $item = ArrayHelper::map($modelSemester, 'semester', 'semester');
        return $item;
    }

    public static function getActivitytype()
    {
        $modelActtype = ScbActivityType::find()->all();
        $item = ArrayHelper::map($modelActtype, 'act_type_id', 'act_type_name');
        return $item;
    }

    public static function getActivitymain()
    {
        $modelActmain = ScbActivityMain::find()->all();
        $item = ArrayHelper::map($modelActmain, 'act_main_id', 'act_main_name');
        return $item;
    }

    public static function getActivitymainyear()
    {
        $modelActmain = ScbActivityMain::find()->all();
        $item = ArrayHelper::map($modelActmain, 'act_main_id', 'year');
        return $item;
    }

    public static function getTeacherType()
    {
        $modelTeacherType = ScbTeacherType::find()->all();
        $item = ArrayHelper::map($modelTeacherType, 'type_id', 'type_name');
        return $item;
    }

    public static function getStudent()
    {
        $modelStudent = ScbStudent::find()
            ->where(['status_advisor' => null])
            ->all();
        $item = ArrayHelper::map($modelStudent, 'student_id', 'student_id');
        return $item;
    }

    public static function getTeacher()
    {
        $modelTeacher = ScbTeacher::find()->all();
        $item = ArrayHelper::map($modelTeacher, 'id_card', 'id_card');
        return $item;
    }

    public static function getPortType()
    {
        $modelPorttype = ScbPortfolioType::find()->all();
        $item = ArrayHelper::map($modelPorttype, 'type_id', 'type_name');
        return $item;
    }

    public static function getProject()
    {
        $modelProject = ScbProject::find()->all();
        $item = ArrayHelper::map($modelProject, 'project_code', 'project_name');
        return $item;
    }

    public static function getScholarship()
    {
        $modelScholarship = ScbScholarshipType::find()->all();
        $item = ArrayHelper::map($modelScholarship, 'scholarship_id', 'sholarship_name');
        return $item;
    }

    public static function getFindStudentStatus($id)
    {
        $modelStudentStatus = RegSysbytedes::find()->where(['BYTECODE' => $id])->andWhere(['TABLENAME' => "STUDENTSTATUS", 'COLUMNNAME' => "STUDENTSTATUS"])->one();
        return $modelStudentStatus->BYTEDES;
    }
}