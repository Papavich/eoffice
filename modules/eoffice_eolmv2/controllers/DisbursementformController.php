<?php

namespace app\modules\eoffice_eolmv2\controllers;


use app\modules\eoffice_eolmv2\assets\AppAssetEolm;
use app\modules\eoffice_eolmv2\models\EolmApprovalform;
use app\modules\eoffice_eolmv2\models\EolmApprovalformajSearch;
use app\modules\eoffice_eolmv2\models\EolmApprovalformajSearch_dis;
use app\modules\eoffice_eolmv2\models\EolmApprovalformHasPersonal;
use app\modules\eoffice_eolmv2\models\EolmApprovalformHasProvince;
use app\modules\eoffice_eolmv2\models\EolmApprovalformsfSearch_dis;
use app\modules\eoffice_eolmv2\models\EolmLoancontract;
use app\modules\eoffice_eolmv2\models\EolmRateCost;
use app\modules\eoffice_eolmv2\models\model_main\EofficeMainViewPisPerson;
use PhpOffice\PhpWord\Settings;
use Yii;
use app\modules\eoffice_eolmv2\components\ModelHelper;
use app\modules\eoffice_eolmv2\models\ModelDis;
use app\modules\eoffice_eolmv2\models\EolmDisbursementform;
use app\modules\eoffice_eolmv2\models\EolmDisbursementformDetails;
use app\modules\eoffice_eolmv2\models\EolmDisbursementformDetailsItem;
use app\modules\eoffice_eolmv2\models\EolmDisbursementSearch;
use app\modules\eoffice_eolmv2\models\EolmApprovalformsfSearch;

use app\modules\eoffice_eolmv2\models\Uploads;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\Url;
use yii\helpers\html;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use yii\widgets\ActiveForm;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
// Microsoft Excel
use PHPExcel;
use PHPExcel_IOFactory;
/**
 * DisbursementformController implements the CRUD actions for EolmDisbursementform model.
 */
