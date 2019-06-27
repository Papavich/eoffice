<?php

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\ScbStudent;
use Yii;
use app\modules\scholar_b\models\ScbConditionHasStudent;
use app\modules\scholar_b\models\ScbConditionHasStudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CheckConditionsController implements the CRUD actions for ScbConditionHasStudent model.
 */
class CheckConditionsController extends Controller
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
     * Lists all ScbConditionHasStudent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScbConditionHasStudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ScbConditionHasStudent model.
     * @param integer $condi_id
     * @param string $scholarship_id
     * @param integer $scholarship_year
     * @param string $student_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($condi_id, $scholarship_id, $scholarship_year, $student_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($condi_id, $scholarship_id, $scholarship_year, $student_id),
        ]);
    }

    /**
     * Creates a new ScbConditionHasStudent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model_check_condition = [new ScbConditionHasStudent()];
        $model_conditions = ScbCondition::find()->where(['scholarship_id'=>$scholarship_id,'scholarship_year'=>$scholarship_year])->all();

        if ($model_check_condition->load(Yii::$app->request->post()) && $model_check_condition->save()) {
            return $this->redirect(['view', 'condi_id' => $model_check_condition->condi_id, 'scholarship_id' => $model_check_condition->scholarship_id, 'scholarship_year' => $model_check_condition->scholarship_year, 'student_id' => $model_check_condition->student_id]);
        }

        return $this->render('create', [
            'model' => $model_check_condition,
        ]);
    }

    /**
     * Updates an existing ScbConditionHasStudent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $condi_id
     * @param string $scholarship_id
     * @param integer $scholarship_year
     * @param string $student_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($condi_id, $scholarship_id, $scholarship_year, $student_id)
    {
        $model = $this->findModel($condi_id, $scholarship_id, $scholarship_year, $student_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'condi_id' => $model->condi_id, 'scholarship_id' => $model->scholarship_id, 'scholarship_year' => $model->scholarship_year, 'student_id' => $model->student_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ScbConditionHasStudent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $condi_id
     * @param string $scholarship_id
     * @param integer $scholarship_year
     * @param string $student_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($condi_id, $scholarship_id, $scholarship_year, $student_id)
    {
        $this->findModel($condi_id, $scholarship_id, $scholarship_year, $student_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ScbConditionHasStudent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $condi_id
     * @param string $scholarship_id
     * @param integer $scholarship_year
     * @param string $student_id
     * @return ScbConditionHasStudent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($condi_id, $scholarship_id, $scholarship_year, $student_id)
    {
        if (($model = ScbConditionHasStudent::findOne(['condi_id' => $condi_id, 'scholarship_id' => $scholarship_id, 'scholarship_year' => $scholarship_year, 'student_id' => $student_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
