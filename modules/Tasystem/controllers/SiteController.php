<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/13/2017
 * Time: 2:10 PM
 */

namespace app\modules\Tasystem\controllers;


use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $this->layout = "main_modules";
        return $this->render('index');
    }



}