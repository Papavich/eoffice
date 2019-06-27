<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/9/2017
 * Time: 6:01 AM
 */

namespace app\modules\Tasystem\controllers;


use yii\web\Controller;

class StudentController extends Controller
{
    public function actionRegister_ta(){
        echo "สมัครเป็นทีเอ";
    }
    public function  actionSave_workload_ta(){
        echo "บันทึกภาระงาน";

    }
    public function actionView_compensation(){
        echo "ดูยอดค่าตอบแทน";
    }

    public function actionAssessment_ta(){
        echo "ประเมิณทีเอ";
    }

}