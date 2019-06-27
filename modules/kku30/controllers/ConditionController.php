<?php

namespace app\modules\kku30\controllers;

use app\modules\kku30\models\Kku30CheckTable;
use app\modules\kku30\models\Kku30Course;
use app\modules\kku30\models\Kku30Group;
use app\modules\kku30\models\Kku30GroupSection;
use app\modules\kku30\models\Kku30GroupTimeslotRoom;
use app\modules\kku30\models\Kku30ProgramsCourse;
use app\modules\kku30\models\Kku30Room;
use app\modules\kku30\models\Kku30Section;
use app\modules\kku30\models\Kku30SectionProgram;
use app\modules\kku30\models\Kku30SectionTeacher;
use app\modules\kku30\models\Kku30Subgroup;
use app\modules\kku30\models\Kku30Subject;
use app\modules\kku30\models\Kku30SubjectCoruse;
use app\modules\kku30\models\Kku30SubjectCoursePlan;
use app\modules\kku30\models\Kku30SubjectOpen;
use app\modules\kku30\models\Kku30SubjectOpenProgram;
use app\modules\kku30\models\Kku30Teacher;
use app\modules\kku30\models\Kku30Timeslot;
use Yii;
use app\modules\kku30\models\Test;
use app\modules\kku30\models\SearchTest;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * TestController implements the CRUD actions for Test model.
 */
class ConditionController extends Controller
{
    public function actionTestelective()
    {
        $Testvalue = Kku30SubjectCoruse::find()->where([
            'type_id' => 2,
            'typegroup_id' => 6
        ])->all();

        $array_help_set = ArrayHelper::toArray($Testvalue, ['app\modules\kku30\models\Kku30SubjectCoruse' => [
            'course_id',
            'type_id',
            'typegroup_id',
            'subgroup_id',
            'subject' => function ($Testvalue) {
                return $Testvalue->subject;
            }
        ]]);

        echo Json::encode($array_help_set);
    }

    public function actionRendercondition()
    {
        $Data_subject_term1 = array();
        $Data_subject_term2 = array();

        $Data_subject_elective_term1 = array();
        $Data_subject_elective_term2 = array();
        $this->layout = "main_module";
        return $this->render('addcondition', [
            'Count_AllData' => 0,
            'Count_Term1' => 0,
            'Count_Term2' => 0,
            'Data_subject_term1' => $Data_subject_term1,
            'Data_subject_term2' => $Data_subject_term2,
            'sub_student' => "",
            'sub_project' => "",
            'sub_stdyear' => null,
            'sub_year' => "",
            'course_id' => 0,
            'Data_section_this_year_term' => null,

            'Count_AllData_Elective' => 0,
            'Count_Elective_Term1' => 0,
            'Count_Elective_Term2' => 0,
            'Data_subject_elective_term1' => $Data_subject_elective_term1,
            'Data_subject_elective_term2' => $Data_subject_elective_term2,
        ]);
    }

    public function actionSearchsubjectcondition()
    {
        $sub_student = Yii::$app->request->post('sub_student');
        $sub_year = Yii::$app->request->post('sub_year');
        $sub_stdyear = Yii::$app->request->post('sub_stdyear');
        $findadmission = intval($sub_year) - intval($sub_stdyear - 1);

        if ($sub_student == null and $sub_year == null and $sub_stdyear == null) {
            $sub_student = Yii::$app->request->get('sub_student');
            $sub_year = Yii::$app->request->get('sub_year');
            $sub_stdyear = Yii::$app->request->get('sub_stdyear');
            $findadmission = intval($sub_year) - intval($sub_stdyear - 1);
        }

        $subject_coruse_plan = Kku30SubjectCoursePlan::find()
            ->joinWith(['course.kku30ProgramsCourses join'])
            ->where([
                'join.program_id' => $sub_student,
                'join.admission_year' => $findadmission,
                'plan_studentyear' => intval($sub_stdyear)
            ])->orderBy([
                'plan_semester' => SORT_ASC,
            ])
            ->all();
        $Data_section_this_year_term = Kku30Section::find()
            ->where([
                'subopen_year' => $sub_year
            ])
            ->all();
        if ($subject_coruse_plan == null) {
            $course_id = 0;
        } else {
            $course_id = $subject_coruse_plan[0]['course_id'];
        }
        $array_subject_plan = ArrayHelper::toArray($subject_coruse_plan, ['app\modules\kku30\models\Kku30SubjectCoursePlan' => [
            'course_id',
            'plan_semester',
            'subject' => function ($subject_coruse_plan) {
                return $subject_coruse_plan->subject;
            }
        ]]);
        $Count_subject_Term1 = 0;
        $Data_subject_term1 = [];
        $Data_subject_term2 = [];
        foreach ($array_subject_plan as $count) {
            if ($count['plan_semester'] == '1') {
                $Count_subject_Term1 = $Count_subject_Term1 + 1;
                array_push($Data_subject_term1, $count);
            } else
                array_push($Data_subject_term2, $count);
        }
        $variableStudentyear = intval($sub_stdyear);
        $subject_elective = Kku30SubjectOpenProgram::find()
            ->joinWith(['subopenSemester.subject.kku30SubjectCoruses join'])
            ->joinWith(['subopenSemester join1'])
            ->where([
                "join1.subopen_year" => $sub_year,
                "join.typegroup_id" => 6,
                "program_class" => 1,
                "program_id" => $sub_student
            ])
            ->andWhere('student_year LIKE :query')
            ->addParams([':query' => '%' . $variableStudentyear . '%'])
            ->andWhere('join.course_id LIKE :query1')
            ->addParams([':query1' => '%' . $sub_student . '%'])
            ->all();

        $array_subject_elective_plan = ArrayHelper::toArray($subject_elective, ['app\modules\kku30\models\Kku30SubjectOpenProgram' => [
            'program_id',
            'student_year',
            'subopen_semester',
            'subject' => function ($subject_elective) {
                return $subject_elective->subopenSemester->subject;
            }
        ]]);

        $Count_subject_elective_term1 = 0;
        $Data_subject_elective_term1 = [];
        $Data_subject_elective_term2 = [];
        foreach ($array_subject_elective_plan as $countelective) {
            if ($countelective['subopen_semester'] == 1) {
                $Count_subject_elective_term1 = $Count_subject_elective_term1 + 1;
                array_push($Data_subject_elective_term1, $countelective);
            } else {
                array_push($Data_subject_elective_term2, $countelective);
            }
        }
        $Count_subject_elective_term2 = sizeof($subject_elective) - $Count_subject_elective_term1;
        $Count_subject_Term2 = sizeof($array_subject_plan) - $Count_subject_Term1;
        $this->layout = "main_module";
        return $this->render('addcondition', [
            'sub_student' => $sub_student,
            'sub_year' => $sub_year,
            'sub_stdyear' => $sub_stdyear,
            'Count_AllData' => sizeof($array_subject_plan),
            'Count_Term1' => $Count_subject_Term1,
            'Count_Term2' => $Count_subject_Term2,
            'Data_subject_term1' => $Data_subject_term1,
            'Data_subject_term2' => $Data_subject_term2,
            'sub_student' => $sub_student,
            'sub_stdyear' => $sub_stdyear,
            'sub_year' => $sub_year,
            'course_id' => $course_id,
            'Data_section_this_year_term' => $Data_section_this_year_term,

            'Count_AllData_Elective' => sizeof($array_subject_elective_plan),
            'Count_Elective_Term1' => $Count_subject_elective_term1,
            'Count_Elective_Term2' => $Count_subject_elective_term2,
            'Data_subject_elective_term1' => $Data_subject_elective_term1,
            'Data_subject_elective_term2' => $Data_subject_elective_term2,
        ]);
    }

    public function actionSearchsubjectaddcondition()
    {
        $sub_year = \Yii::$app->request->post('sub_year');
        $sub_semester = \Yii::$app->request->post('sub_semester');
        $data_subject_open = Kku30SubjectOpen::find()
            ->where([
                'subopen_semester' => 1,
                'subopen_year' => 2561
            ])->all();

        $array_subject_plan = ArrayHelper::toArray($data_subject_open, ['app\modules\kku30\models\Kku30SubjectOpen' => [
            'subopen_year',
            'subopen_semester',
            'subject' => function ($data_subject_open) {
                return $data_subject_open->subject;
            }
        ]]);
//        echo Json::encode($array_subject_plan);

        return $this->render('test', [
            'data_subject_open' => $array_subject_plan,
            'sizeofdata' => sizeof($array_subject_plan)
        ]);
    }

    public function actionPastvalue()
    {
        $section_no = \Yii::$app->request->post('section_no');
        return $this->render('_formaddsection', [
            'section_no' => $section_no
        ]);
    }

