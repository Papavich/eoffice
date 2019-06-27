<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 5/3/2561
 * Time: 16:00
 */

namespace app\modules\eproject\controllers;

use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use app\modules\eproject\models\Advise;
use app\modules\eproject\models\ElasticProject;
use app\modules\eproject\models\ElasticTheory;
use app\modules\eproject\models\ElasticTool;
use app\modules\eproject\models\Enroll;
use app\modules\eproject\models\ExamCommittee;
use app\modules\eproject\models\ExamGroup;
use app\modules\eproject\models\Major;
use app\modules\eproject\models\OpenSubject;
use app\modules\eproject\models\Project;
use app\modules\eproject\models\RequestAdvisee;
use app\modules\eproject\models\Semester;
use app\modules\eproject\models\StudentProject;
use app\modules\eproject\models\Subject;
use app\modules\eproject\models\SubjectView;
use app\modules\eproject\models\Year;
use app\modules\eproject\models\YearSemester;
use app\modules\pms\models\Model;
use Mpdf\Tag\Sub;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class AdminDashboardController extends Controller
{
    public function actionIndex()
    {
        if (\Yii::$app->request->isPost) {
            ini_set( 'max_execution_time', 500 );
            $year = \Yii::$app->request->post( 'year' );
            $semester = \Yii::$app->request->post( 'semester' );

            if (!Year::findOne( $year )) {
                $yearObj = new Year();
                $yearObj->id = $year;
                $yearObj->save();
            }
            if (!Semester::findOne( $semester )) {
                $semesterObj = new Semester();
                $semesterObj->id = $semester;
                $semesterObj->save();
            }
            $yearSemester = new YearSemester();
            $yearSemester->year_id = $year;
            $yearSemester->semester_id = $semester;
            if ($yearSemester->save()) {
                ModelHelper::clearYearSemester();
                foreach (Major::find()->all() as $major) {
                    $adviser = \Yii::$app->request->post( 'adviser-' . $major->id, 10 );
                    RequestAdvisee::generateRequestAdvisee( $adviser, $major->id );
                }
                $this->transferProject();

                Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
            } else {
                Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );

            }
        }
        $yearSemesters = YearSemester::find()
            ->orderBy( ['year_id' => SORT_DESC, 'semester_id' => SORT_DESC] )
            ->all();
        $yearTmp = $yearSemesters[1]->year_id;
        $semesterTmp = $yearSemesters[1]->semester_id;
        $openSubject = SubjectView::find()->innerJoin( OpenSubject::tableName(), SubjectView::tableName() . '.id = ' . OpenSubject::tableName() . '.subject_id' )
            ->innerJoin( Subject::tableName(), Subject::tableName() . '.id = ' . OpenSubject::tableName() . '.subject_id' )
            ->where( ['year_id' => $yearTmp] )
            ->andWhere( ['semester_id' => $semesterTmp] )
            ->orderBy( 'subject_id' )
            ->all();
        return $this->render( 'index', [
            'subjects' => $openSubject
        ] );
    }

    public function actionTransferExamGroup()
    {

        ini_set( 'max_execution_time', 500 );
        $yearSemesters = YearSemester::find()
            ->orderBy( ['year_id' => SORT_DESC, 'semester_id' => SORT_DESC] )
            ->all();
        $yearSemester = $yearSemesters[0];
        $yearTmp = $yearSemesters[1]->year_id;
        $semesterTmp = $yearSemesters[1]->semester_id;
        if ($to = Yii::$app->request->post( 'to' )) {
            $openSubject = SubjectView::find()->innerJoin( OpenSubject::tableName(), SubjectView::tableName() . '.id = ' . OpenSubject::tableName() . '.subject_id' )
                ->innerJoin( Subject::tableName(), Subject::tableName() . '.id = ' . OpenSubject::tableName() . '.subject_id' )
                ->where( ['year_id' => $yearTmp] )
                ->andWhere( ['semester_id' => $semesterTmp] )
                ->orderBy( 'subject_id' )
                ->all();
            foreach ($openSubject as $key => $oldSubject) {
                if ($to[$key] != "0") {
                    $examGroups = ExamGroup::find()
                        ->where( ['year_id' => $yearSemester->year_id] )
                        ->andWhere( ['semester_id' => $yearSemester->semester_id] )
                        ->andWhere( ['subject_id' => $to[$key]] )
                        ->all();
                    foreach ($examGroups as $examGroup) {
                        $examGroup->delete();
                    }
                    $examGroups = ExamGroup::find()
                        ->where( ['year_id' => $yearTmp] )
                        ->andWhere( ['semester_id' => $semesterTmp] )
                        ->andWhere( ['subject_id' => $oldSubject->id] )
                        ->all();
                    foreach ($examGroups as $examGroup) {
                        $examGroupTmp = new ExamGroup();
                        $examGroupTmp->year_id = $yearSemester->year_id;
                        $examGroupTmp->semester_id = $yearSemester->semester_id;
                        $examGroupTmp->subject_id = $to[$key];
                        $examGroupTmp->name = $examGroup->name;
                        $examGroupTmp->room = $examGroup->room;
                        if ($examGroupTmp->save()) {
                            foreach ($examGroup->examCommittees as $examCommittee) {
                                $examCommitteeTmp = new ExamCommittee();
                                $examCommitteeTmp->year_id = $examGroupTmp->year_id;
                                $examCommitteeTmp->semester_id = $examGroupTmp->semester_id;
                                $examCommitteeTmp->semester_id = $examGroupTmp->semester_id;
                                $examCommitteeTmp->subject_id = $examGroupTmp->subject_id;
                                $examCommitteeTmp->subject_id = $examGroupTmp->subject_id;
                                $examCommitteeTmp->exam_group_id = $examGroupTmp->id;
                                $examCommitteeTmp->user_id = $examCommittee->user_id;
                                $examCommitteeTmp->save();
                            }
                        }

                    }
                }

            }
            Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
        }
        $this->redirect( ['index'] );
    }

    public function actionRegeneration()
    {
        ini_set( 'max_execution_time', 500 );
        $this->transferProject();
        Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
        return $this->redirect( ['admin-dashboard/index'] );
    }

    public function actionAjaxGetSubject()
    {
        $openSubject = Subject::getNowOpenSubjects();
        $data = ArrayHelper::toArray( $openSubject, [
            'app\modules\eproject\models\SubjectView' => [
                'id',
                'name',
            ],
        ] );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function actionAjaxReindexProject()
    {
        ElasticProject::deleteIndex();
        ElasticTheory::deleteIndex();
        ElasticTool::deleteIndex();
        ElasticProject::createIndex();
        ElasticTheory::createIndex();
        ElasticTool::createIndex();
        ElasticTheory::reIndex();
        ElasticTool::reIndex();
        ElasticProject::reIndex();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return true;
    }

    private function transferProject()
    {
        $semester = ModelHelper::getNowSemester();
        $year = ModelHelper::getNowYear();
        $openSubject = Subject::getNowOpenSubjects();
        foreach ($openSubject as $key => $item) {
            $openSubjectIds[$key] = $item->id;
        }
        $studentIds = Enroll::find()
            ->where( ['year_id' => $year] )
            ->andWhere( ['semester_id' => $semester] )
            ->andWhere( ['subject_id' => $openSubjectIds] )
            ->select( 'student_id' );
        $yearSemester = ModelHelper::getRecentlyYearSemester();
        $tmp = StudentProject::find()
            ->where( ['student_id' => $studentIds] )
            ->andWhere( ['year_id' => $year] )
            ->andWhere( ['semester_id' => $semester] )
            ->distinct()
            ->select( 'student_id' )
            ->all();
        $studentProjects = StudentProject::find()
            ->where( ['student_id' => $studentIds] )
            ->andWhere( ['year_id' => $yearSemester->year_id] )
            ->andWhere( ['semester_id' => $yearSemester->semester_id] )
            ->andWhere( ['not in', 'student_id', $tmp] )
            ->all();
        foreach ($studentProjects as $studentProject) {
            $tmp = new StudentProject();
            $tmp->year_id = $year;
            $tmp->semester_id = $semester;
            $tmp->student_id = $studentProject->student_id;
            $tmp->project_id = $studentProject->project_id;
            $tmp->subject_id = ModelHelper::getNowSubject( $studentProject->student_id );
            $tmp->save();
        }
        $projectIds = StudentProject::find()
            ->where( ['student_id' => $studentIds] )
            ->andWhere( ['year_id' => $yearSemester->year_id] )
            ->andWhere( ['semester_id' => $yearSemester->semester_id] )
            ->distinct()->select( 'project_id' );
        $tmp = Advise::find()
            ->where( ['project_id' => $projectIds] )
            ->andWhere( ['year_id' => $year] )
            ->andWhere( ['semester_id' => $semester] )
            ->distinct()->select( 'project_id' )
            ->all();
        $advises = Advise::find()
            ->where( ['project_id' => $projectIds] )
            ->andWhere( ['year_id' => $yearSemester->year_id] )
            ->andWhere( ['semester_id' => $yearSemester->semester_id] )
            ->andWhere( ['not in', 'project_id', $tmp] )
            ->all();
        foreach ($advises as $advise) {
            $tmp = new Advise();
            $tmp->adviser_id = $advise->adviser_id;
            $tmp->project_id = $advise->project_id;
            $tmp->adviser_type_id = $advise->adviser_type_id;
            $tmp->year_id = $year;
            $tmp->semester_id = $semester;
            $tmp->subject_id = ModelHelper::getNowSubject( $tmp->project->students[0]->id );
            $tmp->save();
        }
    }
}