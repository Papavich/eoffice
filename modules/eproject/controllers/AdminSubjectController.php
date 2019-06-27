<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 10/1/2561
 * Time: 3:15
 */

namespace app\modules\eproject\controllers;

use app\modules\eproject\controllers;
use app\modules\eproject\models\Subject;
use app\modules\eproject\models\SubjectDocumentType;
use Yii;
use yii\db\StaleObjectException;
use yii\web\Controller;

class AdminSubjectController extends Controller
{
    public function actionDocumentType()
    {
        $subjects = Subject::find()->all();
        return $this->render( 'document-type',
            ['subjects' => $subjects] );
    }


    public function actionDelete($id)
    {
        try {
            Subject::findOne( $id )->delete();
        } catch (StaleObjectException $e) {
            Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
        } catch (\Exception $e) {
            Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
        } catch (\Throwable $e) {
            Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
        }
        return $this->redirect( ['document-type'] );
    }

    public function actionAddSubject()
    {
        $subject = new Subject();
        if (Yii::$app->request->isPost) {
            if ($subject->load( Yii::$app->request->post() ) && $subject->save()) {
                Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
            } else {
                Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'This Subject is Already Exist' ) );
            }


            return $this->redirect( ['document-type'] );

        } else {
            return $this->render( 'add-subject' );
        }

    }

    public function actionUpdateDocumentType()
    {
        $id = Yii::$app->request->get( 'id' );
        $model = Subject::findOne( $id );
        if ($model->load( Yii::$app->request->post() )) {
            SubjectDocumentType:: deleteAll( 'subject_id = :id ', [':id' => $model->id] );
            if (Yii::$app->request->post( 'Subject' )['documentTypes']) {
                foreach (Yii::$app->request->post( 'Subject' )['documentTypes'] as $item) {
                    $relationModel = new SubjectDocumentType();
                    $relationModel->document_type_id = $item;
                    $relationModel->subject_id = $model->id;
                    $relationModel->save();
                }
            }
            return $this->redirect( 'document-type' );
        } else {
            $subject = Subject::findOne( $id );
            return $this->render( 'update-document-type',
                ['subject' => $subject] );
        }

    }
}