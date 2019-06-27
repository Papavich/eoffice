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

            return $this->redirect(['enrollprocess']); //return to action enrollprocess
        }else {
            return $this->redirect(['enrollprocess']); //return to action enrollprocess
        }
    }

    public function actionEnrollprocess()  //this action for manage exam room
    {
        $this->layout = "main_modules";
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
        // print_r($dateArray);
// end count days

        $session['date'] = $dateArray;

        //echo $numberDays . " days";


        //Query Enroll
        $model = new Enroll();

        $AllEnrollItem = [];
        $totaldays = $session['numberDays'];

        $session['totaldays'] = $totaldays;

        $EnrollLength = 0;


        //  $model->load(Yii::$app->request->post());

        //$TotalEnrollItem = [];
        for ($i = 0; $i < $totaldays; $i++) {
            $model = Enroll::find()
                ->where(['exam_enroll_date' => $session['date']['' . $i]])
                ->andWhere(['exam_enroll_seat_temp'] != 0)
                ->orderBy(['exam_enroll_date' => SORT_ASC, 'exam_enroll_seat_temp' => SORT_DESC,])
                ->all();

            $TotalEnrollItem = [];
            foreach ($model as $item) {
                //echo $i;

                $section_no = $item->section_no;
                $subject_id = $item->subject_id;
                $subject_version = $item->subject_version;
                $subopen_semester = $item->subopen_semester;
                $subopen_year = $item->subopen_year;
                $program_id = $item->program_id;
                $program_class = $item->program_class;
                $teacher_id = $item->teacher_id;
                $section_size = $item->section_size;
                $exam_enroll_seat = $item->exam_enroll_seat;
                $exam_enroll_seat_temp = $item->exam_enroll_seat_temp;
                $exam_enroll_start_time = $item->exam_enroll_start_time;
                $exam_enroll_end_time = $item->exam_enroll_end_time;
                $exam_enroll_date = $item->exam_enroll_date;
                $LEVELID = $item->LEVELID;
                $exam_enroll_time = $item->exam_enroll_time;


                $enrollItem = [];
                array_push($enrollItem,
                    $section_no,
                    $subject_id,
                    $subject_version,
                    $subopen_semester,
                    $subopen_year,
                    $program_id,
                    $program_class,
                    $teacher_id,
                    $section_size,
                    $exam_enroll_seat,
                    $exam_enroll_seat_temp,
                    $exam_enroll_start_time,
                    $exam_enroll_end_time,
                    $exam_enroll_date,
                    $LEVELID,
                    $exam_enroll_time
                );

                // echo "<pre>";  print_r($enrollItem); echo "</pre>";
                if ($exam_enroll_date == $session['date'][0]){
                    $EnrollLength++;
                }
                $session['EnrollLength'] = $EnrollLength;
                //echo "<pre>";  print_r($enrollItem); echo "</pre>";
                array_push($TotalEnrollItem, $enrollItem);

            }

            if (!empty($TotalEnrollItem)) {
                array_push($AllEnrollItem, $TotalEnrollItem);
            }


        }
        /* return $this->render('preview',[
             'AllEnrollItem' => $AllEnrollItem,
             // 'currentyear' => $currentyear,
         ]);*/
        //echo "<pre>";print_r($AllEnrollItem);echo "</pre>";
        $session['totalenroll'] = $TotalEnrollItem;
        $session['AllEnrollItem'] = $AllEnrollItem;
        $session['enrollItem'] = $enrollItem;
        $session['enrollTime'] = $exam_enroll_time;

        return $this->redirect(['roomprocess']);
    }

    public function actionRoomprocess()  //this action for manage exam room
    {
        $session = Yii::$app->session;
        $A=0;
        $B=0;
        $AllEnrollItem = $session['AllEnrollItem'];

        $roomQuery = new ExamRoomDetail();
        $roomQuery->load(Yii::$app->request->post());

        // room query
        $AllRooms = [];
        $AllTagA = [];
        $AllTagB = [];

        /*$session['tagA'] = $RoomA;
        $session['tagB'] = $RoomB;
        $session['AlltagA'] = $AllTagA;
        $session['AlltagB'] = $AllTagB;
        $session['totalroom'] = $TotalRoomItem;
        $session['Allroom'] = $AllRooms;
*/

        //$countFirstAllenroll = count($AllEnrollItem[0]);
        //echo $countFirstAllenroll;

        //MANAGE EXAM ROOM BEGIN//
$AllEnrollItem = [];
$RoomTagA = [];

          // BEST FIT //
    $AllEnrollItem = $this->QueryEnroll(0);
//    array_push($AllEnrollItem,$AllEnrollItem);
    $AllTagA = $this->QueryRoom(0,$AllEnrollItem);
//    array_push($RoomTagA,$AllTagA);


         $this->BestFit($AllEnrollItem,$AllTagA);

         $AllEnrollItem = $this->QueryEnroll(0);

         $this->PriorityTagA($AllEnrollItem);

         $AllEnrollItem = $this->QueryEnroll(0);

    //MANAGE EXAM ROOM END //


        $searchModel = new EofficeExamExaminationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('preview',[
            'AllEnrollItem' => $AllEnrollItem,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    protected function BestFit($AllEnrollItem,$AllTagA)
    {
        if ( $AllEnrollItem[0][0][10]>=$AllTagA[0][0][3]) {
            $num =  $AllEnrollItem[0][0][10] - $AllTagA[0][0][3]; //หาผลจำนวนที่เหลือ

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

            $this->UpdateSeat($AllTagA[0][0][0],
                $AllTagA[0][0][1],
                $AllTagA[0][0][4],
                $AllTagA[0][0][6],
                0);

            $this->UpdateStatus($AllTagA[0][0][0],
                $AllTagA[0][0][1],
                $AllTagA[0][0][4],
                $AllTagA[0][0][6],
                0);

            // echo "คนเยอะกว่าห้อง";
        }else{
            $num = $AllTagA[0][0][3] -  $AllEnrollItem[0][0][10]; //หาผลจำนวนที่เหลือ

            $this->UpdateSeat($AllTagA[0][0][0],
                $AllTagA[0][0][1],
                $AllTagA[0][0][4],
                $AllTagA[0][0][6],
                $num);

            if($num == 0 ){
                $this->UpdateStatus($AllTagA[0][0][0],
                    $AllTagA[0][0][1],
                    $AllTagA[0][0][4],
                    $AllTagA[0][0][6],
                    0);
            }
        }
        $this->InsertExam(
            $AllTagA[0][0][0],
            $AllEnrollItem[0][0][1],
            $AllEnrollItem[0][0][6],
            $AllEnrollItem[0][0][13],
            $AllEnrollItem[0][0][11],
            $AllEnrollItem[0][0][12]
        );
    } //จัดห้องสอบรอบแรก

    protected function PriorityTagA($AllEnrollItem)
    {
        for($i = 0 ; $i < count($AllEnrollItem[0]) ; $i++){
            $AllEnrollItem = $this->QueryEnroll(0);
            $AllTagA = $this->QueryRoom(0,$AllEnrollItem);

            if ( $AllEnrollItem[0][0][10]>=$AllTagA[0][0][3]) {
                $num =  $AllEnrollItem[0][0][10] - $AllTagA[0][0][3]; //หาผลจำนวนที่เหลือ

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

                $this->UpdateSeat($AllTagA[0][0][0],
                    $AllTagA[0][0][1],
                    $AllTagA[0][0][4],
                    $AllTagA[0][0][6],
                    0);

                $this->UpdateStatus($AllTagA[0][0][0],
                    $AllTagA[0][0][1],
                    $AllTagA[0][0][4],
                    $AllTagA[0][0][6],
                    0);

                // echo "คนเยอะกว่าห้อง";
            }else{
                $num = $AllTagA[0][0][3] -  $AllEnrollItem[0][0][10]; //หาผลจำนวนที่เหลือ

                $this->UpdateSeat($AllTagA[0][0][0],
                    $AllTagA[0][0][1],
                    $AllTagA[0][0][4],
                    $AllTagA[0][0][6],
                    $num);

                if($num == 0 ){
                    $this->UpdateStatus($AllTagA[0][0][0],
                        $AllTagA[0][0][1],
                        $AllTagA[0][0][4],
                        $AllTagA[0][0][6],
                        0);
                }
            }
            $this->InsertExam(
                $AllTagA[0][0][0],
                $AllEnrollItem[0][0][1],
                $AllEnrollItem[0][0][6],
                $AllEnrollItem[0][0][13],
                $AllEnrollItem[0][0][11],
                $AllEnrollItem[0][0][12]
            );
        }

    }  //จัดห้องสอบ Tag A







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

    protected function UpdateStatus($rooms_id, $exam_room_tag, $rooms_detail_time,$rooms_detail_date,$num)
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
        if (($model = EofficeExamExamination::findOne(['rooms_id' => $rooms_id, 'subject_id' => $subject_id, 'program_class' => $program_class, 'exam_date' => $exam_date,'exam_start_time' => $exam_start_time,'exam_end_time' => $exam_end_time])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function InsertExam($rooms_id, $subject_id, $program_class, $exam_date,$exam_start_time,$exam_end_time)
    {
        $model = new EofficeExamExamination();
        if(isset($_POST)) {
            $model->load(Yii::$app->request->post());
            $update = $model;
            $update->rooms_id = $rooms_id;
            $update->subject_id = $subject_id;
            $update->room_tag = 'A';
            $update->program_class = $program_class;
            $update->exam_date =$exam_date ;
            $update->exam_start_time =$exam_start_time ;
            $update->exam_end_time = $exam_end_time;
            $update->save(false);
        }
    }
    //end insert examination


    protected function QueryEnroll($i)
    {
        $session = Yii::$app->session;
        //query enroll
        $EnrollLength = 0;
        $AllEnrollItem = [];
        $model = Enroll::find()->where(['exam_enroll_date' => $session['date']['' . $i]])
            ->andWhere(['exam_enroll_seat_temp'] != 0)
            ->orderBy(['exam_enroll_date' => SORT_ASC, 'exam_enroll_seat_temp' => SORT_DESC,])
            ->all();

        $TotalEnrollItem = [];
        foreach ($model as $item) {
            //echo $i;

            $section_no = $item->section_no;
            $subject_id = $item->subject_id;
            $subject_version = $item->subject_version;
            $subopen_semester = $item->subopen_semester;
            $subopen_year = $item->subopen_year;
            $program_id = $item->program_id;
            $program_class = $item->program_class;
            $teacher_id = $item->teacher_id;
            $section_size = $item->section_size;
            $exam_enroll_seat = $item->exam_enroll_seat;
            $exam_enroll_seat_temp = $item->exam_enroll_seat_temp;
            $exam_enroll_start_time = $item->exam_enroll_start_time;
            $exam_enroll_end_time = $item->exam_enroll_end_time;
            $exam_enroll_date = $item->exam_enroll_date;
            $LEVELID = $item->LEVELID;
            $exam_enroll_time = $item->exam_enroll_time;


            $enrollItem = [];
            array_push($enrollItem,
                $section_no,
                $subject_id,
                $subject_version,
                $subopen_semester,
                $subopen_year,
                $program_id,
                $program_class,
                $teacher_id,
                $section_size,
                $exam_enroll_seat,
                $exam_enroll_seat_temp,
                $exam_enroll_start_time,
                $exam_enroll_end_time,
                $exam_enroll_date,
                $LEVELID,
                $exam_enroll_time
            );

            // echo "<pre>";  print_r($enrollItem); echo "</pre>";
            if ($exam_enroll_date == $session['date'][0]){
                $EnrollLength++;
            }
            $session['EnrollLength'] = $EnrollLength;
            //echo "<pre>";  print_r($enrollItem); echo "</pre>";
            array_push($TotalEnrollItem, $enrollItem);

        }

        if (!empty($TotalEnrollItem)) {
            array_push($AllEnrollItem, $TotalEnrollItem);
        }
        return $AllEnrollItem;
    }

    protected function QueryRoom($i,$AllEnrollItem)
    {
        $session = Yii::$app->session;
        //query room
        $roomQuery = ExamRoomDetail::find()
            ->where(['exam_room_status' => '0'])
            ->andWhere(['rooms_detail_time' => $AllEnrollItem[0][0][15]])
            ->andWhere(['rooms_detail_date' => $session['date']['' . $i]])
            ->orderBy(['exam_rooms_seat_temp' => SORT_DESC, 'rooms_id' => SORT_ASC])
            ->all();

        $TotalRoomItem = [];
        $RoomA = [];
        $RoomB = [];
        $A = 0;
        $B = 0;
        // room query
        $AllRooms = [];
        $AllTagA = [];
        $AllTagB = [];

        foreach ($roomQuery as $item) {
            $rooms_detail_date = $item->rooms_detail_date;
            $rooms_id = $item->rooms_id;
            $rooms_detail_time = $item->rooms_detail_time;
            $exam_room_tag = $item->exam_room_tag;
            $exam_rooms_seat = $item->exam_rooms_seat;
            $exam_rooms_seat_temp = $item->exam_rooms_seat_temp;
            $exam_room_status = $item->exam_room_status;


            $roomItem = [];
            array_push($roomItem,
                $rooms_id,
                $exam_room_tag,
                $exam_rooms_seat,
                $exam_rooms_seat_temp,
                $rooms_detail_time,
                $exam_room_status,
                $rooms_detail_date
            );

            array_push($TotalRoomItem, $roomItem);


            if ($exam_room_tag =='A'){  //count tag A
                $A++;
                array_push($RoomA, $roomItem);
            }else{ //count tag B
                $B++;
                array_push($RoomB, $roomItem);
            }
        }
        if (!empty($RoomA)&& !empty($RoomB)) { //แบ่งตามวัน ตาม tag
            array_push($AllTagA, $RoomA);
            array_push($AllTagB, $RoomB);
        }

        if (!empty($TotalRoomItem)) {
            array_push($AllRooms, $TotalRoomItem);
        }

        return $AllTagA;
    }




}
