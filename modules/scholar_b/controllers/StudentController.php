<?php

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\model_main\EofficeCentralViewPisPerson;
use app\modules\scholar_b\models\model_main\EofficeCentralViewPisUser;
use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;
use app\modules\scholar_b\models\ScbStudent;
use app\modules\scholar_b\models\ScbStudentHasTeacher;
use Yii;
use app\modules\scholar_b\models\model_main\EofficeMainStudent;
use app\modules\scholar_b\models\model_main\EofficeMainStudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\personsystem\controllers\GetModelController;

/**
 * StudentController implements the CRUD actions for EofficeMainStudent model.
 */
class StudentController extends Controller
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
     * Lists all EofficeMainStudent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EofficeMainStudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EofficeMainStudent model.
     * @param integer $studentbio_id
     * @param string $STUDENTID
     * @param integer $adviser_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionInfoFull($id){
        $modelStudent = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE'=>$id])->one();
        $Student = new EofficeCentralViewStudentFull();
        $model = $Student->getAttributes();

        $student = ScbStudent::find()->where(['student_id'=>$id])->one();
        $teacher = ScbStudentHasTeacher::find()->where(['student_id'=>$id,'teacher_type_id'=>'1'])->one();
        if($teacher!=null) {
            $teacher_detail = EofficeCentralViewPisPerson::find()->where(['person_card_id' => $teacher->teacher_id_card])->one();
        }else $teacher_detail="";


        foreach (array_keys($model) as $item) {
            if($modelStudent->$item==""){$modelStudent->$item = "<span style='color:red'>N/A</span>";}
        }
        if(isset($modelStudent->STUDENTSTATUS)&&$modelStudent->STUDENTSTATUS!=""){
            if($modelStudent->STUDENTSTATUS == "10"){
                $modelStudent->STUDENTSTATUS = "นักศึกษาปัจจุบัน";
            }else if($modelStudent->STUDENTSTATUS == "11"){
                $modelStudent->STUDENTSTATUS = "รักษาสภาพนักศึกษา";
            }else if($modelStudent->STUDENTSTATUS == "12"){
                $modelStudent->STUDENTSTATUS = "ลาพักการเรียน";
            }else if($modelStudent->STUDENTSTATUS == "40"){
                $modelStudent->STUDENTSTATUS = "สำเร็จการศึกษา";
            }else if($modelStudent->STUDENTSTATUS == "61"){
                $modelStudent->STUDENTSTATUS = "พ้นสภาพเนื่องจากไม่ชำระค่าลงทะเบียนต่อ";
            }else{
                $modelStudent->STUDENTSTATUS = "N/A";
            }
        }


        return $this->render('info-full',[
            'modelStudent'=> $modelStudent,
            'District' =>  GetModelController::getFindDistrict($modelStudent->student_home_district_id),
            'Province'=> GetModelController::getFindProvince($modelStudent->student_home_province_id),
            'Amphur' => GetModelController::getFindAmphur($modelStudent->student_home_amphur_id),
            'Zipcode' => GetModelController::getFindZipcode($modelStudent->student_home_zipcode_id),
            'Current_District' => GetModelController::getFindDistrict($modelStudent->student_current_district_id),
            'Current_Province' => GetModelController::getFindProvince($modelStudent->student_current_province_id),
            'Current_Amphur' => GetModelController::getFindAmphur($modelStudent->student_current_amphur_id),
            'Current_Zipcode' => GetModelController::getFindZipcode($modelStudent->student_current_zipcode_id),
            'Father_District' => GetModelController::getFindDistrict($modelStudent->father_district_id),
            'Father_Province' => GetModelController::getFindProvince($modelStudent->father_province_id),
            'Father_Amphur' => GetModelController::getFindAmphur($modelStudent->father_amphur_id),
            'Father_Zipcode' => GetModelController::getFindZipcode($modelStudent->father_zipcode_id),
            'Mother_District' => GetModelController::getFindDistrict($modelStudent->mother_district_id),
            'Mother_Province' => GetModelController::getFindProvince($modelStudent->mother_province_id),
            'Mother_Amphur' => GetModelController::getFindAmphur($modelStudent->mother_amphur_id),
            'Mother_Zipcode' => GetModelController::getFindZipcode($modelStudent->mother_zipcode_id),
            'Father_Religion' => GetModelController::getFindReligion($modelStudent->father_religion),
            'Mother_Religion' => GetModelController::getFindReligion($modelStudent->mother_religion),
            'Father_Nation' => GetModelController::getFindNation($modelStudent->father_nationality),
            'Mother_Nation' => GetModelController::getFindNation($modelStudent->mother_nationality),
            'Parent_District' => GetModelController::getFindDistrict($modelStudent->parent_district_id),
            'Parent_Province' => GetModelController::getFindProvince($modelStudent->parent_province_id),
            'Parent_Amphur' => GetModelController::getFindAmphur($modelStudent->parent_amphur_id),
            'Parent_Zipcode' => GetModelController::getFindZipcode($modelStudent->parent_zipcode_id),
            'student'=>$student,
            'teacher_detail'=>$teacher_detail,
        ]);


    }
    public function actionView($studentbio_id, $STUDENTID, $adviser_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($studentbio_id, $STUDENTID, $adviser_id),
        ]);
    }

    /**
     * Creates a new EofficeMainStudent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EofficeMainStudent();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'studentbio_id' => $model->studentbio_id, 'STUDENTID' => $model->STUDENTID, 'adviser_id' => $model->adviser_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EofficeMainStudent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $studentbio_id
     * @param string $STUDENTID
     * @param integer $adviser_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($studentbio_id, $STUDENTID, $adviser_id)
    {
        $model = $this->findModel($studentbio_id, $STUDENTID, $adviser_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'studentbio_id' => $model->studentbio_id, 'STUDENTID' => $model->STUDENTID, 'adviser_id' => $model->adviser_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EofficeMainStudent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $studentbio_id
     * @param string $STUDENTID
     * @param integer $adviser_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($studentbio_id, $STUDENTID, $adviser_id)
    {
        $this->findModel($studentbio_id, $STUDENTID, $adviser_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EofficeMainStudent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $studentbio_id
     * @param string $STUDENTID
     * @param integer $adviser_id
     * @return EofficeMainStudent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($studentbio_id, $STUDENTID, $adviser_id)
    {
        if (($model = EofficeMainStudent::findOne(['studentbio_id' => $studentbio_id, 'STUDENTID' => $STUDENTID, 'adviser_id' => $adviser_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
