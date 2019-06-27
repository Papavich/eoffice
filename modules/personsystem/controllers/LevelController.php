<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/3/2018
 * Time: 1:02 AM
 */

namespace app\modules\personsystem\controllers;




use app\modules\personsystem\models\BachelorHasLevelSearch;
use app\modules\personsystem\models\BachelorSearch;
use app\modules\personsystem\models\BranchHasLevel;
use app\modules\personsystem\models\BranchHasLevelSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * BachelorHasLevelController implements the CRUD actions for BachelorHasLevel model.
 */
class LevelController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Lists all BranchHasLevel models.
     * @return mixed
     */
    public function actionAddLevelBachelor(){
        $model4 = new BranchHasLevel();
        $searchModel4 = new BranchHasLevelSearch();
        $dataProvider4 = $searchModel4->search(\Yii::$app->request->queryParams);
        $this->layout = "main_modules";
        return $this->render('add-level-bachelor',[
            'model'=> $model4,
            'searchModel' => $searchModel4,
            'dataProvider' => $dataProvider4,
        ]);
    }
    public function actionCreateLevelBachelor()
    {
        $model = new BranchHasLevel();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['add-level-bachelor']);
        }
        return $this->render('add-level-bachelor', [
            'model' => $model,
        ]);
    }

}