    public function actionNewinsert()
    {
        $sum_section = Yii::$app->request->post('sum_section');
        $subject_id = Yii::$app->request->post('subject_id');
        $subject_version = Yii::$app->request->post('subject_version');
        $subopen_semester = Yii::$app->request->post('plna_semester');
        $subopen_year = Yii::$app->request->post('sub_year');
        $subject_count_lab = Yii::$app->request->post('subject_count_lab');
        $subject_count_lec = Yii::$app->request->post('subject_count_lec');


        $sub_student = Yii::$app->request->post('sub_student');
        $sub_year = Yii::$app->request->post('sub_year');
        $sub_stdyear = Yii::$app->request->post('sub_stdyear');


        $search_timeslot = $subject_id . $subject_version . $subopen_semester . $subopen_year;
        //ลบ timeslot เก่า
        $data_group_time_slot = Kku30GroupTimeslotRoom::find()
            ->Where('group_no LIKE :query')
            ->addParams([':query' => '%' . $search_timeslot . '%'])
            ->andwhere([
                'time_insert' => 1
            ])
            ->all();
        foreach ($data_group_time_slot as $row) {
            Kku30GroupTimeslotRoom::deleteAll([
                'group_no' => $row['group_no'],
                'timeslot_id' => $row['timeslot_id']
            ]);
        }
        //ลบ timeslot เก่า

        //ลบ group section เก่า
        $data_group_time_slot = Kku30GroupSection::find()
            ->Where('group_no LIKE :query')
            ->addParams([':query' => '%' . $search_timeslot . '%'])
            ->all();
        foreach ($data_group_time_slot as $row) {
            Kku30GroupSection::deleteAll([
                'group_no' => $row['group_no'],
                'section_no' => $row['section_no'],
                'subject_id' => $row['subject_id'],
                'subject_version' => $row['subject_version'],
                'subopen_semester' => $row['subopen_semester'],
                'subopen_year' => $row['subopen_year']
            ]);
        }
        //ลบ group section เก่า
        //ลบ group เก่า
        $data_group = Kku30Group::find()
            ->Where('group_no LIKE :query')
            ->addParams([':query' => '%' . $search_timeslot . '%'])
            ->all();
        foreach ($data_group as $row) {
            Kku30Group::deleteAll([
                'group_no' => $row['group_no'],
            ]);
        }
        //ลบ group เก่า
        //ลบ section _programs
        $data_sectioin_programs = Kku30SectionProgram::find()
            ->where([
                'subject_id' => $subject_id,
                'subject_version' => intval($subject_version),
                'subopen_semester' => intval($subopen_semester),
                'subopen_year' => intval($subopen_year)
            ])->all();
        foreach ($data_sectioin_programs as $row) {
            Kku30SectionProgram::deleteAll([
                'section_no' => $row['section_no'],
                'subject_id' => $row['subject_id'],
                'subject_version' => intval($row['subject_version']),
                'subopen_semester' => intval($row['subopen_semester']),
                'subopen_year' => intval($row['subopen_year']),
                'program_id' => $row['program_id'],
                'program_class' => intval($row['program_class']),
                'student_year' => intval($row['student_year']),
            ]);
        }
        //ลบ section _programs
        //ลบ section _teacher
        $data_teacher = Kku30SectionTeacher::find()
            ->where([
                'subject_id' => $subject_id,
                'subject_version' => intval($subject_version),
                'subopen_semester' => intval($subopen_semester),
                'subopen_year' => intval($subopen_year)
            ])->all();
//        echo Json::encode($data_teacher);
        foreach ($data_teacher as $row) {
            Kku30SectionTeacher::deleteAll([
                'section_no' => $row['section_no'],
                'subject_id' => $row['subject_id'],
                'subject_version' => intval($row['subject_version']),
                'subopen_semester' => intval($row['subopen_semester']),
                'subopen_year' => intval($row['subopen_year']),
                'teacher_no' => intval($row['teacher_no'])
            ]);
        }
        //ลบ section _teacher
        //ลบ section
        $data_section = Kku30Section::find()
            ->where([
                'subject_id' => $subject_id,
                'subject_version' => intval($subject_version),
                'subopen_semester' => intval($subopen_semester),
                'subopen_year' => intval($subopen_year)
            ])->all();
        foreach ($data_section as $row) {
            Kku30Section::deleteAll([
                'section_no' => $row['section_no'],
                'subject_id' => $row['subject_id'],
                'subject_version' => intval($row['subject_version']),
                'subopen_semester' => intval($row['subopen_semester']),
                'subopen_year' => intval($row['subopen_year']),
            ]);
        }
//        //ลบ section
        //delete เก่า

        $count_check = 0;
        $Max_check = $sum_section;
        for ($i = 0; $i < $sum_section; $i++) {
            $model = new Kku30Section();
            if ($i == 9) {
                $section_no = $i . 1 . "";
            } else {
                $section_no = "0" . ($i + 1);
            }
            $section_size = \Yii::$app->request->post(($i + 1) . "section_size");
            $model['section_no'] = $section_no;
            $model['subject_id'] = $subject_id;
            $model['subject_version'] = intval($subject_version);
            $model['subopen_semester'] = intval($subopen_semester);
            $model['subopen_year'] = intval($subopen_year);
            $model['section_size'] = intval($section_size);
            $sum_section_join_lec = "";
            $sum_section_join_lab = "";

            //หา Section_join_lec
            if (intval($subject_count_lec) != 0) {
                for ($j = 0; $j < $sum_section; $j++) {
                    if ($i != $j) {
                        $section_lec = \Yii::$app->request->post("section_join_lec" . ($i + 1) . ($j + 1));
                        if ($section_lec == "010") {
                            $section_lec = "10";
                        }
                        if ($sum_section_join_lec == "") {
                            $sum_section_join_lec = $section_lec;
                        } else {
                            $sum_section_join_lec = $sum_section_join_lec . "," . $section_lec;
                        }
                    }
                }
                $model['section_join_lec'] = $sum_section_join_lec;
            } else { //ถ้าไม่มีใส่ค่าว่างไว้
                $model['section_join_lec'] = $sum_section_join_lec;
            }
            //หา Section_join_lec
            //หา Section_join_lab and section_condition_lab
            if (intval($subject_count_lab) != 0) {
                for ($j = 0; $j < $sum_section; $j++) {
                    if ($i != $j) {
                        $section_lab = \Yii::$app->request->post("section_join_lab" . ($i + 1) . ($j + 1));
                        if ($section_lab == "010") {
                            $section_lab = "10";
                        }
                        if ($sum_section_join_lab == "") {
                            $sum_section_join_lab = $section_lab;
                        } else {
                            $sum_section_join_lab = $sum_section_join_lab . "," . $section_lab;
                        }
                    }
                }
                $model['section_join_lab'] = $sum_section_join_lab;
                //หาว่ามี มีเงื่อนไขใช้ห้องหรือไม่
                $condition_lab = \Yii::$app->request->post("condition_lab" . ($i + 1));
                if ($condition_lab != "0") {
                    $model['section_condition_lab'] = intval($condition_lab);
                } else {
                    $model['section_condition_lab'] = "";
                }
                //หาว่ามี มีเงื่อนไขใช้ห้องหรือไม่
            } else {
                $model['section_join_lab'] = $sum_section_join_lab;
            }
            //หา Section_join_lab

            //หา count time Lec ของวิชานั้นๆ
            if (intval($subject_count_lec) != 0) {
                $section_count_lec = \Yii::$app->request->post("cout_time_lec" . ($i + 1));
                $count_lec = "";
                if (floatval($section_count_lec) != 0) {
                    $count_lec = (floatval($subject_count_lec) / floatval($section_count_lec));
                }
                $model['section_count_lec'] = intval($count_lec);
            }
            //หา count time Lec ของวิชานั้นๆ
            //หา count time Lab ของวิชานั้นๆ
            if (intval($subject_count_lab) != 0) {
                $section_count_lab = \Yii::$app->request->post("cout_time_lab" . ($i + 1));
                $count_lab = "";
                if (floatval($section_count_lab) != 0) {
                    $count_lab = (floatval($subject_count_lab) / floatval($section_count_lab));
                }
                $model['section_count_lab'] = intval($count_lab);
            }
            //หา count time Lab ของวิชานั้นๆ
            if ($model->save(true)) {
                $count_check++;
            }

            //insert section_program
            $section_programCS = \Yii::$app->request->post("section_programCS" . ($i + 1));
            $Max_check = $Max_check + sizeof($section_programCS);
            $section_programIT = \Yii::$app->request->post("section_programIT" . ($i + 1));
            $Max_check = $Max_check + sizeof($section_programIT);
            $section_programGIS = \Yii::$app->request->post("section_programGIS" . ($i + 1));
            $Max_check = $Max_check + sizeof($section_programGIS);

            //CS
            for ($j = 0; $j < sizeof($section_programCS); $j++) {
                $explode_array = explode(",", $section_programCS[$j]);
                $model1 = new Kku30SectionProgram();
                $model1['section_no'] = $section_no;
                $model1['subject_id'] = $subject_id;
                $model1['subject_version'] = intval($subject_version);
                $model1['subopen_semester'] = intval($subopen_semester);
                $model1['subopen_year'] = intval($subopen_year);
                $model1['program_id'] = $explode_array[0];
                $model1['program_class'] = $explode_array[1];
                $model1['student_year'] = $explode_array[2];
                if ($model1->save(true)) {
                    $count_check++;
                }
            }
            //IT
            for ($j = 0; $j < sizeof($section_programIT); $j++) {
                $explode_array = explode(",", $section_programIT[$j]);
                $model1 = new Kku30SectionProgram();
                $model1['section_no'] = $section_no;
                $model1['subject_id'] = $subject_id;
                $model1['subject_version'] = intval($subject_version);
                $model1['subopen_semester'] = intval($subopen_semester);
                $model1['subopen_year'] = intval($subopen_year);
                $model1['program_id'] = $explode_array[0];
                $model1['program_class'] = $explode_array[1];
                $model1['student_year'] = $explode_array[2];
                if ($model1->save(true)) {
                    $count_check++;
                }
            }
            //GIS
            for ($j = 0; $j < sizeof($section_programGIS); $j++) {
                $explode_array = explode(",", $section_programGIS[$j]);
                $model1 = new Kku30SectionProgram();
                $model1['section_no'] = $section_no;
                $model1['subject_id'] = $subject_id;
                $model1['subject_version'] = intval($subject_version);
                $model1['subopen_semester'] = intval($subopen_semester);
                $model1['subopen_year'] = intval($subopen_year);
                $model1['program_id'] = $explode_array[0];
                $model1['program_class'] = intval($explode_array[1]);
                $model1['student_year'] = intval($explode_array[2]);
                if ($model1->save(true)) {
                    $count_check++;
                }
            }
            //insert section_program

            //insert section_teacher
            $section_teacher = \Yii::$app->request->post("section_teacher" . ($i + 1));
            $Max_check = $Max_check + sizeof($section_teacher);
            for ($j = 0; $j < sizeof($section_teacher); $j++) {
                $model2 = new Kku30SectionTeacher();
                $model2['section_no'] = $section_no;
                $model2['subject_id'] = $subject_id;
                $model2['subject_version'] = intval($subject_version);
                $model2['subopen_semester'] = intval($subopen_semester);
                $model2['subopen_year'] = intval($subopen_year);
                $model2['teacher_no'] = intval($section_teacher[$j]);
                if ($model2->save(true)) {
                    $count_check++;
                }
            }
            //insert section_teacher
        }


        //สำหรับแสดง alert
//        if ($count_check == $Max_check) {
//            echo "<script>alert('บันทึกข้อมูลเรียบร้อย')</script>";
//        } else { //เหลือ check ว่าไม่สำเร็จเพราะอะไร
//            echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ')</script>";
//        }
        //สำหรับแสดง alert

        //ถ้าเป็นวิชาระบุเวลา
        $semester_year = $subopen_semester . $subopen_year;
        $data_group = Kku30Section::find()
            ->where([
                'subject_id' => $subject_id,
                'subject_version' => intval($subject_version),
                'subopen_semester' => intval($subopen_semester),
                'subopen_year' => intval($subopen_year)
            ])
            ->all();
        $time_slot = Kku30Timeslot::find()
            ->all();
        $count_group = Kku30Group::find()
            ->andWhere('group_no LIKE :query')
            ->addParams([':query' => '%' . $semester_year . '%'])
            ->count();
        $array_check_lec = array();
        $array_check_lab = array();
        foreach ($data_group as $row) { //วนลูป Section ของวิชา ....
            //check คาบ Lecture
            if (!(in_array($row['section_no'], $array_check_lec))) { //ถ้าค้นหาแล้วไม่เจอใน array check lec แสดงว่ายังไม่ถูกจัด
                if ($row['section_count_lec'] != null) { //check ว่า มีคาบ Lecture มั้ย ถ้าไม่มีก็จะไม่เข้า
                    if ($row['section_join_lec'] != null) { //check ว่ามีคนเรียนร่วมหรือไม่ true == เรียนร้วม
                        $explode_section = explode(",", $row['section_join_lec']);
                        $check_slot_time = 0;
                        // Loop check ว่าเป็น Section กรอกเวลา
                        for ($i = 0; $i < $row['section_count_lec']; $i++) {
                            $check_lec_day_original = \Yii::$app->request->post("day_lec" . ($i + 1) . intval($row['section_no']));
                            $check_lec_time_original = \Yii::$app->request->post("time_lec" . ($i + 1) . intval($row['section_no']));
                            if ($check_lec_day_original != null && $check_lec_day_original != "0") {
                                $check_slot_time++;
                            }
                            if ($check_lec_time_original != null && $check_lec_time_original != "0") {
                                $check_slot_time++;
                            }
                            for ($j = 0; $j < sizeof($explode_section); $j++) {
                                $check_lec_day = \Yii::$app->request->post("day_lec" . ($i + 1) . intval($explode_section[$j]));
                                $check_lec_time = \Yii::$app->request->post("time_lec" . ($i + 1) . intval($explode_section[$j]));
                                if ($check_lec_day != null && $check_lec_day != "0") {
                                    if ($check_lec_day == $check_lec_day_original) {
                                        $check_slot_time++;
                                    }
                                }
                                if ($check_lec_time != null && $check_lec_time != "0") {
                                    if ($check_lec_time == $check_lec_time_original) {
                                        $check_slot_time++;
                                    }
                                }
                            }
                        }
                        // Loop check ว่าเป็น Section กรอกเวลา
                        if ($check_slot_time == (intval($row['section_count_lec']) * (sizeof($explode_section) + 1) * 2)) { //ถ้า true แสดงว่ากรอกเวลามาครบถ้วน
                            $subject_and_subject_versio = $row['subject_id'] . $row['subject_version'];
                            $count_group_inSection = Kku30Group::find()
                                ->andWhere('group_no LIKE :query')
                                ->addParams([':query' => '%' . $subject_and_subject_versio . $semester_year . '%'])
                                ->count();
                            $model_group = new Kku30Group();
                            $model_group['group_no'] = $count_group_inSection . $subject_and_subject_versio . $semester_year;
                            $model_group['group_amount'] = $row['section_size'];
                            $model_group['group_type'] = 1;
                            $model_group['group_priority'] = 0;
                            $model_group['group_length'] = ($subject_count_lec / $row['section_count_lec']) * 2;
                            $model_group->save();
                            $model_group_section = new Kku30GroupSection();
                            $model_group_section['group_no'] = $count_group_inSection . $subject_and_subject_versio . $semester_year;
                            $model_group_section['section_no'] = $row['section_no'];
                            $model_group_section['subject_id'] = $row['subject_id'];
                            $model_group_section['subject_version'] = $row['subject_version'];
                            $model_group_section['subopen_semester'] = $row['subopen_semester'];
                            $model_group_section['subopen_year'] = $row['subopen_year'];
                            $model_group_section->save();
                            array_push($array_check_lec, $row['section_no']);
                            foreach ($explode_section as $row1) {
                                $model_group_section = new Kku30GroupSection();
                                $model_group_section['group_no'] = $count_group_inSection . $subject_and_subject_versio . $semester_year;
                                $model_group_section['section_no'] = $row1;
                                $model_group_section['subject_id'] = $row['subject_id'];
                                $model_group_section['subject_version'] = $row['subject_version'];
                                $model_group_section['subopen_semester'] = $row['subopen_semester'];
                                $model_group_section['subopen_year'] = $row['subopen_year'];
                                $model_group_section->save();
                                array_push($array_check_lec, $row1);
                            }
                            for ($i = 0; $i < $row['section_count_lec']; $i++) {
                                $day = \Yii::$app->request->post("day_lec" . ($i + 1) . intval($row['section_no'])); //ไม่ต้องดึงมาทุกอันเพราะว่า check จากข้างบนแล้วว่า เหมือนกันทุก secrion ในส่วน ของ time
                                $time = \Yii::$app->request->post("time_lec" . ($i + 1) . intval($row['section_no'])); //ไม่ต้องดึงมาทุกอันเพราะว่า check จากข้างบนแล้วว่า เหมือนกันทุก secrion ในส่วน ของ time
                                $model_group_timeslot = new Kku30GroupTimeslotRoom();
                                $model_group_timeslot['group_no'] = $count_group_inSection . $subject_and_subject_versio . $semester_year;
                                foreach ($time_slot as $row1) {
                                    if ($day == $row1['timeslot_day'] && $time == $row1['timeslot_starttime']) {
                                        $model_group_timeslot['timeslot_id'] = $row1['timeslot_id'];
                                    }
                                }
                                $model_group_timeslot['time_insert'] = 1;
                                $model_group_timeslot['timeslot_lenght'] = (intval($subject_count_lab) / $row['section_count_lec']) * 2;
                                $model_group_timeslot->save();
                            }
                            $count_group++;
                            echo "<script>alert('บันทึกข้อมูลเรียบร้อย')</script>";
                        } else { // ในกรณีกรอกข้อมูลเวลามาไม่ครบต้อง check อีกว่า เค้ามีการกรอกมาหรือไม้
                            if ($check_slot_time != 0) { //ถ้าไม่เท่ากับ 0 แสดงว่า กรอกข้อมูลเวลามา แต่กรอกไม่ครบ
                                echo "<script>alert('กรุณากรอกข้อมูลให้ครบ')</script>";
                            }
                        }
                    } else { //กรณีไม่มี Section Join
                        $check_slot_time = 0;
                        $array_day = array();
                        $array_time = array();
                        //check ว่ากรอกเวลามาครบถ้วนหรือไม้
                        for ($i = 0; $i < $row['section_count_lec']; $i++) {
                            $array_day[$i] = \Yii::$app->request->post("day_lec" . ($i + 1) . intval($row['section_no']));
                            $array_time[$i] = \Yii::$app->request->post("time_lec" . ($i + 1) . intval($row['section_no']));
                            if ($array_day[$i] != null && $array_day[$i] != "0") {
                                $check_slot_time++;
                            }
                            if ($array_time[$i] != null && $array_time[$i] != "0") {
                                $check_slot_time++;
                            }
                        }
                        //check ว่ากรอกข้อมูลครบถ้วนหรือไม่
                        if ($check_slot_time == ($row['section_count_lec'] * 2)) { //ถ้า true แสดงว่่า ข้อมูลเวลามาครบ
                            $subject_and_subject_versio = $row['subject_id'] . $row['subject_version'];
                            $count_group_inSection = Kku30Group::find()
                                ->andWhere('group_no LIKE :query')
                                ->addParams([':query' => '%' . $subject_and_subject_versio . $semester_year . '%'])
                                ->count();
                            $model_group = new Kku30Group();
                            $model_group['group_no'] = $count_group_inSection . $subject_and_subject_versio . $semester_year;
                            $model_group['group_amount'] = $row['section_size'];
                            $model_group['group_type'] = 1;
                            $model_group['group_priority'] = 0;
                            $model_group['group_length'] = ($subject_count_lec / $row['section_count_lec']) * 2;
                            $model_group->save();
                            $model_group_section = new Kku30GroupSection();
                            $model_group_section['group_no'] = $count_group_inSection . $subject_and_subject_versio . $semester_year;
                            $model_group_section['section_no'] = $row['section_no'];
                            $model_group_section['subject_id'] = $row['subject_id'];
                            $model_group_section['subject_version'] = $row['subject_version'];
                            $model_group_section['subopen_semester'] = $row['subopen_semester'];
                            $model_group_section['subopen_year'] = $row['subopen_year'];
                            $model_group_section->save();
                            for ($i = 0; $i < $row['section_count_lec']; $i++) {
                                $model_group_timeslot = new Kku30GroupTimeslotRoom();
                                $model_group_timeslot['group_no'] = $count_group_inSection . $subject_and_subject_versio . $semester_year;
                                foreach ($time_slot as $row1) {
                                    if ($array_day[$i] == $row1['timeslot_day'] && $array_time[$i] == $row1['timeslot_starttime']) {
                                        $model_group_timeslot['timeslot_id'] = $row1['timeslot_id'];
                                    }
                                }
                                $model_group_timeslot['time_insert'] = 1;
                                $model_group_timeslot['timeslot_lenght'] = (intval($subject_count_lec) / $row['section_count_lec']) * 2;
                                $model_group_timeslot->save();
                            }
                            array_push($array_check_lec, $row['section_no']);
                            $count_group++;
                            echo "<script>alert('บันทึกข้อมูลเรียบร้อย')</script>";
                        } else { //ถ้า false ต้องเช็คว่า เค้ากรอกข้อมูลมาบ้างหรือไม่ถ้าไม่ก็ผ่าน แต่ถ้ากรอกมา 1 จุดแต่กรอกไม้ครบให้แสดงว่ากรอกข้อมูลไม่ครบ
                            if ($check_slot_time != 0) { //ถ้าไม่ = 0 แสดงว่ามีการกรอกแต่กรอกไม่ครบ ก็จะไม่ insert เวลา และแจ้งว่า กรอกให้ครับ
                                echo "<script>alert('กรุณากรอกข้อมูลเวลาเรียนให้ครบให้ครบ')</script>";
                            }
                        }
                    }
                }
            }
            //check คาบ Lecture

            //check คาบ Lab
            if (!(in_array($row['section_no'], $array_check_lab))) {
                if ($row['section_count_lab'] != null) {
                    if ($row['section_join_lab'] != null) {
                        $explode_section = explode(",", $row['section_join_lab']);
                        $check_slot_time = 0;
                        // Loop check ว่าเป็น Section กรอกเวลา
                        for ($i = 0; $i < $row['section_count_lab']; $i++) {
                            $check_lab_day_original = \Yii::$app->request->post("day_lab" . ($i + 1) . intval($row['section_no']));
                            $check_lab_time_original = \Yii::$app->request->post("time_lab" . ($i + 1) . intval($row['section_no']));
                            if ($check_lab_day_original != null && $check_lab_day_original != "0") {
                                $check_slot_time++;
                            }
                            if ($check_lab_time_original != null && $check_lab_time_original != "0") {
                                $check_slot_time++;
                            }
                            for ($j = 0; $j < sizeof($explode_section); $j++) {
                                $check_lab_day = \Yii::$app->request->post("day_lab" . ($i + 1) . intval($explode_section[$j]));
                                $check_lab_time = \Yii::$app->request->post("time_lab" . ($i + 1) . intval($explode_section[$j]));
                                if ($check_lab_day != null && $check_lab_day != "0") {
                                    if ($check_lab_day == $check_lab_day_original) {
                                        $check_slot_time++;
                                    }
                                }
                                if ($check_lab_time != null && $check_lab_time != "0") {
                                    if ($check_lab_time == $check_lab_time_original) {
                                        $check_slot_time++;
                                    }
                                }
                            }
                        }
                        // Loop check ว่าเป็น Section กรอกเวลา
                        if ($check_slot_time == (intval($row['section_count_lab']) * (sizeof($explode_section) + 1) * 2)) { //ถ้า true แสดงว่ากรอกเวลามาครบถ้วน
                            $subject_and_subject_versio = $row['subject_id'] . $row['subject_version'];
                            $count_group_inSection = Kku30Group::find()
                                ->andWhere('group_no LIKE :query')
                                ->addParams([':query' => '%' . $subject_and_subject_versio . $semester_year . '%'])
                                ->count();
                            $model_group = new Kku30Group();
                            $model_group['group_no'] = $count_group_inSection . $subject_and_subject_versio . $semester_year;
                            $model_group['group_amount'] = $row['section_size'];
                            if ($row['section_condition_lab'] != null) {
                                $model_group['group_room_condition'] = intval($row['section_condition_lab']);
                            }
                            $model_group['group_type'] = 2;
                            $model_group['group_priority'] = 0;
                            $model_group['group_length'] = ($subject_count_lab / $row['section_count_lab']) * 2;
                            $model_group->save();
                            $model_group_section = new Kku30GroupSection();
                            $model_group_section['group_no'] = $count_group_inSection . $subject_and_subject_versio . $semester_year;
                            $model_group_section['section_no'] = $row['section_no'];
                            $model_group_section['subject_id'] = $row['subject_id'];
                            $model_group_section['subject_version'] = $row['subject_version'];
                            $model_group_section['subopen_semester'] = $row['subopen_semester'];
                            $model_group_section['subopen_year'] = $row['subopen_year'];
                            $model_group_section->save();
                            array_push($array_check_lab, $row['section_no']);
                            foreach ($explode_section as $row1) {
                                $model_group_section = new Kku30GroupSection();
                                $model_group_section['group_no'] = $count_group_inSection . $subject_and_subject_versio . $semester_year;
                                $model_group_section['section_no'] = $row1;
                                $model_group_section['subject_id'] = $row['subject_id'];
                                $model_group_section['subject_version'] = $row['subject_version'];
                                $model_group_section['subopen_semester'] = $row['subopen_semester'];
                                $model_group_section['subopen_year'] = $row['subopen_year'];
                                $model_group_section->save();
                                array_push($array_check_lab, $row1);
                            }
                            for ($i = 0; $i < $row['section_count_lab']; $i++) {
                                $day = \Yii::$app->request->post("day_lab" . ($i + 1) . intval($row['section_no'])); //ไม่ต้องดึงมาทุกอันเพราะว่า check จากข้างบนแล้วว่า เหมือนกันทุก secrion ในส่วน ของ time
                                $time = \Yii::$app->request->post("time_lab" . ($i + 1) . intval($row['section_no'])); //ไม่ต้องดึงมาทุกอันเพราะว่า check จากข้างบนแล้วว่า เหมือนกันทุก secrion ในส่วน ของ time
                                $model_group_timeslot = new Kku30GroupTimeslotRoom();
                                $model_group_timeslot['group_no'] = $count_group_inSection . $subject_and_subject_versio . $semester_year;
                                foreach ($time_slot as $row1) {
                                    if ($day == $row1['timeslot_day'] && $time == $row1['timeslot_starttime']) {
                                        $model_group_timeslot['timeslot_id'] = $row1['timeslot_id'];
                                    }
                                }
                                $model_group_timeslot['time_insert'] = 1;
                                $model_group_timeslot['timeslot_lenght'] = (intval($subject_count_lab) / $row['section_count_lab']) * 2;
                                $model_group_timeslot->save();
                            }
                            $count_group++;
                            echo "<script>alert('บันทึกข้อมูลเรียบร้อย')</script>";
                        } else { // ในกรณีกรอกข้อมูลเวลามาไม่ครบต้อง check อีกว่า เค้ามีการกรอกมาหรือไม้
                            if ($check_slot_time != 0) { //ถ้าไม่เท่ากับ 0 แสดงว่า กรอกข้อมูลเวลามา แต่กรอกไม่ครบ และจะไม่ insert ตาราง
                                echo "<script>alert('กรุณากรอกข้อมูลให้ครบ')</script>";
                            }
                        }
                    } else { //กรณีไม่มี Section Join
                        $check_slot_time = 0;
                        $array_day = array();
                        $array_time = array();
                        //check ว่ากรอกเวลามาครบถ้วนหรือไม้
                        for ($i = 0; $i < $row['section_count_lab']; $i++) {
                            $array_day[$i] = \Yii::$app->request->post("day_lab" . ($i + 1) . intval($row['section_no']));
                            $array_time[$i] = \Yii::$app->request->post("time_lab" . ($i + 1) . intval($row['section_no']));
                            if ($array_day[$i] != null && $array_day[$i] != "0") {
                                $check_slot_time++;
                            }
                            if ($array_time[$i] != null && $array_time[$i] != "0") {
                                $check_slot_time++;
                            }
                        }
                        //check ว่ากรอกข้อมูลครบถ้วนหรือไม่
                        if ($check_slot_time == ($row['section_count_lab'] * 2)) { //ถ้า true แสดงว่่า ข้อมูลเวลามาครบ
                            $subject_and_subject_versio = $row['subject_id'] . $row['subject_version'];
                            $count_group_inSection = Kku30Group::find()
                                ->andWhere('group_no LIKE :query')
                                ->addParams([':query' => '%' . $subject_and_subject_versio . $semester_year . '%'])
                                ->count();
                            $model_group = new Kku30Group();
                            $model_group['group_no'] = $count_group_inSection . $subject_and_subject_versio . $semester_year;
                            $model_group['group_amount'] = $row['section_size'];
                            if ($row['section_condition_lab'] != null) {
                                $model_group['group_room_condition'] = intval($row['section_condition_lab']);
                            }
                            $model_group['group_type'] = 2;
                            $model_group['group_priority'] = 0;
                            $model_group['group_length'] = ($subject_count_lab / $row['section_count_lab']) * 2;
                            $model_group->save();
                            $model_group_section = new Kku30GroupSection();
                            $model_group_section['group_no'] = $count_group_inSection . $subject_and_subject_versio . $semester_year;
                            $model_group_section['section_no'] = $row['section_no'];
                            $model_group_section['subject_id'] = $row['subject_id'];
                            $model_group_section['subject_version'] = $row['subject_version'];
                            $model_group_section['subopen_semester'] = $row['subopen_semester'];
                            $model_group_section['subopen_year'] = $row['subopen_year'];
                            $model_group_section->save();
                            for ($i = 0; $i < $row['section_count_lab']; $i++) {
                                $model_group_timeslot = new Kku30GroupTimeslotRoom();
                                $model_group_timeslot['group_no'] = $count_group_inSection . $subject_and_subject_versio . $semester_year;
                                foreach ($time_slot as $row1) {
                                    if ($array_day[$i] == $row1['timeslot_day'] && $array_time[$i] == $row1['timeslot_starttime']) {
                                        $model_group_timeslot['timeslot_id'] = $row1['timeslot_id'];
                                    }
                                }
                                $model_group_timeslot['time_insert'] = 1;
                                $model_group_timeslot['timeslot_lenght'] = (intval($subject_count_lab) / $row['section_count_lab']) * 2;
                                $model_group_timeslot->save();
                            }
                            array_push($array_check_lab, $row['section_no']);
                            $count_group++;
                            echo "<script>alert('บันทึกข้อมูลเรียบร้อย')</script>";
                        } else { //ถ้า false ต้องเช็คว่า เค้ากรอกข้อมูลมาบ้างหรือไม่ถ้าไม่ก็ผ่าน แต่ถ้ากรอกมา 1 จุดแต่กรอกไม้ครบให้แสดงว่ากรอกข้อมูลไม่ครบ
                            if ($check_slot_time != 0) {
                                echo "<script>alert('กรุณากรอกข้อมูลให้ครบ')</script>";
                            }
                        }
                    }
                }
            }
            //check คาบ Lab
        }
        //ถ้าเป็นวิชาระบุเวลา
        //redirec to searchsubjectcondition
        $findadmission = intval($sub_year) - intval($sub_stdyear - 1);

        $subject_coruse_plan = Kku30SubjectCoursePlan::find()
            ->joinWith(['course.kku30ProgramsCourses join'])
            ->where([
                'join.program_id' => $sub_student,
                'join.admission_year' => $findadmission,
                'plan_studentyear' => intval($sub_stdyear)
            ])->orderBy([
                'plan_semester' => SORT_ASC,
            ])
            ->all();
        $Data_section_this_year_term = Kku30Section::find()
            ->where([
                'subopen_year' => $sub_year
            ])
            ->all();
        if ($subject_coruse_plan == null) {
            $course_id = 0;
        } else {
            $course_id = $subject_coruse_plan[0]['course_id'];
        }
        $array_subject_plan = ArrayHelper::toArray($subject_coruse_plan, ['app\modules\kku30\models\Kku30SubjectCoursePlan' => [
            'course_id',
            'plan_semester',
            'subject' => function ($subject_coruse_plan) {
                return $subject_coruse_plan->subject;
            }
        ]]);
        $Count_subject_Term1 = 0;
        $Data_subject_term1 = [];
        $Data_subject_term2 = [];
        foreach ($array_subject_plan as $count) {
            if ($count['plan_semester'] == '1') {
                $Count_subject_Term1 = $Count_subject_Term1 + 1;
                array_push($Data_subject_term1, $count);
            } else
                array_push($Data_subject_term2, $count);
        }
        $variableStudentyear = intval($sub_stdyear);
        $subject_elective = Kku30SubjectOpenProgram::find()
            ->joinWith(['subopenSemester.subject.kku30SubjectCoruses join'])
            ->joinWith(['subopenSemester join1'])
            ->where([
                "join1.subopen_year" => $sub_year,
                "join.typegroup_id" => 6,
                "program_class" => 1,
                "program_id" => $sub_student
            ])
            ->andWhere('student_year LIKE :query')
            ->addParams([':query' => '%' . $variableStudentyear . '%'])
            ->andWhere('join.course_id LIKE :query1')
            ->addParams([':query1' => '%' . $sub_student . '%'])
            ->all();

        $array_subject_elective_plan = ArrayHelper::toArray($subject_elective, ['app\modules\kku30\models\Kku30SubjectOpenProgram' => [
            'program_id',
            'student_year',
            'subopen_semester',
            'subject' => function ($subject_elective) {
                return $subject_elective->subopenSemester->subject;
            }
        ]]);

        $Count_subject_elective_term1 = 0;
        $Data_subject_elective_term1 = [];
        $Data_subject_elective_term2 = [];
        foreach ($array_subject_elective_plan as $countelective) {
            if ($countelective['subopen_semester'] == 1) {
                $Count_subject_elective_term1 = $Count_subject_elective_term1 + 1;
                array_push($Data_subject_elective_term1, $countelective);
            } else {
                array_push($Data_subject_elective_term2, $countelective);
            }
        }
        $Count_subject_elective_term2 = sizeof($subject_elective) - $Count_subject_elective_term1;
        $Count_subject_Term2 = sizeof($array_subject_plan) - $Count_subject_Term1;
        $this->layout = "main_module";
        return $this->render('addcondition', [
            'sub_student' => $sub_student,
            'sub_year' => $sub_year,
            'sub_stdyear' => $sub_stdyear,
            'Count_AllData' => sizeof($array_subject_plan),
            'Count_Term1' => $Count_subject_Term1,
            'Count_Term2' => $Count_subject_Term2,
            'Data_subject_term1' => $Data_subject_term1,
            'Data_subject_term2' => $Data_subject_term2,
            'sub_student' => $sub_student,
            'sub_stdyear' => $sub_stdyear,
            'sub_year' => $sub_year,
            'course_id' => $course_id,
            'Data_section_this_year_term' => $Data_section_this_year_term,

            'Count_AllData_Elective' => sizeof($array_subject_elective_plan),
            'Count_Elective_Term1' => $Count_subject_elective_term1,
            'Count_Elective_Term2' => $Count_subject_elective_term2,
            'Data_subject_elective_term1' => $Data_subject_elective_term1,
            'Data_subject_elective_term2' => $Data_subject_elective_term2,
        ]);
    }

