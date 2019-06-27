<?php

namespace app\modules\eoffice_materialsys\controllers;

use app\modules\eoffice_materialsys\models\MatsysOrderHasMaterial;
use Yii;
use app\modules\eoffice_materialsys\models\MatsysOrder;
use app\modules\eoffice_materialsys\models\OrderStatusSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderStatusController implements the CRUD actions for MatsysOrder model.
 */
class OrderstatusController extends Controller
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
        $query = MatsysOrder::find()
            ->where(['person_id' => \app\modules\eoffice_materialsys\models\Person::findOne(Yii::$app->user->identity->getId())->id])
            ->andWhere('order_status_confirm = "confirm"')
            ->andWhere('order_status_notification = "notread"')
        ;
        $model_order = MatsysOrderHasMaterial::find()->all();

        $countQuery = clone $query;         //คำสั่งสร้าง Page แบ่งหน้า
        $pages = new Pagination( ['totalCount' => $countQuery->count(), 'pageSize' => 10] );
        $models = $query->offset( $pages->offset )
            ->limit( $pages->limit )
            ->all();

        $this->layout = 'main_material';
        $searchModel = new OrderStatusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;
        $this->layout = 'main_material';
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'model_order' => $model_order,
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

    public function actionAmountstatus(){
        $person_id = Yii::$app->user->identity->getId();
        $sum = MatsysOrder::find()
            ->where(['person_id' =>$person_id])
            ->andWhere('order_status != "0"')
            ->andWhere('order_status_confirm = "confirm"')
            ->andWhere('order_status_notification = "notread"')
        ->count();
        echo $sum;
    }

    public function actionUpdateread(){
        $order_id = Yii::$app->request->post('order_id');
        $order = MatsysOrder::find()
            ->where('order_id = :order_id',[':order_id'=>$order_id])
            ->one();
        if($order->order_status == "1"){
            $order->order_status_notification = "read";
            $order->save(false);
        }
    }
}
