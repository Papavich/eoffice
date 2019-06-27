<?php

namespace app\modules\eoffice_repair\controllers;

use Yii;
use app\modules\eoffice_repair\models\RepairDescription;
use app\modules\eoffice_repair\models\RepairDescriptionSearch;
use app\modules\eoffice_repair\models\RepDesSearch;
use app\modules\eoffice_repair\models\RepEditStatus;
use app\modules\eoffice_repair\models\RepairTracking;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * RepairDescriptionController implements the CRUD actions for RepairDescription model.
 */
class RepairDescriptionController extends Controller
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
     * Lists all RepairDescription models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";

        $searchModel = new RepEditStatus();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListRepair()
    {
        $model = new RepairDescription();
        $searchModel = new RepDesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider = new ActiveDataProvider([
        //                'query' => $query,
        //                'sort'=> ['defaultOrder' => ['rep_desc_id'=>SORT_DESC]]
    // ]);

        $this->layout = "main_modules";

        return $this->render('list_repair', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }
    public function actionManage()
    {
        $model = new RepairDescription();
        $searchModel = new RepairDescriptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "main_modules";

        return $this->render('manage', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }
    public function actionShow()
    {
        $model = new RepairDescription();
        $searchModel = new RepairDescriptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "main_modules";

        return $this->render('manage_list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }


    /**
     * Displays a single RepairDescription model.
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
    public function actionView2($id)
    {

        $this->layout = "main_modules";

        return $this->render('view2', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new RepairDescription model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = "main_modules";

        $model = new RepairDescription();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->rep_desc_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RepairDescription model.
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
            return $this->redirect(['view', 'id' => $model->rep_desc_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdate2($id)
    {
      $track = new RepairTracking();
    $model = $this->findModel($id);
    $this->layout = "main_modules";

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      $track->rep_desc_id=$model->rep_desc_id;
      $track->rep_status_id=$model->rep_status_id;
      $track->rep_tracking_date=date("Y-m-d");
      $track->save();
      // var_dump($track->errors);
      // die();

      return $this->redirect(['view', 'id' => $model->rep_desc_id]);

    } else {
      return $this->render('update2', [
        'model' => $model,
      ]);
        //
        // $this->layout = "main_modules";
        //
        // $model = $this->findModel($id);
        //
        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->rep_desc_id]);
        // }
        //
        // return $this->render('update2', [
        //     'model' => $model,
        // ]);
    }
  }
    // public function actionUpdateList($id)
    // {
    //     $this->layout = "main_modules";
    //
    //     $model = $this->findModel($id);
    //
    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->rep_desc_id]);
    //     }
    //
    //     return $this->render('update2', [
    //         'model' => $model,
    //     ]);
    // }
    /**
     * Deletes an existing RepairDescription model.
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

    /**
     * Finds the RepairDescription model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RepairDescription the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = RepairDescription::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