    public function actionUpdatesection()
    {
        $sum_section = Yii::$app->request->post('sum_section');
        $subject_id = Yii::$app->request->post('subject_id');
        $subject_version = Yii::$app->request->post('subject_version');
        $subopen_semester = Yii::$app->request->post('plan_semester');
        $subopen_year = Yii::$app->request->post('sub_year');
        $subject_count_lab = Yii::$app->request->post('subject_count_lab');
        $subject_count_lec = Yii::$app->request->post('subject_count_lec');


        $sub_student = Yii::$app->request->post('sub_student');
        $sub_year = Yii::$app->request->post('sub_year');
        $sub_stdyear = Yii::$app->request->post('sub_stdyear');

        echo($sum_section);
        echo("<br>");
        echo($subject_id);
        echo("<br>");
        echo($subject_version);
        echo("<br>");
        echo($subopen_semester);
        echo("<br>");
        echo($subopen_year);
        echo("<br>");
        echo($subject_count_lab);
        echo("<br>");
        echo($subject_count_lec);
        echo("<br>");
        echo($sub_student);
        echo("<br>");
        echo($sub_year);
        echo("<br>");
        echo($sub_stdyear);
        echo("<br>");
        exit();
    }

    public function actionInsertsectiondetail($Data_id_sub, $Data_nameThai, $Data_nameEng, $subject_version, $subject_credit, $plan_semester, $subject_count_lab, $subject_count_lec)
    {
        $group_amount = \Yii::$app->request->post('group_amount');
        $sub_student = \Yii::$app->request->post('sub_student');
        $sub_year = \Yii::$app->request->post('sub_year');
        $sub_stdyear = \Yii::$app->request->post('sub_stdyear');
        $section_no = \Yii::$app->request->post('section_no');
        $std_amount = \Yii::$app->request->post('std_amount');
        $count_lecture = "";
        $count_lab = "";
        $section = array();


//    echo Json::encode($section_no);
//        $major[1]="";
        for ($i = 1; $i <= $section_no; $i++) {
//
            $L1[] = \Yii::$app->request->post('L1' . $i);
            $L2[] = \Yii::$app->request->post('L2' . $i);
            $L3[] = \Yii::$app->request->post('L3' . $i);

            $LB1[] = \Yii::$app->request->post('LB1' . $i);
            $LB2[] = \Yii::$app->request->post('LB2' . $i);
            $LB3[] = \Yii::$app->request->post('LB3' . $i);


            $std_cs_project1[] = \Yii::$app->request->post('std_cs_project1' . $i);
            $std_cs_project2[] = \Yii::$app->request->post('std_cs_project2' . $i);
            $std_cs_project3[] = \Yii::$app->request->post('std_cs_project3' . $i);
            $std_cs_project4[] = \Yii::$app->request->post('std_cs_project4' . $i);

            $std_it_project1[] = \Yii::$app->request->post('std_it_project1' . $i);
            $std_it_project2[] = \Yii::$app->request->post('std_it_project2' . $i);
            $std_it_project3[] = \Yii::$app->request->post('std_it_project3' . $i);
            $std_it_project4[] = \Yii::$app->request->post('std_it_project4' . $i);


            $std_gis_project1[] = \Yii::$app->request->post('std_gis_project1' . $i);
            $std_gis_project2[] = \Yii::$app->request->post('std_gis_project2' . $i);
            $std_gis_project3[] = \Yii::$app->request->post('std_gis_project3' . $i);
            $std_gis_project4[] = \Yii::$app->request->post('std_gis_project4' . $i);


            $condition_lab[] = \Yii::$app->request->post('condition_lab' . $i);
            $condition_section[] = \Yii::$app->request->post('condition_section' . $i);
            $major[] = \Yii::$app->request->post('major' . $i);
            $std_year[] = \Yii::$app->request->post('std_year' . $i);
            $std_project[] = \Yii::$app->request->post('std_project' . $i);
            $lec_time[] = \Yii::$app->request->post('lec_time' . $i);
            $lab_time[] = \Yii::$app->request->post('lab_time' . $i);

            $model = new Kku30Section();
            if ($i < 10) {
                $model['section_no'] = "0" . $i;
            }
            $model['subject_id'] = $Data_id_sub;
            $model['subject_version'] = $subject_version;
            $model['subopen_semester'] = $plan_semester;
            $model['subopen_year'] = $sub_year;
            $model['section_size'] = $std_amount[$i - 1];
            if ($subject_count_lec != 0) {
                $count_lecture = $subject_count_lec / $lec_time[$i - 1][0];
                $model['section_count_lec'] = $count_lecture;
            } else {
                $model['section_count_lec'] = $subject_count_lec;
            }
            if ($subject_count_lab != 0) {
                $count_lab = $subject_count_lab / $lab_time[$i - 1][0];
                $model['section_count_lab'] = $count_lab;
            } else {
                $model['section_count_lab'] = $subject_count_lab;
            }
            if ($i == $section_no) {

//                print_r($condition_lab);
//                 print_r($std_cs_project1);
//                print_r($std_cs_project2);
//                print_r($std_cs_project3);
//                print_r($std_cs_project4);
//
//                print_r($std_it_project1);
//                print_r($std_it_project2);
//                print_r($std_it_project3);
//                print_r($std_it_project4);
//
//                print_r($std_gis_project1);
//                print_r($std_gis_project2);
//                print_r($std_gis_project3);
//                print_r($std_gis_project4);
//                 exit();
//                print_r($std_year);
//                print_r($std_project);
//                print_r($condition_lab);
//                print_r($lab_time);
//                print_r($lec_time);
//                exit();
//                print_r($L1);
//                print_r($L2);
//                print_r($L3);
//
//                print_r($LB1);
//                print_r($LB2);
//                print_r($LB3);
//                exit();
            }
////            $model->save();
        }
//        print_r($std_amount);
//        echo "<br>";
//        echo "จำนวน section ".($section_no);
//        echo "<br>";
//        echo "รหัสวิชา ".$Data_id_sub;
//        echo "<br>";
//        echo "เว่อชั่นร์ ".$subject_version;
//        echo "<br>";
//        echo "เทอม ".$plan_semester;
//        echo "<br>";
//        echo "จำนวน lab ".$subject_count_lab;
//        echo "<br>";
//        echo "จำนวน lecture ".$subject_count_lec;
//
//        exit();

        $group_amount = "";
        return $this->render('showaddgroupsection', [
//                'group_amount' => $group_amount,
            'section_no' => $section_no,
            'Data_id_sub' => $Data_id_sub,
            'Data_nameThai' => $Data_nameThai,
            'Data_nameEng' => $Data_nameEng,
            'plan_semester' => $plan_semester,
            'subject_version' => $subject_version,
            'subject_credit' => $subject_credit,
            'subject_count_lec' => $subject_count_lec,
            'subject_count_lab' => $subject_count_lab,
            'sub_year' => $sub_year,
            'sub_student' => $sub_student,
            'sub_stdyear' => $sub_stdyear,
            'std_amount' => $std_amount,

            'L1' => $L1,
            'L2' => $L2,
            'L3' => $L3,
            'LB1' => $LB1,
            'LB2' => $LB2,
            'LB3' => $LB3,

            'condition_lab' => $condition_lab,
            'condition_section' => $condition_section,
            'major' => $major,
            'std_year' => $std_year,
            'std_project' => $std_project,
            'lec_time' => $lec_time,
            'lab_time' => $lab_time,

            'count_lecture' => $count_lecture,
            'count_lab' => $count_lab,

            'std_cs_project1' => $std_cs_project1,
            'std_cs_project2' => $std_cs_project2,
            'std_cs_project3' => $std_cs_project3,
            'std_cs_project4' => $std_cs_project4,

            'std_it_project1' => $std_it_project1,
            'std_it_project2' => $std_it_project2,
            'std_it_project3' => $std_it_project3,
            'std_it_project4' => $std_it_project4,

            'std_gis_project1' => $std_gis_project1,
            'std_gis_project2' => $std_gis_project2,
            'std_gis_project3' => $std_gis_project3,
            'std_gis_project4' => $std_gis_project4,
        ]);
    }

