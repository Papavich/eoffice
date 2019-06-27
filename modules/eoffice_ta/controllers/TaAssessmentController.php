<?php

namespace app\modules\eoffice_ta\controllers;

use Yii;
use app\modules\eoffice_ta\models\TaAssessment;
use app\modules\eoffice_ta\models\TaAssessmentOpen;
use app\modules\eoffice_ta\models\TaAssessmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
/**
 * TaAssessmentController implements the CRUD actions for TaAssessment model.
 */
class TaAssessmentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {  $this->layout = "main_modules";
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
     * Lists all TaAssessment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = TaAssessmentOpen::find(); // สิ่งที่เอาไปประยุกต์ได้ แล้วต้องเปลี่ยน $query -> all สามารถเอาไปใช้ได้เลย โดยไม่ต้องเปลี่ยนแปลง
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 4]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->limit($pages->limit)
            ->all();
        $searchModel = new TaAssessmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->layout = "main_modules";
        return $this->render('index', [
            'model' => $model,
            'pages' => $pages,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaAssessment model.
     * @param string $ta_assessment_id
     * @param string $past
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $past)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($id, $past),
        ]);
    }

    /**
     * Creates a new TaAssessment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model1 = new TaAssessment();
        $model2 = new TaAssessmentOpen();

        if ($model1->load(Yii::$app->request->post()) && $model1->save()) {

                $model2->save();
                $this->layout = "main_modules";
                return $this->redirect(['view', 'ta_assessment_id' => $model1->ta_assessment_id, 'past' => $model1->past]);


        } else {
            $this->layout = "main_modules";
            return $this->render('create', [
                'model' => $model1,
                'model2' => $model2
            ]);

        }
    }


    /**
     * Updates an existing TaAssessment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $ta_assessment_id
     * @param string $past
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $past)
    {
        $model = $this->findModel($id, $past);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->layout = "main_modules";
            return $this->redirect(['view', 'id' => $model->ta_assessment_id, 'past' => $model->past]);
        }
        $this->layout = "main_modules";
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TaAssessment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ta_assessment_id
     * @param string $past
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        $this->layout = "main_modules";
        return $this->redirect(['index']);
    }


    /**
     * Finds the TaAssessment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ta_assessment_id
     * @param string $past
     * @return TaAssessment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ta_assessment_id, $past)
    {
        if (($model = TaAssessment::findOne(['ta_assessment_id' => $ta_assessment_id, 'past' => $past])) !== null) {
            $this->layout = "main_modules";
            return $model;
        }

        //throw new NotFoundHttpException('The requested page does not exist.');
    }protected function findModelOpen($ta_assessment_id, $past)
    {
        if (($model2 = TaAssessmentOpen::findOne(['ta_assessment_id' => $ta_assessment_id, 'past' => $past])) !== null) {
            $this->layout = "main_modules";
            return $model2;
        }

        //throw new NotFoundHttpException('The requested page does not exist.');
    }
}
