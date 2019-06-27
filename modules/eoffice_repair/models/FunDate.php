<?php

namespace app\modules\eoffice_repair\models;
use app\modules\eoffice_repair\models\EofficeCentrViewPisUser;
use app\modules\eoffice_repair\models\RepairDescription;

use Yii;

class FunDate
{
    static public function getBudgetyear(){
        $date = date('Y-m-d');
        $date_result = explode("-",$date);
        $month_temp = ltrim($date_result[1], '0');
        $year = $date_result[0]+543;
        $school_year = null;

        if($month_temp>=10){
            $school_year = substr((string)$year, -2);
        }else{
            $school_year = substr((string)$year, -2);
            $school_year--;
        }
        return $school_year;
    }
    static public function genBillId(){

        $id = Yii::$app->request->get('id');
        $user_temp = User::find()->where('id = :id',[':id' => $id])->one();

        $date = date('Y-m-d');
        $date_result = explode("-",$date);
        $day = $date_result[2];
        $month = $date_result[1];
        $month_temp = ltrim($date_result[1], '0');
        $year = $date_result[0]+543;
        $school_year = null;

        if($month_temp>=10){
            $school_year = substr((string)$year, -2);
        }else{
            $school_year = substr((string)$year, -2);
            $school_year--;
        }

        $id = MatsysOrder::find()->orderBy('order_id_ai DESC')->one();
        $id_ai = null;
        if (isset($id)) {
            $id_ai = $id->order_id_ai + 1;
        } else {
            $id_ai = 1;
        }

        $padded_id = str_pad($id_ai, 7, '0',STR_PAD_LEFT);

        $major = $user_temp['major_id'] ? $user_temp['major_id'] : 0;

        return $school_year."-".$major."-".$padded_id;
    }
    static public function genOrderdetailid(){

        $id = Yii::$app->request->get('id');
        $user_temp = User::find()->where('id = :id',[':id' => $id])->one();

        $date = date('Y-m-d');
        $date_result = explode("-",$date);
        $day = $date_result[2];
        $month = $date_result[1];
        $month_temp = ltrim($date_result[1], '0');
        $year = $date_result[0]+543;
        $school_year = null;

        if($month_temp>=10){
            $school_year = substr((string)$year, -2);
        }else{
            $school_year = substr((string)$year, -2);
            $school_year--;
        }

        $id = MatsysOrder::find()->orderBy('order_id_ai DESC')->one();
        $id_ai = null;
        if (isset($id)) {
            $id_ai = $id->order_id_ai + 1;
        } else {
            $id_ai = 1;
        }

        $padded_id = str_pad($id_ai, 7, '0',STR_PAD_LEFT);

        $major = $user_temp['major_id'] ? $user_temp['major_id'] : 0;

        return $school_year."-".$major."-D".$padded_id;
    }
    static public function dateThaisec($date){
        $date_result_sec = explode(" ",$date);
        $date_result = explode("-",$date_result_sec[0]);
        $day = $date_result[2];
        $month = $date_result[1];
        switch ($date_result[1]){
            case "01":$month="มกราคม";break;
            case "02":$month="กุมภาพันธ์";break;
            case "03":$month="มีนาคม";break;
            case "04":$month="เมษายน";break;
            case "05":$month="พฤษภาคม";break;
            case "06":$month="มิถุนายน";break;
            case "07":$month="กรกฎาคม";break;
            case "08":$month="สิงหาคม";break;
            case "09":$month="กันยายน";break;
            case "10":$month="ตุลาคม";break;
            case "11":$month="พฤศจิกายน";break;
            case "12":$month="ธันวาคม";break;
        }
        $year = $date_result[0]+543;
        return $day." ".$month." ".$year;
    }
    static public function getBudgetperYear(){
        $date = date('Y-m-d');
        $date_result = explode("-",$date);
        $month_temp = ltrim($date_result[1], '0');
        $year = $date_result[0]+543;
        $school_year = null;

        if($month_temp>=10){
            $school_year = substr((string)$year, -2);
        }else{
            $school_year = substr((string)$year, -2);
            $school_year--;
        }
        return $school_year;
    }
    static public function getFullBudgetperYear(){
        $date = date('Y-m-d');
        $date_result = explode("-",$date);
        $month_temp = ltrim($date_result[1], '0');
        $year = $date_result[0]+543;
        $school_year = null;

        if($month_temp>=10){
            $school_year = $year;
        }else{
            $school_year = $year;
            $school_year--;
        }
        return $school_year;
    }
    static public function getBudget($date){
        $date_result = explode("-",$date);
        $month_temp = ltrim($date_result[1], '0');
        $year = $date_result[0]+543;
        $school_year = null;

        if($month_temp>=10){
            $school_year = substr((string)$year, -2);
        }else{
            $school_year = substr((string)$year, -2);
            $school_year--;
        }
        return $school_year;
    }
    static public function getMonthName($month){
        switch ($month){
            case "01":$month="มกราคม";break;
            case "02":$month="กุมภาพันธ์";break;
            case "03":$month="มีนาคม";break;
            case "04":$month="เมษายน";break;
            case "05":$month="พฤษภาคม";break;
            case "06":$month="มิถุนายน";break;
            case "07":$month="กรกฎาคม";break;
            case "08":$month="สิงหาคม";break;
            case "09":$month="กันยายน";break;
            case "10":$month="ตุลาคม";break;
            case "11":$month="พฤศจิกายน";break;
            case "12":$month="ธันวาคม";break;
        }
        return $month;
    }
    static public function dateThaisecTime($date){
        $date_result_sec = explode(" ",$date);
        $date_result = explode("-",$date_result_sec[0]);
        $day = $date_result[2];
        $month = $date_result[1];
        switch ($date_result[1]){
            case "01":$month="มกราคม";break;
            case "02":$month="กุมภาพันธ์";break;
            case "03":$month="มีนาคม";break;
            case "04":$month="เมษายน";break;
            case "05":$month="พฤษภาคม";break;
            case "06":$month="มิถุนายน";break;
            case "07":$month="กรกฎาคม";break;
            case "08":$month="สิงหาคม";break;
            case "09":$month="กันยายน";break;
            case "10":$month="ตุลาคม";break;
            case "11":$month="พฤศจิกายน";break;
            case "12":$month="ธันวาคม";break;
        }
        $year = $date_result[0]+543;
//        return $day." ".$month." ".$year." เวลา : ".$date_result_sec[1];
        return $day." ".$month." ".$year;
    }

}
