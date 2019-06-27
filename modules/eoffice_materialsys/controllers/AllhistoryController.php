<?php

namespace app\modules\eoffice_materialsys\controllers;

use app\modules\eoffice_materialsys\models\MatsysBillDetail;
use app\modules\eoffice_materialsys\models\MatsysOrderHasMaterial;
use Yii;
use app\modules\eoffice_materialsys\models\MatsysOrder;
use app\modules\eoffice_materialsys\models\WidenAdminSearch;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WidenAdminController implements the CRUD actions for MatsysOrder model.
 */
class AllhistoryController extends Controller
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
     * Lists all MatsysOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = MatsysOrder::find();
        $order_mat = MatsysOrderHasMaterial::find()->all();

        $countQuery = clone $query;         //คำสั่งสร้าง Page แบ่งหน้า
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $searchModel = new WidenAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;
        $this->layout = 'main_material';

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'order_mat' => $order_mat,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MatsysOrder model.
     * @param string $order_id
     * @param integer $order_id_ai
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($order_id, $order_id_ai)
    {
        return $this->render('view', [
            'model' => $this->findModel($order_id, $order_id_ai),
        ]);
    }

    /**
     * Creates a new MatsysOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MatsysOrder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'order_id' => $model->order_id, 'order_id_ai' => $model->order_id_ai]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MatsysOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $order_id
     * @param integer $order_id_ai
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($order_id, $order_id_ai)
    {
        $model = $this->findModel($order_id, $order_id_ai);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'order_id' => $model->order_id, 'order_id_ai' => $model->order_id_ai]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MatsysOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $order_id
     * @param integer $order_id_ai
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($order_id, $order_id_ai)
    {
        $this->findModel($order_id, $order_id_ai)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MatsysOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $order_id
     * @param integer $order_id_ai
     * @return MatsysOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($order_id, $order_id_ai)
    {
        if (($model = MatsysOrder::findOne(['order_id' => $order_id, 'order_id_ai' => $order_id_ai])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSaveitem()
    {
//        return Json::encode($_POST);
        foreach ($_POST['order_id_list'] as $key => $item) {
            $order_mat = MatsysOrderHasMaterial::find()
                ->where(['order_id' => $item])
                ->andWhere(['bill_master_id' => $_POST['bill_id_list'][$key]])
                ->andWhere(['material_id' => $_POST['material_id_list'][$key]])
                ->one();
            if ($_POST['order_amount'][$key] == '') {
                $order_mat->material_amount_receive = $_POST['material_amount'][$key];
            } else {
                $order_mat->material_amount_receive = $_POST['order_amount'][$key];
            }
            if (!$order_mat->save()) return print_r($order_mat->errors);
        }

        foreach ($_POST['order_id_list'] as $item) {
            date_default_timezone_set("Asia/Bangkok");
            $order = MatsysOrder::findOne($item);
            $order->order_status = '1';
            $order->order_staff = $_POST['name_admin'];
            $order->order_date_accept = date('Y-m-d H:i:s');
            $order->order_cancel_description = $_POST['order_desc'];
            if (!$order->save()) return print_r($order->errors);
        }
        Yii::$app->session->setFlash('success', "อนุมัติรายการสำเร็จ"); //คำสั่ง alert แจ้งเตือน ทำสำเร็๗
        return $this->redirect(['index']);
    }

    public function actionCancelwiden()
    {
        foreach ($_POST['order_id_list'] as $value) {
            date_default_timezone_set("Asia/Bangkok");
            $order = MatsysOrder::findOne($value);
            $order->order_staff = $_POST['name_admin'];
            $order->order_status = '2';
            $order->order_cancel_description = $_POST['order_cancel_widen'];
            $order->order_date_accept = date("Y-m-d");
            if (!$order->save()) return print_r($order->errors);
        }
        foreach ($_POST['bill_id_list'] as $key => $item) {
            $bill_order = MatsysBillDetail::find()
                ->where(['bill_master_id' => $item])
                ->andWhere(['material_id' => $_POST['material_id_list'][$key]])
                ->andWhere(['bill_detail_use_amount' => $_POST['bill_amount'][$key]])
                ->one();
            $sum = ($_POST['bill_amount'][$key] + $_POST['material_amount'][$key]);
            $bill_order->bill_detail_use_amount = (string)$sum;
            if (!$bill_order->save()) return print_r($bill_order->errors);
        }
        \Yii::$app->session->setFlash('success', "ปฏิเสธรายการสำเร็จ"); //คำสั่ง alert แจ้งเตือน ทำสำเร็จ
        return $this->redirect(['index']);
    }
}
