<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/9/2017
 * Time: 4:54 AM
 */

namespace app\modules\Tasystem\controllers;


use yii\web\Controller;

class StaffController extends Controller
{
    public function actionManagenews(){
        echo "จัดการประกาศ";
    }
    public function  actionManageruleta(){
        echo "จัดการคุณสมบัติ TA";

    }
    public function actionMangesubject(){
        echo "จัดการรายวิชา";
    }

}