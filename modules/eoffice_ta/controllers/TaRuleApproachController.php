<?php

namespace app\modules\eoffice_ta\controllers;

use Yii;
use app\modules\eoffice_ta\models\TaRuleApproach;
use app\modules\eoffice_ta\models\TaRuleApproachSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaRuleApproachController implements the CRUD actions for TaRuleApproach model.
 */
class TaRuleApproachController extends Controller
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
     * Lists all TaRuleApproach models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaRuleApproachSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "main_modules";
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaRuleApproach model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TaRuleApproach model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaRuleApproach();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->layout = "main_modules";
            return $this->redirect(['view', 'id' => $model->ta_rule_approach_id]);
        } else {
            $this->layout = "main_modules";
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaRuleApproach model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->layout = "main_modules";
            return $this->redirect(['view', 'id' => $model->ta_rule_approach_id]);
        } else {
            $this->layout = "main_modules";
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaRuleApproach model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        $this->layout = "main_modules";
        return $this->redirect(['index']);
    }

    /**
     * Finds the TaRuleApproach model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaRuleApproach the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaRuleApproach::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
