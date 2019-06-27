<?php

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\Listport;
use app\modules\scholar_b\models\Listproject;
use app\modules\scholar_b\models\model_main\EofficeCentralViewPisEnroll;
use app\modules\scholar_b\models\model_main\EofficeCentralViewPisEnrollScb;
use app\modules\scholar_b\models\model_main\EofficeCentralViewPisPerson;
use app\modules\scholar_b\models\model_main\EofficeCentralViewPisUser;
use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;
use app\modules\scholar_b\models\model_main\ListProjFull;
use app\modules\scholar_b\models\ScbCommentProject;
use app\modules\scholar_b\models\ScbCondition;
use app\modules\scholar_b\models\ScbConditionHasStudent;
use app\modules\scholar_b\models\ScbPortfolio;
use app\modules\scholar_b\models\ScbProgress;
use app\modules\scholar_b\models\ScbProgressComment;
use app\modules\scholar_b\models\ScbSemester;
use app\modules\scholar_b\models\ScbStudent;
use app\modules\scholar_b\models\ScbStudentHasActivityMain;
use app\modules\scholar_b\models\ScbStudentHasProject;
use app\modules\scholar_b\models\ScbTeacherHasProject;
use app\modules\scholar_b\models\ScbTeacherHasType;
use app\modules\scholar_b\models\ScbYear;
use app\modules\scholar_b\models\ScbYearHasSemester;
use app\modules\scholar_b\models\ScbStudentHasTeacher;
use app\modules\scholar_b\models\StudentHasTeacherSearch;
use app\modules\scholar_b\models\ScbScholarshipType;
use dosamigos\qrcode\lib\Encode;
use Yii;
use app\modules\scholar_b\models\ScbProgressReport;
use app\modules\scholar_b\models\ScbProgressReportSearch;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProgressController implements the CRUD actions for ScbProgressReport model.
 */
class ProgressController extends Controller
{
    const ACT_PAGE_SIZE = 10;

    /**
     * @inheritdoc
     */
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

