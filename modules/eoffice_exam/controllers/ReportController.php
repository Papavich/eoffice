<?php

namespace app\modules\eoffice_exam\controllers;
use app\modules\eoffice_exam\models\EofficeExamExaminationItem;
use app\modules\eoffice_exam\models\EofficeExamInvigilate;
use Yii;
use app\modules\eoffice_exam\models\Subject;
use app\modules\eoffice_exam\models\SubjectOpen;
use app\modules\eoffice_exam\models\ExamDetailExamination;
use app\modules\eoffice_exam\models\EofficeExamExamination;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use PHPExcel;
use PHPExcel_IOFactory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Alert;

class ReportController extends \yii\web\Controller
{
    public function actionReport()
    {
        $this->layout = "main_modules";
        $latestyear = ExamDetailExamination::find()
            ->orderBy(['TimeStamp' => SORT_ASC])->where('rownum' < 2 )->all();
        foreach ($latestyear as $item) {
            $subopen_year = $item->subopen_year;
            $exam_detail_date_start = $item->exam_detail_date_start;
            $exam_detail_date_end = $item->exam_detail_date_end;
            $subopen_semester = $item->subopen_semester;
            $Examcode = $item->Examcode;
        }

        $model = new ExamDetailExamination;
        $model->load(Yii::$app->request->post());
        return $this->render('report',[
            'model' => $model,
            'subopen_year' => $subopen_year,
            'exam_detail_date_start' => $exam_detail_date_start,
            'exam_detail_date_end' => $exam_detail_date_end,
            'subopen_semester' => $subopen_semester,
            'Examcode' => $Examcode,
        ]);
    }

    public function actionReportstd()
    {
        $this->layout = "main_modules";
        $latestyear = ExamDetailExamination::find()
            ->orderBy(['TimeStamp' => SORT_ASC])->where('rownum' < 2 )->all();
        foreach ($latestyear as $item) {
            $subopen_year = $item->subopen_year;
            $exam_detail_date_start = $item->exam_detail_date_start;
            $exam_detail_date_end = $item->exam_detail_date_end;
            $subopen_semester = $item->subopen_semester;
            $Examcode = $item->Examcode;
        }

        $model = new ExamDetailExamination;
        $model->load(Yii::$app->request->post());
        return $this->render('report',[
            'model' => $model,
            'subopen_year' => $subopen_year,
            'exam_detail_date_start' => $exam_detail_date_start,
            'exam_detail_date_end' => $exam_detail_date_end,
            'subopen_semester' => $subopen_semester,
            'Examcode' => $Examcode,
        ]);
    }

    public function actionReportinv()
    {
        $this->layout = "main_modules";
        $latestyear = ExamDetailExamination::find()
            ->orderBy(['TimeStamp' => SORT_ASC])->where('rownum' < 2 )->all();
        foreach ($latestyear as $item) {
            $subopen_year = $item->subopen_year;
            $exam_detail_date_start = $item->exam_detail_date_start;
            $exam_detail_date_end = $item->exam_detail_date_end;
            $subopen_semester = $item->subopen_semester;
            $Examcode = $item->Examcode;
        }

        $model = new ExamDetailExamination;
        $model->load(Yii::$app->request->post());
        return $this->render('report',[
            'model' => $model,
            'subopen_year' => $subopen_year,
            'exam_detail_date_start' => $exam_detail_date_start,
            'exam_detail_date_end' => $exam_detail_date_end,
            'subopen_semester' => $subopen_semester,
            'Examcode' => $Examcode,
        ]);
    }

    public function actionGetRate($subject){
        $subject = Subject::findOne($subject);
        echo Json::encode($subject);

    }

    public function actionExcelRoom() {
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $Start_Date = Yii::$app->request->post('startDate');
        $End_Date = Yii::$app->request->post('endDate');

        //count days
        $startTimeStamp = strtotime($Start_Date);
        $endTimeStamp = strtotime($End_Date);

        $timeDiff = abs($endTimeStamp - $startTimeStamp);

        $numberDays = ($timeDiff / 86400) + 1;  // 86400 seconds in one day

// and you might want to convert to integer
        $numberDays = intval($numberDays);
        $session['numberDays'] = $numberDays;

//show date
        $dateArray = [];
        for ($i = $startTimeStamp; $i <= $endTimeStamp; $i += 86400) {
            $dateArr = date("Y-m-d", $i);
            array_push($dateArray, $dateArr);
            //echo date("Y-m-d", $i) . '<br />';
        }
        $session['date'] = $dateArray;
//        print_r($dateArray);
// end count days


        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel(); //สร้างไฟล์ excel
//
        $center= array(
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ));

        $centerV= array(
            'alignment' => array(
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ));

        $Border = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        for ($row=1;$row<500;$row++){
            $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
        }
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($centerV);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('A')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('B')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('D')->applyFromArray($center);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(45);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);


        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:D1')
            ->setCellValue('A1', 'รายงานห้องสอบ') //กำหนดค่าให้ cell
            ->setCellValue('A3', 'วันที่')
            ->setCellValue('B3', 'เวลาสอบ')
            ->setCellValue('C3', 'ชื่อวิชา')
            ->setCellValue('D3', 'ห้องสอบ');


        // Write data from MySQL result

        // Query นักศึกษาทั้งหมดและตัดวิชาที่ซ้ำ //
