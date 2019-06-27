<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/25/2017
 * Time: 1:26 AM
 */

namespace app\modules\personsystem\controllers;

use app\modules\personsystem\models\AuthAssignment;
use app\modules\personsystem\models\RegEnrollsummary;
use app\modules\personsystem\models\Student;
use yii\data\ArrayDataProvider;
use yii\db\Exception;
use yii\web\Controller;
use dektrium\user\models\User;
use app\modules\personsystem\models\File;
use app\modules\personsystem\models\Importsql;
use app\modules\personsystem\models\RegCourse;
use app\modules\personsystem\models\RegDepartment;
use app\modules\personsystem\models\RegEnroll;
use app\modules\personsystem\models\RegFaculty;
use app\modules\personsystem\models\RegLevel;
use app\modules\personsystem\models\RegOfficer;
use app\modules\personsystem\models\RegProgram;
use app\modules\personsystem\models\RegStudentbio;
use app\modules\personsystem\models\RegStudentmaster;


use yii\helpers\Html;
use yii\web\UploadedFile;


class ImportController extends Controller
{
    public function actionImportExcel()
    {
        $request = \Yii::$app->request;
        $database = $request->post('database');
        $count = 0;
        $modelFile = new File();
        if ($modelFile->load(\Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($modelFile, 'file');
            $filename = 'Data.' . $file->extension;
            $upload = $file->saveAs('web_personal/upload/' . $filename);
            $k = 0;
            if ($upload) {
                define('XLSX', 'web_personal/upload/');
                $csv_file = XLSX . $filename;
                $filecsv = file($csv_file);
                try {
                    $inputFileType = \PHPExcel_IOFactory::identify($csv_file);
                    $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($csv_file);

                } catch (Exception $e) {
                    die('Error');
                }
                $sheet = $objPHPExcel->getSheet(0);
                $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $headingsArray = $objWorksheet->rangeToArray('A1:' . $highestColumn . '1', null, true, true, true);
                $headingsArray = $headingsArray[1];
                $r = -1;
                $namedDataArray = array();
                for ($row = 2; $row <= $highestRow; ++$row) {
                    // $branch=new RegStudentbio();
                    $kuy = true;
                    $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
                    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                        ++$r;
                        if ($database == "reg_studentmaster") {
                            $branch = new RegStudentmaster();
                            $model = $branch->getAttributes(); //Get เเอา attribute name in db
                            foreach (array_keys($model) as $keyModel => $item) {
                                foreach ($headingsArray as $columnKey => $columnHeading) {
                                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                    if ($kuy) {
                                        if (!$branch = RegStudentmaster::findOne($namedDataArray[$r]["STUDENTID"])) {
                                            $branch = new RegStudentmaster();
                                        }
                                        $kuy = false;
                                    }
                                    if ($columnHeading == $item) {
                                        $branch->$item = (string)$namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                echo $branch->STUDENTID;
                                var_dump($branch->errors);
                                exit();
                            }
                            if (RegStudentmaster::findOne($namedDataArray[$r]["STUDENTID"])) {
                                $count++;
                            }
                        } else if ($database == "reg_studentbio") {
                            $branch = new RegStudentbio();
                            $modelAssignment = new AuthAssignment();
                            $model2 = new User();
                            $model3 = new Student();
                            $model = $branch->getAttributes(); //Get เเอา attribute name in db
                            foreach (array_keys($model) as $keyModel => $item) {
                                foreach ($headingsArray as $columnKey => $columnHeading) {
                                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                    if ($kuy) {
                                        if (!$branch = RegStudentbio::findOne($namedDataArray[$r]["STUDENTID"])) {
                                            $branch = new RegStudentbio();
                                        }
                                        $kuy = false;
                                    }
                                    if ($columnHeading == $item) {
                                        $branch->$item = (string)$namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                    }
                                }
                            }
                            if ($branch->save()) {
                                //Create User Model ของ dektrium
                                if (!\app\modules\personsystem\models\User::find()->where(['person_id' => $namedDataArray[$r]["STUDENTID"]])->exists()) {
                                    $model2->username = $namedDataArray[$r]["STUDENTCODE"];
                                    $model2->email = $namedDataArray[$r]["STUDENTCODE"] . "@eofficemail.com";
                                    $model2->password = $namedDataArray[$r]["STUDENTCODE"];
                                    if ($model2->save()) {
                                        //Update User Model คนละตัว
                                        $user = User::findOne($model2->id);
                                        $user->type = "0";
                                        $user->person_id = $namedDataArray[$r]["STUDENTID"];
                                        if (!$user->save()) {
                                            echo "Errors user->save()  <br>";
                                            echo $namedDataArray[$r]["STUDENTID"];
                                            var_dump($user->errors);
                                            exit();
                                        }

                                        //Add Role Student
                                        $modelAssignment->user_id = (string)$model2->id;
                                        $modelAssignment->item_name = "Student";
                                        if (!$modelAssignment->save()) {
                                            echo "Errors modelAssignment->save() <br>";
                                            echo $namedDataArray[$r]["STUDENTID"];
                                            var_dump($modelAssignment->errors);
                                            exit();
                                        }

                                    } else {
                                        echo "Errors model2->save() <br>";
                                        echo $namedDataArray[$r]["STUDENTCODE"];
                                        var_dump($model2->errors);
                                        exit();
                                    }
                                }
                                if (!Student::find()->where(['STUDENTID' => $namedDataArray[$r]["STUDENTID"]])->exists()) {
                                    $model3->STUDENTID = $namedDataArray[$r]["STUDENTID"];
                                    if (!$model3->save()) {
                                        echo $namedDataArray[$r]["STUDENTCODE"];
                                        echo "Errors model3->save() <br>";
                                        var_dump($model3->errors);
                                        exit();
                                    }
                                }
                            } else {
                                echo $namedDataArray[$r]["STUDENTCODE"];
                                var_dump($branch->errors);
                                exit();
                            }
//                            if(!$branch->errors){//Insert ได้แค่ครั้งเดียวเพราะ ID ซ้ำไม่ได้
//                            }
                            if (RegStudentbio::findOne($namedDataArray[$r]["STUDENTID"])) {
                                $count++;
                            }
                        } else if ($database == "reg_level") {
                            $branch = new RegLevel();
                            $model = $branch->getAttributes(); //Get เเอา attribute name in db
                            foreach (array_keys($model) as $keyModel => $item) {
                                foreach ($headingsArray as $columnKey => $columnHeading) {
                                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                    if ($kuy) {
                                        if (!$branch = RegLevel::findOne($namedDataArray[$r]["LEVELID"])) {
                                            $branch = new RegLevel();
                                        }
                                        $kuy = false;
                                    }
                                    if ($columnHeading == $item) {
                                        $branch->$item = (string)$namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                    }
                                }
                            }
                            if (!$branch->save()) {

                                var_dump($branch->errors);
                            }
                            if (RegLevel::findOne($namedDataArray[$r]["LEVELID"])) {
                                $count++;
                            }
                        } else if ($database == "reg_program") {
                            $branch = new RegProgram();
                            $model = $branch->getAttributes(); //Get เเอา attribute name in db
                            foreach (array_keys($model) as $keyModel => $item) {
                                foreach ($headingsArray as $columnKey => $columnHeading) {
                                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                    if ($kuy) {
                                        if (!$branch = RegProgram::findOne($namedDataArray[$r]["PROGRAMID"])) {
                                            $branch = new RegProgram();
                                        }
                                        $kuy = false;
                                    }
                                    if ($columnHeading == $item) {
                                        $branch->$item = (string)$namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                $count = 0;
                                //var_dump($branch->errors);
                            }
                            if (RegProgram::findOne($namedDataArray[$r]["PROGRAMID"])) {
                                $count++;
                            }
                        } else if ($database == "reg_faculty") {
                            $branch = new RegFaculty();
                            $model = $branch->getAttributes(); //Get เเอา attribute name in db
                            foreach (array_keys($model) as $keyModel => $item) {
                                foreach ($headingsArray as $columnKey => $columnHeading) {
                                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                    if ($kuy) {
                                        if (!$branch = RegFaculty::findOne($namedDataArray[$r]["FACULTYID"])) {
                                            $branch = new RegFaculty();
                                        }
                                        $kuy = false;
                                    }
                                    if ($columnHeading == $item) {
                                        $branch->$item = (string)$namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                //var_dump($branch->errors);
                            }
                            if (RegFaculty::findOne($namedDataArray[$r]["FACULTYID"])) {
                                $count++;
                            }
                        } else if ($database == "reg_course") {
                            $branch = new RegCourse();
                            $model = $branch->getAttributes(); //Get เเอา attribute name in db
                            foreach (array_keys($model) as $keyModel => $item) {
                                foreach ($headingsArray as $columnKey => $columnHeading) {
                                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                    if ($kuy) {
                                        if (!$branch = RegCourse::findOne($namedDataArray[$r]["COURSEID"])) {
                                            $branch = new RegCourse();
                                        }
                                        $kuy = false;
                                    }
                                    if ($columnHeading == $item) {
                                        $branch->$item = (string)$namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                // var_dump($branch->errors);
                            }
                            if (RegCourse::findOne($namedDataArray[$r]["COURSEID"])) {
                                $count++;
                            }
                        } else if ($database == "reg_department") {
                            $branch = new RegDepartment();
                            $model = $branch->getAttributes(); //Get เเอา attribute name in db
                            foreach (array_keys($model) as $keyModel => $item) {
                                foreach ($headingsArray as $columnKey => $columnHeading) {
                                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                }
                            }
                            foreach (array_keys($model) as $keyModel => $item) {
                                foreach ($headingsArray as $columnKey => $columnHeading) {
                                    if ($kuy) {
                                        if (!$branch = RegDepartment::findOne(['DEPARTMENTID'=>$namedDataArray[$r]["DEPARTMENTID"],'FACULTYID'=>$namedDataArray[$r]["FACULTYID"]])) {
                                            $branch = new RegDepartment();
                                        }
                                        $kuy = false;
                                    }
                                    if ($columnHeading == $item) {
                                        $branch->$item = (string)$namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                var_dump($branch->errors);
                            }
                            if (RegDepartment::findOne($namedDataArray[$r]["DEPARTMENTID"])) {$count++;}
                        } else if ($database == "reg_officer") {
                            $branch = new RegOfficer();
                            $model = $branch->getAttributes(); //Get เเอา attribute name in db
                            foreach (array_keys($model) as $keyModel => $item) {
                                foreach ($headingsArray as $columnKey => $columnHeading) {
                                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                    if ($kuy) {
                                        if (!$branch = RegOfficer::findOne($namedDataArray[$r]["OFFICERID"])) {
                                            $branch = new RegOfficer();
                                        }
                                        $kuy = false;
                                    }
                                    if ($columnHeading == $item) {
                                        $branch->$item = (string)$namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                //var_dump($branch->errors);
                            }
                            if (RegOfficer::findOne($namedDataArray[$r]["OFFICERID"])) {
                                $count++;
                            }
                        } else if ($database == "reg_course") {
                            $branch = new RegCourse();
                            $model = $branch->getAttributes(); //Get เเอา attribute name in db
                            foreach (array_keys($model) as $keyModel => $item) {
                                foreach ($headingsArray as $columnKey => $columnHeading) {
                                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                    if ($kuy) {
                                        if (!$branch = RegCourse::findOne($namedDataArray[$r]["COURSEID"])) {
                                            $branch = new RegCourse();
                                        }
                                        $kuy = false;
                                    }
                                    if ($columnHeading == $item) {
                                        $branch->$item = (string)$namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                //var_dump($branch->errors);
                            }
                            if (RegCourse::findOne($namedDataArray[$r]["COURSEID"])) {
                                $count++;
                            }
                        } else if ($database == "reg_enrollsummary") {
                            $branch = new RegEnrollsummary();
                            $model = $branch->getAttributes(); //Get เเอา attribute name in db
                            foreach (array_keys($model) as $keyModel => $item) {
                                foreach ($headingsArray as $columnKey => $columnHeading) {
                                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                   // var_dump($namedDataArray);
                                }
                            }
                            foreach (array_keys($model) as $keyModel => $item) {
                                foreach ($headingsArray as $columnKey => $columnHeading) {
                                    if ($kuy) {
                                        if (!$branch = RegEnrollsummary::findOne(['STUDENTID'=>$namedDataArray[$r]["STUDENTID"],'ACADYEAR'=>$namedDataArray[$r]["ACADYEAR"],'SEMESTER'=>$namedDataArray[$r]["SEMESTER"],'COURSEID'=>$namedDataArray[$r]["COURSEID"]])) {
                                            $branch = new RegEnrollsummary();
                                        }
                                        $kuy = false;
                                    }
                                    if ($columnHeading == $item) {
                                        $branch->$item = (string)$namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                var_dump($branch->errors);
                            }
                            if(RegEnrollsummary::findOne($namedDataArray[$r]["STUDENTID"])){$count++;}
                        }

                    }
                }
                unlink('web_personal/upload/' . $filename);
                if (!$branch->errors) {
                    \Yii::$app->getSession()->setFlash('alert1', [
                        'type' => 'success',
                        'duration' => 12000,
                        'icon' => 'fa fa-users',
                        'title' => \Yii::t('app', Html::encode('Submission')),
                        'message' => \Yii::t('app', Html::encode('นำข้อมูลลง Database สำเร็จ')),
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                } else {
                    // print_r($branch->errors);

                    \Yii::$app->getSession()->setFlash('alert1', [
                        'type' => 'warning',
                        'duration' => 12000,
                        'icon' => 'fa fa-warning',
                        'title' => \Yii::t('app', Html::encode('Warning')),
                        'message' => \Yii::t('app', Html::encode('พบข้อผิดพลาด กรุณาอ่านคำแนะนำและตรวจสอบไฟล์')),
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                }
                //  return $this->redirect(['syn/import-excel-test']);
                $this->layout = "main_modules";
                return $this->render('upload', [
                    'model' => $modelFile,
                    'database' => $database,
                    'count' => $count
                ]);
            }
        } else {
//            $searchModel = new StudenttestSearch();
//            $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
            $this->layout = "main_modules";
            return $this->render('upload', [
                'model' => $modelFile,
                'database' => $database,
                'count' => $count
//                'searchModel' => $searchModel,
//                'dataProvider' => $dataProvider,

            ]);
        }
    }
}