<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19/5/2561
 * Time: 15:49
 */

namespace app\modules\eoffice_materialsys\controllers;

use app\modules\eoffice_materialsys\models\MatsysBillDetail;
use app\modules\eoffice_materialsys\models\MatsysLocation;
use app\modules\eoffice_materialsys\models\MatsysMaterialReturnSearch;
use app\modules\eoffice_materialsys\models\MatsysMaterialType;
use app\modules\eoffice_materialsys\models\UploadForm;
use app\modules\eoffice_materialsys\models\MatsysBillDetailSearch;
use yii\data\Pagination;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

use Yii;
use app\modules\eoffice_materialsys\models\MatsysMaterial;
use app\modules\eoffice_materialsys\models\MatsysMaterialSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class MaterialreturnController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(['list']);
    }

    public function actionList(){
        $searchModel = new MatsysMaterialReturnSearch();
        $modelMaterial = new MatsysMaterial();
        $modelLocation = ArrayHelper::map(MatsysLocation::find()->all(), 'location_id', 'location_name');
        $modelType = ArrayHelper::map(MatsysMaterialType::find()->all(), 'material_type_id', 'material_type_name');
        $url_params = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['pagination' => ['pageSize' => 5]]);
        if (isset($url_params['view'])) {
            $dataProvider->pagination->pageSize = 24;
        } else {
            $dataProvider->pagination->pageSize = 20;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelMateril' => $modelMaterial,
            'modelLocation' => $modelLocation,
            'modelType' => $modelType,
        ]);
    }

}