<?php

namespace app\modules\eoffice_exam\controllers;

class InvigilatorremindersController extends \yii\web\Controller
{
    public function actionInvigilatorreminders()
    {
        $this->layout = "main_modules";
        return $this->render('invigilatorreminders');
    }

}
