<?php

namespace app\modules\eoffice_asset\controllers;

use app\modules\eoffice_asset\models\Asset;
use app\modules\pms\models\Model;
use Codeception\Module\Yii1;
use Yii;
use app\modules\eoffice_asset\models\AssetDetail;
use app\modules\eoffice_asset\models\AssetDetailSearch;
use app\modules\eoffice_asset\models\AssetImage;
use yii\gii\Module;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * AssetDetailInsertController implements the CRUD actions for AssetDetail model.
 */
class AssetDetailInsertController extends Controller
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
     * Lists all AssetDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AssetDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AssetDetail model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modeldetail = $model->asset_asset_id;

        return $this->render('view', [
            'model' => $model,
            'modeldetail' => $modeldetail,
        ]);
    }

    /**
     * Creates a new AssetDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      /*  $model = new AssetDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->asset_detail_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]); */
        $modelAsset = new Asset;
        $modelsAssetDetail = [new AssetDetail];
        if($modelsAssetDetail->load(Yii::$app->request->post())) {

            $modelsAssetDetail = Model::createMultiple(AssetDetail::className());
            Model::loadMultiple($modelsAssetDetail, Yii::$app->request->post());
            foreach ($modelsAssetDetail as $index => $modelAssetDetail){
                $modelAssetDetail->asset_detail_name = $index;
                $modelAssetDetail->img =\yii\web\UploadedFile::getInstance($modelAssetDetail,"[{$index}]img");

            }

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsAssetDetail),
                    ActiveForm::validate($modelAsset)
                );
            }
            // validate all models
            $valid = $modelAssetDetail->validate();
            $valid = Model::validateMultiple($modelsAssetDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelAssetDetail->save(false)) {
                        foreach ($modelsAssetDetail as $modelAssetDetail) {
                            $modelAssetDetail->asset_asset_id = $modelAssetDetail->id;

                            if (($flag = $modelsAssetDetail->save(false)) === false) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelAssetDetail->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }


    }

    /**
     * Updates an existing AssetDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
      /*  $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->asset_detail_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]); */

        $modelAsset = Asset::find()->where(['asset_id'=>$id])->one();
        $modelsAssetDetail = AssetDetail::find()->where(['asset_asset_id'=>$id])->all();

        if($modelsAssetDetail->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsAssetDetail, 'id', 'id');
            $modelsAssetDetail = Model::createMultiple(AssetDetail::className());
            Model::loadMultiple($modelsAssetDetail, Yii::$app->request->post());
            foreach ($modelsAssetDetail as $index => $modelAssetDetail){
                $modelAssetDetail->asset_detail_name = $index;
                $modelAssetDetail->img =\yii\web\UploadedFile::getInstance($modelAssetDetail,"[{$index}]img");

            }

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsAssetDetail),
                    ActiveForm::validate($modelAsset)
                );
            }
            // validate all models
            $valid = $modelAssetDetail->validate();
            $valid = Model::validateMultiple($modelsAssetDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelAssetDetail->save(false)) {
                        foreach ($modelsAssetDetail as $modelAssetDetail) {
                            $modelAssetDetail->asset_asset_id = $modelAssetDetail->id;

                            if (($flag = $modelsAssetDetail->save(false)) === false) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelAssetDetail->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }


    }

    /**
     * Deletes an existing AssetDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AssetDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AssetDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AssetDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
