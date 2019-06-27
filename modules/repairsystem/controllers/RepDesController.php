<?php

namespace app\modules\repairsystem\controllers;

use Yii;
use app\modules\repairsystem\models\RepDes;
use app\modules\repairsystem\models\RepDesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* RepDesController implements the CRUD actions for RepDes model.
*/
class RepDesController extends Controller
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
  * Lists all RepDes models.
  * @return mixed
  */
  public function actionIndex()
  {
    $searchModel = new RepDesSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    $this->layout = "main_module";
    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
  * Displays a single RepDes model.
  * @param integer $id
  * @return mixed
  */
  public function actionView($id)
  {
    $this->layout = "main_module";
    return $this->render('view', [
      'model' => $this->findModel($id),
    ]);
  }

  /**
  * Creates a new RepDes model.
  * If creation is successful, the browser will be redirected to the 'view' page.
  * @return mixed
  */
  public function actionCreate()
  {
    $model = new RepDes();
    $this->layout = "main_module";
    if($model->load(Yii::$app->request->post())){


      $model['rep_photo_id'] = 1;
      $model->save();

    }

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->rep_des_id]);
    } else {
      return $this->render('create', [
        'model' => $model,
      ]);
    }
  }

  /**
  * Updates an existing RepDes model.
  * If update is successful, the browser will be redirected to the 'view' page.
  * @param integer $id
  * @return mixed
  */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);
    $this->layout = "main_module";

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->rep_des_id]);
    } else {
      return $this->render('update', [
        'model' => $model,
      ]);
    }
  }

  /**
  * Deletes an existing RepDes model.
  * If deletion is successful, the browser will be redirected to the 'index' page.
  * @param integer $id
  * @return mixed
  */
  public function actionDelete($id)
  {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  /**
  * Finds the RepDes model based on its primary key value.
  * If the model is not found, a 404 HTTP exception will be thrown.
  * @param integer $id
  * @return RepDes the loaded model
  * @throws NotFoundHttpException if the model cannot be found
  */
  protected function findModel($id)
  {
    if (($model = RepDes::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }
}
