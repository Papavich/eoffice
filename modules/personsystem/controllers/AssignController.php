<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/8/2018
 * Time: 11:28 PM
 */

namespace app\modules\personsystem\controllers;


use app\modules\personsystem\models\AuthAssignment;
use app\modules\personsystem\models\AuthItemChild;
use app\modules\personsystem\models\Branch;
use app\modules\personsystem\models\Major;
use app\modules\personsystem\models\RegLevel;
use app\modules\personsystem\models\User;
use app\modules\personsystem\models\ViewStudentFull;
use app\modules\personsystem\models\ViewStudentJoinUser;
use yii\web\Controller;
use yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

class AssignController extends Controller
{

    public function actionToboxAssign()
    {
        $majorRequest = \Yii::$app->request->get('major');
        $yearRequest = \Yii::$app->request->get('year');
        $levelRequest = \Yii::$app->request->get('level');
        $semesterRequest = \Yii::$app->request->get('semester');
        $toVal = \Yii::$app->request->get('toVal');
        // รับมาจาก view Assign_Student
        $student = ViewStudentJoinUser::find()
            ->filterWhere(['LIKE', 'LEVELID', $levelRequest])
            ->andFilterWhere(['LIKE', 'major_id', $majorRequest])
            ->andFilterWhere(['LIKE', 'ADMITACADYEAR', $yearRequest])
            ->andFilterWhere(['LIKE', 'ADMITSEMESTER', $semesterRequest])
            ->all();
        // นำค่าที่รับมา select
        $count=-1;
        $count2 =0;
        if (\Yii::$app->request->get('toVal')) {
            foreach ($toVal as $value => $item) {
                foreach ($student as $value2 =>$item2) {
                    $assignRole = new AuthAssignment();
                    $assignRole->item_name = $item;
                    $assignRole->user_id = (string)$item2->id;
                    if($assignRole->save()){
                        $count++;
                    }else if($assignRole->errors){
                        $count2=2;
                        //var_dump($assignRole->errors);
                    }
                }
            }
            //var_dump($student);
            if($student!=null&&$count==$value2)
                echo "กำหนดสิทธิ์สำเร็จ";
            if($count2 == 2)
                echo "(มีการกำหนดสิทธิ์ซ้ำ)";
            if($student==null)
                echo "ไม่มีนักศึกษา";
        }
  //    print_r($toVal);
    }

