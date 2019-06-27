<?php

namespace app\modules\eoffice_form\controllers;

use app\modules\eoffice_form\models\ApproveDesignSection;
use app\modules\eoffice_form\models\ApproveDesignSectionSearch;
use app\modules\eoffice_form\models\ApprovePosition;
use app\modules\eoffice_form\models\ApprovePositionSearch;
use Yii;
use app\modules\eoffice_form\models\ApproveGroup;
use app\modules\eoffice_form\models\ApproveGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ApproveGroupController implements the CRUD actions for ApproveGroup model.
 */
class ApproveGroupController extends Controller
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
     * Lists all ApproveGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new ApproveGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ApproveGroup model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = "main_modules";
        $session = Yii::$app->session;
        $session['group_id']= $id;

        $searchModel = new ApprovePositionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $ApproveDesignSearchModel = new ApproveDesignSectionSearch();
        $ApproveDesignDataProvider = $ApproveDesignSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ApproveDesignSearchModel' => $ApproveDesignSearchModel,
            'ApproveDesignDataProvider' => $ApproveDesignDataProvider,
        ]);
    }

    public function actionViewSubject($id)
    {
        $this->layout = "main_modules";
        $session = Yii::$app->session;
        $session['group_id']= $id;

        $searchModel = new ApprovePositionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $ApproveDesignSearchModel = new ApproveDesignSectionSearch();
        $ApproveDesignDataProvider = $ApproveDesignSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('viewSubject', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ApproveDesignSearchModel' => $ApproveDesignSearchModel,
            'ApproveDesignDataProvider' => $ApproveDesignDataProvider,
        ]);
    }

    /**
     * Creates a new ApproveGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($template_id)
    {
        $this->layout = "main_modules";
        $model = new ApproveGroup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->groupType->group_type_name == 'อาจารย์ประจำวิชา'){
                return $this->redirect(['view-subject', 'id' => $model->group_id]);
            }else if ($model->groupType->group_type_name == 'อาจารย์ที่ปรึกษา'){
                $groupID = $model->group_id;
                $insertTeacher = new ApprovePosition();
                if (isset($_POST)) {
                    $insertTeacher = new ApprovePosition();
                    $insertTeacher->position_id = '9999';
                    $insertTeacher->position_name = 'อาจารย์ที่ปรึกษา';
                    $insertTeacher->position_order = '1';
                    $insertTeacher->approve_group_id = $groupID;
                    $insertTeacher->save();
                }
                return $this->redirect(['view', 'id' => $model->group_id]);
            }else{
                return $this->redirect(['view', 'id' => $model->group_id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
            'template_id' => $template_id,
        ]);
    }

    /**
     * Updates an existing ApproveGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id,$template_id)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($_POST['ApproveGroup']['group_type_id'] == 1){
                return $this->redirect(['view-subject', 'id' => $model->group_id]);
            }else{
                return $this->redirect(['view', 'id' => $model->group_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'template_id' => $template_id,
        ]);
    }

    /**
     * Deletes an existing ApproveGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$template_id)
    {
        $template_id = $template_id;
        $this->layout = "main_modules";
        $this->findModel($id)->delete();

        return $this->redirect(['req-template/view','id'=>$template_id]);

    }

    /**
     * Finds the ApproveGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ApproveGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ApproveGroup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
