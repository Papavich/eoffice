<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/18/2017
 * Time: 1:47 AM
 */

namespace app\modules\personsystem\controllers;


use app\modules\personsystem\models\Amphur;
use app\modules\personsystem\models\AuthAssignment;
use app\modules\personsystem\models\BoardOfDirectors;
use app\modules\personsystem\models\District;
use app\modules\personsystem\models\Expertise;
use app\modules\personsystem\models\ExpertiseSearch;
use app\modules\personsystem\models\HistoryEducation;
use app\modules\personsystem\models\HistorySearch;
use app\modules\personsystem\models\Person;
use app\modules\personsystem\models\PersonSearch;
use app\modules\personsystem\models\RegDepartment;
use app\modules\personsystem\models\RegPrefix;
use dektrium\user\models\User;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TeacherController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'admin-delete-teacher' => ['POST'],
                ],
            ],
        ];
    }

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
    public function actionAdminEditTeacherList(){
        $searchModel = new PersonSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $this->layout = "main_modules_for_extenkrajee"; //เมื่อใช้ widget ของ krajee จะใช้ app.js ไม่ได้ มันชนกัน ดังนั้นต้องเอาออก
        return $this->render('teacher_list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAdminViewTeacher($id){
        $model = Person::findOne($id);
        $modelEduca = HistoryEducation::find()->where(['person_id' => $id])->all();
        $modelExpertise = Expertise::find()->where(['person_id' => $id])->all();
        $Teacher = new Person();
        $model2 = $Teacher->getAttributes();
        foreach (array_keys($model2) as $item) {
            if($model->$item==""){$model->$item = "<span style='color:red'>N/A</span>";}
        }
//        var_dump(GetModelController::getFindAcademic($model->academic_positions_id));
//        exit();

        $this->layout = "main_modules_for_extenkrajee"; //เมื่อใช้ widget ของ krajee จะใช้ app.js ไม่ได้ มันชนกัน ดังนั้นต้องเอาออก
        return $this->render('view_teacher',
            [
                'Academic'=> GetModelController::getFindAcademic($model->academic_positions_id),
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
    public function actionAdminUpdateTeacher($id){
        $model = $this->findModel($id);
        $model2 = $this->findModelUser($id);
        $searchModelEdu = new HistorySearch();
        $dataProviderEdu = $searchModelEdu->search(\Yii::$app->request->queryParams,$model->person_id);
        $searchModelExper = new ExpertiseSearch();
        $dataProviderExper = $searchModelExper->search(\Yii::$app->request->queryParams,$model->person_id);
        $amphurHome = ArrayHelper::map($this->getAmphur($model->person_home_province),'id','name');
        $districtHome = ArrayHelper::map($this->getDistrict($model->person_home_amphur),'id','name');
        $amphurCurrent = ArrayHelper::map($this->getAmphur($model->person_current_province),'id','name');
        $districtCurrent = ArrayHelper::map($this->getDistrict($model->person_current_amphur),'id','name');
        $modelExper = new Expertise();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model2->username =  $model->person_card_id;
            $model2->password =  $model->person_citizen_id;
           // $model2->email = $model->person_email;
            @unlink(\Yii::getAlias('@webroot').'/web_personal/upload/person/'.$model->person_img);
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
            return $this->redirect(['admin-view-teacher', 'id' => $model->person_id]);
        }
        $this->layout = "main_modules";
        return $this->render('update_teacher', [
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
            'id'=>$id
        ]);
    }


    public function actionAdminDeleteTeacher()
    {
        $request = \Yii::$app->request;
        $id = $request->post('id');

        if(!BoardOfDirectors::find()->where(['person_id' => $id])->all()){
            HistoryEducation::deleteAll(['person_id' => $id]);
            Expertise::deleteAll(['person_id' => $id]);
            $this->findModel($id)->delete();
            \Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => \Yii::t('app', Html::encode('Delete Complete')),
                'message' => \Yii::t('app',Html::encode('ลบข้อมูลเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
        }else{
            \Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'warning',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => \Yii::t('app', Html::encode('Cannot Delete')),
                'message' => \Yii::t('app',Html::encode('ไม่สามารถลบข้อมูลได้เนื่องจาก Board Directer มีการใช้ข้อมูลบุคคลากรนี้อยู่')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
        }

        if($user = User::find()->where(['person_id' => $id])->one()){
            $this->findModelUser($id)->delete();
        }
        if (AuthAssignment::find()->where(['user_id' => $user->id])->all()){
            AuthAssignment::deleteAll(['user_id' => $user->id]);
           // $this->findModelAssign($user->id)->delete();
        }
        return $this->redirect(['admin-edit-teacher-list']);
    }
    public function actionAdminAddTeacher(){
        $this->layout = "main_modules";
        return $this->render('admin_add_teacher');
    }

    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
    protected function findModelUser($id)
    {
        if (($model = User::find()->where(['person_id' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
    protected function findModelAssign($id)
    {
        if (($model = AuthAssignment::find()->where(['user_id' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
    protected function findModelBoard($id)
    {
        if (($model = BoardOfDirectors::find()->where(['board_id' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionEduView($id){
        $this->layout = "main_modules";
        return $this->render('edu_view', [
            'model' => $this->findModelEdu($id),
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
    public function actionEduDelete($id,$person)
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
        //$text = 'admin-update-teacher?id='.$person."&active=2";
        return $this->redirect(['admin-update-teacher', 'id' => $person,'active'=>'2']);
    }
    public function actionEduCreate($person)
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
            'person'=>$person,
        ]);
    }
    protected function findModelEdu($id)
    {
        if (($model = HistoryEducation::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
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
            return $this->redirect(['admin-update-teacher', 'id' => $model->person_id,'active'=>'3']);
        }
        $this->layout = "main_modules";
        return $this->render('exper_update', [
            'model' => $model,
        ]);
    }
    public function actionExperCreate($id)
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
            return $this->redirect(['admin-update-teacher','id'=>$id,'active'=>3]);
        }
        return $this->redirect(['admin-update-teacher','id'=>$id,'active'=>3]);
    }
    public function actionExperDelete($id,$person)
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
        return $this->redirect(['admin-update-teacher','id'=>$person,'active'=>3]);
    }
    protected function findModelExper($id)
    {
        if (($model = Expertise::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
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
}