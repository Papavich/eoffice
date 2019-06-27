<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/19/2018
 * Time: 3:12 PM
 */

namespace app\modules\personsystem\controllers;

use app\modules\personsystem\models\File;
use app\modules\personsystem\models\Importsql;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\UploadedFile;

class UploadController extends Controller
{
    public function actionImportExcel()
    {
        $major = \Yii::$app->request->get( 'major' );
        if (\Yii::$app->request->get( 'major' ) == null)
            $major = Importsql::find()->select('id')->all();

        $modelFile = new File();
        if ($modelFile->load(\Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($modelFile, 'file');
            $filename = 'Data.' . $file->extension;
            $upload = $file->saveAs('web_personal/upload/' . $filename);
            $k =0;
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
                $g = 0;
                $checkID = 0;
                $namedDataArray = array();
                $Import = Importsql::find()->all();
                $qury = Importsql::find()->select('id')->all();
                //  echo $highestRow."<br><br>";
                for ($row = 2; $row <= $highestRow; ++$row) { // วนตามไฟล์ Excel
                    $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
                    //echo $dataRow[$row]['A']." #<br>";
                    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                        ++$r;
                        $branch = new Importsql();
                        $Importsql = new Importsql();
                        $model = $Importsql->getAttributes(); //Get เเอา attribute name in db

                        foreach (array_keys($model) as $item) {
                            //   echo " <b><u>" . $item . "</u></b><br>";
                            foreach ($headingsArray as $columnKey => $columnHeading) {
                                $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                //วนเอาเฉาะ id ของไฟล์
                                $c = -1;

                                foreach ($qury as $value) {
                                    $c++;
                                    // echo $namedDataArray[$r]["id"] . $value->id . "<br>";
                                    if ($namedDataArray[$r]["id"] == $value->id) {
                                        $checkID = 1;
                                        // echo "<b>checkID = $checkID</b><br>";
                                        // echo $namedDataArray[$r][$columnHeading] . "*" . $value->id . "<b>OP</b><br>";
                                    } else {
                                        $checkID = 0;
                                    }
                                    if ($checkID == 1) {
                                        if ($columnHeading != "id" && $columnHeading == $item) { //เช็คหัวตารางกับหัวข้อมูลในไฟล์ Excel ว่าตรงกันหรือไม่
                                            //    echo $columnHeading . "*" . $item . "<b>T</b><br>";
                                            $model = Importsql::findOne($value->id);
                                            $model->$item = $namedDataArray[$r][$columnHeading];
                                            $model->update();
                                        }
                                    }
                                    else if ($checkID == 0 && $columnHeading == $item) {
                                        $branch->$item = $namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                      //  echo "checkID = 0<br>";
                                    }
                                }
                            }
                        }
                        if (!(Importsql::findOne($dataRow[$row]["A"]))) {
                            $branch->save();
                            //  echo "error";
                        }
                    }
                }
//                unlink('web_personal/upload/' . $filename);
//                return $this->redirect(['upload/import-excel']);
                $this->layout = "main_modules";
                return $this->render('upload', ['model' => $modelFile
                    ,'test'=>3
                ]);
            }
        } else {
            $this->layout = "main_modules";
            return $this->render('upload',
                [
                    'model' => $modelFile,
                    'major' => $major

                ]);
        }


    }
}