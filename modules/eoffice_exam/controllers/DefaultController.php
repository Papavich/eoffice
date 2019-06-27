<?php

namespace app\modules\eoffice_exam\controllers;

use yii\web\Controller;

/**
 * Default controller for the `eoffice_exam` module
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
}
