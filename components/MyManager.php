<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/12/2017
 * Time: 1:58 PM
 */

namespace app\components;

use mdm\admin\components\MenuHelper;
use Yii;

class MyManager extends \dektrium\rbac\components\DbManager implements \dektrium\rbac\components\ManagerInterface
{
    public function getItemsByUser($userId)
    {
        // TODO: Implement getItemsByUser() method.
    }

    public function getPermit($userId, $name_module) //getPermissionsByUserAndModule**************************
    {
        $array_getpermission = [];
        if (empty($userId)) {
            return [];
        }
        $inheritedPermission = $this->getInheritedPermissionsByUser($userId);  //get path of permission ออกมาทั้งหมด
        $directPermission = [];
        foreach ($inheritedPermission as $name => $value) {
            if (0 === strpos($name, "/" . $name_module)) {
                array_push($array_getpermission, $name); //เอา $name มา push ใส่ array_getpermission
            }
        }
        return $array_getpermission;
    }
    //ส่ง userId และ ชื่อโมดูล มาเพื่อกรองเอาเฉพาะ path ของ โมดูลนั้นๆ

    public function getPermitReturn($name_path,$name_module) //*********************************
    {
        foreach ($this->getPermit(Yii::$app->user->identity->id,$name_module) as $name => $value) {
            if ($name_path == $value) {
                return "true";
            }
        }
        return "false";
    }

    // function เช็คว่ามีสิทธิ์ไหมโดย return T/F

    public function getMenuModule()
    {
        $arr = [];
        foreach (MenuHelper::getAssignedMenu(\Yii::$app->user->id) as $key => $a) { //return Array ทั้งหมด
            $arr[$key]["label"] = $a["label"];  //จับ lable,url ยัดใส่แม่งเลย
            $arr[$key]["url"] = $a["url"];
            $arr[$key]["icon"] = $a["icon"];
        }
        return $arr;
    }

    public function getmenuParentModule($name_module)
    {
        $arr = [];
        foreach (MenuHelper::getAssignedMenu(\Yii::$app->user->id) as $key => $a) {
            if ($a['label'] == $name_module){
                if (array_key_exists("items", $a)) {
                    foreach ($a["items"] as $b) {
                        $arr2 = [];
                        $arr2["label"] = $b["label"];
                        $arr2["url"] = $b["url"];
                        $arr2["icon"] = $b["icon"];
                        array_push($arr, $arr2);
                        if (array_key_exists("items", $b)) {
                            $arr["items"] = $b["items"];
                        }

                    }

                }
            }


        }
        return $arr;
    }
    public function isAdminAsset($id){
        $getRolesByUser = $this->getPermissionsByUser($id);  //get Roles ออกมาทั้งหมด
        foreach ($getRolesByUser as $name => $value) {
          if($name=="Permit_Asset_Staff"){
            return true;
          }
        }
        return false;
    }


        public function isAdmin(){
            $getRolesByUser = $this->getRolesByUser(Yii::$app->user->identity->id);  //get Roles ออกมาทั้งหมด
            foreach ($getRolesByUser as $name => $value) {
           if($name == "Admin"){
                return true;
            }
            }
            return false;
        }

        public function isStaffFinance(){
            $getRolesByUser = $this->getRolesByUser(Yii::$app->user->identity->id);  //get Roles ออกมาทั้งหมด
            foreach ($getRolesByUser as $name => $value) {
                if($name == "Staﬀ-Finance"){
                    return true;
                }
            }
            return false;
        }

        public function isStudent(){
            $getRolesByUser = $this->getRolesByUser(Yii::$app->user->identity->id);  //get Roles ออกมาทั้งหมด
            foreach ($getRolesByUser as $name => $value) {
                if($name == "Student"){
                    return true;
                }
            }
            return false;
        }

        public function isStaffGeneral(){
            $getRolesByUser = $this->getRolesByUser(Yii::$app->user->identity->id);  //get Roles ออกมาทั้งหมด
            foreach ($getRolesByUser as $name => $value) {
                if($name == "Staﬀ-General"){
                    return true;
                }
            }
            return false;
        }

        public function isStaffGs(){
            $getRolesByUser = $this->getRolesByUser(Yii::$app->user->identity->id);  //get Roles ออกมาทั้งหมด
            foreach ($getRolesByUser as $name => $value) {
                if($name == "Staﬀ-Gs"){
                    return true;
                }
            }
            return false;
        }
        public function isParent(){
            $getRolesByUser = $this->getRolesByUser(Yii::$app->user->identity->id);  //get Roles ออกมาทั้งหมด
            foreach ($getRolesByUser as $name => $value) {
                if($name == "Teacher"){
                    return true;
                }
            }
            return false;
        }
}