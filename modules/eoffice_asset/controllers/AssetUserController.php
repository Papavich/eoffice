<?php

namespace app\modules\eoffice_asset\controllers;

use Yii;
use app\modules\eoffice_asset\models\AssetDetail;
use app\modules\eoffice_asset\models\AssetDetailStatus;
use app\modules\eoffice_asset\models\AssetUserSearch;
use app\modules\eoffice_asset\models\EofficeCentralViewPisPerson;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AssetUserController implements the CRUD actions for AssetDetail model.
 */
class AssetUserController extends Controller
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

    /**
     * Lists all AssetDetail models.
     * @return mixed
     */
    public function actionIndex()
    {

        $this->layout = "main_modules"; //ทีม

        $model = new AssetDetail();
        $status = new AssetDetailStatus();
        $searchModel = new AssetUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=> $model,
            'status' => $status,

        ]);
    }

    /**
     * Displays a single AssetDetail model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = "main_modules"; //ทีม

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewBorrow($id)
    {
        $this->layout = "main_modules"; //ทีม

        return $this->render('view_borrow', [

        ]);
    }

    public function actionCart($id = null)
    {
        if(!intval($id)|| empty($id)) {
            Yii::$app->session->setFlash('error','cannot find this Asset!');
    }


    }
    /**
     * Creates a new AssetDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = "main_modules"; //ทีม
        $model = new AssetDetail();
        $person = new EofficeCentralViewPisPerson();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->asset_detail_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'person' => $person,
        ]);
    }

    /**
     * Updates an existing AssetDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->asset_detail_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AssetDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    /*=================================add cart ===========================================*/























    /**
     * Finds the AssetDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AssetDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AssetDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
