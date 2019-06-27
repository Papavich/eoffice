<?php

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\FileUpload;
use app\modules\scholar_b\models\ScbStaff;
use Yii;
use yii\helpers\Html;
use app\modules\scholar_b\models\ScbNews;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\data\Pagination;

/**
 * NewsController implements the CRUD actions for ScbNews model.
 */
class NewsController extends Controller
{

    const NEWS_PAGE_SIZE = 10;
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
     * Lists all ScbNews models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = ScbNews::find()->orderBy( 'udtime DESC' );
        $countQuery = clone $query;
        $pages = new Pagination( ['totalCount' => $countQuery->count(), 'pageSize' => self::NEWS_PAGE_SIZE] );
        $models = $query->offset( $pages->offset )
            ->limit( $pages->limit )
            ->all();
        return $this->render( 'index', [
            'model' => $models,
            'pages' => $pages,
        ] );
    }

    /**
     * Displays a single ScbNews model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = "main_module";
        $model_news = ScbNews::find()
            ->where(['news_id' => $id])
            ->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'model_news' => $model_news
        ]);
    }

    /**
     * Creates a new ScbNews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddnews()
    {
        $model = new ScbNews();
        $model_file = new  FileUpload();
        if ($model->load(Yii::$app->request->post())) {
            $model->save();

            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app',Html::encode('บันทึกข้อมูลเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);

            return $this->redirect(['view',
                'id' => $model->news_id,
                'staff_id_card' => $model->staff_id_card
            ]);
        }

        return $this->render('addnews', [
            'model' => $model,
            'model_file' => $model_file
        ]);
    }

    /**
     * Updates an existing ScbNews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_file = new  FileUpload();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

                Yii::$app->getSession()->setFlash('alert3', [
                    'type' => 'info',
                    'duration' => 12000,
                    'icon' => 'fa fa-users',
                    'title' => Yii::t('app', Html::encode('Submission')),
                    'message' => Yii::t('app', Html::encode('แก้ไขข้อมูลสำเร็จ')),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

            return $this->redirect(['view', 'id' => $model->news_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'model_file' => $model_file
        ]);
    }

    /**
     * Deletes an existing ScbNews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteone($id)
    {
        if($model = $this->findModel($id)->delete()) {

            Yii::$app->getSession()->setFlash('alert2', [
                'type' => 'danger',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Alert')),
                'message' => Yii::t('app', Html::encode('ลบข่าวสำเร็จ')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);

            return $this->redirect(['index',
                'model' => $model]);
        }
    }

    /* */

    public function actionImageUpload($id)
    {
       // $model = new ScbNews();
        //$imageFile = UploadedFile::getInstance($model, 'news_image');
        $model_file_upload = new FileUpload();
        $imageFile = UploadedFile::getInstance($model_file_upload, 'news_image');

        $directory = Yii::getAlias('../web/web_scb/uploads/news') . DIRECTORY_SEPARATOR;
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }

        if ($imageFile) {
            //$fileName = date("dmYHis") . '-' . $imageFile;
            $fileName = date("dmY") . '-' . $imageFile; //ของใหม่
            $filePath = $directory . $fileName;
            if ($imageFile->saveAs($filePath)) {
                $path = 'news' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
                $_SESSION['fileName'] = $fileName;
                return Json::encode([
                    'files' => [
                        [
                            'name' => $fileName,
                            'size' => $imageFile->size,
                            'url' => $path,
                            'thumbnailUrl' => $path,
                            'deleteUrl' => 'image-delete?name=' . $fileName,
                            'deleteType' => 'POST',
                        ],
                    ],
                ]);
            }
        }

        return '';
    }

    public function actionImageDelete($name)
    {
        $directory = Yii::getAlias('../web/web_scb/uploads/news') . DIRECTORY_SEPARATOR . Yii::$app->session->id;
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }

        $files = FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file) {
            $fileName = basename($file);
            $path = 'news' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
            $output['files'][] = [
                'name' => $fileName,
                'size' => filesize($file),
                'url' => $path,
                'thumbnailUrl' => $path,
                'deleteUrl' => 'image-delete?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        return Json::encode($output);
    }

    /**
     * Finds the ScbNews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ScbNews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ScbNews::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
