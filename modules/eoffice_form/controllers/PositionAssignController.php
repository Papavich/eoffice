<?php

namespace app\modules\eoffice_form\controllers;

use Yii;
use app\modules\eoffice_form\models\PositionAssign;
use app\modules\eoffice_form\models\PositionAssignSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PositionAssignController implements the CRUD actions for PositionAssign model.
 */
class PositionAssignController extends Controller
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
     * Lists all PositionAssign models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new PositionAssign();
        $this->layout = "main_modules";
        $searchModel = new PositionAssignSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single PositionAssign model.
     * @param integer $position_id
     * @param integer $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($position_id, $user_id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($position_id, $user_id),
        ]);
    }

    /**
     * Creates a new PositionAssign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = "main_modules";
        $model = new PositionAssign();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'position_id' => $model->position_id, 'user_id' => $model->user_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PositionAssign model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $position_id
     * @param integer $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($position_id, $user_id)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($position_id, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'position_id' => $model->position_id, 'user_id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PositionAssign model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $position_id
     * @param integer $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($position_id, $user_id)
    {
        $this->layout = "main_modules";
        $this->findModel($position_id, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PositionAssign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $position_id
     * @param integer $user_id
     * @return PositionAssign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($position_id, $user_id)
    {
        if (($model = PositionAssign::findOne(['position_id' => $position_id, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
