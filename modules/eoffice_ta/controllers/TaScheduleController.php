<?php

namespace app\modules\eoffice_ta\controllers;

use Yii;
use app\modules\eoffice_ta\models\TaSchedule;
use app\modules\eoffice_ta\models\TaScheduleSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\modules\eoffice_ta\components\CCalendar as Calendar;

/**
 * TaScheduleController implements the CRUD actions for TaSchedule model.
 */
class TaScheduleController extends Controller
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

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all TaSchedule models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new TaScheduleSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       $query = TaSchedule::find()->orderBy(['time_start'=>SORT_ASC]);
       // $query =  $searchModel->search(Yii::$app->request->queryParams);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()  ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize' => 5 ],
        ]);

        /*$dataProvider = new ActiveDataProvider([
           // $searchModel->search(Yii::$app->request->queryParams),
            'query' => $query,
            'pagination' => [ 'pageSize' => 5 ],
            'sort' => [
                'defaultOrder' => [
                    'time_start' => SORT_ASC,
                ]
            ],
        ]) ;*/
       /* $dataProvider = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
       */

        $this->layout = "main_modules";
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'model' => $model,
            'pages' => $pages,
        ]);
    }

    public function actionCalendar()
    {

        $obj = new Calendar();
        $this->layout = "main_modules";
        return $this->render('calendar', [
            'obj' => $obj,
           'calendar' => $obj->getCalendar($obj->getYearNow(),$obj->getMonthNow()),
        ]);
    }
    public function actionYear()
    {
        $obj = new Calendar();
        $this->layout = "main_modules";
        return $this->render('calendar', [
            'obj' => $obj,
            'calendar' => $obj->getCalendar($obj->getYear()),
        ]);
    }
    public function actionMonth()
    {
        $obj = new Calendar();
        $this->layout = "main_modules";
        return $this->render('calendar', [
            'obj' => $obj,
            'calendar' => $obj->getCalendar($obj->getYearNow(),$obj->getMonthNow()),
        ]);
    }

    /**
     * Displays a single TaSchedule model.
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
     * Creates a new TaSchedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaSchedule();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->layout = "main_modules";
            return $this->redirect(['view', 'id' => $model->ta_schedule_id]);
        }

        $this->layout = "main_modules";
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TaSchedule model.
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
            return $this->redirect(['view', 'id' => $model->ta_schedule_id]);
        }

        $this->layout = "main_modules";
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TaSchedule model.
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
     * Finds the TaSchedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaSchedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaSchedule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