//            for ($j = 0 ; $j < $session['numberDays'] ; $j++) {
        $session = Yii::$app->session;
        $AllExam = [];
        $modelExam = EofficeExamExamination::find()
            ->where(['exam_date' => $session['date']['' . 0]])
            ->orderBy(['subject_id' => SORT_ASC])
            ->all();
        foreach ($modelExam as $item) {
            $exam = [];
            $exam['rooms_id'] = $item->rooms_id;
            $exam['subject_id'] = $item->subject_id;
            $exam['subject_name'] = $item->subname->subject_nameeng;
            $exam['program_class'] = $item->program_class;
            $exam['exam_date'] = $item->exam_date;
            $exam['exam_start_time'] = $item->exam_start_time;
            $exam['exam_end_time'] = $item->exam_end_time;
            array_push($AllExam, $exam);
        }
        $test = count($AllExam);
        $test+=3;
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A4:A'.$test);
        $objPHPExcel->getActiveSheet()->setCellValue('A4',$AllExam[0]['exam_date']);

//        }

        $AllExam1 = [];
        $modelExam = EofficeExamExamination::find()
            ->where(['exam_date' => $session['date']['' . 0]])
            ->andwhere(['exam_start_time' => '08.30'])
            ->orderBy(['subject_id' => SORT_ASC])
            ->all();
        foreach ($modelExam as $item) {
            $exam = [];
            $exam['rooms_id'] = $item->rooms_id;
            $exam['subject_id'] = $item->subject_id;
            $exam['subject_name'] = $item->subname->subject_nameeng;
            $exam['program_class'] = $item->program_class;
            $exam['exam_date'] = $item->exam_date;
            $exam['exam_start_time'] = $item->exam_start_time;
            $exam['exam_end_time'] = $item->exam_end_time;
            array_push($AllExam1, $exam);
        }
//        echo "<pre>";
//        print_r($AllExam1);
//        echo "</pre>";

        $morning = count($AllExam1);
        $morning+=3;
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B4:B'.$morning);
        $objPHPExcel->getActiveSheet()->setCellValue('B4',$AllExam1[0]['exam_start_time'].' - '.$AllExam1[0]['exam_end_time'].' น.');

        $ex=4;
        for ($examm=0;$examm<count($AllExam1);$examm++){
            //$objPHPExcel->getActiveSheet()->setCellValue('B' . $ex,$AllExam[$examm]['exam_start_time'].' - '.$AllExam[$examm]['exam_end_time'].' น.');
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $ex,$AllExam1[$examm]['subject_id'].' : '.$AllExam1[$examm]['subject_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $ex,$AllExam1[$examm]['rooms_id']);
            $ex++;
        }

        $AllExam2 = [];
        $modelExam = EofficeExamExamination::find()
            ->where(['exam_date' => $session['date']['' . 0]])
            ->andwhere(['exam_start_time' => '13.00'])
            ->orderBy(['subject_id' => SORT_ASC])
            ->all();
        foreach ($modelExam as $item) {
            $exam = [];
            $exam['rooms_id'] = $item->rooms_id;
            $exam['subject_id'] = $item->subject_id;
            $exam['subject_name'] = $item->subname->subject_nameeng;
            $exam['program_class'] = $item->program_class;
            $exam['exam_date'] = $item->exam_date;
            $exam['exam_start_time'] = $item->exam_start_time;
            $exam['exam_end_time'] = $item->exam_end_time;
            array_push($AllExam2, $exam);
        }
//        echo "<pre>";
//        print_r($AllExam2);
//        echo "</pre>";
        $afternoon = count($AllExam2);
        $morning+=1;
        $afternoon+=$morning;
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.$morning.':B'.$afternoon);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$morning,$AllExam2[0]['exam_start_time'].' - '.$AllExam[0]['exam_end_time'].' น.');

        $ex2=$morning;
        for ($examm2=0;$examm2<count($AllExam2);$examm2++){
            //$objPHPExcel->getActiveSheet()->setCellValue('B' . $ex,$AllExam[$examm]['exam_start_time'].' - '.$AllExam[$examm]['exam_end_time'].' น.');
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $ex2,$AllExam2[$examm2]['subject_id'].' : '.$AllExam2[$examm2]['subject_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $ex2,$AllExam2[$examm2]['rooms_id']);
            $ex2++;
        }

        // Rename sheet
        //$objPHPExcel->getActiveSheet()->setTitle('Employees');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        //$objPHPExcel->setActiveSheetIndex(0);

        // Save Excel 2007 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('ExamRoomReport.xlsx'); // Save File เป็นชื่อ ExamRoomReport.xlsx

        echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web').'/ExamRoomReport.xlsx'),
            ['class' => 'btn btn-info']);  //สร้าง link download

    } //รายงานห้อง ไม่มีชื่อผู้คุมสอบ

    public function actionExcelRoom2() {
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $Start_Date = Yii::$app->request->post('startDate');
        $End_Date = Yii::$app->request->post('endDate');

        //count days
        $startTimeStamp = strtotime($Start_Date);
        $endTimeStamp = strtotime($End_Date);

        $timeDiff = abs($endTimeStamp - $startTimeStamp);

        $numberDays = ($timeDiff / 86400) + 1;  // 86400 seconds in one day

// and you might want to convert to integer
        $numberDays = intval($numberDays);
        $session['numberDays'] = $numberDays;

//show date
        $dateArray = [];
        for ($i = $startTimeStamp; $i <= $endTimeStamp; $i += 86400) {
            $dateArr = date("Y-m-d", $i);
            array_push($dateArray, $dateArr);
            //echo date("Y-m-d", $i) . '<br />';
        }
        $session['date'] = $dateArray;
//        print_r($dateArray);
// end count days


        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel(); //สร้างไฟล์ excel
//
        $center= array(
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ));

        $centerV= array(
            'alignment' => array(
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ));

        $Border = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        for ($row=1;$row<500;$row++){
            $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
        }
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($centerV);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('A')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('B')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('D')->applyFromArray($center);
//        $objPHPExcel->getActiveSheet()->getStyle('E3:J3')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(45);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);

        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1')
            ->setCellValue('A1', 'รายงานห้องสอบ') //กำหนดค่าให้ cell
            ->setCellValue('A3', 'วันที่')
            ->setCellValue('B3', 'เวลาสอบ')
            ->setCellValue('C3', 'ชื่อวิชา')
            ->setCellValue('D3', 'ห้องสอบ')
            ->setCellValue('E3', 'กรรมการคุมสอบ')
            ->setCellValue('F3', 'ลายมือชื่อผู้รับข้อสอบ')
            ->setCellValue('G3', 'จำนวนซอง')
            ->setCellValue('H3', 'ลายมือชื่อผู้ส่งข้อสอบ')
            ->setCellValue('I3', 'จำนวนซอง')
            ->setCellValue('J3', 'คณะที่มีนักศึกษาลงทะเบียน');


        // Write data from MySQL result

        // Query นักศึกษาทั้งหมดและตัดวิชาที่ซ้ำ //
