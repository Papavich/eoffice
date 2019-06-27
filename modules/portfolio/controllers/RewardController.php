<?php
/**
 * Created by PhpStorm.
 * User: DELLosc
 * Date: 4/9/2560
 * Time: 21:03
 */

namespace app\modules\portfolio\controllers;


use yii\web\Controller;

class RewardController extends Controller
{
    public function actionReward(){
        $this->view->params['status'] = 'staff_add';
        $this->layout = "main_modules";

        return $this->render('Reward');
    }

    public function actionResearch(){

        return $this->render('Research_Prop');
    }
}