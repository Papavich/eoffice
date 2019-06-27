<?php

namespace app\modules\eoffice_asset\controllers;

use app\modules\eoffice_asset\models\AssetGet;
use app\modules\eoffice_asset\models\EofficeCentralViewPisRoom;
use Yii;
use app\modules\eoffice_asset\models\Asset;
use app\modules\eoffice_asset\models\AssetSearch;
use app\modules\eoffice_asset\models\AssetTypeDepartment;
use app\modules\eoffice_asset\models\AssetDetail;
use app\modules\eoffice_asset\models\AssetDetailSearch;
use app\modules\eoffice_asset\models\ModelAssetDetail;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use PHPExcel;
use PHPExcel_IOFactory;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\mpdf\Pdf;
/**
 * AssetController implements the CRUD actions for Asset model.
 */
class AssetController extends Controller
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
     * Lists all Asset models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules"; //ทีม
        $searchModel = new AssetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Asset model.
     * @param integer $id
     * @return mixed
     */

    public function actionQrcode($id)
    {
        {
            $model = $this->findModel($id);
            $connection = Yii::$app->get('db_asset');
            $query = $connection->createCommand("SELECT * FROM asset_detail where asset_asset_id=$id");
            $modelA = $query->queryAll();


            $content = $this->renderPartial('qrcode', [
                'model' => $model,
                'modelA' => $modelA
            ]);

            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
                // set to use core fonts only
                'mode' => Pdf::MODE_UTF8,
                // A4 paper format
                'format' => [30, 30],//กำหนดขนาด
                'marginLeft' => false,
                'marginRight' => false,
                'marginTop' => 3,
                'marginBottom' => false,
                'marginHeader' => false,
                'marginFooter' => false,

                // portrait orientation
                'orientation' => Pdf::ORIENT_PORTRAIT,
                // stream to browser inline
                'destination' => Pdf::DEST_BROWSER,
                // your html content input
                'content' => $content,
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css',
                // any css to be embedded if required
                'cssInline' => 'body{font-size:11px}',
                // set mPDF properties on the fly
                'options' => ['title' => 'Print Sticker', ],
                // call mPDF methods on the fly
                'methods' => [
                    'SetHeader'=>false,
                    'SetFooter'=>false,
                ]
            ]);

            // return the pdf output as per the destination setting
            return $pdf->render();
        }
    }

    public function actionView($id)
    {

        $this->layout = "main_modules"; //ทีม

        $model = $this->findModel($id);
        $connection = Yii::$app->get('db_asset');
        $query = $connection->createCommand("SELECT * FROM asset_detail where asset_asset_id=$id ");  //showผลงาน
        $modelA = $query->queryAll();
     //   $modelA = $this->findModelAssetDetail($model);
 //  $modelA = AssetDetail::find()->where(['asset_asset_id'=>$id])->all();

        return $this->render('view', [
            'model' => $model,
            'modelA' => $modelA

        ]);
    }

    public function actionPrintAsset($id)
    {
        $model = $this->findModel($id);
        $connection = Yii::$app->get('db_asset');
        $query = $connection->
        createCommand("SELECT * FROM asset_detail where asset_asset_id=$id");
        $modelA = $query->queryAll();


        $content = $this->renderPartial('print-asset', [
            'model' => $model,
            'modelA' => $modelA
        ]);



        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => [297, 210],
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css',
            // any css to be embedded if required
            'cssInline' => '.bd{border:1.5px solid; text-align: center;} .ar{text-align:right} .imgbd{border:1px solid}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Preview Report Case: '.$id],
            // call mPDF methods on the fly
            'methods' => [
                //'SetHeader'=>[''],
                //'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }


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
        $model = new Asset();

        $this->layout = "main_modules"; //ทีม
        if ($model->load(Yii::$app->request->post()) && $model->save()
        ) {
            return $this->redirect(['view', 'id' => $model->asset_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionInsertDetail()    //insertลูกครถภัณฑ์
    {
        $detail = new AssetDetail();

        if ($detail->load(Yii::$app->request->post()) && $detail->save()) {
            return $this->redirect(['view', 'id' => $detail->asset_detail_id]);
        } else {
            return $this->render('create', [
                'model' => $detail,
            ]);
        }
    }



    /**
     * Updates an existing Asset model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $this->layout = "main_modules"; //ทีม


        $modelAsset = Asset::find()->where(['asset_id'=>$id])->one();



        $modelsAssetDetail = AssetDetail::find()->where(['asset_asset_id'=>$id])->groupBy(['asset_dept_type']) ->all();
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

                    //echo $num;

                    $num=$row->asset_detail_amount;

                    //ตัดสตริง รันนิ่งโค้ด
                    $code_dept=$row->asset_dept_code_start;
                    $code_dept_str= substr($code_dept,10,3);
                    $code_dept_font=substr($code_dept,0,10);
                    $code_dept_end=substr($code_dept,13,11);


                    $code_univ=$row->asset_univ_code_start;
                    $num_running = $code_dept_str;


                    $model->save();

                    for ($num1=1;$num1<$num;$num1++) {

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

                        $model->save();
                        //echo $num1;
                    }

                    }

            }
            return $this->redirect(['index',

            ]);
        }

        return $this->render('update2', [
            'modelAsset' => $modelAsset,
            'modelsAssetDetail' => (empty($modelsAssetDetail)) ? [new AssetDetail] : $modelsAssetDetail
        ]);
    }
    /**
     * Deletes an existing Asset model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $this->findModelAssetDetail($id)->delete();

        return $this->redirect(['view'=>$id->asset_id]);
    }

    public function actionDeleteAsset($id)
    {


        $model = $this->findModel($id);
        $connection = Yii::$app->get('db_asset');
        $query = $connection->createCommand("SELECT * FROM asset_detail where asset_asset_id=$id");
        $query->deleteAll()&& $model->delete();

        return $this->redirect(['index']);
    }



    /**
     * Finds the Asset model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Asset the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Asset::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    protected function findModelAssetDetail($asset_asset_id)

    {
        if (($modelA = AssetDetail::findOne($asset_asset_id)) !== null) {
            return $modelA;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }




}









