<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/5/2561
 * Time: 11:31
 */

namespace app\modules\eoffice_materialsys\controllers;

use app\modules\eoffice_materialsys\models\MatsysBillDetail;
use app\modules\eoffice_materialsys\models\MatsysBillMaster;
use app\modules\eoffice_materialsys\models\MatsysBillMasterSearch;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
\Yii::getAlias('@web');
class ListbillController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(['list']);
    }

    public function actionList()
    {
        $searchModel = new MatsysBillMasterSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 20;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDetailview(){
        $id = \Yii::$app->request->get('id');

        $query = MatsysBillDetail::find()
        ->where('bill_master_id = :bill_master_id',[':bill_master_id'=>$id]);
        $model = MatsysBillMaster::findOne($id);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('view',[
            'model'=>$model,
            'dataProvider' => $dataProvider
        ]);
    }

}