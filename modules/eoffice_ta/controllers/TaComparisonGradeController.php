<?php

namespace app\modules\eoffice_ta\controllers;

use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use Yii;
use app\modules\eoffice_ta\models\TaComparisonGrade;
use app\modules\eoffice_ta\models\TaComparisonGradeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaComparisonGradeController implements the CRUD actions for TaComparisonGrade model.
 */
class TaComparisonGradeController extends Controller
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
     * Lists all TaComparisonGrade models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaComparisonGradeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaComparisonGrade model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TaComparisonGrade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($s,$ver,$y,$t)
    {
        $model = new TaComparisonGrade();
        $user = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
        $u = Yii::$app->formatter->asNtext($user->person_id);
       // if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        if ($model->load(Yii::$app->request->post()) ) {
            $model->subject_id = $s;
            $model->subject_version = $ver;
            $model->year = $y;
            $model->term = $t;
            $model->person_id = $u;
            $model->doc_ref = $model->upload($model,'doc_ref');
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['view', 'id' => $model->ta_comparison_grade_id]);
        }

        $this->layout = "main_modules";
        return $this->render('create', [
            'model' => $model,
           's'=>$s,
            'ver'=>$ver,
            'y'=>$y,
            't'=>$t,
        ]);
    }

    /**
     * Updates an existing TaComparisonGrade model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $model->doc_ref = $model->upload($model,'doc_ref');
            $model->save();
            return $this->redirect(['view', 'id' => $model->ta_comparison_grade_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TaComparisonGrade model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaComparisonGrade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaComparisonGrade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaComparisonGrade::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