//            for ($j = 0 ; $j < $session['numberDays'] ; $j++) {
        $session = Yii::$app->session;
        $AllExam = [];
        $modelExam = EofficeExamExamination::find()
            ->where(['exam_date' => $session['date']['' . 0]])
            ->orderBy(['subject_id' => SORT_ASC])
            ->all();
        foreach ($modelExam as $item) {
            $exam = [];
            $exam['rooms_id'] = $item->rooms_id;
            $exam['subject_id'] = $item->subject_id;
            $exam['subject_name'] = $item->subname->subject_nameeng;
            $exam['program_class'] = $item->program_class;
            $exam['exam_date'] = $item->exam_date;
            $exam['exam_start_time'] = $item->exam_start_time;
            $exam['exam_end_time'] = $item->exam_end_time;
            array_push($AllExam, $exam);
        }

        $countExam = array_count_values(array_column($AllExam, 'rooms_id')); //นับจำนวนที่ซ้ำกัน

        $test = count($AllExam);
        $test+=3;
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A4:A'.$test);
        $objPHPExcel->getActiveSheet()->setCellValue('A4',$AllExam[0]['exam_date']);

//        }

        $AllExam1 = [];
        $modelExam = EofficeExamExamination::find()
            ->where(['exam_date' => $session['date']['' . 0]])
            ->andwhere(['exam_start_time' => '08.30'])
            ->orderBy(['subject_id' => SORT_ASC])
            ->all();
        foreach ($modelExam as $item) {
            $exam = [];
            $exam['rooms_id'] = $item->rooms_id;
            $exam['subject_id'] = $item->subject_id;
            $exam['subject_name'] = $item->subname->subject_nameeng;
            $exam['program_class'] = $item->program_class;
            $exam['exam_date'] = $item->exam_date;
            $exam['exam_start_time'] = $item->exam_start_time;
            $exam['exam_end_time'] = $item->exam_end_time;
            array_push($AllExam1, $exam);
        }
//        echo "<pre>";
//        print_r($AllExam1);
//        echo "</pre>";

        $morning = count($AllExam1);
        $morning+=3;
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B4:B'.$morning);
        $objPHPExcel->getActiveSheet()->setCellValue('B4',$AllExam1[0]['exam_start_time'].' - '.$AllExam1[0]['exam_end_time'].' น.');

        $ex=4;
        $AllInvigilate = [];
        for ($examm=0;$examm<count($AllExam1);$examm++){
            //$objPHPExcel->getActiveSheet()->setCellValue('B' . $ex,$AllExam[$examm]['exam_start_time'].' - '.$AllExam[$examm]['exam_end_time'].' น.');
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $ex,$AllExam1[$examm]['subject_id'].' : '.$AllExam1[$examm]['subject_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $ex,$AllExam1[$examm]['rooms_id']);
            $AllInv = [];
            $modelInv = EofficeExamInvigilate::find()
                ->where(['exam_date' => $session['date']['' . 0]])
                ->andwhere(['rooms_id' => $AllExam1[$examm]['rooms_id']])
                ->andwhere(['examstart_time' => '08.30'])
                ->all();
            foreach ($modelInv as $item) {
                $INV = [];
//                $INV['person_id'] = $item->person_id;
                $INV['prefix'] = $item->pername->PREFIXABB;
                $INV['person_fname'] = $item->pername->person_name;
                $INV['person_lname'] = $item->pername->person_surname;
                $INV['exam_date'] = $item->exam_date;
                $INV['examstart_time'] = $item->examstart_time;
                $INV['exam_end_time'] = $item->exam_end_time;
                $INV['rooms_id'] = $item->rooms_id;
                array_push($AllInv, $INV);
            }
            $AllInvigilate[$AllExam1[$examm]['rooms_id']] = $AllInv;
//            echo count($AllInvigilate[$AllExam1[$examm]['rooms_id']])."<br>";
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $ex,$AllInvigilate[$AllExam1[$examm]['rooms_id']][0]['person_fname'].','.$AllInvigilate[$AllExam1[$examm]['rooms_id']][1]['person_fname']);
            $ex++;
        }
