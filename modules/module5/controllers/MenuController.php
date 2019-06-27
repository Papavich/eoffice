<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/13/2017
 * Time: 4:18 PM
 */

namespace app\modules\module5\controllers;


use yii\web\Controller;

class MenuController extends Controller
{
    public function actionMenu1(){

        return $this->render('menu1');
    }
    public function actionMenu2(){
        return $this->render('menu2');
    }
    public function actionMenu3(){
        return $this->render('menu3');

    }
    public function actionMenu4(){
        return $this->render('menu4');

    }
    public function actionMenu5(){
        return $this->render('menu5');

    }

}