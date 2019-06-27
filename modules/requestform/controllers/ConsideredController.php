<?php

namespace app\modules\requestform\controllers;

use Yii;
use app\modules\requestform\models\ReqApprove;
use app\modules\requestform\models\ConsideredSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\requestform\models\ReqTemplate;
use app\modules\requestform\models\ReqForm;
use app\modules\requestform\models\ReqFlow;

/**
 * ConsideredController implements the CRUD actions for ReqApprove model.
 */
class ConsideredController extends Controller
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
     * Lists all ReqApprove models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new ConsideredSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReqApprove model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($flow_id)
    {
        $this->layout = "main_modules";
        $flow = ReqFlow::find()->where(['flow_id' => $flow_id])->all();
        foreach ($flow as $item) {
            $form_id = $item->req_form_form_id;
        }
        $form = ReqForm::find()->where(['form_id' => $form_id])->all();
        foreach ($form as $item) {
            $form_value = $item->form_value;
            $template_id = $item->req_template_template_id;
        }
        $model = ReqTemplate::find()->where(['template_id' => $template_id])->all();
        foreach ($model as $item) {
            $req_name = $item->template_name;
            $req_att = $item->template_attribute;
            //$req_accept = $item->template_accept;
        }
        $model = new ReqApprove();
        $approve = ReqApprove::find()->where(['req_flow_flow_id' => $flow_id ,'approve_id' => (Yii::$app->user->identity->id) ])->all();
        foreach ($approve as $item) {
            $approve_status = $item->approve_status;
            $approve_comment = $item->approve_comment;
        }
        return $this->render('view', [
            'model' => $model,
            'req_att' => $req_att,
            'req_name' => $req_name,
            'form_value' => $form_value,
            'approve_status' => $approve_status,
            'approve_comment' => $approve_comment,
        ]);
    }

    /**
     * Creates a new ReqApprove model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ReqApprove();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->approve_running]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ReqApprove model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->approve_running]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ReqApprove model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ReqApprove model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReqApprove the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReqApprove::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
