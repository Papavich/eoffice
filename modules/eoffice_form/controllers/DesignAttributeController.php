<?php

namespace app\modules\eoffice_form\controllers;

use Yii;
use app\modules\eoffice_form\models\DesignAttribute;
use app\modules\eoffice_form\models\DesignAttributeSearch;
use app\modules\eoffice_form\models\AttributeDataSearch;
use app\modules\eoffice_form\models\AttributeData;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DesignAttributeController implements the CRUD actions for DesignAttribute model.
 */
class DesignAttributeController extends Controller
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
                   // 'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DesignAttribute models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new DesignAttributeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DesignAttribute model.
     * @param string $attribute_ref
     * @param integer $design_section_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($attribute_ref, $design_section_id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($attribute_ref, $design_section_id),
        ]);
    }

    public function actionViewList($attribute_ref, $design_section_id)
    {
        $session = Yii::$app->session;
        $session['attribute_ref']= $attribute_ref;
        $session['design_section_id']= $design_section_id;
        $this->layout = "main_modules";
        $searchModel = new AttributeDataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('viewList', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $this->findModel($attribute_ref, $design_section_id),
        ]);
    }

    /**
     * Creates a new DesignAttribute model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($design_section_id)
    {
        $this->layout = "main_modules";
        $model = new DesignAttribute();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['design-section/view', 'id' => $model->design_section_id]);
            //return $this->redirect(['design-section/view', 'attribute_ref' => $model->attribute_ref, 'design_section_id' => $model->design_section_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'design_section_id' => $design_section_id,
        ]);
    }

    /**
     * Updates an existing DesignAttribute model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $attribute_ref
     * @param integer $design_section_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($attribute_ref, $design_section_id)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($attribute_ref, $design_section_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'attribute_ref' => $model->attribute_ref, 'design_section_id' => $model->design_section_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'design_section_id' => $design_section_id,
        ]);
    }

    /**
     * Deletes an existing DesignAttribute model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $attribute_ref
     * @param integer $design_section_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($attribute_ref, $design_section_id)
    {
        $this->layout = "main_modules";
        $this->findModel($attribute_ref, $design_section_id)->delete();

        return $this->redirect(['design-section/view', 'id' => $design_section_id]);


    }

    /**
     * Finds the DesignAttribute model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $attribute_ref
     * @param integer $design_section_id
     * @return DesignAttribute the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($attribute_ref, $design_section_id)
    {
        if (($model = DesignAttribute::findOne(['attribute_ref' => $attribute_ref, 'design_section_id' => $design_section_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
