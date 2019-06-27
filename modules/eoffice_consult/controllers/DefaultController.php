<?php

namespace app\modules\eoffice_consult\controllers;

use yii\web\Controller;

/**
 * Default controller for the `eoffice_consult` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionIndex2()
    {
        return $this->render('index');
    }
}