//        echo "<pre>";
//        print_r($AllInvigilate);
//        echo "</pre>";

        $AllExam2 = [];
        $modelExam = EofficeExamExamination::find()
            ->where(['exam_date' => $session['date']['' . 0]])
            ->andwhere(['exam_start_time' => '13.00'])
            ->orderBy(['subject_id' => SORT_ASC])
            ->all();
        foreach ($modelExam as $item) {
            $exam = [];
            $exam['rooms_id'] = $item->rooms_id;
            $exam['subject_id'] = $item->subject_id;
            $exam['subject_name'] = $item->subname->subject_nameeng;
            $exam['program_class'] = $item->program_class;
            $exam['exam_date'] = $item->exam_date;
            $exam['exam_start_time'] = $item->exam_start_time;
            $exam['exam_end_time'] = $item->exam_end_time;
            array_push($AllExam2, $exam);
        }

        $afternoon = count($AllExam2);
        $morning+=1;
        $afternoon+=$morning;
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.$morning.':B'.$afternoon);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$morning,$AllExam2[0]['exam_start_time'].' - '.$AllExam[0]['exam_end_time'].' น.');

        $ex2=$morning;
        for ($examm2=0;$examm2<count($AllExam2);$examm2++){
            //$objPHPExcel->getActiveSheet()->setCellValue('B' . $ex,$AllExam[$examm]['exam_start_time'].' - '.$AllExam[$examm]['exam_end_time'].' น.');
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $ex2,$AllExam2[$examm2]['subject_id'].' : '.$AllExam2[$examm2]['subject_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $ex2,$AllExam2[$examm2]['rooms_id']);
            $AllInv = [];
            $modelInv = EofficeExamInvigilate::find()
                ->where(['exam_date' => $session['date']['' . 0]])
                ->andwhere(['rooms_id' => $AllExam2[$examm2]['rooms_id']])
                ->andwhere(['examstart_time' => '13.00'])
                ->all();
            foreach ($modelInv as $item) {
                $INV = [];
//                $INV['person_id'] = $item->person_id;
                $INV['prefix'] = $item->pername->PREFIXABB;
                $INV['person_fname'] = $item->pername->person_name;
                $INV['person_lname'] = $item->pername->person_surname;
                $INV['exam_date'] = $item->exam_date;
                $INV['examstart_time'] = $item->examstart_time;
                $INV['exam_end_time'] = $item->exam_end_time;
                $INV['rooms_id'] = $item->rooms_id;
                array_push($AllInv, $INV);
            }
            $AllInvigilate[$AllExam2[$examm2]['rooms_id']] = $AllInv;
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $ex2,$AllInvigilate[$AllExam2[$examm2]['rooms_id']][0]['person_fname'].','.$AllInvigilate[$AllExam2[$examm2]['rooms_id']][1]['person_fname']);
            $ex2++;
        }
        $objPHPExcel->getActiveSheet()->getStyle('A3:J'.$afternoon)->applyFromArray($Border);

        // Rename sheet
        //$objPHPExcel->getActiveSheet()->setTitle('Employees');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        //$objPHPExcel->setActiveSheetIndex(0);

        // Save Excel 2007 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('SignRoomReport.xlsx'); // Save File เป็นชื่อ ExamRoomReport.xlsx

        echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web').'/SignRoomReport.xlsx'),
            ['class' => 'btn btn-info']);  //สร้าง link download

    } //รายงานห้อง มีชื่อผู้คุมสอบ

    public function actionExcelStudent() {
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $Start_Date = Yii::$app->request->post('startDate');
        $End_Date = Yii::$app->request->post('endDate');

        //count days
        $startTimeStamp = strtotime($Start_Date);
        $endTimeStamp = strtotime($End_Date);

        $timeDiff = abs($endTimeStamp - $startTimeStamp);

        $numberDays = ($timeDiff / 86400) + 1;  // 86400 seconds in one day

// and you might want to convert to integer
        $numberDays = intval($numberDays);
        $session['numberDays'] = $numberDays;

//show date
        $dateArray = [];
        for ($i = $startTimeStamp; $i <= $endTimeStamp; $i += 86400) {
            $dateArr = date("Y-m-d", $i);
            array_push($dateArray, $dateArr);
            //echo date("Y-m-d", $i) . '<br />';
        }
        $session['date'] = $dateArray;
//        print_r($dateArray);
// end count days


        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel(); //สร้างไฟล์ excel

        //First sheet
        $sheet = $objPHPExcel->getActiveSheet();
//        $sheet=0;
//        while ($sheet < $numberDays){
//
//            // Add new sheet
//            $objWorkSheet = $objPHPExcel->createSheet($sheet);

            $center= array(
                'alignment' => array(
                    'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                ));

            $centerV= array(
                'alignment' => array(
                    'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ));

            $Border = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => \PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            for ($row=1;$row<500;$row++){
                $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
            }
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($centerV);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($center);
            $objPHPExcel->getActiveSheet()->getStyle('B')->applyFromArray($center);
            $objPHPExcel->getActiveSheet()->getStyle('E')->applyFromArray($center);
            $objPHPExcel->getActiveSheet()->getStyle('D6:F6')->applyFromArray($center);
            $objPHPExcel->getActiveSheet()->getStyle('A3:B5')->applyFromArray($Border);
            $objPHPExcel->getActiveSheet()->getStyle('D6:F6')->applyFromArray($Border);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
//        $objPHPExcel->getActiveSheet()->getStyle('A5:B5')->applyFromArray($Border);
//
                // Add some data
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1')
                    ->setCellValue('A1', 'ใบเซ็นชื่อเข้าสอบ') //กำหนดค่าให้ cell
                    ->setCellValue('A2', 'รายวิชา')
                    ->setCellValue('A3', 'ห้องสอบ')
                    ->setCellValue('A4', 'วันที่สอบ')
                    ->setCellValue('A5', 'เวลาสอบ')
                    ->setCellValue('D6', 'สาขาวิชา')
                    ->setCellValue('E6', 'เลขที่นั่งสอบ')
                    ->setCellValue('F6', 'ลายเซ็น');
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B2:C2');

                // กำหนดค่า i เป็น 7 เพื่อเริ่มพิมพ์ที่แถวที่ 7

                // Write data from MySQL result

            // Query นักศึกษาทั้งหมดและตัดวิชาที่ซ้ำ //
//            for ($j = 0 ; $j < $session['numberDays'] ; $j++) {
                $session = Yii::$app->session;
                $AllExam = [];
                $modelExam = EofficeExamExaminationItem::find()
                    ->where(['exam_date' => $session['date']['' . 0]])
                    ->orderBy(['subject_id' => SORT_ASC])
                    ->all();
                foreach ($modelExam as $item) {
                    $Exam = [];
                    $Exam['STUDENTID'] = $item->STUDENTID;
                    $Exam['STUDENTCODE'] = $item->stdname->STUDENTCODE;
                    $Exam['Subjectname'] = $item->subname->subject_nameeng;
                    $Exam['major'] = $item->stdname->major_code;
                    $Exam['rooms_id'] = $item->rooms_id;
                    $Exam['Prefix'] = $item->stdname->PREFIXNAME;
                    $Exam['fname'] = $item->stdname->STUDENTNAME;
                    $Exam['lname'] = $item->stdname->STUDENTSURNAME;
                    $Exam['exam_date'] = $item->exam_date;
                    $Exam['exam_start_time'] = $item->exam_start_time;
                    $Exam['exam_end_time'] = $item->exam_end_time;
                    $Exam['exam_seat'] = $item->exam_seat;
                    $Exam['subject_id'] = $item->subject_id;
                    array_push($AllExam, $Exam);
                }
//                $c = count($AllExam);
                $countExam = array_count_values(array_column($AllExam, 'rooms_id')); //นับจำนวนที่ซ้ำกัน
//            echo count($countExam)."<br>";
//            echo "<pre>";
//            print_r(key($countExam));
//            echo "</pre>";
//                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i,$c);
//            }
//$sub=3;

        $day=1;
//        while ($subject = current($countExam)) {
            $AllExam = [];
            $modelExam = EofficeExamExaminationItem::find()
                    ->where(['exam_date' => $session['date']['' . 0]])
                    ->andwhere(['rooms_id' => key($countExam)])
                    ->andwhere(['exam_start_time' => '08.30'])
                    ->andwhere(['subject_id' => '000103'])
                    ->orderBy(['exam_seat' => SORT_ASC])
                    ->all();
            foreach ($modelExam as $item) {
                $Exam = [];
                $Exam['STUDENTID'] = $item->STUDENTID;
                $Exam['STUDENTCODE'] = $item->stdname->STUDENTCODE;
                $Exam['major'] = $item->stdname->major_code;
                $Exam['Subjectname'] = $item->subname->subject_nameeng;
                $Exam['rooms_id'] = $item->rooms_id;
                $Exam['Prefix'] = $item->stdname->PREFIXNAME;
                $Exam['fname'] = $item->stdname->STUDENTNAME;
                $Exam['lname'] = $item->stdname->STUDENTSURNAME;
                $Exam['exam_date'] = $item->exam_date;
                $Exam['exam_start_time'] = $item->exam_start_time;
                $Exam['exam_end_time'] = $item->exam_end_time;
                $Exam['exam_seat'] = $item->exam_seat;
                $Exam['subject_id'] = $item->subject_id;
                array_push($AllExam, $Exam);
            }

//            echo key($countExam)."<br>";
            $objPHPExcel->getActiveSheet()->setCellValue('B2',$AllExam[0]['subject_id']." : ".$AllExam[0]['Subjectname']);
            $objPHPExcel->getActiveSheet()->setCellValue('B3',key($countExam));
            $objPHPExcel->getActiveSheet()->setCellValue('B4',$AllExam[0]['exam_date']);
            $objPHPExcel->getActiveSheet()->setCellValue('B5',$AllExam[0]['exam_start_time']." - ".$AllExam[0]['exam_end_time']." น.");

//            $sub+=count($AllExam);
            $day++;
//            next($countExam);
//        }
            $n=7;
        for ($num=1;$num<=count($AllExam);$num++){
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $n,$num);
            $n++;
        }

        $std=7;
        for ($stdid=0;$stdid<count($AllExam);$stdid++){
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $std,$AllExam[$stdid]['STUDENTCODE']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $std,$AllExam[$stdid]['Prefix'].$AllExam[$stdid]['fname']."     ".$AllExam[$stdid]['lname']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $std,"SC-".$AllExam[$stdid]['major']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $std,$AllExam[$stdid]['exam_seat']);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$std.':F'.$std)->applyFromArray($Border);
            $std++;
        }

//        echo "<pre>";
//            print_r($AllExam);
//        echo "</pre>";


//            $AllEnroll = $this->SortArray($AllEnroll);

//            foreach(EofficeExamExaminationItem::find()
//                        ->where(['exam_date' => $session['date'][''.$sheet]])
//                        ->orderBy(['subject_id' => SORT_ASC])
//                        ->all() as $item){ //วนลูปหาพนักงานทั้งหมด
//                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i,$item['STUDENTID']);
//                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $item["exam_date"]);
//                //กำหนดให้คอลัมม์ A แถวที่ i พิมพ์ค่าของ exam_date
//                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $item["exam_start_time"]." - ".$item["exam_end_time"]);
//                $model = Subject::findOne($item["subject_id"]);
//                //query หาชื่อจังหวัดที่มีค่าตรงกับ subject_id ของ subject
//                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $item["subject_id"]." ".$model->subject_namethai);
//                // แทนค่าคอลัมม์ที่ C แถวที่  i ด้วย subject_namethai ที่ query ออกมาได้
//                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $item["Section"]);
//                $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $item["rooms_id"]);
//                $i++;
//            }
//            }

             //Rename sheet
//            $objWorkSheet->setTitle($session['date'][''.$sheet]);
//            $sheet++;
//        }



        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        //$objPHPExcel->setActiveSheetIndex(0);

        // Save Excel 2007 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('StudentReport.xlsx'); // Save File เป็นชื่อ ExamRoomReport.xlsx

        echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web').'/StudentReport.xlsx'),
            ['class' => 'btn btn-info']);  //สร้าง link download

    }

    public function actionExcelInvigilator() {
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $Start_Date = Yii::$app->request->post('startDate');
        $End_Date = Yii::$app->request->post('endDate');

        //count days
        $startTimeStamp = strtotime($Start_Date);
        $endTimeStamp = strtotime($End_Date);

        $timeDiff = abs($endTimeStamp - $startTimeStamp);

        $numberDays = ($timeDiff / 86400) + 1;  // 86400 seconds in one day

// and you might want to convert to integer
        $numberDays = intval($numberDays);
        $session['numberDays'] = $numberDays;

//show date
        $dateArray = [];
        for ($i = $startTimeStamp; $i <= $endTimeStamp; $i += 86400) {
            $dateArr = date("Y-m-d", $i);
            array_push($dateArray, $dateArr);
            //echo date("Y-m-d", $i) . '<br />';
        }
        $session['date'] = $dateArray;
//        print_r($dateArray);
// end count days


        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel(); //สร้างไฟล์ excel

        //First sheet
//        $sheet = $objPHPExcel->getActiveSheet();
//        $sheet=0;
//        while ($sheet < $numberDays){
//
//            // Add new sheet
//            $objWorkSheet = $objPHPExcel->createSheet($sheet);

        $center= array(
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ));

        $centerV= array(
            'alignment' => array(
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ));

        $Border = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        for ($row=1;$row<500;$row++){
            $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
        }
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($centerV);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('A')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('B')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('D')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('E')->applyFromArray($center);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
//        $objPHPExcel->getActiveSheet()->getStyle('A5:B5')->applyFromArray($Border);
//
        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:E1')
            ->setCellValue('A1', 'รายงานกรรมการคุมสอบ') //กำหนดค่าให้ cell
            ->setCellValue('A3', 'วันที่')
            ->setCellValue('B3', 'ลำดับ')
            ->setCellValue('C3', 'ชื่อกรรมการคุมสอบ')
            ->setCellValue('D3', 'เวลาคุมสอบ')
            ->setCellValue('E3', 'ห้องคุมสอบ');



        // Write data from MySQL result

        // Query นักศึกษาทั้งหมดและตัดวิชาที่ซ้ำ //
