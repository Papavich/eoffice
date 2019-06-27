<?php

namespace app\modules\requestform\controllers;

use Yii;
use app\modules\requestform\models\ReqForm;
use app\modules\requestform\models\ReqFlowSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\requestform\models\ReqTemplate;
use app\modules\requestform\models\ReqFlow;
use app\modules\requestform\models\ReqApprove;
/**
 * FlowController implements the CRUD actions for ReqForm model.
 */
class FlowController extends Controller
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
     * Lists all ReqForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new ReqFlowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReqForm model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($form_id)
    {
        $this->layout = "main_modules";
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

        $flow = ReqFlow::find()->where(['req_form_form_id' => $form_id])->all();
        foreach ($flow as $item) {
            $flow_id = $item->flow_id;
        }
        $AllConsider = [];
        $total = 0;
        $approve = ReqApprove::find()->where(['req_flow_flow_id' => $flow_id])->andWhere(['<>','approve_status', 'รอการพิจารณา'])->all();
        foreach ($approve as $item) {
            //$approve_running = $item->approve_running;
            $approve = [];
            $approve["status"] = $item->approve_status;
            $approve["comment"] = $item->approve_comment;
            //array_push($approve,$approve);
            array_push($AllConsider,$approve);
            $total++;
        }

        //echo '<pre>';print_r($AllConsider);echo '</pre>';
        return $this->render('view', [
            'model' => $model,
            'req_att' => $req_att,
            'req_name' => $req_name,
            'form_value' => $form_value,
            'AllConsider' => json_encode($AllConsider),
            'total' => $total,
        ]);
    }

    /**
     * Creates a new ReqForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ReqForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->form_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ReqForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->form_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ReqForm model.
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
     * Finds the ReqForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReqForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReqForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