    public function actionAddsection($Data_id_sub, $Data_nameThai, $Data_nameEng, $plan_semester, $subject_version, $sub_year, $subject_credit, $subject_count_lec, $subject_count_lab, $sub_student, $sub_stdyear)
    {
        $programs_learn_subject = Kku30SubjectOpenProgram::find()
            ->where([
                'subject_id' => $Data_id_sub,
                'subject_version' => $subject_version,
                'subopen_year' => $sub_year,
                'subopen_semester' => $plan_semester
            ])
            ->all();
        //แยก สาขาออก
        $array_learn_CS = array();
        $array_learn_IT = array();
        $array_learn_GIS = array();
        foreach ($programs_learn_subject as $row) {
            if ($row['program_id'] == "CS") {
                array_push($array_learn_CS, $row);
            }
            if ($row['program_id'] == "IT") {
                array_push($array_learn_IT, $row);
            }
            if ($row['program_id'] == "GIS") {
                array_push($array_learn_GIS, $row);
            }
        }
        //แยก สาขาออก
        $section_no = \Yii::$app->request->post('section_no');
        $Data_teacher = Kku30Teacher::find()
            ->all();
        $Data_Room = Kku30Room::find()
            ->where([
                '>=', 'room_type', 2
            ])
            ->andWhere([
                'room_status' => 1
            ])
            ->all();
        $this->layout = "main_module";
        return $this->render('_formaddsection', [
            'array_learn_CS' => $array_learn_CS,
            'array_learn_IT' => $array_learn_IT,
            'array_learn_GIS' => $array_learn_GIS,
            'section_no' => $section_no,
            'Data_id_sub' => $Data_id_sub,
            'Data_nameThai' => $Data_nameThai,
            'Data_nameEng' => $Data_nameEng,
            'plan_semester' => $plan_semester,
            'subject_version' => $subject_version,
            'subject_credit' => $subject_credit,
            'subject_count_lec' => $subject_count_lec,
            'subject_count_lab' => $subject_count_lab,
            'sub_year' => $sub_year,
            'sub_student' => $sub_student,
            'sub_stdyear' => $sub_stdyear,
            'Data_teacher' => $Data_teacher,
            'Data_Room' => $Data_Room
        ]);
    }

