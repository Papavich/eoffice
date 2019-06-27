<?php

namespace app\modules\consulting\controllers;

use Yii;
use app\modules\consulting\models\ConsultPost;
use app\modules\consulting\models\ConsultPostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConsultPostController implements the CRUD actions for ConsultPost model.
 */
class ConsultPostController extends Controller
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
     * Lists all ConsultPost models.
     * @return mixed
     */
    public function actionIndex()
    {
          $this->layout = "main_modules";
        $searchModel = new ConsultPostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionIndex0()
    {
          $this->layout = "main_modules";
        $searchModel = new ConsultPostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index0', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ConsultPost model.
     * @param integer $post_id
     * @param integer $topic_owner_id
     * @param integer $respon_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($post_id, $topic_owner_id, $respon_id)
    {
          $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($post_id, $topic_owner_id, $respon_id),
        ]);
    }

    /**
     * Creates a new ConsultPost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
          $this->layout = "main_modules";
        $model = new ConsultPost();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'post_id' => $model->post_id, 'topic_owner_id' => $model->topic_owner_id, 'respon_id' => $model->respon_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ConsultPost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $post_id
     * @param integer $topic_owner_id
     * @param integer $respon_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($post_id, $topic_owner_id, $respon_id)
    {
          $this->layout = "main_modules";
        $model = $this->findModel($post_id, $topic_owner_id, $respon_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'post_id' => $model->post_id, 'topic_owner_id' => $model->topic_owner_id, 'respon_id' => $model->respon_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ConsultPost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $post_id
     * @param integer $topic_owner_id
     * @param integer $respon_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($post_id, $topic_owner_id, $respon_id)
    {
          $this->layout = "main_modules";
        $this->findModel($post_id, $topic_owner_id, $respon_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ConsultPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $post_id
     * @param integer $topic_owner_id
     * @param integer $respon_id
     * @return ConsultPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($post_id, $topic_owner_id, $respon_id)
    {
        if (($model = ConsultPost::findOne(['post_id' => $post_id, 'topic_owner_id' => $topic_owner_id, 'respon_id' => $respon_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
