<?php

namespace app\modules\eoffice_ta\controllers;

use yii\web\Controller;

/**
 * Default controller for the `eoffice_ta` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        return $this->render('index');
    }


}
