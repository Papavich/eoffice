<?php

namespace app\modules\eoffice_exam\controllers;

class TeacherinformationController extends \yii\web\Controller
{
    public function actionTeacherinformation()
    {
        $this->layout = "main_modules";
        return $this->render('teacherinformation');
    }

}
