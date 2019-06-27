<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/5/2018
 * Time: 12:28 AM
 */

namespace app\modules\personsystem\controllers;


use app\modules\personsystem\models\DepartmentSearch;
use app\modules\personsystem\models\FacultySearch;
use app\modules\personsystem\models\LevelSearch;
use app\modules\personsystem\models\ProgramSearch;
use app\modules\personsystem\models\SchoolSearch;
use yii\web\Controller;

class ViewController extends Controller
{

    public function actionInformation(){
        $active = 1;
        $searchModel = new ProgramSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $searchModel2 = new LevelSearch();
        $dataProvider2 = $searchModel2->search(\Yii::$app->request->queryParams,$active);
        $searchModel3 = new SchoolSearch();
        $dataProvider3 = $searchModel3->search(\Yii::$app->request->queryParams);
        $searchModel4 = new DepartmentSearch();
        $dataProvider4 = $searchModel4->search(\Yii::$app->request->queryParams);
        $searchModel5 = new FacultySearch();
        $dataProvider5 = $searchModel5->search(\Yii::$app->request->queryParams);


        $this->layout = "main_modules";
        return $this->render('information_view',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModel2' => $searchModel2,
            'dataProvider2' => $dataProvider2[0],
            'searchModel3' => $searchModel3,
            'dataProvider3' => $dataProvider3,
            'searchModel4' => $searchModel4,
            'dataProvider4' => $dataProvider4,
            'searchModel5' => $searchModel5,
            'dataProvider5' => $dataProvider5,
            'active'=>$dataProvider2[1],
        ]);

    }
}