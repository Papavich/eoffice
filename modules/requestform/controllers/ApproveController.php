<?php

namespace app\modules\requestform\controllers;

use Yii;
use app\modules\requestform\models\ReqApprove;
use app\modules\requestform\models\ReqApproveSearch;
use app\modules\requestform\models\ReqTemplate;
use app\modules\requestform\models\ReqForm;
use app\modules\requestform\models\ReqFlow;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ApproveController implements the CRUD actions for ReqApprove model.
 */
class ApproveController extends Controller
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
        $searchModel = new ReqApproveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->query->andWhere(['approve_id'=>Yii::$app->user->identity->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex2()
    {
        $this->layout = "main_modules";
        $searchModel = new ReqApproveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->query->andWhere(['approve_id'=>Yii::$app->user->identity->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex3()
    {
        $this->layout = "main_modules";
        $searchModel = new ReqApproveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->query->andWhere(['approve_id'=>Yii::$app->user->identity->id]);

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
        //$model = ReqApprove::find()->where(['req_flow_flow_id' => $flow_id ,'approve_id' => (Yii::$app->user->identity->id) ])->all();
        return $this->render('view', [
            'model' => $model,
            'req_att' => $req_att,
            'req_name' => $req_name,
            'form_value' => $form_value,
        ]);
    }

    /**
     * Creates a new ReqApprove model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
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
*/
    /**
     * Updates an existing ReqApprove model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $this->layout = "main_modules";
        $flow_id = $_POST['flow_id'];
        $user_id = $_POST['user_id'];
        $status = $_POST['ReqApprove']['approve_status'];
        $comment = $_POST['ReqApprove']['approve_comment'];
        $model = ReqApprove::find()->where(['req_flow_flow_id' => $flow_id, 'approve_id' => $user_id])->one();
        if (isset($_POST)) {
           // $model->load(Yii::$app->request->post());
            $approve = ReqApprove::find()->where(['req_flow_flow_id' => $flow_id, 'approve_id' => $user_id])->one();
            $approve->approve_status = $status;
            $approve->approve_comment = $comment;
            $approve->approve_date = (date('Y-m-d H:i:s'));
            $approve->save(false);
            if($status == 'ไม่ผ่านการพิจารณา'){
                $flow = ReqFlow::find()->where(['flow_id' => $flow_id])->one();
                $flow->flow_status = 'ไม่ผ่านการพิจารณา';
                $flow->flow_enddate = (date('Y-m-d H:i:s'));
                $flow->save(false);

            }else{
                $allQueue = ReqApprove::find()->where(['req_flow_flow_id' => $flow_id])->all();
                $allQueue = count ( $allQueue );

                $results = ReqApprove::find()->where(['req_flow_flow_id' => $flow_id, 'approve_visible' => '1'])->all();
                $count = (count ( $results ))+1;

                $queue = ReqApprove::find()->where(['req_flow_flow_id' => $flow_id, 'approve_queue' => $count])->one();
                if (isset($_POST)) {
                    // $queue->load(Yii::$app->request->post());
                    if($count <= $allQueue ){
                        $queue = ReqApprove::find()->where(['req_flow_flow_id' => $flow_id, 'approve_queue' => $count])->one();
                        $queue->approve_visible = '1';
                        $queue->save(false);
                    }else{
                        $flow = ReqFlow::find()->where(['flow_id' => $flow_id])->one();
                        $flow->flow_status = 'ผ่านการพิจารณา';
                        $flow->flow_enddate = (date('Y-m-d H:i:s'));
                        $flow->save(false);
                    }
                }
            }

            $searchModel = new ReqApproveSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
            //$dataProvider->query->andWhere(['approve_id'=>Yii::$app->user->identity->id]);
            //$model = User::find()->where(['status' => 0])->orderBy('userid')->count();
        }
    }

    /**
     * Deletes an existing ReqApprove model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    */

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
