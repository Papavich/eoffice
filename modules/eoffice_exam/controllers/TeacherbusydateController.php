<?php

namespace app\modules\eoffice_exam\controllers;

use Yii;
use app\modules\eoffice_exam\models\Busydate;
use app\modules\eoffice_exam\models\BusydateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeacherbusydateController implements the CRUD actions for Busydate model.
 */
class TeacherbusydateController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Busydate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BusydateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Busydate model.
     * @param string $exam_busydate_date
     * @param string $exam_busydate_time
     * @param integer $person_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($exam_busydate_date, $exam_busydate_time, $person_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($exam_busydate_date, $exam_busydate_time, $person_id),
        ]);
    }

    /**
     * Creates a new Busydate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Busydate();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->exam_busy_file = $model->upload($model,'exam_busy_file');
            $model->save();
            return $this->redirect(['view', 'exam_busydate_date' => $model->exam_busydate_date, 'exam_busydate_time' => $model->exam_busydate_time, 'person_id' => $model->person_id]);
        }else {
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    }

    /**
     * Updates an existing Busydate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $exam_busydate_date
     * @param string $exam_busydate_time
     * @param integer $person_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($exam_busydate_date, $exam_busydate_time, $person_id)
    {
        $model = $this->findModel($exam_busydate_date, $exam_busydate_time, $person_id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->exam_busy_file = $model->upload($model,'exam_busy_file');
            $model->save();
            return $this->redirect(['view', 'exam_busydate_date' => $model->exam_busydate_date, 'exam_busydate_time' => $model->exam_busydate_time, 'person_id' => $model->person_id]);
        } else {
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    }

    /**
     * Deletes an existing Busydate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $exam_busydate_date
     * @param string $exam_busydate_time
     * @param integer $person_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($exam_busydate_date, $exam_busydate_time, $person_id)
    {
        $this->findModel($exam_busydate_date, $exam_busydate_time, $person_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Busydate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $exam_busydate_date
     * @param string $exam_busydate_time
     * @param integer $person_id
     * @return Busydate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($exam_busydate_date, $exam_busydate_time, $person_id)
    {
        if (($model = Busydate::findOne(['exam_busydate_date' => $exam_busydate_date, 'exam_busydate_time' => $exam_busydate_time, 'person_id' => $person_id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actioncheckbusydate()
    {
      return $this->redirect(['checkbusydate']);
    }

}
