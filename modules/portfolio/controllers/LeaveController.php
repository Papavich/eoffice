<?php

namespace app\modules\portfolio\controllers;

use Yii;
use app\modules\portfolio\models\Leave;
use app\modules\portfolio\models\LeaveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Carbon\Carbon;

/**
 * LeaveController implements the CRUD actions for Leave model.
 */
class LeaveController extends BackendController
{
    /**
     * @inheritdoc
     */
   /* public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }*/

    /**
     * Lists all Leave models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LeaveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Leave model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //$model = $this->findModel($id);
       $model = Leave::find()->with('person')->where(['id' => $id])->one();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Leave model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Leave();
        $model->leave_status = '0';
        
       

        if ($model->load(Yii::$app->request->post())) {
         
            //หาผลต่างระหว่างวัน
            $dt2 = Carbon::createFromFormat('Y-m-d', $model->leave_date_end);
            $dt1 = Carbon::createFromFormat('Y-m-d', $model->leave_date_start);
            $leave_num = $dt2->diffInDays($dt1) + 1; 
            //หากอยากเช็คความถูกต้องของการเลือกวันที่ใช้ตัวแปร $leave_num ได้นะครับ เช่น เป็น 0 หรือ ติดลบ หรือไม่
            
            if ($model->leave_day == "เต็มวัน") {
               $model->leave_num = $leave_num;
            } else {
               $model->leave_num = 0.5;
            }
            
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Leave model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            //หาผลต่างระหว่างวัน
            $dt2 = Carbon::createFromFormat('Y-m-d', $model->leave_date_end);
            $dt1 = Carbon::createFromFormat('Y-m-d', $model->leave_date_start);
            $leave_num = $dt2->diffInDays($dt1) + 1; 
            //หากอยากเช็คความถูกต้องของการเลือกวันที่ใช้ตัวแปร $leave_num ได้นะครับ เช่น เป็น 0 หรือ ติดลบ หรือไม่
            
            if ($model->leave_day == "เต็มวัน") {
               $model->leave_num = $leave_num;
            } else {
               $model->leave_num = 0.5;
            }
            
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Leave model.
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
     * Finds the Leave model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Leave the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Leave::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
