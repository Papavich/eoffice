<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 6/7/2560
 * Time: 17:22
 */

namespace app\modules\eproject\controllers;


use app\modules\eproject\models\Advise;
use app\modules\eproject\models\AdviserType;
use app\modules\eproject\models\ExamCommittee;
use app\modules\eproject\models\OpenSubject;
use app\modules\eproject\models\Project;
use app\modules\eproject\models\StudentProject;
use app\modules\eproject\models\Subject;
use app\modules\eproject\models\SubjectView;
use app\modules\eproject\models\User;
use Mpdf\Tag\Sub;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class AdminProjectRunningController extends Controller
{
    public function actionIndex()
    {
        return $this->render( 'index' );
    }

    public function actionAjaxSearch()
    {
        $year = \Yii::$app->request->post( 'year' );
        $semester = \Yii::$app->request->post( 'semester' );
        $subject = \Yii::$app->request->post( 'subject' );
        $projectIds = StudentProject::find()
            ->where( ['year_id' => $year] )
            ->andWhere( ['semester_id' => $semester] )
            ->andWhere( ['subject_id' => $subject] )
            ->groupBy( 'project_id' )
            ->select( 'project_id' );
        $project = Project::find()
            ->where( ['id' => $projectIds] )
            ->andWhere( ['<>', 'name_th', ""] )
            ->orderBy( ['number' => SORT_ASC] )
            ->all();
        $data = false;
        if (count( $project ) != 0) {
            foreach ($project as $key => $item) {
                if ($item->number != null) {
                    $data[$key]['code'] = $item->major->code . $item->number;
                } else {
                    $data[$key]['code'] = "- <a  onclick='add(" . $item->id . ")'>[เพิ่ม]</a>";
                }
                $data[$key]['name'] = $item->name;
                if ($item->mainAdviser) {
                    $data[$key]['adviser'] = $item->mainAdviser->name;
                } else {
                    $data[$key]['adviser'] = "-";
                }
                if ($item->getExamGroup( $year, $semester, $subject )) {
                    $data[$key]['exam_group'] = $item->getExamGroup( $year, $semester, $subject )->name;
                } else {
                    $data[$key]['exam_group'] = "-";
                }
            }
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;

    }

    public function actionAjaxRunningNumber()
    {
        $year = \Yii::$app->request->post( 'year' );
        $semester = \Yii::$app->request->post( 'semester' );
        $subject = \Yii::$app->request->post( 'subject' );

        $projectIds = \Yii::$app->get( 'db_eproject' )->createCommand( 'SELECT
	epro_student_project.project_id
FROM
	epro_student_project

LEFT JOIN epro_advise ON epro_advise.project_id = epro_student_project.project_id
AND epro_advise.adviser_type_id = '.AdviserType::TYPE_PRIMARY_ADVISER.' OR epro_advise.project_id is null
LEFT JOIN epro_exam_committee ON epro_exam_committee.user_id = epro_advise.adviser_id OR epro_exam_committee.user_id is null
WHERE epro_student_project.year_id='.$year.' AND epro_student_project.semester_id='.$semester.'
AND epro_student_project.subject_id='.$subject.'
GROUP BY
	project_id
ORDER BY
	epro_exam_committee.exam_group_id ASC,
	epro_advise.adviser_id ASC
' )->queryAll();

//                $projectIds = StudentProject::find()
//                    ->leftJoin( Advise::tableName(),
//                        StudentProject::tableName() . ".project_id = " . Advise::tableName() . ".project_id AND "
//                        . Advise::tableName() . '.adviser_type_id = 1 OR epro_advise.project_id is null' )
//                    ->leftJoin( ExamCommittee::tableName(),
//                        Advise::tableName() . ".adviser_id = " . ExamCommittee::tableName() . ".user_id OR epro_exam_committee.user_id is null" )
//                    ->groupBy( StudentProject::tableName() . '.project_id' )
//                    ->orderBy( [ExamCommittee::tableName() . ".exam_group_id" => SORT_ASC] )
//                    ->select('epro_student_project.project_id');

        $project = [];
        foreach ($projectIds as $key => $item) {
            if ($model = Project::find()->where( ['id' => $item['project_id']] )
                ->andWhere( ['<>', 'name_th', ""] )->one()) {
                $project[] = $model;
            }
        }
        $data = false;
        if (count( $project ) != 0) {
            foreach ($project as $key => $item) {
                $item->number = ($key + 1);
                $item->save();
                $data[$key]['code'] = $item->major->code . ($key + 1);
                $data[$key]['name'] = $item->name;
                if ($item->mainAdviser) {
                    $data[$key]['adviser'] = $item->mainAdviser->name;
                } else {
                    $data[$key]['adviser'] = "-";
                }
                if ($item->getExamGroup( $year, $semester, $subject )) {
                    $data[$key]['exam_group'] = $item->getExamGroup( $year, $semester, $subject )->name;
                } else {
                    $data[$key]['exam_group'] = "-";
                }
            }
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function actionAjaxAdd()
    {

        $year = \Yii::$app->request->post( 'year' );
        $semester = \Yii::$app->request->post( 'semester' );
        $subject = \Yii::$app->request->post( 'subject' );
        $id = \Yii::$app->request->post( 'id' );
        $projectIds = StudentProject::find()
            ->where( ['year_id' => $year] )
            ->andWhere( ['semester_id' => $semester] )
            ->andWhere( ['subject_id' => $subject] )
            ->groupBy( 'project_id' )
            ->select( 'project_id' );
        $number = Project::find()
            ->where( ['id' => $projectIds] )
            ->andWhere( ['<>', 'name_th', ""] )
            ->andWhere( ['<>', 'number', ""] )
            ->orderBy( ['number' => SORT_DESC] )
            ->select( 'number' )
            ->one();
        $project = Project::findOne( $id );
        if ($number) {
            $project->number = $number->number + 1;
        } else {
            $project->number = 1;
        }
        $project->save();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return true;
    }

    public function actionAjaxSaveNumber()
    {
        $year = \Yii::$app->request->post( 'year' );
        $semester = \Yii::$app->request->post( 'semester' );
        $subject = \Yii::$app->request->post( 'subject' );
        $projectIds = \Yii::$app->get( 'db_eproject' )->createCommand( 'SELECT
	epro_student_project.project_id
FROM
	epro_student_project

LEFT JOIN epro_advise ON epro_advise.project_id = epro_student_project.project_id
AND epro_advise.adviser_type_id = '.AdviserType::TYPE_PRIMARY_ADVISER.' OR epro_advise.project_id is null
LEFT JOIN epro_exam_committee ON epro_exam_committee.user_id = epro_advise.adviser_id OR epro_exam_committee.user_id is null
WHERE epro_student_project.year_id='.$year.' AND epro_student_project.semester_id='.$semester.'
AND epro_student_project.subject_id='.$subject.'
GROUP BY
	project_id
ORDER BY
	epro_exam_committee.exam_group_id ASC,
	epro_advise.adviser_id ASC
' )->queryAll();

//                $projectIds = StudentProject::find()
//                    ->leftJoin( Advise::tableName(),
//                        StudentProject::tableName() . ".project_id = " . Advise::tableName() . ".project_id AND "
//                        . Advise::tableName() . '.adviser_type_id = 1 OR epro_advise.project_id is null' )
//                    ->leftJoin( ExamCommittee::tableName(),
//                        Advise::tableName() . ".adviser_id = " . ExamCommittee::tableName() . ".user_id OR epro_exam_committee.user_id is null" )
//                    ->groupBy( StudentProject::tableName() . '.project_id' )
//                    ->orderBy( [ExamCommittee::tableName() . ".exam_group_id" => SORT_ASC] )
//                    ->select('epro_student_project.project_id');

        $project = [];
        foreach ($projectIds as $key => $item) {
            if ($model = Project::find()->where( ['id' => $item['project_id']] )
                ->andWhere( ['<>', 'name_th', ""] )->one()) {
                $project[] = $model;
            }
        }
        $data = false;
        if (count( $project ) != 0) {
            foreach ($project as $key => $item) {
                $item->number = ($key + 1);
                $item->save();
                $data[$key]['code'] = $item->major->code . $item->number;
                $data[$key]['name'] = $item->name;
                if ($item->mainAdviser) {
                    $data[$key]['adviser'] = $item->mainAdviser->name;
                } else {
                    $data[$key]['adviser'] = "-";
                }
                if ($item->getExamGroup( $year, $semester, $subject )) {
                    $data[$key]['exam_group'] = $item->getExamGroup( $year, $semester, $subject )->name;
                } else {
                    $data[$key]['exam_group'] = "-";
                }
            }
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }


    public function actionAjaxGetSubject()
    {
        $year = \Yii::$app->request->post( 'year' );
        $semester = \Yii::$app->request->post( 'semester' );
        $openSubjects = OpenSubject::find()
            ->where( ['year_id' => $year] )
            ->andWhere( ['semester_id' => $semester] )
            ->select( 'subject_id' );
        $subject = Subject::find()
            ->where( ['id' => $openSubjects] )->all();
        $data = ArrayHelper::toArray( $subject, [
            'app\modules\eproject\models\Subject' => [
                'id',
                'name',
            ],
        ] );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }
}