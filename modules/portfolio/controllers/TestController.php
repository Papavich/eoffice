<?php

namespace app\modules\portfolio\controllers;

use app\modules\portfolio\models\Owner;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * Default controller for the `portfolio_system` module
 */
class TestController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $owner = Owner::find()->all();
        return Json::encode($owner);
        return $this->render('index');
    }
}