    public function actionEditsection($Data_id_sub, $Data_nameThai, $Data_nameEng, $plan_semester, $subject_version, $sub_year, $subject_credit, $subject_count_lec, $subject_count_lab, $sub_student, $sub_stdyear)
    {
        $new_section_no = Yii::$app->request->post('section_no');
        if ($new_section_no == null) {
            $new_section_no = 0;
        }
        $data = Kku30Section::find()
            ->where([
                'subject_id' => $Data_id_sub,
                'subject_version' => $subject_version,
                'subopen_semester' => $plan_semester,
                'subopen_year' => $sub_year
            ])
            ->all();
        $semester_year = $plan_semester . $sub_year . "";
        $Data_Group = Kku30Group::find()
            ->Where('group_no LIKE :query')
            ->addParams([':query' => '%' . $semester_year . '%'])
            ->all();
        $section_data = ArrayHelper::toArray($data, ['app\modules\kku30\models\Kku30Section' => [  // set array ให้ออกมาในการดึงครังเดียว
            'section_no',
            'subject_id',
            'subject_version',
            'subopen_semester',
            'subopen_year',
            'section_size',
            'section_join_lec',
            'section_join_lab',
            'section_count_lec',
            'section_count_lab',
            'section_condition_lab',
            'subject_detail' => function ($data) {
                return $data->subopenSemester->subject;
            },
            'section_program' => function ($data) {
                return $data->kku30SectionPrograms;
            },
            'section_teacher' => function ($data) {
                return $data->kku30SectionTeachers;
            },
            'time' => function ($data) {
                $group_timeslot = ArrayHelper::toArray($data->kku30GroupSections, ['app\modules\kku30\models\Kku30GroupSection' => [
                    'group_timeslot' => function ($group_section) {
                        $Timeslot = Kku30GroupTimeslotRoom::find()
                            ->where([
                                'group_no' => $group_section->group_no,
                            ])->all();
                        return $Timeslot;
                    },
                ]]);
                return $group_timeslot;
            },
        ]]);

        $programs_learn_subject = Kku30SubjectOpenProgram::find()
            ->where([
                'subject_id' => $Data_id_sub,
                'subject_version' => $subject_version,
                'subopen_year' => $sub_year,
                'subopen_semester' => $plan_semester
            ])
            ->all();
        //แยก สาขาออก
        $array_learn_CS = array();
        $array_learn_IT = array();
        $array_learn_GIS = array();
        foreach ($programs_learn_subject as $row) {
            if ($row['program_id'] == "CS") {
                array_push($array_learn_CS, $row);
            }
            if ($row['program_id'] == "IT") {
                array_push($array_learn_IT, $row);
            }
            if ($row['program_id'] == "GIS") {
                array_push($array_learn_GIS, $row);
            }
        }

        $Data_teacher = Kku30Teacher::find()->all();
        $Data_Room = Kku30Room::find()
            ->where([
                '>=', 'room_type', 2
            ])
            ->andWhere([
                'room_status' => 1
            ])
            ->all();
        $Data_time_slot = Kku30Timeslot::find()
            ->all();

//        echo Json::encode($section_data);
        $this->layout = "main_module";
        return $this->render('_formeditsection', [
            'section_data' => $section_data,
            'array_learn_CS' => $array_learn_CS,
            'array_learn_IT' => $array_learn_IT,
            'array_learn_GIS' => $array_learn_GIS,
            'Data_teacher' => $Data_teacher,
            'data' => $data,
            'Data_id_sub' => $Data_id_sub,
            'Data_nameThai' => $Data_nameThai,
            'Data_nameEng' => $Data_nameEng,
            'plan_semester' => $plan_semester,
            'subject_version' => $subject_version,
            'sub_year' => $sub_year,
            'subject_credit' => $subject_credit,
            'subject_count_lec' => $subject_count_lec,
            'subject_count_lab' => $subject_count_lab,
            'sub_student' => $sub_student,
            'sub_stdyear' => $sub_stdyear,
            'new_section_no' => $new_section_no,
            'Data_Room' => $Data_Room,
            'Data_time_slot' => $Data_time_slot,
            'Data_Group' => $Data_Group
        ]);
    }

    public function actionDatamanagement()
    {
        return $this->render('datamanagement', [
        ]);
    }

    public function actionAddgroupsection()
    {
//        $section_no = \Yii::$app->request->post('section_no');

        return $this->render('_formaddgroupsection', [

        ]);
    }

    public function actionShowaddgroupsection()
    {
//        $section_no = \Yii::$app->request->post('section_no');
        $group_amount = "";
        return $this->render('showaddgroupsection', [
            'group_amount' => $group_amount,

        ]);
    }

    public function actionAddgroupsectionamount()
    {
//        echo($section_no);
//        exit();
        $group_amount = \Yii::$app->request->post('group_amount');


        return $this->render('showaddgroupsection', [
            'group_amount' => $group_amount
        ]);
    }

    public function actionShowdatamanagement()
    {
        return $this->render('datamanagement');
    }

