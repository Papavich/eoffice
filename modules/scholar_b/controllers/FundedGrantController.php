<?php

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;
use app\modules\scholar_b\models\ScbFundedType;
use app\modules\scholar_b\models\ScbStudent;
use app\modules\scholar_b\models\ScbYearHasSemester;
use Yii;
use app\modules\scholar_b\models\ScbFunded;
use app\modules\scholar_b\models\ScbFundedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;


class FundedGrantController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ScbFundedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($student_id, $funded_type_id, $funded_date, $year, $semester)
    {
        $funded_type = ScbFundedType::find()->all();
        $year_semester = ScbYearHasSemester::find()->all();
        // $main_test = EofficeMainTest::find()->where(['user_id'=>$student_id])->one();
        $main_full = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $student_id])->one();
        return $this->render('view', [
            'model_funded' => $this->findModel($student_id, $funded_type_id, $funded_date, $year, $semester),
            'funded_type' => $funded_type,
            'year_semester' => $year_semester,
            'main_full' => $main_full
        ]);
    }

    public function actionCreate()
    {
        $model_funded = new ScbFunded();
        $funded_type = ScbFundedType::find()->all();
        $year_semester = ScbYearHasSemester::find()->all();
        if ($model_funded->load(Yii::$app->request->post()) && $model_funded->save()) {
            return $this->redirect(['view',
                'student_id' => $model_funded->student_id,
                'funded_type_id' => $model_funded->funded_type_id,
                'funded_date' => $model_funded->funded_date,
                'year' => $model_funded->year,
                'semester' => $model_funded->semester]);
        }

        $this->layout = "main_module";
        return $this->render('create', [
            'model_funded' => $model_funded,
            'funded_type' => $funded_type,
            'year_semester' => $year_semester
        ]);
    }

    public function actionGetstd()
    {
        $id = Yii::$app->request->get('student');
        $model_std = ScbStudent::find()->where(['student_id' => $id])->one();
        //   $main_test = EofficeMainTest::find()->where(['user_id'=>$id])->one();
        $main_full = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $id])->one();
        if ($main_full)
            echo "<label>$main_full->PREFIXNAME$main_full->STUDENTNAME  $main_full->STUDENTSURNAME</label> <br><label>สาขาวิชา$main_full->major_name </label>";
        else
            echo "<label>รหัสไม่ถูกต้อง : ไม่พบข้อมูลนักศึกษา</label>";

    }


    public function actionCheckid()
    {
        $id = Yii::$app->request->get('student');
        $main_full = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $id])->one();
        if ($main_full)
            echo "<font color='#00ced1'>รหัสถูกต้อง : $main_full->PREFIXNAME$main_full->STUDENTNAME  $main_full->STUDENTSURNAME</font>";
        else
            echo "<font color='#dc143c'>รหัสไม่ถูกต้อง : ไม่พบข้อมูลนักศึกษา</font>";
    }


    public function actionUpdate($student_id, $funded_type_id, $funded_date, $year, $semester)
    {

        $model_funded = $this->findModel($student_id, $funded_type_id, $funded_date, $year, $semester);
        $funded_type = ScbFundedType::find()->all();
        $year_semester = ScbYearHasSemester::find()->all();
        // $main_test = EofficeMainTest::find()->where(['user_id'=>$model_funded->student_id])->one();
        $main_full = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $model_funded->student_id])->one();
        if ($model_funded->load(Yii::$app->request->post()) && $model_funded->save()) {
            return $this->redirect(['view', 'student_id' => $model_funded->student_id, 'funded_type_id' => $model_funded->funded_type_id, 'funded_date' => $model_funded->funded_date, 'year' => $model_funded->year, 'semester' => $model_funded->semester]);
        }

        $this->layout = "main_module";
        return $this->render('update', [
            'model_funded' => $model_funded,
            'funded_type' => $funded_type,
            'year_semester' => $year_semester,
            'main_full' => $main_full
        ]);
    }

    public function actionDelete($student_id, $funded_type_id, $funded_date, $year, $semester)
    {
        $this->findModel($student_id, $funded_type_id, $funded_date, $year, $semester)->delete();

        return $this->redirect(['index']);
    }

    public function actionFundedGrantByPerson()
    {
        $year = ScbYearHasSemester::find()->select('year')->distinct()->all();
        $this->layout = "main_module";
        return $this->render('funded-grant-by-person', ['year' => $year]);
    }

    public function actionFundedJs()
    {
        if (Yii::$app->request->get()) {
            $studentId = Yii::$app->request->get('key');
            $year = Yii::$app->request->get('sem');
            $main_full = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $studentId])->one();

            Yii::$app->thaiFormatter->locale = 'th_TH';

            if ($studentId != null) {
                $show = " 
    <div class=\"panel panel-info\">
      <div class=\"panel-heading\">
       
        <div class=\"row\">
        <div class=\"col-md-4\">
        </div>
        <div class=\"col-md-4\">
            <center><b>ข้อมูลการเบิกจ่ายนักศึกษาทุนรายบุคคล</b></center>
        </div>
        <div class=\"col-md-2\">
        </div>
            <div class=\"col-md-1\">
                
            </div>
            <div class=\"col-md-1\">
                <a href='../funded-grant/excel-fg-by-person?studentId=$studentId&year=$year' id=\"report\" class=\"btn btn-xs btn-primary btn-3d\"><i
                            class=\"fa fa-file-excel-o\"></i>Excel
                </a>
            </div>
        </div>
                    
        
        
        
      </div>
      <div class=\"panel-body\">
      
      <div class='row'>
         <div class='col-md-4'>
            <label>ชื่อ-สกุล : $main_full->PREFIXNAME$main_full->STUDENTNAME  $main_full->STUDENTSURNAME</label>
        </div>
        <div class='col-md-4'>
            <label>เลขประจำตัวนักศึกษา : $main_full->STUDENTCODE</label>
        </div>
        <div class='col-md-4'>
            <label>สาขาวิชา$main_full->major_name </label>
        </div>
      </div>
      
      <div class='row'>
         <div class='col-md-4'>
            <label>ระดับการศึกษา : $main_full->LEVELNAME</label>
        </div>
        <div class='col-md-4'>
            <label>ปีที่เข้าศึกษา : " . Yii::$app->formatter->asDate($main_full->ADMITDATE, 'long') . "</label>
        </div>
        <div class='col-md-4'>
            <label>ปีที่สำเร็จศึกษา : " . Yii::$app->formatter->asDate($main_full->FINISHDATE, 'long') . "</label>
        </div>
      </div>
      
      <div class='row'>
         <div class='col-md-4'>
            <label>อาจารย์ที่ปรึกษา : อาจารย์$main_full->OFFICERNAME  $main_full->OFFICERSURNAME</label>
        </div>
        
      </div>
      
    </div>
 
</thead>
 <table id=\"table1\" class=\"table table-striped table-hover table-bordered\">
                                <thead style='background-color: #d9edf7'>
                                <tr>
                                    <th>รายการเบิกจ่าย</th>
                                    <th>ปีการศึกษา</th>
                                    <th>จำนวนเงิน</th>
                                    <th>วันที่เบิกจ่าย</th>
                                   
                                </tr>
                                </thead><tbody>";
            }

            if ($year == 0) {
                $years = ScbFunded::find()->select('year')->where(['student_id' => $studentId])->distinct()->all();
                foreach ($years as $row) {
                    $data1 = ScbFunded::find()->FilterWhere(['like', 'funded_type_id', 1101])->andWhere(['year' => $row->year, 'student_id' => $studentId])->one();
                    if ($data1) {
                        $show = $show . "<tr><td>" . $data1->fundedname->funded_type_name . "</td><td>" . $data1->year . "</td><td>" . $data1->funded_amount . "</td><td>" . Yii::$app->formatter->asDate($data1->funded_date, 'long') . "</td><tr>";
                    }
                    $data2 = ScbFunded::find()->FilterWhere(['like', 'funded_type_id', 1102])->andWhere(['year' => $row->year, 'student_id' => $studentId])->one();
                    if ($data2) {
                        $show = $show . "<tr><td>" . $data2->fundedname->funded_type_name . "</td><td>" . $data2->year . "</td><td>" . $data2->funded_amount . "</td><td>" . Yii::$app->formatter->asDate($data2->funded_date, 'long') . "</td><tr>";

                    }
                    $data3 = ScbFunded::find()->FilterWhere(['like', 'funded_type_id', 1103])->andWhere(['year' => $row->year, 'student_id' => $studentId])->one();
                    if ($data3) {
                        $show = $show . "<tr><td>" . $data3->fundedname->funded_type_name . "</td><td>" . $data3->year . "</td><td>" . $data3->funded_amount . "</td><td>" . Yii::$app->formatter->asDate($data3->funded_date, 'long') . "</td><tr>";

                    }
                }
                $data = ScbFunded::find()->FilterWhere(['like', 'funded_type_id', 12])->andWhere(['student_id' => $studentId])->orderBy(['funded_date' => SORT_ASC])->all();
                if ($data) {
                    foreach ($data as $row) {
                        $show = $show . "<tr><td>" . $row->fundedname->funded_type_name . "</td><td>" . $row->year . "</td><td>" . $row->funded_amount . "</td><td>" . Yii::$app->formatter->asDate($row->funded_date, 'long') . "</td><tr>";

                    }
                }

                $show = $show . "     </tbody>
                            </table>";
                echo $show;
            } else if ($year != 0) {
                $model = ScbFunded::find()->where(['student_id' => $studentId, 'year' => $year])->orderBy(['funded_type_id' => SORT_ASC])->all();
                if ($model) {
                    foreach ($model as $row) {
                        $show = $show . "<tr><td>" . $row->fundedname->funded_type_name . "</td><td>" . $row->year . "</td><td>" . $row->funded_amount . "</td><td>" . Yii::$app->formatter->asDate($row->funded_date, 'long') . "</td><tr>";

                    }
                    $show = $show . "     </tbody>
                                            </table>";
                    echo $show;
                } else {
                    echo "ไม่พบข้อมูล";
                }

            }
        }
    }


    public function actionExcelFgByPerson($studentId, $year)
    {

        $main_full = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $studentId])->one();


        $objPHPExcel = new PHPExcel();

        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

        $objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true)->applyFromArray($style);
        $objPHPExcel->getActiveSheet()->getStyle('A4:E7')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A9:E9')->applyFromArray($style)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getRowDimension('1:50')->setRowHeight(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A2:E2')
            ->mergeCells('A4:B4')
            ->mergeCells('A5:B5')
            ->mergeCells('A6:B6')
            ->mergeCells('C4:E4')
            ->mergeCells('C5:E5')
            ->mergeCells('C6:E6')
            ->mergeCells('C7:E7')
            ->setCellValue('A2', 'ข้อมูลการเบิกจ่ายนักศึกษาทุนรายบุคคล')
            ->setCellValue('A4', 'ชื่อ-สกุล' . ' : ' . $main_full->PREFIXNAME . $main_full->STUDENTNAME . '  ' . $main_full->STUDENTSURNAME)//กำหนดให้ cell A4 พิมพ์คำว่า employeeNumber
            // ->setCellValue('A4', $main_full->PREFIXNAME.$main_full->STUDENTNAME.'  '.$main_full->STUDENTSURNAME)//กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('C4', 'เลขประจำตัวนักศึกษา : ' . $main_full->STUDENTCODE)
            // ->setCellValue('D4', $main_full->STUDENTCODE)
            ->setCellValue('A5', 'สาขา' . $main_full->major_name)
            // ->setCellValue('F4', $main_full->major_name)
            ->setCellValue('A7', 'ระดับการศึกษา' . ' : ' . $main_full->LEVELNAME)
            // ->setCellValue('B5', $main_full->LEVELNAME)
            ->setCellValue('C5', 'ปีที่เข้าศึกษา : ' . Yii::$app->formatter->asDate($main_full->ADMITDATE, 'long'))
            //  ->setCellValue('D5', Yii::$app->formatter->asDate($main_full -> ADMITDATE, 'long'))
            ->setCellValue('C6', 'ปีที่จบการศึกษา : ' . Yii::$app->formatter->asDate($main_full->FINISHDATE, 'long'))
            // ->setCellValue('F5', Yii::$app->formatter->asDate($main_full -> FINISHDATE, 'long'))
            ->setCellValue('A6', 'อาจารย์ที่ปรึกษา' . ' : อาจารย์' . $main_full->OFFICERNAME . '  ' . $main_full->OFFICERSURNAME)
            // ->setCellValue('B6', 'อาจารย์'.$main_full->OFFICERNAME.'  '.$main_full->OFFICERSURNAME)
            ->setCellValue('A9', 'รายการเบิกจ่าย')//กำหนดให้ cell C4 พิมพ์คำว่า lastName
            ->setCellValue('B9', 'ปีการศึกษา')//กำหนดให้ cell D4 พิมพ์คำว่า extension
            ->setCellValue('C9', 'ภาคการศึกษา')
            ->setCellValue('D9', 'จำนวนเงิน')//กำหนดให้ cell E4 พิมพ์คำว่า email
            ->setCellValue('E9', 'วันที่เบิกจ่าย');//กำหนดให้ cell D4 พิมพ์คำว่า officeCode
        $i = 10; // กำหนดค่า i เป็น 6 เพื่อเริ่มพิมพ์ที่แถวที่ 6

        if ($year == 0) {
            $years = ScbFunded::find()->select('year')->where(['student_id' => $studentId])->distinct()->all();
            foreach ($years as $row) {
                $data1 = ScbFunded::find()->FilterWhere(['like', 'funded_type_id', 1101])->andWhere(['year' => $row->year, 'student_id' => $studentId])->one();
                if ($data1) {
                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data1->fundedname->funded_type_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data1["year"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data1["semester"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $data1["funded_amount"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, Yii::$app->formatter->asDate($data1->funded_date, 'long'));
                    $i++;
                }
                $data2 = ScbFunded::find()->FilterWhere(['like', 'funded_type_id', 1102])->andWhere(['year' => $row->year, 'student_id' => $studentId])->one();
                if ($data2) {
                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data2->fundedname->funded_type_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data2["year"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data2["semester"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $data2["funded_amount"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, Yii::$app->formatter->asDate($data2->funded_date, 'long'));
                    $i++;
                }
                $data3 = ScbFunded::find()->FilterWhere(['like', 'funded_type_id', 1103])->andWhere(['year' => $row->year, 'student_id' => $studentId])->one();
                if ($data3) {
                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data3->fundedname->funded_type_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data3["year"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data3["semester"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $data3["funded_amount"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, Yii::$app->formatter->asDate($data3->funded_date, 'long'));
                    $i++;
                }
            }
            $data = ScbFunded::find()->FilterWhere(['like', 'funded_type_id', 12])->andWhere(['student_id' => $studentId])->orderBy(['funded_date' => SORT_ASC])->all();
            if ($data) {
                foreach ($data as $row) {
                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $row->fundedname->funded_type_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $row["year"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $row["semester"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $row["funded_amount"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, Yii::$app->formatter->asDate($row->funded_date, 'long'));
                    $i++;
                }
            }
        } else if ($year != 0) {
            $model = ScbFunded::find()->where(['student_id' => $studentId, 'year' => $year])->orderBy(['funded_type_id' => SORT_ASC])->all();
            if ($model) {
                foreach ($model as $row) {
                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $row->fundedname->funded_type_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $row["year"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $row["semester"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $row["funded_amount"]);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, Yii::$app->formatter->asDate($row->funded_date, 'long'));
                    $i++;
                }
            }
        }

        $i--;
        $objPHPExcel->getActiveSheet()->getStyle('A9:E' . $i)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="FundedGrantByPerson"' . $studentId . '.xlsx"');
        header('Cache-Control: max-age=0');


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;

        // Rename sheet
        //$objPHPExcel->getActiveSheet()->setTitle('Employees');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        //$objPHPExcel->setActiveSheetIndex(0);

        // Save Excel 2007 file
        // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //   $objWriter->save('web_scb/export/excel/FundedGrantByPerson'.$studentId.'.xlsx'); // Save File เป็นชื่อ myData.xlsx
        // $link = \Yii::getAlias('@web') . '/web_scb/export/excel/FundedGrantByPerson'.$studentId.'.xlsx';
        // echo $link;
        //  echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/web_scb/export/excel/FundedGrantByPerson'.$studentId.'.xlsx'), ['class' => 'btn btn-info']);  //สร้าง link download

    }


    protected function findModel($student_id, $funded_type_id, $funded_date, $year, $semester)
    {
        if (($model = ScbFunded::findOne(['student_id' => $student_id, 'funded_type_id' => $funded_type_id, 'funded_date' => $funded_date, 'year' => $year, 'semester' => $semester])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
