<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/9/2017
 * Time: 5:57 AM
 */

namespace app\modules\Tasystem\controllers;


use yii\web\Controller;

class TeacherController extends controller
{
    public function actionSelect_ta(){
        echo "เลือก TA";
    }
    public function  actionSee_list_ta(){
        echo "ดูรายชื่อ TA";
    }
    public function actionSee_workload_ta(){
        echo "ดูภาระงาน TA";
    }
}