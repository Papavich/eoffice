<?php

namespace app\modules\eoffice_exam\controllers;

class AddController extends \yii\web\Controller
{
    public function actionAdd()
    {
        $this->layout = "main_modules";
        return $this->render('add');
    }

}
