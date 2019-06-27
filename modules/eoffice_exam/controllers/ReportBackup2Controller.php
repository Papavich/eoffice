<?php

namespace app\modules\eoffice_exam\controllers;
use Yii;
use app\modules\eoffice_exam\models\Subject;
use app\modules\eoffice_exam\models\SubjectOpen;
use app\modules\eoffice_exam\models\EofficeExamExamination;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use PHPExcel;
use PHPExcel_IOFactory;
use yii\helpers\Html;
use yii\helpers\Url;

class ReportController extends \yii\web\Controller
{
    public function actionReport()
    {
        $this->layout = "main_modules";
        $model = new SubjectOpen;
        $model2 = new Subject;

        return $this->render('report',[
            'model' => $model,
            'model2' => $model2,
            //'listData' => $listData,
        ]);
    }

    public function actionGetRate($subject){
        $subject = Subject::findOne($subject);
        echo Json::encode($subject);

    }

    public function actionExcelRoom() {
        $request = Yii::$app->request;
       $date = Yii::$app->request->post('date');
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel(); //สร้างไฟล์ excel

        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('D1:F1')
            ->setCellValue('D1', 'รายงานห้องสอบ') //กำหนดให้ cell A2 พิมพ์คำว่า Employees Report
            ->setCellValue('A3', 'ห้องสอบ') //กำหนดให้ cell A4 พิมพ์คำว่า employeeNumber
            ->setCellValue('B3', 'แถว') //กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('C3', 'รหัสวิชา') //กำหนดให้ cell C4 พิมพ์คำว่า lastName
            ->setCellValue('D3', 'ชื่อวิชา') //กำหนดให้ cell D4 พิมพ์คำว่า extension
            ->setCellValue('E3', 'วันที่สอบ') //กำหนดให้ cell E4 พิมพ์คำว่า email
            ->setCellValue('F3', 'เวลาเริ่มสอบ') //กำหนดให้ cell D4 พิมพ์คำว่า officeCode
            ->setCellValue('G3', 'เวลาสิ้นสุด'); //กำหนดให้ cell G4 พิมพ์คำว่า reportsTo

        $i = 5; // กำหนดค่า i เป็น 6 เพื่อเริ่มพิมพ์ที่แถวที่ 6

        // Write data from MySQL result
        foreach(EofficeExamExamination::find()->where(['exam_date' => $date])->all() as $item){ //วนลูปหาพนักงานทั้งหมด
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $item["rooms_id"]);
            //กำหนดให้คอลัมม์ A แถวที่ i พิมพ์ค่าของ employeeNumber
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $item["room_tag"]);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $item["subject_id"]);
            $model = Subject::findOne($item["subject_id"]);
            //query หาชื่อจังหวัดที่มีค่าตรงกับ officeCode ของพนักงาน
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $model->subject_namethai);
            // แทนค่าคอลัมม์ที่ F แถวที่  i ด้วย subject_namethai ที่ query ออกมาได้
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $item["exam_date"]);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $item["exam_start_time"]);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $item["exam_end_time"]);
            $i++;
        }

        // Rename sheet
        //$objPHPExcel->getActiveSheet()->setTitle('Employees');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        //$objPHPExcel->setActiveSheetIndex(0);

        // Save Excel 2007 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('ExamRoomReport.xlsx'); // Save File เป็นชื่อ ExamRoomReport.xlsx
        echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web').'/ExamRoomReport.xlsx'), ['class' => 'btn btn-info']);  //สร้าง link download

    }
}
