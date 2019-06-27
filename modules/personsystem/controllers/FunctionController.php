<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/10/2018
 * Time: 7:58 PM
 */

namespace app\modules\personsystem\controllers;


use app\modules\personsystem\models\AuthAssignment;
use app\modules\personsystem\models\User;
use app\modules\personsystem\models\ViewPisUser;
use app\modules\personsystem\models\ViewStudentJoinUser;
use yii\web\Controller;

class FunctionController extends Controller
{
  public static function getNameuser($user_id){
      $name = ViewPisUser::find()->select(['student_fname_th','student_lname_th','person_lname_th','person_fname_th'])->where(['id'=>$user_id])->one();
      $nameuser = \Yii::$app->user->identity->username;
      if($name->student_fname_th!=null){
          $nameuser = $name->student_fname_th." ".$name->student_lname_th;
      }elseif ($name->person_lname_th!=null){
          $nameuser = $name->person_fname_th." ".$name->person_lname_th;
      }
      return $nameuser;
  }


}