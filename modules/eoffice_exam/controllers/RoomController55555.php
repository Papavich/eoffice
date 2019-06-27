<?php

namespace app\modules\eoffice_exam\controllers;

use app\modules\eoffice_exam\models\EofficeExamExaminationItem;
use Yii;
use yii\web\Controller;
use yii\helpers\Html;
use app\modules\eoffice_exam\models\ExamDetailExamination;
use app\modules\eoffice_exam\models\Enroll;
use app\modules\eoffice_exam\models\EnrollDetail;
use app\modules\eoffice_exam\models\ExamRoomDetail;
use app\modules\eoffice_exam\models\EofficeExamExamination;
use app\modules\eoffice_exam\models\EofficeExamExaminationSearch;

use yii\behaviors\TimestampBehavior;


use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class RoomController55555 extends \yii\web\Controller
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


    public function actionRoom() //this action will show default page
    {
        $this->layout = "main_modules";
        //$currentyear = new ExamDetailExamination;
        $latestyear = ExamDetailExamination::find()
            ->orderBy(['TimeStamp' => SORT_ASC])
            ->where('rownum' < 2 )
            ->all();
        foreach ($latestyear as $item) {
            $subopen_year = $item->subopen_year;
            $exam_detail_date_start = $item->exam_detail_date_start;
            $exam_detail_date_end = $item->exam_detail_date_end;
            $subopen_semester = $item->subopen_semester;
            $Examcode = $item->Examcode;
        }
        $CheckRow = count($latestyear);
        if ($CheckRow == 0){
            $model = new ExamDetailExamination;
            $model->load(Yii::$app->request->post());
            return $this->render('room2',[
                'model' => $model,
            ]);
        }else{
            $model = new ExamDetailExamination;
            $model->load(Yii::$app->request->post());

            return $this->render('room',[
                'model' => $model,
                'subopen_year' => $subopen_year,
                'exam_detail_date_start' => $exam_detail_date_start,
                'exam_detail_date_end' => $exam_detail_date_end,
                'subopen_semester' => $subopen_semester,
                'Examcode' => $Examcode,

                // 'currentyear' => $currentyear,
            ]);
        }


    }

    public function actionInsert() //insert value from default page to DB
    {

        $time = new \DateTime('now', new \DateTimeZone('GMT+7'));
//echo date_format($time, 'Y-m-d H:i:s');
        $request = Yii::$app->request;
        $_SESSION['year'] = $_POST['ExamDetailExamination']['subopen_year'];
        $_SESSION['semester'] = $_POST['ExamDetailExamination']['subopen_semester'];
        $_SESSION['type'] = $_POST['ExamDetailExamination']['Examcode'];
        $_SESSION['startdate'] = Yii::$app->request->post('startDate');
        $_SESSION['enddate'] = Yii::$app->request->post('endDate');

// check ค่าใน DB
        $check = ExamDetailExamination::find()
            ->where(['subopen_year' => $_SESSION['year']])
            ->andWhere(['subopen_semester' => $_SESSION['semester']])
            ->andWhere(['Examcode' => $_SESSION['type']])
            ->andwhere(['exam_detail_date_start' => $_SESSION['startdate']])
            ->andWhere(['exam_detail_date_end' =>$_SESSION['enddate'] ])
            ->all();
        foreach ($check as $item) {
            $subopen_year = $item->subopen_year;
            $exam_detail_date_start = $item->exam_detail_date_start;
            $exam_detail_date_end = $item->exam_detail_date_end;
            $subopen_semester = $item->subopen_semester;
            $Examcode = $item->Examcode;
        }
        if (empty($item)){
            $insert = new ExamDetailExamination();
            $insert->load(Yii::$app->request->post());
            $insert = new ExamDetailExamination();

            $insert->exam_detail_date_start = Yii::$app->request->post('startDate');
            $insert->exam_detail_date_end = Yii::$app->request->post('endDate');
            $insert->subopen_semester = $_POST['ExamDetailExamination']['subopen_semester'];
            $insert->subopen_year = $_POST['ExamDetailExamination']['subopen_year'];
            $insert->Examcode = $_POST['ExamDetailExamination']['Examcode'];
            $insert->TimeStamp = date_format($time, 'Y-m-d H:i:s');
            $insert->save(false);

            return $this->redirect(['examprocess']); //return to action examprocess
        }else {
            return $this->redirect('show-exam-room');
        }
    }

    public function actionShowExamRoom(){
        $searchModel = new EofficeExamExaminationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('ShowExamRoom',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExamprocess()  //this action for manage exam room
    {
        $session = Yii::$app->session;
        //count days
        $startTimeStamp = strtotime($_SESSION['startdate']);
        $endTimeStamp = strtotime($_SESSION['enddate']);

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
//        print_r($session['date']);
// end count days

        $AllExamination = [];

//        for($days = 0 ; $days < $session['numberDays']; $days++ ) {


        // Variable //

        $Examination = [];

///////////////////////////////BEST FIT//////////////////////////////////////

        $AllEnroll = $this->QueryAllEnroll();


        //$BestFit = [];

        $AllEnrollA = $this->QueryEnrollA($AllEnroll);
        $AllEnrollA = $this->SortArray($AllEnrollA);
        $AllRoomA = $this->GetRoomA(0, $AllEnrollA[0]['TIME']);
        $AllRoomA = $this->SortArray($AllRoomA);

        if ($AllEnrollA[0]['SEAT'] >= $AllRoomA[0]['SEAT']) {
            $num = $AllEnrollA[0]['SEAT'] - $AllRoomA[0]['SEAT']; //หาผลจำนวนที่เหลือ
            $AllEnrollA[0]['SEAT'] = $num;
            $AllRoomA[0]['SEAT'] = 0;
            $AllEnrollA[0]['SEAT_temp'] = $AllEnrollA[0]['SEAT'];
            $AllRoomA[0]['SEAT_temp'] = $AllRoomA[0]['SEAT'];
        } else {
            $num = $AllRoomA[0]['SEAT'] - $AllEnrollA[0]['SEAT']; //หาผลจำนวนที่เหลือ
            $AllRoomA[0]['SEAT'] = $num;
            $AllEnrollA[0]['SEAT'] = 0 ;
            $AllEnrollA[0]['SEAT_temp'] = $AllEnrollA[0]['SEAT'];
            $AllRoomA[0]['SEAT_temp'] = $AllRoomA[0]['SEAT'];
        }

        $BestFit['SUBJECT'] = $AllEnrollA[0];
        $BestFit['ROOM'] = $AllRoomA[0];
        array_push($Examination,$BestFit);

        $AllEnrollB = $this->QueryEnrollB($AllEnroll);
        $AllEnrollB = $this->SortArray($AllEnrollB);
        $AllRoomB = $this->GetRoomB(0, $AllEnrollB[0]['TIME']);

        if ($AllEnrollB[0]['SEAT'] >= $AllRoomB[0]['SEAT']) {
            $num = $AllEnrollB[0]['SEAT'] - $AllRoomB[0]['SEAT']; //หาผลจำนวนที่เหลือ
            $AllEnrollB[0]['SEAT'] = $num;
            $AllRoomB[0]['SEAT'] = 0;
            $AllEnrollB[0]['SEAT_temp'] = $AllEnrollB[0]['SEAT'];
            $AllRoomB[0]['SEAT_temp'] = $AllRoomB[0]['SEAT'];
        } else {
            $num = $AllRoomB[0]['SEAT'] - $AllEnrollB[0]['SEAT']; //หาผลจำนวนที่เหลือ
            $AllRoomB[0]['SEAT'] = $num;
            $AllEnrollB[0]['SEAT'] = 0 ;
            $AllEnrollB[0]['SEAT_temp'] = $AllEnrollB[0]['SEAT'];
            $AllRoomB[0]['SEAT_temp'] = $AllRoomB[0]['SEAT'];
        }

        $BestFit['SUBJECT'] = $AllEnrollB[0];
        $BestFit['ROOM'] = $AllRoomB[0];
        array_push($Examination,$BestFit);

///////////////////////////////BEST FIT//////////////////////////////////////



///////////////////////////////PRIORITY//////////////////////////////////////

        $AllEnrollA = $this->SortArray($AllEnrollA);
        $AllRoomA = $this->SortArray($AllRoomA);

//$r = 0;
          // for ($r=0;$r<count($AllRoomA);$r++){
//        do {

            for ($e = 0; $e < count($AllEnrollA); $e++) { //วน loop หาวิชาที่พอดีกับห้องที่สุด
                if ($AllRoomA[0] == $AllEnrollA[$e]) { //จำนวนคนลงทะเบียน เท่ากับ จำนวนที่นั่งในห้อง
                    $equal['SUBJECT'] = $AllEnrollA[$e];
                    $equal['ROOM'] = $AllRoomA[0];
                    array_push($Examination, $equal);
                    $AllEnrollA[$e]['SEAT'] = 0;
                    $AllRoomA[0]['SEAT'] = 0;
                    $AllEnrollA[$e]['SEAT_temp'] = $AllEnrollA[$e]['SEAT'];
                    $AllRoomA[0]['SEAT_temp'] = $AllRoomA[0]['SEAT'];
                    break;
                } else { //จำนวนคนลงทะเบียน ไม่เท่ากับ จำนวนที่นั่งในห้อง
                    $sum = abs($AllRoomA[0]['SEAT'] - $AllEnrollA[$e]['SEAT']);
                    $AllEnrollA[$e]['SEAT_temp'] = $sum;
                }
            }

            $AllEnrollA = $this->SortArrayTemp($AllEnrollA); //เรียงลำดับความต่างของคนลงทะเบียนกับที่นั่งจากน้อยไปมาก

            if ($AllEnrollA[0]['SEAT'] >= $AllRoomA[0]['SEAT']) {  // คนลงทะเบียนมากกว่าที่นั่งในห้อง
                $AllRoomA[0]['SEAT'] = 0; //ที่นั่งของห้องนั้นเป็น 0
                $AllRoomA[0]['SEAT_temp'] = 0;
                $AllEnrollA[0]['SEAT'] = $AllEnrollA[0]['SEAT_temp']; //จำนวนคนลงทะเบียนเหลือเท่ากับผลลัพธ์ที่ได้จากการคำนวน
                $AllEnrollA[0]['SEAT_temp'] = $AllEnrollA[0]['SEAT'];

                $Prior['SUBJECT'] = $AllEnrollA[0];
                $Prior['ROOM'] = $AllRoomA[0];
                array_push($Examination, $Prior); //ยัดวิชาเข้าสอบในห้องนั้น

                for ($r = 0; $r < count($AllRoomA); $r++) {


                }

//                for ($r = 0; $r < count($AllRoomA); $r++) { //วน loop หาห้องที่มีที่นั่งใกล้เคียงกับคนที่เหลือ
//                    if ($AllEnrollA[0] == $AllRoomA[$r]) {  //จำนวนคนลงทะเบียน เท่ากับ จำนวนที่นั่งในห้อง
//                        $equal['SUBJECT'] = $AllEnrollA[0];
//                        $equal['ROOM'] = $AllRoomA[$r];
//                        array_push($Examination, $equal);
//                        $AllEnrollA[0]['SEAT'] = 0;
//                        $AllRoomA[$r]['SEAT'] = 0;
//                        $AllEnrollA[0]['SEAT_temp'] = $AllEnrollA[0]['SEAT'];
//                        $AllRoomA[$r]['SEAT_temp'] = $AllRoomA[$r]['SEAT'];
//                        break;
//                    } else { //จำนวนคนลงทะเบียน ไม่เท่ากับ จำนวนที่นั่งในห้อง
//                        $sum = abs($AllRoomA[$r]['SEAT'] - $AllEnrollA[0]['SEAT']);
//                        $AllRoomA[$r]['SEAT_temp'] = $sum;
//                    }
//                }


//                $AllRoomA = $this->SortArrayTemp($AllRoomA);
//                $Prior['SUBJECT'] = $AllEnrollA[0];
//                $Prior['ROOM'] = $AllRoomA[0];
//                array_push($Examination, $Prior);

            } else {  //ที่นั่งในห้องมีมากกว่าคนลงทะเบียน

                $AllEnrollA[0]['SEAT'] = 0; //จำนวนคนลงทะเบียนเหลือ 0
                $AllRoomA[0]['SEAT'] = $AllEnrollA[0]['SEAT_temp']; //จำนวนที่นั่งเหลือเท่ากับผลลัพธ์ที่คำนวนได้
                $AllRoomA[0]['SEAT_temp'] = $AllRoomA[0]['SEAT'];
                $AllEnrollA[0]['SEAT_temp'] = 0;

                $Prior['SUBJECT'] = $AllEnrollA[0];
                $Prior['ROOM'] = $AllRoomA[0];
                array_push($Examination, $Prior); //ยัดวิชาเข้าสอบในห้องนั้น

//                    $AllEnrollA = $this->SortArray($AllEnrollA);
//                for ($e = 0 ; $e < count($AllEnrollA) ; $e++){ //วน loop หาวิชาที่พอดีกับห้องที่สุด
//                    if ($AllRoomA[0] == $AllEnrollA[$e]){
//                        $equal['SUBJECT'] = $AllEnrollA[$e];
//                        $equal['ROOM'] = $AllRoomA[0];
//                        array_push($Examination,$equal);
//                        $AllEnrollA[$e]['SEAT'] = 0;
//                        $AllRoomA[0]['SEAT'] = 0;
//                        $AllEnrollA[$e]['SEAT_temp'] = $AllEnrollA[$e]['SEAT'];
//                        $AllRoomA[0]['SEAT_temp'] = $AllRoomA[0]['SEAT'];
//
//                    }else{
//                        $sum = abs($AllRoomA[0]['SEAT'] - $AllEnrollA[$e]['SEAT']);
//                        $AllEnrollA[$e]['SEAT_temp'] = $sum;
//                    }
//                }
//                    $AllEnrollA = $this->SortArrayTemp($AllEnrollA);
//                $AllRoomA = $this->SortArrayTemp($AllRoomA);
//                $Prior['SUBJECT'] = $AllEnrollA[0];
//                $Prior['ROOM'] = $AllRoomA[0];
//                array_push($Examination, $Prior);
            }
            $AllEnrollA = $this->SortArray($AllEnrollA);
//        }while($AllEnrollA[0]['SEAT'] != 0);
///////////////////////////////PRIORITY//////////////////////////////////////

           //}
//
//
        echo "EXAMINATION"."<pre>";
        print_r($Examination);
        echo "</pre>";



//        echo "ROOM A"."<pre>";
//        print_r($AllRoomA);
//        echo "</pre>";
//
//        echo "ENROLL A"."<pre>";
//        print_r($AllEnrollA);
//        echo "</pre>";

//        echo "ENROLL A"."<pre>";
//        print_r($AllEnrollA);
//        echo "</pre>";

//            $i = 0;
//
//            $AllEnrollA = $this->QueryEnrollA($AllEnroll);
//            /***TAG A***/
//            do {
//
//                $AllEnrollA = $this->SortArray($AllEnrollA);
//                $AllRoom = $this->GetRoomA(0, $AllEnrollA[0]['TIME']);
//
//                if ($AllEnrollA[0]['SEAT_temp'] >= $AllRoom[0]['SEAT_temp']) {
//
//                    $num = $AllEnrollA[0]['SEAT_temp'] - $AllRoom[0]['SEAT_temp']; //หาผลจำนวนที่เหลือ
//
//                    $AllEnrollA[0]['SEAT_temp'] = $num;
//
//                    $this->UpdateSeat(
//                        $AllRoom[0]['ROOMID'],
//                        $AllRoom[0]['TAG'],
//                        $AllRoom[0]['TIME'],
//                        $AllRoom[0]['DATE'],
//                        0);
//                    $this->UpdateStatus(
//                        $AllRoom[0]['ROOMID'],
//                        $AllRoom[0]['TAG'],
//                        $AllRoom[0]['TIME'],
//                        $AllRoom[0]['DATE']);
//                } else {
//                    $num = $AllRoom[0]['SEAT_temp'] - $AllEnrollA[0]['SEAT_temp']; //หาผลจำนวนที่เหลือ
//                    $AllEnrollA[0]['SEAT_temp'] = 0;
//                    if ($num == 0) {
//                        $this->UpdateStatus(
//                            $AllRoom[0]['ROOMID'],
//                            $AllRoom[0]['TAG'],
//                            $AllRoom[0]['TIME'],
//                            $AllRoom[0]['DATE']
//                        );
//                    } else {
//                        $this->UpdateSeat(
//                            $AllRoom[0]['ROOMID'],
//                            $AllRoom[0]['TAG'],
//                            $AllRoom[0]['TIME'],
//                            $AllRoom[0]['DATE'],
//                            $num);
//                    }
//                }
//
//                $BestFit['SUBJECT'] = $AllEnrollA[0];
//                $BestFit['ROOM'] = $AllRoom[0];
//
//                array_push($Examination, $BestFit);
//
//                $i++;
//                $AllEnrollA = $this->SortArray($AllEnrollA);
//            } while ($AllEnrollA[0]['SEAT_temp'] != 0);
//            /***TAG A***/
//
//            ////////////////////////////////////BBBBBBBBBBB//////////////////////////////////////////
//            /***TAG B***/
//            $AllEnrollB = $this->QueryEnrollB($AllEnroll);
//            do {
//                $AllEnrollB = $this->SortArray($AllEnrollB);
//                $AllRoom = $this->GetRoomB(0, $AllEnrollB[0]['TIME']);
//
//                if ($AllEnrollB[0]['SEAT_temp'] >= $AllRoom[0]['SEAT_temp']) {
//
//                    $num = $AllEnrollB[0]['SEAT_temp'] - $AllRoom[0]['SEAT_temp']; //หาผลจำนวนที่เหลือ
//
//                    $AllEnrollB[0]['SEAT_temp'] = $num;
//
//                    $this->UpdateSeat(
//                        $AllRoom[0]['ROOMID'],
//                        $AllRoom[0]['TAG'],
//                        $AllRoom[0]['TIME'],
//                        $AllRoom[0]['DATE'],
//                        0);
//                    $this->UpdateStatus(
//                        $AllRoom[0]['ROOMID'],
//                        $AllRoom[0]['TAG'],
//                        $AllRoom[0]['TIME'],
//                        $AllRoom[0]['DATE']
//                    );
//                } else {
//                    $num = $AllRoom[0]['SEAT_temp'] - $AllEnrollB[0]['SEAT_temp']; //หาผลจำนวนที่เหลือ
//                    $AllEnrollB[0]['SEAT_temp'] = 0;
//                    if ($num == 0) {
//                        $this->UpdateStatus(
//                            $AllRoom[0]['ROOMID'],
//                            $AllRoom[0]['TAG'],
//                            $AllRoom[0]['TIME'],
//                            $AllRoom[0]['DATE']
//                        );
//                    } else {
//                        $this->UpdateSeat(
//                            $AllRoom[0]['ROOMID'],
//                            $AllRoom[0]['TAG'],
//                            $AllRoom[0]['TIME'],
//                            $AllRoom[0]['DATE'],
//                            $num);
//                    }
//                }
//
//                $BestFit['SUBJECT'] = $AllEnrollB[0];
//                $BestFit['ROOM'] = $AllRoom[0];
//
//                array_push($Examination, $BestFit);
//                $i++;
//                $AllEnrollB = $this->SortArray($AllEnrollB);
//            } while ($AllEnrollB[0]['SEAT_temp'] != 0);
//            /***TAG B***/
//
//            $AllExamination['' . $session['date'][0]] = $Examination;

//            for ($round = 0; $round < $i; $round++) {
//                $this->InsertExam(
//                    $AllExamination['' . $session['date'][$days]][$round]['ROOM']['ROOMID'],
//                    $AllExamination['' . $session['date'][$days]][$round]['ROOM']['TAG'],
//                    $AllExamination['' . $session['date'][$days]][$round]['SUBJECT']['SUBJECT_ID'],
//                    $AllExamination['' . $session['date'][$days]][$round]['SUBJECT']['PROGRAM_CLASS'],
//                    $AllExamination['' . $session['date'][$days]][$round]['SUBJECT']['DATE'],
//                    $AllExamination['' . $session['date'][$days]][$round]['SUBJECT']['START_TIME'],
//                    $AllExamination['' . $session['date'][$days]][$round]['SUBJECT']['END_TIME']
//                );
//            }
//        }


//        $AllEnrollA = $this->QueryEnrollA(0);
//
//        echo 'ROOM TAG A <br>';
//        echo '<pre>';
//        print_r($AllEnrollA);
//        echo '</pre>';
//        $AllEnrollB = $this->QueryEnrollB(0);
//        echo '<pre>';
//        print_r($AllEnrollB);
//        echo '</pre>';

//        return $this->redirect('studentprocess');
    }


    // Function //


    protected function QueryAllEnroll(){
        // Query วิชาทั้งหมดและตัดวิชาที่ซ้ำ //
        $session = Yii::$app->session;
        $AllEnroll = [];
        $modelEnroll = Enroll::find()
            ->where(['exam_enroll_date' => $session['date']['' . 0]])
            ->orderBy(['exam_enroll_seat_temp' => SORT_DESC])
            ->all();
        foreach ($modelEnroll as $item) {
            $Enroll = [];
            $Enroll['SECTION_NO'] = $item->section_no;
            $Enroll['SUBJECT_ID'] = $item->subject_id;
            $Enroll['SEBJECT_VERSION'] = $item->subject_version;
            $Enroll['SUBOPEN_SEMESTER'] = $item->subopen_semester;
            $Enroll['SUBOPEN_YEAR'] = $item->subopen_year;
            $Enroll['PROGRAM_ID'] = $item->program_id;
            $Enroll['PROGRAM_CLASS'] = $item->program_class;
            $Enroll['TEACHER_ID'] = $item->teacher_id;
            $Enroll['SEAT'] = $item->exam_enroll_seat;
            $Enroll['SEAT_temp'] = $item->exam_enroll_seat_temp;
            $Enroll['START_TIME'] = $item->exam_enroll_start_time;
            $Enroll['END_TIME'] = $item->exam_enroll_end_time;
            $Enroll['DATE'] = $item->exam_enroll_date;
            $Enroll['TYPE'] = $item->Examcode;
            $Enroll['TIME'] = $item->exam_enroll_time;
            array_push($AllEnroll, $Enroll);
        }

        $countEnroll = array_count_values(array_column($AllEnroll, 'SUBJECT_ID')); //นับจำนวนที่ซ้ำกัน

        $AllEnroll = [];
        while ($subject = current($countEnroll)) {

            if ($countEnroll[key($countEnroll)] == 1) {
                $modelEnroll = Enroll::find()
                    ->where(['exam_enroll_date' => $session['date']['' . 0]])
                    ->andwhere(['subject_id' => key($countEnroll)])
                    ->orderBy(['exam_enroll_seat_temp' => SORT_DESC])
                    ->all();
                foreach ($modelEnroll as $item) {
                    $Enroll = [];
                    $Enroll['SECTION_NO'] = $item->section_no;
                    $Enroll['SUBJECT_ID'] = $item->subject_id;
                    $Enroll['SEBJECT_VERSION'] = $item->subject_version;
                    $Enroll['SUBOPEN_SEMESTER'] = $item->subopen_semester;
                    $Enroll['SUBOPEN_YEAR'] = $item->subopen_year;
                    $Enroll['PROGRAM_ID'] = $item->program_id;
                    $Enroll['PROGRAM_CLASS'] = $item->program_class;
                    $Enroll['TEACHER_ID'] = $item->teacher_id;
                    $Enroll['SEAT'] = $item->exam_enroll_seat;
                    $Enroll['SEAT_temp'] = $item->exam_enroll_seat_temp;
                    $Enroll['START_TIME'] = $item->exam_enroll_start_time;
                    $Enroll['END_TIME'] = $item->exam_enroll_end_time;
                    $Enroll['DATE'] = $item->exam_enroll_date;
                    $Enroll['TYPE'] = $item->Examcode;
                    $Enroll['TIME'] = $item->exam_enroll_time;
                    array_push($AllEnroll, $Enroll);
                }
            } else {
                $sum = 0;
                $modelEnroll = Enroll::find()
                    ->where(['exam_enroll_date' => $session['date']['' . 0]])
                    ->andwhere(['subject_id' => key($countEnroll)])
                    ->orderBy(['exam_enroll_seat' => SORT_DESC])
                    ->all();
                foreach ($modelEnroll as $item) {
                    $sum = $sum + $item->exam_enroll_seat;
                }

                $modelEnroll = Enroll::find()
                    ->where(['exam_enroll_date' => $session['date']['' . 0]])
                    ->andwhere(['subject_id' => key($countEnroll)])
                    ->orderBy(['exam_enroll_seat' => SORT_DESC])
                    ->one();
                $Enroll = [];
                $Enroll['SECTION_NO'] = $modelEnroll['section_no'];
                $Enroll['SUBJECT_ID'] = $modelEnroll['subject_id'];
                $Enroll['SEBJECT_VERSION'] = $modelEnroll['subject_version'];
                $Enroll['SUBOPEN_SEMESTER'] = $modelEnroll['subopen_semester'];
                $Enroll['SUBOPEN_YEAR'] = $modelEnroll['subopen_year'];
                $Enroll['PROGRAM_ID'] = $modelEnroll['program_id'];
                $Enroll['PROGRAM_CLASS'] = $modelEnroll['program_class'];
                $Enroll['TEACHER_ID'] = $modelEnroll['teacher_id'];
                $Enroll['SEAT'] = $sum;
                $Enroll['SEAT_temp'] = $modelEnroll['exam_enroll_seat_temp'];
                $Enroll['START_TIME'] = $modelEnroll['exam_enroll_start_time'];
                $Enroll['END_TIME'] = $modelEnroll['exam_enroll_end_time'];
                $Enroll['DATE'] = $modelEnroll['exam_enroll_date'];
                $Enroll['TYPE'] = $modelEnroll['Examcode'];
                $Enroll['TIME'] = $modelEnroll['exam_enroll_time'];
                array_push($AllEnroll, $Enroll);
            }
            next($countEnroll);
        }
        $AllEnroll = $this->SortArray($AllEnroll);
        return $AllEnroll;
    }


    // Function //



    public function actionStudentprocess() //this action for จับเด็กเข้าห้อง
    {

        $session = Yii::$app->session;

        ////////////////// QUERY การสอบแต่ละวัน/////////////////////
        $AllExam = [];

        for ($round = 0; $round < $session['numberDays']; $round++) {

            $Examination = EofficeExamExamination::find()
                ->where(['exam_date' => $session['date']['' . $round]])
                ->orderBy(['subject_id' => SORT_ASC])
                ->all();
            foreach ($Examination as $item) {
                $Exam = [];
                $Exam['rooms_id'] = $item->rooms_id;
                $Exam['room_tag'] = $item->room_tag;
                $Exam['subject_id'] = $item->subject_id;
                $Exam['program_class'] = $item->program_class;
                $Exam['exam_date'] = $item->exam_date;
                $Exam['exam_time'] = $item->exam_start_time;
                $Exam['exam_start_time'] = $item->exam_start_time;
                $Exam['exam_end_time'] = $item->exam_end_time;
                if ($Exam['exam_time'] == '08.30') {
                    $Exam['exam_time'] = 'เช้า';
                } else {
                    $Exam['exam_time'] = 'บ่าย';
                }
                array_push($AllExam, $Exam);
            }
//            echo count($AllExam);

///////////////////////////////// QUERY หาเด็กน้อย ///////////////////////////////////

            $AllStudent = [];

            for ($j = 0; $j < count($AllExam); $j++) {

                $ERDetail = EnrollDetail::find()
                    ->where(['subject_id' => $AllExam[$j]['subject_id']])
                    ->orderBy(['STUDENTID' => SORT_ASC])
                    ->all();

                foreach ($ERDetail as $item) {
                    $EnrollDT = [];
                    $EnrollDT['STUDENTID'] = $item->STUDENTID;
                    $EnrollDT['section_no'] = $item->section_no;
                    $EnrollDT['subject_id'] = $item->subject_id;
                    $EnrollDT['subject_version'] = $item->subject_version;
                    $EnrollDT['subopen_semester'] = $item->subopen_semester;
                    $EnrollDT['subopen_year'] = $item->subopen_year;
                    $EnrollDT['program_id'] = $item->program_id;
                    $EnrollDT['program_class'] = $item->program_class;

                    array_push($AllStudent, $EnrollDT);
                }

                $ROOM = ExamRoomDetail::find()
                    ->where(['rooms_detail_date' => $AllExam[$j]['exam_date']])
                    ->andWhere(['rooms_id' => $AllExam[$j]['rooms_id']])
                    ->andWhere(['rooms_detail_time' => $AllExam[$j]['exam_time']])
                    ->andWhere(['exam_room_tag' => $AllExam[$j]['room_tag']])
                    ->orderBy(['rooms_detail_date' => SORT_ASC, 'rooms_id' => SORT_ASC])
                    ->one();

//            $STUDENTID,$rooms_id,$exam_date,$exam_start_time,$exam_end_time
                $num = 1;
                for ($i = 0; $i < $ROOM['exam_rooms_seat']; $i++) {

                    $checkStd = EofficeExamExaminationItem::find()
                        ->where(['STUDENTID' => $AllStudent[$i]['STUDENTID']])
//                        ->andWhere(['rooms_id' => $ROOM['rooms_id']])
//                        ->andWhere(['exam_date' => $AllExam[$j]['exam_date']])
                        ->andWhere(['subject_id' => $AllExam[$j]['subject_id']])
                        ->all();

                    if (count($checkStd)==0) {
                        if ($AllExam[$j]['room_tag'] == 'A') {
                            if ($num < 10){
                                $tag = 'A0' . $num;
                                $this->InsertStudent(
                                    $AllStudent[$i]['STUDENTID'],
                                    $AllExam[$j]['subject_id'],
                                    $ROOM['rooms_id'],
                                    $AllExam[$j]['exam_date'],
                                    $AllExam[$j]['exam_start_time'],
                                    $AllExam[$j]['exam_end_time'],
                                    $tag
                                );
                            }else{
                                $tag = 'A' . $num;
                                $this->InsertStudent(
                                    $AllStudent[$i]['STUDENTID'],
                                    $AllExam[$j]['subject_id'],
                                    $ROOM['rooms_id'],
                                    $AllExam[$j]['exam_date'],
                                    $AllExam[$j]['exam_start_time'],
                                    $AllExam[$j]['exam_end_time'],
                                    $tag
                                );
                            }
                        } else {
                            if ($num < 10){
                                $tag = 'B0' . $num;
                                $this->InsertStudent(
                                    $AllStudent[$i]['STUDENTID'],
                                    $AllExam[$j]['subject_id'],
                                    $ROOM['rooms_id'],
                                    $AllExam[$j]['exam_date'],
                                    $AllExam[$j]['exam_start_time'],
                                    $AllExam[$j]['exam_end_time'],
                                    $tag
                                );
                            }else{
                                $tag = 'B' . $num;
                                $this->InsertStudent(
                                    $AllStudent[$i]['STUDENTID'],
                                    $AllExam[$j]['subject_id'],
                                    $ROOM['rooms_id'],
                                    $AllExam[$j]['exam_date'],
                                    $AllExam[$j]['exam_start_time'],
                                    $AllExam[$j]['exam_end_time'],
                                    $tag
                                );
                            }
                        }
                        $num = $num + 1;
                    }
                }
            }


            //}


//        echo "STUDENT"."<pre>";
//        print_r($AllStudent);
//        echo "</pre>";

        return $this->redirect('show-exam-room');
        }
    }



    protected function Bestfit($AllEnroll){

        $Examination = [];
        $BestFit = [];

        $AllEnrollA = $this->QueryEnrollA($AllEnroll);
        $AllEnrollA = $this->SortArray($AllEnrollA);
        $AllRoomA = $this->GetRoomA(0, $AllEnrollA[0]['TIME']);

        if ($AllEnrollA[0]['SEAT'] >= $AllRoomA[0]['SEAT']) {
            $num = $AllEnrollA[0]['SEAT'] - $AllRoomA[0]['SEAT']; //หาผลจำนวนที่เหลือ
            $AllEnrollA[0]['SEAT_temp'] = $num;
            $AllRoomA[0]['SEAT'] = 0;
        } else {
            $num = $AllRoomA[0]['SEAT'] - $AllEnrollA[0]['SEAT']; //หาผลจำนวนที่เหลือ
            $num = $AllRoomA[0]['SEAT'] = $num;
            $AllEnrollA[0]['SEAT_temp'] = 0;
        }

        $BestFit['SUBJECT'] = $AllEnrollA[0];
        $BestFit['ROOM'] = $AllRoomA[0];
        array_push($Examination,$BestFit);



        $AllEnrollB = $this->QueryEnrollB($AllEnroll);
        $AllEnrollB = $this->SortArray($AllEnrollB);
        $AllRoomB = $this->GetRoomB(0, $AllEnrollB[0]['TIME']);


        if ($AllEnrollB[0]['SEAT'] >= $AllRoomB[0]['SEAT']) {
            $num = $AllEnrollB[0]['SEAT'] - $AllRoomB[0]['SEAT']; //หาผลจำนวนที่เหลือ
            $AllEnrollB[0]['SEAT_temp'] = $num;
            $AllRoomB[0]['SEAT'] = 0;
        } else {
            $num = $AllRoomB[0]['SEAT'] - $AllEnrollB[0]['SEAT']; //หาผลจำนวนที่เหลือ
            $num = $AllRoomB[0]['SEAT'] = $num;
            $AllEnrollB[0]['SEAT_temp'] = 0;
        }

        $BestFit['SUBJECT'] = $AllEnrollB[0];
        $BestFit['ROOM'] = $AllRoomB[0];
        array_push($Examination,$BestFit);

        $AllEnrollA = $this->SortArray($AllEnrollA);

        return $Examination;
    }

    protected function BestfitB($AllEnrollB){

        $Examination = [];
        $BestFit = [];


        $AllEnrollB = $this->SortArray($AllEnrollB);
        $AllRoomB = $this->GetRoomA(0, $AllEnrollB[0]['TIME']);

        if ($AllEnrollB[0]['SEAT'] >= $AllRoomB[0]['SEAT']) {
            $num = $AllEnrollB[0]['SEAT'] - $AllRoomB[0]['SEAT']; //หาผลจำนวนที่เหลือ
            $AllEnrollB[0]['SEAT_temp'] = $num;
            $AllRoomB[0]['SEAT'] = 0;
        } else {
            $num = $AllRoomB[0]['SEAT'] - $AllEnrollB[0]['SEAT']; //หาผลจำนวนที่เหลือ
            $num = $AllRoomB[0]['SEAT'] = $num;
            $AllEnrollB[0]['SEAT_temp'] = 0;
        }

        $BestFit['SUBJECT'] = $AllEnrollB[0];
        $BestFit['ROOM'] = $AllRoomB[0];
        array_push($Examination,$BestFit);

        $AllEnrollA = $this->SortArray($AllEnrollB);

        return $Examination;
    }

    protected function SortArray($array){
        $SEAT = array();
        foreach ($array as $key => $row)
        {
            $SEAT[$key] = $row['SEAT'];
        }
        array_multisort($SEAT, SORT_DESC, $array);

        return $array;
    }

    protected function SortArrayTemp($array){
        $SEAT_temp = array();
        foreach ($array as $key => $row)
        {
            $SEAT_temp[$key] = $row['SEAT_temp'];
        }
        array_multisort($SEAT_temp, SORT_ASC, $array);

        return $array;
    }

    protected function QueryEnrollA($getEnroll){

        if (count($getEnroll) % 2 == 0) {
            $HalfEnroll = ceil(count($getEnroll) / 4); //แบ่งครึ่ง ENROLL เพื่อจัดใส่แต่ละ TAG
            $AllEnrollA = [];

            for ($i=0;$i<$HalfEnroll-1;$i++){
                array_push($AllEnrollA, $getEnroll[$i]);
            }
            for ($i=count($getEnroll)-1;$i>=(count($getEnroll)-$HalfEnroll);$i--){
                array_push($AllEnrollA, $getEnroll[$i]);
            }
            return $AllEnrollA;
        }else{
            $HalfEnroll = ceil((count($getEnroll)-1) / 4); //แบ่งครึ่ง ENROLL เพื่อจัดใส่แต่ละ TAG
            $AllEnrollA = [];

            for ($i=0;$i<$HalfEnroll;$i++){
                array_push($AllEnrollA, $getEnroll[$i]);
            }
            for ($i=count($getEnroll)-1;$i>=(count($getEnroll)-$HalfEnroll);$i--){
                array_push($AllEnrollA, $getEnroll[$i]);
            }
            return $AllEnrollA;
        }

    } //QUERY ENROLL FOR TAG A

//    protected function QueryEnrollA($i){
//        $session = Yii::$app->session;
//        $getEnroll = Enroll::find()//QUERY ENROLL ทั้งหมด
//        ->where(['exam_enroll_date' => $session['date']['' . $i]])
//            //->andWhere(['exam_enroll_seat_temp'] != '0')
//            ->orderBy(['exam_enroll_seat_temp' => SORT_DESC])
//            ->all();
//
//        $HalfEnroll = ceil(count($getEnroll) / 4); //แบ่งครึ่ง ENROLL เพื่อจัดใส่แต่ละ TAG
//
//        $AllEnrollA = [];
//        $getEnroll = Enroll::find()//เลือกวิชาที่มีคนลงทะเบียนเยอะ
//        ->where(['exam_enroll_date' => $session['date']['' . $i]])
//            // ->andWhere(['exam_enroll_seat_temp'] != 0)
//            ->orderBy(['exam_enroll_seat_temp' => SORT_DESC])
//            ->limit($HalfEnroll)
//            ->all();
//        foreach ($getEnroll as $item) {
//            $EnrollA = [];
//            $EnrollA['SECTION_NO'] = $item->section_no;
//            $EnrollA['SUBJECT_ID'] = $item->subject_id;
//            $EnrollA['SEBJECT_VERSION'] = $item->subject_version;
//            $EnrollA['SUBOPEN_SEMESTER'] = $item->subopen_semester;
//            $EnrollA['SUBOPEN_YEAR'] = $item->subopen_year;
//            $EnrollA['PROGRAM_ID'] = $item->program_id;
//            $EnrollA['PROGRAM_CLASS'] = $item->program_class;
//            $EnrollA['TEACHER_ID'] = $item->teacher_id;
//            $EnrollA['SEAT_temp'] = $item->exam_enroll_seat_temp;
//            $EnrollA['START_TIME'] = $item->exam_enroll_start_time;
//            $EnrollA['END_TIME'] = $item->exam_enroll_end_time;
//            $EnrollA['DATE'] = $item->exam_enroll_date;
//            $EnrollA['TYPE'] = $item->Examcode;
//            $EnrollA['TIME'] = $item->exam_enroll_time;
//            array_push($AllEnrollA, $EnrollA);
//        }
//
//        $getEnroll = Enroll::find()//เลือกวิชาที่มีคนลงทะเบียนเยอะ
//        ->where(['exam_enroll_date' => $session['date']['' . $i]])
//            //->andWhere(['exam_enroll_seat_temp'] != 0)
//            ->orderBy(['exam_enroll_seat_temp' => SORT_ASC])
//            ->limit($HalfEnroll)
//            ->all();
//        foreach ($getEnroll as $item) {
//            $EnrollA = [];
//            $EnrollA['SECTION_NO'] = $item->section_no;
//            $EnrollA['SUBJECT_ID'] = $item->subject_id;
//            $EnrollA['SEBJECT_VERSION'] = $item->subject_version;
//            $EnrollA['SUBOPEN_SEMESTER'] = $item->subopen_semester;
//            $EnrollA['SUBOPEN_YEAR'] = $item->subopen_year;
//            $EnrollA['PROGRAM_ID'] = $item->program_id;
//            $EnrollA['PROGRAM_CLASS'] = $item->program_class;
//            $EnrollA['TEACHER_ID'] = $item->teacher_id;
//            $EnrollA['SEAT_temp'] = $item->exam_enroll_seat_temp;
//            $EnrollA['START_TIME'] = $item->exam_enroll_start_time;
//            $EnrollA['END_TIME'] = $item->exam_enroll_end_time;
//            $EnrollA['DATE'] = $item->exam_enroll_date;
//            $EnrollA['TYPE'] = $item->Examcode;
//            $EnrollA['TIME'] = $item->exam_enroll_time;
//            array_push($AllEnrollA, $EnrollA);
//        }
//        return $AllEnrollA;
//    } //QUERY ENROLL FOR TAG A

    protected function QueryEnrollB($getEnroll){

//        $HalfEnroll = count($getEnroll) - ceil(count($getEnroll) / 2); //แบ่งครึ่ง ENROLL เพื่อจัดใส่แต่ละ TAG
//        $OffSetNum = ceil(count($getEnroll) / 4);

        if (count($getEnroll) % 2 == 0) {
            $HalfEnroll = ceil(count($getEnroll) / 4); //แบ่งครึ่ง ENROLL เพื่อจัดใส่แต่ละ TAG
            $AllEnrollB = [];
            for ($i=$HalfEnroll-1;$i<(count($getEnroll)-$HalfEnroll);$i++){
                array_push($AllEnrollB, $getEnroll[$i]);
            }
            return $AllEnrollB;
        } else {
             $HalfEnroll = ceil((count($getEnroll)-1) / 4); //แบ่งครึ่ง ENROLL เพื่อจัดใส่แต่ละ TAG
            $AllEnrollB = [];

            for ($i=$HalfEnroll;$i<(count($getEnroll)-$HalfEnroll);$i++) {
                array_push($AllEnrollB, $getEnroll[$i]);
            }
            return $AllEnrollB;
        }
    } //QUERY ENROLL FOR TAG B

//    protected function QueryEnrollB($i){
//        $session = Yii::$app->session;
//        $getEnroll = Enroll::find()//QUERY ENROLL ทั้งหมด
//        ->where(['exam_enroll_date' => $session['date']['' . $i]])
//            ->andWhere(['exam_enroll_seat_temp'] != '0')
//            ->orderBy(['exam_enroll_seat_temp' => SORT_DESC])
//            ->all();
//
//        $HalfEnroll = count($getEnroll) - ceil(count($getEnroll) / 2); //แบ่งครึ่ง ENROLL เพื่อจัดใส่แต่ละ TAG
//        $OffSetNum = ceil(count($getEnroll) / 4);
//
//
//        if ($HalfEnroll % 2 == 0) {
////                echo 'ลงตัวจ้า';
//            $AllEnrollB = [];
//            $getEnroll = Enroll::find()//เลือกวิชาที่มีคนลงทะเบียนเยอะ
//            ->where(['exam_enroll_date' => $session['date']['' . $i]])
//                ->andWhere(['exam_enroll_seat_temp'] != 0)
//                ->orderBy(['exam_enroll_seat_temp' => SORT_DESC])
//                ->limit(ceil($HalfEnroll / 2))
//                ->offset($OffSetNum)
//                ->all();
//            foreach ($getEnroll as $item) {
//                $EnrollB = [];
//                $EnrollB['SECTION_NO'] = $item->section_no;
//                $EnrollB['SUBJECT_ID'] = $item->subject_id;
//                $EnrollB['SEBJECT_VERSION'] = $item->subject_version;
//                $EnrollB['SUBOPEN_SEMESTER'] = $item->subopen_semester;
//                $EnrollB['SUBOPEN_YEAR'] = $item->subopen_year;
//                $EnrollB['PROGRAM_ID'] = $item->program_id;
//                $EnrollB['PROGRAM_CLASS'] = $item->program_class;
//                $EnrollB['TEACHER_ID'] = $item->teacher_id;
//                $EnrollB['SEAT_temp'] = $item->exam_enroll_seat_temp;
//                $EnrollB['START_TIME'] = $item->exam_enroll_start_time;
//                $EnrollB['END_TIME'] = $item->exam_enroll_end_time;
//                $EnrollB['DATE'] = $item->exam_enroll_date;
//                $EnrollB['TYPE'] = $item->Examcode;
//                $EnrollB['TIME'] = $item->exam_enroll_time;
//                array_push($AllEnrollB, $EnrollB);
//            }
//
//            $getEnroll = Enroll::find()//เลือกวิชาที่มีคนลงทะเบียนเยอะ
//            ->where(['exam_enroll_date' => $session['date']['' . $i]])
//                ->andWhere(['exam_enroll_seat_temp'] != 0)
//                ->orderBy(['exam_enroll_seat_temp' => SORT_ASC])
//                ->limit(ceil($HalfEnroll / 2))
//                ->offset($OffSetNum)
//                ->all();
//            foreach ($getEnroll as $item) {
//                $EnrollB = [];
//                $EnrollB['SECTION_NO'] = $item->section_no;
//                $EnrollB['SUBJECT_ID'] = $item->subject_id;
//                $EnrollB['SEBJECT_VERSION'] = $item->subject_version;
//                $EnrollB['SUBOPEN_SEMESTER'] = $item->subopen_semester;
//                $EnrollB['SUBOPEN_YEAR'] = $item->subopen_year;
//                $EnrollB['PROGRAM_ID'] = $item->program_id;
//                $EnrollB['PROGRAM_CLASS'] = $item->program_class;
//                $EnrollB['TEACHER_ID'] = $item->teacher_id;
//                $EnrollB['SEAT_temp'] = $item->exam_enroll_seat_temp;
//                $EnrollB['START_TIME'] = $item->exam_enroll_start_time;
//                $EnrollB['END_TIME'] = $item->exam_enroll_end_time;
//                $EnrollB['DATE'] = $item->exam_enroll_date;
//                $EnrollB['TYPE'] = $item->Examcode;
//                $EnrollB['TIME'] = $item->exam_enroll_time;
//                array_push($AllEnrollB, $EnrollB);
//            }
//        } else {
////                echo 'ไม่ลงตัวจ้า <br>';
////                echo($HalfEnroll);
////                echo '<br>';
//            $AllEnrollB = [];
//            $getEnroll = Enroll::find()//เลือกวิชาที่มีคนลงทะเบียนเยอะ
//            ->where(['exam_enroll_date' => $session['date']['' . $i]])
//                ->andWhere(['exam_enroll_seat_temp'] != 0)
//                ->orderBy(['exam_enroll_seat_temp' => SORT_DESC])
//                ->limit(ceil($HalfEnroll / 2))
//                ->offset($OffSetNum)
//                ->all();
//            foreach ($getEnroll as $item) {
//                $EnrollB = [];
//                $EnrollB['SECTION_NO'] = $item->section_no;
//                $EnrollB['SUBJECT_ID'] = $item->subject_id;
//                $EnrollB['SEBJECT_VERSION'] = $item->subject_version;
//                $EnrollB['SUBOPEN_SEMESTER'] = $item->subopen_semester;
//                $EnrollB['SUBOPEN_YEAR'] = $item->subopen_year;
//                $EnrollB['PROGRAM_ID'] = $item->program_id;
//                $EnrollB['PROGRAM_CLASS'] = $item->program_class;
//                $EnrollB['TEACHER_ID'] = $item->teacher_id;
//                $EnrollB['SEAT_temp'] = $item->exam_enroll_seat_temp;
//                $EnrollB['START_TIME'] = $item->exam_enroll_start_time;
//                $EnrollB['END_TIME'] = $item->exam_enroll_end_time;
//                $EnrollB['DATE'] = $item->exam_enroll_date;
//                $EnrollB['TYPE'] = $item->Examcode;
//                $EnrollB['TIME'] = $item->exam_enroll_time;
//                array_push($AllEnrollB, $EnrollB);
//            }
//
//            $getEnroll = Enroll::find()//เลือกวิชาที่มีคนลงทะเบียนเยอะ
//            ->where(['exam_enroll_date' => $session['date']['' . $i]])
//                ->andWhere(['exam_enroll_seat_temp'] != 0)
//                ->orderBy(['exam_enroll_seat_temp' => SORT_ASC])
//                ->limit(ceil($HalfEnroll / 2) - 1)
//                ->offset($OffSetNum)
//                ->all();
//            foreach ($getEnroll as $item) {
//                $EnrollB = [];
//                $EnrollB['SECTION_NO'] = $item->section_no;
//                $EnrollB['SUBJECT_ID'] = $item->subject_id;
//                $EnrollB['SEBJECT_VERSION'] = $item->subject_version;
//                $EnrollB['SUBOPEN_SEMESTER'] = $item->subopen_semester;
//                $EnrollB['SUBOPEN_YEAR'] = $item->subopen_year;
//                $EnrollB['PROGRAM_ID'] = $item->program_id;
//                $EnrollB['PROGRAM_CLASS'] = $item->program_class;
//                $EnrollB['TEACHER_ID'] = $item->teacher_id;
//                $EnrollB['SEAT_temp'] = $item->exam_enroll_seat_temp;
//                $EnrollB['START_TIME'] = $item->exam_enroll_start_time;
//                $EnrollB['END_TIME'] = $item->exam_enroll_end_time;
//                $EnrollB['DATE'] = $item->exam_enroll_date;
//                $EnrollB['TYPE'] = $item->Examcode;
//                $EnrollB['TIME'] = $item->exam_enroll_time;
//                array_push($AllEnrollB, $EnrollB);
//            }
//        }
//        return $AllEnrollB;
//    } //QUERY ENROLL FOR TAG B

    protected function GetRoomA($i,$timeA){
        $session = Yii::$app->session;
        $getRoom = ExamRoomDetail::find()->where([
            'rooms_detail_date' => $session['date']['' . $i],
            'exam_room_status' => '0',
            'rooms_detail_time'=> $timeA])
            ->orderBy(['exam_rooms_seat'=>SORT_DESC])
            ->all();

        $AllRoomA = [];
        $AllSeatA = 0;
        $AllRoomB = [];
        $AllSeatB = 0;

        foreach ($getRoom as $item) {
            $getARoom = [];
            $getBRoom = [];
            if ($item->exam_room_tag == 'A') {
                $getARoom['ROOMID'] = $item->rooms_id;
                $getARoom['TAG'] = $item->exam_room_tag;
                $getARoom['TIME'] = $item->rooms_detail_time;
                $getARoom['DATE'] = $item->rooms_detail_date;
                $getARoom['SEAT'] = $item->exam_rooms_seat;
                $getARoom['SEAT_temp'] = $item->exam_rooms_seat_temp;
                array_push($AllRoomA, $getARoom);
                $AllSeatA = $AllSeatA + $item->exam_rooms_seat_temp;
            } else {
                $getBRoom['ROOMID'] = $item->rooms_id;
                $getBRoom['TAG'] = $item->exam_room_tag;
                $getBRoom['TIME'] = $item->rooms_detail_time;
                $getBRoom['DATE'] = $item->rooms_detail_date;
                $getBRoom['SEAT'] = $item->exam_rooms_seat;
                $getBRoom['SEAT_temp'] = $item->exam_rooms_seat_temp;
                array_push($AllRoomB, $getBRoom);
                $AllSeatB = $AllSeatB + $item->exam_rooms_seat_temp;
            }
        }
        return $AllRoomA;
    }

    protected function GetRoomB($i,$timeB){
        $session = Yii::$app->session;
        $getRoom = ExamRoomDetail::find()->where([
            'rooms_detail_date' => $session['date']['' . $i],
            'exam_room_status' => '0',
            'rooms_detail_time'=> $timeB,])
            ->orderBy(['exam_rooms_seat'=>SORT_DESC])
            ->all();

        $AllRoomA = [];
        $AllSeatA = 0;
        $AllRoomB = [];
        $AllSeatB = 0;
        foreach ($getRoom as $item) {
            $getARoom = [];
            $getBRoom = [];
            if ($item->exam_room_tag == 'A') {
                $getARoom['ROOMID'] = $item->rooms_id;
                $getARoom['TAG'] = $item->exam_room_tag;
                $getARoom['TIME'] = $item->rooms_detail_time;
                $getARoom['DATE'] = $item->rooms_detail_date;
                $getARoom['SEAT'] = $item->exam_rooms_seat;
                $getARoom['SEAT_temp'] = $item->exam_rooms_seat_temp;
                array_push($AllRoomA, $getARoom);
                $AllSeatA = $AllSeatA + $item->exam_rooms_seat_temp;
            } else {
                $getBRoom['ROOMID'] = $item->rooms_id;
                $getBRoom['TAG'] = $item->exam_room_tag;
                $getBRoom['TIME'] = $item->rooms_detail_time;
                $getBRoom['DATE'] = $item->rooms_detail_date;
                $getBRoom['SEAT'] = $item->exam_rooms_seat;
                $getBRoom['SEAT_temp'] = $item->exam_rooms_seat_temp;
                array_push($AllRoomB, $getBRoom);
                $AllSeatB = $AllSeatB + $item->exam_rooms_seat_temp;
            }
        }
        return $AllRoomB;
    }

    protected function Priority($j,$AllEnroll,$AllRoom)
    {
//        $AllEnroll = $this->QueryEnrollA(0);
//        $AllEnroll = $this->SortArray($AllEnroll);
//        $AllRoom= $this->GetRoomA(0,$AllEnroll[0]['TIME']);
            if ($AllEnroll[$j]['SEAT_temp'] >= $AllRoom[$j]['SEAT_temp']) {
                $num = $AllEnroll[$j]['SEAT_temp'] - $AllRoom[$j]['SEAT_temp']; //หาผลจำนวนที่เหลือ

                $this->UpdateEnroll(
                    $AllEnroll[$j]['SECTION_NO'],
                    $AllEnroll[$j]['SUBJECT_ID'],
                    $AllEnroll[$j]['SEBJECT_VERSION'],
                    $AllEnroll[$j]['SUBOPEN_SEMESTER'],
                    $AllEnroll[$j]['SUBOPEN_YEAR'],
                    $AllEnroll[$j]['PROGRAM_ID'],
                    $AllEnroll[$j]['PROGRAM_CLASS'],
                    $AllEnroll[$j]['TEACHER_ID'],
                    $num);

                $this->UpdateSeat(
                    $AllRoom[$j]['ROOMID'],
                    $AllRoom[$j]['TAG'],
                    $AllRoom[$j]['TIME'],
                    $AllRoom[$j]['DATE'],
                    0);

                $this->UpdateStatus(
                    $AllRoom[$j]['ROOMID'],
                    $AllRoom[$j]['TAG'],
                    $AllRoom[$j]['TIME'],
                    $AllRoom[$j]['DATE']);

                // echo "คนเยอะกว่าห้อง";
            } else {
                $num = $AllRoom[$j]['SEAT_temp'] - $AllEnroll[$j]['SEAT_temp']; //หาผลจำนวนที่เหลือ

                $this->UpdateSeat(
                    $AllRoom[$j]['ROOMID'],
                    $AllRoom[$j]['TAG'],
                    $AllRoom[$j]['TIME'],
                    $AllRoom[$j]['DATE'],
                    $num);

                if ($num == 0) {
                    $this->UpdateStatus(
                        $AllRoom[$j]['ROOMID'],
                        $AllRoom[$j]['TAG'],
                        $AllRoom[$j]['TIME'],
                        $AllRoom[$j]['DATE']);
                }

                $this->UpdateEnroll(
                    $AllEnroll[$j]['SECTION_NO'],
                    $AllEnroll[$j]['SUBJECT_ID'],
                    $AllEnroll[$j]['SEBJECT_VERSION'],
                    $AllEnroll[$j]['SUBOPEN_SEMESTER'],
                    $AllEnroll[$j]['SUBOPEN_YEAR'],
                    $AllEnroll[$j]['PROGRAM_ID'],
                    $AllEnroll[$j]['PROGRAM_CLASS'],
                    $AllEnroll[$j]['TEACHER_ID'],
                    0);
            }
            $this->InsertExam(
                $AllRoom[$j]['ROOMID'],
                $AllEnroll[$j]['SUBJECT_ID'],
                $AllEnroll[0]['SECTION_NO'],
                $AllEnroll[$j]['PROGRAM_CLASS'],
                $AllEnroll[$j]['DATE'],
                $AllEnroll[$j]['START_TIME'],
                $AllEnroll[$j]['END_TIME']
            );
        }

 //จัดห้องสอบ Tag A

    protected function PriorityTagB($AllEnrollItem)
    {
        for($i = 0 ; $i < count($AllEnrollItem[0]) ; $i++){
            $AllEnrollItem = $this->QueryEnroll(0);
            $AllTagB = $this->QueryRoomTagB(0,$AllEnrollItem);

            if ( $AllEnrollItem[0][0][10]>=$AllTagB[0][0][3]) {
                $num =  $AllEnrollItem[0][0][10] - $AllTagB[0][0][3]; //หาผลจำนวนที่เหลือ

                $this->UpdateEnroll(
                    $AllEnrollItem[0][0][0],
                    $AllEnrollItem[0][0][1],
                    $AllEnrollItem[0][0][2],
                    $AllEnrollItem[0][0][3],
                    $AllEnrollItem[0][0][4],
                    $AllEnrollItem[0][0][5],
                    $AllEnrollItem[0][0][6],
                    $AllEnrollItem[0][0][7],
                    $num);

                $this->UpdateSeat($AllTagB[0][0][0],
                    $AllTagB[0][0][1],
                    $AllTagB[0][0][4],
                    $AllTagB[0][0][6],
                    0);

                $this->UpdateStatus($AllTagB[0][0][0],
                    $AllTagB[0][0][1],
                    $AllTagB[0][0][4],
                    $AllTagB[0][0][6],
                    0);

                // echo "คนเยอะกว่าห้อง";
            }else{
                $num = $AllTagB[0][0][3] -  $AllEnrollItem[0][0][10]; //หาผลจำนวนที่เหลือ

                $this->UpdateSeat($AllTagB[0][0][0],
                    $AllTagB[0][0][1],
                    $AllTagB[0][0][4],
                    $AllTagB[0][0][6],
                    $num);

                if($num == 0 ){
                    $this->UpdateStatus($AllTagB[0][0][0],
                        $AllTagB[0][0][1],
                        $AllTagB[0][0][4],
                        $AllTagB[0][0][6],
                        0);
                }
            }
            $this->InsertExam(
                $AllTagB[0][0][0],
                $AllEnrollItem[0][0][1],
                $AllEnrollItem[0][0][6],
                $AllEnrollItem[0][0][13],
                $AllEnrollItem[0][0][11],
                $AllEnrollItem[0][0][12]
            );
        }

    }  //จัดห้องสอบ Tag B


    //update enroll
    protected function findEnrollModel($section_no, $subject_id, $subject_version, $subopen_semester, $subopen_year, $program_id, $program_class, $teacher_id)
    {
        if (($model = Enroll::findOne(['section_no' => $section_no, 'subject_id' => $subject_id, 'subject_version' => $subject_version, 'subopen_semester' => $subopen_semester, 'subopen_year' => $subopen_year, 'program_id' => $program_id, 'program_class' => $program_class, 'teacher_id' => $teacher_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function UpdateEnroll($section_no, $subject_id, $subject_version, $subopen_semester, $subopen_year, $program_id, $program_class, $teacher_id,$num)
    {
        $model = $this->findEnrollModel($section_no, $subject_id, $subject_version, $subopen_semester, $subopen_year, $program_id, $program_class, $teacher_id);
        if(isset($_POST)) {
            $model->load(Yii::$app->request->post());
            $update = $model;
            $update->exam_enroll_seat_temp = $num;
            $update->save(false);
        }
    }
    //end update enroll

    //update room
    protected function findRoomModel($rooms_id, $exam_room_tag, $rooms_detail_time,$rooms_detail_date)
    {
        if (($model = ExamRoomDetail::findOne(['rooms_detail_date' => $rooms_detail_date, 'rooms_detail_time' => $rooms_detail_time, 'rooms_id' => $rooms_id, 'exam_room_tag' => $exam_room_tag])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function UpdateStatus($rooms_id, $exam_room_tag, $rooms_detail_time,$rooms_detail_date)
    {
        $model = $this->findRoomModel($rooms_id, $exam_room_tag, $rooms_detail_time,$rooms_detail_date);
        if(isset($_POST)) {
            $model->load(Yii::$app->request->post());
            $update = $model;
            $update->exam_room_status = '1';
            $update->save(false);
        }
    }

    protected function UpdateSeat($rooms_id, $exam_room_tag, $rooms_detail_time,$rooms_detail_date,$num)
    {
        $model = $this->findRoomModel($rooms_id, $exam_room_tag, $rooms_detail_time,$rooms_detail_date);
        if(isset($_POST)) {
            $model->load(Yii::$app->request->post());
            $update = $model;
            $update->exam_rooms_seat_temp = $num;
            $update->save(false);
        }
    }

    //end update room

    //insert examination
    protected function findExaminationModel($rooms_id, $subject_id, $program_class, $exam_date,$exam_start_time,$exam_end_time)
    {
        if (($model = EofficeExamExamination::findOne(['rooms_id' => $rooms_id, 'subject_id' => $subject_id,'program_class' => $program_class, 'exam_date' => $exam_date,'exam_start_time' => $exam_start_time,'exam_end_time' => $exam_end_time])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function InsertExam($rooms_id,$room_tag,$subject_id,$program_class, $exam_date,$exam_start_time,$exam_end_time)
    {
        $model = new EofficeExamExamination();
        if(isset($_POST)) {
            $model->load(Yii::$app->request->post());
            $update = $model;
            $update->rooms_id = $rooms_id;
            $update->subject_id = $subject_id;
            $update->room_tag = $room_tag;
            $update->program_class = $program_class;
            $update->exam_date =$exam_date ;
            $update->exam_start_time =$exam_start_time ;
            $update->exam_end_time = $exam_end_time;
            $update->save(false);
        }
    }
    //end insert examination

    //insert student
    protected function findExaminationItemModel($STUDENTID, $rooms_id,$exam_date, $exam_start_time, $exam_end_time)
    {
        if (($model = EofficeExamExaminationItem::findOne(['STUDENTID' => $STUDENTID, 'rooms_id' => $rooms_id,'exam_date'=>$exam_date, 'exam_start_time' => $exam_start_time, 'exam_end_time' => $exam_end_time])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function InsertStudent($STUDENTID,$subject_id,$rooms_id,$exam_date,$exam_start_time,$exam_end_time,$exam_seat)
    {
        $model = new EofficeExamExaminationItem();
        if(isset($_POST)) {
            $model->load(Yii::$app->request->post());
            $update = $model;
            $update->STUDENTID = $STUDENTID;
            $update->subject_id = $subject_id;
            $update->rooms_id = $rooms_id;
            $update->exam_date = $exam_date;
            $update->exam_start_time = $exam_start_time;
            $update->exam_end_time = $exam_end_time;
            $update->exam_seat = $exam_seat;
            $update->save(false);
        }
    }
    //end insert examination
}
