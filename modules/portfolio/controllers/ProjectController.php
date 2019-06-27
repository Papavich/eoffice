<?php

namespace app\modules\portfolio\controllers;

use Yii;
use app\modules\portfolio\models\Project;
use app\modules\portfolio\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $pro = new  Project();
        $persons = [];
        $persons_main = Yii::$app->getDb()->createCommand('SELECT id FROM view_pis_user')->queryOne();
        foreach ($persons_main as $person_main) {
            if($person_main === $pro->person_id)
            $person['id'] = $person_main['id'];
            $person['name'] = $person_main['user_type_id'] !== '0' ? $person_main['person_name'] . ' ' . $person_main['person_lname_th'] : $person_main['student_fname_th'] . ' ' . $person_main['student_lname_th'];
            array_push($persons, $person);
        }

        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
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
    public function actionPdf() {

        $query = Project::find()->limit(50);

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
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionShow()
    {
        $this->view->params['status'] = 'index3';
        $this->layout = "main";


        $projects = Project::find()->all();

        $data["projects"] = $projects;



        return $this->render("index3", $data);

    }

    public function actionCreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->project_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->project_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Project model.
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
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
