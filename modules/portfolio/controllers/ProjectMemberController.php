<?php

namespace app\modules\portfolio\controllers;

use app\modules\portfolio\models\Project;
use Yii;
use app\modules\portfolio\models\ProjectMember;
use app\modules\portfolio\models\ProjectMemberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\pdf;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
/**
 * ProjectMemberController implements the CRUD actions for ProjectMember model.
 */
class ProjectMemberController extends Controller
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
    public  function actionPdf()
    {
        $query = ProjectMember::find()->limit(50);
        $dataProvider = new \yii\data\ActiveDataProvider(
            [
                'query' => $query,
                'pagination' => false,
            ]
        );
        $content = $this->renderPartial('report',[
            'dataProvider' => $dataProvider,
        ]);

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
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
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>['ออกรายงานโดย'.Yii::$app->formatter->asDate(time())],
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public function actionExcel($model) {

        $query = ProjectMember::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        $count = $dataProvider->getTotalCount();

        $content = $this->renderPartial('excelreport',[
            'model' => $dataProvider,
            'count' => $count
        ]);
        $fileName = 'PersonReport'.time().'.xls';
        $options = ['mimeType' => 'application/vnd.ms-excel'];

        Yii::$app->response->sendContentAsFile($content, $fileName,$options);
        Yii::$app->end();
    }

    /**
     * Lists all ProjectMember models.
     * @return mixed
     */
    public function actionPromem()
    {
        // $this->view->params['status'] = 'add_project';
        $this->layout = "main";
        $model3 = ProjectMember::find()->all();
        $searchModel = new ProjectMemberSearch();


        return $this->render('Promem',
            ['model3'=>$model3,
                'searchModel' => $searchModel,


            ]);


    }
    public function actionPubindex()
    {
        // $this->view->params['status'] = 'add_project';
        $this->layout = "main";
        $model2 = Project::find()->all();


        return $this->render('Show3',
            ['model2'=>$model2]);


    }

    public function actionIndex()
    {
        $searchModel = new ProjectMemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectMember model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProjectMember model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectMember();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pro_member_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProjectMember model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pro_member_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProjectMember model.
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
     * Finds the ProjectMember model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectMember the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectMember::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
