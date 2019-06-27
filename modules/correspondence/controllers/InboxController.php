<?php

namespace app\modules\correspondence\controllers;

use Yii;
use app\modules\correspondence\models\CmsInbox;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InboxController implements the CRUD actions for CmsInbox model.
 */
class InboxController extends Controller
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
     * Lists all CmsInbox models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CmsInbox::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsInbox model.
     * @param integer $inbox_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionView($inbox_id, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($inbox_id, $user_id),
        ]);
    }

    /**
     * Creates a new CmsInbox model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmsInbox();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'inbox_id' => $model->inbox_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CmsInbox model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $inbox_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionUpdate($inbox_id, $user_id)
    {
        $model = $this->findModel($inbox_id, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'inbox_id' => $model->inbox_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CmsInbox model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $inbox_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionDelete($inbox_id, $user_id)
    {
        $this->findModel($inbox_id, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CmsInbox model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $inbox_id
     * @param integer $user_id
     * @return CmsInbox the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($inbox_id, $user_id)
    {
        if (($model = CmsInbox::findOne(['inbox_id' => $inbox_id, 'user_id' => $user_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
