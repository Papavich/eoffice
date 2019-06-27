<?php

namespace app\modules\eoffice_materialsys\controllers;

use app\modules\eoffice_materialsys\models\MatsysOrderHasMaterial;
use app\modules\eoffice_materialsys\models\MatsysOrderReturn;
use Yii;
use app\modules\eoffice_materialsys\models\MatsysOrder;
use app\modules\eoffice_materialsys\models\OrderReturnUserSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderReturnUserController implements the CRUD actions for MatsysOrder model.
 */
class OrderreturnuserController extends Controller
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
        $query = MatsysOrder::find()->where(['person_id' => \app\modules\eoffice_materialsys\models\Person::findOne(Yii::$app->user->identity->getId())->id]);
        $order_mat = MatsysOrderHasMaterial::find()->all();
        $order_return = MatsysOrderReturn::find()->all();

        $countQuery = clone $query;         //คำสั่งสร้าง Page แบ่งหน้า
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $this->layout = 'main_material';
        $searchModel = new OrderReturnUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;

        return $this->render('index', [
            'models' => $models,
            'order_mat' => $order_mat,
            'order_return' => $order_return,
            'pages' => $pages,
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

    public function actionReturnsubmit()
    {
        $order_id_list = [];
        $mat_id_list = [];
        $return_amount_list = [];
        $stock_id_list = [];
        foreach (Yii::$app->request->post() as $key => $post) {
            if (strpos($key, 'order_id') === 0) {
                array_push($order_id_list, $post);
            } else if (strpos($key, 'order_return_amount') === 0) {
                array_push($return_amount_list, $post);
            } else if (strpos($key, 'material_id') === 0) {
                array_push($mat_id_list, $post);
            } else if (strpos($key, 'stock_id') === 0) {
                array_push($stock_id_list, $post);
            }
        }

        foreach ($_POST['bill_id'] as $key => $value)
        {
            date_default_timezone_set("Asia/Bangkok");
            $order_return = new MatsysOrderReturn();
            $order_return->bill_master_id = $_POST['bill_id'][$key];
            $order_return->order_id_ai = $_POST['order_ai'][$key];
            $order_return->order_id = $_POST['order_id_check'][$key];
            $order_return->material_id = $_POST['mat_id_check'][$key];
            if ($_POST['order_return_amount'][$key] != null) {
                $order_return->order_return_amount = $_POST['order_return_amount'][$key];
            } else {
                $order_return->order_return_amount = $_POST['order_return_amount_default'][$key];
            }
            $order_return->order_return_date = date('Y-m-d H:i:s');
            if ($order_return->order_return_amount != 0) {
                $order_return->save();
            }
        }

        foreach ($_POST['order_id_check'] as $value1) {
            $order = MatsysOrder::findOne($value1);
            $order->order_status_return = '1';
            $order->save();
        }

        \Yii::$app->session->setFlash( 'success', "ทำรายการสำเร็จ" ); //คำสั่ง alert แจ้งเตือน ทำสำเร็จ
        return $this->redirect(['index']);
    }
}
