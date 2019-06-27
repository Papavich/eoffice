<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/25/2017
 * Time: 3:52 AM
 */

namespace app\modules\personsystem\controllers;


use app\controllers\ApiController;
use app\models\Importsql;
use app\modules\personsystem\controllers;
use app\modules\personsystem\models\AuthAssignment;
use app\modules\personsystem\models\AuthItemChild;
use app\modules\personsystem\models\BoardOfDirectors;
use app\modules\personsystem\models\BranchHasLevel;
use app\modules\personsystem\models\Expertise;
use app\modules\personsystem\models\ExpertiseSearch;
use app\modules\personsystem\models\HistoryEducation;
use app\modules\personsystem\models\HistorySearch;
use app\modules\personsystem\models\Major;
use app\modules\personsystem\models\MajorHasProgram;
use app\modules\personsystem\models\Person;
use app\modules\personsystem\models\RegLevel;
use app\modules\personsystem\models\RegPrefix;
use app\modules\personsystem\models\RegProgram;
use app\modules\personsystem\models\RegStudentbio;
use app\modules\personsystem\models\RegStudentmaster;
use app\modules\personsystem\models\RegSysbytedes;
use app\modules\personsystem\models\Student;
use app\modules\personsystem\models\User;
use app\modules\personsystem\models\ViewStudentFull;
use app\modules\personsystem\models\ViewStudentJoinUser;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Exception;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use dektrium\rbac\models\Assignment;
use Yii;


