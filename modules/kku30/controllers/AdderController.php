<?php
/**
 * Created by PhpStorm.
 * User: minimooooz
 * Date: 12-Nov-17
 * Time: 17:04
 */

namespace app\modules\kku30\controllers;


use app\modules\kku30\models\Adder;
use app\modules\kku30\models\Kku30GroupSection;
use app\modules\kku30\models\Kku30ProgramsCourse;
use app\modules\kku30\models\Kku30Section;
use app\modules\kku30\models\Kku30SectionProgram;
use app\modules\kku30\models\Kku30SectionTeacher;
use app\modules\kku30\models\Kku30Subject;
use app\modules\kku30\models\Kku30SubjectCoruse;
use app\modules\kku30\models\Kku30SubjectCoursePlan;
use app\modules\kku30\models\Kku30SubjectOpen;
use app\modules\kku30\models\Kku30SubjectOpenProgram;
use Yii;
use yii\db\Exception;
use yii\helpers\Console;
use yii\helpers\Json;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class AdderController extends Controller
{
    public function actionShowsubject()
    {
        $model = new Adder();
        $Data_subject_term1 = array();
        $Data_subject_term2 = array();

        $Data_subject_elective_term1 = array();
        $Data_subject_elective_term2 = array();
        $subject_opened = "";
        $subject_opened_program = "";
        $this->layout = "main_module";
        return $this->render('showsubject', [
            'model' => $model,
            'Count_AllData' => 0,
            'Count_Term1' => 0,
            'Count_Term2' => 0,
            'Data_subject_term1' => $Data_subject_term1,
            'Data_subject_term2' => $Data_subject_term2,
            'sub_student' => "",
            'sub_stdyear' => null,
            'sub_year' => "",
            'course_id' => 0,

            'Count_AllData_Elective' => 0,
            'Count_Elective_Term1' => 0,
            'Count_Elective_Term2' => 0,
            'Data_subject_elective_term1' => $Data_subject_elective_term1,
            'Data_subject_elective_term2' => $Data_subject_elective_term2,
            'subject_opened' => $subject_opened,
            'subject_opened_program' => $subject_opened_program,
        ]);
    }

    public function actionAddsubject($course_id, $sub_stdyear, $plan_semester, $sub_student, $sub_year)
    {
        $this->layout = "main_module";
        return $this->render('addsubject', [
            'course_id' => $course_id,
            'sub_stdyear' => $sub_stdyear,
            'plan_semester' => $plan_semester,
            'sub_student' => $sub_student,
            'sub_year' => $sub_year
        ]);
    }

    public function actionAddsubjectelective($course_id, $sub_stdyear, $plan_semester, $sub_student, $sub_year)
    {
        $this->layout = "main_module";
        return $this->render('addsubjectelective', [
            'course_id' => $course_id,
            'sub_stdyear' => $sub_stdyear,
            'plan_semester' => $plan_semester,
            'sub_student' => $sub_student,
            'sub_year' => $sub_year
        ]);
    }

    public function actionInsertsubject()
    {
        $course_id = Yii::$app->request->post('course_id');
        $subject_id = Yii::$app->request->post('subject_id');
        $subject_version = Yii::$app->request->post('subject_version');
        $plan_studentyear = Yii::$app->request->post('plan_studentyear');
        $plan_semester = Yii::$app->request->post('plan_semester');
        $sub_student = Yii::$app->request->post('sub_student');
        $sub_year = Yii::$app->request->post('sub_year');

        $model_subject_course_plan = new Kku30SubjectCoursePlan();
        $model_subject_course_plan['course_id'] = $course_id;
        $model_subject_course_plan['subject_id'] = $subject_id;
        $model_subject_course_plan['subject_version'] = intval($subject_version);
        $model_subject_course_plan['plan_studentyear'] = intval($plan_studentyear);
        $model_subject_course_plan['plan_semester'] = intval($plan_semester);

        if ($model_subject_course_plan->save()) {
            echo '<script language="javascript">';
            echo 'alert("บันทึกเสร็จสิ้น")';
            echo '</script>';
            $this->redirect(array('searchsubjectsemester', 'sub_student' => $sub_student, 'sub_year' => $sub_year, 'sub_stdyear' => $plan_studentyear));
        } else {
            echo '<script language="javascript">';
            echo 'alert("วิชาและปีหลักสูตรไม่มีในระบบ")';
            echo '</script>';
            $this->layout = "main_module";
            return $this->render('addsubject', [
                'course_id' => $course_id,
                'sub_stdyear' => $plan_studentyear,
                'plan_semester' => $plan_semester,
                'sub_student' => $sub_student,
                'sub_year' => $sub_year,
            ]);
        }
    }

    public function actionInsertsubjectelective()
    {
        $course_id = Yii::$app->request->post('course_id');
        $subject_id = Yii::$app->request->post('subject_id');
        $subject_version = Yii::$app->request->post('subject_version');
        $plan_studentyear = Yii::$app->request->post('plan_studentyear');
        $plan_semester = Yii::$app->request->post('plan_semester');
        $sub_student = Yii::$app->request->post('sub_student');
        $sub_year = Yii::$app->request->post('sub_year');

        $check_insert = Kku30SubjectOpen::find()
            ->where([
                'subject_id' => $subject_id,
                'subject_version' => intval($subject_version),
                'subopen_semester' => intval($plan_semester),
                'subopen_year' => intval($sub_year)
            ])
            ->count();
        if ($check_insert == 0) { //ถ้ายังไม่มีการใส่วิชาที่เปิดสอน
            $model_subject_open = new Kku30SubjectOpen();
            $model_subject_open['subject_id'] = $subject_id;
            $model_subject_open['subject_version'] = intval($subject_version);
            $model_subject_open['subopen_semester'] = intval($plan_semester);
            $model_subject_open['subopen_year'] = $sub_year;
            if ($model_subject_open->save()) {
                for ($i = 1; $i <= 2; $i++) {
                    $model_subject_open_programs = new Kku30SubjectOpenProgram();
                    $model_subject_open_programs['subject_id'] = $subject_id;
                    $model_subject_open_programs['subject_version'] = intval($subject_version);
                    $model_subject_open_programs['subopen_semester'] = intval($plan_semester);
                    $model_subject_open_programs['subopen_year'] = intval($sub_year);
                    $model_subject_open_programs['program_id'] = $sub_student;
                    $model_subject_open_programs['program_class'] = $i;
                    $model_subject_open_programs['student_year'] = $plan_studentyear;
                    $model_subject_open_programs->save();
                }
                $this->redirect(array('searchsubjectsemester', 'sub_student' => $sub_student, 'sub_year' => $sub_year, 'sub_stdyear' => $plan_studentyear));
            } else {
                echo '<script language="javascript">';
                echo 'alert("วิชาและปีหลักสูตรไม่มีในระบบ")';
                echo '</script>';
                $this->layout = "main_module";
                return $this->render('addsubject', [
                    'course_id' => $course_id,
                    'sub_stdyear' => $plan_studentyear,
                    'plan_semester' => $plan_semester,
                    'sub_student' => $sub_student,
                    'sub_year' => $sub_year,
                ]);
            }
        } else { //มีการใส่วิชาที่เปิดสอนแล้ว
            for ($i = 1; $i <= 2; $i++) {
                $model_subject_open_programs = new Kku30SubjectOpenProgram();
                $model_subject_open_programs['subject_id'] = $subject_id;
                $model_subject_open_programs['subject_version'] = intval($subject_version);
                $model_subject_open_programs['subopen_semester'] = intval($plan_semester);
                $model_subject_open_programs['subopen_year'] = intval($sub_year);
                $model_subject_open_programs['program_id'] = $sub_student;
                $model_subject_open_programs['program_class'] = $i;
                $model_subject_open_programs['student_year'] = $plan_studentyear;
                $model_subject_open_programs->save();
            }
            $this->redirect(array('searchsubjectsemester', 'sub_student' => $sub_student, 'sub_year' => $sub_year, 'sub_stdyear' => $plan_studentyear));
        }
    }

    public function actionAddelectivesub($sub_student, $sub_stdyear, $plan_semester, $sub_year)
    {
        $model = new Kku30SubjectOpenProgram();
        $model->load(Yii::$app->request->post());
        $checksubhect = Kku30SubjectOpen::find()
            ->where([
                "subject_id" => $model->subject_id,
                "subject_versiion" => $model->subject_version,
            ])
            ->count();
        return $this->render('addelectivesub', [
            'model' => $model,
            'sub_student' => $sub_student,
            'sub_stdyear' => $sub_stdyear,
            'plan_semester' => $plan_semester,
            'sub_year' => $sub_year,

        ]);
    }

    public function actionInsertelective($sub_student, $sub_stdyear, $plan_semester, $sub_year)
    {
        $model = new Kku30SubjectOpenProgram();
        return $this->render('addelectivesub', [
            'model' => $model,
            'sub_student' => $sub_student,
            'sub_stdyear' => $sub_stdyear,
            'plan_semester' => $plan_semester,
            'sub_year' => $sub_year,

        ]);
    }

    public function actionDatainsertelective()
    {
        $modelss = new Kku30SubjectOpenProgram();
        $modelss->load(Yii::$app->request->post());
        $checksubhect = Kku30SubjectOpen::find()
            ->where([
                "subject_id" => $modelss->subject_id,
                "subject_version" => $modelss->subject_version,
                "subopen_semester" => $modelss->subopen_semester,
                "subopen_year" => $modelss->subopen_year
            ])
            ->count();
        if ($checksubhect == 1) {
            $modelss->program_class = 1;
            $modelss->save();
            $modeltest = new Kku30SubjectOpenProgram();
            $modeltest->load(Yii::$app->request->post());
            $modeltest->program_class = 2;
            $modeltest->save();
        } else {
            $subject_open = new Kku30SubjectOpen();
            $subject_open->subject_id = $modelss->subject_id;
            $subject_open->subject_version = $modelss->subject_version;
            $subject_open->subopen_semester = $modelss->subopen_semester;
            $subject_open->subopen_year = $modelss->subopen_year;
            $subject_open->save();
            $modelss->program_class = 1;
            $modelss->save();
            $modeltest = new Kku30SubjectOpenProgram();
            $modeltest->load(Yii::$app->request->post());
            $modeltest->program_class = 2;
            $modeltest->save();
        }

        $model = new Adder();
        $Data_subject_term1 = array();
        $Data_subject_term2 = array();
        $Data_subject_elective_term1 = array();
        $Data_subject_elective_term2 = array();
        $this->layout = "main_module";
        return $this->render('showsubject', [
            'model' => $model,
            'Count_AllData' => 0,
            'Count_Term1' => 0,
            'Count_Term2' => 0,
            'Data_subject_term1' => $Data_subject_term1,
            'Data_subject_term2' => $Data_subject_term2,
            'sub_student' => "",
            'sub_stdyear' => null,
            'sub_year' => "",
            'course_id' => 0,
            'Count_AllData_Elective' => 0,
            'Count_Elective_Term1' => 0,
            'Count_Elective_Term2' => 0,
            'Data_subject_elective_term1' => $Data_subject_elective_term1,
            'Data_subject_elective_term2' => $Data_subject_elective_term2,
        ]);

    }

    public function actionSearchsubjectsemester()
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
//        หา วิชาบังคับตามหลักสุตร
        $subject_coruse_plan = Kku30SubjectCoursePlan::find()
            ->joinWith(['course.kku30ProgramsCourses join'])
            ->where([
                'join.program_id' => $sub_student,
                'join.admission_year' => $findadmission,
                'plan_studentyear' => intval($sub_stdyear)
            ])->orderBy([
                'plan_semester' => SORT_ASC
            ])
            ->all();
//        หา วิชาบังคับตามหลักสุตร
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
        // query elective subject
        $variableStudentyear = intval($sub_stdyear);
        $subject_elective = Kku30SubjectOpenProgram::find()
            ->joinWith(['subopenSemester.subject.kku30SubjectCoruses join2'])
            ->joinWith(['subopenSemester join1'])
            ->where([
                "join1.subopen_year" => intval($sub_year),
                "join2.typegroup_id" => 6,
                "program_class" => 1,
                "program_id" => $sub_student
            ])
            ->andWhere('student_year LIKE :query')
            ->addParams([':query' => '%' . $variableStudentyear . '%'])
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

        $Count_subject_Term2 = sizeof($array_subject_plan) - $Count_subject_Term1;
        $model = new Adder();

        //GET SUBJECT OPENED
        $subject_opened = Kku30SubjectOpen::find()->all();
        //GET SUBJECT OPENED

        //GET SUBJECT OPENED PROGRAM
        $subject_opened_program = Kku30SubjectOpenProgram::find()->all();
        //GET SUBJECT OPENED PROGRAM
        $this->layout = "main_module";
        return $this->render('showsubject', [
            'model' => $model,
            'Count_AllData' => sizeof($array_subject_plan),
            'Count_Term1' => $Count_subject_Term1,
            'Count_Term2' => $Count_subject_Term2,
            'Data_subject_term1' => $Data_subject_term1,
            'Data_subject_term2' => $Data_subject_term2,
            'sub_student' => $sub_student,
            'sub_stdyear' => $sub_stdyear,
            'sub_year' => $sub_year,
            'course_id' => $course_id,
            'Count_AllData_Elective' => sizeof($array_subject_elective_plan),
            'Count_Elective_Term1' => $Count_subject_elective_term1,
            'Count_Elective_Term2' => $Count_subject_elective_term2,
            'Data_subject_elective_term1' => $Data_subject_elective_term1,
            'Data_subject_elective_term2' => $Data_subject_elective_term2,
            'subject_opened' => $subject_opened,
            'subject_opened_program' => $subject_opened_program
        ]);
    }

    public function actionFindallsubjectelective()
    {
        $getEsubData = Kku30SubjectCoruse::find()->where([
            'type_id' => 2,
            'typegroup_id' => 6
        ])->all();

        $array_subject_elective_plan = ArrayHelper::toArray($getEsubData, ['app\modules\kku30\models\Kku30SubjectCoruse' => [
            'course_id',
            'type_id',
            'typegroup_id',
            'subgroup_id',
            'subject' => function ($getEsubData) {
                return $getEsubData->subject;
            }
        ]]);


        //generate json file
        $dirjson = Yii::getAlias('../web/web_kku30/json/subjectelective_data.json');
        $fp = fopen($dirjson, 'w');
        fwrite($fp, json_encode($array_subject_elective_plan));
        fclose($fp);

        exit();
    }

    public function actionAddsubjectopen($course_id, $subject_id, $sub_stdyear, $plan_semester, $subject_version, $sub_year, $sub_student)
    {

        $model = new Kku30SubjectOpen();
        $model['subject_id'] = $subject_id;
        $model['subject_version'] = intval($subject_version);
        $model['subopen_semester'] = intval($plan_semester);
        $model['subopen_year'] = intval($sub_year);
        $model->save();

        for ($i = 1; $i <= 2; $i++) {
            $model = new Kku30SubjectOpenProgram();
            $model['subject_id'] = $subject_id;
            $model['subject_version'] = intval($subject_version);
            $model['subopen_semester'] = intval($plan_semester);
            $model['subopen_year'] = intval($sub_year);
            $model['program_id'] = $sub_student;
            $model['program_class'] = $i;
            $model['student_year'] = intval($sub_stdyear);
            $model->save();

        }
        $this->redirect(array('searchsubjectsemester', 'sub_student' => $sub_student, 'sub_year' => $sub_year, 'sub_stdyear' => $sub_stdyear));

    }

    public function actionClosesubject($course_id, $subject_id, $sub_stdyear, $plan_semester, $subject_version, $sub_year, $sub_student)
    {
        for ($i = 1; $i <= 2; $i++) {
            Kku30SubjectOpenProgram::deleteAll([
                'subject_id' => $subject_id,
                'subject_version' => intval($subject_version),
                'subopen_semester' => intval($plan_semester),
                'subopen_year' => intval($sub_year),
                'program_id' => $sub_student,
                'program_class' => $i,
                'student_year' => intval($sub_stdyear)
            ]);
        }
        $subject_opened_program = Kku30SubjectOpenProgram::find()
            ->where([
                'subject_id' => $subject_id,
                'subject_version' => $subject_version,
                'subopen_semester' => $plan_semester,
                'subopen_year' => $sub_year
            ])
            ->all();

        if (count($subject_opened_program) == 0) {
            //5
            Kku30SubjectOpen::deleteAll([
                'subject_id' => $subject_id,
                'subject_version' => intval($subject_version),
                'subopen_semester' => intval($plan_semester),
                'subopen_year' => intval($sub_year),
            ]);
        }
        //2
        for ($j = 1; $j <= 2; $j++) {
            Kku30SectionProgram::deleteAll([
                'subject_id' => $subject_id,
                'subject_version' => intval($subject_version),
                'subopen_semester' => intval($plan_semester),
                'subopen_year' => intval($sub_year),
                'program_id' => $sub_student,
                'program_class' => $j,
                'student_year' => intval($sub_stdyear)
            ]);
        }

        //3
        Kku30SectionTeacher::deleteAll([
            'subject_id' => $subject_id,
            'subject_version' => intval($subject_version),
            'subopen_semester' => intval($plan_semester),
            'subopen_year' => intval($sub_year),
        ]);

        Kku30GroupSection::deleteAll([
            'subject_id' => $subject_id,
            'subject_version' => intval($subject_version),
            'subopen_semester' => intval($plan_semester),
            'subopen_year' => intval($sub_year),
        ]);

        //1
        Kku30Section::deleteAll([
            'subject_id' => $subject_id,
            'subject_version' => intval($subject_version),
            'subopen_semester' => intval($plan_semester),
            'subopen_year' => intval($sub_year)
        ]);
        $this->redirect(array('searchsubjectsemester', 'sub_student' => $sub_student, 'sub_year' => $sub_year, 'sub_stdyear' => $sub_stdyear));
    }

    public function actionDeletesubjectopen($course_id, $subject_id, $plan_semester, $subject_version, $sub_student, $sub_year, $sub_stdyear)
    {
        //check ก่อนว่า สาขานั้นได้เรียนอยู่หรือไม่
        $data_check = Kku30SubjectOpenProgram::find()
            ->where([
                'subject_id' => $subject_id,
                'subject_version' => intval($subject_version),
                'student_year' => intval($sub_stdyear),
                'subopen_year' => intval($sub_year),
                'subopen_semester' => intval($plan_semester),
                'program_id' => $sub_student
            ])
            ->all();

        if (sizeof($data_check) == 0) { //ตัวเองเรียนอยู่หรือไม่ ถ้าไม่ให้ลบแผนได้
            Kku30SubjectCoursePlan::deleteAll([
                'course_id' => $course_id,
                'subject_id' => $subject_id,
                'subject_version' => intval($subject_version),
                'plan_studentyear' => intval($sub_stdyear),
                'plan_semester' => intval($plan_semester),
            ]);
            $data_check_2 = Kku30SubjectOpenProgram::find()
                ->where([
                    'subject_id' => $subject_id,
                    'subject_version' => intval($subject_version),
                    'student_year' => intval($sub_stdyear),
                    'subopen_year' => intval($sub_year),
                    'subopen_semester' => intval($plan_semester),
                ])
                ->all();
            if (sizeof($data_check_2) == 0) { // ถ้าไม่มีใครเรียนเลย ให้ลบ วิชาที่เปิดอยู่ด้วย
                Kku30SubjectOpen::deleteAll([
                    'subject_id' => $subject_id,
                    'subject_version' => intval($subject_version),
                    'subopen_year' => intval($sub_year),
                    'subopen_semester' => intval($plan_semester)
                ]);
            }
        } else { //ถ้าตัวเองเรียนอยู่
            for ($i = 1; $i <= 2; $i++) {
                Kku30SubjectOpenProgram::deleteAll([
                    'subject_id' => $subject_id,
                    'subject_version' => intval($subject_version),
                    'subopen_semester' => intval($plan_semester),
                    'subopen_year' => intval($sub_year),
                    'program_id' => $sub_student,
                    'program_class' => $i,
                    'student_year' => intval($sub_stdyear),

                ]);
            }
            Kku30SubjectCoursePlan::deleteAll([
                'course_id' => $course_id,
                'subject_id' => $subject_id,
                'subject_version' => intval($subject_version),
                'plan_studentyear' => intval($sub_stdyear),
                'plan_semester' => intval($plan_semester),
            ]);
            $data_check_2 = Kku30SubjectOpenProgram::find()
                ->where([
                    'subject_id' => $subject_id,
                    'subject_version' => intval($subject_version),
                    'subopen_year' => intval($sub_year),
                    'subopen_semester' => intval($plan_semester),
                ])
                ->all();
            if (sizeof($data_check_2) == 0) { // ถ้าไม่มีใครเรียนเลย ให้ลบ วิชาที่เปิดอยู่ด้วย
                Kku30SubjectOpen::deleteAll([
                    'subject_id' => $subject_id,
                    'subject_version' => intval($subject_version),
                    'subopen_year' => intval($sub_year),
                    'subopen_semester' => intval($plan_semester),
                ]);
            }
        }
        $this->redirect(array('searchsubjectsemester', 'sub_student' => $sub_student, 'sub_year' => $sub_year, 'sub_stdyear' => $sub_stdyear));
    }

    public function actionDeleteelectivesub($sub_student, $course_id, $subject_id, $sub_stdyear, $plan_semester, $subject_version, $sub_year)
    {
        Kku30SubjectOpenProgram::deleteAll([
            'subject_id' => $subject_id,
            'subject_version' => $subject_version,
            'subopen_semester' => $plan_semester,
            'subopen_year' => $sub_year,
            'program_id' => $sub_student,
            'student_year' => $sub_stdyear,
        ]);
        $this->redirect(array('searchsubjectsemester', 'sub_student' => $sub_student, 'sub_year' => $sub_year, 'sub_stdyear' => $sub_stdyear));

    }

    public function actionRendertest()
    {
        return $this->render('_formsubjectelective');
    }

    public function actionDelete($id)
    {
        Adder::findOne($id)->delete();
        return $this->redirect(['addsubject']);
    }

    public function actionUpdatesubject($id)
    {
        $model = Adder::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['addsubject', 'id' => $model->sub_id]);
        } else {
            return $this->render('updatesubject', [
                'model' => $model,
            ]);
        }
    }

    public function actionDetailsubject($id)
    {
        $model = Kku30Subject::findOne($id);
        $sub_id = $model->subject_id;
        $sub_version = $model->subject_version;
        $sub_namethai = $model->subject_namethai;
        $sub_nameeng = $model->subject_nameeng;
        $sub_credit = $model->subject_credit;
        $sub_time = $model->subject_time;
        $sub_desc = $model->subject_description;
        return $this->render('detailsubject', [
            'model' => $model,
            'sub_id' => $sub_id,
            'sub_version' => $sub_version,
            'sub_namethai' => $sub_namethai,
            'sub_nameeng' => $sub_nameeng,
            'sub_credit' => $sub_credit,
            'sub_time' => $sub_time,
            'sub_desc' => $sub_desc,
        ]);


    }

    public function actionAddcondition()
    {
        $model = new Adder();

        $sub_student = Yii::$app->request->get('sub_student');
        $sub_year = Yii::$app->request->get('sub_year');
        $sub_stdyear = Yii::$app->request->get('sub_stdyear');
        $sub_project = Yii::$app->request->get('sub_project');
//        $searchData = ['sub_student'=>$sub_student,
//            'sub_year'=>$sub_year,
//            'sub_stdyear'=>$sub_stdyear,
//            'sub_project'=>$sub_project,
//            ];

        if (Yii::$app->request->get('sub_student') == null) {
            $sub_student = '';
        }

        if (Yii::$app->request->get('sub_year') == null) {
            $sub_year = '';
        }

        if (Yii::$app->request->get('sub_stdyear') == null) {
            $sub_stdyear = '';
        }

        if (Yii::$app->request->get('sub_project') == null) {
            $sub_project = '';
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['addcondition', 'id' => $model->sub_id]);
        } else {

            $data_term1 = Adder::find()->where(['sub_term' => "ภาคการเรียนที่ 1"])->andWhere(['LIKE', 'sub_student', $sub_student])->andWhere(['LIKE', 'sub_year', $sub_year])->andWhere(['LIKE', 'sub_stdyear', $sub_stdyear])->andWhere(['LIKE', 'sub_project', $sub_project])->all();
            $data_term2 = Adder::find()->where(['sub_term' => "ภาคการเรียนที่ 2"])->andWhere(['LIKE', 'sub_student', $sub_student])->andWhere(['LIKE', 'sub_year', $sub_year])->andWhere(['LIKE', 'sub_stdyear', $sub_stdyear])->andWhere(['LIKE', 'sub_project', $sub_project])->all();
            $N = count($data_term2);
            if (count($data_term1) > count($data_term2)) {
                $N = count($data_term1);
            }

            return $this->render('addcondition', [
                'model' => $model,
                'data_term1' => $data_term1,
                'data_term2' => $data_term2,
                'N' => $N,
                'sub_student' => $sub_student,
                'sub_year' => $sub_year,
                'sub_stdyear' => $sub_stdyear,
                'sub_project' => $sub_project,

            ]);
        }
    }

}