<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/13/2017
 * Time: 1:16 AM
 * ต*/

namespace app\modules\personsystem\controllers;

use app\models\AcademicPositions;


use app\modules\personsystem\models\BranchHasLevel;
use app\modules\personsystem\models\BranchHasLevelSearch;
use app\modules\personsystem\models\Major;
use app\modules\personsystem\models\MajorHasProgram;
use app\modules\personsystem\models\Person;
use app\modules\personsystem\models\RegLevel;
use app\modules\personsystem\models\RegProgram;
use app\modules\personsystem\models\RegStudentbio;
use app\modules\personsystem\models\RegStudentmaster;
use app\modules\personsystem\models\RegPrefix;
use app\modules\personsystem\models\RegSysbytedes;
use app\modules\personsystem\models\ViewStudentFull;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;


class ReportController extends controller
{
    public function actionReportStaff()
    {

        $this->layout = "main_modules";
        return $this->render('admin-report-staff');

    }

    public function actionReportStudent()
    {
        $this->layout = "main_modules";
        $funcT = ViewStudentFull::find()->all();
        $modelStudentREG = RegStudentmaster::find()->select('ADMITACADYEAR')->orderBy(['ADMITACADYEAR' => SORT_DESC])->groupBy(["ADMITACADYEAR"])->all();
        $modelMajor = Major::find()->select(['major_name','major_id'])->all();
        $modelLevel = RegLevel::find()
            ->select(["reg_level.LEVELID", "reg_level.LEVELNAME"])
            ->innerJoin('reg_studentmaster', 'reg_studentmaster.LEVELID = reg_level.LEVELID')->groupBy("reg_level.LEVELID")->all();
        $modelStatus = RegSysbytedes::find()
            ->select(["reg_sysbytedes.BYTEDES", "reg_sysbytedes.BYTECODE"])
            ->innerJoin('reg_studentmaster', 'reg_studentmaster.STUDENTSTATUS = reg_sysbytedes.BYTECODE')
            ->where(['reg_sysbytedes.TABLENAME' => "STUDENTSTATUS", 'reg_sysbytedes.COLUMNNAME' => "STUDENTSTATUS"])
            ->groupBy("reg_studentmaster.STUDENTSTATUS")->all();
        return $this->render('admin-report-student',
            [
                'modelYear' => $modelStudentREG,
                'modelLevel' => $modelLevel,
                'modelMajor' => $modelMajor,
                'modelStatus'=> $modelStatus,
            ]);
    }

