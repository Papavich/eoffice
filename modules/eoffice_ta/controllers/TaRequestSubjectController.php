<?php

namespace app\modules\eoffice_ta\controllers;

use Yii;
use app\modules\eoffice_ta\models\TaRequestSubject;
use app\modules\eoffice_ta\models\TaRequestSubjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaRequestSubjectController implements the CRUD actions for TaRequestSubject model.
 */
class TaRequestSubjectController extends Controller
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
     * Lists all TaRequestSubject models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaRequestSubjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaRequestSubject model.
     * @param string $person_id
     * @param string $subject_id
     * @param string $term_id
     * @param string $year
     * @return mixed
     */
    public function actionView($person_id, $subject_id, $term_id, $year)
    {
        return $this->render('view', [
            'model' => $this->findModel($person_id, $subject_id, $term_id, $year),
        ]);
    }

    /**
     * Creates a new TaRequestSubject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaRequestSubject();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'person_id' => $model->person_id, 'subject_id' => $model->subject_id, 'term_id' => $model->term_id, 'year' => $model->year]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaRequestSubject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $person_id
     * @param string $subject_id
     * @param string $term_id
     * @param string $year
     * @return mixed
     */
    public function actionUpdate($person_id, $subject_id, $term_id, $year)
    {
        $model = $this->findModel($person_id, $subject_id, $term_id, $year);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'person_id' => $model->person_id, 'subject_id' => $model->subject_id, 'term_id' => $model->term_id, 'year' => $model->year]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaRequestSubject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $person_id
     * @param string $subject_id
     * @param string $term_id
     * @param string $year
     * @return mixed
     */
    public function actionDelete($person_id, $subject_id, $term_id, $year)
    {
        $this->findModel($person_id, $subject_id, $term_id, $year)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaRequestSubject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $person_id
     * @param string $subject_id
     * @param string $term_id
     * @param string $year
     * @return TaRequestSubject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($person_id, $subject_id, $term_id, $year)
    {
        if (($model = TaRequestSubject::findOne(['person_id' => $person_id, 'subject_id' => $subject_id, 'term_id' => $term_id, 'year' => $year])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