class TestController extends Controller
{
    public function actionDate(){
     echo   controllers\GetModelController::getFindProgram(310203301160);

    }
    public function actionStatus(){
        $student = ViewStudentJoinUser::find()
            ->filterWhere(['LIKE', 'LEVELID',  40])
            ->andFilterWhere(['LIKE', 'major_id', 1])
            ->andFilterWhere(['LIKE', 'ADMITACADYEAR', 2557])
            ->andFilterWhere(['LIKE', 'ADMITSEMESTER', 1])
            ->all();
        $funcT = ViewStudentFull::find()
            ->filterWhere(['=', 'LEVELID', 34])
            ->andFilterWhere(['=', 'major_id', 1])
            ->andFilterWhere(['=', 'ADMITACADYEAR', 2557])
            ->andFilterWhere(['=', 'STUDENTSTATUS', ""])
            ->all();
       // $test = RegSysbytedes::find()->all();
        echo "Hee";
        var_dump($funcT);
    }
    public function actionCreate()
    {
        $modelAssignment = new AuthAssignment();
        $modelAssignment->user_id = "64";
        $modelAssignment->item_name = "Teacher";
        $modelAssignment->save();

    }
    public function actionItems(){
        $modelItem = new AuthItemChild();
        $AuthItem =  AuthItemChild::find()->select('parent')->distinct()->all();

        foreach ($AuthItem as $item){
           echo $item->parent."<br>";
        }
    }
    public function actionProgram()
    {
        $Major = \Yii::$app->request->get('major');
        $Year = \Yii::$app->request->get('year');
        $array = [];
        if ($Major == "ALL") {
            $funcT = ViewStudentFull::find()->all();
        } else if ($Major == "ICT") {
            $funcT = ViewStudentFull::find()
                ->where(['major_id' => '2','ADMITACADYEAR'=>$Year,'branch_id'=>'1'])->all();
        } else if ($Major == "ICTVIP") {
            $funcT = ViewStudentFull::find()
                ->where(['major_id' => '2','ADMITACADYEAR'=>$Year,'branch_id'=>'2'])->all();
        } else if ($Major == "CS") {
            $funcT = ViewStudentFull::find()
                ->where(['major_id' => '1','ADMITACADYEAR'=>$Year,'branch_id'=>'1'])->all();
        } else if ($Major == "CSVIP") {
            $funcT = ViewStudentFull::find()
                ->where(['major_id' => '1','ADMITACADYEAR'=>$Year,'branch_id'=>'2'])->all();
        } else if ($Major == "GIS") {
            $funcT = ViewStudentFull::find()
                ->where(['major_id' => '3','ADMITACADYEAR'=>$Year,'branch_id'=>'1'])->all();
        } else if ($Major == "GISVIP") {
            $funcT = ViewStudentFull::find()
                ->where(['major_id' => '3','ADMITACADYEAR'=>$Year,'branch_id'=>'2'])->all();
        }else{
            $funcT = ViewStudentFull::find()->all();
        }
        $array2 = [];
        foreach ($funcT as $value => $item){
            $user = User::find()->where(['person_id'=>$item->STUDENTID])->one();
           if($user!=null)
               $array2[$value] = $user->id;
        }
       // print_r($array2);
        $count = 0;
        foreach ($array2 as $value =>$item){
            $AssignStudent = AuthAssignment::find()->select('item_name')->where(['user_id'=>$item])->distinct()->all();
            foreach ($AssignStudent as $value2 => $item2){
                $array[$count] = $item2->item_name;
                echo $array[$count];
                $count++;
            }
    }
    }
    public function actionDeleteOne($id)
    {
        if(User::find()->where(['person_id'=>$id])->all()){
            $id =  User::find()->where(['person_id'=>$id])->one();
            echo $id->id;
            echo "Hee";
           // $this->findModelUser()->delete();
        }
    }
    protected function findModelUser($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionUser()
    {
        $beer = BoardOfDirectors::find()->where(['person_id'=>'4','director_id'=>'2','period_id'=>'1'])->exists();
            print_r($beer);

        //BoardOfDirectors::find()->where(['person_id'=>'4','director_id'=>'2','period_id'=>'1'])->all();
    }
    public function actionAdminUpdateTeacher($id){
        $model = $this->findModel($id);
        $model2 = $this->findModelUser($id);
        $searchModelEdu = new HistorySearch();
        $dataProviderEdu = $searchModelEdu->search(\Yii::$app->request->queryParams,$model->person_id);
        $searchModelExper = new ExpertiseSearch();
        $dataProviderExper = $searchModelExper->search(\Yii::$app->request->queryParams,$model->person_id);
        $modelExper = new Expertise();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model2->username =  $model->person_card_id;
            $model2->password =  $model->person_citizen_id;
            $model2->email = $model->person_email;
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
            'searchModelEdu' => $searchModelEdu,
            'dataProviderEdu' => $dataProviderEdu,
            'searchModelExper' => $searchModelExper,
            'dataProviderExper' => $dataProviderExper,
            'modelExper'=>$modelExper,

        ]);
    }
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionLevel(){
        $modelLevel = ViewStudentFull::find()->select(['branch_id'])->distinct()->all();
        $admitsemester = ViewStudentFull::find()->select('ADMITSEMESTER')->distinct()->all();
        $assignRole = AuthItemChild::find()->select('parent')->distinct()->all();
        $studentRevoke = AuthAssignment::find()
            ->leftJoin(User::tableName(), AuthAssignment::tableName() . '.user_id = ' . User::tableName() . '.id')
            ->where(['item_name'=>'Student'])->andWhere(User::tableName().'.type = 0')->all();

        $userAssign = [];
        $student = ViewStudentJoinUser::find()->where(['major_id'=>'1','branch_id'=>'1','ADMITACADYEAR'=>'2557'])->select('id')->all();
        $count=0;
        foreach ($student as $value=>$item){
            $assign = AuthAssignment::find()->where(['user_id'=>$item->id])->all();
           // print_r($assign);
            if($count==$value){
                foreach ($assign as $item2){
                    $userAssign[$count] = $item2->item_name;
                }
            }
            if($assign!=null)
                $count++;
        }
        print_r($studentRevoke);
        //$studentAssign =
//        foreach ($studentRevoke as $value=>$item){
//           echo $item->user_id.":".$value."<br>";
//        }
        //var_dump($modelLevel);
    }
    public function actionRevoke(){
        $userAssign =[];
        $role = "Student";
        $levelRequest = "";
        $majorRequest= "";
        $yearRequest = "";
        $semesterRequest = "";
        $student = ViewStudentJoinUser::find()
            ->filterWhere(['LIKE', 'LEVELID', $levelRequest])
            ->andFilterWhere(['LIKE', 'major_id', $majorRequest])
            ->andFilterWhere(['LIKE', 'ADMITACADYEAR', $yearRequest])
            ->andFilterWhere(['LIKE', 'ADMITSEMESTER', $semesterRequest])
            ->all();
        $count=0;
        foreach ($student as $value=> $item) {
           // var_dump($item->STUDENTID);
          echo $value." : ".$item->STUDENTID."<br>";
        }

    }
    public function actionTest69(){
        $itemRole = "Teacher";
        $assign = AuthAssignment::find()->where(['item_name'=>$itemRole])->select('user_id');// นักศึกษาตาม role ที่ select มา *มี Role แล้ว
        $userNotHave = ViewStudentJoinUser::find()->where(['NOT IN','id',$assign])->andWhere(['branch_id'=>'1','major_id'=>'3','ADMITACADYEAR'=>'2557','ADMITSEMESTER'=>'1'])->select('STUDENTCODE')->all();
        $studentYear = ViewStudentJoinUser::find()->select('ADMITACADYEAR')->orderBy(['ADMITACADYEAR' => SORT_DESC])->distinct()->all();
    var_dump($studentYear[0]);
      //  echo $studentYear[0];
        foreach ($studentYear as $value=>$item){
            if($value==0)
            echo $item->ADMITACADYEAR."<br>";
        }
    //  var_dump($user);
    }
    public function actionTestApi(){
        $this->layout = "main_modules";
        return $this->render('staff_create',[

        ]);

    }





}