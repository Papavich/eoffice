<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 6/7/2560
 * Time: 17:22
 */

namespace app\modules\eproject\controllers;


use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\models\Advise;
use app\modules\eproject\models\AdviserType;
use app\modules\eproject\models\ExamCommittee;
use app\modules\eproject\models\ExamGroup;
use app\modules\eproject\models\Major;
use app\modules\eproject\models\OpenSubject;
use app\modules\eproject\models\Project;
use app\modules\eproject\models\Subject;
use app\modules\eproject\models\SubjectView;
use yii\db\StaleObjectException;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class AdminProjectExamGroupController extends Controller
{
    public function actionIndex()
    {
        return $this->render( 'index' );
    }

    public function actionAjaxGetSubject()
    {
//        $year = \Yii::$app->request->post( 'year' );
//        $semester = \Yii::$app->request->post( 'semester' );
//        $subjectIds = Subject::find()->select( 'id' );
//        $openSubjectIds=OpenSubject::find()->where( ['subject_id' => $subjectIds] )
//            ->andWhere( ['year_id' =>$year] )
//            ->andWhere( ['semester_id' => $semester] )
//            ->select('subject_id');
//        $subject= SubjectView::find()->where( ['id' => $openSubjectIds] )->all();
//        $data = ArrayHelper::toArray( $subject, [
//            'app\modules\eproject\models\SubjectView' => [
//                'id',
//                'name',
//            ],
//        ] );
        $year = \Yii::$app->request->post( 'year' );
        $semester = \Yii::$app->request->post( 'semester' );
        $subject=SubjectView::find()->innerJoin(OpenSubject::tableName(),SubjectView::tableName().'.id = '.OpenSubject::tableName().'.subject_id')
            ->innerJoin(Subject::tableName(),Subject::tableName().'.id = '.OpenSubject::tableName().'.subject_id')
            ->where( ['year_id' =>$year] )
            ->andWhere( ['semester_id' => $semester] )
            ->orderBy('subject_id')
            ->all();
        $data = ArrayHelper::toArray( $subject, [
            'app\modules\eproject\models\SubjectView' => [
                'id',
                'name',
            ],
        ] );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function actionAjaxSearch()
    {
        $year = \Yii::$app->request->post( 'year' );
        $semester = \Yii::$app->request->post( 'semester' );
        $subject = \Yii::$app->request->post( 'subject' );
        $examGroups = ExamGroup::find()
            ->where( ['year_id' => $year] )
            ->andWhere( ['semester_id' => $semester] )
            ->andWhere( ['subject_id' => $subject] )
            ->all();
        $data = false;
        if (count( $examGroups ) != 0) {
            foreach ($examGroups as $key => $item) {
                $data[$key]['name'] = $item->name;
                $data[$key]['id'] = $item->id;
                foreach ($item->users as $subKey => $user) {
                    $data[$key]['advisers'][$subKey]['name'] = $user->name;
                    $data[$key]['advisers'][$subKey]['id'] = $user->id;
                    $projectIds = Advise::find()
                        ->where( ['year_id' => $year] )
                        ->andWhere( ['semester_id' => $semester] )
                        ->andWhere( ['subject_id' => $subject] )
                        ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER] )
                        ->andWhere( ['adviser_id' => $user->id] )
                        ->select( 'project_id' );
                    $data[$key]['advisers'][$subKey]['cs'] = (int)Project::find()
                        ->where( ['id' => $projectIds] )
                        ->andWhere( ['major_id' => 1] )->count();
                    $data[$key]['advisers'][$subKey]['ict'] = (int)Project::find()
                        ->where( ['id' => $projectIds] )
                        ->andWhere( ['major_id' => 2] )->count();
                    $data[$key]['advisers'][$subKey]['gis'] = (int)Project::find()
                        ->where( ['id' => $projectIds] )
                        ->andWhere( ['major_id' => 3] )->count();
                    $data[$key]['advisers'][$subKey]['total'] = $data[$key]['advisers'][$subKey]['cs'] +
                        $data[$key]['advisers'][$subKey]['ict'] +
                        $data[$key]['advisers'][$subKey]['gis'];

                }

            }

        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;

    }

    public function actionAjaxAddGroup()
    {
        $name = \Yii::$app->request->post( 'name' );
        $room = \Yii::$app->request->post( 'room' );
        $year = \Yii::$app->request->post( 'year' );
        $subject = \Yii::$app->request->post( 'subject' );
        $semester = \Yii::$app->request->post( 'semester' );
        $examGroup = new ExamGroup() ;
        $examGroup->name = $name;
        $examGroup->room = $room;
        $examGroup->year_id = $year;
        $examGroup->semester_id = $semester;
        $examGroup->subject_id = $subject;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($examGroup->save()) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * @return mixed
     * @throws StaleObjectException
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionAjaxRemoveGroup()
    {
        $id = \Yii::$app->request->post( 'id' );
        $examGroup = ExamGroup::findOne( $id );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if ($examGroup->delete()) {
            return true;
        } else {
            return $examGroup->getErrors();

        }

    }

    public function actionAjaxUpdateGroup()
    {
        $id = \Yii::$app->request->post( 'id' );
        $name = \Yii::$app->request->post( 'name' );
        $examGroup = ExamGroup::findOne( $id );
        $examGroup->name = $name;

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($examGroup->save()) {
            return true;
        } else {
            return false;
        }

    }

    public function actionAjaxAddTeacher()
    {
        $teacher = \Yii::$app->request->post( 'teacher' );
        $group = \Yii::$app->request->post( 'group' );
        $year = \Yii::$app->request->post( 'year' );
        $subject = \Yii::$app->request->post( 'subject' );
        $semester = \Yii::$app->request->post( 'semester' );
        $committee = new ExamCommittee() ;
        $committee->user_id = $teacher;
        $committee->exam_group_id = $group;
        $committee->year_id = $year;
        $committee->semester_id = $semester;
        $committee->subject_id = $subject;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($committee->save()) {
            return true;
        } else {
            return $committee->getErrors();
        }

    }

    /**
     * @throws StaleObjectException
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionAjaxRemoveTeacher()
    {
        $id = \Yii::$app->request->post( 'teacher' );
        $group = \Yii::$app->request->post( 'group' );
        $committee = ExamCommittee::find()->where( ['exam_group_id' => $group] )
            ->andWhere( ['user_id' => $id] )->one();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($committee->delete()) {
            return true;
        } else {
            return false;
        }


    }
}