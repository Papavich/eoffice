<?php

namespace app\modules\eoffice_exam\controllers;

use Yii;
use app\modules\eoffice_exam\models\EofficeExamExamination;
use app\modules\eoffice_exam\models\EofficeExamExaminationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EofficeExamExaminationController implements the CRUD actions for EofficeExamExamination model.
 */
class EofficeExamExaminationController extends Controller
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
     * Lists all EofficeExamExamination models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EofficeExamExaminationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EofficeExamExamination model.
     * @param string $rooms_id
     * @param string $Section
     * @param string $subject_id
     * @param integer $program_class
     * @param string $exam_date
     * @param string $exam_start_time
     * @param string $exam_end_time
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($rooms_id, $Section, $subject_id, $program_class, $exam_date, $exam_start_time, $exam_end_time)
    {
        return $this->render('view', [
            'model' => $this->findModel($rooms_id, $Section, $subject_id, $program_class, $exam_date, $exam_start_time, $exam_end_time),
        ]);
    }

    /**
     * Creates a new EofficeExamExamination model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EofficeExamExamination();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'rooms_id' => $model->rooms_id, 'Section' => $model->Section, 'subject_id' => $model->subject_id, 'program_class' => $model->program_class, 'exam_date' => $model->exam_date, 'exam_start_time' => $model->exam_start_time, 'exam_end_time' => $model->exam_end_time]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EofficeExamExamination model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $rooms_id
     * @param string $Section
     * @param string $subject_id
     * @param integer $program_class
     * @param string $exam_date
     * @param string $exam_start_time
     * @param string $exam_end_time
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($rooms_id, $Section, $subject_id, $program_class, $exam_date, $exam_start_time, $exam_end_time)
    {
        $model = $this->findModel($rooms_id, $Section, $subject_id, $program_class, $exam_date, $exam_start_time, $exam_end_time);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'rooms_id' => $model->rooms_id, 'Section' => $model->Section, 'subject_id' => $model->subject_id, 'program_class' => $model->program_class, 'exam_date' => $model->exam_date, 'exam_start_time' => $model->exam_start_time, 'exam_end_time' => $model->exam_end_time]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EofficeExamExamination model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $rooms_id
     * @param string $Section
     * @param string $subject_id
     * @param integer $program_class
     * @param string $exam_date
     * @param string $exam_start_time
     * @param string $exam_end_time
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($rooms_id, $Section, $subject_id, $program_class, $exam_date, $exam_start_time, $exam_end_time)
    {
        $this->findModel($rooms_id, $Section, $subject_id, $program_class, $exam_date, $exam_start_time, $exam_end_time)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EofficeExamExamination model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $rooms_id
     * @param string $Section
     * @param string $subject_id
     * @param integer $program_class
     * @param string $exam_date
     * @param string $exam_start_time
     * @param string $exam_end_time
     * @return EofficeExamExamination the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($rooms_id, $Section, $subject_id, $program_class, $exam_date, $exam_start_time, $exam_end_time)
    {
        if (($model = EofficeExamExamination::findOne(['rooms_id' => $rooms_id, 'Section' => $Section, 'subject_id' => $subject_id, 'program_class' => $program_class, 'exam_date' => $exam_date, 'exam_start_time' => $exam_start_time, 'exam_end_time' => $exam_end_time])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