    public function actionReportTeacher()
    {
        $this->layout = "main_modules";
        return $this->render('admin-report-teacher');
    }
    public function actionToboxStudentWord(){
        $HeeVal = \Yii::$app->request->get('toVal1');
        $HeeText = \Yii::$app->request->get('toText');
        $Status = \Yii::$app->request->get('status');
        $Major = \Yii::$app->request->get('major');
        $Year = \Yii::$app->request->get('year');
        $Level = \Yii::$app->request->get('level');
        Settings::setTempDir(\Yii::getAlias('../modules/personsystem').'/temp/');
        $templateProcessor = new TemplateProcessor(\Yii::getAlias('../modules/personsystem').'/msword/template_in.docx');
        Settings::setTempDir(\Yii::getAlias('@webroot').'/temp/'); //Path ของ Folder temp ที่สร้างเอาไว้
        $MajorName ="";
        if($Major=="1"){
            $MajorName="สาขาวิชาวิทยาการคอมพิวเตอร์";
        }else if($Major=="2"){
            $MajorName="สาขาวิชาเทคโนโลยีสารสนเทศ";
        }else if($Major=="3"){
            $MajorName="สาขาวิชาภูมิสารสนเทศศาสตร์";
        }
       // echo $Status."|".$Major."|".$Year."|".$Level."|";
        // กำหนดค่า $YedMePls เป็น 4 เพื่อเริ่มพิมพ์ที่แถวที่ 4
        $datas = [[]];
        // Write data from MySQL result (วนลูปเพื่อเอาข้อมูลที่เลือกจาก Database)
        //LEVELID 34 ป.ตรีภาคพิเศษ 31 ป.ตรีภาคปกติ
        //PROGRAMID /0206 วิทยาการคอม /0210 เทคโนโลยีสารสนเทศและการสื่อสาร /0227 เทคโนโลยีสารสนเทศ /0212 ภูมิสารสนเทศศาสตร์
        for ($i = 0; $i < sizeof($HeeVal); $i++) {
            //  สามารถเขียน อัลกอริทึมเช็คเพีนงเงื่อนไขเดียวได้ แต่เลือกที่ใช้วิธีการแยก เพื่อให้ง่ายต่อความเข้าใจ
            $funcT = ViewStudentFull::find()
                ->filterWhere(['=', 'LEVELID', $Level])
                ->andFilterWhere(['=', 'major_id', $Major])
                ->andFilterWhere(['=', 'ADMITACADYEAR', $Year])
                ->andFilterWhere(['=', 'STUDENTSTATUS', $Status])
                ->all();
            $j=0;
            foreach ($funcT as $item) { //วนลูป
                //$datas = [['STUDENTCODE' => 11, 'PREFIXNAME' => 'ทดสอบ1', 'STUDENTNAME' => 250, 'amount' => 2],];
                if ($HeeVal[$i] == "student_mobile_phone") {//ชื่อ-นามสกุล ภาษาไทย
                    $datas["STUDENTMOBILE"][$j] = $item->STUDENTMOBILE;
                } else if ($HeeVal[$i] == "student_email") {//
                    $datas["STUDENTEMAIL"][$j] = $item->STUDENTEMAIL;
                } else if ($HeeVal[$i] == "adviser_id") {//ที่ปรึกษา
                    $datas["OFFICERNAME"][$j] = $item->OFFICERNAME." ".$item->OFFICERSURNAME;
                } else if ($HeeVal[$i] == "GPA") {//เกรด
                    $datas["GPA"][$j] = $item->GPA;
                } else if ($HeeVal[$i] == "PREFIXID") {//คำนำหน้าชื่อ
                    $datas["PREFIXNAME"][$j] = $item->PREFIXNAME;
                } else if ($HeeVal[$i] == "STUDENTCODE") {//รหัสนักศึกษา
                    $datas["STUDENTCODE"][$j] =  $item->STUDENTCODE;
                } else if ($HeeVal[$i] == "CITIZENID") {//รหัสบัตรประชาชน
                    $datas["CITIZENID"][$j] = $item->CITIZENID;
                } else if ($HeeVal[$i] == "STUDENTNAME") {//ชื่อ-นามสกุล ภาษาอังกฤษ
                    $datas["STUDENTNAME"][$j] = $item->STUDENTNAME." ".$item->STUDENTSURNAME;
                } else if ($HeeVal[$i] == "PROGRAMID") {
                    $datas["major_name"][$j] = $item->major_name;
                } else if ($HeeVal[$i] == "STUDENTYEAR") {
                    $datas["STUDENTYEAR"][$j] = $item->STUDENTYEAR;
                }
               // echo $HeeVal[$i].$i;
                $j++;
            }
        }
        //var_dump($funcT);
//        foreach ($funcT as $item) {
//        echo $item->STUDENTID."<br>";
//        }
        $StatusStudent = RegSysbytedes::find()
            ->select(["reg_sysbytedes.BYTEDES"])
            ->where(['BYTECODE' =>$Status,'reg_sysbytedes.TABLENAME' => "STUDENTSTATUS", 'reg_sysbytedes.COLUMNNAME' => "STUDENTSTATUS"])
          ->one();

        $templateProcessor->setValue('doc_department', $MajorName);//อัดตัวแปร รายตัว
        $templateProcessor->setValue('student_status', $StatusStudent->BYTEDES);
        $templateProcessor->setValue('ADMITACADYEAR', $Year);
        $templateProcessor->cloneRow('STUDENTCODE', sizeof($funcT));
        $j=1;
        for ($i = 0; $i < sizeof($funcT); $i++) {
            $templateProcessor->setValue('NO#'.$j,$j);
            if(isset($datas['STUDENTCODE'][$i])){
                $templateProcessor->setValue('STUDENTCODE#'.$j,$datas['STUDENTCODE'][$i]);
            }else{
                $templateProcessor->setValue('STUDENTCODE#'.$j,"");
            }
            if(isset($datas['STUDENTNAME'][$i])){
                $templateProcessor->setValue('STUDENTNAME#'.$j,$datas['STUDENTNAME'][$i]);
            }else{
                $templateProcessor->setValue('STUDENTNAME#'.$j,"");
            }
            if(isset($datas['STUDENTMOBILE'][$i])){
                $templateProcessor->setValue('STUDENTMOBILE#'.$j,$datas['STUDENTMOBILE'][$i]);
            }else{
                $templateProcessor->setValue('STUDENTMOBILE#'.$j,"");
            }
            if(isset($datas['STUDENTEMAIL'][$i])){
                $templateProcessor->setValue('STUDENTEMAIL#'.$j,$datas['STUDENTEMAIL'][$i]);
            }else{
                $templateProcessor->setValue('STUDENTEMAIL#'.$j,"");
            }
            if(isset($datas['OFFICERNAME'][$i])){
                $templateProcessor->setValue('OFFICERNAME#'.$j,$datas['OFFICERNAME'][$i]);
            }else{
                $templateProcessor->setValue('OFFICERNAME#'.$j,"");
            }
            if(isset($datas['GPA'][$i])){
                $templateProcessor->setValue('GPA#'.$j,$datas['GPA'][$i]);
            }else{
                $templateProcessor->setValue('GPA#'.$j,"");
            }
            if(isset($datas['PREFIXNAME'][$i])){
                $templateProcessor->setValue('PREFIXNAME#'.$j,$datas['PREFIXNAME'][$i]);
            }else{
                $templateProcessor->setValue('PREFIXNAME#'.$j,"");
            }
            if(isset($datas['CITIZENID'][$i])){
                $templateProcessor->setValue('CITIZENID#'.$j,$datas['CITIZENID'][$i]);
            }else{
                $templateProcessor->setValue('CITIZENID#'.$j,"");
            }
            if(isset($datas['major_name'][$i])){
                $templateProcessor->setValue('major_name#'.$j,$datas['major_name'][$i]);
            }else{
                $templateProcessor->setValue('major_name#'.$j,"");
            }
            if(isset($datas['STUDENTYEAR'][$i])){
                $templateProcessor->setValue('STUDENTYEAR#'.$j,$datas['STUDENTYEAR'][$i]);
            }else{
                $templateProcessor->setValue('STUDENTYEAR#'.$j,"");
            }

            $j++;
        }
        $templateProcessor->saveAs('ReportStudent.docx');//สั่งให้บันทึกข้อมูลลงไฟล์ใหม่
        $tjung = \Yii::getAlias('@web') . '/msword/ReportStudent.docx';
        if(empty($funcT)){
            echo "";
        }else{
            echo $tjung;
        }


    }
    public function actionToboxStaffWord(){
        $HeeVal = \Yii::$app->request->get('toVal');
        $HeeText = \Yii::$app->request->get('toText');
        Settings::setTempDir(\Yii::getAlias('../modules/personsystem').'/temp/');
        $templateProcessor = new TemplateProcessor(\Yii::getAlias('../modules/personsystem').'/msword/template_staff.docx');
        Settings::setTempDir(\Yii::getAlias('@webroot').'/temp/'); //Path ของ Folder temp ที่สร้างเอาไว้
        $datas = [[]];
        $funcT = Person::find()->where('person_type = :person_type', [':person_type' => '2'])->all();
        for ($i = 0; $i < sizeof($HeeVal); $i++) {
            $j=0;
            foreach ($funcT as $item) {
                if ($HeeVal[$i] == "person_mobile") {
                    $datas["person_mobile"][$j] = $item->person_mobile;
                } else if ($HeeVal[$i] == "person_fax") {
                    $datas["person_fax"][$j] = $item->person_fax;
                } else if ($HeeVal[$i] == "person_email") {
                    $datas["person_email"][$j] = $item->person_email;
                } else if ($HeeVal[$i] == "person_position_staff") {
                    $datas["person_position_staff"][$j] = $item->person_position_staff;
                } else if ($HeeVal[$i] == "prefix_id") {
                    $model = RegPrefix::findOne($item["prefix_id"]);
                    $datas["PREFIXNAME"][$j] = $model->PREFIXNAME;
                } else if ($HeeVal[$i] == "person_citizen_id") {
                    $datas["person_citizen_id"][$j] = $item->person_citizen_id;
                } else if ($HeeVal[$i] == "person_name") {
                    $datas["person_name"][$j] = $item->person_name." ".$item->person_surname;
                } else if ($HeeVal[$i] == "person_name_eng") {
                    $datas["person_name_eng"][$j] = $item->person_name_eng . " " . $item->person_surname_eng;
                }
                $j++;
            }
        }
        $templateProcessor->cloneRow('PREFIXNAME', sizeof($funcT));
        $j=1;
        for ($i = 0; $i < sizeof($funcT); $i++) {
            $templateProcessor->setValue('NO#'.$j,$j);
            if(isset($datas['PREFIXNAME'][$i])){
                $templateProcessor->setValue('PREFIXNAME#'.$j,$datas['PREFIXNAME'][$i]);
            }else{
                $templateProcessor->setValue('PREFIXNAME#'.$j,"");
            }
            if(isset($datas['person_name'][$i])){
                $templateProcessor->setValue('person_name#'.$j,$datas['person_name'][$i]);
            }else{
                $templateProcessor->setValue('person_name#'.$j,"");
            }
            if(isset($datas['person_name_eng'][$i])){
                $templateProcessor->setValue('person_name_eng#'.$j,$datas['person_name_eng'][$i]);
            }else{
                $templateProcessor->setValue('person_name_eng#'.$j,"");
            }
            if(isset($datas['person_position_staff'][$i])){
                $templateProcessor->setValue('position_staff#'.$j,$datas['person_position_staff'][$i]);
            }else{
                $templateProcessor->setValue('position_staff#'.$j,"");
            }
            if(isset($datas['person_citizen_id'][$i])){
                $templateProcessor->setValue('person_citizen_id#'.$j,$datas['person_citizen_id'][$i]);
            }else{
                $templateProcessor->setValue('person_citizen_id#'.$j,"");
            }
            if(isset($datas['person_email'][$i])){
                $templateProcessor->setValue('person_email#'.$j,$datas['person_email'][$i]);
            }else{
                $templateProcessor->setValue('person_email#'.$j,"");
            }
            if(isset($datas['person_mobile'][$i])){
                $templateProcessor->setValue('person_mobile#'.$j,$datas['person_mobile'][$i]);
            }else{
                $templateProcessor->setValue('person_mobile#'.$j,"");
            }
            if(isset($datas['person_fax'][$i])){
                $templateProcessor->setValue('person_fax#'.$j,$datas['person_fax'][$i]);
            }else{
                $templateProcessor->setValue('person_fax#'.$j,"");
            }
            $j++;
        }
        $templateProcessor->saveAs('ReportStaff.docx');//สั่งให้บันทึกข้อมูลลงไฟล์ใหม่
        $tjung = \Yii::getAlias('@web') . '/msword/ReportStaff.docx';
        echo $tjung;

    }
    public function actionToboxStaff()
    {
        $HeeVal = \Yii::$app->request->get('toVal');
        $HeeText = \Yii::$app->request->get('toText');
        $objPHPExcel = new \PHPExcel(); //สร้างไฟล์ excel
        for ($i = 0; $i < sizeof($HeeText); $i++) {
            $columnLetter = \PHPExcel_Cell::stringFromColumnIndex($i);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($columnLetter . "3", $HeeText[$i]);
            echo $columnLetter . " ";
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'ออกรายงานข้อมูลเจ้าหน้าที่ ภาควิชาวิทยาการคอมพิวเตอร์');
        $column = 0;
        for ($i = 0; $i < sizeof($HeeVal); $i++) {
            $YedMePls = 4;
            $columnLetter = \PHPExcel_Cell::stringFromColumnIndex($column);
            $funcT = Person::find()->where('person_type = :person_type', [':person_type' => '2'])->all();
            foreach ($funcT as $item) {
                if ($HeeVal[$i] == "person_mobile") {//ชื่อ-นามสกุล ภาษาไทย
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["person_mobile"]);
                } else if ($HeeVal[$i] == "person_fax") {
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["person_fax"]);
                } else if ($HeeVal[$i] == "person_email") {
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["person_email"]);
                } else if ($HeeVal[$i] == "person_position_staff") {
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["person_position_staff"]);
                } else if ($HeeVal[$i] == "prefix_id") {
                    $model = RegPrefix::findOne($item["prefix_id"]);
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $model["PREFIXNAME"]);
                } else if ($HeeVal[$i] == "person_citizen_id") {
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["person_citizen_id"]);
                } else if ($HeeVal[$i] == "person_name") {
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["person_name"] . " " . $item["person_surname"]);
                } else if ($HeeVal[$i] == "person_name_eng") {
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["person_name_eng"] . " " . $item["person_surname_eng"]);
                }
                $YedMePls++;
            }
            $column++;
        }
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('ReportStaff.xlsx'); // Save File เป็นชื่อ myData.xlsx
        $tjung = \Yii::getAlias('@web') . '/ReportStaff.xlsx';
        echo $tjung;

    }
    public function actionToboxTeacherWord(){
        $HeeVal = \Yii::$app->request->get('toVal');
        $HeeText = \Yii::$app->request->get('toText');
        $HeeSelect = \Yii::$app->request->get('toSelect');
        Settings::setTempDir(\Yii::getAlias('../modules/personsystem').'/temp/');
        $templateProcessor = new TemplateProcessor(\Yii::getAlias('../modules/personsystem').'/msword/template_teacher.docx');
        Settings::setTempDir(\Yii::getAlias('@webroot').'/temp/'); //Path ของ Folder temp ที่สร้างเอาไว้
        $datas = [[]];
        $HeeSelectName ="";
        if($HeeSelect=="CS"){
            $HeeSelectName="ประจำสาขาวิชาวิทยาการคอมพิวเตอร์";
        }else if($HeeSelect=="ICT"){
            $HeeSelectName="ประจำสาขาวิชาเทคโนโลยีสารสนเทศ";
        }else if($HeeSelect=="GIS"){
            $HeeSelectName="ประจำสาขาวิชาภูมิสารสนเทศศาสตร์";
        }
        if ($HeeSelect == "ALL") {
            $funcT = Person::find()
                ->leftJoin(Major::tableName(), Person::tableName() . '.major_id = ' . Major::tableName() . '.major_id')
                ->where('person_type = :person_type', [':person_type' => '1'])->all();
        } else if ($HeeSelect == "ICT") {
            $funcT = Person::find()
                ->leftJoin(Major::tableName(), Person::tableName() . '.major_id = ' . Major::tableName() . '.major_id')
                ->where('major_code = :major_code', [':major_code' => 'ICT'])
                ->andWhere('person_type = :person_type', [':person_type' => '1'])->all();
        } else if ($HeeSelect == "CS") {
            $funcT = Person::find()
                ->leftJoin(Major::tableName(), Person::tableName() . '.major_id = ' . Major::tableName() . '.major_id')
                ->where('major_code = :major_code', [':major_code' => 'CS'])
                ->andWhere('person_type = :person_type', [':person_type' => '1'])->all();
        } else if ($HeeSelect == "GIS") {
            $funcT = Person::find()
                ->leftJoin(Major::tableName(), Person::tableName() . '.major_id = ' . Major::tableName() . '.major_id')
                ->where('major_code = :major_code', [':major_code' => 'GIS'])
                ->andWhere('person_type = :person_type', [':person_type' => '1'])->all();
        }

        for ($i = 0; $i < sizeof($HeeVal); $i++) {
            $j=0;
            foreach ($funcT as $item) { //วนลูป
                if ($HeeVal[$i] == "person_name") {//ชื่อ-นามสกุล ภาษาไทย
                    $datas["person_name"][$j] = $item->person_name." ".$item->person_surname;
                } else if ($HeeVal[$i] == "person_name_eng") {//ชื่อ-นามสกุล ภาษาอังกฤษ
                    $datas["person_name_eng"][$j] = $item->person_name_eng." ".$item->person_surname_eng;}
                else if ($HeeVal[$i] == "lecturer") {
                    $datas["lecturer"][$j] = $item->major->major_name;
                } else if ($HeeVal[$i] == "academic_positions_abb") {//ตำแหน่งทางวิชาการ
                    $model = AcademicPositions::findOne($item["academic_positions_id"]);
                    $datas["academic_positions"][$j] = $model->academic_positions;
                } else if ($HeeVal[$i] == "person_citizen_id") {//รหัสบัตรประชาชน
                    $datas["person_citizen_id"][$j] = $item->person_citizen_id;
                } else if ($HeeVal[$i] == "prefix_id") {//คำนำหน้าชื่อ
                    $model = RegPrefix::findOne($item["prefix_id"]);
                    $datas["PREFIXNAME"][$j] = $model->PREFIXNAME;
                } else if ($HeeVal[$i] == "person_email") {
                    $datas["person_email"][$j] = $item->person_email;
                } else if ($HeeVal[$i] == "person_fax") {
                    $datas["person_fax"][$j] = $item->person_fax;
                } else if ($HeeVal[$i] == "person_mobile") {
                    $datas["person_mobile"][$j] = $item->person_mobile;
                }
                $j++;
            }

        }
        $templateProcessor->setValue('major', $HeeSelectName);//อัดตัวแปร รายตัว
        $templateProcessor->cloneRow('NO', sizeof($funcT));
        $k=1;
        for ($i = 0; $i < sizeof($funcT); $i++) {
            $templateProcessor->setValue('NO#'.$k,$k);
            if(isset($datas['PREFIXNAME'][$i])){
                $templateProcessor->setValue('PREFIXNAME#'.$k,$datas['PREFIXNAME'][$i]);
            }else{
                $templateProcessor->setValue('PREFIXNAME#'.$k,"");
            }
            if(isset($datas['person_name'][$i])){
                $templateProcessor->setValue('person_name#'.$k,$datas['person_name'][$i]);
            }else{
                $templateProcessor->setValue('person_name#'.$k,"");
            }
            if(isset($datas['person_name_eng'][$i])){
                $templateProcessor->setValue('person_name_eng#'.$k,$datas['person_name_eng'][$i]);
            }else{
                $templateProcessor->setValue('person_name_eng#'.$k,"");
            }
            if(isset($datas['lecturer'][$i])){
                $templateProcessor->setValue('lecturer#'.$k,$datas['lecturer'][$i]);
            }else{
                $templateProcessor->setValue('lecturer#'.$k,"");
            }
            if(isset($datas['person_citizen_id'][$i])){
                $templateProcessor->setValue('person_citizen_id#'.$k,$datas['person_citizen_id'][$i]);
            }else{
                $templateProcessor->setValue('person_citizen_id#'.$k,"");
            }
            if(isset($datas['person_email'][$i])){
                $templateProcessor->setValue('person_email#'.$k,$datas['person_email'][$i]);
            }else{
                $templateProcessor->setValue('person_email#'.$k,"");
            }
            if(isset($datas['person_mobile'][$i])){
                $templateProcessor->setValue('person_mobile#'.$k,$datas['person_mobile'][$i]);
            }else{
                $templateProcessor->setValue('person_mobile#'.$k,"");
            }
            if(isset($datas['person_fax'][$i])){
                $templateProcessor->setValue('person_fax#'.$k,$datas['person_fax'][$i]);
            }else{
                $templateProcessor->setValue('person_fax#'.$k,"");
            }
            if(isset($datas['academic_positions'][$i])){
                $templateProcessor->setValue('academic_positions#'.$k,$datas['academic_positions'][$i]);
            }else{
                $templateProcessor->setValue('academic_positions#'.$k,"");
            }
            $k++;
        }
        $templateProcessor->saveAs('ReportTeacher.docx');//สั่งให้บันทึกข้อมูลลงไฟล์ใหม่
        $tjung = \Yii::getAlias('@web') . '/msword/ReportTeacher.docx';
        echo $tjung;
    }

    public function actionToboxTeacher()
    {
        $HeeVal = \Yii::$app->request->get('toVal');
        $HeeText = \Yii::$app->request->get('toText');
        $HeeSelect = \Yii::$app->request->get('toSelect');
        $objPHPExcel = new \PHPExcel(); //สร้างไฟล์ excel

        for ($i = 0; $i < sizeof($HeeText); $i++) {
            $columnLetter = \PHPExcel_Cell::stringFromColumnIndex($i);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($columnLetter . "3", $HeeText[$i]);
        }
        $HeeSelectName ="";
        if($HeeSelect=="CS"){
            $HeeSelectName="ประจำสาขาวิชาวิทยาการคอมพิวเตอร์";
        }else if($HeeSelect=="ICT"){
            $HeeSelectName="ประจำสาขาวิชาเทคโนโลยีสารสนเทศ";
        }else if($HeeSelect=="GIS"){
            $HeeSelectName="ประจำสาขาวิชาภูมิสารสนเทศศาสตร์";
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'ออกรายงานข้อมูลอาจารย์'.$HeeSelectName);
        // กำหนดค่า t เป็น 4 เพื่อเริ่มพิมพ์ที่แถวที่ 4
        $column = 0;
        // Write data from MySQL result
        for ($i = 0; $i < sizeof($HeeVal); $i++) {
            $YedMePls = 4;
            $columnLetter = \PHPExcel_Cell::stringFromColumnIndex($column);
            if ($HeeSelect == "ALL") {
                $funcT = Person::find()
                    ->where(['person_type' => '1'])->all();
            } else if ($HeeSelect == "ICT") {
                $funcT = Person::find()
                    ->where(['major_id' => '2','person_type' => '1'])->all();
            } else if ($HeeSelect == "CS") {
                $funcT = Person::find()
                    ->where(['major_id' => '1','person_type' => '1'])->all();
            } else if ($HeeSelect == "GIS") {
                $funcT = Person::find()
                    ->where(['major_id' => '3','person_type' => '1'])->all();
            }

            foreach ($funcT as $item) { //วนลูป

                // for($j=0;$j<sizeof($HeeText);$j++) {
                if ($HeeVal[$i] == "person_name") {//ชื่อ-นามสกุล ภาษาไทย
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["person_name"] . "  " . $item["person_surname"]);
                } else if ($HeeVal[$i] == "person_name_eng") {//ชื่อ-นามสกุล ภาษาอังกฤษ
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["person_name_eng"] . "  " . $item["person_surname_eng"]);
                } else if ($HeeVal[$i] == "lecturer") {
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item->major->major_name);
                } else if ($HeeVal[$i] == "academic_positions_abb") {//ตำแหน่งทางวิชาการ
                    $model = AcademicPositions::findOne($item["academic_positions_id"]);
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $model["academic_positions"]);
                } else if ($HeeVal[$i] == "person_citizen_id") {//รหัสบัตรประชาชน
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["person_citizen_id"]);
                } else if ($HeeVal[$i] == "prefix_id") {//คำนำหน้าชื่อ
                    $model = RegPrefix::findOne($item["prefix_id"]);
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $model["PREFIXNAME"]);
                } else if ($HeeVal[$i] == "person_email") {
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["person_email"]);
                } else if ($HeeVal[$i] == "person_fax") {
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["person_fax"]);
                } else if ($HeeVal[$i] == "person_mobile") {
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["person_mobile"]);
                }
                //  echo $columnLetter . " : " . $YedMePls . "<br>";
                $YedMePls++;
                //  }
            }
            $column++;
        }
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('ReportTeacher.xlsx'); // Save File เป็นชื่อ myData.xlsx
        $tjung = \Yii::getAlias('@web') . '/ReportTeacher.xlsx';
        echo $tjung;

    }

    public function actionToboxStudent()
    {
        $HeeVal = \Yii::$app->request->get('toVal1'); //ส่งค่ามาเป็น array
        $HeeText = \Yii::$app->request->get('toText');//ส่งค่ามาเป็น array
        $Status = \Yii::$app->request->get('status'); // ไม่ใช้ Array
        $Major = \Yii::$app->request->get('major'); // ไม่ใช้ Array
        $Year = \Yii::$app->request->get('year'); // ไม่ใช้ Array
        $Level = \Yii::$app->request->get('level');
        //   echo $Status." / ".$Major." / ".$Year;
        $objPHPExcel = new \PHPExcel(); //สร้างไฟล์ excel

        $array = [];
        for ($i = 0; $i < sizeof($HeeText); $i++) {
            $columnLetter = \PHPExcel_Cell::stringFromColumnIndex($i);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($columnLetter . "3", $HeeText[$i]);
        } // วนลูปเอาค่าที่เลือกมาเช่น อีเมล,ที่ปรึกษา,เกรดเฉลี่ย
        $MajorName ="";
        if($Major=="1"){
            $MajorName="สาขาวิชาวิทยาการคอมพิวเตอร์";
        }else if($Major=="2"){
            $MajorName="สาขาวิชาเทคโนโลยีสารสนเทศ";
        }else if($Major=="3"){
            $MajorName="สาขาวิชาภูมิสารสนเทศศาสตร์";
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'ออกรายงานข้อมูลนักศึกษา'.$MajorName);
        // กำหนดค่า $YedMePls เป็น 4 เพื่อเริ่มพิมพ์ที่แถวที่ 4
        $column = 0;
        // Write data from MySQL result (วนลูปเพื่อเอาข้อมูลที่เลือกจาก Database)
        //LEVELID 34 ป.ตรีภาคพิเศษ 31 ป.ตรีภาคปกติ
        //PROGRAMID /0206 วิทยาการคอม /0210 เทคโนโลยีสารสนเทศและการสื่อสาร /0227 เทคโนโลยีสารสนเทศ /0212 ภูมิสารสนเทศศาสตร์
        for ($i = 0; $i < sizeof($HeeVal); $i++) {
            $YedMePls = 4;
            $columnLetter = \PHPExcel_Cell::stringFromColumnIndex($column);
            //  สามารถเขียน อัลกอริทึมเช็คเพีนงเงื่อนไขเดียวได้ แต่เลือกที่ใช้วิธีการแยก เพื่อให้ง่ายต่อความเข้าใจ
            $funcT = ViewStudentFull::find()
                ->filterWhere(['=', 'LEVELID', $Level])
                ->andFilterWhere(['=', 'major_id', $Major])
                ->andFilterWhere(['=', 'ADMITACADYEAR', $Year])
                ->andFilterWhere(['=', 'STUDENTSTATUS', $Status])
                ->all();


            foreach ($funcT as $item) { //วนลูป

                if ($HeeVal[$i] == "student_mobile_phone") {//ชื่อ-นามสกุล ภาษาไทย
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item->STUDENTMOBILE);
                }
                else if ($HeeVal[$i] == "student_email") {//
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["STUDENTEMAIL"]);
                } else if ($HeeVal[$i] == "adviser_id") {//ที่ปรึกษา
                    //$objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $model["adviser_id"]);
                } else if ($HeeVal[$i] == "GPA") {//เกรด
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["GPA"]);
                } else if ($HeeVal[$i] == "PREFIXID") {//คำนำหน้าชื่อ
                    $model = RegPrefix::findOne($item["PREFIXID"]);
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $model["PREFIXNAME"]);
                } else if ($HeeVal[$i] == "STUDENTCODE") {//รหัสนักศึกษา
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["STUDENTCODE"]);
                } else if ($HeeVal[$i] == "CITIZENID") {//รหัสบัตรประชาชน
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item->CITIZENID);
                } else if ($HeeVal[$i] == "STUDENTNAME") {//ชื่อ-นามสกุล ภาษาอังกฤษ
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["STUDENTNAME"] . "  " . $item["STUDENTSURNAME"]);
                } else if ($HeeVal[$i] == "PROGRAMID") {
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $Major);
                } else if ($HeeVal[$i] == "STUDENTYEAR") {
                    $objPHPExcel->getActiveSheet()->setCellValue($columnLetter . $YedMePls, $item["STUDENTYEAR"]);
                }
                //  echo $columnLetter . " : " . $YedMePls . "<br>";
                $YedMePls++;
            }
            $column++;
        }
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('ReportStudent.xlsx'); // Save File เป็นชื่อ myData.xlsx
        $tjung = \Yii::getAlias('@web') . '/ReportStudent.xlsx';
        //  echo " ppfuck"."  ".$Major." : ".$you;
        if(empty($funcT)){
            echo "";
        }else{
            echo $tjung;
        }

    }



}