<?php

namespace app\modules\eoffice_exam\controllers;
use Yii;
use app\modules\eoffice_exam\models\EofficeExamBusydate;
use app\modules\eoffice_exam\models\EofficeExamBusydateSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CheckinvigilatorController extends \yii\web\Controller
{
    public function actionCheckinvigilator()
    {
        $searchModel = new EofficeExamBusydateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('checkinvigilator', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
