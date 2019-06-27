<?php

namespace app\modules\eoffice_eolm\controllers;
use app\modules\eoffice_eolm\components\AuthHelper;
use app\modules\eoffice_eolm\components\ModelHelper;
use app\modules\eoffice_eolm\models\EolmApprovalformajSearch;
use app\modules\eoffice_eolm\models\EolmApprovalformajSearch_dis;
use app\modules\eoffice_eolm\models\EolmApprovalformHasPersonal;
use app\modules\eoffice_eolm\models\EolmApprovalformsfSearch;
use app\modules\eoffice_eolm\models\EolmApprovalformsfSearch_dis;
use app\modules\eoffice_eolm\models\EolmHotel;
use app\modules\eoffice_eolm\models\EolmReceiptHotelajSearch;
use app\modules\eoffice_eolm\models\model_main\EofficeMainViewPisPerson;
use Yii;
use app\modules\eoffice_eolm\models\Model;
use app\modules\eoffice_eolm\models\EolmReceiptHotel;
use app\modules\eoffice_eolm\models\EolmReceiptHotelDetails;
use app\modules\eoffice_eolm\models\EolmReceiptHotelDetailsPersonal;
use app\modules\eoffice_eolm\models\EolmReceiptHotelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;
/**
 * ReceipthotelController implements the CRUD actions for EolmReceiptHotel model.
 */
