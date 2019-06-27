<?php

namespace app\modules\materialsystem\controllers;

use Yii;
use app\modules\materialsystem\models\MatsysOrderReturn;
use app\modules\materialsystem\models\MatsysOrder;
use app\modules\materialsystem\models\OrderReturnAdminSearch;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderReturnAdminController implements the CRUD actions for MatsysOrder model.
 */
class OrderReturnAdminController extends Controller
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
        $order_return = MatsysOrderReturn::find()->all();

        $countQuery = clone $query;         //คำสั่งสร้าง Page แบ่งหน้า
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $this->layout = 'main_material';
        $searchModel = new OrderReturnAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;

        return $this->render('index', [
            'models' => $models,
            'order_return' => $order_return,
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

    public function actionSubmit_return()
    {
        foreach ($_POST['order_id_list'] as $key => $item) {
            date_default_timezone_set("Asia/Bangkok");
            $return_order = MatsysOrderReturn::find()
                ->where(['order_id' => $item])
                ->andWhere(['material_id' => $_POST['material_id_list'][$key]])
                ->one();
            if (($_POST['return_amount'][$key])=='') {
                $return_order->order_return_amount_use = $_POST['return_amount_default'][$key];
            } else {
                $return_order->order_return_amount_use = $_POST['return_amount'][$key];
            }

            $return_order->order_return_date_accept = date('Y-m-d H:i:s');
            if (!$return_order->save()) return print_r($return_order->errors);
        }

        foreach ($_POST['order_id_list'] as $key => $item) {
            $order = MatsysOrder::findOne($item);
            $order->order_status_return = '2';
            $order->save();
        }
        \Yii::$app->session->setFlash('success', "ตรวจสอบวัสดุเรียบร้อย"); //คำสั่ง alert แจ้งเตือน ทำสำเร็๗
        return $this->redirect(['index']);
    }
}
