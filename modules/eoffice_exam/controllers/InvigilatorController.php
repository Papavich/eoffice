<?php

namespace app\modules\eoffice_exam\controllers;
use app\modules\eoffice_exam\models\EofficeExamInvigilate2Search;
use Yii;
use app\modules\eoffice_exam\models\EofficeExamExamination;
use app\modules\eoffice_exam\models\ExamDetailExamination;
use app\modules\eoffice_exam\models\Busydate;
use app\modules\eoffice_exam\models\ViewPisPerson;
use app\modules\eoffice_exam\models\EofficeExamInvigilate;

class InvigilatorController extends \yii\web\Controller
{
    public function actionIndex()
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
        return $this->render('invigilator',[
            'model' => $model,
            'subopen_year' => $subopen_year,
            'exam_detail_date_start' => $exam_detail_date_start,
            'exam_detail_date_end' => $exam_detail_date_end,
            'subopen_semester' => $subopen_semester,
            'Examcode' => $Examcode,
        ]);
    }

    public function actionProcess()
    {
        $this->layout = "main_modules";
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
        //print_r($dateArray);
// end count days

        ///////////////////////////////////////////QUERY การสอบ//////////////////////////////////////////
        $AllExamination=[];
        $Examination = EofficeExamExamination::find()->all();
        $SumExam = count($Examination);

        for ($round = 0 ; $round < $numberDays ; $round++){
            // Query วิชาทั้งหมดและตัดวิชาที่ซ้ำ //
            $session = Yii::$app->session;
            $AllExam = [];
            $modelExam = EofficeExamExamination::find()
                ->where(['exam_date' => $session['date']['' . $round]])
//              ->orderBy(['exam_enroll_seat_temp' => SORT_DESC])
                ->all();
            foreach ($modelExam as $item) {
                $Exam = [];
                $Exam['rooms_id'] = $item->rooms_id;
                $Exam['room_tag'] = $item->room_tag;
                $Exam['subject_id'] = $item->subject_id;
                $Exam['program_class'] = $item->program_class;
                $Exam['exam_date'] = $item->exam_date;
                $Exam['exam_start_time'] = $item->exam_start_time;
                $Exam['exam_end_time'] = $item->exam_end_time;
                if ($item->exam_start_time == '08.30'){
                    $Exam['time'] = 'เช้า';
                }else{
                    $Exam['time'] = 'บ่าย';
                }
                array_push($AllExam, $Exam);
            }

            $countExam = array_count_values(array_column($AllExam, 'rooms_id')); //นับจำนวนที่ซ้ำกัน

            $AllExam = [];
            while ($subject = current($countExam)) {
                $modelExam = EofficeExamExamination::find()
                    ->select(['exam_start_time','rooms_id','exam_date','exam_end_time'])
                    ->where(['exam_date' => $session['date']['' . $round]])
                    ->andwhere(['rooms_id' => key($countExam)])
                    ->distinct(['rooms_id'])
                    ->distinct(['exam_start_time'])
                    ->orderBy(['rooms_id' => SORT_ASC,'room_tag' => SORT_ASC])
                    ->all();
                foreach ($modelExam as $item) {

                    $Exam = [];
                    $Exam['rooms_id'] = $item->rooms_id;
//                    $Exam['room_tag'] = $item->room_tag;
//                    $Exam['subject_id'] = $item->subject_id;
//                    $Exam['program_class'] = $item->program_class;
                    $Exam['exam_date'] = $item->exam_date;
                    $Exam['exam_start_time'] = $item->exam_start_time;
                    $Exam['exam_end_time'] = $item->exam_end_time;
                    if ($item->exam_start_time == '08.30'){
                        $Exam['time'] = 'เช้า';
                    }else{
                        $Exam['time'] = 'บ่าย';
                    }
                    array_push($AllExam, $Exam);
                }
                next($countExam);
            }
            $AllExamination['' . $session['date'][$round]] = $AllExam;
        }

//        echo "EXAMINATION"."<pre>";
//        print_r($AllExamination);
//        echo "</pre>";

///////////////////////////////////////////QUERY วันที่1////////////////////////////////////////////

        $BusyDate = Busydate::find()->all();//QUERY BUSY DATE ทั้งหมด
        $CountBD = count($BusyDate); // COUNT BUSY DATE
        $AllBusy = [];
        for ($days = 0 ; $days < $numberDays ; $days++){
            $BusyDate = Busydate::find()
                ->where(['exam_busydate_date'=>$session['date']['' . $days]])
                ->all();
            foreach ($BusyDate as $item){
                $Busy = [];
                $Busy['exam_busydate_date'] = $item->exam_busydate_date;
                $Busy['exam_busydate_time'] = $item->exam_busydate_time;
                $Busy['exam_busydate_note'] = $item->exam_busydate_note;
                $Busy['person_id'] = $item->person_id;
                array_push($AllBusy,$Busy);
            }
        }
//        echo "BUSY DATE"."<pre>";
//        print_r($AllBusy);
//        echo "</pre>";


////////////////////////////////////////////QUERY รายชื่อบุคคลากร///////////////////////////////////////////////

        $ViewPerson = ViewPisPerson::find()->all();
        $CountPerson = count($ViewPerson);

        $AllPerson = [];

//        for ($p = 0 ; $p < $CountPerson ; $p++){
        $ViewPerson = ViewPisPerson::find()
            ->where(['<>','person_name','ผู้ดูแลระบบ'])
            ->orderBy(['person_name'=>SORT_ASC])
            ->all();
        foreach ($ViewPerson as $item) {
            $Person = [];
            $Person['person_id'] = $item->person_id;
            $Person['PREFIXNAME'] = $item->PREFIXNAME;
            $Person['person_name'] = $item->person_name;
            $Person['person_surname'] = $item->person_surname;
            $Person['academic_positions'] = $item->academic_positions;
            for ($b=0;$b<count($AllBusy);$b++){
                if ($Person['person_id']==$AllBusy[$b]['person_id']){
                    break;
                }else{
                    array_push($AllPerson, $Person);
                    break;
                }
            }
        }
//        echo "PERSON"."<pre>";
//        print_r($AllPerson);
//        echo "</pre>";
        ////////////////////////////////////////////QUERY รายชื่อบุคคลากร///////////////////////////////////////////////

        // จัดคนคุมสอบ โดยให้คุมสอบได้ ห้องละ 2 คน
        $Allinvigilate = [];
        $num = 0;

        for ($day=0;$day<$session['numberDays'];$day++) {
            $invigilate = [];
            for ($i = 0; $i < count($AllExamination['' . $session['date'][$day]]); $i++) {
                $AllExamination[''.$session['date'][$day]][$i]['invigilate1'] = $AllPerson[$num];
                $AllExamination[''.$session['date'][$day]][$i]['invigilate2'] = $AllPerson[''.($num + 1)];
                $num = $num + 2;
                array_push($invigilate, $AllExamination['' . $session['date'][$day]][$i]);


            }
            $Allinvigilate['' . $session['date'][$day]] = $invigilate;
//            echo "InsertInvigilate"."<pre>";
//            print_r($Allinvigilate);
//            echo "</pre>";

//            $AllExamination['' . $session['date'][$days]][$round]['ROOM']['ROOMID'],
            for ($i = 0; $i < count($AllExamination['' . $session['date'][$day]]); $i++) {
//                echo $Allinvigilate['' . $session['date'][$day]][$i]['exam_date'];
                $this->InsertInvigilate(
                    $Allinvigilate['' . $session['date'][$day]][$i]['invigilate1']['person_id'],
                    $Allinvigilate['' . $session['date'][$day]][$i]['exam_date'],
                    $Allinvigilate['' . $session['date'][$day]][$i]['exam_start_time'],
                    $Allinvigilate['' . $session['date'][$day]][$i]['exam_end_time'],
                    $Allinvigilate['' . $session['date'][$day]][$i]['rooms_id']
                    );
                $this->InsertInvigilate(
                    $Allinvigilate['' . $session['date'][$day]][$i]['invigilate2']['person_id'],
                    $Allinvigilate['' . $session['date'][$day]][$i]['exam_date'],
                    $Allinvigilate['' . $session['date'][$day]][$i]['exam_start_time'],
                    $Allinvigilate['' . $session['date'][$day]][$i]['exam_end_time'],
                    $Allinvigilate['' . $session['date'][$day]][$i]['rooms_id']
                );
            }

//            array_push($Allinvigilate,$invigilate);

        }



//
//            echo count($AllExam);

//echo $CountPerson;



       return $this->redirect('preview');
    }

    public function actionPreview(){

        $searchModel = new EofficeExamInvigilate2Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('preview', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //insert Invigilate
    protected function findInvigilateModel($person_id, $exam_date,$examstart_time, $exam_end_time,
                                           $subject_id,$section_no,$rooms_id)
    {
        if (($model = EofficeExamInvigilate::findOne(['person_id' => $person_id, 'exam_date' => $exam_date,
                'examstart_time'=>$examstart_time,'exam_end_time'=>$exam_end_time, 'subject_id' => $subject_id, 'section_no' => $section_no,'rooms_id' => $rooms_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function InsertInvigilate($person_id,$exam_date,$examstart_time,$exam_end_time,$rooms_id)
    {
        $model = new EofficeExamInvigilate();
        if(isset($_POST)) {
            $model->load(Yii::$app->request->post());
            $update = $model;
            $update->person_id = $person_id;
            $update->exam_date = $exam_date;
            $update->examstart_time = $examstart_time;
            $update->exam_end_time = $exam_end_time;
            $update->rooms_id =$rooms_id;
            $update->save(false);
        }
    }
    //end insert Invigilate

    public function actionView($person_id, $exam_date, $examstart_time, $exam_end_time)
    {
        return $this->render('view', [
            'model' => $this->findModel($person_id, $exam_date, $examstart_time, $exam_end_time),
        ]);
    }

    /**
     * Creates a new EofficeExamInvigilate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EofficeExamInvigilate();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'person_id' => $model->person_id, 'exam_date' => $model->exam_date, 'examstart_time' => $model->examstart_time, 'exam_end_time' => $model->exam_end_time]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EofficeExamInvigilate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $person_id
     * @param string $exam_date
     * @param string $examstart_time
     * @param string $exam_end_time
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($person_id, $exam_date, $examstart_time, $exam_end_time)
    {
        $model = $this->findModel($person_id, $exam_date, $examstart_time, $exam_end_time);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'person_id' => $model->person_id, 'exam_date' => $model->exam_date, 'examstart_time' => $model->examstart_time, 'exam_end_time' => $model->exam_end_time]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EofficeExamInvigilate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $person_id
     * @param string $exam_date
     * @param string $examstart_time
     * @param string $exam_end_time
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($person_id, $exam_date, $examstart_time, $exam_end_time)
    {
        $this->findModel($person_id, $exam_date, $examstart_time, $exam_end_time)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EofficeExamInvigilate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $person_id
     * @param string $exam_date
     * @param string $examstart_time
     * @param string $exam_end_time
     * @return EofficeExamInvigilate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($person_id, $exam_date, $examstart_time, $exam_end_time)
    {
        if (($model = EofficeExamInvigilate::findOne(['person_id' => $person_id, 'exam_date' => $exam_date, 'examstart_time' => $examstart_time, 'exam_end_time' => $exam_end_time])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}


