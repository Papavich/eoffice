<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 29/10/2560
 * Time: 13:23
 */

namespace app\modules\eproject\controllers;


use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use app\modules\eproject\models\Advise;
use app\modules\eproject\models\AdviserType;
use app\modules\eproject\models\ChangeAdviserRequest;
use app\modules\eproject\models\ChangeMemberRequest;
use app\modules\eproject\models\ChangeTopicRequest;
use app\modules\eproject\models\Project;
use app\modules\eproject\models\RequestAdviser;
use app\modules\eproject\models\StudentProject;
use app\modules\eproject\models\StudentRequestAdviser;
use app\modules\eproject\models\StudentRequestMember;
use app\modules\eproject\models\User;
use app\modules\pms\models\Model;
use Yii;
use yii\web\Controller;

class RequestingController extends Controller
{
    /**
     * @return string
     */
    public function actionIn()
    {
        //for teacher
        if (YIi::$app->request->isGet) {
            $modelAdviserRequest = RequestAdviser::find()
                ->where( ['adviser_id' => Yii::$app->user->identity->getId()] )
                ->andWhere( ['or', ['status' => RequestAdviser::STATUS_PENDING], ['status' => RequestAdviser::STATUS_WAITING]] )
                ->all();
            $modelChangeTopic = User::find()->where( ["id" => Yii::$app->user->identity->getId()] )->one()->changeTopicRequests;
            $modelChangeMember = User::find()->where( ["id" => Yii::$app->user->identity->getId()] )->one()->changeMemberRequests;
            $modelChangeAdviser = ChangeAdviserRequest::find()
                ->where(['and', ['or',['status' => ChangeAdviserRequest::STATUS_PENDING],['status' => ChangeAdviserRequest::STATUS_WAITING_SOURCE]], ['from' => Yii::$app->user->identity->getId()]])
                ->orWhere( ['and', ['or',['status' => ChangeAdviserRequest::STATUS_SOURCE_ADVISER_APPROVED],['status' => ChangeAdviserRequest::STATUS_WAITING_DESTINATION]], ['to' => Yii::$app->user->identity->getId()]] )->all();
            return $this->render( 'in',
                [
                    'modelAdviserRequest' => $modelAdviserRequest,
                    'modelChangeTopic' => $modelChangeTopic,
                    'modelChangeAdviser' => $modelChangeAdviser,
                    'modelChangeMember' => $modelChangeMember
                ] );
        } else if (Yii::$app->request->isPost) {

            //do somethings
            $request = Yii::$app->request;
            if ($request->post( 'approveCA' )) {
                $model = ChangeAdviserRequest::findOne( $request->post( 'approveCA' ) );
                if ($model->status == ChangeAdviserRequest::STATUS_PENDING||$model->status == ChangeAdviserRequest::STATUS_WAITING_SOURCE) {
                    $model->status = ChangeAdviserRequest::STATUS_SOURCE_ADVISER_APPROVED;
                } else if ($model->status == ChangeAdviserRequest::STATUS_SOURCE_ADVISER_APPROVED||$model->status == ChangeAdviserRequest::STATUS_WAITING_DESTINATION) {
                    $model->status = ChangeAdviserRequest::STATUS_APPROVED;
                    Advise::deleteAll( ['project_id' => $model->project_id,
                        'subject_id' => ModelHelper::getSubjectId( $model->crby ),
                        'year_id' => ModelHelper::getNowYear(),
                        'semester_id' => ModelHelper::getNowSemester()] );
                    $adviserRelation = new Advise();
                    $adviserRelation->project_id = $model->project_id;
                    $adviserRelation->adviser_id = Yii::$app->user->identity->getId();
//                    $adviserRelation->status = Advise::STATUS_ACTIVE;
                    $adviserRelation->year_id = ModelHelper::getNowYear();
                    $adviserRelation->subject_id = ModelHelper::getSubjectId( $model->crby );
                    $adviserRelation->semester_id = ModelHelper::getNowSemester();
                    $adviserRelation->adviser_type_id = AdviserType::TYPE_PRIMARY_ADVISER;
                   $adviserRelation->save();
                    Project::findOne( $model->project_id )->updateElastic();
                }
                if ($comment = $request->post( 'comment' )) {
                    $model->comment = $comment;
                }else{
                    $model->comment = "";
                }
                $model->save();
//                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
                return $this->redirect( Yii::$app->request->referrer );
            } else if ($request->post( 'disapproveCA' )) {
                $model = ChangeAdviserRequest::findOne( $request->post( 'disapproveCA' ) );
                if ($model->status == ChangeAdviserRequest::STATUS_SOURCE_ADVISER_APPROVED||$model->status == ChangeAdviserRequest::STATUS_WAITING_DESTINATION) {
                    Advise::deleteAll( ['project_id' => $model->project_id,
                        'subject_id' => ModelHelper::getSubjectId( $model->crby ),
                        'year_id' => ModelHelper::getNowYear(),
                        'semester_id' => ModelHelper::getNowSemester()] );
                    Project::findOne( $model->project_id )->updateElastic();
                }
                $model->status = ChangeAdviserRequest::STATUS_DISAPPROVED;
                if ($comment = $request->post( 'comment' )) {
                    $model->comment = $comment;
                }else{
                    $model->comment = "";
                }
                $model->save();
//                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
                return $this->redirect( Yii::$app->request->referrer );
            } else if ($request->post( 'waitingCA' )) {

                $model = ChangeAdviserRequest::findOne( $request->post( 'waitingCA' ) );
                if ($model->status == ChangeAdviserRequest::STATUS_PENDING) {
                    $model->status = ChangeAdviserRequest::STATUS_WAITING_SOURCE;
                } else if ($model->status == ChangeAdviserRequest::STATUS_SOURCE_ADVISER_APPROVED) {
                    $model->status = ChangeAdviserRequest::STATUS_WAITING_DESTINATION;
                }
                if ($comment = $request->post( 'comment' )) {
                    $model->comment = $comment;
                }else{
                    $model->comment = "";
                }
                $model->save();
//                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
                return $this->redirect( Yii::$app->request->referrer );
            } else if ($request->post( 'approveCT' )) {
                $model = ChangeTopicRequest::findOne( $request->post( 'approveCT' ) );
                $model->status = ChangeTopicRequest::STATUS_APPROVED;
                if ($comment = $request->post( 'comment' )) {
                    $model->comment = $comment;
                }else{
                    $model->comment = "";
                }
                $model->save();
                $projectModel = Project::findOne( $model->project_id );
                $projectModel->name_en = $model->pro_name_en;
                $projectModel->name_th = $model->pro_name_th;
                $projectModel->save();
//                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
                return $this->redirect( Yii::$app->request->referrer );
            } else if ($request->post( 'disapproveCT' )) {
                $model = ChangeTopicRequest::findOne( $request->post( 'disapproveCT' ) );
                $model->status = ChangeTopicRequest::STATUS_DISAPPROVED;
                if ($comment = $request->post( 'comment' )) {
                    $model->comment = $comment;
                }else{
                    $model->comment = "";
                }
                $model->save();
//                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
                return $this->redirect( Yii::$app->request->referrer );
            } else if ($request->post( 'waitingCT' )) {
                $model = ChangeTopicRequest::findOne( $request->post( 'waitingCT' ) );
                $model->status = ChangeTopicRequest::STATUS_WAITING;
                if ($comment = $request->post( 'comment' )) {
                    $model->comment = $comment;
                }else{
                    $model->comment = "";
                }
                $model->save();
//                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
                return $this->redirect( Yii::$app->request->referrer );
            } else if ($request->post( 'approveCM' )) {
                $model = ChangeMemberRequest::findOne( $request->post( 'approveCM' ) );
                $model->status = ChangeMemberRequest::STATUS_APPROVED;
                if ($comment = $request->post( 'comment' )) {
                    $model->comment = $comment;
                }else {
                    $model->comment = "";
                }
                $model->save();
                $studentProjects = StudentProject::find()
                    ->where( ['project_id' => $model->project_id] )
                    ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                    ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )->all();
                foreach ($studentProjects as $studentProject) {
                    $studentProject->delete();
                }
                $studentMembers = StudentRequestMember::find()->where( ['change_member_request_id' => $model->id] )
                    ->andWhere( ['type' => StudentRequestMember::TYPE_TO] )->all();
                foreach ($studentMembers as $studentMember) {
                    $tmp = new StudentProject();
                    $tmp->student_id = $studentMember->student_id;
                    $tmp->year_id = ModelHelper::getNowYear();
                    $tmp->semester_id = ModelHelper::getNowSemester();
                    $tmp->subject_id = ModelHelper::getNowSubject( $studentMember->student_id );
                    $tmp->project_id = $model->project_id;
                    $tmp->save();
                }
                Project::findOne( $model->project_id )->updateElastic();
//                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
                return $this->redirect( Yii::$app->request->referrer );
            } else if ($request->post( 'disapproveCM' )) {
                $model = ChangeMemberRequest::findOne( $request->post( 'disapproveCM' ) );
                $model->status = ChangeMemberRequest::STATUS_DISAPPROVED;
                if ($comment = $request->post( 'comment' )) {
                    $model->comment = $comment;
                }else{
                    $model->comment = "";
                }
                $model->save();
//                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
                return $this->redirect( Yii::$app->request->referrer );
            } else if ($request->post( 'waitingCM' )) {
                $model = ChangeMemberRequest::findOne( $request->post( 'waitingCM' ) );
                $model->status = ChangeMemberRequest::STATUS_WAITING;
                if ($comment = $request->post( 'comment' )) {
                    $model->comment = $comment;
                }else{
                    $model->comment = "";
                }
                $model->save();
//                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
                return $this->redirect( Yii::$app->request->referrer );
            } else if ($request->post( 'approveRA' )) {
                $model = RequestAdviser::findOne( $request->post( 'approveRA' ) );
                $model->status = RequestAdviser::STATUS_APPROVED;
                if ($comment = $request->post( 'comment' )) {
                    $model->comment = $comment;
                }else{
                    $model->comment = "";
                }
                $model->save();
                $stdId = StudentRequestAdviser::find()->where( ['adviser_request_id' => $model->id] )->one()->student_id;
                $subjcet_id = ModelHelper::getSubjectId( $stdId);
                if (Project::findProjectId( $stdId ) == false) {
                    //ถ้ายังไม่มีโปรเจคมาก่อน
                    //สร้างโปรเจคใหม่ =
                    $projectModel = new Project();
                    $projectModel->year_id = ModelHelper::getNowYear();
                    $projectModel->semester_id = ModelHelper::getNowSemester();
                    $projectModel->major_id = User::findOne( $stdId )->major_id;
                    $projectModel->save();

                    foreach (StudentRequestAdviser::find()->where( ['adviser_request_id' => $model->id] )->all() as $item) {

                        $tmp = new StudentProject();
                        $tmp->student_id = $item->student_id;
                        $tmp->year_id = ModelHelper::getNowYear();
                        $tmp->semester_id = ModelHelper::getNowSemester();
                        $tmp->subject_id = $subjcet_id;
                        $tmp->project_id = $projectModel->id;
                        $tmp->save();
                    }
                } else {

                    foreach (StudentRequestAdviser::find()->where( ['adviser_request_id' => $model->id] )->all() as $item) {

                        $tmp = new StudentProject();
                        $tmp->student_id = $item->student_id;
                        $tmp->year_id = ModelHelper::getNowYear();
                        $tmp->semester_id = ModelHelper::getNowSemester();
                        $tmp->subject_id = $subjcet_id;
                        $tmp->project_id = Project::findProjectId( $stdId );
                        $tmp->save();
                    }
                }
                //สร้างความสัมพัธ์ทที่ปรึกษาใหม
                $adviserRelation = new Advise();
                $adviserRelation->project_id = Project::findProjectId( $stdId );
                $adviserRelation->adviser_id = Yii::$app->user->identity->getId();
//                $adviserRelation->status = ProjectXAdviser::STATUS_ACTIVE;
                $adviserRelation->adviser_type_id = AdviserType::TYPE_PRIMARY_ADVISER;
                $adviserRelation->year_id = ModelHelper::getNowYear();
                $adviserRelation->semester_id = ModelHelper::getNowSemester();
                $adviserRelation->subject_id = $subjcet_id;
                $adviserRelation->save();

//                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
                return $this->redirect( Yii::$app->request->referrer );
            } else if ($request->post( 'disapproveRA' )) {
                $model = RequestAdviser::findOne( $request->post( 'disapproveRA' ) );
                $model->status = RequestAdviser::STATUS_DISAPPROVED;
                if ($comment = $request->post( 'comment' )) {
                    $model->comment = $comment;
                }else{
                    $model->comment = "";
                }
                $model->save();

//                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
                return $this->redirect( Yii::$app->request->referrer );
            } else if ($request->post( 'waitingRA' )) {
                $model = RequestAdviser::findOne( $request->post( 'waitingRA' ) );
                $model->status = RequestAdviser::STATUS_WAITING;
                if ($comment = $request->post( 'comment' )) {
                    $model->comment = $comment;
                }else{
                    $model->comment = "";
                }
                $model->save();

//                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
                return $this->redirect( Yii::$app->request->referrer );
            }

        }
    }

    /**
     * @return string
     */
    public function actionOut()
    {
        //for student
        if (YIi::$app->request->isGet) {
            $modelAdviserRequest = RequestAdviser::find()
                ->where( ['crby' => Yii::$app->user->identity->getId()] )
                ->all();
            $modelChangeTopic = ChangeTopicRequest::find()
                ->where( ['project_id' => Project::findProjectId()] )
                ->all();
            $modelChangeAdviser = ChangeAdviserRequest::find()
                ->where( ['project_id' => Project::findProjectId()] )
                ->all();
            $modelChangeMember = ChangeMemberRequest::find()
                ->where( ['project_id' => Project::findProjectId()] )
                ->all();
            return $this->render( 'out',
                [
                    'modelAdviserRequest' => $modelAdviserRequest,
                    'modelChangeTopic' => $modelChangeTopic,
                    'modelChangeAdviser' => $modelChangeAdviser,
                    'modelChangeMember' => $modelChangeMember
                ] );
        }
    }

    /**
     * @return string
     */
    public function actionCancelRequest()
    {
        $type = Yii::$app->request->post( 'type' );
        $id = Yii::$app->request->post( 'id' );
        if ($type == "RA") {
            $request = RequestAdviser::findOne( $id );
            $request->status = RequestAdviser::STATUS_CANCELED;
            if ($request->save()) {
                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
            } else {
                Yii::$app->session->setFlash( 'warning', 'มีข้อผิดหลาพ' );
            }
        } else if ($type == "CT") {
            $request = ChangeTopicRequest::findOne( $id );
            $request->status = ChangeTopicRequest::STATUS_CANCELED;
            if ($request->save()) {
                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
            } else {
                Yii::$app->session->setFlash( 'warning', controllers::t('label','Something Went Wrong') );
            }
        } else if ($type == "CA") {
            $request = ChangeAdviserRequest::findOne( $id );
            $request->status = ChangeAdviserRequest::STATUS_CANCELED;
            if ($request->save()) {
                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
            } else {
                Yii::$app->session->setFlash( 'warning', controllers::t('label','Something Went Wrong') );
            }
        } else if ($type == "CM") {
            $request = ChangeMemberRequest::findOne( $id );
            $request->status = ChangeMemberRequest::STATUS_CANCELED;
            if ($request->save()) {
                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
            } else {
                Yii::$app->session->setFlash( 'warning', controllers::t('label','Something Went Wrong') );
            }
        }

        return $this->redirect( ['out'] );
    }
}