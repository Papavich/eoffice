<?php

namespace app\modules\eoffice_asset\controllers;

use yii\web\Controller;

/**
 * Default controller for the `eoffice_asset` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "main_modules"; //ทีม
        return $this->render('index');
    }
}