//            for ($j = 0 ; $j < $session['numberDays'] ; $j++) {
        $session = Yii::$app->session;
        $AllInv = [];
        $modelInv = EofficeExamInvigilate::find()
            ->where(['exam_date' => $session['date']['' . 0]])
            ->orderBy(['examstart_time' => SORT_ASC])
            ->all();
        foreach ($modelInv as $item) {
            $INV = [];
            $INV['person_id'] = $item->person_id;
            $INV['prefix'] = $item->pername->PREFIXABB;
            $INV['person_fname'] = $item->pername->person_name;
            $INV['person_lname'] = $item->pername->person_surname;
            $INV['exam_date'] = $item->exam_date;
            $INV['examstart_time'] = $item->examstart_time;
            $INV['exam_end_time'] = $item->exam_end_time;
            $INV['rooms_id'] = $item->rooms_id;
            array_push($AllInv, $INV);
        }
        $test = count($AllInv);
        $test+=3;
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A4:A'.$test);
//            echo key($countExam)."<br>";
        $objPHPExcel->getActiveSheet()->setCellValue('A4',$AllInv[0]['exam_date']);

//        }
        $n=4;
        for ($num=1;$num<=count($AllInv);$num++){
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $n,$num);
            $n++;
        }

        $inv=4;
        for ($invi=0;$invi<count($AllInv);$invi++){
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $inv,$AllInv[$invi]['prefix'].$AllInv[$invi]['person_fname']."     ".$AllInv[$invi]['person_lname']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $inv,$AllInv[$invi]['examstart_time'].' - '.$AllInv[$invi]['exam_end_time']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $inv,$AllInv[$invi]['rooms_id']);
            $inv++;
        }


        //Rename sheet
