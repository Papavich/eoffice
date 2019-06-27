<?php

namespace app\modules\eoffice_exam\controllers;
use Yii;
use app\modules\eoffice_exam\models\EofficeExamInvigilate;
use app\modules\eoffice_exam\models\EofficeExamInvigilateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class TeacherdateController extends \yii\web\Controller
{
    public function actionTeacherdate()
    {
        $this->layout = "main_modules";
        return $this->render('teacherdate');
    }

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
     * Lists all EofficeExamInvigilate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EofficeExamInvigilateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EofficeExamInvigilate model.
     * @param integer $person_id
     * @param string $exam_date
     * @param string $examstart_time
     * @param string $exam_end_time
     * @param string $subject_id
     * @param string $section_no
     * @param string $room_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($person_id, $exam_date, $examstart_time, $exam_end_time, $subject_id, $section_no, $room_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($person_id, $exam_date, $examstart_time, $exam_end_time, $subject_id, $section_no, $room_id),
        ]);
    }

    /**
     * Creates a new EofficeExamInvigilate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EofficeExamInvigilate();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'person_id' => $model->person_id, 'exam_date' => $model->exam_date, 'examstart_time' => $model->examstart_time, 'exam_end_time' => $model->exam_end_time, 'subject_id' => $model->subject_id, 'section_no' => $model->section_no, 'room_id' => $model->room_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EofficeExamInvigilate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $person_id
     * @param string $exam_date
     * @param string $examstart_time
     * @param string $exam_end_time
     * @param string $subject_id
     * @param string $section_no
     * @param string $room_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($person_id, $exam_date, $examstart_time, $exam_end_time, $subject_id, $section_no, $room_id)
    {
        $model = $this->findModel($person_id, $exam_date, $examstart_time, $exam_end_time, $subject_id, $section_no, $room_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'person_id' => $model->person_id, 'exam_date' => $model->exam_date, 'examstart_time' => $model->examstart_time, 'exam_end_time' => $model->exam_end_time, 'subject_id' => $model->subject_id, 'section_no' => $model->section_no, 'room_id' => $model->room_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EofficeExamInvigilate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $person_id
     * @param string $exam_date
     * @param string $examstart_time
     * @param string $exam_end_time
     * @param string $subject_id
     * @param string $section_no
     * @param string $room_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($person_id, $exam_date, $examstart_time, $exam_end_time, $subject_id, $section_no, $room_id)
    {
        $this->findModel($person_id, $exam_date, $examstart_time, $exam_end_time, $subject_id, $section_no, $room_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EofficeExamInvigilate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $person_id
     * @param string $exam_date
     * @param string $examstart_time
     * @param string $exam_end_time
     * @param string $subject_id
     * @param string $section_no
     * @param string $room_id
     * @return EofficeExamInvigilate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($person_id, $exam_date, $examstart_time, $exam_end_time, $subject_id, $section_no, $room_id)
    {
        if (($model = EofficeExamInvigilate::findOne(['person_id' => $person_id, 'exam_date' => $exam_date, 'examstart_time' => $examstart_time, 'exam_end_time' => $exam_end_time, 'subject_id' => $subject_id, 'section_no' => $section_no, 'room_id' => $room_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
