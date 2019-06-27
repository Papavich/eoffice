<?php

namespace app\modules\eoffice_consult\controllers;


use app\modules\eoffice_consult\models\EofficeCentralViewStudentFull;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

class SiteController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->layout = "main_modules";
        return $this->render('index');
    }


    public function actionProfile()
    {
      $this->layout = "main_modules";
        $model = new EofficeCentralViewStudentFull();
        $searchModel = new EofficeCentralViewStudentFull();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider = new ActiveDataProvider([
        //                'query' => $query,
        //                'sort'=> ['defaultOrder' => ['rep_desc_id'=>SORT_DESC]]
    // ]);
        return $this->render('profile', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }


}