//        $objWorkSheet->setTitle($session['date'][''.$sheet]);
//        $sheet++;
//        }



        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        //$objPHPExcel->setActiveSheetIndex(0);

        // Save Excel 2007 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('InvigilatorReport.xlsx'); // Save File เป็นชื่อ ExamRoomReport.xlsx

        echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web').'/InvigilatorReport.xlsx'),
            ['class' => 'btn btn-info']);  //สร้าง link download

    } //รายงานผู้คุมสอบ

    public function actionExcelInvigilator2() {
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $Start_Date = Yii::$app->request->post('startDate');
        $End_Date = Yii::$app->request->post('endDate');

        //count days
        $startTimeStamp = strtotime($Start_Date);
        $endTimeStamp = strtotime($End_Date);

        $timeDiff = abs($endTimeStamp - $startTimeStamp);

        $numberDays = ($timeDiff / 86400) + 1;  // 86400 seconds in one day

// and you might want to convert to integer
        $numberDays = intval($numberDays);
        $session['numberDays'] = $numberDays;

//show date
        $dateArray = [];
        for ($i = $startTimeStamp; $i <= $endTimeStamp; $i += 86400) {
            $dateArr = date("Y-m-d", $i);
            array_push($dateArray, $dateArr);
            //echo date("Y-m-d", $i) . '<br />';
        }
        $session['date'] = $dateArray;
//        print_r($dateArray);
// end count days


        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel(); //สร้างไฟล์ excel

        //First sheet
        $sheet = $objPHPExcel->getActiveSheet();
//        $sheet=0;
//        while ($sheet < $numberDays){
//
//            // Add new sheet
//            $objWorkSheet = $objPHPExcel->createSheet($sheet);

        $center= array(
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ));

        $centerV= array(
            'alignment' => array(
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ));

        $Border = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        for ($row=1;$row<500;$row++){
            $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
        }
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($centerV);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('A')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('B')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('D6:F6')->applyFromArray($center);
        $objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($Border);
