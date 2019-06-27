<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/6/2018
 * Time: 4:39 PM
 */

namespace app\controllers;

use app\modules\personsystem\models\ViewPisUser;
use yii;
use yii\web\Controller;
use dektrium\user\helpers\Password;
use dektrium\user\models\User;
use mdm\admin\models\form\ResetPassword;
use yii\filters\VerbFilter;

class ApiController extends Controller
{
    /**
     * @inheritdoc
     */
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionTest(){
        var_dump(\Yii::$app->authManager->isAdminAsset(64));
    }

    public function actionCheckUser()
    {
        $this->enableCsrfValidation = false;
        if(Yii::$app->request->isPost){
            $username = Yii::$app->request->get('username');
            $password = Yii::$app->request->get('password');
            $user = ViewPisUser::find()->where(['username'=>$username])->one();
            if($user!=null){
                $json_data["information"] = array(
                    "status_login" =>  Password::validate(Yii::$app->request->get('password'), $user->password_hash ),
                    "student_name"=>$user->student_fname_th,
                    "student_surname"=>$user->student_lname_th,
                    "student_mobile"=>$user->STUDENTMOBILE,
                    "student_email"=>$user->STUDENTEMAIL,
                    "student_img"=>$user->student_img,
                    "person_name"=>$user->person_fname_th,
                    "person_surname"=>$user->person_lname_th,
                    "person_email"=>$user->person_email,
                    "person_mobile"=>$user->person_mobile,
                    "person_img"=>$user->person_img,
                    "is_staff_asset"=>\Yii::$app->authManager->isAdminAsset($user->id),
                );
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                echo json_encode($json_data);
            }else{
                $json_data["information"] = array(
                    "status_login" => false,

                );
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                echo json_encode($json_data);
            }
        }else{
            $json_data["information"] = array(
                "status_login" => false
            );
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo json_encode($json_data);
        }

    }


}