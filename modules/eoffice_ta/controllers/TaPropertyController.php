<?php

namespace app\modules\eoffice_ta\controllers;

use Yii;
use app\modules\eoffice_ta\models\TaProperty;
use app\modules\eoffice_ta\models\TaPropertySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaPropertyController implements the CRUD actions for TaProperty model.
 */
class TaPropertyController extends Controller
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

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all TaProperty models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = TaProperty::find()->orderBy(['crtime'=>SORT_DESC,'udtime'=>SORT_DESC])->all();
        $searchModel = new TaPropertySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "main_modules";
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Rules' => $model,
        ]);
    }

    /**
     * Displays a single TaProperty model.
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
     * Creates a new TaProperty model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaProperty();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->crtime = date('Y-m-d H:i:s');
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['index']);
        } else {
            $this->layout = "main_modules";
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionActive($id)
    {
        $model = $this->findModel($id);
        $model->active_status;
        if ($model->save()) {
            //TaHrPay::updateAll(['active_status'=>1],['ta_hr_pay_id'=>$id]);
            if ($model->active_status == '1') {
                //TaHrPay::updateAll(['active_status'=>'0'],['ta_hr_pay_id'=>$id]);
                $model->update($model->active_status = '0');

            } elseif ($model->active_status == '0') {
                $model->update($model->active_status = '1');
                //TaHrPay::updateAll(['active_status'=>0],['ta_hr_pay_id'=>$id]);
            }
            return $this->redirect(['index']);
        }
    }


    /**
     * Updates an existing TaProperty model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())  ) {
            $model->udtime = date('Y-m-d H:i:s');
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect('index');
        } else {
            $this->layout = "main_modules";
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaProperty model.
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
     * Finds the TaProperty model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaProperty the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaProperty::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