//        $objPHPExcel->getActiveSheet()->getStyle('D6:F6')->applyFromArray($Border);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
//        $objPHPExcel->getActiveSheet()->getStyle('A5:B5')->applyFromArray($Border);
//
        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:G1')
            ->setCellValue('A1', 'บัญชีลงเวลาปฏิบัติงานของผู้คุมสอบ') //กำหนดค่าให้ cell
            ->setCellValue('A3', 'ลำดับที่')
            ->setCellValue('B3', 'ห้องสอบ')
            ->setCellValue('C3', 'ผู้คุมสอบ')
            ->setCellValue('D3', 'ลายเซ็น')
            ->setCellValue('E3', 'เวลามา')
            ->setCellValue('F3', 'ลายเซ็น')
            ->setCellValue('G3', 'เวลากลับ');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C2:E2');

        // กำหนดค่า i เป็น 7 เพื่อเริ่มพิมพ์ที่แถวที่ 7

        // Write data from MySQL result

        // Query นักศึกษาทั้งหมดและตัดวิชาที่ซ้ำ //
//            for ($j = 0 ; $j < $session['numberDays'] ; $j++) {
        $session = Yii::$app->session;
        $AllInv = [];
        $modelInv = EofficeExamInvigilate::find()
            ->where(['exam_date' => $session['date']['' . 0]])
            ->orderBy(['rooms_id' => SORT_ASC])
            ->all();
        foreach ($modelInv as $item) {
            $INV = [];
            $INV['person_id'] = $item->person_id;
            $INV['prefix'] = $item->pername->PREFIXABB;
            $INV['person_fname'] = $item->pername->person_name;
            $INV['person_lname'] = $item->pername->person_surname;
            $INV['exam_date'] = $item->exam_date;
            $INV['examstart_time'] = $item->examstart_time;
            $INV['exam_end_time'] = $item->exam_end_time;
            $INV['rooms_id'] = $item->rooms_id;
            array_push($AllInv, $INV);
        }

        $countINV = array_count_values(array_column($AllInv, 'rooms_id')); //นับจำนวนที่ซ้ำกัน
        $s = 4;
        $r = 4;
        $Allinvigilate =[];
        while ($subject = current($countINV)) {
        $AllInv = [];
        $modelInv = EofficeExamInvigilate::find()
            ->where(['exam_date' => $session['date']['' . 0]])
            ->andwhere(['rooms_id' => key($countINV)])
            ->all();
        foreach ($modelInv as $item) {
            $INV = [];
            $INV['person_id'] = $item->person_id;
            $INV['prefix'] = $item->pername->PREFIXABB;
            $INV['person_fname'] = $item->pername->person_name;
            $INV['person_lname'] = $item->pername->person_surname;
            $INV['exam_date'] = $item->exam_date;
            $INV['examstart_time'] = $item->examstart_time;
            $INV['exam_end_time'] = $item->exam_end_time;
            $INV['rooms_id'] = $item->rooms_id;
            array_push($AllInv, $INV);
        }
            $Allinvigilate[key($countINV)] = $AllInv;

            $objPHPExcel->getActiveSheet()->setCellValue('C2',$session['date']['' . 0]);
            for ($row=1;$row<=count($AllInv);$row++){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$r,$row);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$r)->applyFromArray($Border);
                    if ($row==count($AllInv)){
                        $r+=2;
                    }else{
                        $r++;
                    }
            }

        for ($row=0;$row<count($AllInv);$row++){
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$s,$Allinvigilate[key($countINV)][$row]['rooms_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$s,$Allinvigilate[key($countINV)][$row]['prefix'].' '.$Allinvigilate[key($countINV)][$row]['person_fname'].'  '.$Allinvigilate[key($countINV)][$row]['person_lname']);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$s.':G'.$s)->applyFromArray($Border);

            if ($row==(count($AllInv)-1)){
                $s+=2;
        }else{
                $s++;
            }
        }
            next($countINV);

        }

//        echo "<pre>";
//        print_r($Allinvigilate);
//        echo "</pre>";

        //Rename sheet