    public function actionAssignStudent()
    {
        $majorRequest = \Yii::$app->request->get('major');
        $yearRequest = \Yii::$app->request->get('year');
        $levelRequest = \Yii::$app->request->get('level');
        $semesterRequest = \Yii::$app->request->get('semester');

        $studentYear = ViewStudentJoinUser::find()->select('ADMITACADYEAR')->orderBy(['ADMITACADYEAR' => SORT_DESC])->distinct()->all();//ปีการศึกษาที่เข้ามา
        $major = Major::find()->all();
        $admitsemester = ViewStudentJoinUser::find()->select('ADMITSEMESTER')->distinct()->all();
        $authItem = AuthItemChild::find()->select('parent')->orderBy(['parent' => SORT_DESC])->distinct()->all();
        $level = RegLevel::find()
            ->select(["reg_level.LEVELID", "reg_level.LEVELNAME"])
            ->innerJoin('reg_studentmaster', 'reg_studentmaster.LEVELID = reg_level.LEVELID')->groupBy("reg_level.LEVELID")->all();
        // select เอาข้อมูลที่ต้องกาารให้เลือกบน view Assign_Student  เอาไป Render ในหน้าวิว

            $student = ViewStudentJoinUser::find()
                ->filterWhere(['LIKE', 'LEVELID', $levelRequest])
                ->andFilterWhere(['LIKE', 'major_id', $majorRequest])
                ->andFilterWhere(['LIKE', 'ADMITACADYEAR', $yearRequest])
                ->andFilterWhere(['LIKE', 'ADMITSEMESTER', $semesterRequest])
                ->all();

        $this->layout = "main";
        return $this->render('assign_student', [
            'student'=> $student,
            'StudentYear' => $studentYear,
            'Level' => $level,
            'Major' => $major,
            'Admitsemester' => $admitsemester,
            'AuthItem' => $authItem,
            'majorRequest'=>$majorRequest,
            'yearRequest'=>$yearRequest,
            'semesterRequest'=>$semesterRequest,
            'levelRequest'=>$levelRequest
        ]);
    }
    public function actionAssignView(){
        $majorRequest = \Yii::$app->request->get('major');
        $yearRequest = \Yii::$app->request->get('year');
        $levelRequest = \Yii::$app->request->get('level');
        $semesterRequest = \Yii::$app->request->get('semester');

        $studentYear = ViewStudentJoinUser::find()->select('ADMITACADYEAR')->orderBy(['ADMITACADYEAR' => SORT_DESC])->distinct()->all();//ปีการศึกษาที่เข้ามา
        $major = Major::find()->all();
        $admitsemester = ViewStudentJoinUser::find()->select('ADMITSEMESTER')->distinct()->all();
        $authItem = AuthItemChild::find()->select('parent')->orderBy(['parent' => SORT_DESC])->distinct()->all();
        $level = RegLevel::find()
            ->select(["reg_level.LEVELID", "reg_level.LEVELNAME"])
            ->innerJoin('reg_studentmaster', 'reg_studentmaster.LEVELID = reg_level.LEVELID')->groupBy("reg_level.LEVELID")->all();
        // select เอาข้อมูลที่ต้องกาารให้เลือกบน view Assign_Student  เอาไป Render ในหน้าวิว

        $student = ViewStudentJoinUser::find()
            ->filterWhere(['LIKE', 'LEVELID', $levelRequest])
            ->andFilterWhere(['LIKE', 'major_id', $majorRequest])
            ->andFilterWhere(['LIKE', 'ADMITACADYEAR', $yearRequest])
            ->andFilterWhere(['LIKE', 'ADMITSEMESTER', $semesterRequest])
            ->all();

        $this->layout = "main";
        return $this->render('assign_view', [
            'StudentYear' => $studentYear,
            'Level' => $level,
            'Major' => $major,
            'Admitsemester' => $admitsemester,
            'AuthItem' => $authItem,
            'student'=> $student,
            'majorCheck'=>$majorRequest,
            'yearCheck'=>$yearRequest,
            'semesterCheck'=>$semesterRequest,
            'levelCheck'=>$levelRequest
        ]);
    }
    public function actionRevokeStudent()
    {
        $itemRole = \Yii::$app->request->get('item');
        $majorRequest = \Yii::$app->request->get('major');
        $yearRequest = \Yii::$app->request->get('graduate_year');
        $levelRequest = \Yii::$app->request->get('level');
        $semesterRequest = \Yii::$app->request->get('semester');
        // รับมาจาก view Revoke_Student
//        if(\Yii::$app->request->post('item')==null)
//            $itemRole = "Teacher";
        //กำหนดค่าเริ่มต้นที่จะค้นหาให้กับ Role

        $studentYear = ViewStudentJoinUser::find()->select('ADMITACADYEAR')->orderBy(['ADMITACADYEAR' => SORT_DESC])->distinct()->all();//ปีการศึกษาที่เข้ามา
        $level = RegLevel::find()
            ->select(["reg_level.LEVELID", "reg_level.LEVELNAME"])
            ->innerJoin('reg_studentmaster', 'reg_studentmaster.LEVELID = reg_level.LEVELID')->groupBy("reg_level.LEVELID")->all();
        $major = Major::find()->all();
        $admitsemester = ViewStudentJoinUser::find()->select('ADMITSEMESTER')->distinct()->all();
        // select เอาข้อมูลที่ต้องกาารให้เลือกบน view Revoke_Student  เอาไป Render ในหน้าวิว

        $authItem = AuthItemChild::find()->select('parent')->orderBy(['parent' => SORT_DESC])->distinct()->all();
        $assign = AuthAssignment::find()->where(['item_name' => $itemRole])->select('user_id');// นักศึกษาตาม role ที่ select มา *มี Role แล้ว
        $userHave = ViewStudentJoinUser::find()->where(['IN', 'id', $assign])->andWhere(['LEVELID' => $levelRequest, 'major_id' => $majorRequest, 'ADMITACADYEAR' => $yearRequest, 'ADMITSEMESTER' => $semesterRequest])->select(['STUDENTCODE','STUDENTID','STUDENTNAME','STUDENTSURNAME'])->all();//นักศึกษาที่มี Role นี้
        $userNotHave = ViewStudentJoinUser::find()->where(['NOT IN', 'id', $assign])->andWhere(['LEVELID' => $levelRequest, 'major_id' => $majorRequest, 'ADMITACADYEAR' => $yearRequest, 'ADMITSEMESTER' => $semesterRequest])->select(['STUDENTCODE','STUDENTID','STUDENTNAME','STUDENTSURNAME'])->all();
        // select เอาข้อมูลที่ต้องกาารให้เลือกบน view Revoke_Student  เอาไป Render ในหน้าวิว

        // echo $itemRole.":".$majorRequest.":".$levelRequest.":".$yearRequest.":".$semesterRequest."";
        $this->layout = "main";
        return $this->render('revoke_student', [
            'AuthItem' => $authItem,
            'studentRevoke' => $userNotHave,
            'studentAssign' => $userHave,
            'StudentYear' => $studentYear,
            'Level' => $level,
            'Major' => $major,
            'Admitsemester' => $admitsemester,
            'majorRequest' => $majorRequest,
            'yearRequest' => $yearRequest,
            'levelRequest' => $levelRequest,
            'semesterRequest' => $semesterRequest,
             'itemRole' => $itemRole,
        ]);
    }
    public function actionToboxRevoke()
    {
        $majorRequest = \Yii::$app->request->get('major');
        $yearRequest = \Yii::$app->request->get('year');
        $levelRequest = \Yii::$app->request->get('level');
        $semesterRequest = \Yii::$app->request->get('semester');
        $authen = \Yii::$app->request->get('item');
        $toVal = \Yii::$app->request->get('toVal');
        // รับมาจาก view Assign_Student

        $count = 0;
        if (\Yii::$app->request->get('toVal')) {
            foreach ($toVal as $value => $item) {
                $student = ViewStudentJoinUser::find()->where(['STUDENTID'=>$item,'item_name'=>$authen])->leftJoin('auth_assignment', 'auth_assignment.user_id=view_student_join_user.id')->one();
               if($student!=null){
                   $this->findModelAssign($student->id,$authen)->delete();
                   $count++;
               }
            }
            //var_dump($student);
            if($student!=null&&$count>0)
                echo "Revoke สิทธิ์สำเร็จ";
//            if($count2 == 2)
//                echo "(มีการกำหนดสิทธิ์ซ้ำ)";
//            if($student==null)
//                echo "ไม่มีนักศึกษา";
        }
        //    print_r($toVal);
    }

    protected function findModelAssign($user_id, $item_name)
    {
        if (($model = AuthAssignment::findOne(['user_id' => $user_id, 'item_name' => $item_name])) !== null) {
            return $model;
        }

        throw new yii\web\NotFoundHttpException('The requested page does not exist.');
    }

}