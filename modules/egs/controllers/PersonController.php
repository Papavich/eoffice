<?php

namespace app\modules\egs\controllers;

use app\modules\egs\models\EgsCalendar;
use app\modules\egs\models\EgsLevelBinder;
use app\modules\egs\models\EgsPlan;
use app\modules\egs\models\EgsPlanBinder;
use Yii;

use yii\base\Module;
use yii\helpers\Json;
use yii\web\Controller;


class PersonController extends Controller
{
    public function actionFindTeacher($load)
    {
        $load = filter_var($load, FILTER_VALIDATE_BOOLEAN);
        $teachers = Config::get_all_teacher();
        $user = Config::get_current_user();
        $reg_program_id = $user['program_id'];
        $plan = EgsPlanBinder::findOne(['reg_program_id' => $reg_program_id]);
        $my_load = empty($plan) ? null : $plan->plan->planType->egsLoad->load_amount;
        return Json::encode(Format::personNameOnly($teachers, $load, $my_load));
    }

    public function actionStudent()
    {
        $students_ = Config::get_all_student();
        $students = [];
        foreach ($students_ as $student) {
            $reg_program_id = $student['program_id'];
            $level = EgsLevelBinder::findOne(['reg_program_id' => $reg_program_id]);
            if (!empty($level))
                array_push($students, $student);
        }
        $students = Config::get_all_student();
        return Json::encode(Format::personNameOnly($students));
    }

    public function actionCurrent()
    {
        $current_user = Config::get_current_user();
        if (!$current_user) {
            return Json::encode(['user_type_id' => -1]);
        }
        return Json::encode(Format::personNameOnly($current_user));
    }
}
