<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 26/3/2561
 * Time: 14:04
 */

namespace app\modules\eproject\controllers;


use app\modules\eproject\models\Project;
use app\modules\eproject\models\RequestAdviser;
use app\modules\eproject\models\StudentProject;
use app\modules\eproject\models\User;
use app\modules\eproject\models\ViewStudentFull;
use app\modules\personsystem\controllers\GetModelController;
use Yii;
use yii\web\Controller;

class StudentController extends Controller
{
    public function actionView($id)
    {
        $modelAdviserRequest = RequestAdviser::find()
            ->where( ['crby' => $id] )
            ->all();
        $projectId = StudentProject::find()->where( ['student_id' => $id] )
            ->distinct()->select( 'project_id' );
        $project = Project::find()->where( ['id' => $projectId] )->all();

        $studentId = substr( User::findOne( $id )->username, '0', '9' );
        $modelStudent = ViewStudentFull::findOne( $studentId );
        $Student = new ViewStudentFull();
        $model = $Student->getAttributes();

        foreach (array_keys( $model ) as $item) {
            if ($modelStudent->$item == "") {
                $modelStudent->$item = "<span style='color:red'>N/A</span>";
            }
        }
        if (isset( $modelStudent->STUDENTSTATUS ) && $modelStudent->STUDENTSTATUS != "") {
            if ($modelStudent->STUDENTSTATUS == "10") {
                $modelStudent->STUDENTSTATUS = "นักศึกษาปัจจุบัน";
            } else if ($modelStudent->STUDENTSTATUS == "11") {
                $modelStudent->STUDENTSTATUS = "รักษาสภาพนักศึกษา";
            } else if ($modelStudent->STUDENTSTATUS == "12") {
                $modelStudent->STUDENTSTATUS = "ลาพักการเรียน";
            } else if ($modelStudent->STUDENTSTATUS == "40") {
                $modelStudent->STUDENTSTATUS = "สำเร็จการศึกษา";
            } else if ($modelStudent->STUDENTSTATUS == "61") {
                $modelStudent->STUDENTSTATUS = "พ้นสภาพเนื่องจากไม่ชำระค่าลงทะเบียนต่อ";
            } else {
                $modelStudent->STUDENTSTATUS = "N/A";
            }
        }

        return $this->render( 'view', [
            'modelAdviserRequest' => $modelAdviserRequest,
            'modelStudent' => $modelStudent,
            'projects' => $project,
            'District' => GetModelController::getFindDistrict( $modelStudent->student_home_district_id ),
            'Province' => GetModelController::getFindProvince( $modelStudent->student_home_province_id ),
            'Amphur' => GetModelController::getFindAmphur( $modelStudent->student_home_amphur_id ),
            'Zipcode' => GetModelController::getFindZipcode( $modelStudent->student_home_zipcode_id ),
            'Current_District' => GetModelController::getFindDistrict( $modelStudent->student_current_district_id ),
            'Current_Province' => GetModelController::getFindProvince( $modelStudent->student_current_province_id ),
            'Current_Amphur' => GetModelController::getFindAmphur( $modelStudent->student_current_amphur_id ),
            'Current_Zipcode' => GetModelController::getFindZipcode( $modelStudent->student_current_zipcode_id ),
            'Father_District' => GetModelController::getFindDistrict( $modelStudent->father_district_id ),
            'Father_Province' => GetModelController::getFindProvince( $modelStudent->father_province_id ),
            'Father_Amphur' => GetModelController::getFindAmphur( $modelStudent->father_amphur_id ),
            'Father_Zipcode' => GetModelController::getFindZipcode( $modelStudent->father_zipcode_id ),
            'Mother_District' => GetModelController::getFindDistrict( $modelStudent->mother_district_id ),
            'Mother_Province' => GetModelController::getFindProvince( $modelStudent->mother_province_id ),
            'Mother_Amphur' => GetModelController::getFindAmphur( $modelStudent->mother_amphur_id ),
            'Mother_Zipcode' => GetModelController::getFindZipcode( $modelStudent->mother_zipcode_id ),
            'Father_Religion' => GetModelController::getFindReligion( $modelStudent->father_religion ),
            'Mother_Religion' => GetModelController::getFindReligion( $modelStudent->mother_religion ),
            'Father_Nation' => GetModelController::getFindNation( $modelStudent->father_nationality ),
            'Mother_Nation' => GetModelController::getFindNation( $modelStudent->mother_nationality ),
            'Parent_District' => GetModelController::getFindDistrict( $modelStudent->parent_district_id ),
            'Parent_Province' => GetModelController::getFindProvince( $modelStudent->parent_province_id ),
            'Parent_Amphur' => GetModelController::getFindAmphur( $modelStudent->parent_amphur_id ),
            'Parent_Zipcode' => GetModelController::getFindZipcode( $modelStudent->parent_zipcode_id ),
        ] );
    }


}