    public function actionDatamanagements()
    {

        $source_year = Yii::$app->request->post('source_year');
        $source_semester = Yii::$app->request->post('source_semester');

        $des_year = Yii::$app->request->post('des_year');
        $des_semester = Yii::$app->request->post('des_semester');

        $all_data_subject = Yii::$app->request->post('all_data_subject');
        $all_data_condition = Yii::$app->request->post('all_data_condition');
        $all_data_timetable = Yii::$app->request->post('all_data_timetable');

//        echo($all_data_subject);
//        echo($all_data_condition);
//        echo($all_data_timetable);
//        exit();
//
//        echo ("SOURCE");
//        echo ("<br>");
//        echo ($source_year);
//        echo ("<br>");
//        echo ($source_semester);
//
//        echo ("DESTINATION");
//        echo ("<br>");
//        echo ($des_year);
//        echo ("<br>");
//        echo ($des_semester);
//        exit();

        // ************ COPY TABLE ****************
        if ($all_data_timetable == 1) {

            $year_start = $source_year;
            $semester_start = $source_semester;
            $year_semester_start = $semester_start . $year_start . "";

            $year_end = $des_year;
            $semester_end = $des_semester;
            $year_semester_end = $semester_end . $year_end . "";

            $data_all_timeslot = Kku30GroupTimeslotRoom::find()
                ->Where('group_no LIKE :query')
                ->addParams([':query' => '%' . $year_semester_start . '%'])
                ->andwhere([
                    'time_insert' => 0,
                ])->all();

            foreach ($data_all_timeslot as $row) {
                $model_group_timeslot_room = new Kku30GroupTimeslotRoom();
                $model_group_timeslot_room['group_no'] = substr($row['group_no'], 0, -5) . $year_semester_end;
                $model_group_timeslot_room['timeslot_id'] = $row['timeslot_id'];
                $model_group_timeslot_room['timeslot_lenght'] = $row['timeslot_lenght'];
                $model_group_timeslot_room['room_id'] = $row['room_id'];
                $model_group_timeslot_room['time_insert'] = $row['time_insert'];
                $model_group_timeslot_room->save();
            }


            echo("return to view ");
            exit ();
        }
        // ************ COPY TABLE ****************


        return $this->render('datamanagement', [
        ]);


    }

    public function actionShowdatamanagements()
    {
        $this->layout = "main_module";
        return $this->render('datamanagement');
    }

    public function actionCopysubjectopen()
    {
        $source_semester = Yii::$app->request->post('source_semester');
        $source_year = Yii::$app->request->post('source_year');
        $des_semester = Yii::$app->request->post('des_semester');
        $des_year = Yii::$app->request->post('des_year');

        $year_start = $source_year;
        $semester_start = $source_semester;

        $year_end = $des_year;
        $semester_end = $des_semester;

        $data_subject_open = Kku30SubjectOpen::find()
            ->where([
                'subopen_year' => $year_start,
                'subopen_semester' => $semester_start,
            ])->all();

        foreach ($data_subject_open as $row) {
            $model_subject_open = new Kku30SubjectOpen();
            $model_subject_open['subject_id'] = $row['subject_id'];
            $model_subject_open['subject_version'] = $row['subject_version'];
            $model_subject_open['subopen_semester'] = $semester_end;
            $model_subject_open['subopen_year'] = $year_end;
            $model_subject_open->save();
        }

        $data_subject_open_programs = Kku30SubjectOpenProgram::find()
            ->where([
                'subopen_year' => $year_start,
                'subopen_semester' => $semester_start,
            ])->all();


        foreach ($data_subject_open_programs as $row) {
            $model_subject_open = new Kku30SubjectOpenProgram();
            $model_subject_open['subject_id'] = $row['subject_id'];
            $model_subject_open['subject_version'] = $row['subject_version'];
            $model_subject_open['subopen_semester'] = $semester_end;
            $model_subject_open['subopen_year'] = $year_end;
            $model_subject_open['program_id'] = $row['program_id'];
            $model_subject_open['program_class'] = $row['program_class'];
            $model_subject_open['student_year'] = $row['student_year'];
            $model_subject_open->save();
        }

        echo '<script language="javascript">';
        echo 'alert("บันทึกข้อมูลสำเร็จ !")';
        echo '</script>';
        $this->redirect(array('showdatamanagement', 'source_semester' => $source_semester, 'source_year' => $source_year, 'des_semester' => $des_semester, 'des_year' => $des_year,));

    }

    public function actionCopysectionandcondition()
    {
        $source_semester = Yii::$app->request->post('source_semester');
        $source_year = Yii::$app->request->post('source_year');
        $des_semester = Yii::$app->request->post('des_semester');
        $des_year = Yii::$app->request->post('des_year');
        $year_start = $source_year;
        $semester_start = $source_semester;
        $year_semester_start = $semester_start . $year_start . "";

        $year_end = $des_year;
        $semester_end = $des_semester;
        $year_semester_end = $semester_end . $year_end . "";

        $data_section = Kku30Section::find()
            ->where([
                'subopen_year' => $year_start,
                'subopen_semester' => $semester_start,
            ])->all();

        foreach ($data_section as $row) {
            $model_section = new Kku30Section();
            $model_section['section_no'] = $row['section_no'];
            $model_section['subject_id'] = $row['subject_id'];
            $model_section['subject_version'] = $row['subject_version'];
            $model_section['subopen_semester'] = $semester_end;
            $model_section['subopen_year'] = $year_end;
            $model_section['section_size'] = $row['section_size'];
            $model_section['section_join_lec'] = $row['section_join_lec'];
            $model_section['section_join_lab'] = $row['section_join_lab'];
            $model_section['section_count_lec'] = $row['section_count_lec'];
            $model_section['section_count_lab'] = $row['section_count_lab'];
            $model_section['section_condition_lab'] = $row['section_condition_lab'];
            $model_section->save();
        }

        $data_section_program = Kku30SectionProgram::find()
            ->where([
                'subopen_year' => $year_start,
                'subopen_semester' => $semester_start,
            ])->all();

        foreach ($data_section_program as $row) {
            $model_section_programs = new Kku30SectionProgram();
            $model_section_programs['section_no'] = $row['section_no'];
            $model_section_programs['subject_id'] = $row['subject_id'];
            $model_section_programs['subject_version'] = $row['subject_version'];
            $model_section_programs['subopen_semester'] = $semester_end;
            $model_section_programs['subopen_year'] = $year_end;
            $model_section_programs['program_id'] = $row['program_id'];
            $model_section_programs['program_class'] = $row['program_class'];
            $model_section_programs['student_year'] = $row['student_year'];
            $model_section_programs->save();
        }

        $data_section_teacher = Kku30SectionTeacher::find()
            ->where([
                'subopen_year' => $year_start,
                'subopen_semester' => $semester_start,
            ])->all();

        foreach ($data_section_teacher as $row) {
            $model_section_teacher = new Kku30SectionTeacher();
            $model_section_teacher['section_no'] = $row['section_no'];
            $model_section_teacher['subject_id'] = $row['subject_id'];
            $model_section_teacher['subject_version'] = $row['subject_version'];
            $model_section_teacher['subopen_semester'] = $semester_end;
            $model_section_teacher['subopen_year'] = $year_end;
            $model_section_teacher['teacher_no'] = $row['teacher_no'];
            $model_section_teacher->save();
        }

        $data_group_timeslot = Kku30GroupTimeslotRoom::find()
            ->Where('group_no LIKE :query')
            ->addParams([':query' => '%' . $year_semester_start . '%'])
            ->andwhere([
                'time_insert' => 1,
            ])->all();

        foreach ($data_group_timeslot as $row) {
            //check ว่า Insert group นั้นไปหรือยัง
            $count = Kku30Group::find()
                ->where([
                    'group_no' => substr($row['group_no'], 0, -5) . $year_semester_end
                ])->count();
            if ($count == 0) {
                $model_group = new Kku30Group();
                $model_group['group_no'] = substr($row['group_no'], 0, -5) . $year_semester_end;
                $model_group['group_amount'] = $row['group_amount'];
                $model_group['group_type'] = $row['group_type'];
                $model_group['group_priority'] = $row['group_priority'];
                $model_group['group_length'] = $row['group_length'];
                $model_group->save();
            }
            //check ว่า Insert group นั้นไปหรือยัง
            $data_section_Group = Kku30GroupSection::find()
                ->where([
                    'group_no' => $row['group_no']
                ])
                ->all();
            foreach ($data_section_Group as $row1) {
                $model_group_section = new Kku30GroupSection();
                $model_group_section['group_no'] = substr($row['group_no'], 0, -5) . $year_semester_end;
                $model_group_section['section_no'] = $row1['section_no'];
                $model_group_section['subject_id'] = $row1['subject_id'];
                $model_group_section['subject_version'] = $row1['subject_version'];
                $model_group_section['subopen_semester'] = $semester_end;
                $model_group_section['subopen_year'] = $year_end;
                $model_group_section->save();
            }
        }

        echo '<script language="javascript">';
        echo 'alert("บันทึกข้อมูลสำเร็จ !")';
        echo '</script>';

        $this->redirect(array('showdatamanagement', 'source_semester' => $source_semester, 'source_year' => $source_year, 'des_semester' => $des_semester, 'des_year' => $des_year,));
    }

    public function actionCopytable()
    {
        $source_semester = Yii::$app->request->post('source_semester');
        $source_year = Yii::$app->request->post('source_year');
        $des_semester = Yii::$app->request->post('des_semester');
        $des_year = Yii::$app->request->post('des_year');


        $year_start = $source_year;
        $semester_start = $source_semester;
        $year_semester_start = $semester_start . $year_start . "";

        $year_end = $des_year;
        $semester_end = $des_semester;
        $year_semester_end = $semester_end . $year_end . "";

        $data_all_timeslot = Kku30GroupTimeslotRoom::find()
            ->Where('group_no LIKE :query')
            ->addParams([':query' => '%' . $year_semester_start . '%'])
            ->andwhere([
                'time_insert' => 0,
            ])->all();

//        echo Json::encode($data_all_timeslot);
//        exit();

        foreach ($data_all_timeslot as $row) {
            $model_group_timeslot_room = new Kku30GroupTimeslotRoom();
            $model_group_timeslot_room['group_no'] = substr($row['group_no'], 0, -5) . $year_semester_end;
            $model_group_timeslot_room['timeslot_id'] = $row['timeslot_id'];
            $model_group_timeslot_room['timeslot_lenght'] = $row['timeslot_lenght'];
            $model_group_timeslot_room['room_id'] = $row['room_id'];
            $model_group_timeslot_room['time_insert'] = $row['time_insert'];
            $model_group_timeslot_room->save();
        }
        echo '<script language="javascript">';
        echo 'alert("บันทึกข้อมูลสำเร็จ !")';
        echo '</script>';

        $this->redirect(array('showdatamanagement', 'source_semester' => $source_semester, 'source_year' => $source_year, 'des_semester' => $des_semester, 'des_year' => $des_year,));
    }

    public function actionShowdeletetimetable()
    {
        $year = Yii::$app->request->get('year');
        $semester = Yii::$app->request->get('semester');
        $this->layout = "main_module";
        return $this->render('deletetimetable', [
            'year' => $year,
            'semester' => $semester
        ]);
    }