class DisbursementformController extends Controller
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
     * Lists all EolmDisbursementform models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmDisbursementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EolmDisbursementform model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EolmDisbursementform model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $this->layout = "main_modules";
        $model = new EolmDisbursementform;
        $modelsDisburse = [new EolmDisbursementformDetails];
        $modelsDetail = [[new EolmDisbursementformDetailsItem]];
        $model->eolm_app_id = $id;
        //$model->eolm_dis_date = date('yy-mm-dd');

        if ($model->load(Yii::$app->request->post())) {
            $modelsDisburse = ModelDis::createMultiple(EolmDisbursementformDetails::classname());
            ModelDis::loadMultiple($modelsDisburse, Yii::$app->request->post());

            // validate  models
            $valid = $model->validate();
            $valid = ModelDis::validateMultiple($modelsDisburse) && $valid;

            if (isset($_POST['EolmDisbursementformDetailsItem'][0][0])) {
                foreach ($_POST['EolmDisbursementformDetailsItem'] as $indexDisburse => $details) {
                    foreach ($details as $indexDetail => $detail) {
                        $data['EolmDisbursementformDetailsItem'] = $detail;
                        $modelDetail = new EolmDisbursementformDetailsItem;

                        //$detail->doc =$modelDetail->upload($detail,'doc');

                        $modelDetail->load($data);
                        $modelsDetail[$indexDisburse][$indexDetail] = $modelDetail;
                        $valid = $modelDetail->validate();

                    }

                }
            }

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsDisburse as $indexDisburse => $modelDisburse) {

                            if ($flag === false) {
                                break;
                            }

                            $modelDisburse->eolm_app_id = $model->eolm_app_id;

                            if (!($flag = $modelDisburse->save(false))) {
                                break;
                            }

                            if (isset($modelsDetail[$indexDisburse]) && is_array($modelsDetail[$indexDisburse])) {
                                foreach ($modelsDetail[$indexDisburse] as $indexDetail => $modelDetail) {
                                    $modelDetail->eolm_app_id = $model->eolm_app_id;
                                    $modelDetail->person_id = $modelDisburse->person_id;
                                    $modelDetail->eolm_dis_type = $modelDisburse->eolm_dis_type;
                                    //add
                                   // $this->CreateDir($modelDetail->ref);
                                    //$modelDetail->covenant  = $this->uploadSingleFile($modelDetail);
                                    if (!($flag = $modelDetail->save(false))) {
                                        break;
                                    }/*else {
                                        $modelDetail->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
                                    }*/
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash( 'success', "แก้ไขสำเร็จ" );
                        return $this->redirect(['update2', 'id' => $model->eolm_app_id]);
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
            'modelsDisburse' => (empty($modelsDisburse)) ? [new EolmDisbursementformDetails] : $modelsDisburse,
            'modelsDetail' => (empty($modelsDetail)) ? [[new EolmDisbursementformDetailsItem]] : $modelsDetail,
        ]);
    }


    public function actionCreate2($id)
    {
        $model = $this->findModel($id);
        $this->layout = "main_modules";
        $model = ModelHelper::create($model);
        if ($model->load(Yii::$app->request->post())) {
            $this->Uploads(false);

            if($model->save()){
                Yii::$app->session->setFlash( 'success', "บันทึกสำเร็จ" );
                return $this->redirect(['view', 'id' => $model->eolm_app_id]);
            }

        } else {
            $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
        }
        return $this->render('create2', [
            'model' => $model,
            'initialPreview'=>[],
            'initialPreviewConfig'=>[]
        ]);
    }


    /**
     * Updates an existing EolmDisbursementform model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = "main_modules";

        $model = $this->findModel($id);
        $model = ModelHelper::update($model);
        $modelsDisburse = $model->eolmDisbursementformDetails;
        $modelsDetail = [];
        $oldDetails = [];
        if (!empty($modelsDisburse)) {
            foreach ($modelsDisburse as $indexDisburse => $modelDisburse) {
                $details = $modelDisburse->eolmDisbursementformDetailsItems;
                $modelsDetail[$indexDisburse] = $details;
                $oldDetails = ArrayHelper::merge(ArrayHelper::index($details, 'person_id'), $oldDetails);
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            EolmDisbursementformDetailsItem::deleteAll(['eolm_app_id' => $id]);
            EolmDisbursementformDetails::deleteAll(['eolm_app_id' => $id]);

            $modelsDisburse = ModelDis::createMultiple(EolmDisbursementformDetails::classname());
            ModelDis::loadMultiple($modelsDisburse, Yii::$app->request->post());


            // validate  models
            $valid = $model->validate();
            $valid = ModelDis::validateMultiple($modelsDisburse) && $valid;

            if (isset($_POST['EolmDisbursementformDetailsItem'][0][0])) {
                foreach ($_POST['EolmDisbursementformDetailsItem'] as $indexDisburse => $details) {
                    foreach ($details as $indexDetail => $detail) {
                        $data['EolmDisbursementformDetailsItem'] = $detail;
                        $modelDetail = new EolmDisbursementformDetailsItem;
                        $modelDetail->load($data);

                        $modelsDetail[$indexDisburse][$indexDetail] = $modelDetail;
                        //$modelsDetail[$indexDisburse][$indexDetail]->doc ="x.doc";
                        //$modelsDetail[$indexDisburse][$indexDetail]->doc =$modelDetail->upload($modelDetail,'doc');
                        $valid = $modelDetail->validate();
                    }
                }
            }
            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsDisburse as $indexDisburse => $modelDisburse) {

                            if ($flag === false) {
                                break;
                            }

                            $modelDisburse->eolm_app_id = $model->eolm_app_id;

                            if (!($flag = $modelDisburse->save(false))) {
                                break;
                            }

                            if (isset($modelsDetail[$indexDisburse]) && is_array($modelsDetail[$indexDisburse])) {
                                foreach ($modelsDetail[$indexDisburse] as $indexDetail => $modelDetail) {
                                    $modelDetail->eolm_app_id = $model->eolm_app_id;
                                    $modelDetail->person_id = $modelDisburse->person_id;
                                    $modelDetail->eolm_dis_type = $modelDisburse->eolm_dis_type;
                                    if (!($flag = $modelDetail->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash( 'success', "แก้ไขสำเร็จ" );
                        return $this->redirect(['update2', 'id' => $model->eolm_app_id]);
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
            'modelsDisburse' => (empty($modelsDisburse)) ? [new EolmDisbursementformDetails] : $modelsDisburse,
            'modelsDetail' => (empty($modelsDetail)) ? [[new EolmDisbursementformDetailsItem]] : $modelsDetail
        ]);
    }
    public function actionUpdate2($id)
    {
        $model = $this->findModel($id);
        $this->layout = "main_modules";
        $model = ModelHelper::update($model);

        list($initialPreview,$initialPreviewConfig) = $this->getInitialPreview($model->ref);
        if ($model->load(Yii::$app->request->post())) {
            $this->Uploads(false);
            if(empty($model->ref)){
                $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
            }

            if($model->save()){
                Yii::$app->session->setFlash( 'success', "แก้ไขสำเร็จ" );
                return $this->redirect(['view', 'id' => $model->eolm_app_id]);
            }
        }/*else {
            $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
        }*/
        return $this->render('update2', [
            'model' => $model,
            'initialPreview'=>$initialPreview,
            'initialPreviewConfig'=>$initialPreviewConfig
        ]);
    }


    /**
     * Deletes an existing EolmDisbursementform model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        //remove upload file & data
        $this->removeUploadDir($model->ref);
        Uploads::deleteAll(['ref'=>$model->ref]);
        Uploads::deleteAll(['ref'=>$model->ref]);

        if ($model->delete()) {
            Yii::$app->session->setFlash( 'success', "ลบข้อมูลสำเร็จ" );
            return $this->redirect(['index']);
        }


    }


    /**
     * Finds the EolmDisbursementform model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EolmDisbursementform the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EolmDisbursementform::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
    /*|*********************************************************************************|
  |================================ Upload Ajax ====================================|
  |*********************************************************************************|*/

    public function actionUploadAjax(){
        $this->Uploads(true);
    }

    private function CreateDir($folderName){
        if($folderName != NULL){
            $basePath = EolmDisbursementform::getUploadPath();
            if(BaseFileHelper::createDirectory($basePath.$folderName,0777)){
                BaseFileHelper::createDirectory($basePath.$folderName.'/thumbnail',0777);
            }
        }
        return;
    }

    private function removeUploadDir($dir){
        BaseFileHelper::removeDirectory(EolmDisbursementform::getUploadPath().$dir);
    }

    private function Uploads($isAjax=false) {
        if (Yii::$app->request->isPost) {
            $images = UploadedFile::getInstancesByName('upload_ajax');
            if ($images) {

                if($isAjax===true){
                    $ref =Yii::$app->request->post('ref');
                }else{
                    $EolmDisbursementform = Yii::$app->request->post('EolmDisbursementform');
                    $ref = $EolmDisbursementform['ref'];
                }

                $this->CreateDir($ref);

                foreach ($images as $file){
                    $fileName       = $file->baseName . '.' . $file->extension;
                    $realFileName   = md5($file->baseName.time()) . '.' . $file->extension;
                    $savePath       = EolmDisbursementform::UPLOAD_FOLDER.'/'.$ref.'/'. $realFileName;
                    if($file->saveAs($savePath)){

                        if($this->isImage(Url::base(true).'/'.$savePath)){
                            $this->createThumbnail($ref,$realFileName);
                        }

                        $model                  = new Uploads;
                        $model->ref             = $ref;
                        $model->file_name       = $fileName;
                        $model->real_filename   = $realFileName;
                        $model->save(false);

                        if($isAjax===true){
                            echo json_encode(['success' => 'true']);
                        }

                    }else{
                        if($isAjax===true){
                            echo json_encode(['success'=>'false','eror'=>$file->error]);
                        }
                    }

                }
            }
        }
    }

    private function getInitialPreview($ref) {
        $datas = Uploads::find()->where(['ref'=>$ref])->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $key => $value) {
            array_push($initialPreview, $this->getTemplatePreview($value));
            array_push($initialPreviewConfig, [
                'caption'=> $value->file_name,
                'width'  => '120px',
                'url'    => Url::to(['/eoffice_eolmv2/disbursementform/deletefile-ajax']),
                'key'    => $value->upload_id
            ]);
        }
        return  [$initialPreview,$initialPreviewConfig];
    }

    public function isImage($filePath){
        return @is_array(getimagesize($filePath)) ? true : false;
    }

    private function getTemplatePreview(Uploads $model){
        $filePath = EolmDisbursementform::getUploadUrl().$model->ref.'/thumbnail/'.$model->real_filename;
        $isImage  = $this->isImage($filePath);
        if($isImage){
            $file = Html::img($filePath,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
        }else{
            $file =  "<div class='file-preview-other'> " .
                "<h2><i class='glyphicon glyphicon-file'></i></h2>" .
                "</div>";
        }
        return $file;
    }

    private function createThumbnail($folderName,$fileName,$width=250){
        $uploadPath   = EolmDisbursementform::getUploadPath().'/'.$folderName.'/';
        $file         = $uploadPath.$fileName;
        $image        = Yii::$app->image->load($file);
        $image->resize($width);
        $image->save($uploadPath.'thumbnail/'.$fileName);
        return;
    }

    public function actionDeletefileAjax(){

        $model = Uploads::findOne(Yii::$app->request->post('key'));
        if($model!==NULL){
            $filename  = EolmDisbursementform::getUploadPath().$model->ref.'/'.$model->real_filename;
            $thumbnail = EolmDisbursementform::getUploadPath().$model->ref.'/thumbnail/'.$model->real_filename;
            if($model->delete()){
                @unlink($filename);
                @unlink($thumbnail);
                echo json_encode(['success'=>true]);
            }else{
                echo json_encode(['success'=>false]);
            }
        }else{
            echo json_encode(['success'=>false]);
        }
    }


/*|*********************************************************************************|*/
    public function actionWord($id) /*function ปริ้น word */
    {
        Settings::setTempDir(Yii::getAlias('@webroot').'/web_eolm/files/temp/'); //Path ของ Folder temp ที่สร้างเอาไว้
        $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot').'/web_eolm/files/8708.docx'); //Path ของ template ที่สร้างเอาไว้
        $model = EolmDisbursementform::findOne($id);
        $model_app = EolmApprovalform::findOne($id);
        $model_loan = EolmLoancontract::findOne($id);
        //ผู้ขออนุมัติ
        $modelper1 = EolmApprovalformHasPersonal::find()->where(['eolm_app_id' => $id,'eolm_app_has_person_type_id'=>1])->one();
        $per1 = EofficeMainViewPisPerson::find()->where(['person_id'=>$modelper1["person_id"]])->one();
        $person_id = $per1['academic_positions_abb_thai']." ".$per1['person_name']." ".$per1['person_surname'];
        $position = $per1['academic_positions_abb_thai']; //ตำแหน่ง
        $position_full = $per1['academic_positions']; //ตำแหน่ง
        //ผู้ติดตาม
        $sql2 = 'SELECT * FROM eoffice_eolmv2.eolm_approvalform_has_personal  
                    LEFT JOIN eoffice_central.view_pis_person ON eoffice_eolmv2.eolm_approvalform_has_personal.person_id = eoffice_central.view_pis_person.person_id 
                    WHERE eoffice_eolmv2.eolm_approvalform_has_personal.eolm_app_id='.$model->eolm_app_id.'
                    AND eoffice_eolmv2.eolm_approvalform_has_personal.eolm_app_has_person_type_id=2';
        $person_id2s = EolmApprovalformHasPersonal::findBySql($sql2)->asArray()->all();
        $person_id2= "";
        foreach($person_id2s as $m){
            if ($m === reset($person_id2s)){
                $person_id2=$m['academic_positions_abb_thai']." ".$m['person_name']." ".$m['person_surname'];
            }else{
                $person_id2=$person_id2.','.$m['academic_positions_abb_thai']." ".$m['person_name']." ".$m['person_surname'];
            }
        }
        //จังหวัด
        $sql = 'SELECT * FROM eoffice_eolmv2.eolm_approvalform_has_province  
                    LEFT JOIN eoffice_central.province ON eoffice_eolmv2.eolm_approvalform_has_province.PROVINCE_ID = eoffice_central.province.PROVINCE_ID 
                    WHERE eoffice_eolmv2.eolm_approvalform_has_province.eolm_app_id='.$model->eolm_app_id;
        $provinces = EolmApprovalformHasProvince::findBySql($sql)->asArray()->all();
        $province= "";
        foreach($provinces as $m){
            if ($m === reset($provinces)){
                $province=$m['PROVINCE_NAME'];
            }else{
                $province=$province.','.$m['PROVINCE_NAME'];
            }
        }
        //เดินทางจาก
        $s1=" ";$s2=" ";$s3=" ";$s4=" ";$s5=" ";$s6=" ";
         if ($model['eolm_dis_go_from']=='บ้านพัก'){
                $s1 = ' / ';
            }elseif ($model['eolm_dis_go_from']=='สำนักงาน'){
                $s2 = ' / ';
            }elseif ($model['eolm_dis_go_from']=='ประเทศไทย'){
                $s3 = ' / ';
            }
            //กลับถัง
         if ($model['eolm_dis_back_to']=='บ้านพัก'){
                $s4 = ' / ';
            }elseif ($model['eolm_dis_back_to']=='สำนักงาน'){
                $s5 = ' / ';
            }elseif ($model['eolm_dis_back_to']=='ประเทศไทย'){
                $s6 = ' / ';
            }
        $for1="";$for2="";
        if ($model['eolm_dis_disburse_for']=='ข้าพเจ้า'){
            $for1 = ' / ';
        }else{
            $for2 = ' / ';
        }


        $templateProcessor->setValue(
            [
                'loan_number',
                'date',
                'app_number',
                'money',
                'date2',
                'person_id',
                'position',
                'position_full',
                'person_id2',
                'province',
                's1','s2','s3','s4','s5','s6',
                'dateg',
                'dateb',
                'time1',
                'time2',
                'd',
                'h',
                'for1','for2','at','st','vt','ot',
                'ad','sd','am','sm','vm','om',

                'total',
                'text',
                'doc',


            ],
            [

                $model_loan->eolm_loa_number,
                Yii::$app->thaiFormatter->asDate(date("Y-m-d"), 'long')." ",
                $model_app->eolm_app_number,
                $model_loan->eolm_loa_total_amout,
                Yii::$app->thaiFormatter->asDate($model_app->eolm_app_date, 'long')." ",
                $person_id,
                $position,
                $position_full,
                $person_id2,
                $province,
                $s1,$s2,$s3,$s4,$s5,$s6,
                Yii::$app->thaiFormatter->asDate($model->eolm_dis_go_date, 'long')." ",
                Yii::$app->thaiFormatter->asDate($model->eolm_dis_back_date, 'long')." ",
                $model->eolm_dis_go_time,
                $model->eolm_dis_back_time,
                $model->eolm_dis_date_count,
                $model->eolm_dis_time,
                $for1,$for2,$model->eolm_dis_allowance_type,$model->eolm_dis_hotal_type,$model->eolm_vehicletype,$model->eolm_dis_other_expenses,
                $model->eolm_dis_allowance_day,$model->eolm_dis_hotal_day,$model->eolm_dis_allowance_cost,$model->eolm_dis_hotal_cost,$model->eolm_dis_vehicle_cost,$model->eolm_dis_other_expenses_cost,
                $model_loan->eolm_loa_total_amout,
                $model_loan->eolm_loa_total_text,
                $model->eolm_dis_doc_count,

            ]); // การ setValue หลายๆ ตะวแปรพร้อมกะน

        $templateProcessor->saveAs(Yii::getAlias('@webroot').'/web_eolm/files/8708/8708_'.$model->eolm_app_id.'.docx'); //กำหนด Path ที่จะสร้างไฟล์
        $path =Yii::getAlias('@webroot').'/web_eolm/files/8708/8708_'.$model->eolm_app_id.'.docx'; // สร้าง Link สำหรับ Download ไฟล์ที่แทนที่ข้อมูลแล้ว
        return Yii::$app->response->sendFile($path);
    }

    public function actionGetRate($positionId)
    {
        $position = EolmRateCost::findOne($positionId);
        echo Json::encode($position);
    }

    public function actionRate($id)
    {
        $position = EolmApprovalformHasPersonal::find()->where(['eolm_app_id'=>$id])->count();
        return $position;
    }
/*|*********************************************************************************|*/
    public function actionExcel($id) {
        $model = $this->findModel($id);
        $model_app = EolmApprovalform::findOne($id);
        $model_loan = EolmLoancontract::findOne($id);
        //ผู้ขออนุมัติ
        $modelper1 = EolmApprovalformHasPersonal::find()->where(['eolm_app_id' => $id,'eolm_app_has_person_type_id'=>1])->one();
        $per1 = EofficeMainViewPisPerson::find()->where(['person_id'=>$modelper1["person_id"]])->one();
        $person_id = $per1['academic_positions_abb_thai']." ".$per1['person_name']." ".$per1['person_surname'];
        $position = $per1['academic_positions'];
        //ผู้ติดตาม
        $sql2 = 'SELECT * FROM eoffice_eolmv2.eolm_approvalform_has_personal  
                    LEFT JOIN eoffice_central.view_pis_person ON eoffice_eolmv2.eolm_approvalform_has_personal.person_id = eoffice_central.view_pis_person.person_id 
                    WHERE eoffice_eolmv2.eolm_approvalform_has_personal.eolm_app_id='.$model->eolm_app_id.'
                    AND eoffice_eolmv2.eolm_approvalform_has_personal.eolm_app_has_person_type_id=2';
        $person_id2s = EolmApprovalformHasPersonal::findBySql($sql2)->asArray()->all();
        $person_id2= "-";
        foreach($person_id2s as $m){
            if ($m === reset($person_id2s)){
                $person_id2=$m['academic_positions_abb_thai']." ".$m['person_name']." ".$m['person_surname'];
            }else{
                $person_id2=$person_id2.','.$m['academic_positions_abb_thai']." ".$m['person_name']." ".$m['person_surname'];
            }
        }
        $h='ประกอบใบเบิกค่าใช้จ่ายในการเดินทางของ '.$person_id.' และ '.$person_id2.' ลงวันที่ '. date("d/m/Y");
        $mon='จำนวนเงินรวมทั้งสิ้น (ตัวอักษร) (-'.$model->eolm_dis_total_text.'-)';

        $d8=EolmDisbursementformDetailsItem::find()->from('eolm_disbursementform_details_item')->where(['eolm_app_id'=>$model->eolm_app_id,'person_id'=>$modelper1["person_id"],'eolm_dis_type'=>3])->sum('eolm_dis_detail_amout');
        $e8=EolmDisbursementformDetailsItem::find()->from('eolm_disbursementform_details_item')->where(['eolm_app_id'=>$model->eolm_app_id,'person_id'=>$modelper1["person_id"],'eolm_dis_type'=>4])->sum('eolm_dis_detail_amout');
        $f8=EolmDisbursementformDetailsItem::find()->from('eolm_disbursementform_details_item')->where(['eolm_app_id'=>$model->eolm_app_id,'person_id'=>$modelper1["person_id"],'eolm_dis_type'=>1])->sum('eolm_dis_detail_amout');
        $g8=EolmDisbursementformDetailsItem::find()->from('eolm_disbursementform_details_item')->where(['eolm_app_id'=>$model->eolm_app_id,'person_id'=>$modelper1["person_id"],'eolm_dis_type'=>2])->sum('eolm_dis_detail_amout');
        //create
        $n=Yii::getAlias('@webroot').'/web_eolm/files/8708.xlsx';
        $objReader = new \PHPExcel_Reader_Excel2007();
        $objPHPExcel = $objReader->load($n);
        //set value
        $objPHPExcel->getActiveSheet()->SetCellValue('I23',date("d/m/Y"));
        $objPHPExcel->getActiveSheet()->SetCellValue('B20',$mon);
        $objPHPExcel->getActiveSheet()->SetCellValue('A5',$h);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8',$person_id);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8',$position);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8',$d8);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8',$e8);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8',$f8);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8',$g8);
        $objPHPExcel->getActiveSheet()->SetCellValue('H8',$g8+$f8+$e8+$d8);



        $i = 9; // กำหนดค่า i เป็น 8 เพื่อเริ่มพิมพ์ที่แถวที่ 8
        $x=2;
        // Write data from MySQL result
        foreach($person_id2s as $item){ //วนลูปหาพนักงานทั้งหมด
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $x);
            //กำหนดให้คอลัมม์ A แถวที่ i พิมพ์ค่าของ employeeNumber
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $item['academic_positions_abb_thai']." ".$item['person_name']." ".$item['person_surname']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $item["academic_positions"]);
            $c1=EolmDisbursementformDetailsItem::find()->from('eolm_disbursementform_details_item')->where(['eolm_app_id'=>$model->eolm_app_id,'person_id'=>$item["person_id"],'eolm_dis_type'=>3])->sum('eolm_dis_detail_amout');
            $c2=EolmDisbursementformDetailsItem::find()->from('eolm_disbursementform_details_item')->where(['eolm_app_id'=>$model->eolm_app_id,'person_id'=>$item["person_id"],'eolm_dis_type'=>4])->sum('eolm_dis_detail_amout');
            $c3=EolmDisbursementformDetailsItem::find()->from('eolm_disbursementform_details_item')->where(['eolm_app_id'=>$model->eolm_app_id,'person_id'=>$item["person_id"],'eolm_dis_type'=>1])->sum('eolm_dis_detail_amout');
            $c4=EolmDisbursementformDetailsItem::find()->from('eolm_disbursementform_details_item')->where(['eolm_app_id'=>$model->eolm_app_id,'person_id'=>$item["person_id"],'eolm_dis_type'=>2])->sum('eolm_dis_detail_amout');
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $c1);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $c2);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $c3);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $c4);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $c1+$c2+$c3+$c4);
            $i++;
            $x++;
        }


        //save file
        $name = Yii::getAlias('@webroot').'/web_eolm/files/disbursement/แบบ8708ส่วนที่2_'.$model->eolm_app_id.'.xlsx';

        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($name);

        //download file
        $path =Yii::getAlias('@web').'/web_eolm/files/disbursement/แบบ8708ส่วนที่2_'.$model->eolm_app_id.'.xlsx'; // สร้าง Link สำหรับ Download ไฟล์ที่แทนที่ข้อมูลแล้ว
        return Yii::$app->response->redirect($path);
    }

    public function actionExcel2($id,$person_id) {

        $per1 = EofficeMainViewPisPerson::find()->where(['person_id'=>$person_id])->one();
        $person = $per1['academic_positions_abb_thai']." ".$per1['person_name']." ".$per1['person_surname'];
        $position = $per1['academic_positions'];

        $h='ข้าพเจ้า '.$person.' ตำแหน่ง '.$position;
        //$mon='รวมทั้งสิ้น (ตัวอักษร) (-'.$model->eolm_dis_total_text.'-)';
        $sql2 = 'SELECT * FROM eoffice_eolmv2.eolm_disbursementform_details_item where eolm_app_id = '.$id.' and eolm_dis_detail_bill = 2 and person_id = '.$person_id.' and eolm_dis_type=1 or eolm_dis_type=2';
        $models = EolmDisbursementformDetailsItem::findBySql($sql2)->asArray()->all();
        //$models = EolmDisbursementformDetailsItem::find()->from('eolm_disbursementform_details_item')->where(['eolm_app_id'=>$id,'person_id'=>$person_id,'eolm_dis_detail_bill' => 2,'eolm_dis_type'=>1])->orWhere(['eolm_dis_type'=>2])->all();
        /*$d8=EolmDisbursementformDetailsItem::find()->from('eolm_disbursementform_details_item')->where(['eolm_app_id'=>$model->eolm_app_id,'person_id'=>$person_id]);
        $e8=EolmDisbursementformDetailsItem::find()->from('eolm_disbursementform_details_item')->where(['eolm_app_id'=>$model->eolm_app_id,'person_id'=>$modelper1["person_id"],'eolm_dis_type'=>4])->sum('eolm_dis_detail_amout');
        $f8=EolmDisbursementformDetailsItem::find()->from('eolm_disbursementform_details_item')->where(['eolm_app_id'=>$model->eolm_app_id,'person_id'=>$modelper1["person_id"],'eolm_dis_type'=>1])->sum('eolm_dis_detail_amout');
        $g8=EolmDisbursementformDetailsItem::find()->from('eolm_disbursementform_details_item')->where(['eolm_app_id'=>$model->eolm_app_id,'person_id'=>$modelper1["person_id"],'eolm_dis_type'=>2])->sum('eolm_dis_detail_amout');
       */ //create
        $n=Yii::getAlias('@webroot').'/web_eolm/files/111.xlsx';
        $objReader = new \PHPExcel_Reader_Excel2007();
        $objPHPExcel = $objReader->load($n);
        //set value
        $objPHPExcel->getActiveSheet()->SetCellValue('A14',$h);
        $objPHPExcel->getActiveSheet()->SetCellValue('C19','วันที่ '.date("d/m/Y"));
        //$objPHPExcel->getActiveSheet()->SetCellValue('H8',$g8+$f8+$e8+$d8);



        $i = 6; // กำหนดค่า i เป็น 8 เพื่อเริ่มพิมพ์ที่แถวที่ 8
        $x=0;
        // Write data from MySQL result
        foreach($models as $item){ //วนลูปหาพนักงานทั้งหมด
            $Weddingdate = new \DateTime($item['eolm_dis_detail_date']);
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $Weddingdate->format('d-m-Y'));
            //กำหนดให้คอลัมม์ A แถวที่ i พิมพ์ค่าของ employeeNumber
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $item['eolm_dis_detail_detail']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $item['eolm_dis_detail_amout']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $item['eolm_dis_detail_amout']);
           /*
            */
           $x=$x+$item['eolm_dis_detail_amout'];
            $i++;
        }
        $objPHPExcel->getActiveSheet()->setCellValue('c12', $x);

        /*$bath = $this->convert($x);
        $mon='รวมทั้งสิ้น (ตัวอักษร) (-'.$bath.'-)';
        $objPHPExcel->getActiveSheet()->setCellValue('A13', $mon);*/

        //\Yii::$app->getView()->registerJsFile(\Yii::getAlias('@web') . '/web_eolm/js/thaibath.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


        //save file
        $name = Yii::getAlias('@webroot').'/web_eolm/files/disbursement/บก111_'.$person.'.xlsx';
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($name);
        //download file
        $path =Yii::getAlias('@web').'/web_eolm/files/disbursement/บก111_'.$person.'.xlsx'; // สร้าง Link สำหรับ Download ไฟล์ที่แทนที่ข้อมูลแล้ว
       return Yii::$app->response->redirect($path);
    }

    public function actionDownload($ref,$name) {
        $file = Yii::getAlias('@webroot') . '/web_eolm/bill/'.$ref.'/'.$name;
        //return Yii::$app->response->redirect($file);
        Yii::$app->response->sendFile($file);

    }
}
