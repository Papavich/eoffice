<?php

namespace app\modules\eoffice_exam\controllers;

class RemindersController extends \yii\web\Controller
{
    public function actionReminders()
    {
        $this->layout = "main_modules";
        return $this->render('reminders');
    }

}
