<?php

namespace app\modules\eoffice_exam\controllers;

use app\modules\eoffice_exam\models\EofficeExamInvigilate;
use Yii;
use app\modules\eoffice_exam\models\ExamTeacherExchange;
use app\modules\eoffice_exam\models\EofficeExamInvigilateSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\eoffice_exam\models\ExamTeacherExchangeSearch;
use app\modules\eoffice_exam\models\ExamPersonSearch;


/**
 * TeacherexchangeController implements the CRUD actions for ExamTeacherExchange model.
 */
class TeacherexchangeController extends Controller
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
     * Lists all ExamTeacherExchange models.
     * @return mixed
     */
    public function actionIndex()
    {
      $searchModel = new ExamTeacherExchangeSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      $dataProvider2 = $searchModel->search2(Yii::$app->request->queryParams);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
            'searchModel' => $searchModel,
          ]);
    }




    public function actionTest($exam_date,$person_id,$examstart_time,$exam_end_time,$rooms_id)
    {
      $model2 = new EofficeExamInvigilate();
      $model = new ExamTeacherExchange();
      $model3 = new ExamPersonSearch();
      $model4 = new ExamTeacherExchange();
      $this->layout = "main_modules";
        return $this->render('form-exchang',[
          'model' => $model,
          'exam_date' => $exam_date,
          'person_id' => $person_id,
          'examstart_time' => $examstart_time,
          'exam_end_time' => $exam_end_time,
          'rooms_id' => $rooms_id,
          'model2' => $model2,
          'model3' => $model3,
          'model4' => $model4,
        ]);


      }

    /**
     * Displays a single ExamTeacherExchange model.
     * @param string $exam_exchange_date
     * @param string $exam_exchange_start_time
     * @param string $exam_exchange_end_time
     * @param integer $person_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($exam_exchange_date, $exam_exchange_start_time, $exam_exchange_end_time, $person_id)
    {
            return $this->render('view', [
            'model' => $this->findModel($exam_exchange_date, $exam_exchange_start_time, $exam_exchange_end_time, $person_id),
        ]);
        session_start();
        $_SESSION["exchangid"] = $person_id;
        session_write_close();
    }

    /**
     * Creates a new ExamTeacherExchange model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      $searchModel = new EofficeExamInvigilateSearch(); //ดึง GridView มาดูในหน้า Create
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams); //ดึง GridView มาดูในหน้า Create
      $model = new EofficeExamInvigilate();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'examdate.exam_date' => $model->exam_exchange_date,
        //      'exam_exchange_start_time' => $model->exam_exchange_start_time,
        //       'exam_exchange_end_time' => $model->exam_exchange_end_time, 'person_id' => $model->person_id]);
        // }
        return $this->render('create', [
            'model' => $model,
            'dataProvider' => $dataProvider,  //ดึง GridView มาดูในหน้า Create
            'searchModel' => $searchModel,    //ดึง GridView มาดูในหน้า Create
        ]);

    }

    /**
     * Updates an existing ExamTeacherExchange model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $exam_exchange_date
     * @param string $exam_exchange_start_time
     * @param string $exam_exchange_end_time
     * @param integer $person_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionForm($exam_date,$person_id,$examstart_time,$exam_end_time,$rooms_id)
    {
      $model = new EofficeExamInvigilate();
      $model2 = new ExamTeacherExchange();
      $model3 = new ExamPersonSearch();
      $this->layout = "main_modules";
        return $this->render('_form',[
          'model' => $model,
          'exam_date' => $exam_date,
          'person_id' => $person_id,
          'examstart_time' => $examstart_time,
          'exam_end_time' => $exam_end_time,
          'rooms_id' => $rooms_id,
          'model2' => $model2,
          'model3' => $model3,
        ]);
    }

    public function actionInsert()
    {
            $insert = new ExamTeacherExchange();
            $insert->load(Yii::$app->request->post());
            $insert = new ExamTeacherExchange();
            $insert->exam_exchange_date = Yii::$app->request->post('date');
            $insert->exam_exchange_start_time = $_POST['Invigilate']['examstart_time'];
            $insert->exam_exchange_end_time = $_POST['Invigilate']['exam_end_time'];
            $insert->person_id = $_POST['Invigilate']['person_id'];
            $insert->rooms_id = $_POST['Invigilate']['rooms_id'];
            $insert->exam_type_namethai = $_POST['ExamTeacherExchange']['exam_type_namethai'];
            $insert->subopen_year = $_POST['ExamTeacherExchange']['subopen_year'];
            $insert->subopen_semester = $_POST['ExamTeacherExchange']['subopen_semester'];
            $insert->eaxm_exchange_tel = $_POST['ExamTeacherExchange']['eaxm_exchange_tel'];
            $insert->exam_exchange_note = $_POST['ExamTeacherExchange']['exam_exchange_note'];

          //  $insert->exam_type_namethai = $_POST['ExamTeacherExchange']['exam_type_namethai'];
            $insert->save(false);

            return $this->redirect(['index']);
    }

    // ฟังก์ชันการแลกเปลี่ยนวันคุมสอบ
    public function actionInsertexchang()
    {
            $insert = new ExamTeacherExchange();
            $insert->load(Yii::$app->request->post());
            $insert = new ExamTeacherExchange();
            $insert->exam_exchange_date = Yii::$app->request->post('date');
            $insert->exam_exchange_start_time = $_POST['Invigilate']['examstart_time'];
            $insert->exam_exchange_end_time = $_POST['Invigilate']['exam_end_time'];
            $insert->person_id = $_POST['ExamExchange']['person_id'];
            $insert->exam_per_exchange = $_POST['ExamExchange']['person_id'];
            $insert->exam_exchange_status = $_POST['ExamExchange']['exam_exchange_status'];

            $insert->save(false);
            //echo "insert successful";
            return $this->redirect(['index']);
    }


    /**
     * Deletes an existing ExamTeacherExchange model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $exam_exchange_date
     * @param string $exam_exchange_start_time
     * @param string $exam_exchange_end_time
     * @param integer $person_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($exam_exchange_date, $exam_exchange_start_time, $exam_exchange_end_time, $person_id)
    {
        $this->findModel($exam_exchange_date, $exam_exchange_start_time, $exam_exchange_end_time, $person_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ExamTeacherExchange model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $exam_exchange_date
     * @param string $exam_exchange_start_time
     * @param string $exam_exchange_end_time
     * @param integer $person_id
     * @return ExamTeacherExchange the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($exam_exchange_date, $exam_exchange_start_time, $exam_exchange_end_time, $person_id)
    {
        if (($model = ExamTeacherExchange::findOne(['exam_exchange_date' => $exam_exchange_date, 'exam_exchange_start_time' => $exam_exchange_start_time, 'exam_exchange_end_time' => $exam_exchange_end_time, 'person_id' => $person_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
 * Updates an existing ExamTeacherExchange model.
 * If update is successful, the browser will be redirected to the 'view' page.
 * @param string $exam_exchange_date
 * @param string $exam_exchange_start_time
 * @param string $exam_exchange_end_time
 * @param integer $person_id
 * @return mixed
 * @throws NotFoundHttpException if the model cannot be found
 */
public function actionUpdate($exam_exchange_date, $exam_exchange_start_time, $exam_exchange_end_time, $person_id)
{
    $model = new EofficeExamInvigilate();
    $searchModel = new EofficeExamInvigilateSearch(); //ดึง GridView มาดูในหน้า Create
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    $model = $this->findModel($exam_exchange_date, $exam_exchange_start_time, $exam_exchange_end_time, $person_id);


    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'exam_exchange_date' => $model->exam_exchange_date, 'exam_exchange_start_time' => $model->exam_exchange_start_time, 'exam_exchange_end_time' => $model->exam_exchange_end_time, 'person_id' => $model->person_id]);
    }


    return $this->render('update', [
        'model' => $model,
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,


    ]);

}




}
