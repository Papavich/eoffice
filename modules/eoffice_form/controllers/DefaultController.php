<?php

namespace app\modules\eoffice_form\controllers;

use yii\web\Controller;

/**
 * Default controller for the `eoffice_form` module
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
