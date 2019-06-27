<?php

namespace app\modules\eoffice_asset\controllers;

use app\modules\eoffice_asset\models\AssetTypeDepartment;
use app\modules\eoffice_asset\models\EofficeCentralViewPisRoom;
use phpDocumentor\Reflection\Types\Integer;
use yii\base\Model;

use app\modules\eoffice_asset\models\AssetSearch;
use Yii;
use app\modules\eoffice_asset\models\AssetDetail;
use app\modules\eoffice_asset\models\AssetdetailSearch;
use app\modules\eoffice_asset\models\Asset;
use app\modules\eoffice_asset\models\ModelAssetDetail;
use app\modules\eoffice_asset\models\AssetQuery;
use yii\web\Controller;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;
use \yii\web\UploadedFile;

/**
 * AssetInsertController implements the CRUD actions for AssetDetail model.
 */
class AssetInsertController extends Controller
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

        $this->layout = "main_modules";
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
  /*  public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }*/

    public function actionView($id)
    {

        $this->layout = "main_modules"; //ทีม

        $modelAsset = $this->findModel($id);
        $connection = Yii::$app->get('db_asset');
        $modelsAssetDetail = $connection->createCommand("SELECT * FROM asset_detail where asset_asset_id=$id ");  //showผลงาน

        //   $modelA = $this->findModelAssetDetail($model);
        //  $modelA = AssetDetail::find()->where(['asset_asset_id'=>$id])->all();

        return $this->render('view', [
            'modelAsset' => $modelAsset,
            'modelsAssetDetail' => $modelsAssetDetail

        ]);
    }




    public function actionCreate()
    {

       $this->layout = "main_modules";

        $modelAsset = new Asset;
        $modelsAssetDetail = [new AssetDetail];

        if ($modelAsset->load(Yii::$app->request->post())) {

          //  $image = UploadedFile::getInstance($model,'asset_detail_image');

            $modelAsset->save();

            $modelsAssetDetail = ModelAssetDetail::createMultiple(AssetDetail::classname(), $modelsAssetDetail);
            ModelAssetDetail::loadMultiple($modelsAssetDetail, Yii::$app->request->post());
            foreach ($modelsAssetDetail as $row) {

                if ($row->asset_detail_amount) {
                    $model = new AssetDetail;

                    $model->asset_asset_id = $modelAsset->asset_id;
                    $model->asset_univ_code_start = $row->asset_univ_code_start;
                    $model->asset_univ_type = $row->asset_univ_type;
                    $model->asset_dept_code_start = $row->asset_dept_code_start;
                    $model->asset_dept_type = $row->asset_dept_type;
                    $model->asset_detail_name = $row->asset_detail_name;
                    $model->asset_detail_brand = $row->asset_detail_brand;
                    $model->asset_detail_amount = $row->asset_detail_amount;
                    $model->asset_detail_age = $row->asset_detail_age;
                    $model->asset_detail_price = $row->asset_detail_price;
                    $model->asset_detail_price_wreck = $row->asset_detail_price_wreck;
                    $model->asset_detail_insurance = $row->asset_detail_insurance;
                    $model->asset_detail_building = $row->asset_detail_building;
                    $model->asset_detail_room = $row->asset_detail_room;
                  //  $model->asset_detail_image = $row->


                    $num=$row->asset_detail_amount;

                    //ตัดสตริง รันนิ่งโค้ด
                    $code_dept=$row->asset_dept_code_start;
                    $code_dept_str= substr($code_dept,10,3);
                    $code_dept_font=substr($code_dept,0,10);
                    $code_dept_end=substr($code_dept,13,11);


                    $code_univ=$row->asset_univ_code_start;
                    $num_running = $code_dept_str;

                      $model->save();

                    for ($num1=1;$num1<$num;$num1++){
                        $code_univ++;
                        $num_running++;
                        if(strlen($num_running)==1){
                                                  $num_running_read='00'.$num_running;
                    }else if(strlen($num_running)==2){
                        $num_running_read='0'.$num_running;
                    }else{
                        $num_running_read=''.$num_running;
                    }
                    $asset_dept_code = $code_dept_font.$num_running_read.$code_dept_end;

                        $model = new AssetDetail;
                        $model->asset_asset_id = $modelAsset->asset_id;
                        $model->asset_univ_code_start = $code_univ.'';
                        $model->asset_univ_type = $row->asset_univ_type;
                        $model->asset_dept_code_start = $asset_dept_code;
                        $model->asset_dept_type = $row->asset_dept_type;
                        $model->asset_detail_name = $row->asset_detail_name;
                        $model->asset_detail_brand = $row->asset_detail_brand;
                        $model->asset_detail_amount = $row->asset_detail_amount;
                        $model->asset_detail_age = $row->asset_detail_age;
                        $model->asset_detail_price = $row->asset_detail_price;
                        $model->asset_detail_price_wreck = $row->asset_detail_price_wreck;
                        $model->asset_detail_insurance = $row->asset_detail_insurance;
                        $model->asset_detail_building = $row->asset_detail_building;
                        $model->asset_detail_room = $row->asset_detail_room;

                        $num=$row->asset_detail_amount;

                       // $code_univ_str=$row->asset_univ_code_start;

                         $model->save();
                       //echo "__".$asset_dept_code;
                       //echo $code_dept_font.$num_running_read.$code_dept_end;
                    }

                }


            }
            return $this->render('view', [
                'modelAsset' => $modelAsset,
                'modelsAssetDetail' =>  $modelsAssetDetail,

            ]);

        }

        return $this->render('create', [
            'modelAsset' => $modelAsset,
            'modelsAssetDetail' => (empty($modelsAssetDetail)) ? [new AssetDetail()] : $modelsAssetDetail,

        ]);
    }

    /**
     * Updates an existing AssetDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   /* public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->asset_detail_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    } */

   public function actionUpdate($id)
    {
        $this->layout = "main_modules";
        $modelAsset = Asset::find()->where(['asset_id'=>$id])->one();
        $modelsAssetDetail = AssetDetail::find()->where(['asset_asset_id'=>$id])->all();
        if($modelsAssetDetail == null){
            $modelsAssetDetail = [new AssetDetail];
        }

        if ($modelAsset->load(Yii::$app->request->post())) {
            $modelAsset->save();
            $modelsAssetDetail = ModelAssetDetail::createMultiple(AssetDetail::classname(), $modelsAssetDetail);
            ModelAssetDetail::loadMultiple($modelsAssetDetail, Yii::$app->request->post());
            AssetDetail::deleteAll(['asset_asset_id'=>$modelAsset]);
            foreach ($modelsAssetDetail as $row){
                if($row->asset_detail_amount){
                    $model = new AssetDetail;
                    $model->asset_asset_id = $modelAsset->asset_id;
                    $model->asset_univ_code_start =$row->asset_univ_code_start;
                    $model->asset_univ_type =$row->asset_univ_type;
                    $model->asset_dept_code_start =$row->asset_dept_code_start;
                    $model->asset_dept_type =$row->asset_dept_type;
                    $model->asset_detail_name =$row->asset_detail_name;
                    $model->asset_detail_brand =$row->asset_detail_brand;
                    $model->asset_detail_amount =$row->asset_detail_amount;
                    $model->asset_detail_age =$row->asset_detail_age;
                    $model->asset_detail_price =$row->asset_detail_price;
                    $model->asset_detail_price_wreck =$row->asset_detail_price_wreck;
                    $model->asset_detail_insurance = $row->asset_detail_insurance;
                    $model->asset_detail_building =$row->asset_detail_building;
                    $model->asset_detail_room =$row->asset_detail_room;
                    $model->save();

                }

            }
            exit;
        }

        return $this->render('update', [
            'modelAsset' => $modelAsset,
            'modelsAssetDetail' => (empty($modelsAssetDetail)) ? [new AssetDetail] : $modelsAssetDetail
        ]);
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


  /*  public function actionDelete($id)
    {
       $this->findModel($id);
        $asset_detail_name = $model->asset_detail_name;

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Record  <strong>"' . $asset_detail_name . '"</strong> deleted successfully.');
        }

        return $this->redirect(['index']);
    }
*/
    /**
     * Finds the AssetDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AssetDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
  /*  protected function findModel($id)
    {
        if (($model = AssetDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    } */

    protected function findModel($id)
    {
        if (($model = AssetDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



   protected function Model($id)
    {
        if (($model = Asset::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
