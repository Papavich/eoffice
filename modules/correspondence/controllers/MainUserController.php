<?php

namespace app\modules\correspondence\controllers;

use app\modules\correspondence\models\model_main\PersonView;

class MainUserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = PersonView::find()->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['data' => $searchModel];
    }

}
