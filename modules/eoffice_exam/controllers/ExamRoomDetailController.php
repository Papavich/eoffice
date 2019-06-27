<?php

namespace app\modules\eoffice_exam\controllers;

use Yii;
use app\modules\eoffice_exam\models\ExamRoomDetail;
use app\modules\eoffice_exam\models\ExamRoomDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExamRoomDetailController implements the CRUD actions for ExamRoomDetail model.
 */
class ExamRoomDetailController extends Controller
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
     * Lists all ExamRoomDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExamRoomDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ExamRoomDetail model.
     * @param string $rooms_detail_date
     * @param string $rooms_detail_time
     * @param string $rooms_id
     * @param string $exam_room_tag
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($rooms_detail_date, $rooms_detail_time, $rooms_id, $exam_room_tag)
    {
        return $this->render('view', [
            'model' => $this->findModel($rooms_detail_date, $rooms_detail_time, $rooms_id, $exam_room_tag),
        ]);
    }

    /**
     * Creates a new ExamRoomDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ExamRoomDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'rooms_detail_date' => $model->rooms_detail_date, 'rooms_detail_time' => $model->rooms_detail_time, 'rooms_id' => $model->rooms_id, 'exam_room_tag' => $model->exam_room_tag]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ExamRoomDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $rooms_detail_date
     * @param string $rooms_detail_time
     * @param string $rooms_id
     * @param string $exam_room_tag
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($rooms_detail_date, $rooms_detail_time, $rooms_id, $exam_room_tag)
    {
        $model = $this->findModel($rooms_detail_date, $rooms_detail_time, $rooms_id, $exam_room_tag);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'rooms_detail_date' => $model->rooms_detail_date, 'rooms_detail_time' => $model->rooms_detail_time, 'rooms_id' => $model->rooms_id, 'exam_room_tag' => $model->exam_room_tag]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ExamRoomDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $rooms_detail_date
     * @param string $rooms_detail_time
     * @param string $rooms_id
     * @param string $exam_room_tag
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($rooms_detail_date, $rooms_detail_time, $rooms_id, $exam_room_tag)
    {
        $this->findModel($rooms_detail_date, $rooms_detail_time, $rooms_id, $exam_room_tag)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ExamRoomDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $rooms_detail_date
     * @param string $rooms_detail_time
     * @param string $rooms_id
     * @param string $exam_room_tag
     * @return ExamRoomDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($rooms_detail_date, $rooms_detail_time, $rooms_id, $exam_room_tag)
    {
        if (($model = ExamRoomDetail::findOne(['rooms_detail_date' => $rooms_detail_date, 'rooms_detail_time' => $rooms_detail_time, 'rooms_id' => $rooms_id, 'exam_room_tag' => $exam_room_tag])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
