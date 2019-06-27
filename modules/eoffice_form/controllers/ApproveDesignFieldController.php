<?php

namespace app\modules\eoffice_form\controllers;

use Yii;
use app\modules\eoffice_form\models\ApproveDesignField;
use app\modules\eoffice_form\models\ApproveDesignFieldSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ApproveDesignFieldController implements the CRUD actions for ApproveDesignField model.
 */
class ApproveDesignFieldController extends Controller
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
     * Lists all ApproveDesignField models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ApproveDesignFieldSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ApproveDesignField model.
     * @param string $approve_field_ref
     * @param integer $approve_design_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($approve_field_ref, $approve_design_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($approve_field_ref, $approve_design_id),
        ]);
    }

    /**
     * Creates a new ApproveDesignField model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ApproveDesignField();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'approve_field_ref' => $model->approve_field_ref, 'approve_design_id' => $model->approve_design_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ApproveDesignField model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $approve_field_ref
     * @param integer $approve_design_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($approve_field_ref, $approve_design_id)
    {
        $model = $this->findModel($approve_field_ref, $approve_design_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'approve_field_ref' => $model->approve_field_ref, 'approve_design_id' => $model->approve_design_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ApproveDesignField model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $approve_field_ref
     * @param integer $approve_design_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($approve_field_ref, $approve_design_id)
    {
        $this->findModel($approve_field_ref, $approve_design_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ApproveDesignField model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $approve_field_ref
     * @param integer $approve_design_id
     * @return ApproveDesignField the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($approve_field_ref, $approve_design_id)
    {
        if (($model = ApproveDesignField::findOne(['approve_field_ref' => $approve_field_ref, 'approve_design_id' => $approve_design_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
