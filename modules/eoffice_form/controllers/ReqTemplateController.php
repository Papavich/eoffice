<?php

namespace app\modules\eoffice_form\controllers;

use app\modules\eoffice_form\models\ApproveGroup;
use app\modules\eoffice_form\models\AttributeData;
use app\modules\eoffice_form\models\DesignAttribute;
use app\modules\eoffice_form\models\DesignSection;
use app\modules\eoffice_form\models\DesignSectionSearch;
use app\modules\requestform\models\Template;
use Yii;
use app\modules\eoffice_form\models\ReqTemplate;
use app\modules\eoffice_form\models\ReqTemplateSearch;
use app\modules\eoffice_form\models\ApproveGroupSearch;
use app\modules\eoffice_form\models\Section;
use app\modules\eoffice_form\models\SectionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * ReqTemplateController implements the CRUD actions for ReqTemplate model.
 */
class ReqTemplateController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }

    //Upload File//
    private function uploadSingleFile($model,$tempFile=null){
        $file = [];
        $json = '';
        try {
            $UploadedFile = UploadedFile::getInstance($model,'template_file');
            if($UploadedFile !== null){
                $oldFileName = $UploadedFile->basename.'.'.$UploadedFile->extension;
                $newFileName = md5($UploadedFile->basename.time()).'.'.$UploadedFile->extension;
                $UploadedFile->saveAs(ReqTemplate::UPLOAD_FOLDER.'/'.$model->template_id.'/'.$newFileName);
                $file[$newFileName] = $oldFileName;
                $json = Json::encode($file);
            }else{
                $json=$tempFile;
            }
        } catch (Exception $e) {
            $json=$tempFile;
        }
        return $json ;
    }
    //Upload File//

    //Storage Folder//
    private function CreateDir($folderName){
        if($folderName != NULL){
            $basePath = ReqTemplate::getUploadPath();
            if(BaseFileHelper::createDirectory($basePath.$folderName,0777)){
                BaseFileHelper::createDirectory($basePath.$folderName.'/thumbnail',0777);
            }
        }
        return;
    }
    //Storage Folder //

    //Download File//
    public function actionDownload($id,$file,$file_name){
        $model = $this->findModel($id);
        if(!empty($model->template_id) && !empty($model->template_file)){
            Yii::$app->response->sendFile($model->getUploadPath().''.$model->template_id.'/'.$file,$file_name);
        }else{
            $this->redirect(['/req-template/view','id'=>$id]);
        }
    }
    //Download File//

    public function actionDeletefile($id,$field,$fileName){
        $status = ['success'=>false];
        if(in_array($field, ['template_file'])){
            $model = $this->findModel($id);
            $files =  Json::decode($model->{$field});
            if(array_key_exists($fileName, $files)){
                if($this->deleteFile('file',$model->template_id,$fileName)){
                    $status = ['success'=>true];
                    unset($files[$fileName]);
                    $model->{$field} = Json::encode($files);
                    $model->save();
                }
            }
        }
        echo json_encode($status);
    }

    private function deleteFile($type='file',$ref,$fileName){
        if(in_array($type, ['file','thumbnail'])){
            if($type==='file'){
                $filePath = ReqTemplate::getUploadPath().$ref.'/'.$fileName;
            } else {
                $filePath = ReqTemplate::getUploadPath().$ref.'/thumbnail/'.$fileName;
            }
            @unlink($filePath);
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Lists all ReqTemplate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new ReqTemplateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReqTemplate model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = "main_modules";

        $session = Yii::$app->session;
        $session['template_id']= $id;

        $searchModel = new DesignSectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$session['template_id']= $id;

        $ApproveSearchModel = new ApproveGroupSearch();
        $ApproveDataProvider = $ApproveSearchModel->search(Yii::$app->request->queryParams);

        $designSection = new DesignSection();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ApproveSearchModel' => $ApproveSearchModel,
            'ApproveDataProvider' => $ApproveDataProvider,

            'designSection' => $designSection,

        ]);
    }

    /**
     * Creates a new ReqTemplate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
    public function actionCreate()
    {
        $this->layout = "main_modules";
        $model = new ReqTemplate();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->template_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    */

    public function actionCreate()
    {
        $this->layout = "main_modules";
        $model = new ReqTemplate();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->CreateDir($model->template_id);
            $model->template_file = $this->uploadSingleFile($model);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->template_id]);
            }
        } else {
            $model->template_id = substr(Yii::$app->getSecurity()->generateRandomString(),10);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ReqTemplate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionUpdate($id)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->template_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }*/

    public function actionUpdate($id)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($id);
        $tempTemplate = $model->template_file;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->template_file = $this->uploadSingleFile($model,$tempTemplate);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->template_id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing ReqTemplate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $this->findModel($id)->delete();
        $this->layout = "main_modules";
        return $this->redirect(['req-template/index']);
    }

    /**
     * Finds the ReqTemplate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReqTemplate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReqTemplate::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPreview($id)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($id);

            return $this->render('preview', [
                'model' => $model,
            ]);

    }



}
