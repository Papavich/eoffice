<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/18/2017
 * Time: 1:25 AM
 */

namespace app\modules\personsystem\controllers;

use app\modules\personsystem\models\Amphur;
use app\modules\personsystem\models\District;
use app\modules\personsystem\models\AuthAssignment;
use app\modules\personsystem\models\RegPrefix;
use app\modules\personsystem\models\RegStudentbio;
use app\modules\personsystem\models\RegStudentmaster;
use app\modules\personsystem\models\Skill;
use app\modules\personsystem\models\Student;
use app\modules\personsystem\models\StudentListSearch;
use app\modules\personsystem\models\StudentSkill;
use app\modules\personsystem\models\StudentskillSearch;
use app\modules\personsystem\models\User;
use app\modules\personsystem\models\ViewStudentFull;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\base\Exception;

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
                    'admin-delete-student' => ['POST'],
                   // 'admin-update-student'=>['POST'],
                ],
            ],
        ];
    }
    public function actionAdminEditStudentList(){
        $searchModel = new StudentListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $skill = Skill::find()->all();
        $this->layout = "main_modules_for_extenkrajee"; //เมื่อใช้ widget ของ krajee จะใช้ app.js ไม่ได้ มันชนกัน ดังนั้นต้องเอาออก
        return $this->render('student_list',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'skill'=> $skill,
        ]);
    }
    public function actionAdminUpdateStudent($id){
        $model = $this->findModelStudent($id);

        $amphurHome = ArrayHelper::map($this->getAmphur($model->student_home_province_id),'id','name');
        $districtHome = ArrayHelper::map($this->getDistrict($model->student_home_amphur_id),'id','name');
        $amphurCurrent = ArrayHelper::map($this->getAmphur($model->student_current_province_id),'id','name');
        $districtCurrent = ArrayHelper::map($this->getDistrict($model->student_current_amphur_id),'id','name');

        $amphurFather = ArrayHelper::map($this->getAmphur($model->father_province_id),'id','name');
        $districtFather = ArrayHelper::map($this->getDistrict($model->father_amphur_id),'id','name');

        $amphurMother = ArrayHelper::map($this->getAmphur($model->mother_province_id),'id','name');
        $districtMother = ArrayHelper::map($this->getDistrict($model->mother_amphur_id),'id','name');

        $amphurParent = ArrayHelper::map($this->getAmphur($model->parent_province_id),'id','name');
        $districtParent = ArrayHelper::map($this->getDistrict($model->parent_amphur_id),'id','name');
       // $SkillModel = Skill::findOne($studentId);
        $StudentModel = Student::findOne($id); //หานักศึกษา
        if($StudentModel->load( Yii::$app->request->post())){
            try {
                $this->deleteCasecade($id);
            }catch (Exception $e){
                echo $e;
            }
        }
        if ($model->load(Yii::$app->request->post())  && $model->validate()) {
            @unlink(Yii::getAlias('@webroot').'/web_personal/upload/System/'.$model->student_img);
            $model->student_img = $model->upload($model,'student_img');
            if($model->save()){
                Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'success',
                    'duration' => 12000,
                    'icon' => 'fa fa-users',
                    'title' => Yii::t('app', Html::encode('Submission')),
                    'message' => Yii::t('app',Html::encode('บันทึกข้อมูลเสร็จเรียบร้อย')),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
            }else{
                Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'warning',
                    'duration' => 12000,
                    'icon' => 'fa fa-users',
                    'title' => Yii::t('app', Html::encode('error')),
                    'message' => Yii::t('app',Html::encode('error')),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
            }


          //  $modelStudent->save(false);
            return $this->redirect(['admin-view-student', 'id' => $model->STUDENTID]);
        }

            $this->layout = "main_modules";
            return $this->render('update_student', [
                'model' => $model,
                'modelStudent'=>$StudentModel,
                'amphurHome'=> $amphurHome,
                'districtHome'=>$districtHome,
                'amphurCurrent'=> $amphurCurrent,
                'districtCurrent'=>$districtCurrent,
                'amphurFather'=>$amphurFather,
                'districtFather'=>$districtFather,
                'amphurMother'=>$amphurMother,
                'districtMother'=>$districtMother,
                'amphurParent'=>$amphurParent,
                'districtParent'=>$districtParent,
            ]);

    }
    public function deleteCasecade($id)
    {
        StudentSkill::deleteAll( ['id_student' => $id] );
        if(Yii::$app->request->post('Student')['skills']){
            foreach (Yii::$app->request->post('Student')['skills'] as $item){
                if(!Student::findSkillId($item,$id)){//ถ้าไม่มีจะบันทึกลง
                    if (!is_numeric( $item )) {
                        $Skill = new Skill();
                        $Skill->skill_name = $item;
                        $Skill->save();
                        $item = $Skill->id_skill;
                    }
                    $studentSkill = new StudentSkill();
                    $studentSkill->id_student = $id;
                    $studentSkill->id_skill = $item;
                    $studentSkill->save();
                }
                // var_dump(Student::findSkillId($item,$id));
            }
        }
    }
    public function actionAdminDeleteStudent(){
        $request = Yii::$app->request;
        $id = $request->post('id');
        if(RegStudentbio::findOne($id)){
            $this->findModelStudentBio($id)->delete();
        }
        if(Student::findOne($id)){
            $this->findModelStudentCs($id)->delete();
        }
        $this->findModelStudentMaster($id)->delete();
        if(User::find()->where(['person_id'=>$id])->all()){
            $id =  User::find()->where(['person_id'=>$id])->one();
            $this->findModelUser($id)->delete();
        }
        if(AuthAssignment::find()->where(['user_id' => $id])->all()){
            AuthAssignment::deleteAll(['user_id' =>$id]);
        }
        Yii::$app->getSession()->setFlash('alert1', [
            'type' => 'success',
            'duration' => 12000,
            'icon' => 'fa fa-users',
            'title' => Yii::t('app', Html::encode('Delete Complete')),
            'message' => Yii::t('app',Html::encode('ลบข้อมูลเสร็จเรียบร้อย')),
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
        return $this->redirect(['admin-edit-student-list']);
    }

    public function actionAdminViewStudent($id){
        $modelStudent = ViewStudentFull::findOne($id);
        $Student = new ViewStudentFull();
        $model = $Student->getAttributes();
        $modelSkill = StudentSkill::find()->where(['id_student'=>$id])->all();
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

        $this->layout = "main_modules_for_extenkrajee"; //เมื่อใช้ widget ของ krajee จะใช้ app.js ไม่ได้ มันชนกัน ดังนั้นต้องเอาออก
        return $this->render('view_student',[
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
            'modelSkill'=>$modelSkill,
        ]);
    }

    protected function findModelStudentSkill($id)
    {
        if (($model = StudentSkill::find()->where(['is_student'=>$id])->all()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    protected function findModelStudent($id)
    {
        if (($model = ViewStudentFull::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    protected function findModelStudentBio($id)
    {
        if (($model = RegStudentbio::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    protected function findModelStudentMaster($id)
    {
        if (($model = RegStudentmaster::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    protected function findModelStudentCs($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    protected function findModelUser($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function getAmphur($id){
        $datas = Amphur::find()->where(['PROVINCE_ID'=>$id])->all();
        return $this->MapData($datas,'AMPHUR_ID','AMPHUR_NAME');
    }
    protected function getDistrict($id){
        $datas = District::find()->where(['AMPHUR_ID'=>$id])->all();
        return $this->MapData($datas,'DISTRICT_ID','DISTRICT_NAME');
    }
    protected function MapData($datas,$fieldId,$fieldName){
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id'=>$value->{$fieldId},'name'=>$value->{$fieldName}]);
        }
        return $obj;
    }

    public function actionSearchStudentSkill(){
        if(Yii::$app->request->get('id_skill')){
            $skill = Yii::$app->request->get('id_skill');
            $searchModel = new StudentskillSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$skill);
        }else{
            $skill = [];
            $searchModel = new StudentskillSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$skill);
        }



        $this->layout="main_modules_for_extenkrajee";
        return $this->render('search_skill',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}