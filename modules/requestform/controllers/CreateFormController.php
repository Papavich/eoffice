<?php

namespace app\modules\requestform\controllers;

use Yii;
use yii\web\Controller;
use app\modules\requestform\models\ReqTemplate;
use yii\web\NotFoundHttpException;

class CreateFormController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->layout = "main_modules";
        $model = new ReqTemplate();
        return $this->render('index', [
            'model' => $model,
        ]);

    }

}
