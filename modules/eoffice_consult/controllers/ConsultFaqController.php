<?php

namespace app\modules\eoffice_consult\controllers;

use Yii;
use app\modules\eoffice_consult\models\ConsultFaq;
use app\modules\eoffice_consult\models\ConsultFaqSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ConsultFaqController extends \yii\web\Controller
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
   * Lists all ConsultFaq models.
   * @return mixed
   */
  public function actionIndex()
  {
        $this->layout = "main_modules";
      $searchModel = new ConsultFaqSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('index', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);
  }

  public function actionIndex0()
  {
        $this->layout = "main_modules";
      $searchModel = new ConsultFaqSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('index0', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);
  }

  /**
   * Displays a single ConsultFaq model.
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
   * Creates a new ConsultFaq model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
        $this->layout = "main_modules";
      $model = new ConsultFaq();

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['index', 'id' => $model->faq_id]);
      }

      return $this->render('create', [
          'model' => $model,
      ]);
  }

  /**
   * Updates an existing ConsultFaq model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
        $this->layout = "main_modules";
      $model = $this->findModel($id);

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['index', 'id' => $model->faq_id]);
      }

      return $this->render('update', [
          'model' => $model,
      ]);
  }

  /**
   * Deletes an existing ConsultFaq model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
        $this->layout = "main_modules";
      $this->findModel($id)->delete();

      return $this->redirect(['index']);
  }

  /**
   * Finds the ConsultFaq model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return ConsultFaq the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
      if (($model = ConsultFaq::findOne($id)) !== null) {
          return $model;
      }

      throw new NotFoundHttpException('The requested page does not exist.');
  }

}
