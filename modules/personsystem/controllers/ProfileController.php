<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/29/2017
 * Time: 7:23 AM
 */

namespace app\modules\personsystem\controllers;


use app\modules\personsystem\models\Amphur;
use app\modules\personsystem\models\District;
use app\modules\personsystem\models\AuthAssignment;
use app\modules\personsystem\models\Expertise;
use app\modules\personsystem\models\ExpertiseSearch;
use app\modules\personsystem\models\HistoryEducation;
use app\modules\personsystem\models\HistorySearch;
use app\modules\personsystem\models\Person;
use app\modules\personsystem\models\RegDepartment;
use app\modules\personsystem\models\RegFaculty;
use app\modules\personsystem\models\Responsibility;
use app\modules\personsystem\models\ResponsibilitySearch;
use app\modules\personsystem\models\Skill;
use app\modules\personsystem\models\StaffSearch;
use app\modules\personsystem\models\Student;
use app\modules\personsystem\models\StudentSkill;
use app\modules\personsystem\models\ViewStudentFull;
use dektrium\user\models\SettingsForm;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use dektrium\user\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class ProfileController extends Controller
{
    use AjaxValidationTrait;
    use EventTrait;
    const EVENT_BEFORE_ACCOUNT_UPDATE = 'beforeAccountUpdate';

    public function actionLists($id)
    {
        $posts = RegDepartment::find()
            ->where(['FACULTYID' => $id])
            ->orderBy('FACULTYID DESC')
            ->all();

        if (!empty($posts)) {
            foreach($posts as $post) {
                echo "<option value='".$post->DEPARTMENTID."'>".$post->DEPARTMENTNAME."</option>";
            }
        } else {
            echo "<option>-</option>";
        }

    }
    public function actionTeacher(){
        $model = $this->findModel(\Yii::$app->user->identity->person_id);
        $model2 = $this->findModelUser(\Yii::$app->user->identity->person_id);
        $amphurHome = ArrayHelper::map($this->getAmphur($model->person_home_province),'id','name');
        $districtHome = ArrayHelper::map($this->getDistrict($model->person_home_amphur),'id','name');
        $amphurCurrent = ArrayHelper::map($this->getAmphur($model->person_current_province),'id','name');
        $districtCurrent = ArrayHelper::map($this->getDistrict($model->person_current_amphur),'id','name');
        $searchModelEdu = new HistorySearch();
        $dataProviderEdu = $searchModelEdu->search(\Yii::$app->request->queryParams,\Yii::$app->user->identity->person_id);
        $searchModelExper = new ExpertiseSearch();
        $dataProviderExper = $searchModelExper->search(\Yii::$app->request->queryParams,\Yii::$app->user->identity->person_id);
        $modelExper = new Expertise();
        /** @var SettingsForm $model */
        $modelReset = \Yii::createObject(SettingsForm::className());
//        $request = Yii::$app->request;
//        if($request->post('new_password1')&&$request->post('new_password2')){
//            $pass1 =$request->post('new_password1');
//            $pass2 =$request->post('new_password2');
//            if($pass1==$pass2){
//                $new_password = $pass1;
//                $modelReset->new_password = $new_password;
//            }else{
//                $new_password = false;
//            }
//        }
        $event = $this->getFormEvent($modelReset);
        $this->performAjaxValidation($modelReset);
        $this->trigger(self::EVENT_BEFORE_ACCOUNT_UPDATE, $event);
        if ($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model2->username =  $model->person_card_id;
            //$model2->password =  $model->person_citizen_id;
            //$model2->email = $model->person_email;
            @unlink(Yii::getAlias('@webroot').'/web_personal/upload/person/'.$model->person_img);
            $model->person_img = $model->upload($model,'person_img');
            $model->save();
            $model2->save();

            \Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => \Yii::t('app', Html::encode('Submission')),
                'message' => \Yii::t('app',Html::encode('บันทึกข้อมูลเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['teacher']);
        }
        $this->layout = "main_modules";
        return $this->render('teacher_form', [
            'model' => $model,
            'amphurHome'=> $amphurHome,
            'districtHome'=>$districtHome,
            'amphurCurrent'=> $amphurCurrent,
            'districtCurrent'=>$districtCurrent,
            'searchModelEdu' => $searchModelEdu,
            'dataProviderEdu' => $dataProviderEdu,
            'searchModelExper' => $searchModelExper,
            'dataProviderExper' => $dataProviderExper,
            'modelExper'=>$modelExper,
            'modelReset' => $modelReset,

        ]);
    }
    public function actionStaff(){
        $model = $this->findModel(\Yii::$app->user->identity->person_id);
        $modelUser = $this->findModelUser(\Yii::$app->user->identity->person_id);
        $amphurHome = ArrayHelper::map($this->getAmphur($model->person_home_province),'id','name');
        $districtHome = ArrayHelper::map($this->getDistrict($model->person_home_amphur),'id','name');
        $amphurCurrent = ArrayHelper::map($this->getAmphur($model->person_current_province),'id','name');
        $districtCurrent = ArrayHelper::map($this->getDistrict($model->person_current_amphur),'id','name');
        $searchModelEdu = new HistorySearch();
        $dataProviderEdu = $searchModelEdu->search(\Yii::$app->request->queryParams,$model->person_id);
        $searchModelRespon = new ResponsibilitySearch();
        $dataProviderRespon = $searchModelRespon->search(\Yii::$app->request->queryParams,$model->person_id);
        $modelRespon = new Responsibility();
        /** @var SettingsForm $model */
        $modelReset = \Yii::createObject(SettingsForm::className());

        $event = $this->getFormEvent($modelReset);
        $this->performAjaxValidation($modelReset);
        $this->trigger(self::EVENT_BEFORE_ACCOUNT_UPDATE, $event);


        if ($model->load(\Yii::$app->request->post())&& $model->validate()) {
            $modelUser->username =  $model->person_card_id;
            //$model2->password =  $model->person_citizen_id;
            //$model2->email = $model->person_email;
            @unlink(Yii::getAlias('@webroot').'/web_personal/upload/person/'.$model->person_img);
            $model->person_img = $model->upload($model,'person_img');
            $model->save();
            $modelUser->save();
            \Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => \Yii::t('app', Html::encode('Submission')),
                'message' => \Yii::t('app',Html::encode('บันทึกข้อมูลเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['staff']);
        }
        $this->layout = "main_modules";
        return $this->render('staff_form', [
            'model' => $model,
            'amphurHome'=> $amphurHome,
            'districtHome'=>$districtHome,
            'amphurCurrent'=> $amphurCurrent,
            'districtCurrent'=>$districtCurrent,
            'searchModelEdu' => $searchModelEdu,
            'dataProviderEdu' => $dataProviderEdu,
            'searchModelRespon' => $searchModelRespon,
            'dataProviderRespon' => $dataProviderRespon,
            'modelRespon' => $modelRespon,
            // 'model2' => $model2,
            'modelReset' => $modelReset,
        ]);
    }

    public function actionStudent(){
        $id = \Yii::$app->user->identity->person_id;
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
        $StudentModel = Student::findOne($id); //หานักศึกษา
        if($StudentModel->load( Yii::$app->request->post())){
            try {
                $this->deleteCasecade($id);
            }catch (Exception $e){
                echo $e;
            }
        }
        $modelReset = \Yii::createObject(SettingsForm::className());
        $event = $this->getFormEvent($modelReset);
        $this->performAjaxValidation($modelReset);
        $this->trigger(self::EVENT_BEFORE_ACCOUNT_UPDATE, $event);
        if ($model->load(Yii::$app->request->post())  && $model->validate()){
            @unlink(Yii::getAlias('@webroot').'/web_personal/upload/System/'.$model->student_img);
            $model->student_img = $model->upload($model,'student_img');
            $model->save();
            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app',Html::encode('บันทึกข้อมูลเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['student']);
        }
        if($model->STUDENTSTATUS!=""){
            if($model->STUDENTSTATUS == "10"){
                $model->STUDENTSTATUS = "นักศึกษาปัจจุบัน";
            }else if($model->STUDENTSTATUS == "11"){
                $model->STUDENTSTATUS = "รักษาสภาพนักศึกษา";
            }else if($model->STUDENTSTATUS == "12"){
                $model->STUDENTSTATUS = "ลาพักการเรียน";
            }else if($model->STUDENTSTATUS == "40"){
                $model->STUDENTSTATUS = "สำเร็จการศึกษา";
            }else if($model->STUDENTSTATUS == "61"){
                $model->STUDENTSTATUS = "พ้นสภาพเนื่องจากไม่ชำระค่าลงทะเบียนต่อ";
            }else{
                $model->STUDENTSTATUS = "";
            }
        }
        $this->layout = "main_modules";
        return $this->render('student_form', [
            'model' => $model,
            'modelReset'=>$modelReset,
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
            'modelStudent'=>$StudentModel,
        ]);
    }
    public function actionViewStudent(){
        $modelStudent = ViewStudentFull::findOne(\Yii::$app->user->identity->person_id);
        $Student = new ViewStudentFull();
        $model = $Student->getAttributes();

        foreach (array_keys($model) as $item) {
            if($modelStudent->$item==""){$modelStudent->$item = "<span style='color:red'>N/A</span>";}
        }
        if($modelStudent->STUDENTSTATUS!=""){
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
        $this->layout = "main_modules";
        return $this->render('student',[
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
        ]);
    }
    protected function findModelStudent($id)
    {
        if (($model = ViewStudentFull::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionViewTeacher(){
        $model = Person::findOne(\Yii::$app->user->identity->person_id);
        $modelEduca = HistoryEducation::find()->where(['person_id' => \Yii::$app->user->identity->person_id])->all();
        $modelExpertise = Expertise::find()->where(['person_id' => \Yii::$app->user->identity->person_id])->all();
        $Teacher = new Person();
        $model2 = $Teacher->getAttributes();
        foreach (array_keys($model2) as $item) {
            if($model->$item==""){$model->$item = "<span style='color:red'>N/A</span>";}
        }
        $this->layout = "main_modules";
        return $this->render('view_teacher',
            [
                'model' => $model,
                'model_Prefix'=> GetModelController::getFindPrefix($model->prefix_id),
                'home_district' => GetModelController::getFindDistrict($model->person_home_district),
                'home_amphur' => GetModelController::getFindAmphur($model->person_home_amphur),
                'home_province' => GetModelController::getFindProvince($model->person_home_province),
                'home_zipcode' => GetModelController::getFindZipcode($model->person_home_zipcode),
                'current_district' => GetModelController::getFindDistrict($model->person_current_district),
                'current_amphur' => GetModelController::getFindAmphur($model->person_current_amphur),
                'current_province' => GetModelController::getFindProvince($model->person_current_province),
                'current_zipcode' => GetModelController::getFindZipcode($model->person_current_zipcode),
                'modelEduca' => $modelEduca,
                'modelExpertise' => $modelExpertise,

            ]);
    }
    public function actionExperUpdate($id){
        $model = $this->findModelExper($id);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => \Yii::t('app', Html::encode('Submission')),
                'message' => \Yii::t('app',Html::encode('บันทึกข้อมูลเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['teacher','active'=>'3']);
        }
        $this->layout = "main_modules";
        return $this->render('exper_update', [
            'model' => $model,
        ]);
    }
    public function actionExperCreate()
    {
        $model = new Expertise();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => \Yii::t('app', Html::encode('Submission')),
                'message' => \Yii::t('app',Html::encode('เพิ่มข้อมูลเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['teacher','active'=>3]);
        }
        return $this->redirect(['teacher','active'=>3]);
    }
    public function actionExperDelete($id)
    {
        $this->findModelExper($id)->delete();
        \Yii::$app->getSession()->setFlash('alert1', [
            'type' => 'success',
            'duration' => 12000,
            'icon' => 'fa fa-users',
            'title' => \Yii::t('app', Html::encode('Delete Complete')),
            'message' => \Yii::t('app',Html::encode('ลบข้อมูลเสร็จเรียบร้อย')),
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
        return $this->redirect(['teacher','active'=>3]);
    }
    protected function findModelExper($id)
    {
        if (($model = Expertise::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionViewStaff(){
        $model = Person::findOne(\Yii::$app->user->identity->person_id);
        $modelEduca = HistoryEducation::find()->where(['person_id' => \Yii::$app->user->identity->person_id])->all();
        $modelRespon = Responsibility::find()->where(['person_id' => \Yii::$app->user->identity->person_id])->all();
        $Staff = new Person();
        $model2 = $Staff->getAttributes();
        foreach (array_keys($model2) as $item) {
            if($model->$item==""){$model->$item = "<span style='color:red'>N/A</span>";}
        }
        $this->layout = "main_modules";
        return $this->render('view_staff', [
            'model' => $model,
            'model_Prefix'=> GetModelController::getFindPrefix($model->prefix_id),
            'home_district' => GetModelController::getFindDistrict($model->person_home_district),
            'home_amphur' => GetModelController::getFindAmphur($model->person_home_amphur),
            'home_province' => GetModelController::getFindProvince($model->person_home_province),
            'home_zipcode' => GetModelController::getFindZipcode($model->person_home_zipcode),
            'current_district' => GetModelController::getFindDistrict($model->person_current_district),
            'current_amphur' => GetModelController::getFindAmphur($model->person_current_amphur),
            'current_province' => GetModelController::getFindProvince($model->person_current_province),
            'current_zipcode' => GetModelController::getFindZipcode($model->person_current_zipcode),
            'modelEduca' => $modelEduca,
            'modelRespon' => $modelRespon,
        ]);
    }

    public function actionEduCreate()
    {
        $model = new HistoryEducation();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => \Yii::t('app', Html::encode('Submission')),
                'message' => \Yii::t('app',Html::encode('เพิ่มข้อมูลเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['edu-view', 'id' => $model->history_education_id]);
        }
        $this->layout = "main_modules";
        return $this->render('edu_create', [
            'model' => $model,
            'person'=>\Yii::$app->user->identity->person_id,
        ]);
    }
    public function actionEduUpdate($id){
        $model = $this->findModelEdu($id);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => \Yii::t('app', Html::encode('Submission')),
                'message' => \Yii::t('app',Html::encode('บันทึกข้อมูลเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['edu-view', 'id' => $model->history_education_id]);
        }
        $this->layout = "main_modules";
        return $this->render('edu_update', [
            'model' => $model,
        ]);
    }
    public function actionEduView($id){
        $this->layout = "main_modules";
        return $this->render('edu_view', [
            'model' => $this->findModelEdu($id),
        ]);
    }
    public function actionEduDelete($id)
    {
        $this->findModelEdu($id)->delete();
        \Yii::$app->getSession()->setFlash('alert1', [
            'type' => 'success',
            'duration' => 12000,
            'icon' => 'fa fa-users',
            'title' => \Yii::t('app', Html::encode('Delete Complete')),
            'message' => \Yii::t('app',Html::encode('ลบข้อมูลเสร็จเรียบร้อย')),
            'positonY' => 'top',
            'positonX' => 'right'
        ]);

        return $this->redirect([GetModelController::getType(),'active'=>'2']);
    }
    public function actionStaffResponCreate()
    {
        $model = new Responsibility();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => \Yii::t('app', Html::encode('Submission')),
                'message' => \Yii::t('app',Html::encode('เพิ่มข้อมูลเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['staff','active'=>3]);
        }
        return $this->redirect(['staff','active'=>3]);
    }

    public function actionStaffResponDelete($id)
    {
        $this->findModelRespon($id)->delete();
        \Yii::$app->getSession()->setFlash('alert1', [
            'type' => 'success',
            'duration' => 12000,
            'icon' => 'fa fa-users',
            'title' => \Yii::t('app', Html::encode('Delete Complete')),
            'message' => \Yii::t('app',Html::encode('ลบข้อมูลเสร็จเรียบร้อย')),
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
        return $this->redirect(['staff','active'=>3]);
    }
    public function actionGuest(){

    }
    protected function findModelUser($id)
    {
        if (($model = User::find()->where(['person_id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
    protected function findModelEdu($id)
    {
        if (($model = HistoryEducation::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
    protected function findModelRespon($id)
    {
        if (($model = Responsibility::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }


    public function actionGetAmphur() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $province_id = $parents[0];
                $out = $this->getAmphur($province_id);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    public function actionGetDistrict() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $province_id = empty($ids[0]) ? null : $ids[0];
            $amphur_id = empty($ids[1]) ? null : $ids[1];
            if ($province_id != null) {
                $data = $this->getDistrict($amphur_id);
                echo Json::encode(['output'=>$data, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
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

}