class ReceipthotelController extends Controller
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
     * Lists all EolmReceiptHotel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmReceiptHotelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionApprovalsearch()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmApprovalformsfSearch_dis();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('approvalsearch', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionApprovalajsearch()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmApprovalformajSearch_dis();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('approvalajsearch', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionHotel()
    {
        $hotel = new EolmHotel();

        if ($hotel->load(Yii::$app->request->post()) && $hotel->save()) {
            Yii::$app->session->setFlash('success', "บันทึกสำเร็จ");
            //return $this->redirect(['index']);
        }

        return $this->render('create', [
            'hotel' => $hotel,
        ]);
    }
    public function actionIndexaj()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmReceiptHotelajSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexaj', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EolmReceiptHotel model.
     * @param integer $eolm_app_id
     * @param integer $eolm_hotel_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($eolm_app_id, $eolm_hotel_id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($eolm_app_id, $eolm_hotel_id),
        ]);
    }

    /**
     * Creates a new EolmReceiptHotel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $this->layout = "main_modules";
        $model = ModelHelper::create(new EolmReceiptHotel);
        $modelsHotel = [new EolmReceiptHotelDetails];
        $modelsDetail = [[new EolmReceiptHotelDetailsPersonal]];


        if ($model->load(Yii::$app->request->post())) {
            $model->eolm_app_id=$id;
            $modelsHotel = Model::createMultiple(EolmReceiptHotelDetails::classname());
            Model::loadMultiple($modelsHotel, Yii::$app->request->post());

            // validate
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsHotel) && $valid;
            if ($valid) {
            if (isset($_POST['EolmReceiptHotelDetailsPersonal'][0][0])) {
                foreach ($_POST['EolmReceiptHotelDetailsPersonal'] as $indexHotel => $details) {
                    foreach ($details as $indexDetail => $detail) {
                        $data['EolmReceiptHotelDetailsPersonal'] = $detail;
                        $modelDetail = new EolmReceiptHotelDetailsPersonal;
                        $modelDetail->load($data);
                        $modelsDetail[$indexHotel][$indexDetail] = $modelDetail;
                        $valid = $modelDetail->validate();
                    }
                }
            }}
                if ($valid) {


                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsHotel as $indexHotel => $modelHotel) {

                            if ($flag === false) {
                                break;
                            }

                            $modelHotel->eolm_app_id = $model->eolm_app_id;
                            $modelHotel->eolm_hotel_id = $model->eolm_hotel_id;

                            if (!($flag = $modelHotel->save(false))) {
                                break;
                            }

                            if (isset($modelsDetail[$indexHotel]) && is_array($modelsDetail[$indexHotel])) {
                                foreach ($modelsDetail[$indexHotel] as $indexDetail => $modelDetail) {
                                    $modelDetail->eolm_app_id = $model->eolm_app_id;
                                    $modelDetail->eolm_hotel_id = $modelHotel->eolm_hotel_id;
                                    $modelDetail->eolm_rec_hotel_details_room_name = $modelHotel->eolm_rec_hotel_details_room_name;
                                    if (!($flag = $modelDetail->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        $userType = AuthHelper::getUserType();
                        if ($userType==AuthHelper::TYPE_ADMIN){
                            Yii::$app->session->setFlash( 'success', "บันทึกสำเร็จ" );
                            return $this->redirect(['index', 'id' => $model->eolm_app_id]);
                        }elseif ($userType==AuthHelper::TYPE_TEACHER||AuthHelper::TYPE_APPROVERS){
                            Yii::$app->session->setFlash( 'success', "บันทึกสำเร็จ" );
                            return $this->redirect(['index', 'id' => $model->eolm_app_id]);
                        }
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsHotel' => (empty($modelsHotel)) ? [new EolmReceiptHotelDetails] : $modelsHotel,
            'modelsDetail' => (empty($modelsDetail)) ? [[new EolmReceiptHotelDetailsPersonal]] : $modelsDetail,
        ]);
    }

    /**
     * Updates an existing EolmReceiptHotel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $eolm_app_id
     * @param integer $eolm_hotel_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($eolm_app_id, $eolm_hotel_id)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($eolm_app_id, $eolm_hotel_id);
        $model = ModelHelper::update($model);
        $modelsHotel = $model->eolmReceiptHotelDetails;
        $modelsDetail = [];
        $oldDetails = [];
        if (!empty($modelsHotel)) {
            foreach ($modelsHotel as $indexHotel => $modelHotel) {
                $details = $modelHotel->eolmReceiptHotelDetailsPersonals;
                $modelsDetail[$indexHotel] = $details;
                $oldDetails = ArrayHelper::merge(ArrayHelper::index($details, 'eolm_rec_hotel_details_room_name'), $oldDetails);
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            EolmReceiptHotelDetailsPersonal::deleteAll(['eolm_app_id' => $eolm_app_id,'eolm_hotel_id'=>$eolm_hotel_id]);
            EolmReceiptHotelDetails::deleteAll(['eolm_app_id' => $eolm_app_id,'eolm_hotel_id'=>$eolm_hotel_id]);

            $modelsHotel = Model::createMultiple(EolmReceiptHotelDetails::classname());
            Model::loadMultiple($modelsHotel, Yii::$app->request->post());


            // validate
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsHotel) && $valid;

            if (isset($_POST['EolmReceiptHotelDetailsPersonal'][0][0])) {
                foreach ($_POST['EolmReceiptHotelDetailsPersonal'] as $indexHotel => $details) {
                    foreach ($details as $indexDetail => $detail) {
                        $data['EolmReceiptHotelDetailsPersonal'] = $detail;
                        $modelDetail = new EolmReceiptHotelDetailsPersonal;
                        $modelDetail->load($data);
                        $modelsDetail[$indexHotel][$indexDetail] = $modelDetail;
                        $valid = $modelDetail->validate();
                    }
                }
            }

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsHotel as $indexHotel => $modelHotel) {

                            if ($flag === false) {
                                break;
                            }

                            $modelHotel->eolm_app_id = $model->eolm_app_id;
                            $modelHotel->eolm_hotel_id = $model->eolm_hotel_id;

                            if (!($flag = $modelHotel->save(false))) {
                                break;
                            }

                            if (isset($modelsDetail[$indexHotel]) && is_array($modelsDetail[$indexHotel])) {
                                foreach ($modelsDetail[$indexHotel] as $indexDetail => $modelDetail) {
                                    $modelDetail->eolm_app_id = $model->eolm_app_id;
                                    $modelDetail->eolm_hotel_id = $modelHotel->eolm_hotel_id;
                                    $modelDetail->eolm_rec_hotel_details_room_name = $modelHotel->eolm_rec_hotel_details_room_name;
                                    if (!($flag = $modelDetail->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        $userType = AuthHelper::getUserType();
                        if ($userType==AuthHelper::TYPE_ADMIN){
                            Yii::$app->session->setFlash( 'success', "แก้ไขสำเร็จ" );
                            return $this->redirect(['index','id'=>$eolm_app_id]);
                        }elseif ($userType==AuthHelper::TYPE_TEACHER||AuthHelper::TYPE_APPROVERS){
                            Yii::$app->session->setFlash( 'success', "แก้ไขสำเร็จ" );
                            return $this->redirect(['index','id'=>$eolm_app_id]);
                        }
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsHotel' => (empty($modelsHotel)) ? [new EolmReceiptHotelDetails] : $modelsHotel,
            'modelsDetail' => (empty($modelsDetail)) ? [[new EolmReceiptHotelDetailsPersonal]] : $modelsDetail
        ]);
    }

    /**
     * Deletes an existing EolmReceiptHotel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $eolm_app_id
     * @param integer $eolm_hotel_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($eolm_app_id, $eolm_hotel_id)
    {

        $this->layout = "main_modules";

        $models = $this->findModel($eolm_app_id, $eolm_hotel_id);
        if ($models->delete()) {
            Yii::$app->session->setFlash( 'success', "ลบข้อมูลสำเร็จ" );
            return $this->redirect(['index','id'=>$eolm_app_id]);
        }
    }

    /**
     * Finds the EolmReceiptHotel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $eolm_app_id
     * @param integer $eolm_hotel_id
     * @return EolmReceiptHotel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($eolm_app_id, $eolm_hotel_id)
    {
        if (($model = EolmReceiptHotel::findOne(['eolm_app_id' => $eolm_app_id, 'eolm_hotel_id' => $eolm_hotel_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionExcel($eolm_app_id,$eolm_hotel_id) {


        $ho1 = EolmHotel::find()->where(['eolm_hotel_id'=>$eolm_hotel_id])->one();
        $hotel= 'พักที่: '.$ho1['eolm_hotel_name'].' '.$ho1['eolm_hotel_address'];

        $ho2 = EolmReceiptHotel::find()->where(['eolm_hotel_id'=>$eolm_hotel_id,'eolm_app_id'=>$eolm_app_id])->one();
        $date1 = new \DateTime($ho2['eolm_rec_hotel_stay_date']);
        $date2 = new \DateTime($ho2['eolm_rec_hotel_checkout_date']);

        $detail='ค่าที่พักจำนวน '.$ho2['eolm_rec_hotel_room_amount'].'ห้อง จำนวน '.$ho2['eolm_rec_hotel_nights_amount'].' ราคาห้องละ '.$ho2['eolm_rec_hotel_price_per_room'].' บาท ';
        $detail2='เข้าพักวันที่ '.$date1->format('d-M-Y');
        $detail3= 'ออกจากที่พักวันที่ '.$date2->format('d-M-Y');

        $ho3 = EolmReceiptHotelDetails::find()->where(['eolm_hotel_id'=>$eolm_hotel_id,'eolm_app_id'=>$eolm_app_id])->asArray()->all();


        $n=Yii::getAlias('@webroot').'/web_eolm/files/111hotel.xlsx';
        $objReader = new \PHPExcel_Reader_Excel2007();
        $objPHPExcel = $objReader->load($n);
        //set value

        $i = 8; // กำหนดค่า i เป็น 8 เพื่อเริ่มพิมพ์ที่แถวที่ 8
        $x=1;

        // Write data from MySQL result


        $objPHPExcel->getActiveSheet()->setCellValue('A5', $date1->format('d/m/Y').' ถึง '.$date2->format('d/m/Y'));
        $objPHPExcel->getActiveSheet()->setCellValue('A3', $hotel);
        $objPHPExcel->getActiveSheet()->setCellValue('B5', $detail);
        $objPHPExcel->getActiveSheet()->setCellValue('B6', $detail2);
        $objPHPExcel->getActiveSheet()->setCellValue('B7', $detail3);

        foreach($ho3 as $item){ //วนลูปหาพนักงานทั้งหมด

            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, 'ห้องที่ '.$x.' '.$item['eolm_rec_hotel_details_room_name']);
            $ho4 = EolmReceiptHotelDetailsPersonal::find()->where(['eolm_hotel_id'=>$eolm_hotel_id,'eolm_app_id'=>$eolm_app_id,'eolm_rec_hotel_details_room_name'=>$item['eolm_rec_hotel_details_room_name']])->asArray()->all();
            foreach($ho4 as $itemd){
                $i++;
                $name=EofficeMainViewPisPerson::find()->where(['person_id'=>$itemd['person_id']])->one();
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $name['PREFIXNAME'].' '.$name['person_name'].' '.$name['person_surname']);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $itemd['eolm_rec_hotel_details_personal_amount']);

            }
            $i++;
            $x++;
        }
       // $objPHPExcel->getActiveSheet()->setCellValue('B'. $i, $ho2['eolm_rec_hotel_amount_text']);
       // $objPHPExcel->getActiveSheet()->setCellValue('C'. $i, $ho2['eolm_rec_hotel_amount']);
         $objPHPExcel->getActiveSheet()->setCellValue('A21', $ho2['eolm_rec_hotel_amount_text']);
         $objPHPExcel->getActiveSheet()->setCellValue('C21', $ho2['eolm_rec_hotel_amount']);
       /* $objPHPExcel->getActiveSheet()->getStyle(
            'B8:' .
            2 .
            $i-6
        )->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);*/
        //$i=$i+2;
       // $objPHPExcel->getActiveSheet()->setCellValue('B'. $i, 'ลงชื่อ...............................................');
       // $i++;
        //ผู้ขออนุมัติ
        $modelper1 = EolmApprovalformHasPersonal::find()->where(['eolm_app_id' => $eolm_app_id,'eolm_app_has_person_type_id'=>1])->one();
        $per1 = EofficeMainViewPisPerson::find()->where(['person_id'=>$modelper1["person_id"]])->one();
        $person_id = $per1['academic_positions_abb_thai']." ".$per1['person_name']." ".$per1['person_surname'];
       // $objPHPExcel->getActiveSheet()->setCellValue('B'. $i, '( '.$person_id.' )');
        $objPHPExcel->getActiveSheet()->setCellValue('B24', '( '.$person_id.' )');



        //save file
        $name = Yii::getAlias('@webroot').'/web_eolm/files/disbursement/บก111_'.$eolm_app_id.$eolm_hotel_id.'.xlsx';
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($name);
        //download file
        $path =Yii::getAlias('@web').'/web_eolm/files/disbursement/บก111_'.$eolm_app_id.$eolm_hotel_id.'.xlsx'; // สร้าง Link สำหรับ Download ไฟล์ที่แทนที่ข้อมูลแล้ว
        return Yii::$app->response->redirect($path);
    }
}
