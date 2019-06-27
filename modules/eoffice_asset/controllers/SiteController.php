<?php

namespace app\modules\eoffice_asset\controllers;
use yii\web\Controller;


class SiteController extends Controller
{
    public function actionIndex()
    {
        $this->layout = "main_modules"; //ทีม
        return $this->render('index');
    }

    public function actionLoadApp()
    {
        $this->layout = "main_modules"; //ทีม
        return $this->render('load-app');
    }

}

