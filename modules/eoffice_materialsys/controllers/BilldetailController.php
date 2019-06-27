<?php

namespace app\modules\eoffice_materialsys\controllers;

use Yii;
use app\modules\eoffice_materialsys\models\MatsysBillDetail;
use app\modules\eoffice_materialsys\models\MatsysBillDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BillDetailController implements the CRUD actions for MatsysBillDetail model.
 */
class BilldetailController extends Controller
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
     * Lists all MatsysBillDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MatsysBillDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MatsysBillDetail model.
     * @param string $material_id
     * @param string $bill_master_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($material_id, $bill_master_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($material_id, $bill_master_id),
        ]);
    }

    /**
     * Creates a new MatsysBillDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MatsysBillDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'material_id' => $model->material_id, 'bill_master_id' => $model->bill_master_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MatsysBillDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $material_id
     * @param string $bill_master_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($material_id, $bill_master_id)
    {
        $model = $this->findModel($material_id, $bill_master_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'material_id' => $model->material_id, 'bill_master_id' => $model->bill_master_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MatsysBillDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $material_id
     * @param string $bill_master_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($material_id, $bill_master_id)
    {
        $this->findModel($material_id, $bill_master_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MatsysBillDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $material_id
     * @param string $bill_master_id
     * @return MatsysBillDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($material_id, $bill_master_id)
    {
        if (($model = MatsysBillDetail::findOne(['material_id' => $material_id, 'bill_master_id' => $bill_master_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
