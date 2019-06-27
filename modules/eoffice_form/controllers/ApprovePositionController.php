<?php

namespace app\modules\eoffice_form\controllers;

use app\modules\eoffice_form\models\Position;
use app\modules\eoffice_form\models\PositionDirectors;
use Yii;
use app\modules\eoffice_form\models\ApprovePosition;
use app\modules\eoffice_form\models\ApprovePositionSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ApprovePositionController implements the CRUD actions for ApprovePosition model.
 */
class ApprovePositionController extends Controller
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
     * Lists all ApprovePosition models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new ApprovePositionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ApprovePosition model.
     * @param integer $position_id
     * @param integer $approve_group_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($position_id, $approve_group_id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($position_id, $approve_group_id),
        ]);
    }

    /**
     * Creates a new ApprovePosition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($group_id)
    {
        $this->layout = "main_modules";
        $model = new ApprovePosition();

        if ($model->load(Yii::$app->request->post())) {
            if( $_POST['ApprovePosition']['position_id'] == '9999'){
                if(isset($_POST)){
                    $model->load(Yii::$app->request->post());
                    $ApprovePosition = new ApprovePosition();
                    $ApprovePosition->position_id = $_POST['ApprovePosition']['position_id'];
                    $ApprovePosition->position_name = 'อาจารย์ที่ปรึกษา';
                    $ApprovePosition->position_order = $_POST['ApprovePosition']['position_order'];
                    $ApprovePosition->approve_group_id = $group_id;
                    $ApprovePosition->save();
                    return $this->redirect(['view', 'position_id' => $model->position_id, 'approve_group_id' => $model->approve_group_id]);
                }
            }else{
                $getName = Position::find()
                    ->where(['position_id' => $_POST['ApprovePosition']['position_id']])
                    ->one();
//                foreach ($getName as $item) {
//                    $PositionName = $item->position_name;
//                }
                if(isset($_POST)){
                    $model->load(Yii::$app->request->post());
                    $ApprovePosition = new ApprovePosition();
                    $ApprovePosition->position_id = $_POST['ApprovePosition']['position_id'];
                    $ApprovePosition->position_name = $getName['position_name'];
                    $ApprovePosition->position_order = $_POST['ApprovePosition']['position_order'];
                    $ApprovePosition->approve_group_id = $group_id;
                    $ApprovePosition->save();
                    return $this->redirect(['view', 'position_id' => $model->position_id, 'approve_group_id' => $model->approve_group_id]);
                }
            }

        }
        return $this->render('create', [
            'model' => $model,
            'group_id' => $group_id,
        ]);
    }

    /**
     * Updates an existing ApprovePosition model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $position_id
     * @param integer $approve_group_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($position_id, $approve_group_id)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($position_id, $approve_group_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'position_id' => $model->position_id, 'approve_group_id' => $model->approve_group_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'group_id' => $approve_group_id,
        ]);
    }

    /**
     * Deletes an existing ApprovePosition model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $position_id
     * @param integer $approve_group_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($position_id, $approve_group_id)
    {
        $this->layout = "main_modules";
        $this->findModel($position_id, $approve_group_id)->delete();

        return $this->redirect(['approve-group/view','id'=>$approve_group_id]);
    }

    /**
     * Finds the ApprovePosition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $position_id
     * @param integer $approve_group_id
     * @return ApprovePosition the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($position_id, $approve_group_id)
    {
        if (($model = ApprovePosition::findOne(['position_id' => $position_id, 'approve_group_id' => $approve_group_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
