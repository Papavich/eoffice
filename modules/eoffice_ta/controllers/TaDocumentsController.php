<?php

namespace app\modules\eoffice_ta\controllers;

use Yii;
use app\modules\eoffice_ta\models\TaDocuments;
use app\modules\eoffice_ta\models\TaDocumentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * TaDocumentsController implements the CRUD actions for TaDocuments model.
 */
class TaDocumentsController extends Controller
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
     * Lists all TaDocuments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = TaDocuments::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 6]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $searchModel = new TaDocumentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->layout = "main_modules";
        return $this->render('index', [
            'model' => $model,
            'pages' => $pages,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaDocuments model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

   /* public function actionDownload()
    {
        $file=Yii::$app->request->get('file');
        $path=Yii::$app->request->get('path');
        $root=Yii::getAlias('@webroot').$path.$file;
        if (file_exists($root)) {
            return Yii::$app->response->sendFile($root);
        } else {
            throw new \yii\web\NotFoundHttpException("{$file} is not found!");
        }
    }*/
    public function actionDownload($id)
    {
        $download = TaDocuments::findOne($id);
        $path = Yii::getAlias('@webroot').'/web_ta/files/'.$download->ta_documents_path;

        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        } else {
            throw new \yii\web\NotFoundHttpException("{$path} is not found!");
        }
    }
    /**
     * Creates a new TaDocuments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaDocuments();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->ta_documents_path = $model->upload($model,'ta_documents_path');
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['view','id'=>$model->ta_documents_id]);
        }
        $this->layout = "main_modules";
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TaDocuments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->ta_documents_path = $model->upload($model,'ta_documents_path');
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['view','id'=>$model->ta_documents_id]);
        }
        $this->layout = "main_modules";
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TaDocuments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        @unlink(Yii::getAlias('@webroot').'/web_ta/'
            .$model->upload_folder.'/'.$model->ta_documents_path);
        $model->delete();

        Yii::$app->session->setFlash('success', 'ลบข้อมูลเรียบร้อยแล้ว');
        $this->layout = "main_modules";
        return $this->redirect(['index']);

    }

    /**
     * Finds the TaDocuments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaDocuments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaDocuments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
