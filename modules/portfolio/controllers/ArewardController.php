<?php

namespace app\modules\portfolio\controllers;

use Yii;
use app\modules\portfolio\models\Areward;
use app\modules\portfolio\models\ArewardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\jui\DatePicker;
use kartik\datetime\DateTimePicker;
use kartik\widgets\DepDrop;
use yii\widgets\ActiveForm;


/**
 * ArewardController implements the CRUD actions for Areward model.
 */
class ArewardController extends Controller
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
     * Lists all Areward models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArewardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Areward model.
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
     * Creates a new Areward model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Areward();

        $persons = [];
        $persons_main = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user')->queryAll();
        foreach ($persons_main as $person_main) {
            $person['id'] = $person_main['id'];
            $person['name'] = $person_main['user_type_id'] === '1' ? $person_main['person_fname_th'] . ' ' . $person_main['person_lname_th'] : $person_main['student_fname_th'] . ' ' . $person_main['student_lname_th'];
            array_push($persons, $person);
        }
        $stds = [];
        $stds_main = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user')->queryAll();
        foreach ($stds_main as $std_main) {
            $std['id'] = $std_main['id'];
            $std['name'] = $std_main['user_type_id'] !== '0' ?   $std_main['person_fname_th'] . ' ' .  $std_main['person_lname_th']  : $std_main['student_fname_th'] . ' ' . $std_main['student_lname_th'];
            array_push($stds, $std);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'image');
            if($file->size!=0){
                $model->image = $file->name;
                $file->saveAs('web_pfo/areward/'.$file->name);
                $model->save();

            }
            return $this->redirect(['view', 'id' => $model->areward_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'persons' => $persons,
            'stds' => $stds,
        ]);
    }

    /**
     * Updates an existing Areward model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public  function actionPdf()
    {
        $query = Areward::find()->limit(50);
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
            'format' => Pdf::FORMAT_A3,
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->areward_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Areward model.
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
     * Finds the Areward model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Areward the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Areward::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
