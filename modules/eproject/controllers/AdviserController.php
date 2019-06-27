<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 17/8/2560
 * Time: 17:07
 */

namespace app\modules\eproject\controllers;


use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use app\modules\eproject\models\Advise;
use app\modules\eproject\models\AdviserBroadcast;
use app\modules\eproject\models\AdviserType;
use app\modules\eproject\models\BroadcastMajor;

use app\modules\eproject\models\ChangeAdviserRequest;
use app\modules\eproject\models\Enroll;
use app\modules\eproject\models\OpenSubject;
use app\modules\eproject\models\Project;
use app\modules\eproject\models\RequestAdvisee;
use app\modules\eproject\models\RequestAdviser;
use app\modules\eproject\models\StudentProject;
use app\modules\eproject\models\StudentRequestAdviser;
use app\modules\eproject\models\Subject;
use app\modules\eproject\models\SubjectView;
use app\modules\eproject\models\User;
use app\modules\eproject\models\YearSemester;
use Yii;
use yii\base\Exception;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class AdviserController extends Controller
{
    public function actionStudentStatus(){
        if (Yii::$app->request->get( 'id' ) == null) {
            $subjectId = Subject::getNowOpenSubjects()[0]->id;
        } else {
            $subjectId = Yii::$app->request->get( 'id' );
        }
        $students=User::find()
            ->innerJoin(Enroll::tableName(),Enroll::tableName().'.student_id = '.User::tableName().'.id')
            ->where(['year_id'=>ModelHelper::getNowYear()])
            ->andWhere(['semester_id'=>ModelHelper::getNowSemester()])
            ->andWhere(['subject_id'=>$subjectId])
            ->all();
        return $this->render('student-status',[
            'students'=>$students,
            'subjectId'=>$subjectId
        ]);
    }

    public function actionWorkLoad(){
        return $this->render('work-load',[
            'users'=> User::find()->where( ['user_type_id' => 1] )->all()
        ]);
    }
    /**
     * @return string
     */
    public function actionHistory()
    {
        $tmp = Yii::$app->request->get( 'YearSemester' );
        $year = $tmp['year_id'];
        $semester = $tmp['semester_id'];
        $yearSemester = new YearSemester();
        $yearSemester->load( Yii::$app->request->get() );

        if ($year && $semester) {
            $query = Project::find()
                ->innerJoin( Advise::tableName(), Advise::tableName() . '.project_id = ' . Project::tableName() . '.id'
                    . ' AND adviser_type_id = ' . AdviserType::TYPE_PRIMARY_ADVISER . ' AND adviser_id =' . Yii::$app->user->identity->getId() )
                ->where( [Project::tableName() . '.year_id' => $year] )
                ->andWhere( [Project::tableName() . '.semester_id' => $semester] )
                ->orderBy( [Project::tableName() . '.year_id' => SORT_DESC,
                    Project::tableName() . '.semester_id' => SORT_ASC] );
        } else {
            $query = Project::find()
                ->innerJoin( Advise::tableName(), Advise::tableName() . '.project_id = ' . Project::tableName() . '.id'
                    . ' AND adviser_type_id = ' . AdviserType::TYPE_PRIMARY_ADVISER . ' AND adviser_id =' . Yii::$app->user->identity->getId() )
                ->orderBy( [Project::tableName() . '.year_id' => SORT_DESC,
                    Project::tableName() . '.semester_id' => SORT_ASC] );
        }
        $countQuery = clone $query;
        $pages = new Pagination( ['totalCount' => $countQuery->count(), 'pageSize' => 5] );
        $models = $query->offset( $pages->offset )
            ->limit( $pages->limit )
            ->all();
        return $this->render( 'history', ['data' => $models,
            'pages' => $pages,
            'yearSemester' => $yearSemester] );
    }

    /**
     * @return string
     */
    public function actionManagement()
    {
        $projectIds = Advise::find()
            ->where( ['adviser_id' => Yii::$app->user->identity->getId()] )
            ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->select( 'project_id' );
        $project = Project::find()->where( ['id' => $projectIds] )->all();
        $adviseeRequest = RequestAdvisee::find()
            ->where( ['adviser_id' => Yii::$app->user->identity->getId()] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )->one();
        if (!$adviseeRequest) {

            $count = Advise::find()
                ->where( ['adviser_id' => Yii::$app->user->identity->getId()] )
                ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER,
                ] )->count();
            $adviseeRequest = new RequestAdvisee();
            $adviseeRequest->need = 0;
            $adviseeRequest->added = $count;
        }

        return $this->render( 'management', [
            'project' => $project,
            'adviseeRequest' => $adviseeRequest
        ] );
    }

    public function actionAjaxUpdateNeed()
    {

        $value = \Yii::$app->request->post( 'value' );
        $requestAdvisee = RequestAdvisee::find()
            ->where( ['adviser_id' => Yii::$app->user->identity->getId()] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )->one();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($requestAdvisee) {
            $requestAdvisee->need = $value;
            if ($requestAdvisee->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            $count = Advise::find()
                ->where( ['adviser_id' => Yii::$app->user->identity->getId()] )
                ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER,
                ] )->count();
            $requestAdvisee = new RequestAdvisee();
            $requestAdvisee->need = $value;
            $requestAdvisee->added = $count;
            $requestAdvisee->year_id = ModelHelper::getNowYear();
            $requestAdvisee->semester_id = ModelHelper::getNowSemester();
            $requestAdvisee->adviser_id = Yii::$app->user->identity->getId();
            if ($requestAdvisee->save()) {
                return true;
            } else {
                return $requestAdvisee->errors;
            }
        }


    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionRequest()
    {

        if (Enroll::find()
            ->where( ['student_id' => Yii::$app->user->identity->getId()] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )->one()
        ) {

            $model = new RequestAdviser();
            if (Yii::$app->request->isGet) {

                $projectId = Project::findProjectId();

                if (RequestAdviser::find()->where( ['crby' => Yii::$app->user->identity->getId()] )->andWhere( ['status' => RequestAdviser::STATUS_PENDING] )->one()) {

                    Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Your Requesting is Processing' ) );
                    return $this->redirect( ['requesting/out'] );
                } else if ($projectId && Advise::find()
                        ->where( ['project_id' => $projectId] )
                        ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                        ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                        ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
                        ->one()) {
                    Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'You Already Have Adviser' ) );
                    return $this->redirect( Yii::$app->request->referrer );
                } else {

                    if (!$teacher = Yii::$app->request->get( 'teacher' )) {
                        $teacher = null;
                    }
                    return $this->render( 'request',
                        ['model' => $model,
                            'teacher' => $teacher] );
                }
            } else if (Yii::$app->request->isPost) {

                if ($model->load( Yii::$app->request->post() )) {
                    $model->status = RequestAdviser::STATUS_PENDING;
                    if ($model->save()) {
                        $this->fillRelations( $model->id );
                        Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
                    } else {
                        Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
                    }
                }
                return $this->redirect( ['requesting/out'] );
            }
        } else {
            Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'You Not Enroll' ) );

            return $this->redirect( ['site/index'] );
        }


    }


    public function actionBroadcastView()
    {
        $id = Yii::$app->request->get( 'id' );
        $broabcast = AdviserBroadcast::findOne( $id );
        return $this->render( 'broadcast-view',
            ['broadcast' => $broabcast] );
    }


    /**
     * @return string|\yii\web\Response
     */
    public function actionBroadcast()
    {
        //กรณีที่มีประกาศอยู่แล้ว
        if (AdviserBroadcast::find()->where( ['adviser_id' => Yii::$app->user->identity->getId()] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->one()) {
            $model = AdviserBroadcast::find()->where( ['adviser_id' => Yii::$app->user->identity->getId()] )
                ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
//                ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
                ->one();
        } else {
            //กรณีที่ไม่มีสร้างใหม่
            $model = new AdviserBroadcast();
        }

        if (Yii::$app->request->isGet) {
            return $this->render( 'broadcast', ['model' => $model] );
        } else if (Yii::$app->request->isPost) {
            if ($_POST['submitBtn'] == 'submit') {
                //กรณีกดปุ่ม Submit
                $model->adviser_id = Yii::$app->user->identity->getId();
                $model->status = AdviserBroadcast::STATUS_ACTIVE;
                $model->year_id = ModelHelper::getNowYear();
                $model->semester_id = ModelHelper::getNowSemester();
//                $model->subject_id = ModelHelper::getSubjectId();

                if ($model->load( Yii::$app->request->post() ) && $model->save()) {

                    try {
                        BroadcastMajor::deleteAll( ['adviser_broadcast_id' => $model->id] );
                        foreach (Yii::$app->request->post( 'AdviserBroadcast' )['majors'] as $item) {
                            $relationModel = new BroadcastMajor();
                            $relationModel->major_id = $item;
                            $relationModel->adviser_broadcast_id = $model->id;
                            $relationModel->save();
                        }
                        Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
                        return $this->redirect( ['broadcast'] );
                    } catch (Exception $e) {
                        Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
                        return $this->redirect( ['broadcast'] );
                    }
                } else {
                    Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
                    return $this->redirect( ['broadcast'] );
                }
            } else {
                //กรณีกดปุ่ม ยกเลิก
                $model->status = AdviserBroadcast::STATUS_NOT_ACTIVE;
                $model->save();
//                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
                return $this->redirect( ['broadcast'] );
            }

        }
    }

    /**
     * @return string
     */
    public function actionNoAdviserStd()
    {
        $subject = Subject::getNowOpenSubjects();
        if (Yii::$app->request->get( 'subject' ) == null) {
            if ($subject) {
                $subjectId = $subject[0]->id;
            } else {
                $subjectId = 0;
            }
        } else {
            $subjectId = Yii::$app->request->get( 'subject' );
        }
        $stdProject = StudentProject::find()
           ->innerJoin(Advise::tableName(),Advise::tableName().'.project_id = '.StudentProject::tableName().'.project_id')
            ->andWhere( [Advise::tableName().'.year_id' => ModelHelper::getNowYear()] )
            ->andWhere( [Advise::tableName().'.semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( [Advise::tableName().'.subject_id' => $subjectId] )
            ->select( 'student_id' );
        $enrolls = Enroll::find()
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['subject_id' => $subjectId] )
            ->andWhere( ['not in', 'student_id', $stdProject] )
            ->all();

        return $this->render( 'no-adviser-std',
            ['enrolls' => $enrolls,
                'subject' => $subject,
                'subjectId' => $subjectId] );
    }

    public function actionAjaxGetSubject()
    {
        $year = \Yii::$app->request->post( 'year' );
        $semester = \Yii::$app->request->post( 'semester' );
        $subjectIds = Subject::find()->select( 'id' );
        $openSubjectIds = OpenSubject::find()->where( ['subject_id' => $subjectIds] )
            ->andWhere( ['year_id' => $year] )
            ->andWhere( ['semester_id' => $semester] )
            ->select( 'subject_id' );
        $subject = SubjectView::find()->where( ['id' => $openSubjectIds] )->all();
        $data = ArrayHelper::toArray( $subject, [
            'app\modules\eproject\models\SubjectView' => [
                'id',
                'name',
            ],
        ] );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionChangeAdviser()
    {
        $model = new ChangeAdviserRequest();
        if (Yii::$app->request->isGet) {
            $projectId = Project::findProjectId();
            if ($projectId && Advise::find()
                    ->where( ['project_id' => $projectId] )
                    ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER] )
                    ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                    ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                    ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
                    ->one()) {
                if (ChangeAdviserRequest::find()->where( ['project_id' => Project::findProjectId()] )->andWhere( ['status' => '0'] )->one()) {
                    Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Your Requesting is Processing' ) );

                    return $this->redirect( ['requesting/out'] );
                } else {
                    return $this->render( 'change-adviser', ['model' => $model,
                        'project' => Project::findOne( $projectId )] );
                }
            } else {
                Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'You Not Have Adviser' ) );

                return $this->redirect( Yii::$app->request->referrer );
            }


        } else {
            if ($model->load( Yii::$app->request->post() )) {
                $model->status = '0';
                $model->project_id = Project::findProjectId();
                $model->from = Advise::find()
                    ->where( ['project_id' => Project::findProjectId()] )
                    ->andWhere( ['adviser_type_id' => 1] )
                    ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                    ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                    ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
                    ->one()->adviser_id;
                if ($model->save()) {

                    Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
                } else {
                    Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
                }
            }
            return $this->redirect( ['requesting/out'] );
        }

    }

    /**
     * @return string
     */
    public function actionStudentPerAdviser()
    {
        $major = Yii::$app->request->get( 'major' );
        if (Yii::$app->request->get( 'major' ) == null)
            $major = 0;
        if ($major == 0) {
            $requestAdvisee = RequestAdvisee::find()
                ->where( ['year_id' => ModelHelper::getNowYear()] )
                ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                ->all();
        } else {
            $requestAdvisee = RequestAdvisee::find()
                ->innerJoin( User::tableName(),
                    RequestAdvisee::tableName() . '.adviser_id=' . User::tableName() . '.id AND ' .
                    User::tableName() . '.major_id=' . $major )
                ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                ->all();
        }

        return $this->render( 'student-per-adviser',
            ['requestAdvisee' => $requestAdvisee,
                'major' => $major] );
    }


    /**
     * @param $id
     */
    private function fillRelations($id)
    {
        $relationModel = new StudentRequestAdviser();
        $relationModel->student_id = Yii::$app->user->identity->getId();
        $relationModel->adviser_request_id = $id;
        $relationModel->year_id = ModelHelper::getNowYear();
        $relationModel->semester_id = ModelHelper::getNowSemester();
        $relationModel->subject_id = ModelHelper::getSubjectId();
        $relationModel->save();
        if (Yii::$app->request->post( 'RequestAdviser' )['students']) {
            foreach (Yii::$app->request->post( 'RequestAdviser' )['students'] as $item) {
                $relationModel = new StudentRequestAdviser();
                $relationModel->student_id = $item;
                $relationModel->adviser_request_id = $id;
                $relationModel->year_id = ModelHelper::getNowYear();
                $relationModel->semester_id = ModelHelper::getNowSemester();
                $relationModel->subject_id = ModelHelper::getSubjectId();
                $relationModel->save();
            }
        }

    }

}