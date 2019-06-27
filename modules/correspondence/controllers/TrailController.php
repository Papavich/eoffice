<?php

namespace app\modules\correspondence\controllers;

use bedezign\yii2\audit\components\web\Controller;
use app\modules\correspondence\models\AuditTrail;
use app\modules\correspondence\models\AuditTrailSearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * TrailController
 * @package bedezign\yii2\audit\controllers
 */
class TrailController extends Controller
{
    /**
     * Lists all AuditTrail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_module";
        $searchModel = new AuditTrailSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

    /**
     * Displays a single AuditTrail model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $this->layout = "main_module";
        $searchModel = new AuditTrailSearch;
        $dataProvider = $searchModel->searchAuditTrail(Yii::$app->request->get());
        if (!$dataProvider) {
            throw new NotFoundHttpException('The requested trail does not exist.');
        }
        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }
}
