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
 * TaAssessmentOpenController implements the CRUD actions for TaAssessmentOpen model.
 */
class TaAssessmentOpenController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $this->layout = "main_modules";
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
     * Lists all TaAssessmentOpen models.
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
     * Displays a single TaAssessmentOpen model.
     * @param string $ta_assessment_id
     * @param string $past
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id,$past)
    {
      $model =  $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($id,$past),
        ]);
    }

    /**
     * Creates a new TaAssessmentOpen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaAssessmentOpen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->layout = "main_modules";
            return $this->redirect(['view', 'ta_assessment_id' => $model->ta_assessment_id, 'past' => $model->past]);
        }
        $this->layout = "main_modules";
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TaAssessmentOpen model.
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
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['view', 'id' => $model->ta_assessment_id, 'past' => $model->past]);
        }
        $this->layout = "main_modules";
        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing TaAssessmentOpen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ta_assessment_id
     * @param string $past
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $past)
    {
          $this->findModel($id, $past)->delete();

            Yii::$app->session->setFlash('success', 'ลบข้อมูลเรียบร้อยแล้ว');
            $this->layout = "main_modules";
            return $this->redirect(['index']);

    }

    /**
     * Finds the TaAssessmentOpen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ta_assessment_id
     * @param string $past
     * @return TaAssessmentOpen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id,$past)
    {
        if (($model = TaAssessmentOpen::findOne($id,$past)) !== null) {
            return $model;
        }

      //  throw new NotFoundHttpException('The requested page does not exist.');
    }
}
