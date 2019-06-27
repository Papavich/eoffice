<?php

namespace app\modules\eoffice_ta\controllers;

use Yii;
use app\modules\eoffice_ta\models\TaTopicAssessment;
use app\modules\eoffice_ta\models\TaTopicAssessmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
/**
 * TaTopicAssessmentController implements the CRUD actions for TaTopicAssessment model.
 */
class TaTopicAssessmentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {$this->layout = "main_modules";
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
     * Lists all TaTopicAssessment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = TaTopicAssessment::find(); // สิ่งที่เอาไปประยุกต์ได้ แล้วต้องเปลี่ยน $query -> all สามารถเอาไปใช้ได้เลย โดยไม่ต้องเปลี่ยนแปลง
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 4]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->limit($pages->limit)
            ->all();
        $searchModel = new TaTopicAssessmentSearch();
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
     * Displays a single TaTopicAssessment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {$this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TaTopicAssessment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaTopicAssessment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->topic_ass_id]);
        }
        $this->layout = "main_modules";
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TaTopicAssessment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->layout = "main_modules";
            return $this->redirect(['view', 'id' => $model->topic_ass_id]);
        }
        $this->layout = "main_modules";
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TaTopicAssessment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $this->layout = "main_modules";
        return $this->redirect(['index']);
    }

    /**
     * Finds the TaTopicAssessment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaTopicAssessment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaTopicAssessment::findOne($id)) !== null) {
            $this->layout = "main_modules";
            return $model;
        }

        //throw new NotFoundHttpException('The requested page does not exist.');
    }
}
