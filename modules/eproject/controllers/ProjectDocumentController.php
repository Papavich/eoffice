<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 10/10/2560
 * Time: 21:23
 */

namespace app\modules\eproject\controllers;


use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use app\modules\eproject\models\Advise;
use app\modules\eproject\models\AdviserType;
use app\modules\eproject\models\DocumentType;
use app\modules\eproject\models\Project;
use app\modules\eproject\models\ProjectDocument;
use app\modules\eproject\models\ProjectPublic;
use app\modules\eproject\models\ProjectXStudent;
use app\modules\eproject\models\PublicDocument;
use app\modules\eproject\models\PublicXDocument;
use app\modules\eproject\models\StudentProject;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ProjectDocumentController extends Controller
{
    const PUBLIC_DOCUMENT_TYPE = 8;
    const DOCUMENT_STATUS_PENDING = '0';
    const FILE_TYPE_URL = 5;
    const IS_NOT_PUBLIC_DOCUMENT = 0;

    /**
     * @return \yii\web\Response
     */
    public function actionDeletePublicDocument()
    {
        $id = Yii::$app->request->get( 'id' );
        $model = ProjectPublic::findOne( $id );
        $model->delete();
        return $this->redirect( ['index'] );
    }


    /**
     * @return \yii\web\Response
     */
    public function actionAddPublicDocument()
    {
        $request = Yii::$app->request;
        $publicDocument = new ProjectPublic();
        $publicDocument->title = $request->post( 'name' );
        $publicDocument->project_id = Project::findProjectId();
        $publicDocument->public_type_id = $request->post( 'ProjectPublic' )['public_type_id'];
        $publicDocument->save();
        return $this->redirect( ['index'] );
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $projectId = Project::findProjectId();
        if ($projectId && Advise::find()->where( ['project_id' => $projectId] )->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER] )->one()) {
            $data = $this->prepareDocumentData();
            $public = ProjectPublic::find()->where( ['project_id' => Project::findProjectId()] )->all();
            return $this->render( 'index', [
                'model' => new ProjectDocument(),
                'data' => $data,
                'public' => $public,
                'publicDocument' => new ProjectPublic()] );
        } else {
            Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'You Not Have Adviser' ) );
            return $this->redirect( Yii::$app->request->referrer );
        }

    }

    /**
     * @return \yii\web\Response
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $doc_type = $request->post( 'doc_type' );
            $doc_id = $request->post( 'doc_id' );
            if ($doc_id == self::IS_NOT_PUBLIC_DOCUMENT) {
                $model = new ProjectDocument();
                //Initial Value
                $model->project_id = Project::findProjectId();
                $model->document_type_id =$doc_type;
                $model->file_type_id = $this->getFileType();
            } else {
                $model = new PublicDocument();
                $model->file_type_id = $this->getFileType();
                $model->project_public_id = $doc_id;
            }
//            $model->status = self::DOCUMENT_STATUS_PENDING; //** 0 is pending */

            if ($this->getFileType() == self::FILE_TYPE_URL) {
                $model->path = $request->post( 'url' );
                // If database have old pending data
                // It's will be deleted
                $this->deleteOldFile( $doc_type );
                $model->save();

            } else {
                // Begin of file uploading
                try {
                    $model->path = UploadedFile::getInstance( new ProjectDocument(), 'path' );
                    // If database have old pending data
                    // It's will be deleted
                    $this->deleteOldFile( $doc_type );
                    $model->path = $model->uploadFile(); //method return ชื่อไฟล์
                    $model->save();
                    Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
                } catch (Exception $e) {
                    Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
                }
            }
        }
        return $this->redirect( ['index'] );
    }

    /**
     * @return mixed
     * get file extension from input file
     */
    private function getFileExtension()
    {
        $fileName = $_FILES['ProjectDocument']['name']['path'];
        $extension = $ext = pathinfo( $fileName, PATHINFO_EXTENSION );
        return strtolower( $extension );
    }

    /**
     * @return bool|int
     * get file type for insert to database
     */
    private function getFileType()
    {
        if (Yii::$app->request->post( 'file_type' ) == "url") {
            return self::FILE_TYPE_URL;
        }
        $ext = $this->getFileExtension();
        if ($ext == 'doc' || $ext == 'docx') {
            return 2;
        } else if ($ext == 'ppt' || $ext == 'pptx') {
            return 3;
        } else if ($ext == 'pdf') {
            return 1;
        } else if ($ext == 'png' | $ext == 'jpg' | $ext == 'jpeg') {
            return 4;
        } else {
            return false;
        }
    }

    /**
     * @param $docType
     * @return bool
     * this method used to check old pending file
     * if found will be deleted
     */
    private function deleteOldFile($docType)
    {
        $doc_id = Yii::$app->request->post( 'doc_id' );
        if ($doc_id == self::IS_NOT_PUBLIC_DOCUMENT) {
            $model = ProjectDocument::find()->where( ['project_id' => Project::findProjectId()] )
                ->andWhere( ['document_type_id' => $docType] )
                ->andWhere( ['file_type_id' => $this->getFileType()] )
                ->one();
        } else {
            $model = PublicDocument::find()->where( ['project_public_id' => $doc_id] )
                ->andWhere( ['file_type_id' => $this->getFileType()] )
                ->one();
        }
        if ($model) {
            try {
                if ($this->getFileType() != self::FILE_TYPE_URL && file_exists( Yii::getAlias( '@webroot' ) . '/' . $model->filePath )) {
                    unlink( Yii::getAlias( '@webroot' ) . '/' . $model->filePath ); //ลบไฟล์ออก
                }
                $model->delete();
                return true;
            } catch (Exception $e) {
                return false;
            }
        } else {
            return false;
        }

    }

    /**
     * @return mixed
     * prepare document data to show in index view
     */
    public function prepareDocumentData()
    {
        foreach (DocumentType::find()->all() as $documentType) {
            $data[$documentType->id] = $this->getDocumentData( $documentType->id );
        }
        return $data;
    }

    /**
     * @param $id
     * @return ProjectDocument
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = ProjectDocument::findOne( $id )) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }

    /**
     * @param $type
     * @return array|\yii\db\ActiveRecord[]
     */
    private function getDocumentData($type)
    {
        return ProjectDocument::find()->where( ['project_id' => Project::findProjectId()] )
            ->andWhere( ['document_type_id' => $type] )
            ->all();
    }
}