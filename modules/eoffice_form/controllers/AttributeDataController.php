<?php

namespace app\modules\eoffice_form\controllers;

use Yii;
use app\modules\eoffice_form\models\AttributeData;
use app\modules\eoffice_form\models\AttributeDataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AttributeDataController implements the CRUD actions for AttributeData model.
 */
class AttributeDataController extends Controller
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
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AttributeData models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new AttributeDataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AttributeData model.
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
     * Creates a new AttributeData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($design_section_id,$attribute_ref)
    {
        $this->layout = "main_modules";
        $model = new AttributeData();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['design-attribute/view-list', 'attribute_ref' => $attribute_ref, 'design_section_id' => $design_section_id]);
        }



        return $this->render('create', [
            'model' => $model,
            'design_section_id' => $design_section_id,
            'attribute_ref' => $attribute_ref,

        ]);
    }

    /**
     * Updates an existing AttributeData model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id,$design_section_id,$attribute_ref)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->attribute_data_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'design_section_id' => $design_section_id,
            'attribute_ref' => $attribute_ref,
        ]);
    }

    /**
     * Deletes an existing AttributeData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$design_section_id,$attribute_ref)
    {
        $this->layout = "main_modules";
        $this->findModel($id,$attribute_ref, $design_section_id)->delete();

        return $this->redirect(['design-attribute/view-list', 'attribute_ref' => $attribute_ref, 'design_section_id' => $design_section_id]);
    }

    /**
     * Finds the AttributeData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AttributeData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AttributeData::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
