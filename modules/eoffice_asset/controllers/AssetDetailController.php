<?php

namespace app\modules\eoffice_asset\controllers;

use yii\base\Model;

use app\modules\eoffice_asset\models\Asset;
use app\modules\eoffice_asset\models\AssetSearch;

use Yii;
use app\modules\eoffice_asset\models\AssetDetail;
use app\modules\eoffice_asset\models\AssetdetailSearch;
use app\modules\eoffice_asset\models\AssetTypeDepartment;
use app\modules\eoffice_asset\models\EofficeCentralViewPisRoom;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\eoffice_asset\models;

use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;

use yii\db\Query;
use PHPExcel;
use PHPExcel_IOFactory;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\mpdf\Pdf;


/**
 * AssetDetailController implements the CRUD actions for AssetDetail model.
 */
class AssetDetailController extends Controller
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

    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    /**
     * Lists all AssetDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules"; //ทีม



       // $asset_status = new models\AssetDetailStatus;

    //    $name1 =  \app\modules\eoffice_asset\models\AssetTypeDepartment::findOne($model['asset_dept_type'])->asset_type_dept_name;
       // $status = \app\modules\eoffice_asset\models\AssetDetailStatus::find($model['asset_detail_status'])->where($asset_status['asset_name']);
        $searchModel = new AssetdetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,


          //  'name1' => $name1
        ]);
    }

    /**
     * Displays a single AssetDetail model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $this->layout = "main_modules"; //ทีม

        $model = $this->findModel($id);
        $modelA = $this->findModelAsset($model->asset_asset_id);
        return $this->render('view', [
            'model' => $model,
            'modelA' => $modelA,

        ]);
    }

    /**
     * Creates a new AssetDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     *
     *
     */

    public function actionExcel() {
        // Create new PHPExcel object

        $objPHPExcel = new PHPExcel(); //สร้างไฟล์ excel
        // Add some data

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'รายการครุภัณฑ์คงเหลือปี') //กำหนดให้ cell A2 พิมพ์คำว่า Employees Report
            ->setCellValue('A2', 'ลำดับ') //กำหนดให้ cell A4 พิมพ์คำว่า employeeNumber
            ->setCellValue('B2', 'รายการ') //กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('C2', 'ลักษณะ/ยี่ห้อ') //กำหนดให้ cell C4 พิมพ์คำว่า lastName
            ->setCellValue('D2', 'หมายเลขครุภัณฑ์มหาวิทยาลัย') //กำหนดให้ cell D4 พิมพ์คำว่า extension
            ->setCellValue('E2', 'หมายเลขครุภัณฑ์ภาควิชา') //กำหนดให้ cell E4 พิมพ์คำว่า email
            ->setCellValue('F2', 'ราคาต่อหน่วย') //กำหนดให้ cell D4 พิมพ์คำว่า officeCode
            ->setCellValue('G2', 'สถานที่เก็บ') //กำหนดให้ cell G4 พิมพ์คำว่า reportsTo
            ->setCellValue('H2', 'วิธีการที่ได้มา') //กำหนดให้ cell H4 พิมพ์คำว่า jobTitle
            ->setCellValue('I2', 'ปีงบประมาณ') //กำหนดให้ cell H4 พิมพ์คำว่า jobTitle
            ->setCellValue('J2', 'หมายเหตุ'); //กำหนดให้ cell H4 พิมพ์คำว่า jobTitle

             $i = 3 ; // กำหนดค่า i เป็น 6 เพื่อเริ่มพิมพ์ที่แถวที่ 6
             $no = 1;

        $connection = Yii::$app->get('db_asset');
        $query = $connection->createCommand("SELECT asset.*,asset_detail.* FROM asset,asset_detail WHERE asset.asset_id = asset_detail.asset_asset_id");
       $model = $query->queryAll();

        foreach($model as $item){ //วนลูปหาพนักงานทั้งหมด
            $room = EofficeCentralViewPisRoom::findOne($item["asset_detail_room"])->rooms_name;


            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $no); //กำหนดให้คอลัมม์ A แถวที่ i พิมพ์ค่าของ employeeNumber
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $item["asset_detail_name"]);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $item["asset_detail_brand"]);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $item["asset_univ_code_start"]);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $item["asset_dept_code_start"]);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $item["asset_detail_price"]);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $room);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $room);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $item["asset_year"]);

            $i++;
            $no++;
        }



        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('myData.xlsx'); // Save File เป็นชื่อ myData.xlsx
        echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web').'/myData.xlsx'), ['class' => 'btn btn-info']);  //สร้าง link download
    }

    public function actionCreate()
    {

        $this->layout = "main_modules";

        $modelA = new Asset;
        $model = [new AssetDetail];

        if ($modelA->load(Yii::$app->request->post())) {

            $model = Model::createMultiple(AssetDetail::classname());
            Model::loadMultiple($model, Yii::$app->request->post());

            // validate all models
            $valid = $modelA->validate();
            $valid = Model::validateMultiple($model) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $modelA->save(false)) {
                        foreach ($model as $models) {
                            $models->asset_id = $modelA->asset_detail_id;
                            if (! ($flag = $models->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelA->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelA' => $modelA,
            'model' => (empty($model)) ? [new Asset()] : $model
        ]);
    }

    public function actionUpdate($id)
    {
        $this->layout = "main_modules"; //ทีม

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->asset_detail_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AssetDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionDelete($id)
    {
        $this->layout = "main_modules";

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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelAsset($id)
    {
        if (($model = Asset::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findModelType($id)
    {
        if (($model = AssetTypeDepartment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
}
