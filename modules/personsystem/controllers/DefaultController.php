<?php

namespace app\modules\personsystem\controllers;

use yii\web\Controller;

/**
 * Default controller for the `personsystem` module
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
