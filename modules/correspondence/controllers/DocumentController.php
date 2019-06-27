<?php

namespace app\modules\correspondence\controllers;

use app\modules\correspondence\models\gridview\RollGridView;
use Yii;
use app\modules\correspondence\models\CmsDocument;
use app\modules\correspondence\models\DocumentGridView;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocumentController implements the CRUD actions for CmsDocument model.
 */
class DocumentController extends Controller
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
     * Lists all CmsDocument models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentGridView();
        $dataProvider = $searchModel->searchReceiveInFolder(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndex2()
    {
        $this->layout = "main_module";
        $searchModel = new RollGridView();
        $dataProvider = $searchModel->searchRoll(Yii::$app->request->queryParams);
        return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single CmsDocument model.
     * @param string $doc_id
     * @param integer $sub_type_id
     * @param string $address_id
     * @param integer $doc_dept_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($doc_id, $sub_type_id, $address_id, $doc_dept_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($doc_id, $sub_type_id, $address_id, $doc_dept_id),
        ]);
    }

    /**
     * Creates a new CmsDocument model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmsDocument();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'doc_id' => $model->doc_id, 'sub_type_id' => $model->sub_type_id, 'address_id' => $model->address_id, 'doc_dept_id' => $model->doc_dept_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CmsDocument model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $doc_id
     * @param integer $sub_type_id
     * @param string $address_id
     * @param integer $doc_dept_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($doc_id, $sub_type_id, $address_id, $doc_dept_id)
    {
        $model = $this->findModel($doc_id, $sub_type_id, $address_id, $doc_dept_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'doc_id' => $model->doc_id, 'sub_type_id' => $model->sub_type_id, 'address_id' => $model->address_id, 'doc_dept_id' => $model->doc_dept_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CmsDocument model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $doc_id
     * @param integer $sub_type_id
     * @param string $address_id
     * @param integer $doc_dept_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($doc_id, $sub_type_id, $address_id, $doc_dept_id)
    {
        $this->findModel($doc_id, $sub_type_id, $address_id, $doc_dept_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CmsDocument model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $doc_id
     * @param integer $sub_type_id
     * @param string $address_id
     * @param integer $doc_dept_id
     * @return CmsDocument the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($doc_id, $sub_type_id, $address_id, $doc_dept_id)
    {
        if (($model = CmsDocument::findOne(['doc_id' => $doc_id, 'sub_type_id' => $sub_type_id, 'address_id' => $address_id, 'doc_dept_id' => $doc_dept_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
