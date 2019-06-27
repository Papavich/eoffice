<?php

namespace app\modules\eoffice_exam\controllers;

use Yii;
use app\modules\eoffice_exam\models\EofficeExamExaminationItem;
use app\modules\eoffice_exam\models\EofficeExamExaminationItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentroomController implements the CRUD actions for EofficeExamExaminationItem model.
 */
class StudentroomController extends Controller
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
     * Lists all EofficeExamExaminationItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EofficeExamExaminationItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EofficeExamExaminationItem model.
     * @param string $STUDENTID
     * @param string $rooms_id
     * @param string $exam_date
     * @param string $exam_start_time
     * @param string $exam_end_time
     * @param string $subject_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($STUDENTID, $rooms_id, $exam_date, $exam_start_time, $exam_end_time, $subject_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($STUDENTID, $rooms_id, $exam_date, $exam_start_time, $exam_end_time, $subject_id),
        ]);
    }

    /**
     * Creates a new EofficeExamExaminationItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EofficeExamExaminationItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'STUDENTID' => $model->STUDENTID, 'rooms_id' => $model->rooms_id, 'exam_date' => $model->exam_date, 'exam_start_time' => $model->exam_start_time, 'exam_end_time' => $model->exam_end_time, 'subject_id' => $model->subject_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EofficeExamExaminationItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $STUDENTID
     * @param string $rooms_id
     * @param string $exam_date
     * @param string $exam_start_time
     * @param string $exam_end_time
     * @param string $subject_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($STUDENTID, $rooms_id, $exam_date, $exam_start_time, $exam_end_time, $subject_id)
    {
        $model = $this->findModel($STUDENTID, $rooms_id, $exam_date, $exam_start_time, $exam_end_time, $subject_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'STUDENTID' => $model->STUDENTID, 'rooms_id' => $model->rooms_id, 'exam_date' => $model->exam_date, 'exam_start_time' => $model->exam_start_time, 'exam_end_time' => $model->exam_end_time, 'subject_id' => $model->subject_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EofficeExamExaminationItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $STUDENTID
     * @param string $rooms_id
     * @param string $exam_date
     * @param string $exam_start_time
     * @param string $exam_end_time
     * @param string $subject_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($STUDENTID, $rooms_id, $exam_date, $exam_start_time, $exam_end_time, $subject_id)
    {
        $this->findModel($STUDENTID, $rooms_id, $exam_date, $exam_start_time, $exam_end_time, $subject_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EofficeExamExaminationItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $STUDENTID
     * @param string $rooms_id
     * @param string $exam_date
     * @param string $exam_start_time
     * @param string $exam_end_time
     * @param string $subject_id
     * @return EofficeExamExaminationItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($STUDENTID, $rooms_id, $exam_date, $exam_start_time, $exam_end_time, $subject_id)
    {
        if (($model = EofficeExamExaminationItem::findOne(['STUDENTID' => $STUDENTID, 'rooms_id' => $rooms_id, 'exam_date' => $exam_date, 'exam_start_time' => $exam_start_time, 'exam_end_time' => $exam_end_time, 'subject_id' => $subject_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
