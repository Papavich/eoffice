<?php

namespace app\modules\eoffice_exam\controllers;

class EditreportController extends \yii\web\Controller
{
    public function actionEditreport()
    {
        $this->layout = "main_modules";
        return $this->render('editreport');
    }

}
