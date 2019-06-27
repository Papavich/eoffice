<?php

namespace app\modules\eoffice_ta\controllers;

use Yii;
use app\modules\eoffice_ta\models\TaEquation;
use app\modules\eoffice_ta\models\TaEquationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaEquationController implements the CRUD actions for TaEquation model.
 */
class TaEquationController extends Controller
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
     * Lists all TaEquation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaEquationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "main_modules";
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaEquation model.
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

    /**
     * Creates a new TaEquation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaEquation();

        if ($model->load(Yii::$app->request->post()))  {
            $model->crtime = date('Y-m-d H:i:s');
            $model->save();
            return $this->redirect(['view', 'id' => $model->ta_equation_id]);
        }

        $this->layout = "main_modules";
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TaEquation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $model->udtime = date('Y-m-d H:i:s');
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['view', 'id' => $model->ta_equation_id]);
        }
        $this->layout = "main_modules";
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TaEquation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $this->layout = "main_modules";
        return $this->redirect(['index']);
    }

    /**
     * Finds the TaEquation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaEquation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaEquation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
