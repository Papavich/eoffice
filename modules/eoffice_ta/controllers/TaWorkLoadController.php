<?php

namespace app\modules\eoffice_ta\controllers;

use Yii;
use app\modules\eoffice_ta\models\TaWorkLoad;
use app\modules\eoffice_ta\models\TaRegister;
use app\models\Person;
use app\modules\eoffice_ta\models\TaWorkLoadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaWorkLoadController implements the CRUD actions for TaWorkLoad model.
 */
class TaWorkLoadController extends Controller
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
     * Lists all TaWorkLoad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $u = Person::findOne(['user_id' => Yii::$app->user->id]);
        $per= $u->person_citizen_id;
        $model= TaRegister::find()->where(['person_id'=>$per])->all();
        $searchModel = new TaWorkLoadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "main_modules";
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }

    /**
     * Displays a single TaWorkLoad model.
     * @param string $person_id
     * @param string $subject_id
     * @param string $term_id
     * @param string $year_id
     * @return mixed
     */
    public function actionView($person_id, $subject_id, $term_id, $year_id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($person_id, $subject_id, $term_id, $year_id),
        ]);
    }

    /**
     * Creates a new TaWorkLoad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $u = Person::findOne(['user_id' => Yii::$app->user->id]);
        $person_id = $u->person_citizen_id;
        $model = new TaWorkLoad();
        if ($model->load(Yii::$app->request->post()) ) {
            $model->person_id = $person_id;
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['view', 'person_id' => $model->person_id, 'subject_id' => $model->subject_id, 'term_id' => $model->term_id, 'year_id' => $model->year_id]);
        } else {
            $this->layout = "main_modules";
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaWorkLoad model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $person_id
     * @param string $subject_id
     * @param string $term_id
     * @param string $year_id
     * @return mixed
     */
    public function actionUpdate($s, $t, $y)
    {
        $u = Person::findOne(['user_id' => Yii::$app->user->id]);
        $person_id = $u->person_citizen_id;
        $model = $this->findModel($person_id, $s, $t, $y);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->layout = "main_modules";
            return $this->redirect(['view', 'person_id' => $model->person_id, 'subject_id' => $model->subject_id, 'term_id' => $model->term_id, 'year_id' => $model->year_id]);
        } else {
            $this->layout = "main_modules";
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaWorkLoad model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $person_id
     * @param string $subject_id
     * @param string $term_id
     * @param string $year_id
     * @return mixed
     */
    public function actionDelete($person_id, $subject_id, $term_id, $year_id)
    {
        $this->findModel($person_id, $subject_id, $term_id, $year_id)->delete();

        $this->layout = "main_modules";
        return $this->redirect(['index']);
    }

    /**
     * Finds the TaWorkLoad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $person_id
     * @param string $subject_id
     * @param string $term_id
     * @param string $year_id
     * @return TaWorkLoad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($person_id, $subject_id, $term_id, $year_id)
    {
        if (($model = TaWorkLoad::findOne(['person_id' => $person_id, 'subject_id' => $subject_id, 'term_id' => $term_id, 'year_id' => $year_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
