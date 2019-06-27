<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/9/2017
 * Time: 7:34 PM
 */

namespace app\modules\personsystem\controllers;


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
use app\modules\personsystem\models\Studenttest;
use app\modules\personsystem\models\StudenttestSearch;
use yii\db\Exception;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\UploadedFile;

class SynController extends Controller
{

    public function actionImportData()
    {
        $this->layout = "main_modules";
        return $this->render('import-data');

    }

    public function actionSelectId()
    {
        $qury = Importsql::find()->select('id')->all();
        foreach ($qury as $value) {
            echo $value->id . "<br>";
        }

    }

    public function actionImportExcelTest2()
    {
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
                //  echo $highestRow."<br><br>";
                for ($row = 2; $row <= $highestRow; ++$row) { // วนตามไฟล์ Excel
                    $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
                    //echo $dataRow[$row]['A']." #<br>";
                    $flag = false;
                    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                        ++$r;
                        $branch = new Importsql();
                        $model = $branch->getAttributes(); //Get เเอา attribute name in db
                        foreach (array_keys($model) as $keyModel => $item) {
                            foreach ($headingsArray as $columnKey => $columnHeading) {
                                $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                //  echo $dataRow[$row][$columnKey]."<br>";
                                //วนเอาเฉาะ id ของไฟล์
                                // echo $namedDataArray[$r]["id"] . $value->id . "<br>";
                                if (Importsql::findOne($namedDataArray[$r]["id"])) {
                                    if ($columnHeading != "id" && $columnHeading == $item) { //เช็คหัวตารางกับหัวข้อมูลในไฟล์ Excel ว่าตรงกันหรือไม่
                                        //    echo $columnHeading . "*" . $item . "<b>T</b><br>";
                                        $model = Importsql::findOne($namedDataArray[$r]["id"]);
                                        $model->$item = $namedDataArray[$r][$columnHeading];
                                        $model->update();
                                    }
                                } else {
                                    $branch->$item = $namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                    if ($columnHeading == $item) {
                                        $branch->save();
                                    }

                                }
                            }
                        }
                    }
                }
                unlink('web_personal/upload/' . $filename);
                //return $this->redirect(['syn/import-excel-test2']);
//                $this->layout = "main_modules";
//                return $this->render('upload', ['model' => $modelFile
//                    ,'test'=>3
//                ]);
            }
        } else {
            $searchModel = new StudenttestSearch();
            $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
            $this->layout = "main_modules";
            return $this->render('upload', [
                'model' => $modelFile,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,

            ]);
        }
    }

    public function actionImportExcelTest()
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
                    $kuy=true;
                    $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
                    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                        ++$r;
                        if($database=="reg_studentmaster") {
                            $branch=new RegStudentmaster();
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
                                        if($columnHeading =="STUDENTID"){$count++;}
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                $count = 0;
                               // var_dump($branch->errors);
                            }
                        }else if($database=="reg_studentbio"){
                            $branch=new RegStudentbio();
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
                                        if($columnHeading =="STUDENTID"){$count++;}
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                $count = 0;
                                //var_dump($branch->errors);
                            }
                        }else if($database=="reg_level"){
                            $branch=new RegLevel();
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
                                        if($columnHeading =="LEVELID"){$count++;}
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                $count = 0;
                                //var_dump($branch->errors);
                            }
                        }else if($database=="reg_program"){
                            $branch=new RegProgram();
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
                                        if($columnHeading =="PROGRAMID"){$count++;}
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                $count = 0;
                                //var_dump($branch->errors);
                            }
                        }else if($database=="reg_faculty"){
                            $branch=new RegFaculty();
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
                                        if($columnHeading =="FACULTYID"){$count++;}
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                $count = 0;
                                //var_dump($branch->errors);
                            }
                        }else if($database=="reg_course"){
                            $branch=new RegCourse();
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
                                        if($columnHeading =="COURSEID"){$count++;}
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                $count = 0;
                                //var_dump($branch->errors);
                            }
                        }else if($database=="reg_department"){
                            $branch=new RegDepartment();
                            $model = $branch->getAttributes(); //Get เเอา attribute name in db
                            foreach (array_keys($model) as $keyModel => $item) {
                                foreach ($headingsArray as $columnKey => $columnHeading) {
                                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                    if ($kuy) {
                                        if (!$branch = RegDepartment::findOne($namedDataArray[$r]["FACULTYID"])) {
                                            $branch = new RegDepartment();
                                        }
                                        $kuy = false;
                                    }
                                    if ($columnHeading == $item) {
                                        $branch->$item = (string)$namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                        if($columnHeading =="FACULTYID"){$count++;}
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                $count = 0;
                                //var_dump($branch->errors);
                            }
                        }else if($database=="reg_officer"){
                            $branch=new RegOfficer();
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
                                        if($columnHeading =="OFFICERID"){$count++;}
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                $count = 0;
                                //var_dump($branch->errors);
                            }
                        }else if($database=="reg_course"){
                            $branch=new RegCourse();
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
                                        if($columnHeading =="COURSEID"){$count++;}
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                $count = 0;
                                //var_dump($branch->errors);
                            }
                        }else if($database=="reg_enroll"){
                            $branch=new RegEnroll();
                            $model = $branch->getAttributes(); //Get เเอา attribute name in db
                            foreach (array_keys($model) as $keyModel => $item) {
                                foreach ($headingsArray as $columnKey => $columnHeading) {
                                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                    if ($kuy) {
                                        if (!$branch = RegEnroll::findOne($namedDataArray[$r]["STUDENTID"])) {
                                            $branch = new RegEnroll();
                                        }
                                        $kuy = false;
                                    }
                                    if ($columnHeading == $item) {
                                        $branch->$item = (string)$namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                        if($columnHeading =="STUDENTID"){$count++;}
                                    }
                                }
                            }
                            if (!$branch->save()) {
                                $count = 0;
                                //var_dump($branch->errors);
                            }
                        }

                    }
                }
                unlink('web_personal/upload/' . $filename);
                if(!$branch->errors){
                    \Yii::$app->getSession()->setFlash('alert1', [
                        'type' => 'success',
                        'duration' => 12000,
                        'icon' => 'fa fa-users',
                        'title' => \Yii::t('app', Html::encode('Submission')),
                        'message' => \Yii::t('app', Html::encode('นำข้อมูลลง Database สำเร็จ')),
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                }else{
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
                    'database'=>$database,
                    'count'=> $count
                ]);
            }
        } else {
//            $searchModel = new StudenttestSearch();
//            $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
            $this->layout = "main_modules";
            return $this->render('upload', [
                'model' => $modelFile,
                'database' => $database,
                'count'=> $count
//                'searchModel' => $searchModel,
//                'dataProvider' => $dataProvider,

            ]);
        }
    }

    public function actionImportExcelTest1()
    {
        $model = new File();
        if ($model->load(\Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'file');
            $filename = 'Data.' . $file->extension;
            $upload = $file->saveAs('web_personal/upload/' . $filename);
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
                $check = 0;

                for ($row = 2; $row <= $highestRow; $row++) {
                    $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);

                    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                        ++$r;
                        //echo"0<br>";  //columnKey => "A","B"  //columnHeading => "id","name"
                        $branch = new Importsql();
                        foreach ($headingsArray as $columnKey => $columnHeading) {
                            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
//                          print_r("<br>");
                            if ($columnHeading == "id") {
                                $branch->id = $namedDataArray[$r][$columnHeading];
                            } else if ($columnHeading == "name") {
                                $branch->name = $namedDataArray[$r][$columnHeading];
                            } else if ($columnHeading == "last_name") {
                                $branch->last_name = $namedDataArray[$r][$columnHeading];
                            } else if ($columnHeading == "age") {
                                $branch->age = $namedDataArray[$r][$columnHeading];
                            }
                        }
                        if (!(Importsql::findOne($dataRow[$row]["A"]))) {
                            $branch->save();
                        }
                        //   return $this->redirect(['site/index']);
                        //if(!$branch->save()) print_r($branch->errors);
                        // print_r($headingsArray["A"]." <br>");
                        // $branch->id = $dataRow[$r][$columnKey];
                    }

                }
                unlink('web_personal/upload/' . $filename);

                // return $this->redirect(['site/index']);

            }
        } else {
            $this->layout = "main_modules";
            return $this->render('upload', ['model' => $model]);
        }
    }

    public function actionTest()
    {
        $request = \Yii::$app->request;
        $database = $request->post('database');
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

            }
            unlink('web_personal/upload/' . $filename);

            $this->layout = "main_modules";
            return $this->render('upload', [
                'model' => $modelFile,
                'test' => $database
            ]);

        } else {
            $this->layout = "main_modules";
            return $this->render('upload', [
                'model' => $modelFile,
                'test' => $database

            ]);

        }
    }

}