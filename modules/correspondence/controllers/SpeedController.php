<?php

namespace app\modules\correspondence\controllers;

use Yii;
use app\modules\correspondence\models\CmsDocSpeed;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SpeedController implements the CRUD actions for CmsDocSpeed model.
 */
class SpeedController extends Controller
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
     * Lists all CmsDocSpeed models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CmsDocSpeed::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsDocSpeed model.
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
     * Creates a new CmsDocSpeed model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmsDocSpeed();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['setting/setting-document#ttab1_nobg', 'model_speed' => CmsDocSpeed::find()->all()]);
        } else {
            return $this->render('create', [
                'model_speed' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CmsDocSpeed model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->layout = "main_module";
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['setting/setting-document#ttab1_nobg', 'model_speed' => CmsDocSpeed::find()->all()]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CmsDocSpeed model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $model = $this->findModel($_POST['id']);
        $model->delete();
        //return $this->redirect(['staff/setting-document']);
    }

    /**
     * Finds the CmsDocSpeed model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsDocSpeed the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsDocSpeed::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
