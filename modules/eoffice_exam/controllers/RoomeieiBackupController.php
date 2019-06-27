<?php

namespace app\modules\eoffice_exam\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Html;
use app\modules\eoffice_exam\models\ExamDetailExamination;
use app\modules\eoffice_exam\models\Enroll;
use app\modules\eoffice_exam\models\ExamRoomDetail;
use app\modules\eoffice_exam\models\EofficeExamExamination;
use app\modules\eoffice_exam\models\EofficeExamExaminationSearch;
use yii\behaviors\TimestampBehavior;


use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class RoomController extends \yii\web\Controller
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

            return $this->redirect(['examprocess']); //return to action enrollprocess
        }else {
            return $this->redirect(['examprocess']); //return to action enrollprocess
        }
    }

    public function actionExamprocess()  //this action for manage exam room
    {
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
        //print_r($dateArray);
// end count days

        $session['date'] = $dateArray;

        $session = Yii::$app->session;



            //////////////////////////////////////AAAAAAAAAAA//////////////////////////////////////////////////

            //////////////////////////////////////AAAAAAAAAAA//////////////////////////////////////////////////

            //////////////////////////////////////////BBBBBBBBBB///////////////////////////////////////////////////
            //$AllEnrollB = $this->QueryEnrollB($i);
            //////////////////////////////////////////BBBBBBBBBB///////////////////////////////////////////////////

//            echo 'ENROLL TAG B<br>';
//            echo 'วันที่' . $dateArray[0] . '<pre>';
//            print_r($AllEnrollB);
//            echo '</pre>';
//            echo 'ROOM TAG B <br>';
//            echo 'วันที่' . $dateArray[$i] . '<pre>';
//            print_r($AllRoomB);
//            echo '</pre>';


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//        echo 'ENROLL TAG A<br>';
//        echo '<pre>';
//        print_r($AllEnrollA);
//        echo '</pre>';


//        echo 'ROOM TAG A <br>';
//        echo '<pre>';
//        print_r($AllRoomA);
//        echo '</pre>';


//        echo 'ENROLL<br>';
//        echo '<pre>';
//        $AllEnrollA = $this->QueryEnrollA(0);
//        $AllEnrollA = $this->SortArray($AllEnrollA);
//        print_r($AllEnrollA);
//        echo '</pre>';


        //BEST FIT TAG A//

        $AllEnrollA = $this->QueryEnrollA(0);
        $AllEnrollA = $this->SortArray($AllEnrollA);
        $AllRoomA = $this->GetRoomA(0,$AllEnrollA[0]['TIME']);
        $this->BestFit($AllEnrollA,$AllRoomA);

        //BEST FIT TAG A//


        //PIORITY TAG A//

        $AllEnrollA = $this->QueryEnrollA(0);
        $AllEnrollA = $this->SortArray($AllEnrollA);
        $AllRoomA= $this->GetRoomA(0,$AllEnrollA[0]['TIME']);
        $this->Priority(0,$AllEnrollA,$AllRoomA);
//
        $AllEnrollA = $this->QueryEnrollA(0);
        $AllEnrollA = $this->SortArray($AllEnrollA);
        $AllRoomA= $this->GetRoomA(0,$AllEnrollA[0]['TIME']);
        $this->Priority(0,$AllEnrollA,$AllRoomA);
//
//        $AllEnrollA = $this->QueryEnrollA(0);
//        $AllEnrollA = $this->SortArray($AllEnrollA);
//        $AllRoomA= $this->GetRoomA(0,$AllEnrollA[0]['TIME']);
//        $this->Priority(0,$AllEnrollA,$AllRoomA);
//
//        $AllEnrollA = $this->QueryEnrollA(0);
//        $AllEnrollA = $this->SortArray($AllEnrollA);
//        $AllRoomA= $this->GetRoomA(0,$AllEnrollA[0]['TIME']);
//        $this->Priority(0,$AllEnrollA,$AllRoomA);
//
//        $AllEnrollA = $this->QueryEnrollA(0);
//        $AllEnrollA = $this->SortArray($AllEnrollA);
//        $AllRoomA= $this->GetRoomA(0,$AllEnrollA[0]['TIME']);
//        $this->Priority(0,$AllEnrollA,$AllRoomA);
//
//        $AllEnrollA = $this->QueryEnrollA(0);
//        $AllEnrollA = $this->SortArray($AllEnrollA);
//        $AllRoomA= $this->GetRoomA(0,$AllEnrollA[0]['TIME']);
//        $this->Priority(0,$AllEnrollA,$AllRoomA);
//
//        $AllEnrollA = $this->QueryEnrollA(0);
//        $AllEnrollA = $this->SortArray($AllEnrollA);
//        $AllRoomA= $this->GetRoomA(0,$AllEnrollA[0]['TIME']);
//        $this->Priority(0,$AllEnrollA,$AllRoomA);
//
//        $AllEnrollA = $this->QueryEnrollA(0);
//        $AllEnrollA = $this->SortArray($AllEnrollA);
//        $AllRoomA= $this->GetRoomA(0,$AllEnrollA[0]['TIME']);
//        $this->Priority(0,$AllEnrollA,$AllRoomA);
//
//        $AllEnrollA = $this->QueryEnrollA(0);
//        $AllEnrollA = $this->SortArray($AllEnrollA);
//        $AllRoomA= $this->GetRoomA(0,$AllEnrollA[0]['TIME']);
//        $this->Priority(0,$AllEnrollA,$AllRoomA);
//
//        $AllEnrollA = $this->QueryEnrollA(0);
//        $AllEnrollA = $this->SortArray($AllEnrollA);
//        $AllRoomA= $this->GetRoomA(0,$AllEnrollA[0]['TIME']);
//        $this->Priority(0,$AllEnrollA,$AllRoomA);
//

        echo 'ENROLL<br>';
        echo '<pre>';
        $AllEnrollA = $this->QueryEnrollA(0);
        $AllEnrollA = $this->SortArray($AllEnrollA);
        print_r($AllEnrollA);
        echo '</pre>';

        $searchModel = new EofficeExamExaminationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('preview',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    protected function SortArray($array){
        $SEAT_TEMP = array();
        foreach ($array as $key => $row)
        {
            $SEAT_TEMP[$key] = $row['SEAT_temp'];
        }
        array_multisort($SEAT_TEMP, SORT_DESC, $array);

        return $array;
    }

    protected function QueryEnrollA($i){
        $session = Yii::$app->session;
        $getEnroll = Enroll::find()//QUERY ENROLL ทั้งหมด
        ->where(['exam_enroll_date' => $session['date']['' . $i]])
            //->andWhere(['exam_enroll_seat_temp'] != '0')
            ->orderBy(['exam_enroll_seat_temp' => SORT_DESC])
            ->all();

        $HalfEnroll = ceil(count($getEnroll) / 4); //แบ่งครึ่ง ENROLL เพื่อจัดใส่แต่ละ TAG

        $AllEnrollA = [];
        $getEnroll = Enroll::find()//เลือกวิชาที่มีคนลงทะเบียนเยอะ
        ->where(['exam_enroll_date' => $session['date']['' . $i]])
           // ->andWhere(['exam_enroll_seat_temp'] != 0)
            ->orderBy(['exam_enroll_seat_temp' => SORT_DESC])
            ->limit($HalfEnroll)
            ->all();
        foreach ($getEnroll as $item) {
            $EnrollA = [];
            $EnrollA['SECTION_NO'] = $item->section_no;
            $EnrollA['SUBJECT_ID'] = $item->subject_id;
            $EnrollA['SEBJECT_VERSION'] = $item->subject_version;
            $EnrollA['SUBOPEN_SEMESTER'] = $item->subopen_semester;
            $EnrollA['SUBOPEN_YEAR'] = $item->subopen_year;
            $EnrollA['PROGRAM_ID'] = $item->program_id;
            $EnrollA['PROGRAM_CLASS'] = $item->program_class;
            $EnrollA['TEACHER_ID'] = $item->teacher_id;
            $EnrollA['SEAT_temp'] = $item->exam_enroll_seat_temp;
            $EnrollA['START_TIME'] = $item->exam_enroll_start_time;
            $EnrollA['END_TIME'] = $item->exam_enroll_end_time;
            $EnrollA['DATE'] = $item->exam_enroll_date;
            $EnrollA['TYPE'] = $item->Examcode;
            $EnrollA['TIME'] = $item->exam_enroll_time;
            array_push($AllEnrollA, $EnrollA);
        }

        $getEnroll = Enroll::find()//เลือกวิชาที่มีคนลงทะเบียนเยอะ
        ->where(['exam_enroll_date' => $session['date']['' . $i]])
            //->andWhere(['exam_enroll_seat_temp'] != 0)
            ->orderBy(['exam_enroll_seat_temp' => SORT_ASC])
            ->limit($HalfEnroll)
            ->all();
        foreach ($getEnroll as $item) {
            $EnrollA = [];
            $EnrollA['SECTION_NO'] = $item->section_no;
            $EnrollA['SUBJECT_ID'] = $item->subject_id;
            $EnrollA['SEBJECT_VERSION'] = $item->subject_version;
            $EnrollA['SUBOPEN_SEMESTER'] = $item->subopen_semester;
            $EnrollA['SUBOPEN_YEAR'] = $item->subopen_year;
            $EnrollA['PROGRAM_ID'] = $item->program_id;
            $EnrollA['PROGRAM_CLASS'] = $item->program_class;
            $EnrollA['TEACHER_ID'] = $item->teacher_id;
            $EnrollA['SEAT_temp'] = $item->exam_enroll_seat_temp;
            $EnrollA['START_TIME'] = $item->exam_enroll_start_time;
            $EnrollA['END_TIME'] = $item->exam_enroll_end_time;
            $EnrollA['DATE'] = $item->exam_enroll_date;
            $EnrollA['TYPE'] = $item->Examcode;
            $EnrollA['TIME'] = $item->exam_enroll_time;
            array_push($AllEnrollA, $EnrollA);
        }
        return $AllEnrollA;
    } //QUERY ENROLL FOR TAG A

    protected function QueryEnrollB($i){
        $session = Yii::$app->session;
        $getEnroll = Enroll::find()//QUERY ENROLL ทั้งหมด
        ->where(['exam_enroll_date' => $session['date']['' . $i]])
            ->andWhere(['exam_enroll_seat_temp'] != '0')
            ->orderBy(['exam_enroll_seat_temp' => SORT_DESC])
            ->all();

        $HalfEnroll = count($getEnroll) - ceil(count($getEnroll) / 2); //แบ่งครึ่ง ENROLL เพื่อจัดใส่แต่ละ TAG
        $OffSetNum = ceil(count($getEnroll) / 4);


        if ($HalfEnroll % 2 == 0) {
//                echo 'ลงตัวจ้า';
            $AllEnrollB = [];
            $getEnroll = Enroll::find()//เลือกวิชาที่มีคนลงทะเบียนเยอะ
            ->where(['exam_enroll_date' => $session['date']['' . $i]])
                ->andWhere(['exam_enroll_seat_temp'] != 0)
                ->orderBy(['exam_enroll_seat_temp' => SORT_DESC])
                ->limit(ceil($HalfEnroll / 2))
                ->offset($OffSetNum)
                ->all();
            foreach ($getEnroll as $item) {
                $EnrollB = [];
                $EnrollB['SECTION_NO'] = $item->section_no;
                $EnrollB['SUBJECT_ID'] = $item->subject_id;
                $EnrollB['SEBJECT_VERSION'] = $item->subject_version;
                $EnrollB['SUBOPEN_SEMESTER'] = $item->subopen_semester;
                $EnrollB['SUBOPEN_YEAR'] = $item->subopen_year;
                $EnrollB['PROGRAM_ID'] = $item->program_id;
                $EnrollB['PROGRAM_CLASS'] = $item->program_class;
                $EnrollB['TEACHER_ID'] = $item->teacher_id;
                $EnrollB['SEAT_temp'] = $item->exam_enroll_seat_temp;
                $EnrollB['START_TIME'] = $item->exam_enroll_start_time;
                $EnrollB['END_TIME'] = $item->exam_enroll_end_time;
                $EnrollB['DATE'] = $item->exam_enroll_date;
                $EnrollB['TYPE'] = $item->Examcode;
                $EnrollB['TIME'] = $item->exam_enroll_time;
                array_push($AllEnrollB, $EnrollB);
            }

            $getEnroll = Enroll::find()//เลือกวิชาที่มีคนลงทะเบียนเยอะ
            ->where(['exam_enroll_date' => $session['date']['' . $i]])
                ->andWhere(['exam_enroll_seat_temp'] != 0)
                ->orderBy(['exam_enroll_seat_temp' => SORT_ASC])
                ->limit(ceil($HalfEnroll / 2))
                ->offset($OffSetNum)
                ->all();
            foreach ($getEnroll as $item) {
                $EnrollB = [];
                $EnrollB['SECTION_NO'] = $item->section_no;
                $EnrollB['SUBJECT_ID'] = $item->subject_id;
                $EnrollB['SEBJECT_VERSION'] = $item->subject_version;
                $EnrollB['SUBOPEN_SEMESTER'] = $item->subopen_semester;
                $EnrollB['SUBOPEN_YEAR'] = $item->subopen_year;
                $EnrollB['PROGRAM_ID'] = $item->program_id;
                $EnrollB['PROGRAM_CLASS'] = $item->program_class;
                $EnrollB['TEACHER_ID'] = $item->teacher_id;
                $EnrollB['SEAT_temp'] = $item->exam_enroll_seat_temp;
                $EnrollB['START_TIME'] = $item->exam_enroll_start_time;
                $EnrollB['END_TIME'] = $item->exam_enroll_end_time;
                $EnrollB['DATE'] = $item->exam_enroll_date;
                $EnrollB['TYPE'] = $item->Examcode;
                $EnrollB['TIME'] = $item->exam_enroll_time;
                array_push($AllEnrollB, $EnrollB);
            }
        } else {
//                echo 'ไม่ลงตัวจ้า <br>';
//                echo($HalfEnroll);
//                echo '<br>';
            $AllEnrollB = [];
            $getEnroll = Enroll::find()//เลือกวิชาที่มีคนลงทะเบียนเยอะ
            ->where(['exam_enroll_date' => $session['date']['' . $i]])
                ->andWhere(['exam_enroll_seat_temp'] != 0)
                ->orderBy(['exam_enroll_seat_temp' => SORT_DESC])
                ->limit(ceil($HalfEnroll / 2))
                ->offset($OffSetNum)
                ->all();
            foreach ($getEnroll as $item) {
                $EnrollB = [];
                $EnrollB['SECTION_NO'] = $item->section_no;
                $EnrollB['SUBJECT_ID'] = $item->subject_id;
                $EnrollB['SEBJECT_VERSION'] = $item->subject_version;
                $EnrollB['SUBOPEN_SEMESTER'] = $item->subopen_semester;
                $EnrollB['SUBOPEN_YEAR'] = $item->subopen_year;
                $EnrollB['PROGRAM_ID'] = $item->program_id;
                $EnrollB['PROGRAM_CLASS'] = $item->program_class;
                $EnrollB['TEACHER_ID'] = $item->teacher_id;
                $EnrollB['SEAT_temp'] = $item->exam_enroll_seat_temp;
                $EnrollB['START_TIME'] = $item->exam_enroll_start_time;
                $EnrollB['END_TIME'] = $item->exam_enroll_end_time;
                $EnrollB['DATE'] = $item->exam_enroll_date;
                $EnrollB['TYPE'] = $item->Examcode;
                $EnrollB['TIME'] = $item->exam_enroll_time;
                array_push($AllEnrollB, $EnrollB);
            }

            $getEnroll = Enroll::find()//เลือกวิชาที่มีคนลงทะเบียนเยอะ
            ->where(['exam_enroll_date' => $session['date']['' . $i]])
                ->andWhere(['exam_enroll_seat_temp'] != 0)
                ->orderBy(['exam_enroll_seat_temp' => SORT_ASC])
                ->limit(ceil($HalfEnroll / 2) - 1)
                ->offset($OffSetNum)
                ->all();
            foreach ($getEnroll as $item) {
                $EnrollB = [];
                $EnrollB['SECTION_NO'] = $item->section_no;
                $EnrollB['SUBJECT_ID'] = $item->subject_id;
                $EnrollB['SEBJECT_VERSION'] = $item->subject_version;
                $EnrollB['SUBOPEN_SEMESTER'] = $item->subopen_semester;
                $EnrollB['SUBOPEN_YEAR'] = $item->subopen_year;
                $EnrollB['PROGRAM_ID'] = $item->program_id;
                $EnrollB['PROGRAM_CLASS'] = $item->program_class;
                $EnrollB['TEACHER_ID'] = $item->teacher_id;
                $EnrollB['SEAT_temp'] = $item->exam_enroll_seat_temp;
                $EnrollB['START_TIME'] = $item->exam_enroll_start_time;
                $EnrollB['END_TIME'] = $item->exam_enroll_end_time;
                $EnrollB['DATE'] = $item->exam_enroll_date;
                $EnrollB['TYPE'] = $item->Examcode;
                $EnrollB['TIME'] = $item->exam_enroll_time;
                array_push($AllEnrollB, $EnrollB);
            }
        }
        return $AllEnrollB;
    } //QUERY ENROLL FOR TAG B

    protected function GetRoomA($i,$timeA){
        $session = Yii::$app->session;
        $getRoom = ExamRoomDetail::find()->where([
            'rooms_detail_date' => $session['date']['' . $i],
            'exam_room_status' => '0',
            'rooms_detail_time'=> $timeA,])
            ->orderBy(['exam_rooms_seat_temp'=>SORT_DESC])
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
                $getARoom['SEAT_temp'] = $item->exam_rooms_seat_temp;
                array_push($AllRoomA, $getARoom);
                $AllSeatA = $AllSeatA + $item->exam_rooms_seat_temp;
            } else {
                $getBRoom['ROOMID'] = $item->rooms_id;
                $getBRoom['TAG'] = $item->exam_room_tag;
                $getBRoom['TIME'] = $item->rooms_detail_time;
                $getBRoom['DATE'] = $item->rooms_detail_date;
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
            ->orderBy(['exam_rooms_seat_temp'=>SORT_DESC])
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
                $getARoom['SEAT_temp'] = $item->exam_rooms_seat_temp;
                array_push($AllRoomA, $getARoom);
                $AllSeatA = $AllSeatA + $item->exam_rooms_seat_temp;
            } else {
                $getBRoom['ROOMID'] = $item->rooms_id;
                $getBRoom['TAG'] = $item->exam_room_tag;
                $getBRoom['TIME'] = $item->rooms_detail_time;
                $getBRoom['DATE'] = $item->rooms_detail_date;
                $getBRoom['SEAT_temp'] = $item->exam_rooms_seat_temp;
                array_push($AllRoomB, $getBRoom);
                $AllSeatB = $AllSeatB + $item->exam_rooms_seat_temp;
            }
        }
        return $AllRoomB;
    }

    protected function BestFit($AllEnroll,$AllRoom)
    {
        if ( $AllEnroll[0]['SEAT_temp']>=$AllRoom[0]['SEAT_temp']) {
            $num =  $AllEnroll[0]['SEAT_temp'] - $AllRoom[0]['SEAT_temp']; //หาผลจำนวนที่เหลือ

            $this->UpdateEnroll(
                $AllEnroll[0]['SECTION_NO'],
                $AllEnroll[0]['SUBJECT_ID'],
                $AllEnroll[0]['SEBJECT_VERSION'],
                $AllEnroll[0]['SUBOPEN_SEMESTER'],
                $AllEnroll[0]['SUBOPEN_YEAR'],
                $AllEnroll[0]['PROGRAM_ID'],
                $AllEnroll[0]['PROGRAM_CLASS'],
                $AllEnroll[0]['TEACHER_ID'],
                $num);

            $this->UpdateSeat(
                $AllRoom[0]['ROOMID'],
                $AllRoom[0]['TAG'],
                $AllRoom[0]['TIME'],
                $AllRoom[0]['DATE'],
                0);

            $this->UpdateStatus(
                $AllRoom[0]['ROOMID'],
                $AllRoom[0]['TAG'],
                $AllRoom[0]['TIME'],
                $AllRoom[0]['DATE'],
                0);

            // echo "คนเยอะกว่าห้อง";
        }else{
            $num = $AllRoom[0]['SEAT_temp'] -  $AllEnroll[0]['SEAT_temp']; //หาผลจำนวนที่เหลือ

            $this->UpdateSeat(
                $AllRoom[0]['ROOMID'],
                $AllRoom[0]['TAG'],
                $AllRoom[0]['TIME'],
                $AllRoom[0]['DATE'],
                $num);

            if($num == 0 ){
                $this->UpdateStatus(
                    $AllRoom[0]['ROOMID'],
                    $AllRoom[0]['TAG'],
                    $AllRoom[0]['TIME'],
                    $AllRoom[0]['DATE'],
                    0);
            }
        }
        $this->InsertExam(
            $AllRoom[0]['ROOMID'],
            $AllEnroll[0]['SUBJECT_ID'],
            $AllEnroll[0]['SECTION_NO'],
            $AllEnroll[0]['PROGRAM_CLASS'],
            $AllEnroll[0]['DATE'],
            $AllEnroll[0]['START_TIME'],
            $AllEnroll[0]['END_TIME']
        );
    } //จัดห้องสอบรอบแรก

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
    protected function findExaminationModel($rooms_id, $subject_id,$section_no, $program_class, $exam_date,$exam_start_time,$exam_end_time)
    {
        if (($model = EofficeExamExamination::findOne(['rooms_id' => $rooms_id, 'subject_id' => $subject_id,'section_no'=>$section_no, 'program_class' => $program_class, 'exam_date' => $exam_date,'exam_start_time' => $exam_start_time,'exam_end_time' => $exam_end_time])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function InsertExam($rooms_id, $subject_id, $section_no,$program_class, $exam_date,$exam_start_time,$exam_end_time)
    {
        $model = new EofficeExamExamination();
        if(isset($_POST)) {
            $model->load(Yii::$app->request->post());
            $update = $model;
            $update->rooms_id = $rooms_id;
            $update->subject_id = $subject_id;
            $update->Section = $section_no;
            $update->room_tag = 'A';
            $update->program_class = $program_class;
            $update->exam_date =$exam_date ;
            $update->exam_start_time =$exam_start_time ;
            $update->exam_end_time = $exam_end_time;
            $update->save(false);
        }
    }
    //end insert examination

}
