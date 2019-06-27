<?php

namespace app\modules\eoffice_ta\controllers;

use app\modules\eproject\models\News;
use Yii;
use app\modules\eoffice_ta\models\TaNews;
use app\modules\eoffice_ta\models\TaNewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;


/**
 * TaNewsController implements the CRUD actions for TaNews model.
 */
class TaNewsController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all TaNews models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaNewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = TaNews::find()->all();

        $this->layout = "main_modules";
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single TaNews model.
     * @param integer $id
     * @return mixed
     */
   /* public function actionView($id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }*/
    public function actionDetail($id){
        $this->layout = "main_modules";
        return $this->render('detail', [
            'model' => $this->findModel($id),
            //'method'=>'GET'
        ]);
    }
    public function actionView($id){
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($id),
            //'method'=>'GET'
        ]);
    }

    /**
     * Creates a new TaNews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaNews();

        if /*($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->ta_news_img = $model->upload($model,'ta_news_img');
            $model->ta_news_imgs = $model->uploadMultiple($model,'ta_news_imgs');
            $model->save();*/
        ($model->load( Yii::$app->request->post() ) ) {
            $model->ta_status = 'NEWS-PUBLIC';
            $model->save();
            Yii::$app->session->setFlash( 'success', "เพิ่มข่าวสำเร็จ" );
            $this->layout = "main_modules";
            return $this->redirect(['view', 'id' => $model->ta_news_id]);
        } else {
            $this->layout = "main_modules";
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaNews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
  /*  public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_img = $model->ta_news_img;
        $old_imgs = $model->ta_news_imgs;
        if ($model->load(Yii::$app->request->post())) {
            $imgage = UploadedFile::getInstance($model, 'ta_news_img');
            $imgages = UploadedFile::getInstances($model, 'ta_news_imgs');
            if (isset($imgage) && ($imgages)) {
                $model->ta_news_img = $imgage->baseName . '.' . $imgage->extension;
                foreach ($imgages as $imgs) {
                    $model->ta_news_imgs = $imgs->baseName . '.' . $imgs->extension;
                }
            } else {
                $model->ta_news_img = $old_img;
                $model->ta_news_imgs = $old_imgs;
            }
            if ($model->save()) {
                if (isset($imgage)) {
                    $imgage->saveAs(Yii::getAlias('@web/web_ta/images/upload/') .$model->ta_news_img);
                }
                if (isset($imgages)) {
                    $path = Yii::getAlias('@web/web_ta/images/upload/');
                    $photoes = [];
                    foreach ($imgages as $imgs) {
                        $file_name = $imgs->baseName . '.' . $imgs->extension;
                        if ($imgs->saveAs($path . $file_name)) {
                            $photoes[] = $model->ta_news_imgs;
                        }
                        $model->ta_news_imgs = $photoes;
                        if ($model->isNewRecord) {
                            return implode(',', $photoes);
                        } else {
                            return implode(',', (ArrayHelper::merge($photoes, $model->getOwnPhotosToArray())));
                        }
                    }
                }
            }
               // return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
                $this->layout = "main_modules";
                return $this->redirect(['view', 'id' => $model->ta_news_id]);
            } else {
                $this->layout = "main_modules";
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }*/

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load( Yii::$app->request->post() )) {

            $model->save();
            Yii::$app->session->setFlash( 'success', "แก้ไขข้อมูลสำเร็จ" );
            $this->layout = "main_modules";
            return $this->redirect( ['view', 'id' => $model->ta_news_id] );
        } else {
            $this->layout = "main_modules";
            return $this->render( 'update', [
                'model' => $model,
            ] );
        }
    }

   /* public function Update($id)
    {
        $model = $this->findModel($id);
        $oldImage = $model->d_img_path;
        if ($model->load(Yii::$app->request->post()))
        {
            $image = UploadedFile::getInstance($model, 'd_img_path');
            if(isset($image)){
                $model->d_img_path=  $model->d_nic.'.'.$image->extension;
            } else {
                $model->d_img_path = $oldImage;
            }
            if($model->save())
            {
                if(isset($image)){
                    $image->saveAs('uploads/'.$model->d_img_path);
                }
            }
            return $this->redirect('view');
        }
    }
   */

    /**
     * Deletes an existing TaNews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        @unlink(Yii::getAlias('@webroot').'/web_ta/images'
            .$model->upload_folder.'/'.$model->ta_news_img);
        @unlink(Yii::getAlias('@webroot').'/web_ta/images'
            .$model->upload_folder.'/'.$model->ta_news_imgs);
        $model->delete();

        $this->layout = "main_modules";
        return $this->redirect(['index']);
    }

    /**
     * Finds the TaNews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaNews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaNews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    //-----------------------------ABOUT UPLOAD--------------------------------------------
    /*private function getInitialPreview($img) {
        $datas = TaNews::find()->where(['ta_news_imgs'=>$img])->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $key => $value) {
            array_push($initialPreview, $this->getTemplatePreview($value));
            array_push($initialPreviewConfig, [
                'caption'=> $value->file_name,
                'width' => '120px',
                'url' => Url::to(['/freelance/deletefile-ajax']),
                'key' => $value->upload_id
            ]);
        }
        return [$initialPreview,$initialPreviewConfig];
    }
    public function isImage($filePath){
        return @is_array(getimagesize($filePath)) ? true : false;
    }
    private function getTemplatePreview(Uploads $model){
        $filePath = Freelance::getUploadUrl().$model->ref.'/thumbnail/'.$model->real_filename;
        $isImage = $this->isImage($filePath);
        if($isImage){
            $file = Html::img($filePath,['class'=>'file-preview-image',
                'alt'=>$model->file_name, 'title'=>$model->file_name]);
        }else{
            $file = "<div class='file-preview-other'> " .
                     "<h2><i class='glyphicon glyphicon-file'></i></h2>" . "</div>";
        }
        return $file;
    }
    private function createThumbnail($folderName,$fileName,$width=250){
        $uploadPath = Freelance::getUploadPath().'/'.$folderName.'/';
        $file = $uploadPath.$fileName;
        $image = Yii::$app->image->load($file);
        $image->resize($width);
        $image->save($uploadPath.'thumbnail/'.$fileName);
        return;
    }
    public function actionDeletefileAjax(){
        $model = TaNews::findOne(Yii::$app->request->post('key'));
        if($model!==NULL){
            $filename = Freelance::getUploadPath().$model->ref.'/'.$model->real_filename;
            $thumbnail = Freelance::getUploadPath().$model->ref.'/thumbnail/'.$model->real_filename;
         if($model->delete()){
              @unlink($filename);
              @unlink($thumbnail);
              echo json_encode(['success'=>true]);
         }else{
              echo json_encode(['success'=>false]);
          }
         }else{
            echo json_encode(['success'=>false]);
        }
    }
    public function actionDelete0($id)
    {
        $model = $this->findModel($id);
     //remove upload file & data
        $this->removeUploadDir($model->ref);
        TaNews::deleteAll(['ref'=>$model->ref]);
        $model->delete();
        return $this->redirect(['index']);
    }
    */
}
