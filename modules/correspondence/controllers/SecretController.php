<?php

namespace app\modules\correspondence\controllers;

use Yii;
use app\modules\correspondence\models\CmsDocSecret;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SecretController implements the CRUD actions for CmsDocSecret model.
 */
class SecretController extends Controller
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
     * Lists all CmsDocSecret models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CmsDocSecret::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsDocSecret model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CmsDocSecret model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmsDocSecret();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['setting/setting-document#ttab2_nobg', 'model_secret' => CmsDocSecret::find()->all()]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CmsDocSecret model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->layout = "main_module";
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['setting/setting-document#ttab2_nobg', 'model_secret' => CmsDocSecret::find()->all()]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CmsDocSecret model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $model = $this->findModel($_POST['id']);
        $model->delete();
      //  return $this->redirect(['staff/setting-document#ttab2_nobg']);
    }

    /**
     * Finds the CmsDocSecret model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsDocSecret the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsDocSecret::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
