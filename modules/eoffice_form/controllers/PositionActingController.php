<?php

namespace app\modules\eoffice_form\controllers;

use Yii;
use app\modules\eoffice_form\models\PositionActing;
use app\modules\eoffice_form\models\PositionActingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PositionActingController implements the CRUD actions for PositionActing model.
 */
class PositionActingController extends Controller
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

    /**
     * Lists all PositionActing models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new PositionActingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new PositionActing();


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single PositionActing model.
     * @param integer $position_id
     * @param integer $user_id
     * @param string $acting_startDate
     * @param string $acting_endDate
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($position_id, $user_id, $acting_startDate, $acting_endDate)
    {

        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($position_id, $user_id, $acting_startDate, $acting_endDate),
        ]);
    }

    /**
     * Creates a new PositionActing model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = "main_modules";
        $model = new PositionActing();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'position_id' => $model->position_id, 'user_id' => $model->user_id, 'acting_startDate' => $model->acting_startDate, 'acting_endDate' => $model->acting_endDate]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PositionActing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $position_id
     * @param integer $user_id
     * @param string $acting_startDate
     * @param string $acting_endDate
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($position_id, $user_id, $acting_startDate, $acting_endDate)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($position_id, $user_id, $acting_startDate, $acting_endDate);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'position_id' => $model->position_id, 'user_id' => $model->user_id, 'acting_startDate' => $model->acting_startDate, 'acting_endDate' => $model->acting_endDate]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PositionActing model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $position_id
     * @param integer $user_id
     * @param string $acting_startDate
     * @param string $acting_endDate
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($position_id, $user_id, $acting_startDate, $acting_endDate)
    {
        $this->layout = "main_modules";
        $this->findModel($position_id, $user_id, $acting_startDate, $acting_endDate)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PositionActing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $position_id
     * @param integer $user_id
     * @param string $acting_startDate
     * @param string $acting_endDate
     * @return PositionActing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($position_id, $user_id, $acting_startDate, $acting_endDate)
    {
        if (($model = PositionActing::findOne(['position_id' => $position_id, 'user_id' => $user_id, 'acting_startDate' => $acting_startDate, 'acting_endDate' => $acting_endDate])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
