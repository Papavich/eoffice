<?php

namespace app\modules\portfolio\controllers;

use Yii;
use app\modules\portfolio\models\ProjectOrder;
use app\modules\portfolio\models\ProjectOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use kartik\mpdf\Pdf;

/**
 * ProjectOrderController implements the CRUD actions for ProjectOrder model.
 */
class ProjectOrderController extends Controller
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
     * Lists all ProjectOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectOrder model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionShowMe()
    {
        $this->view->params['status'] = 'view3';
        $this->layout = "main";

        $id = Yii::$app->user->getId();
        // return Json::encode($id);


//       $model = $this->findModel($id);

        $query = Yii::$app->getDb()->createCommand("SELECT * FROM view_pis_user where id=$id")->queryOne();


        $query2 = ProjectOrder::find()

            ->where([
                'person_id' => $query['id']
            ])->all();

        //return Json::encode($query2);
        // $modelA = $query->queryAll();
        //   $modelA = $this->findModelAssetDetail($model);
        //  $modelA = AssetDetail::find()->where(['asset_asset_id'=>$id])->all();

        /* $persons = [];
         $persons_main = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user')->queryAll();
         foreach ($persons_main as $person_main) {
             $person['id'] = $person_main['id'];
             $person['name'] = $person_main['user_type_id'] !== '0' ? $person_main['person_name'] . ' ' . $person_main['person_lname_th'] : $person_main['student_fname_th'] . ' ' . $person_main['student_lname_th'];
             array_push($persons, $person);
         }*/
        // return Json::encode($query2);
        return $this->render('view3', [

            'query2' =>  $query2,
            'query' =>  $query,

        ]);


    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProjectOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectOrder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->project_order_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProjectOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->project_order_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionPdf() {

        $query = ProjectOrder::find()->limit(50);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        $content = $this->renderPartial('report',[
            'dataProvider' => $dataProvider,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf(array(
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            //'format' => [100,200],  กว้าง,สูง
            //filename
            'filename' => time(),
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => array(
                'title' => 'codingthailand',
                'subject' => 'person report',
                'keywords' => 'person,codingthailand',
            ),
            // call mPDF methods on the fly
            'methods' => array(
                'SetHeader'=> array('รายงานโดย ระบบผลงาน || ออกรายงานเมื่อ: '.Yii::$app->formatter->asDatetime(time())),
                'SetFooter'=> array('หน้าที่ {PAGENO}'),
            )
        ));

        // return the pdf output as per the destination setting
        return $pdf->render();

    }
    /**
     * Deletes an existing ProjectOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProjectOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectOrder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