//            $objWorkSheet->setTitle($session['date'][''.$sheet]);
//            $sheet++;
//        }



        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        //$objPHPExcel->setActiveSheetIndex(0);

        // Save Excel 2007 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('TimeInvigilateReport.xlsx'); // Save File เป็นชื่อ ExamRoomReport.xlsx

        echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web').'/TimeInvigilateReport.xlsx'),
            ['class' => 'btn btn-info']);  //สร้าง link download

    } //รายงานลงชื่อผู้คุมสอบ

    public function actionExcelInvigilator3() {
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $Start_Date = Yii::$app->request->post('startDate');
        $End_Date = Yii::$app->request->post('endDate');

        //count days
        $startTimeStamp = strtotime($Start_Date);
        $endTimeStamp = strtotime($End_Date);

        $timeDiff = abs($endTimeStamp - $startTimeStamp);

        $numberDays = ($timeDiff / 86400) + 1;  // 86400 seconds in one day

// and you might want to convert to integer
        $numberDays = intval($numberDays);
        $session['numberDays'] = $numberDays;

//show date
        $dateArray = [];
        for ($i = $startTimeStamp; $i <= $endTimeStamp; $i += 86400) {
            $dateArr = date("Y-m-d", $i);
            array_push($dateArray, $dateArr);
            //echo date("Y-m-d", $i) . '<br />';
        }
        $session['date'] = $dateArray;
//        print_r($dateArray);
// end count days


        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel(); //สร้างไฟล์ excel

        //First sheet
//        $sheet = $objPHPExcel->getActiveSheet();
//        $sheet=0;
//        while ($sheet < $numberDays){
//
//            // Add new sheet
//            $objWorkSheet = $objPHPExcel->createSheet($sheet);

        $center= array(
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ));

        $centerV= array(
            'alignment' => array(
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ));

        $Border = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        for ($row=1;$row<500;$row++){
            $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
        }
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($centerV);
        $objPHPExcel->getActiveSheet()->getStyle('A:D')->applyFromArray($center);
//        $objPHPExcel->getActiveSheet()->getStyle('A')->applyFromArray($center);
//        $objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($center);
//        $objPHPExcel->getActiveSheet()->getStyle('B')->applyFromArray($center);
//        $objPHPExcel->getActiveSheet()->getStyle('D')->applyFromArray($center);
//        $objPHPExcel->getActiveSheet()->getStyle('E')->applyFromArray($center);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
//        $objPHPExcel->getActiveSheet()->getStyle('A5:B5')->applyFromArray($Border);
//
        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:D1')
            ->setCellValue('A1', 'กำหนดการคุมสอบ') //กำหนดค่าให้ cell
            ->setCellValue('A3', 'ชื่อกรรมการคุมสอบ')
            ->setCellValue('B3', 'วันที่คุมสอบ')
            ->setCellValue('C3', 'เวลา')
            ->setCellValue('D3', 'ห้องสอบ');



        // Write data from MySQL result

        // Query นักศึกษาทั้งหมดและตัดวิชาที่ซ้ำ //
//            for ($j = 0 ; $j < $session['numberDays'] ; $j++) {

            $session = Yii::$app->session;
        $AllInv = [];
            $modelInv = EofficeExamInvigilate::find()
                ->where(['exam_date' => $session['date']['' . 0]])
                ->orderBy(['person_id' => SORT_ASC])
                ->all();
            foreach ($modelInv as $item) {
                $INV = [];
                $INV['person_id'] = $item->person_id;
                $INV['prefix'] = $item->pername->PREFIXABB;
                $INV['person_fname'] = $item->pername->person_name;
                $INV['person_lname'] = $item->pername->person_surname;
                $INV['exam_date'] = $item->exam_date;
                $INV['examstart_time'] = $item->examstart_time;
                $INV['exam_end_time'] = $item->exam_end_time;
                $INV['rooms_id'] = $item->rooms_id;
                array_push($AllInv, $INV);
            }
            $countINV = array_count_values(array_column($AllInv, 'person_id')); //นับจำนวนที่ซ้ำกัน
            $Allinvigilate = [];
//        echo "<pre>";
//        print_r($countINV);
//        echo "</pre>";
        $AllInv = [];
            while ($person = current($countINV)) {
                $modelInv = EofficeExamInvigilate::find()
                    ->where(['person_id' => key($countINV)])
                    ->andwhere(['exam_date' => $session['date']['' . 0]])
                    ->all();
                foreach ($modelInv as $item) {
                    $INV = [];
                    $INV['person_id'] = $item->person_id;
                    $INV['prefix'] = $item->pername->PREFIXABB;
                    $INV['person_fname'] = $item->pername->person_name;
                    $INV['person_lname'] = $item->pername->person_surname;
                    $INV['exam_date'] = $item->exam_date;
                    $INV['examstart_time'] = $item->examstart_time;
                    $INV['exam_end_time'] = $item->exam_end_time;
                    $INV['rooms_id'] = $item->rooms_id;
                    array_push($AllInv, $INV);
                }
               // $invv[key($countINV)] = $AllInv;
                //$Allinvigilate[key($countINV)] = $invv;

                $test = count($AllInv);
                $test+=3;
                //$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A4:A'.$test);
//            echo key($countExam)."<br>";
                $r=4;
                for($row=0;$row<count($AllInv);$row++){
                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$r,$AllInv[$row]['prefix']
                        .''.$AllInv[$row]['person_fname'].'  '.$AllInv[$row]['person_lname']);
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$r,$AllInv[$row]['exam_date']);
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$r,$AllInv[$row]['examstart_time'].' - '.$AllInv[$row]['exam_end_time'].' น.');
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$r,$AllInv[$row]['rooms_id']);
                $r++;
                }
                $objPHPExcel->getActiveSheet()->getStyle('A1:D'.$test)->applyFromArray($Border);

                next($countINV);
            }

//        echo "<pre>";
//        print_r($AllInv);
//        echo "</pre>";


        //Rename sheet
//        $objWorkSheet->setTitle($session['date'][''.$sheet]);
//        $sheet++;
//        }



        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        //$objPHPExcel->setActiveSheetIndex(0);

        // Save Excel 2007 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('InvigilatorReport2.xlsx'); // Save File เป็นชื่อ ExamRoomReport.xlsx

        echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web').'/InvigilatorReport2.xlsx'),
            ['class' => 'btn btn-info']);  //สร้าง link download

    } //รายงานผู้คุมสอบรายบุคคล

}
