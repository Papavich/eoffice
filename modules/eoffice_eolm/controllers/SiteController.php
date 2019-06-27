<?php
/**.
 * <---------SYSTEM eoffice_eolm----------->
 * Created by PhpStorm.
 * User: User
 * Date: 9/13/2017
 * Time: 1:43 PM
 */

namespace app\modules\eoffice_eolm\controllers;

use app\components\MyManager;
use app\modules\eoffice_eolm\models\model_main\EofficeMainViewPisUser;
use mdm\admin\components\MenuHelper;
use mdm\admin\models\Menu;
use MongoDB\Driver\Manager;
use yii\helpers\Json;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $this->layout = "main_modules";
        return $this->render('index');
    }

    public function actionSpecialstaff()
    {
        return $this->render('specialstaff');
    }



    public function actionTestgetrole()
    {
        $function = new MyManager();
        //echo Json::encode($function->getRolesByUser(\Yii::$app->user->identity->id));
        echo Json::encode(\Yii::$app->authManager->getRolesByUser(\Yii::$app->user->identity->id));
        // print_r($function->getRolesByUser(Yii::$app->user->identity->id)) ;
    }

    public function actionTestgetassign()
    {
        echo Json::encode(MenuHelper::getAssignedMenu(\Yii::$app->user->id));
        // print_r(MenuHelper::getAssignedMenu(\Yii::$app->user->id));
    }

    public function actionTestmenu()
    {
        $arr = [];
        foreach (MenuHelper::getAssignedMenu(\Yii::$app->user->id) as $key => $a) {
            $arr[$key]["label"] = $a["label"];
            $arr[$key]["url"] = $a["url"];
            $arr[$key]["icon"] = $a["icon"];
        }
        echo Json::encode($arr);
        // return $arr;
        // echo \yii\helpers\Json::encode($arr);
        // echo Json::encode(MenuHelper::getAssignedMenu(\Yii::$app->user->id));
    }

    public function actionTestmenuparent()
    {
        $arr = [];
        foreach (MenuHelper::getAssignedMenu(\Yii::$app->user->id) as $key => $a) { //เอา key ของ arrayมาเก็บไว้
            if ($a['label'] === "eoffice_eolm") { //if key index of lable === module5
                if (array_key_exists("items", $a)) {
                    foreach ($a["items"] as $b) { //$b = ค่าใน array //เอา $a ไปใส่ $b
                        $arr2 = [];
                        $arr2["label"] = $b["label"];
                        $arr2["url"] = $b["url"];
                        $arr2["icon"] = $b["icon"];
                        array_push($arr, $arr2); //เอา $arr2 มาต่อท้าย จะได้ไม่ซ้ำ index
                        if (array_key_exists("items", $b)) { //เช็คลูกอีกรอบ :: ถ้ามี index items ใน $b // $b  = array BIG
                            $arr["items"] = $b["items"];
                        }

                    }

                }
            }
        }
        echo Json::encode($arr);
        // return $arr;
        // echo \yii\helpers\Json::encode($arr);
        // echo Json::encode(MenuHelper::getAssignedMenu(\Yii::$app->user->id));
    }

    public function actionTest1()
    {
        echo Json::encode(MenuHelper::getAssignedMenu(\Yii::$app->user->id));

    }

    public function actionGetpermit()
    {
        echo Json::encode(\Yii::$app->authManager->getPermit(\Yii::$app->user->identity->id, \Yii::$app->controller->module->id));
    }

    public function actionGetpermitreturn()
    {
        echo \Yii::$app->authManager->getPermitReturn("/eoffice_eolm/menu/menu1","eoffice_eolm");
    }

    public function actionParentmodule()
    {
        $function = new MyManager();
        echo \Yii::$app->authManager->getTest();
        //  echo Json::encode($function->getmenuParentModule("module5"));

    }

    public function actionGetrole()
    {
        $function = new MyManager();
        echo Json::encode($function->getRoles());

    }

    public function actionIsadmin(){
        echo Json::encode(\Yii::$app->authManager->isAdmin());
    }
    public function actionIsstafffinance(){
        echo Json::encode(\Yii::$app->authManager->isStaffFinance());
    }
    public function actionIsstudent(){
        echo Json::encode(\Yii::$app->authManager->isStudent());
    }
    public function actionIsstaffgeneral(){
        echo Json::encode(\Yii::$app->authManager->isStaffGeneral());
    }
    public function actionIsstaffgs(){
        echo Json::encode(\Yii::$app->authManager->isStaffGs());
    }
    public function actionIsparent(){
        echo Json::encode(\Yii::$app->authManager->isParent());
    }
    public static function getNameuser($user_id){
        $name = EofficeMainViewPisUser::find()->select(['student_fname_th','student_lname_th','person_lname_th','person_fname_th'])->where(['id'=>$user_id])->one();
        $nameuser = \Yii::$app->user->identity->username;
        if($name->student_fname_th!=null){
            $nameuser = $name->student_fname_th." ".$name->student_lname_th;
        }elseif ($name->person_lname_th!=null){
            $nameuser = $name->person_fname_th." ".$name->person_lname_th;
        }
        return $nameuser;
    }

}