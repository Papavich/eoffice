<?php

namespace app\modules\eoffice_exam\controllers;

class StudentremindersController extends \yii\web\Controller
{
    public function actionStudentreminders()
    {
        $this->layout = "main_modules";
        return $this->render('studentreminders');
    }

}