    /**
     * Lists all ScbProgressReport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScbProgressReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single ScbProgressReport model.
     * @param integer $progress_seq
     * @param string $student_id
     * @param integer $project_year
     * @param integer $project_semester
     * @param integer $project_code
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTest()
    {

        return $this->render('progress');
    }

    public function actionSelect()
    {
        $seq = Yii::$app->request->post('seq');
        $sem = Yii::$app->request->post('sem');
        $year_select = Yii::$app->request->post('year');
        $student_id = Yii::$app->user->identity->username;

        $semester = ScbSemester::find()->all();
        $year = ScbYear::find()->all();

        if (Yii::$app->request->post()) {


            return $this->redirect(['std-index',
                'seq' => $seq,
                'sem' => $sem,
                'year_select' => $year_select,
                'student_id' => $student_id,
            ]);
        }

        return $this->render('select', [
            'semester' => $semester,
            'year' => $year,


        ]);
    }

    public function actionStdIndex()
    {
        $seq = Yii::$app->request->get('seq');
        $sem = Yii::$app->request->get('sem');
        $year_select = Yii::$app->request->get('year_select');
        $student_id = Yii::$app->user->identity->username;
        if ($sem == 1) {
            $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $year_select, 'semester' => '1'])->all();
        } else if ($sem > 1) {
            $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $year_select])->all();
        }

        $student_central = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $student_id])->one();

        $student_user = EofficeCentralViewPisUser::find()->where(['user_id' => $student_id])->one();
        $portfolio = ScbPortfolio::find()->where(['crby' => $student_user->id, 'year' => $year_select, 'port_status' => '1'])->all();
        $progress_model = new ScbProgress();
        $progress_find = ScbProgress::find()->where(['progress_seq' => $seq, 'student_id' => $student_id, 'year' => $year_select, 'semester' => $sem])->one();

        $student_activity = ScbStudentHasActivityMain::find()->where(['student_id' => $student_id, 'year' => $year_select, 'select_activity_status' => 1])->all();

        $student = ScbStudent::find()->where(['student_id' => $student_id])->one();

        $condition_std = ScbConditionHasStudent::find()->where(['student_id' => $student_id,
            'scholarship_id' => $student->scholarship_id, 'scholarship_year' => $student->scholarship_year])->all();

        $view_port3 = Listport::find()->where(['student_id' => $student_id, 'port_status' => '1', 'port_type_id' => '22'])
            ->orWhere(['student_id' => $student_id, 'port_status' => '1', 'port_type_id' => '12'])->all();
        $port3_count = 0;
        foreach ($view_port3 as $item3) {
            $port3_count++;
        }
        $view_port4 = Listport::find()->where(['student_id' => $student_id, 'port_status' => '1'])->all();
        $port4_count = 0;
        foreach ($view_port4 as $item4) {
            $port4_count++;
        }


        $find_gpa1 = EofficeCentralViewPisEnrollScb::find()->where(['STUDENTCODE' => $student_id, 'ACADYEAR' => $year_select, 'SEMESTER' => '1'])->all();
        $sumCREDITATTEMPT1 = 0;
        $sumGRADE1 = 0;
        foreach ($find_gpa1 as $item1) {
            if ($item1->GRADE != "") {
                $sumCREDITATTEMPT1 = $sumCREDITATTEMPT1 + $item1->CREDITATTEMPT;
            }
            if ($item1->GRADE == "A") {
                $sumGRADE1 = $sumGRADE1 + (4 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "B+") {
                $sumGRADE1 = $sumGRADE1 + (3.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "B") {
                $sumGRADE1 = $sumGRADE1 + (3 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "C+") {
                $sumGRADE1 = $sumGRADE1 + (2.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "C") {
                $sumGRADE1 = $sumGRADE1 + (2 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "D+") {
                $sumGRADE1 = $sumGRADE1 + (1.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "D") {
                $sumGRADE1 = $sumGRADE1 + (1 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "F") {
                $sumGRADE1 = $sumGRADE1 + (0 * $item1->CREDITATTEMPT);
            } else {
                $sumGRADE1 = $sumGRADE1 + 0;
            }
        }
        if ($sumGRADE1 == 0 && $sumCREDITATTEMPT1 == 0) {
            $gpa1 = 0;
        } else {
            $gpa1 = number_format($sumGRADE1 / $sumCREDITATTEMPT1, 2);
        }


        // exit;
        //  return Json::encode($find_gpa);
        $find_gpa2 = EofficeCentralViewPisEnrollScb::find()->where(['STUDENTCODE' => $student_id, 'ACADYEAR' => $year_select, 'SEMESTER' => '2'])->all();
        $sumCREDITATTEMPT2 = 0;
        $sumGRADE2 = 0;
        foreach ($find_gpa2 as $item2) {
            if ($item2->GRADE != "") {
                $sumCREDITATTEMPT2 = $sumCREDITATTEMPT2 + $item2->CREDITATTEMPT;
            }
            if ($item2->GRADE == "A") {
                $sumGRADE2 = $sumGRADE2 + (4 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "B+") {
                $sumGRADE2 = $sumGRADE2 + (3.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "B") {
                $sumGRADE2 = $sumGRADE2 + (3 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "C+") {
                $sumGRADE2 = $sumGRADE2 + (2.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "C") {
                $sumGRADE2 = $sumGRADE2 + (2 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "D+") {
                $sumGRADE2 = $sumGRADE2 + (1.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "D") {
                $sumGRADE2 = $sumGRADE2 + (1 * $item2->CREDITATTEMPT);
            } else {
                $sumGRADE2 = $sumGRADE2 + (0 * $item2->CREDITATTEMPT);
            }
        }
        if ($sumGRADE2 == 0 && $sumCREDITATTEMPT2 == 0) {
            $gpa2 = 0;
        } else {
            $gpa2 = number_format($sumGRADE2 / $sumCREDITATTEMPT2, 2);
        }


        if ($progress_model->load(Yii::$app->request->post())) {
            $progress_model->progress_seq = $seq;
            $progress_model->student_id = $student_id;
            $progress_model->year = $year_select;
            $progress_model->semester = $sem;


            try {
                $progress_model->progress_file = UploadedFile::getInstance($progress_model, 'progress_file');
                $progress_model->progress_file = $progress_model->uploadFile();
                $progress_model->save();

                Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'success',
                    'duration' => 12000,
                    'icon' => 'fa fa-users',
                    'title' => Yii::t('app', Html::encode('Submission')),
                    'message' => Yii::t('app', Html::encode('อัพโหลดเรียบร้อย')),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['std-index',
                    'seq' => $seq,
                    'sem' => $sem,
                    'year_select' => $year_select,
                    'student_id' => $student_id,
                ]);

            } catch (Exception $e) {
            }
        }


        return $this->render('std-index', [
            'seq' => $seq,
            'sem' => $sem,
            'year_select' => $year_select,
            'student_id' => $student_id,
            'project_student' => $project_student,
            'student_central' => $student_central,
            'portfolio' => $portfolio,
            'student_activity' => $student_activity,
            'progress_model' => $progress_model,
            'progress_find' => $progress_find,
            'condition_std' => $condition_std,
            'gpa1' => $gpa1,
            'gpa2' => $gpa2,
            'port3_count' => $port3_count,
            'port4_count' => $port4_count,

        ]);
    }

    public function actionResult()
    {
        $seq = Yii::$app->request->get('seq');
        $student_id = Yii::$app->user->identity->username;
        $project_year = Yii::$app->request->get('proj_year');
        $project_semester = Yii::$app->request->get('proj_sem');
        $project_code = Yii::$app->request->get('proj_code');
        $year_select = Yii::$app->request->get('year_select');
        $semester_select = Yii::$app->request->get('sem_select');
        $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $project_year, 'semester' => $project_semester, 'project_code' => $project_code])->one();


        $model_progress = new ScbProgressReport();

        if ($model_progress->load(Yii::$app->request->post())) {
            $model_progress->progress_seq = $seq;
            $model_progress->student_id = $student_id;
            $model_progress->project_year = $project_year;
            $model_progress->project_semester = $project_semester;
            $model_progress->project_code = $project_code;
            $model_progress->year = $year_select;
            $model_progress->semester = $semester_select;
            $model_progress->save();
        }


        return $this->render('result', [
            'model_progress' => $model_progress,
            'project_student' => $project_student,
            'progress_seq' => $seq,
            'student_id' => $student_id,
            'project_year' => $project_year,
            'project_semester' => $project_semester,
            'semester_select' => $semester_select,
            'year_select' => $year_select,
            'seq' => $seq

        ]);


    }

    public function actionResultUpdate()
    {
        $seq = Yii::$app->request->get('seq');
        $student_id = Yii::$app->user->identity->username;
        $project_year = Yii::$app->request->get('proj_year');
        $project_semester = Yii::$app->request->get('proj_sem');
        $project_code = Yii::$app->request->get('proj_code');
        $year_select = Yii::$app->request->get('year_select');
        $semester_select = Yii::$app->request->get('sem_select');
        $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $project_year, 'semester' => $project_semester, 'project_code' => $project_code])->one();


        $model_progress = ScbProgressReport::find()->where(['progress_seq' => $seq, 'student_id' => $student_id,
            'project_year' => $project_year, 'project_semester' => $project_semester, 'project_code' => $project_code
        ])->one();

        if ($model_progress->load(Yii::$app->request->post())) {
            $model_progress->progress_seq = $seq;
            $model_progress->student_id = $student_id;
            $model_progress->project_year = $project_year;
            $model_progress->project_semester = $project_semester;
            $model_progress->project_code = $project_code;
            $model_progress->year = $year_select;
            $model_progress->semester = $semester_select;
            $model_progress->save();
            return $this->redirect(['std-index', 'seq' => $seq, 'sem' => $semester_select, 'year_select' => $year_select]);
        }


        return $this->render('result', [
            'model_progress' => $model_progress,
            'project_student' => $project_student,
            'progress_seq' => $seq,
            'semester_select' => $semester_select,
            'year_select' => $year_select,

        ]);

    }

    public function actionStdViewAdvp()
    {
        $seq = Yii::$app->request->get('seq');
        $student_id = Yii::$app->user->identity->username;
        $project_year = Yii::$app->request->get('proj_year');
        $project_semester = Yii::$app->request->get('proj_sem');
        $project_code = Yii::$app->request->get('proj_code');
        $year_select = Yii::$app->request->get('year_select');
        $semester_select = Yii::$app->request->get('sem_select');

        $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $project_year, 'semester' => $project_semester, 'project_code' => $project_code])->one();
        $teacher_project = ScbTeacherHasProject::find()->where(['project_code' => $project_code])->one();
        $central_person = EofficeCentralViewPisPerson::find()->where(['person_card_id' => $teacher_project->teacher_id_card])->one();


        $model_comment = ScbCommentProject::find()->where(['progress_seq' => $seq, 'student_id' => $student_id,
            'project_year' => $project_year, 'project_semester' => $project_semester, 'project_code' => $project_code,
            'teacher_id_card' => $teacher_project->teacher_id_card, 'teacher_project_code' => $teacher_project->project_code,
            'adviser_status' => $teacher_project->adviser_status])->one();

        return $this->render('std-view-advp', [
            'model_comment' => $model_comment,
            'central_person' => $central_person,
            'progress_seq' => $seq,
            'year_select' => $year_select,
            'semester_select' => $semester_select,
            'project_student' => $project_student,

        ]);
    }


    public function actionAdvpSelect()
    {
        $semester = ScbSemester::find()->all();
        $year = ScbYear::find()->all();

        if (Yii::$app->request->post()) {

        }

        return $this->render('advp-select', [
            'semester' => $semester,
            'year' => $year,
        ]);
    }

    public function actionAdvpList()
    {
        $seq = Yii::$app->request->get('seq');
        $sem = Yii::$app->request->get('sem');
        $year_select = Yii::$app->request->get('year');

        $this->layout = "main_module";

        $personId = EofficeCentralViewPisUser::findOne(\Yii::$app->user->identity->getId())->username;

        $model = ScbScholarshipType::find()->all();

        $teacher = Yii::$app->get('db_scb')
            ->createCommand('SELECT
	DISTINCT scb_student_has_project.student_id
FROM
	scb_teacher_has_project
INNER JOIN scb_student_has_project ON scb_teacher_has_project.project_code = scb_student_has_project.project_code
WHERE
	scb_teacher_has_project.teacher_id_card = "' . $personId . '"')
            ->queryAll();


        return $this->render('advp-list', [

            'model' => $model,
            'seq' => $seq,
            'sem' => $sem,
            'year_select' => $year_select,
            'teacher' => $teacher

        ]);
    }


    public function actionAdvpIndex()
    {
        $seq = Yii::$app->request->get('seq');
        $sem = Yii::$app->request->get('sem');
        $year_select = Yii::$app->request->get('year_select');
        $student_id = Yii::$app->request->get('student_id');


        $personId = EofficeCentralViewPisUser::findOne(\Yii::$app->user->identity->getId())->username;
        if ($sem == 1) {
            $teacher_std_project = ListProjFull::find()->where(['teacher_id_card' => Yii::$app->user->identity->username,
                'student_id' => $student_id, 'year' => $year_select, 'semester' => '1', 'pro_status' => '1'])->all();
        } else if ($sem > 1) {
            $teacher_std_project = ListProjFull::find()->where(['teacher_id_card' => Yii::$app->user->identity->username,
                'student_id' => $student_id, 'year' => $year_select, 'pro_status' => '1'])->all();
        }


        $student_central = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $student_id])->one();

        $student_user = EofficeCentralViewPisUser::find()->where(['user_id' => $student_id])->one();
        $portfolio = ScbPortfolio::find()->where(['crby' => $student_user->id, 'year' => $year_select, 'port_status' => '1'])->all();

        $progress_find = ScbProgress::find()->where(['progress_seq' => $seq, 'student_id' => $student_id, 'year' => $year_select, 'semester' => $sem])->one();
        $student_activity = ScbStudentHasActivityMain::find()->where(['student_id' => $student_id, 'year' => $year_select, 'select_activity_status' => 1])->all();

        $student = ScbStudent::find()->where(['student_id' => $student_id])->one();
        $condition_std = ScbConditionHasStudent::find()->where(['student_id' => $student_id,
            'scholarship_id' => $student->scholarship_id, 'scholarship_year' => $student->scholarship_year])->all();

        $view_port3 = Listport::find()->where(['student_id' => $student_id, 'port_status' => '1', 'port_type_id' => '22'])
            ->orWhere(['student_id' => $student_id, 'port_status' => '1', 'port_type_id' => '12'])->all();
        $port3_count = 0;
        foreach ($view_port3 as $item3) {
            $port3_count++;
        }
        $view_port4 = Listport::find()->where(['student_id' => $student_id, 'port_status' => '1'])->all();
        $port4_count = 0;
        foreach ($view_port4 as $item4) {
            $port4_count++;
        }


        $find_gpa1 = EofficeCentralViewPisEnrollScb::find()->where(['STUDENTCODE' => $student_id, 'ACADYEAR' => $year_select, 'SEMESTER' => '1'])->all();
        $sumCREDITATTEMPT1 = 0;
        $sumGRADE1 = 0;
        foreach ($find_gpa1 as $item1) {
            if ($item1->GRADE != "") {
                $sumCREDITATTEMPT1 = $sumCREDITATTEMPT1 + $item1->CREDITATTEMPT;
            }
            if ($item1->GRADE == "A") {
                $sumGRADE1 = $sumGRADE1 + (4 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "B+") {
                $sumGRADE1 = $sumGRADE1 + (3.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "B") {
                $sumGRADE1 = $sumGRADE1 + (3 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "C+") {
                $sumGRADE1 = $sumGRADE1 + (2.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "C") {
                $sumGRADE1 = $sumGRADE1 + (2 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "D+") {
                $sumGRADE1 = $sumGRADE1 + (1.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "D") {
                $sumGRADE1 = $sumGRADE1 + (1 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "F") {
                $sumGRADE1 = $sumGRADE1 + (0 * $item1->CREDITATTEMPT);
            } else {
                $sumGRADE1 = $sumGRADE1 + 0;
            }
        }
        if ($sumGRADE1 == 0 && $sumCREDITATTEMPT1 == 0) {
            $gpa1 = 0;
        } else {
            $gpa1 = number_format($sumGRADE1 / $sumCREDITATTEMPT1, 2);
        }


        // exit;
        //  return Json::encode($find_gpa);
        $find_gpa2 = EofficeCentralViewPisEnrollScb::find()->where(['STUDENTCODE' => $student_id, 'ACADYEAR' => $year_select, 'SEMESTER' => '2'])->all();
        $sumCREDITATTEMPT2 = 0;
        $sumGRADE2 = 0;
        foreach ($find_gpa2 as $item2) {
            if ($item2->GRADE != "") {
                $sumCREDITATTEMPT2 = $sumCREDITATTEMPT2 + $item2->CREDITATTEMPT;
            }
            if ($item2->GRADE == "A") {
                $sumGRADE2 = $sumGRADE2 + (4 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "B+") {
                $sumGRADE2 = $sumGRADE2 + (3.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "B") {
                $sumGRADE2 = $sumGRADE2 + (3 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "C+") {
                $sumGRADE2 = $sumGRADE2 + (2.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "C") {
                $sumGRADE2 = $sumGRADE2 + (2 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "D+") {
                $sumGRADE2 = $sumGRADE2 + (1.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "D") {
                $sumGRADE2 = $sumGRADE2 + (1 * $item2->CREDITATTEMPT);
            } else {
                $sumGRADE2 = $sumGRADE2 + (0 * $item2->CREDITATTEMPT);
            }
        }
        if ($sumGRADE2 == 0 && $sumCREDITATTEMPT2 == 0) {
            $gpa2 = 0;
        } else {
            $gpa2 = number_format($sumGRADE2 / $sumCREDITATTEMPT2, 2);
        }


        return $this->render('advp-index', [
            'seq' => $seq,
            'sem' => $sem,
            'year_select' => $year_select,
            'student_id' => $student_id,
            'student_central' => $student_central,
            'portfolio' => $portfolio,
            'student_activity' => $student_activity,
            'progress_find' => $progress_find,
            'teacher_std_project' => $teacher_std_project,
            'condition_std' => $condition_std,
            'gpa1' => $gpa1,
            'gpa2' => $gpa2,
            'port3_count' => $port3_count,
            'port4_count' => $port4_count,

        ]);
    }

    public function actionAdvpView()
    {
        $seq = Yii::$app->request->get('seq');
        $student_id = Yii::$app->request->get('student_id');
        $project_year = Yii::$app->request->get('proj_year');
        $project_semester = Yii::$app->request->get('proj_sem');
        $project_code = Yii::$app->request->get('proj_code');
        $year_select = Yii::$app->request->get('year_select');
        $semester_select = Yii::$app->request->get('sem_select');
        $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $project_year, 'semester' => $project_semester, 'project_code' => $project_code])->one();


        $model_progress = ScbProgressReport::find()->where(['progress_seq' => $seq, 'student_id' => $student_id,
            'project_year' => $project_year, 'project_semester' => $project_semester, 'project_code' => $project_code
        ])->one();


        return $this->render('advp-view', [
            'model_progress' => $model_progress,
            'project_student' => $project_student,
            'progress_seq' => $seq,
            'semester_select' => $semester_select,
            'year_select' => $year_select,
            'student_id' => $student_id

        ]);
    }

    public function actionAdvpComment()
    {
        $seq = Yii::$app->request->get('seq');
        $student_id = Yii::$app->request->get('student_id');
        $project_year = Yii::$app->request->get('proj_year');
        $project_semester = Yii::$app->request->get('proj_sem');
        $project_code = Yii::$app->request->get('proj_code');
        $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $project_year, 'semester' => $project_semester, 'project_code' => $project_code])->one();
        $teacher_id = Yii::$app->user->identity->username;
        $year_select = Yii::$app->request->get('year_select');
        $semester_select = Yii::$app->request->get('sem_select');
        $teacher_project = ScbTeacherHasProject::find()->where(['teacher_id_card' => $teacher_id, 'project_code' => $project_code])->one();
        $model_comment = new ScbCommentProject();
        $central_person = EofficeCentralViewPisPerson::find()->where(['person_card_id' => $teacher_id])->one();

        $model_comment = ScbCommentProject::find()->where(['progress_seq' => $seq, 'student_id' => $student_id,
            'project_year' => $project_year, 'project_semester' => $project_semester, 'project_code' => $project_code,
            'teacher_id_card' => $teacher_project->teacher_id_card, 'teacher_project_code' => $teacher_project->project_code,
            'adviser_status' => $teacher_project->adviser_status])->one();
        if ($model_comment == null) {
            $model_comment = new ScbCommentProject();
        }

        if ($model_comment->load(Yii::$app->request->post())) {
            $model_comment->progress_seq = $seq;
            $model_comment->student_id = $student_id;
            $model_comment->project_year = $project_year;
            $model_comment->project_semester = $project_semester;
            $model_comment->project_code = $project_code;
            $model_comment->teacher_id_card = $teacher_project->teacher_id_card;
            $model_comment->teacher_project_code = $teacher_project->project_code;
            $model_comment->adviser_status = $teacher_project->adviser_status;

            $model_comment->save();

            return $this->redirect(['advp-index',
                'seq' => $seq,
                'sem' => $semester_select,
                'year_select' => $year_select,
                'student_id' => $student_id,
            ]);
        }


        return $this->render('advp-comment', [
            'project_student' => $project_student,
            'progress_seq' => $seq,
            'student_id' => $student_id,
            'project_year' => $project_year,
            'project_semester' => $project_semester,
            'model_comment' => $model_comment,
            'semester_select' => $semester_select,
            'year_select' => $year_select,
            'central_person' => $central_person,

        ]);

    }

    public function actionCmtSelect()
    {

        $semester = ScbSemester::find()->all();
        $year = ScbYear::find()->all();

        if (Yii::$app->request->post()) {

        }

        return $this->render('cmt-select', [
            'semester' => $semester,
            'year' => $year,
        ]);

    }

    public function actionCmtList()
    {
        $seq = Yii::$app->request->get('seq');
        $sem = Yii::$app->request->get('sem');
        $year_select = Yii::$app->request->get('year');

        $this->layout = "main_module";

        $personId = EofficeCentralViewPisUser::findOne(\Yii::$app->user->identity->getId())->username;

        $model = ScbScholarshipType::find()->all();

        $student_progress = ScbProgress::find()->where(['progress_seq' => $seq, 'year' => $year_select, 'semester' => $sem])->orderBy(['udtime' => SORT_ASC])->all();
        //return Json::encode($student_progress);

        $student_all = ScbStudent::find()->where(['out_of_scb_status' => '0','status_edu'=>'1'])->orderBy(['scholarship_id' => SORT_DESC])->all();

        return $this->render('cmt-list', [

            'model' => $model,
            'seq' => $seq,
            'sem' => $sem,
            'year_select' => $year_select,
            'student_progress' => $student_progress,
            'student_all' => $student_all,

        ]);
    }

    public function actionCmtIndex()
    {
        $seq = Yii::$app->request->get('seq');
        $sem = Yii::$app->request->get('sem');
        $year_select = Yii::$app->request->get('year_select');
        $student_id = Yii::$app->request->get('student_id');


        $central_person = EofficeCentralViewPisPerson::find()->where(['person_card_id' => Yii::$app->user->identity->username])->one();

        if ($sem == 1) {
            $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $year_select, 'semester' => '1'])->all();
        } else if ($sem > 1) {
            $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $year_select])->all();
        }

        $student_central = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $student_id])->one();

        $student_user = EofficeCentralViewPisUser::find()->where(['user_id' => $student_id])->one();
        $portfolio = ScbPortfolio::find()->where(['crby' => $student_user->id, 'year' => $year_select, 'port_status' => '1'])->all();

        $progress_find = ScbProgress::find()->where(['progress_seq' => $seq, 'student_id' => $student_id, 'year' => $year_select, 'semester' => $sem])->one();
        $student_activity = ScbStudentHasActivityMain::find()->where(['student_id' => $student_id, 'year' => $year_select, 'select_activity_status' => 1])->all();

        $committee = ScbTeacherHasType::find()->where(['teacher_id_card' => Yii::$app->user->identity->username, 'teacher_type_id' => '4'])
            ->orWhere(['teacher_id_card' => Yii::$app->user->identity->username, 'teacher_type_id' => '5'])
            ->orWhere(['teacher_id_card' => Yii::$app->user->identity->username, 'teacher_type_id' => '6'])
            ->orWhere(['teacher_id_card' => Yii::$app->user->identity->username, 'teacher_type_id' => '7'])
            ->one();

        $student = ScbStudent::find()->where(['student_id' => $student_id])->one();
        $condition_std = ScbConditionHasStudent::find()->where(['student_id' => $student_id,
            'scholarship_id' => $student->scholarship_id, 'scholarship_year' => $student->scholarship_year])->all();

        $view_port3 = Listport::find()->where(['student_id' => $student_id, 'port_status' => '1', 'port_type_id' => '22'])
            ->orWhere(['student_id' => $student_id, 'port_status' => '1', 'port_type_id' => '12'])->all();
        $port3_count = 0;
        foreach ($view_port3 as $item3) {
            $port3_count++;
        }
        $view_port4 = Listport::find()->where(['student_id' => $student_id, 'port_status' => '1'])->all();
        $port4_count = 0;
        foreach ($view_port4 as $item4) {
            $port4_count++;
        }


        $find_gpa1 = EofficeCentralViewPisEnrollScb::find()->where(['STUDENTCODE' => $student_id, 'ACADYEAR' => $year_select, 'SEMESTER' => '1'])->all();
        $sumCREDITATTEMPT1 = 0;
        $sumGRADE1 = 0;
        foreach ($find_gpa1 as $item1) {
            if ($item1->GRADE != "") {
                $sumCREDITATTEMPT1 = $sumCREDITATTEMPT1 + $item1->CREDITATTEMPT;
            }
            if ($item1->GRADE == "A") {
                $sumGRADE1 = $sumGRADE1 + (4 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "B+") {
                $sumGRADE1 = $sumGRADE1 + (3.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "B") {
                $sumGRADE1 = $sumGRADE1 + (3 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "C+") {
                $sumGRADE1 = $sumGRADE1 + (2.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "C") {
                $sumGRADE1 = $sumGRADE1 + (2 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "D+") {
                $sumGRADE1 = $sumGRADE1 + (1.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "D") {
                $sumGRADE1 = $sumGRADE1 + (1 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "F") {
                $sumGRADE1 = $sumGRADE1 + (0 * $item1->CREDITATTEMPT);
            } else {
                $sumGRADE1 = $sumGRADE1 + 0;
            }
        }
        if ($sumGRADE1 == 0 && $sumCREDITATTEMPT1 == 0) {
            $gpa1 = 0;
        } else {
            $gpa1 = number_format($sumGRADE1 / $sumCREDITATTEMPT1, 2);
        }


        // exit;
        //  return Json::encode($find_gpa);
        $find_gpa2 = EofficeCentralViewPisEnrollScb::find()->where(['STUDENTCODE' => $student_id, 'ACADYEAR' => $year_select, 'SEMESTER' => '2'])->all();
        $sumCREDITATTEMPT2 = 0;
        $sumGRADE2 = 0;
        foreach ($find_gpa2 as $item2) {
            if ($item2->GRADE != "") {
                $sumCREDITATTEMPT2 = $sumCREDITATTEMPT2 + $item2->CREDITATTEMPT;
            }
            if ($item2->GRADE == "A") {
                $sumGRADE2 = $sumGRADE2 + (4 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "B+") {
                $sumGRADE2 = $sumGRADE2 + (3.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "B") {
                $sumGRADE2 = $sumGRADE2 + (3 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "C+") {
                $sumGRADE2 = $sumGRADE2 + (2.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "C") {
                $sumGRADE2 = $sumGRADE2 + (2 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "D+") {
                $sumGRADE2 = $sumGRADE2 + (1.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "D") {
                $sumGRADE2 = $sumGRADE2 + (1 * $item2->CREDITATTEMPT);
            } else {
                $sumGRADE2 = $sumGRADE2 + (0 * $item2->CREDITATTEMPT);
            }
        }
        if ($sumGRADE2 == 0 && $sumCREDITATTEMPT2 == 0) {
            $gpa2 = 0;
        } else {
            $gpa2 = number_format($sumGRADE2 / $sumCREDITATTEMPT2, 2);
        }

        $progress_comment = ScbProgressComment::find()->where(['progress_seq' => $seq, 'student_id' => $student_id,
            'progress_year' => $year_select, 'progress_semester' => $sem, 'teacher_id_card' => $committee->teacher_id_card,
            'teacher_type_id' => $committee->teacher_type_id])->one();
        if ($progress_comment == null) {
            $progress_comment = new ScbProgressComment();
        }
        if ($progress_comment->load(Yii::$app->request->get())) {
            $progress_comment->progress_seq = $seq;
            $progress_comment->student_id = $student_id;
            $progress_comment->progress_year = $year_select;
            $progress_comment->progress_semester = $sem;
            $progress_comment->teacher_id_card = $committee->teacher_id_card;
            $progress_comment->teacher_type_id = $committee->teacher_type_id;
            $progress_comment->save();

            return $this->redirect(['cmt-index',
                'seq' => $seq,
                'sem' => $sem,
                'year_select' => $year_select,
                'student_id' => $student_id,
            ]);
        }


        return $this->render('cmt-index', [
            'seq' => $seq,
            'sem' => $sem,
            'year_select' => $year_select,
            'student_id' => $student_id,
            'project_student' => $project_student,
            'student_central' => $student_central,
            'portfolio' => $portfolio,
            'student_activity' => $student_activity,
            'progress_find' => $progress_find,
            'progress_comment' => $progress_comment,
            'central_person' => $central_person,
            'condition_std' => $condition_std,
            'gpa1' => $gpa1,
            'gpa2' => $gpa2,
            'port3_count' => $port3_count,
            'port4_count' => $port4_count,
        ]);

    }


    public function actionCmtViewResult()
    {
        $seq = Yii::$app->request->get('seq');
        $student_id = Yii::$app->request->get('student_id');
        $project_year = Yii::$app->request->get('proj_year');
        $project_semester = Yii::$app->request->get('proj_sem');
        $project_code = Yii::$app->request->get('proj_code');
        $year_select = Yii::$app->request->get('year_select');
        $semester_select = Yii::$app->request->get('sem_select');
        $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $project_year, 'semester' => $project_semester, 'project_code' => $project_code])->one();


        $model_progress = ScbProgressReport::find()->where(['progress_seq' => $seq, 'student_id' => $student_id,
            'project_year' => $project_year, 'project_semester' => $project_semester, 'project_code' => $project_code
        ])->one();


        return $this->render('cmt-view-result', [
            'model_progress' => $model_progress,
            'project_student' => $project_student,
            'progress_seq' => $seq,
            'semester_select' => $semester_select,
            'year_select' => $year_select,

        ]);
    }

    public function actionCmtViewComment()
    {
        $seq = Yii::$app->request->get('seq');
        $student_id = Yii::$app->request->get('student_id');
        $project_year = Yii::$app->request->get('proj_year');
        $project_semester = Yii::$app->request->get('proj_sem');
        $project_code = Yii::$app->request->get('proj_code');
        $year_select = Yii::$app->request->get('year_select');
        $semester_select = Yii::$app->request->get('sem_select');

        $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $project_year, 'semester' => $project_semester, 'project_code' => $project_code])->one();
        $teacher_project = ScbTeacherHasProject::find()->where(['project_code' => $project_code])->one();
        $central_person = EofficeCentralViewPisPerson::find()->where(['person_card_id' => $teacher_project->teacher_id_card])->one();


        $model_comment = ScbCommentProject::find()->where(['progress_seq' => $seq, 'student_id' => $student_id,
            'project_year' => $project_year, 'project_semester' => $project_semester, 'project_code' => $project_code,
            'teacher_id_card' => $teacher_project->teacher_id_card, 'teacher_project_code' => $teacher_project->project_code,
            'adviser_status' => $teacher_project->adviser_status])->one();

        return $this->render('cmt-view-comment', [
            'model_comment' => $model_comment,
            'central_person' => $central_person,
            'progress_seq' => $seq,
            'year_select' => $year_select,
            'semester_select' => $semester_select,
            'project_student' => $project_student,
        ]);
    }

    public function actionStfSelect()
    {

        $semester = ScbSemester::find()->all();
        $year = ScbYear::find()->all();

        if (Yii::$app->request->post()) {

        }

        return $this->render('stf-select', [
            'semester' => $semester,
            'year' => $year,
        ]);

    }

    public function actionStfList()
    {
        $seq = Yii::$app->request->get('seq');
        $sem = Yii::$app->request->get('sem');
        $year_select = Yii::$app->request->get('year');

        $this->layout = "main_module";

        $model = ScbScholarshipType::find()->all();

        $student_progress = ScbProgress::find()->where(['progress_seq' => $seq, 'year' => $year_select, 'semester' => $sem])->orderBy(['udtime' => SORT_ASC])->all();
        //return Json::encode($student_progress);

        $student_all = ScbStudent::find()->where(['out_of_scb_status' => '0','status_edu'=>'1'])->orderBy(['scholarship_id' => SORT_DESC])->all();

        return $this->render('stf-list', [

            'model' => $model,
            'seq' => $seq,
            'sem' => $sem,
            'year_select' => $year_select,
            'student_progress' => $student_progress,
            'student_all' => $student_all,

        ]);
    }

    public function actionStfIndex()
    {
        $seq = Yii::$app->request->get('seq');
        $sem = Yii::$app->request->get('sem');
        $year_select = Yii::$app->request->get('year_select');
        $student_id = Yii::$app->request->get('student_id');

        if ($sem == 1) {
            $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $year_select, 'semester' => '1'])->all();
        } else if ($sem > 1) {
            $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $year_select])->all();
        }

        $student_central = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $student_id])->one();
        $student_user = EofficeCentralViewPisUser::find()->where(['user_id' => $student_id])->one();
        $portfolio = ScbPortfolio::find()->where(['crby' => $student_user->id, 'year' => $year_select, 'port_status' => '1'])->all();
        $progress_find = ScbProgress::find()->where(['progress_seq' => $seq, 'student_id' => $student_id, 'year' => $year_select, 'semester' => $sem])->one();
        $student_activity = ScbStudentHasActivityMain::find()->where(['student_id' => $student_id, 'year' => $year_select, 'select_activity_status' => 1])->all();

        $student = ScbStudent::find()->where(['student_id' => $student_id])->one();
        $condition_std = ScbConditionHasStudent::find()->where(['student_id' => $student_id,
            'scholarship_id' => $student->scholarship_id, 'scholarship_year' => $student->scholarship_year])->all();
        $progress_comment_all = ScbProgressComment::find()->where(['progress_seq' => $seq, 'student_id' => $student_id,
            'progress_year' => $year_select, 'progress_semester' => $sem])->orderBy(['result' => SORT_DESC])->all();
        $view_port3 = Listport::find()->where(['student_id' => $student_id, 'port_status' => '1', 'port_type_id' => '22'])
            ->orWhere(['student_id' => $student_id, 'port_status' => '1', 'port_type_id' => '12'])->all();
        $port3_count = 0;
        foreach ($view_port3 as $item3) {
            $port3_count++;
        }
        $view_port4 = Listport::find()->where(['student_id' => $student_id, 'port_status' => '1'])->all();
        $port4_count = 0;
        foreach ($view_port4 as $item4) {
            $port4_count++;
        }


        $find_gpa1 = EofficeCentralViewPisEnrollScb::find()->where(['STUDENTCODE' => $student_id, 'ACADYEAR' => $year_select, 'SEMESTER' => '1'])->all();
        $sumCREDITATTEMPT1 = 0;
        $sumGRADE1 = 0;
        foreach ($find_gpa1 as $item1) {
            if ($item1->GRADE != "") {
                $sumCREDITATTEMPT1 = $sumCREDITATTEMPT1 + $item1->CREDITATTEMPT;
            }
            if ($item1->GRADE == "A") {
                $sumGRADE1 = $sumGRADE1 + (4 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "B+") {
                $sumGRADE1 = $sumGRADE1 + (3.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "B") {
                $sumGRADE1 = $sumGRADE1 + (3 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "C+") {
                $sumGRADE1 = $sumGRADE1 + (2.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "C") {
                $sumGRADE1 = $sumGRADE1 + (2 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "D+") {
                $sumGRADE1 = $sumGRADE1 + (1.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "D") {
                $sumGRADE1 = $sumGRADE1 + (1 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "F") {
                $sumGRADE1 = $sumGRADE1 + (0 * $item1->CREDITATTEMPT);
            } else {
                $sumGRADE1 = $sumGRADE1 + 0;
            }
        }
        if ($sumGRADE1 == 0 && $sumCREDITATTEMPT1 == 0) {
            $gpa1 = 0;
        } else {
            $gpa1 = number_format($sumGRADE1 / $sumCREDITATTEMPT1, 2);
        }


        // exit;
        //  return Json::encode($find_gpa);
        $find_gpa2 = EofficeCentralViewPisEnrollScb::find()->where(['STUDENTCODE' => $student_id, 'ACADYEAR' => $year_select, 'SEMESTER' => '2'])->all();
        $sumCREDITATTEMPT2 = 0;
        $sumGRADE2 = 0;
        foreach ($find_gpa2 as $item2) {
            if ($item2->GRADE != "") {
                $sumCREDITATTEMPT2 = $sumCREDITATTEMPT2 + $item2->CREDITATTEMPT;
            }
            if ($item2->GRADE == "A") {
                $sumGRADE2 = $sumGRADE2 + (4 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "B+") {
                $sumGRADE2 = $sumGRADE2 + (3.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "B") {
                $sumGRADE2 = $sumGRADE2 + (3 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "C+") {
                $sumGRADE2 = $sumGRADE2 + (2.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "C") {
                $sumGRADE2 = $sumGRADE2 + (2 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "D+") {
                $sumGRADE2 = $sumGRADE2 + (1.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "D") {
                $sumGRADE2 = $sumGRADE2 + (1 * $item2->CREDITATTEMPT);
            } else {
                $sumGRADE2 = $sumGRADE2 + (0 * $item2->CREDITATTEMPT);
            }
        }
        if ($sumGRADE2 == 0 && $sumCREDITATTEMPT2 == 0) {
            $gpa2 = 0;
        } else {
            $gpa2 = number_format($sumGRADE2 / $sumCREDITATTEMPT2, 2);
        }


        return $this->render('stf-index', [
            'seq' => $seq,
            'sem' => $sem,
            'year_select' => $year_select,
            'student_id' => $student_id,
            'student_central' => $student_central,
            'portfolio' => $portfolio,
            'student_activity' => $student_activity,
            'progress_find' => $progress_find,
            'project_student' => $project_student,
            'condition_std' => $condition_std,
            'gpa1' => $gpa1,
            'gpa2' => $gpa2,
            'port3_count' => $port3_count,
            'port4_count' => $port4_count,
            'progress_comment_all' => $progress_comment_all,

        ]);
    }

    public function actionStfViewResult()
    {
        $seq = Yii::$app->request->get('seq');
        $student_id = Yii::$app->request->get('student_id');
        $project_year = Yii::$app->request->get('proj_year');
        $project_semester = Yii::$app->request->get('proj_sem');
        $project_code = Yii::$app->request->get('proj_code');
        $year_select = Yii::$app->request->get('year_select');
        $semester_select = Yii::$app->request->get('sem_select');
        $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $project_year, 'semester' => $project_semester, 'project_code' => $project_code])->one();


        $model_progress = ScbProgressReport::find()->where(['progress_seq' => $seq, 'student_id' => $student_id,
            'project_year' => $project_year, 'project_semester' => $project_semester, 'project_code' => $project_code
        ])->one();


        return $this->render('stf-view-result', [
            'model_progress' => $model_progress,
            'project_student' => $project_student,
            'progress_seq' => $seq,
            'semester_select' => $semester_select,
            'year_select' => $year_select,

        ]);
    }

    public function actionStfViewComment()
    {
        $seq = Yii::$app->request->get('seq');
        $student_id = Yii::$app->request->get('student_id');
        $project_year = Yii::$app->request->get('proj_year');
        $project_semester = Yii::$app->request->get('proj_sem');
        $project_code = Yii::$app->request->get('proj_code');
        $year_select = Yii::$app->request->get('year_select');
        $semester_select = Yii::$app->request->get('sem_select');

        $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $project_year, 'semester' => $project_semester, 'project_code' => $project_code])->one();
        $teacher_project = ScbTeacherHasProject::find()->where(['project_code' => $project_code])->one();
        $central_person = EofficeCentralViewPisPerson::find()->where(['person_card_id' => $teacher_project->teacher_id_card])->one();


        $model_comment = ScbCommentProject::find()->where(['progress_seq' => $seq, 'student_id' => $student_id,
            'project_year' => $project_year, 'project_semester' => $project_semester, 'project_code' => $project_code,
            'teacher_id_card' => $teacher_project->teacher_id_card, 'teacher_project_code' => $teacher_project->project_code,
            'adviser_status' => $teacher_project->adviser_status])->one();

        return $this->render('stf-view-comment', [
            'model_comment' => $model_comment,
            'central_person' => $central_person,
            'progress_seq' => $seq,
            'year_select' => $year_select,
            'semester_select' => $semester_select,
            'project_student' => $project_student,
        ]);
    }

    public function actionSumResult()
    {
        $seq = Yii::$app->request->get('seq');
        $sem = Yii::$app->request->get('sem');
        $year_select = Yii::$app->request->get('year_select');
        $student_id = Yii::$app->request->get('student_id');
        $set = Yii::$app->request->get('key');
        $progress_comment_all = ScbProgressComment::find()->where(['progress_seq' => $seq, 'student_id' => $student_id,
            'progress_year' => $year_select, 'progress_semester' => $sem])->orderBy(['result' => SORT_DESC])->all();

        $student = ScbStudent::find()->where(['student_id'=>$student_id])->one();
        $progress_find = ScbProgress::find()->where(['progress_seq' => $seq, 'student_id' => $student_id, 'year' => $year_select, 'semester' => $sem])->one();
        $student_central = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $student_id])->one();

        if ($progress_find->load(Yii::$app->request->post()) && $student->load(Yii::$app->request->post())) {
            $progress_find->save();
            $student->save();
            return $this->redirect(['stf-list',
                'seq' => $seq,
                'sem' => $sem,
                'year' => $year_select,]);
            }


        return $this->render('sum-result', [
            'seq' => $seq,
            'sem' => $sem,
            'year_select' => $year_select,
            'student_id' => $student_id,
            'progress_comment_all' => $progress_comment_all,
            'progress_find' => $progress_find,
            'student_central' => $student_central,
            'student' => $student,

        ]);

    }

    public function actionViewSumResult()
    {
        $seq = Yii::$app->request->get('seq');
        $sem = Yii::$app->request->get('sem');
        $year_select = Yii::$app->request->get('year_select');
        $student_id = Yii::$app->request->get('student_id');

        $student = ScbStudent::find()->where(['student_id'=>$student_id])->one();
        $progress_comment_all = ScbProgressComment::find()->where(['progress_seq' => $seq, 'student_id' => $student_id,
            'progress_year' => $year_select, 'progress_semester' => $sem])->orderBy(['result' => SORT_DESC])->all();

        $progress_find = ScbProgress::find()->where(['progress_seq' => $seq, 'student_id' => $student_id, 'year' => $year_select, 'semester' => $sem])->one();
        $student_central = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $student_id])->one();

        return $this->render('view-sum-result', [
            'seq' => $seq,
            'sem' => $sem,
            'year_select' => $year_select,
            'student_id' => $student_id,
            'progress_comment_all' => $progress_comment_all,
            'progress_find' => $progress_find,
            'student_central' => $student_central,
            'student' => $student,
        ]);

    }

    public function actionTcSelect()
    {

        $semester = ScbSemester::find()->all();
        $year = ScbYear::find()->all();

        if (Yii::$app->request->post()) {

        }

        return $this->render('tc-select', [
            'semester' => $semester,
            'year' => $year,
        ]);

    }

    public function actionTcList()
    {
        $seq = Yii::$app->request->get('seq');
        $sem = Yii::$app->request->get('sem');
        $year_select = Yii::$app->request->get('year');

        $this->layout = "main_module";

        $model = ScbScholarshipType::find()->all();

        $student_progress = ScbProgress::find()->where(['progress_seq' => $seq, 'year' => $year_select, 'semester' => $sem])->orderBy(['udtime' => SORT_ASC])->all();
        //return Json::encode($student_progress);

        $student_all = ScbStudent::find()->where(['out_of_scb_status' => '0','status_edu'=>'1'])->orderBy(['scholarship_id' => SORT_DESC])->all();

        return $this->render('tc-list', [

            'model' => $model,
            'seq' => $seq,
            'sem' => $sem,
            'year_select' => $year_select,
            'student_progress' => $student_progress,
            'student_all' => $student_all,

        ]);
    }
    public function actionTcIndex()
    {
        $seq = Yii::$app->request->get('seq');
        $sem = Yii::$app->request->get('sem');
        $year_select = Yii::$app->request->get('year_select');
        $student_id = Yii::$app->request->get('student_id');

        if ($sem == 1) {
            $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $year_select, 'semester' => '1'])->all();
        } else if ($sem > 1) {
            $project_student = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $year_select])->all();
        }

        $student_central = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $student_id])->one();
        $student_user = EofficeCentralViewPisUser::find()->where(['user_id' => $student_id])->one();
        $portfolio = ScbPortfolio::find()->where(['crby' => $student_user->id, 'year' => $year_select, 'port_status' => '1'])->all();
        $progress_find = ScbProgress::find()->where(['progress_seq' => $seq, 'student_id' => $student_id, 'year' => $year_select, 'semester' => $sem])->one();
        $student_activity = ScbStudentHasActivityMain::find()->where(['student_id' => $student_id, 'year' => $year_select, 'select_activity_status' => 1])->all();

        $student = ScbStudent::find()->where(['student_id' => $student_id])->one();
        $condition_std = ScbConditionHasStudent::find()->where(['student_id' => $student_id,
            'scholarship_id' => $student->scholarship_id, 'scholarship_year' => $student->scholarship_year])->all();
        $progress_comment_all = ScbProgressComment::find()->where(['progress_seq' => $seq, 'student_id' => $student_id,
            'progress_year' => $year_select, 'progress_semester' => $sem])->orderBy(['result' => SORT_DESC])->all();
        $view_port3 = Listport::find()->where(['student_id' => $student_id, 'port_status' => '1', 'port_type_id' => '22'])
            ->orWhere(['student_id' => $student_id, 'port_status' => '1', 'port_type_id' => '12'])->all();
        $port3_count = 0;
        foreach ($view_port3 as $item3) {
            $port3_count++;
        }
        $view_port4 = Listport::find()->where(['student_id' => $student_id, 'port_status' => '1'])->all();
        $port4_count = 0;
        foreach ($view_port4 as $item4) {
            $port4_count++;
        }


        $find_gpa1 = EofficeCentralViewPisEnrollScb::find()->where(['STUDENTCODE' => $student_id, 'ACADYEAR' => $year_select, 'SEMESTER' => '1'])->all();
        $sumCREDITATTEMPT1 = 0;
        $sumGRADE1 = 0;
        foreach ($find_gpa1 as $item1) {
            if ($item1->GRADE != "") {
                $sumCREDITATTEMPT1 = $sumCREDITATTEMPT1 + $item1->CREDITATTEMPT;
            }
            if ($item1->GRADE == "A") {
                $sumGRADE1 = $sumGRADE1 + (4 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "B+") {
                $sumGRADE1 = $sumGRADE1 + (3.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "B") {
                $sumGRADE1 = $sumGRADE1 + (3 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "C+") {
                $sumGRADE1 = $sumGRADE1 + (2.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "C") {
                $sumGRADE1 = $sumGRADE1 + (2 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "D+") {
                $sumGRADE1 = $sumGRADE1 + (1.5 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "D") {
                $sumGRADE1 = $sumGRADE1 + (1 * $item1->CREDITATTEMPT);
            } else if ($item1->GRADE == "F") {
                $sumGRADE1 = $sumGRADE1 + (0 * $item1->CREDITATTEMPT);
            } else {
                $sumGRADE1 = $sumGRADE1 + 0;
            }
        }
        if ($sumGRADE1 == 0 && $sumCREDITATTEMPT1 == 0) {
            $gpa1 = 0;
        } else {
            $gpa1 = number_format($sumGRADE1 / $sumCREDITATTEMPT1, 2);
        }


        // exit;
        //  return Json::encode($find_gpa);
        $find_gpa2 = EofficeCentralViewPisEnrollScb::find()->where(['STUDENTCODE' => $student_id, 'ACADYEAR' => $year_select, 'SEMESTER' => '2'])->all();
        $sumCREDITATTEMPT2 = 0;
        $sumGRADE2 = 0;
        foreach ($find_gpa2 as $item2) {
            if ($item2->GRADE != "") {
                $sumCREDITATTEMPT2 = $sumCREDITATTEMPT2 + $item2->CREDITATTEMPT;
            }
            if ($item2->GRADE == "A") {
                $sumGRADE2 = $sumGRADE2 + (4 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "B+") {
                $sumGRADE2 = $sumGRADE2 + (3.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "B") {
                $sumGRADE2 = $sumGRADE2 + (3 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "C+") {
                $sumGRADE2 = $sumGRADE2 + (2.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "C") {
                $sumGRADE2 = $sumGRADE2 + (2 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "D+") {
                $sumGRADE2 = $sumGRADE2 + (1.5 * $item2->CREDITATTEMPT);
            } else if ($item2->GRADE == "D") {
                $sumGRADE2 = $sumGRADE2 + (1 * $item2->CREDITATTEMPT);
            } else {
                $sumGRADE2 = $sumGRADE2 + (0 * $item2->CREDITATTEMPT);
            }
        }
        if ($sumGRADE2 == 0 && $sumCREDITATTEMPT2 == 0) {
            $gpa2 = 0;
        } else {
            $gpa2 = number_format($sumGRADE2 / $sumCREDITATTEMPT2, 2);
        }


        return $this->render('tc-index', [
            'seq' => $seq,
            'sem' => $sem,
            'year_select' => $year_select,
            'student_id' => $student_id,
            'student_central' => $student_central,
            'portfolio' => $portfolio,
            'student_activity' => $student_activity,
            'progress_find' => $progress_find,
            'project_student' => $project_student,
            'condition_std' => $condition_std,
            'gpa1' => $gpa1,
            'gpa2' => $gpa2,
            'port3_count' => $port3_count,
            'port4_count' => $port4_count,
            'progress_comment_all' => $progress_comment_all,

        ]);
    }

    public function actionView($progress_seq, $student_id, $project_year, $project_semester, $project_code)
    {
        return $this->render('view', [
            'model' => $this->findModel($progress_seq, $student_id, $project_year, $project_semester, $project_code),
        ]);
    }

    /**
     * Creates a new ScbProgressReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ScbProgressReport();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'progress_seq' => $model->progress_seq, 'student_id' => $model->student_id, 'project_year' => $model->project_year, 'project_semester' => $model->project_semester, 'project_code' => $model->project_code]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ScbProgressReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $progress_seq
     * @param string $student_id
     * @param integer $project_year
     * @param integer $project_semester
     * @param integer $project_code
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($progress_seq, $student_id, $project_year, $project_semester, $project_code)
    {
        $model = $this->findModel($progress_seq, $student_id, $project_year, $project_semester, $project_code);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'progress_seq' => $model->progress_seq, 'student_id' => $model->student_id, 'project_year' => $model->project_year, 'project_semester' => $model->project_semester, 'project_code' => $model->project_code]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ScbProgressReport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $progress_seq
     * @param string $student_id
     * @param integer $project_year
     * @param integer $project_semester
     * @param integer $project_code
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($progress_seq, $student_id, $project_year, $project_semester, $project_code)
    {
        $this->findModel($progress_seq, $student_id, $project_year, $project_semester, $project_code)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ScbProgressReport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $progress_seq
     * @param string $student_id
     * @param integer $project_year
     * @param integer $project_semester
     * @param integer $project_code
     * @return ScbProgressReport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($progress_seq, $student_id, $project_year, $project_semester, $project_code)
    {
        if (($model = ScbProgressReport::findOne(['progress_seq' => $progress_seq, 'student_id' => $student_id, 'project_year' => $project_year, 'project_semester' => $project_semester, 'project_code' => $project_code])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