    public function actionAjaxCheckDelete()
    {
        $year = Yii::$app->request->post('year');
        $semester = Yii::$app->request->post('semester');
        $check_delete_subject_open = 0;
        $check_delete_condition = 0;
        $check_delete_timeslot = 0;
        $search_semester_year = $semester . $year . "";
        //ค้นหาว่ามีวิชาที่เปิดหรือไม่
        $Data_subject = Kku30SubjectOpen::find()
            ->where([
                'subopen_semester' => intval($semester),
                'subopen_year' => intval($year)
            ])
            ->all();
        //ค้นหาว่ามีวิชาที่เปิดหรือไม่

        //ค้นหาว่ามี section ที่เปิดหรือไม่
        $Data_section = Kku30Section::find()
            ->where([
                'subopen_semester' => intval($semester),
                'subopen_year' => intval($year)
            ])
            ->all();
        //ค้นหาว่ามี section ที่เปิดหรือไม่


        //ค้นหาว่ามี timeslot นั้นหรือไม่่
        $timeslot = Kku30GroupTimeslotRoom::find()
            ->where('group_no LIKE :query')
            ->addParams([':query' => '%' . $search_semester_year . '%'])
            ->andWhere([
                'time_insert' => 0
            ])
            ->all();
        $Data_timeslot = array();
        for ($i = 0; $i < sizeof($timeslot); $i++) {
            $str_check = substr($timeslot[$i]['group_no'], -5, 5);
            if ($str_check == $search_semester_year) {
                array_push($Data_timeslot, $timeslot[$i]);
            }
        }
        //ค้นหาว่ามี timeslot นั้นหรือไม่่

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'year' => $year,
            'semester' => $semester,
            'sizeofSection' => sizeof($Data_section),
            'sizeofSubject' => sizeof($Data_subject),
            'sizeofTimeslot' => sizeof($Data_timeslot)
        ];
    }

    public function actionAjaxDeleteSubjectOpen()
    {
        $year = Yii::$app->request->post('year');
        $semester = Yii::$app->request->post('semester');

        //delete subjectopen programs
        $Data_subject_open_programs = Kku30SubjectOpenProgram::find()
            ->where([
                'subopen_semester' => intval($semester),
                'subopen_year' => intval($year)
            ])
            ->all();
        foreach ($Data_subject_open_programs as $row) {
            Kku30SubjectOpenProgram::deleteAll([
                'subject_id' => $row['subject_id'],
                'subject_version' => $row['subject_version'],
                'subopen_semester' => $row['subopen_semester'],
                'subopen_year' => $row['subopen_year'],
                'program_id' => $row['program_id'],
                'program_class' => $row['program_class'],
                'student_year' => $row['student_year'],
            ]);
        }
        //delete subjectopen programs
        //delete subjectopen
        $Data_subject_open = Kku30SubjectOpen::find()
            ->where([
                'subopen_semester' => intval($semester),
                'subopen_year' => intval($year)
            ])
            ->all();
        foreach ($Data_subject_open as $row) {
            Kku30SubjectOpen::deleteAll([
                'subject_id' => $row['subject_id'],
                'subject_version' => $row['subject_version'],
                'subopen_semester' => $row['subopen_semester'],
                'subopen_year' => $row['subopen_year']
            ]);
        }
        //delete subjectopen
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'year' => $year,
            'semester' => $semester,
        ];
    }

    public function actionAjaxDeleteSectionCondition()
    {
        $year = Yii::$app->request->post('year');
        $semester = Yii::$app->request->post('semester');
        $search_year_semester = $semester . $year . "";

        //delete group timeslot ออกไปให้หมดก่อน
        $Grouptimeslot = Kku30GroupTimeslotRoom::find()
            ->where('group_no LIKE :query')
            ->addParams([':query' => '%' . $search_year_semester . '%'])
            ->andWhere([
                'time_insert' => 1
            ])
            ->all();
        $Data_grpup_timeslot = array(); //เอาไว้ใช้ลบ Group เพิ่ม
        foreach ($Grouptimeslot as $row) {
            $str_check = substr($row['group_no'], -5, 5);
            if ($str_check == $search_year_semester) {
                array_push($Data_grpup_timeslot, $row);
            }
        }
        foreach ($Data_grpup_timeslot as $row) {
            Kku30GroupTimeslotRoom::deleteAll([
                'group_no' => $row['group_no'],
                'timeslot_id' => $row['timeslot_id']
            ]);
        }
        //delete group timeslot ออกไปให้หมดก่อน

        //delete group section
        $Data_group_section = Kku30GroupSection::find()
            ->where([
                'subopen_year' => intval($year),
                'subopen_semester' => intval($semester)
            ])
            ->all();

        foreach ($Data_group_section as $row) {
            Kku30GroupSection::deleteAll([
                'group_no' => $row['group_no'],
                'section_no' => $row['section_no'],
                'subject_id' => $row['subject_id'],
                'subject_version' => $row['subject_version'],
                'subopen_semester' => $row['subopen_semester'],
                'subopen_year' => $row['subopen_year']
            ]);
        }
        //delete group section
        // delete group
        $Data_Group = array();
        $Group = Kku30Group::find()
            ->where('group_no LIKE :query')
            ->addParams([':query' => '%' . $search_year_semester . '%'])
            ->all();
        foreach ($Group as $row) {
            $str_check = substr($row['group_no'], -5, 5);
            if ($str_check == $search_year_semester) {
                array_push($Data_Group, $row);
            }
        }
        foreach ($Data_Group as $row) {
            Kku30Group::deleteAll([
                'group_no' => $row['group_no'],
            ]);
        }
        // delete group
        //delete teacher
        $data_section_teacher = Kku30SectionTeacher::find()
            ->where([
                'subopen_semester' => $semester,
                'subopen_year' => $year
            ])
            ->all();
        foreach ($data_section_teacher as $row) {
            Kku30SectionTeacher::deleteAll([
                'section_no' => $row['section_no'],
                'subject_id' => $row['subject_id'],
                'subject_version' => $row['subject_version'],
                'subopen_semester' => $row['subopen_semester'],
                'subopen_year' => $row['subopen_year'],
                'teacher_no' => $row['teacher_no']
            ]);
        }
        //delete teacher
        //delete programs
        $data_section_programs = Kku30SectionProgram::find()
            ->where([
                'subopen_semester' => $semester,
                'subopen_year' => $year
            ])
            ->all();
        foreach ($data_section_programs as $row) {
            Kku30SectionProgram::deleteAll([
                'section_no' => $row['section_no'],
                'subject_id' => $row['subject_id'],
                'subject_version' => $row['subject_version'],
                'subopen_semester' => $row['subopen_semester'],
                'subopen_year' => $row['subopen_year'],
                'program_id' => $row['program_id'],
                'program_class' => $row['program_class'],
                'student_year' => $row['student_year']
            ]);
        }
        //delete programs
        //delete section
        $data_section = Kku30Section::find()
            ->where([
                'subopen_semester' => $semester,
                'subopen_year' => $year
            ])
            ->all();
        foreach ($data_section as $row) {
            Kku30Section::deleteAll([
                'section_no' => $row['section_no'],
                'subject_id' => $row['subject_id'],
                'subject_version' => $row['subject_version'],
                'subopen_semester' => $row['subopen_semester'],
                'subopen_year' => $row['subopen_year'],
            ]);
        }
        //delete section

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'year' => $year,
            'semester' => $semester,
        ];
    }

    public function actionAjaxDeleteTimeslot()
    {
        $year = Yii::$app->request->post('year');
        $semester = Yii::$app->request->post('semester');
        $semester_year = $semester . $year . "";

        $Check_save = Kku30CheckTable::find()
            ->where([
                'check_table_year' => intval($year),
                'check_table_semester' => intval($semester)
            ])
            ->all();
        foreach ($Check_save as $row) {
            Kku30CheckTable::deleteAll([
                'check_table_year' => $row['check_table_year'],
                'check_table_semester' => $row['check_table_semester']
            ]);
        }
        //delete_grouptimeslotroom
        $Grouptimeslot = Kku30GroupTimeslotRoom::find()
            ->Where('group_no LIKE :query')
            ->addParams([':query' => '%' . $semester_year . '%'])
            ->andwhere([
                'time_insert' => 0
            ])
            ->all();

        $Data_Group_timeslot = array();
        foreach ($Grouptimeslot as $row) {
            $str_check = substr($row['group_no'], -5, 5);
            if ($str_check == $semester_year) {
                array_push($Data_Group_timeslot, $row);
            }
        }

        foreach ($Data_Group_timeslot as $row) {
            Kku30GroupTimeslotRoom::deleteAll([
                'group_no' => $row['group_no'],
                'timeslot_id' => $row['timeslot_id'],
            ]);
        }
        //delete_grouptimeslotroom
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'year' => $year,
            'semester' => $semester,
        ];
    }

    public function actionAjaxGetDataSubject()
    {
        $source_year = Yii::$app->request->post('source_year');
        $source_semester = Yii::$app->request->post('source_semester');
        $des_year = Yii::$app->request->post('des_year');
        $des_semester = Yii::$app->request->post('des_semester');

        $Data_Subject_open = Kku30SubjectOpen::find()
            ->where([
                'subopen_year' => $source_year,
                'subopen_semester' => $source_semester
            ])
            ->all();

        //ต้อง check ก่อนว่า วิชาในปีนั้น สามารถใช้กับปีปลายทางได้หรือไม่ ได้หรือไม่
        $array_Admission_year = array();
        for ($i = 0; $i < 4; $i++) {
            array_push($array_Admission_year, intval($des_year) - $i);
        }

        $Data_programs_course = Kku30ProgramsCourse::find()
            ->all();
        $array_program_course = array(); //เก็บหลักสูตรของแต่ละปีในปีการศึกษา ปลายทาง
        $array_course = array();
        $array_subject_plan = array();
        $array_subject_course = array();
        for ($i = 0; $i < sizeof($array_Admission_year); $i++) {
            foreach ($Data_programs_course as $row1) {
                if ($row1['admission_year'] == $array_Admission_year[$i]) {
                    $check = 0;
                    foreach ($array_course as $row) {
                        if ($row == $row1['course_id']) {
                            $check++;
                        }
                    }
                    if ($check == 0) {
                        array_push($array_course, $row1['course_id']);
                        $Data_subject_plan = Kku30SubjectCoursePlan::find()
                            ->where([
                                'plan_semester' => $source_semester,
                                'course_id' => $row1['course_id']
                            ])
                            ->all();
                        foreach ($Data_subject_plan as $row) {
                            array_push($array_subject_plan, $row);

                        }
                        $Data_subject_course = Kku30SubjectCoruse::find()
                            ->where([
                                'course_id' => $row1['course_id']
                            ])
                            ->all();
                        foreach ($Data_subject_course as $row) {
                            array_push($array_subject_course, $row);
                        }
                    }
                    switch ($row1['program_id']) {
                        case "CS":
                            $array_program_course[$i]["CS"] = $row1['course_id'];
                            break;
                        case "IT":
                            $array_program_course[$i]["IT"] = $row1['course_id'];
                            break;
                        case "GIS":
                            $array_program_course[$i]["GIS"] = $row1['course_id'];
                            break;
                        default:
                            break;
                    }
                }
            }
        }

        $Data_set_subject_open = ArrayHelper::toArray($Data_Subject_open, ['app\modules\kku30\models\Kku30SubjectOpen' => [  // set array ให้ออกมาในการดึงครังเดียว
            'subject_id',
            'subject_version',
            'subopen_semester',
            'subopen_year',
            'subject_detail' => function ($data) {
                return $data->subject;
            },
            'subject_open_program' => function ($data) {
                return $data->kku30SubjectOpenPrograms;
            },
        ]]);

        $Data_subject_open_real = array();
        foreach ($Data_set_subject_open as $row) { // loop วิชาที่เปิดสอนทั้งหมด
            $count_check = 0;
            $check = 0;
            foreach ($row['subject_open_program'] as $row1) {
                if (intval($row1['program_class']) == 1) {
                    switch ($row1['program_id']) {
                        case "CS":
                            if (!empty($array_program_course[$row1['student_year'] - 1]['CS'])) {
                                $course_id = $array_program_course[$row1['student_year'] - 1]['CS'];
                                $check1 = 0;
                                foreach ($array_subject_plan as $row2) {
                                    if ($row2['course_id'] == $course_id && $row2['subject_id'] == $row1['subject_id'] && $row2['subject_version'] == $row1['subject_version']) {
                                        $check++;
                                        $check1++;
                                    }
                                }
                                if ($check1 == 0) {
                                    foreach ($array_subject_course as $row2) {
                                        if ($row2['course_id'] == $course_id && $row2['subject_id'] == $row1['subject_id'] && $row2['subject_version'] == $row1['subject_version']) {
                                            $check++;
                                        }
                                    }
                                }
                            }
                            break;
                        case "IT":
                            if (!empty($array_program_course[$row1['student_year'] - 1]['IT'])) {
                                $course_id = $array_program_course[$row1['student_year'] - 1]['IT'];
                                $check1 = 0;
                                foreach ($array_subject_plan as $row2) {
                                    if ($row2['course_id'] == $course_id && $row2['subject_id'] == $row1['subject_id'] && $row2['subject_version'] == $row1['subject_version']) {
                                        $check++;
                                        $check1++;
                                    }
                                }
                                if ($check1 == 0) {
                                    foreach ($array_subject_course as $row2) {
                                        if ($row2['course_id'] == $course_id && $row2['subject_id'] == $row1['subject_id'] && $row2['subject_version'] == $row1['subject_version']) {
                                            $check++;
                                        }
                                    }
                                }
                            }
                            break;
                        case "GIS":
                            if (!empty($array_program_course[$row1['student_year'] - 1]['GIS'])) {
                                $course_id = $array_program_course[$row1['student_year'] - 1]['GIS'];
                                $check1 = 0;
                                foreach ($array_subject_plan as $row2) {
                                    if ($row2['course_id'] == $course_id && $row2['subject_id'] == $row1['subject_id'] && $row2['subject_version'] == $row1['subject_version']) {
                                        $check++;
                                        $check1++;
                                    }
                                }
                                if ($check1 == 0) {
                                    foreach ($array_subject_course as $row2) {
                                        if ($row2['course_id'] == $course_id && $row2['subject_id'] == $row1['subject_id'] && $row2['subject_version'] == $row1['subject_version']) {
                                            $check++;
                                        }
                                    }
                                }
                            }
                            break;
                    }
                    $count_check++;
                }
            }
            if ($check == $count_check) {
                array_push($Data_subject_open_real, $row);
            }
        }
        //ต้อง check ก่อนว่า วิชาในปีนั้น สามารถใช้กับปีปลายทางได้หรือไม่
        $array_help_set = ArrayHelper::toArray($Data_subject_open_real, ['app\modules\kku30\models\Kku30SubjectOpen' => [  // set array ให้ออกมาในการดึงครังเดียว
            'subject_id',
            'subject_version',
            'subopen_semester',
            'subopen_year',
            'subject_detail' => function ($data) {
                return $data->subject;
            },
        ]]);

        $Data_subject_open_des = Kku30SubjectOpen::find()
            ->where([
                'subopen_year' => $des_year,
                'subopen_semester' => $des_semester
            ])
            ->all();
        $Data_section_des = Kku30Section::find()
            ->where([
                'subopen_year' => $des_year,
                'subopen_semester' => $des_semester
            ])
            ->all();

        $Data_array_Copy_section = array();
        foreach ($Data_subject_open_des as $row) {
            foreach ($Data_Subject_open as $row1) {
                if ($row['subject_id'] == $row1['subject_id'] && $row['subject_version'] == $row1['subject_version']) {
                    array_push($Data_array_Copy_section, $row);
                }
            }
        }

        $array_help_set2 = ArrayHelper::toArray($Data_array_Copy_section, ['app\modules\kku30\models\Kku30SubjectOpen' => [  // set array ให้ออกมาในการดึงครังเดียว
            'subject_id',
            'subject_version',
            'subopen_semester',
            'subopen_year',
            'subject_detail' => function ($data) {
                return $data->subject;
            },
        ]]);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'year' => $source_year,
            'semester' => $source_semester,
            'datasubjectopen' => $array_help_set,
            'datausecopycondition' => $array_help_set2,
            'datasubopendesyear' => $Data_subject_open_des,
            'datasectiondes' => $Data_section_des
        ];

    }

    public function actionAjaxInsertCopySubjectopen()
    {
        $Data_insert = Yii::$app->request->post('Data_insert');
        $source_year = Yii::$app->request->post('source_year');
        $source_semester = Yii::$app->request->post('source_semester');
        $des_year = Yii::$app->request->post('des_year');
        $des_semester = Yii::$app->request->post('des_semester');

        $Data_subject_open_programs = Kku30SubjectOpenProgram::find()
            ->where([
                'subopen_year' => intval($source_year),
                'subopen_semester' => intval($source_semester)
            ])
            ->all();

        $Data_subject_open_des = Kku30SubjectOpen::find()
            ->where([
                'subopen_year' => intval($des_year),
                'subopen_semester' => intval($des_semester)
            ])
            ->all();

        $success_return = 0;
        foreach ($Data_insert as $row) {
            $explode_str = explode(",", $row);
            $check_repeat = 0;
            foreach ($Data_subject_open_des as $row1) {
                if ($row1['subject_id'] == $explode_str[0] && $row1['subject_version'] == intval($explode_str[1])) {
                    $check_repeat++;
                }
            }
            if ($check_repeat == 0) {
                $model = new Kku30SubjectOpen();
                $model['subject_id'] = $explode_str[0];
                $model['subject_version'] = intval($explode_str[1]);
                $model['subopen_semester'] = $des_semester;
                $model['subopen_year'] = $des_year;
                $model->save();
                foreach ($Data_subject_open_programs as $row1) {
                    if ($row1['subject_id'] == $explode_str[0] && $row1['subject_version'] == intval($explode_str[1])) {
                        $model_subject_open_programs = new Kku30SubjectOpenProgram();
                        $model_subject_open_programs['subject_id'] = $row1['subject_id'];
                        $model_subject_open_programs['subject_version'] = $row1['subject_version'];
                        $model_subject_open_programs['subopen_semester'] = intval($des_semester);
                        $model_subject_open_programs['subopen_year'] = intval($des_year);
                        $model_subject_open_programs['program_id'] = $row1['program_id'];
                        $model_subject_open_programs['program_class'] = $row1['program_class'];
                        $model_subject_open_programs['student_year'] = $row1['student_year'];
                        $model_subject_open_programs->save();
                    }
                }
            } else {
                $success_return++;
            }
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'sucess' => $success_return,
        ];
    }

    public function actionAjaxInsertCopySection()
    {
        $Data_insert = Yii::$app->request->post('Data_insert');
        $source_year = Yii::$app->request->post('source_year');
        $source_semester = Yii::$app->request->post('source_semester');
        $des_year = Yii::$app->request->post('des_year');
        $des_semester = Yii::$app->request->post('des_semester');

        $Data_section_des = Kku30Section::find()
            ->where([
                'subopen_year' => $des_year,
                'subopen_semester' => $des_semester
            ])
            ->all();

        $Data_section_source = Kku30Section::find()
            ->where([
                'subopen_year' => $source_year,
                'subopen_semester' => $source_semester
            ])
            ->all();
        $Data_section_programs_source = Kku30SectionProgram::find()
            ->where([
                'subopen_year' => $source_year,
                'subopen_semester' => $source_semester
            ])
            ->all();
        $Data_section_teacher_source = Kku30SectionTeacher::find()
            ->where([
                'subopen_year' => $source_year,
                'subopen_semester' => $source_semester
            ])
            ->all();

        $Data_group_section_source = Kku30GroupSection::find()
            ->where([
                'subopen_year' => $source_year,
                'subopen_semester' => $source_semester
            ])
            ->all();

        foreach ($Data_insert as $row) {
            $explode_value = explode(",", $row);
            $check_repeat = 0;
            $check_sucess = 0;
            foreach ($Data_section_des as $row1) {
                if ($explode_value[0] == $row1['subject_id'] && intval($explode_value[1]) == $row1['subject_version']) {
                    $check_repeat++;
                }
            }
            if ($check_repeat == 0) {
                //insert Section
                foreach ($Data_section_source as $row1) {
                    if ($explode_value[0] == $row1['subject_id'] && intval($explode_value[1]) == $row1['subject_version']) {
                        $model_section = new Kku30Section();
                        $model_section['section_no'] = $row1['section_no'];
                        $model_section['subject_id'] = $row1['subject_id'];
                        $model_section['subject_version'] = intval($row1['subject_version']);
                        $model_section['subopen_semester'] = intval($des_semester);
                        $model_section['subopen_year'] = intval($des_year);
                        $model_section['section_size'] = $row1['section_size'];
                        $model_section['section_join_lec'] = $row1['section_join_lec'];
                        $model_section['section_join_lab'] = $row1['section_join_lab'];
                        $model_section['section_count_lec'] = $row1['section_count_lec'];
                        $model_section['section_count_lab'] = $row1['section_count_lab'];
                        $model_section['section_condition_lab'] = $row1['section_condition_lab'];
                        $model_section->save();
                    }
                }
                //insert Section
                //insert SectionPrograms
                foreach ($Data_section_programs_source as $row1) {
                    if ($explode_value[0] == $row1['subject_id'] && intval($explode_value[1]) == $row1['subject_version']) {
                        $model_section_programs = new Kku30SectionProgram();
                        $model_section_programs['section_no'] = $row1['section_no'];
                        $model_section_programs['subject_id'] = $row1['subject_id'];
                        $model_section_programs['subject_version'] = $row1['subject_version'];
                        $model_section_programs['subopen_semester'] = intval($des_semester);
                        $model_section_programs['subopen_year'] = intval($des_year);
                        $model_section_programs['program_id'] = $row1['program_id'];
                        $model_section_programs['program_class'] = $row1['program_class'];
                        $model_section_programs['student_year'] = $row1['student_year'];
                        $model_section_programs->save();
                    }
                }
                //insert SectionPrograms
                //insert SectionTeacher
                foreach ($Data_section_teacher_source as $row1) {
                    if ($explode_value[0] == $row1['subject_id'] && intval($explode_value[1]) == $row1['subject_version']) {
                        $model_section_teacher = new Kku30SectionTeacher();
                        $model_section_teacher['section_no'] = $row1['section_no'];
                        $model_section_teacher['subject_id'] = $row1['subject_id'];
                        $model_section_teacher['subject_version'] = $row1['subject_version'];
                        $model_section_teacher['subopen_semester'] = intval($des_semester);
                        $model_section_teacher['subopen_year'] = intval($des_year);
                        $model_section_teacher['teacher_no'] = $row1['teacher_no'];
                        $model_section_teacher->save();
                    }
                }
                //insert SectionTeacher
                //Insert Group_Section
                foreach ($Data_group_section_source as $row1) {
                    if ($explode_value[0] == $row1['subject_id'] && intval($explode_value[1]) == $row1['subject_version']) {
                        $str_length = $row['group_no'];
                        $new_group_no_copy = substr($row['group_no'], 0, $str_length - 5);
                        $new_group_no_copy = $new_group_no_copy . $des_semester . $des_year;
                        $check_group = Kku30Group::find()
                            ->where([
                                'group_no' => $new_group_no_copy
                            ])
                            ->count();
                        if ($check_group == 0) { //กรณียังไม่มีข้อมูลใน Kku30Group
                            $data_group = Kku30Group::find()
                                ->where([
                                    'group_no' => $row['group_no']
                                ])
                                ->all();
                            foreach ($data_group as $row2) {
                                $model_group = new Kku30Group();
                                $model_group['group_no'] = $new_group_no_copy;
                                $model_group['group_amount'] = $row2['group_amount'];
                                $model_group['group_type'] = $row2['group_type'];
                                $model_group['group_priority'] = $row2['group_priority'];
                                $model_group['group_length'] = $row2['group_length'];
                                $model_group['group_room_condition'] = $row2['group_room_condition'];
                                $model_group->save();
                            }
                        }
                        $model_group_section = new Kku30GroupSection();
                        $model_group_section['group_no'] = $new_group_no_copy;
                        $model_group_section['section_no'] = $row1['section_no'];
                        $model_group_section['subject_id'] = $row1['subject_id'];
                        $model_group_section['subject_version'] = $row1['subject_version'];
                        $model_group_section['subopen_semester'] = intval($des_semester);
                        $model_group_section['subopen_year'] = intval($des_year);
                        $model_group_section->save();
                        $check_timeslot = Kku30GroupTimeslotRoom::find()
                            ->where([
                                'group_no' => $new_group_no_copy
                            ])
                            ->all();
                        if (sizeof($check_timeslot) == 0) {
                            $check_timeslot = Kku30GroupTimeslotRoom::find()
                                ->where([
                                    'group_no' => $row1['group_no']
                                ])
                                ->all();
                            foreach ($check_timeslot as $row2) {
                                $model_group_timeslot_room = new Kku30GroupTimeslotRoom();
                                $model_group_timeslot_room['group_no'] = $new_group_no_copy;
                                $model_group_timeslot_room['timeslot_id'] = $row2['timeslot_id'];
                                $model_group_timeslot_room['timeslot_lenght'] = $row2['timeslot_lenght'];
                                $model_group_timeslot_room['room_id'] = $row2['room_id'];
                                $model_group_timeslot_room['time_insert'] = $row2['time_insert'];
                                $model_group_timeslot_room->save();
                            }
                        }
                    }
                }
                //Insert Group_Section
            } else {
                $check_sucess++;
            }
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'sucess' => $check_sucess,
        ];

    }

}
