<?php

namespace app\modules\personsystem\controllers;

use Yii;
use app\modules\personsystem\models\BoardOfDirectors;
use app\modules\personsystem\models\BoardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BoardController implements the CRUD actions for BoardOfDirectors model.
 */
class BoardController extends Controller
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
     * Lists all BoardOfDirectors models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BoardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BoardOfDirectors model.
     * @param string $board_id
     * @param integer $person_id
     * @param integer $director_id
     * @param integer $period_id
     * @return mixed
     */
    public function actionView($board_id, $person_id, $director_id, $period_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($board_id, $person_id, $director_id, $period_id),
        ]);
    }

    /**
     * Creates a new BoardOfDirectors model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BoardOfDirectors();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'board_id' => $model->board_id, 'person_id' => $model->person_id, 'director_id' => $model->director_id, 'period_id' => $model->period_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BoardOfDirectors model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $board_id
     * @param integer $person_id
     * @param integer $director_id
     * @param integer $period_id
     * @return mixed
     */
    public function actionUpdate($board_id, $person_id, $director_id, $period_id)
    {
        $model = $this->findModel($board_id, $person_id, $director_id, $period_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'board_id' => $model->board_id, 'person_id' => $model->person_id, 'director_id' => $model->director_id, 'period_id' => $model->period_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BoardOfDirectors model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $board_id
     * @param integer $person_id
     * @param integer $director_id
     * @param integer $period_id
     * @return mixed
     */
    public function actionDelete($board_id, $person_id, $director_id, $period_id)
    {
        $this->findModel($board_id, $person_id, $director_id, $period_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BoardOfDirectors model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $board_id
     * @param integer $person_id
     * @param integer $director_id
     * @param integer $period_id
     * @return BoardOfDirectors the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($board_id, $person_id, $director_id, $period_id)
    {
        if (($model = BoardOfDirectors::findOne(['board_id' => $board_id, 'person_id' => $person_id, 'director_id' => $director_id, 'period_id' => $period_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
