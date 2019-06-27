<?php

namespace app\modules\correspondence\controllers;

use Yii;
use app\modules\correspondence\models\CmsDocToDept;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ToDeptController implements the CRUD actions for CmsDocToDept model.
 */
class ToDeptController extends Controller
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
     * Lists all CmsDocToDept models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CmsDocToDept::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsDocToDept model.
     * @param integer $doc_to_dept_id
     * @param string $doc_id
     * @return mixed
     */
    public function actionView($doc_to_dept_id, $doc_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($doc_to_dept_id, $doc_id),
        ]);
    }

    /**
     * Creates a new CmsDocToDept model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmsDocToDept();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'doc_to_dept_id' => $model->doc_to_dept_id, 'doc_id' => $model->doc_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CmsDocToDept model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $doc_to_dept_id
     * @param string $doc_id
     * @return mixed
     */
    public function actionUpdate($doc_to_dept_id, $doc_id)
    {
        $model = $this->findModel($doc_to_dept_id, $doc_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'doc_to_dept_id' => $model->doc_to_dept_id, 'doc_id' => $model->doc_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CmsDocToDept model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $doc_to_dept_id
     * @param string $doc_id
     * @return mixed
     */
    public function actionDelete($doc_to_dept_id, $doc_id)
    {
        $this->findModel($doc_to_dept_id, $doc_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CmsDocToDept model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $doc_to_dept_id
     * @param string $doc_id
     * @return CmsDocToDept the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($doc_to_dept_id, $doc_id)
    {
        if (($model = CmsDocToDept::findOne(['doc_to_dept_id' => $doc_to_dept_id, 'doc_id' => $doc_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
