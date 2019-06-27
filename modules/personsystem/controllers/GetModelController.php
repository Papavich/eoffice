<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/22/2018
 * Time: 3:50 PM
 */

namespace app\modules\personsystem\controllers;

use app\modules\personsystem\models\AcademicPositions;
use app\modules\personsystem\models\Amphur;
use app\modules\personsystem\models\Branch;
use app\modules\personsystem\models\District;
use app\modules\personsystem\models\Major;
use app\modules\personsystem\models\Period;
use app\modules\personsystem\models\Person;
use app\modules\personsystem\models\PositionDirectors;
use app\modules\personsystem\models\Province;
use app\modules\personsystem\models\RegDepartment;
use app\modules\personsystem\models\RegFaculty;
use app\modules\personsystem\models\RegLevel;
use app\modules\personsystem\models\RegNation;
use app\modules\personsystem\models\RegOfficer;
use app\modules\personsystem\models\RegPrefix;
use app\modules\personsystem\models\RegProgram;
use app\modules\personsystem\models\RegReligion;
use app\modules\personsystem\models\RegSchool;
use app\modules\personsystem\models\RegSysbytedes;
use app\modules\personsystem\models\Zipcode;
use yii\helpers\ArrayHelper;

class GetModelController
{
    public static function getType(){
        $modelUser = \Yii::$app->user->identity->type;
        if($modelUser == 1){
            $modelUser = "teacher";
        }else if($modelUser == 2){
            $modelUser = "staff";
        }else if($modelUser == 0){
            $modelUser = "student";
        }else{
            $modelUser = "guest";
        }
        return $modelUser;
    }
    public static function getDateThai($strDate)
    {
        if($strDate!=null){
            $strYear = date("Y",strtotime($strDate))+543;
            $strMonth= date("n",strtotime($strDate));
            $strDay= date("j",strtotime($strDate));
            $strHour= date("H",strtotime($strDate));
            $strMinute= date("i",strtotime($strDate));
            $strSeconds= date("s",strtotime($strDate));
            $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
            $strMonthThai=$strMonthCut[$strMonth];
            return "$strDay $strMonthThai $strYear";
        }else{
            return "";
        }
    }
    public static function getPerson(){
        $modelPerson = Person::find()->all();
        $item = ArrayHelper::map($modelPerson, 'person_id', 'person_name');
        return $item;
    }
    public static function getDirector(){
        $modelDirector = PositionDirectors::find()->all();
        $item = ArrayHelper::map($modelDirector, 'director_id', 'position_name');
        return $item;
    }
    public static function getPeriod(){
        $modelPeriod = Period::find()->all();
        $item = ArrayHelper::map($modelPeriod, 'period_id', 'period_describe');
        return $item;
    }
    public static function getMajor(){
        $modelMajor = Major::find()->all();
        $item = ArrayHelper::map($modelMajor, 'major_id', 'major_name');
        return $item;
    }
    public static function getProgramFilter(){
        $modelProgram = RegProgram::find()->where(['DEPARTMENTID' => ['2320','2322']])->all();
        $item = ArrayHelper::map($modelProgram, 'PROGRAMID', 'PROGRAMID');
        return $item;
    }
    public static function getFindProgram($id){
        $modelProgram = RegProgram::find()->where(['PROGRAMID' => $id])->andWhere(['DEPARTMENTID' => ['2320','2322']])->one();
        if($modelProgram==null){
            return "";
        }else{
            return  $modelProgram->PROGRAMNAME;
        }
    }
    public static function getReligion(){
        $modelReligion = RegReligion::find()->all();
        $item = ArrayHelper::map($modelReligion, 'RELIGIONID', 'RELIGIONNAME');
        return $item;
    }
    public static function getFindReligion($id){
        $modelReligion = RegReligion::find()->where(['RELIGIONID' => $id])->one();
        return $modelReligion;
    }
    public static function getNation(){
        $modelNation = RegNation::find()->all();
        return $modelNation;
    }
    public static function getNational(){
        $modelNation = RegNation::find()->all();
        $item = ArrayHelper::map($modelNation, 'NATIONID', 'NATIONNAME');
        return $item;
    }
    public static function getFindNation($id){
        $modelNation = RegNation::find()->where(['NATIONID' => $id])->one();
        return $modelNation;
    }
    public static function getProvince(){
        $modelProvince = Province::find()->all();
        $item = ArrayHelper::map($modelProvince, 'PROVINCE_ID', 'PROVINCE_NAME');
        return $item;
    }
    public static function getAmphur(){
        $modelAmphur = Amphur::find()->all();
        $item = ArrayHelper::map($modelAmphur, 'AMPHUR_ID', 'AMPHUR_NAME');
        return $item;
    }
    public static function getDistrict(){
        $modelDistrict = District::find()->all();
        $item = ArrayHelper::map($modelDistrict, 'DISTRICT_ID', 'DISTRICT_NAME');
        return $item;
    }
    public static function getZipcode(){
        $modelZipcode = Zipcode::find()->all();
        $item = ArrayHelper::map($modelZipcode, 'ZIPCODE_ID', 'ZIPCODE');
        return $item;
    }
    public static function getFindDistrict($id){
        $modelDistrict = District::find()->where(['DISTRICT_ID' => $id])->one();
        return $modelDistrict;
    }
    public static function getFindProvince($id){
        $modelProvince = Province::find()->where(['PROVINCE_ID' => $id])->one();
        return $modelProvince;
    }
    public static function getFindAmphur($id){
        $modelAmphur = Amphur::find()->where(['AMPHUR_ID' => $id])->one();
        return $modelAmphur;
    }
    public static function getFindZipcode($id){
        $modelZipcode = Zipcode::find()->where(['ZIPCODE_ID' => $id])->one();
        return $modelZipcode;
    }
    public static function getFindPrefix($id){
        $modelPrefix = RegPrefix::find()->where(['PREFIXID' => $id])->one();
        return $modelPrefix;
    }
    public static function getPrefix(){
        $modelPrefix = RegPrefix::find()->all();
        $item = ArrayHelper::map($modelPrefix, 'PREFIXID', 'PREFIXNAME');
        return $item;
    }
    public static function getAcademic(){
    $modelAca = AcademicPositions::find()->all();
    $item = ArrayHelper::map($modelAca, 'academic_positions_id', 'academic_positions');
    return $item;
    }
    public static function getFindAcademic($id){
        $modelAca = AcademicPositions::find()->where(['academic_positions_id' => $id])->one();
        if($modelAca==null){
            return "";
        }else{
            return $modelAca->academic_positions;
        }
    }
    public static function getFindAcademic2($id){
        if($id=='2112'){
            return "";
        }else{
            $modelAca = AcademicPositions::find()->where(['academic_positions_id' => $id])->one();
            if($modelAca==null){
                return "";
            }else{
                return $modelAca->academic_positions_abb_thai;
            }
        }
    }
    public static function getFindPeriod($id){
        $modelPeriod = Period::find()->where(['period_id' => $id])->one();
        return $modelPeriod;
    }
    public static function getFindPosition($id){
        $modelPosition = PositionDirectors::find()->where(['director_id' => $id])->one();
        return $modelPosition;
    }
    public static function getFaculty(){
    $modelFaculty = RegFaculty::find()->all();
    $item = ArrayHelper::map($modelFaculty, 'FACULTYID', 'FACULTYNAME');
    return $item;
    }
    public static function getDepart(){
        $modelDepart = RegDepartment::find()->all();
        $item = ArrayHelper::map($modelDepart, 'DEPARTMENTID', 'DEPARTMENTNAME');
        return $item;
    }
    public static function getSchool(){
        $modelSchool = RegSchool::find()->all();
        $item = ArrayHelper::map($modelSchool, 'SCHOOLID', 'SCHOOLNAME');
        return $item;
    }
    public static function getFindSchool($id){
        $modelSchool = Zipcode::find()->where(['SCHOOLID' => $id])->one();
        return $modelSchool;
    }
    public static function getOffice(){
        $modelOffice = RegOfficer::find()->all();
        $item = ArrayHelper::map($modelOffice, 'OFFICERID', 'OFFICERNAME');
        return $item;
    }
    public static function getFindOffice($id){
        $modelOffice = RegOfficer::find()->where(['OFFICERID' => $id])->one();
        return $modelOffice;
    }
    public static function getPosition(){
        $modelPosition = PositionDirectors::find()->all();
        $item = ArrayHelper::map($modelPosition, 'director_id', 'position_name');
        return $item;
    }
    public static function getLevel(){
        $modelLevel = RegLevel::find()->all();
        $item = ArrayHelper::map($modelLevel, 'LEVELID', 'LEVELNAME');
        return $item;
    }
    public static function getBranch(){
        $modelBranch = Branch::find()->all();
        $item = ArrayHelper::map($modelBranch, 'branch_id', 'branch_name');
        return $item;
    }
    public static function getFindStudentStatus($id){
        $modelStudentStatus = RegSysbytedes::find()->where(['BYTECODE' => $id])->andWhere(['TABLENAME'=>"STUDENTSTATUS",'COLUMNNAME'=>"STUDENTSTATUS"])->one();
        return $modelStudentStatus->BYTEDES;
    }







}