<?php

namespace app\modules\eoffice_exam\controllers;

class BasicdataController extends \yii\web\Controller
{
    public function actionBasicdata()
    {
        $this->layout = "main_modules";
        return $this->render('basicdata');
    }

}
