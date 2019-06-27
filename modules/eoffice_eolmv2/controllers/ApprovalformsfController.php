<?php

namespace app\modules\eoffice_eolmv2\controllers;

use app\modules\eoffice_eolmv2\models\EolmApprovalform_reportSearch;
use app\modules\eoffice_eolmv2\models\EolmApprovalformHasStudent;
use app\modules\eoffice_eolmv2\models\EolmApprovalformHasVehicle;
use app\modules\eoffice_eolmv2\models\EolmApprovalformsfSearch_loan;
use app\modules\eoffice_eolmv2\models\EolmBorrowingplansItem;
use app\modules\eoffice_eolmv2\models\EolmLoancontract;
use app\modules\eoffice_eolmv2\models\EolmSigner;
use app\modules\eoffice_eolmv2\models\model_main\EofficeCentralViewPisBoardOfDirectors;
use app\modules\eoffice_eolmv2\models\model_main\EofficeMainPerson;
use app\modules\eoffice_eolmv2\models\model_main\EofficeMainViewPisPerson;
use Yii;
use app\modules\eoffice_eolmv2\components\ModelHelper;
use app\modules\eoffice_eolmv2\models\EolmApprovalform;
use app\modules\eoffice_eolmv2\models\EolmApprovalformsfSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\eoffice_eolmv2\models\EolmBudgettype;
use app\modules\eoffice_eolmv2\models\EolmBudgetplan;
use app\modules\eoffice_eolmv2\models\EolmExpenditurecategoty;
use app\modules\eoffice_eolmv2\models\EolmStatus;
use app\modules\eoffice_eolmv2\models\ProjectSub;
use app\modules\eoffice_eolmv2\models\EolmType;
use app\modules\eoffice_eolmv2\models\EolmApprovalformHasProvince;
use app\modules\eoffice_eolmv2\models\EolmApprovalformHasPersonal;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/**
 * EolmApprovalformsfController implements the CRUD actions for EolmApprovalform model.
 */
class ApprovalformsfController extends Controller
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
     * Lists all EolmApprovalform models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmApprovalformsfSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDocument()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmApprovalform_reportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('document', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionReport()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmApprovalform_reportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EolmApprovalform model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EolmApprovalform model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = "main_modules";

        $model =  ModelHelper::create(new EolmApprovalform());


        if ($model->load(Yii::$app->request->post())) {
            $model->eolm_status_id=1;
            $model->save();
              $post = Yii::$app->request->post();
              $postModel = $post['EolmApprovalform'];
                    $postModel0=  $postModel['person_ids1'];
                    if ( !empty( $postModel0) ){
                            $newModel0  = new EolmApprovalformHasPersonal();
                            $newModel0->eolm_app_id = $model->eolm_app_id;
                            $newModel0->person_id = $model->person_ids1;
                            $newModel0->eolm_app_has_person_type_id = '1';
                            $newModel0->save();
                    }
                  $postModelMulti=  $postModel['person_ids'];
                  if ( !empty( $postModelMulti) ){
                      foreach ($postModelMulti as $key => $value) {

                          $newModel  = new EolmApprovalformHasPersonal();
                          $newModel->eolm_app_id = $model->eolm_app_id;
                          $newModel->person_id = $value;
                          $newModel->eolm_app_has_person_type_id = '2';
                          $newModel->save();
                      }
                  }
                  /*$postModelMulti2=  $postModel['person_ids2'];
                  if ( !empty( $postModelMulti2) ){
                      foreach ($postModelMulti2 as $key => $value) {

                          $newModel2  = new EolmApprovalformHasPersonal();
                          $newModel2->eolm_app_id = $model->eolm_app_id;
                          $newModel2->person_id = $value;
                          $newModel2->eolm_app_has_person_type_id = '3';
                          $newModel2->save();
                      }
                  }*/
            if ($model->eolm_budt_id == 3){
                Yii::$app->session->setFlash( 'success', "บันทึกสำเร็จ" );
                return $this->redirect('index');

            }else{
                Yii::$app->session->setFlash( 'success', "บันทึกสำเร็จ" );
                return $this->redirect(['loancontractin/create', 'id' => $model->eolm_app_id]);
            }
        } elseif (!\Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->get());/*
            $model->eolm_prov_ids = ArrayHelper::map($model->eolmProvs, 'eolm_prov_name', 'eolm_prov_name');*/

        }
       // $model->eolm_app_date = date('Y-m-d');
        return $this->render('create', [
            'model' => $model,
            
        ]);
    }

    /**
     * Updates an existing EolmApprovalform model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     
    public function actionTest(){
        return echo "string";
    }*/
     public function actionUpdate($id)
    
    {
        $this->layout = "main_modules";
        $model = $this->findModel($id);
        $model = ModelHelper::update($model);

        if ($model->load(Yii::$app->request->post())) {
            EolmApprovalformHasProvince::deleteAll(['eolm_app_id' => $id]);
            EolmApprovalformHasVehicle::deleteAll(['eolm_app_id' => $id]);
            EolmApprovalformHasStudent::deleteAll(['eolm_app_id' => $id]);
            $model->save();
            EolmApprovalformHasPersonal::deleteAll(['eolm_app_id' => $id]);
                $post = Yii::$app->request->post();
              $postModel = $post['EolmApprovalform'];
                    $postModel0=  $postModel['person_ids1'];
                    if ( !empty( $postModel0) ){
                        $newModel0  = new EolmApprovalformHasPersonal();
                        $newModel0->eolm_app_id = $model->eolm_app_id;
                        $newModel0->person_id = $model->person_ids1;
                        $newModel0->eolm_app_has_person_type_id = '1';
                        $newModel0->save();
                    }
                  $postModelMulti=  $postModel['person_ids'];
                  if ( !empty( $postModelMulti) ){
                      foreach ($postModelMulti as $key => $value) {
                          $newModel  = new EolmApprovalformHasPersonal();
                          $newModel->eolm_app_id = $model->eolm_app_id;
                          $newModel->person_id = $value;
                          $newModel->eolm_app_has_person_type_id = '2';
                          $newModel->save();
                      }
                  }  
                  /*$postModelMulti2=  $postModel['person_ids2'];
                  if ( !empty( $postModelMulti2) ){
                      foreach ($postModelMulti2 as $key => $value) {

                          $newModel2  = new EolmApprovalformHasPersonal();
                          $newModel2->eolm_app_id = $model->eolm_app_id;
                          $newModel2->person_id = $value;
                          $newModel2->eolm_app_has_person_type_id = '3';
                          $newModel2->save();
                      }
                  }*/
                if ($model->eolm_status_id == 1){
                    Yii::$app->db_eolm->createCommand()
                        ->update('eolm_approvalform', ['eolm_status_id' => 0], 'eolm_app_id ='.$id)
                        ->execute();

                }
                Yii::$app->session->setFlash( 'success', "แก้ไขสำเร็จ" );
                $mo = EolmLoancontract::find()->where('eolm_app_id='.$model->eolm_app_id)->one();
                if(empty($mo)){
                    return $this->redirect(['loancontractin/create', 'id' => $model->eolm_app_id]);
                }else{
                    return $this->redirect(['loancontractin/update', 'id' => $model->eolm_app_id]);
                }
           // }
        } elseif (!\Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->get());
            //เรียกข้อมูล provinces ที่จัดเก็บไว้
            $model->provinces = ArrayHelper::map(EolmApprovalformHasProvince::find()
                ->where(['eolm_app_id' => $id])->all(), 'PROVINCE_ID', 'PROVINCE_ID');
            $model->person_ids1 = ArrayHelper::map(EolmApprovalformHasPersonal::find()
                ->where(['eolm_app_id' => $id, 'eolm_app_has_person_type_id' => 1])->all(), 'person_id', 'person_id');
            //เรียกข้อมูล ผู้ติดตาม ที่จัดเก็บไว้
            $model->person_ids = ArrayHelper::map(EolmApprovalformHasPersonal::find()
                ->where(['eolm_app_id' => $id, 'eolm_app_has_person_type_id' => 2])->all(), 'person_id', 'person_id');
            //เรียกข้อมูล นักศึกษา ที่จัดเก็บไว้
            $model->person_ids2 = ArrayHelper::map(EolmApprovalformHasStudent::find()
                ->where(['eolm_app_id' => $id])->all(), 'STUDENTID', 'STUDENTID');



            $de1 = EolmApprovalformHasVehicle::find()->where(['eolm_app_id' => $id, 'eolm_vehicle_type_id' => 1])->one();
            if ($de1!=null) {
                $model->vehicle1 = $de1->eolm_vehicle_type_id;
                $model->vdate1 = $de1->eolm_vehicle_amount_date;
                $model->vamount1 = $de1->eolm_vehicle_amount;
            }
            $de2 = EolmApprovalformHasVehicle::find()->where(['eolm_app_id' => $id, 'eolm_vehicle_type_id' => 2])->one();
            if ($de2!=null) {
                $model->vehicle2 = $de2->eolm_vehicle_type_id;
                $model->vdate2 = $de2->eolm_vehicle_amount_date;
                $model->vamount2 = $de2->eolm_vehicle_amount;
            }
            $de3 = EolmApprovalformHasVehicle::find()->where(['eolm_app_id' => $id, 'eolm_vehicle_type_id' => 3])->one();
            if ($de3!=null) {
                $model->vehicle3 = $de3->eolm_vehicle_type_id;
                $model->vehicle_detail3 = $de3->eolm_vehicle_detail;
                $model->vdate3 = $de3->eolm_vehicle_amount_date;
                $model->vamount3 = $de3->eolm_vehicle_amount;
            }
            $de4=EolmApprovalformHasVehicle::find()->where(['eolm_app_id' => $id,'eolm_vehicle_type_id'=>4])->one();
            if ($de4!=null) {
                $model->vehicle4 = $de4->eolm_vehicle_type_id;
                $model->vehicle_detail4 = $de4->eolm_vehicle_detail;
                $model->vdate4 = $de4->eolm_vehicle_amount_date;
                $model->vamount4 = $de4->eolm_vehicle_amount;
            }
            $de5=EolmApprovalformHasVehicle::find()->where(['eolm_app_id' => $id,'eolm_vehicle_type_id'=>5])->one();
            if ($de5!=null) {
                $model->vehicle5 = $de5->eolm_vehicle_type_id;
                $model->vehicle_detail5 = $de5->eolm_vehicle_detail;
                $model->vdate5 = $de5->eolm_vehicle_amount_date;
                $model->vamount5 = $de5->eolm_vehicle_amount;
            }
            $de6=EolmApprovalformHasVehicle::find()->where(['eolm_app_id' => $id,'eolm_vehicle_type_id'=>6])->one();
            if ($de6!=null) {
                $model->vehicle6 = $de6->eolm_vehicle_type_id;
                $model->vehicle_detail6 = $de6->eolm_vehicle_detail;
                $model->vdate6 = $de6->eolm_vehicle_amount_date;
                $model->vamount6 = $de6->eolm_vehicle_amount;
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
   
    /**
     * Deletes an existing EolmApprovalform model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->layout = "main_modules";
        $model=$this->findModel($id);
        if ($model->delete()) {
            Yii::$app->session->setFlash( 'success', "ลบข้อมูลสำเร็จ" );
            return $this->redirect(['index']);
        }
    }

    public function actionChecked($id)
    {
        Yii::$app->db_eolm->createCommand()
            ->update('eolm_approvalform', ['eolm_status_id' => 2], 'eolm_app_id ='.$id)
            ->execute();
        Yii::$app->session->setFlash( 'success', "ส่งต่อไปยังผู้อนุมัติเรียบร้อย" );
        return $this->redirect(['index']);
    }



    /**
     * Finds the EolmApprovalform model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EolmApprovalform the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EolmApprovalform::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('ไม่พบ EolmApprovalform');
        }
    }


    public function actionWord($id) /*function ปริ้น word */
    {
        Settings::setTempDir(Yii::getAlias('@webroot').'/web_eolm/files/temp/'); //Path ของ Folder temp ที่สร้างเอาไว้
        $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot').'/web_eolm/files/appvform.docx'); //Path ของ template ที่สร้างเอาไว้
        $model = EolmApprovalform::findOne($id);
        $model1 = EolmStatus::findOne($model["eolm_status_id"]);
        $model3 = EolmBudgetplan::findOne($model["eolm_budp_id"]);
        $model4 = EolmBudgettype::findOne($model["eolm_budt_id"]);
        $eolm_budp_id_1 = '';
        $eolm_budp_id_2 = '';
        if ($model4-> eolm_budt_id==1){
            $eolm_budp_id_1 = '/';
        }elseif ($model4->eolm_budt_id==2){
            $eolm_budp_id_2 = '/';
        }
        $model5 = EolmExpenditurecategoty::findOne($model["eolm_exp_id"]);
        $model7 = ProjectSub::findOne($model["pro_id"]);
        $model8 = EolmType::findOne($model["eolm_type_id"]);

        $model_loan = EolmLoancontract::find()->where(['eolm_app_id' => $id])->one();
        $modelper1 = EolmApprovalformHasPersonal::find()->where(['eolm_app_id' => $id,'eolm_app_has_person_type_id'=>1])->one();
        $per1 = EofficeMainViewPisPerson::find()->where(['person_id'=>$modelper1["person_id"]])->one();
        $modelper1 = $per1['academic_positions_abb_thai']." ".$per1['person_name']." ".$per1['person_surname'];
        $v1='';
        $v2='';
        $v3='';
        $v4='';
        $v5='';
        $v6='';
        $v4_detail='-';
        $v5_detail='-';
        $v6_detail='-';
        $vehi = EolmBorrowingplansItem::find()->asArray()->where(['eolm_app_id' => $id])->all();
        $model_approv1 = EolmSigner::find()->where(['eolm_signer_type_id'=>1])->one();
        $approvper1 = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id'=>$model_approv1["person_id"]])->one();
        $approv1 = $approvper1['academic_positions']." ".$approvper1['person_name']." ".$approvper1['person_surname'];
        $approv1_pos = $approvper1['position_name'];

        foreach ($vehi as $v){
            if ($v['eolm_bor_type_id']==1){
                $v1 = '/';
            }elseif ($v['eolm_bor_type_id']==2){
                $v2 = '/';
            }elseif ($v['eolm_bor_type_id']==3){
                $v3 = '/';
            }elseif ($v['eolm_bor_type_id']==4){
                $v4 = '/';
                $v4_detail = $v['eolm_bor_detail'];
            }elseif ($v['eolm_bor_type_id']==5){
                $v5 = '/';
                $v5_detail = $v['eolm_bor_detail'];
            }elseif ($v['eolm_bor_type_id']==6){
                $v6 = '/';
                $v6_detail = $v['eolm_bor_detail'];
            }
        }



        //Yii::$app->thaiFormatter->locale = 'th_TH';
        $eolm_app_date=Yii::$app->thaiFormatter->asDate($model->eolm_app_date, 'long')." ";
        $eolm_app_deprture_date=Yii::$app->thaiFormatter->asDate($model->eolm_app_deprture_date, 'long')." ";
        $eolm_app_return_date=Yii::$app->thaiFormatter->asDate($model->eolm_app_return_date, 'long')." ";

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

        $sql3 = 'SELECT * FROM eoffice_eolmv2.eolm_signer  
                    LEFT JOIN eoffice_central.view_pis_person ON eoffice_eolmv2.eolm_signer.person_id = eoffice_central.view_pis_person.person_id 
                    WHERE eoffice_eolmv2.eolm_signer.eolm_signer_type_id =2';
        $approv2s = EolmSigner::findBySql($sql3)->asArray()->all();
        $approv2= "";
        foreach($approv2s as $m){
            if ($m === reset($approv2s)){
                $approv2=$m['PREFIXABB']." ".$m['person_name']." ".$m['person_surname'];
            }else{
                $approv2=$approv2.','.$m['PREFIXABB']." ".$m['person_name']." ".$m['person_surname'];
            }
        }



        $templateProcessor->setValue(
            [   
                'eolm_app_id',//1
                'eolm_app_date',//2
                'eolm_app_subject',//3
                'eolm_app_number',//4
                'eolm_app_deprture_date' ,//5
                'eolm_app_return_date' ,//6
                //'eolm_app_borrow_money',//7
                'eolm_budget_year',//8
               // 'eolm_type_id',//9
               // 'eolm_link',//10
               // 'eolm_status_id',//11
                'pro_id' ,//12
                'eolm_loa_total_amout',//13
                'eolm_budp_id',//14
                'eolm_exp_id',//15
                'person_id',//16
                'eolm_budp_id_1',//17
                'eolm_budp_id_2',//18
                'v1','v2','v3','v4','v5','v6',
                'v4_detail','v5_detail','v6_detail',
                'province','person_id2',
                'approv1',
                'approv1_pos',
                'approv2',

            ],
            [   /*กำหนดค่าที่จะแสดงในเอกสาร*/
                $model->eolm_app_id,//1
                $eolm_app_date,//2
                $model->eolm_app_subject,//3
                $model->eolm_app_number,//4
                $eolm_app_deprture_date,//5
                $eolm_app_return_date,//6
                //$model->eolm_app_borrow_money,//7
                $model->eolm_budget_year,//8
                ///$model8->eolm_type_name,//9
              //  $model->eolm_link,//10
               // $model1->eolm_status_name,//11
                $model7->ProSub_name,//12
                $model_loan->eolm_loa_total_amout,//13
                $model3->eolm_budp_name,//14
                $model5->eolm_exp_name,//15
                $modelper1,//16
                $eolm_budp_id_1,//17
                $eolm_budp_id_2,//18
                $v1,$v2,$v3,$v4,$v5,$v6,
                $v4_detail,$v5_detail,$v6_detail,
                $province,$person_id2,
                $approv1,
                $approv1_pos,
                $approv2,

            ]); // การ setValue หลายๆ ตะวแปรพร้อมกะน

        $templateProcessor->saveAs(Yii::getAlias('@webroot').'/web_eolm/files/appform/แบบขออนุมัติหลักการ_'.$model->eolm_app_id.'.docx'); //กำหนด Path ที่จะสร้างไฟล์
        $path =Yii::getAlias('@webroot').'/web_eolm/files/appform/แบบขออนุมัติหลักการ_'.$model->eolm_app_id.'.docx'; // สร้าง Link สำหรับ Download ไฟล์ที่แทนที่ข้อมูลแล้ว
        return Yii::$app->response->sendFile($path);
    }

    public function actionWord2($id) /*function ปริ้น word */
    {
        Settings::setTempDir(Yii::getAlias('@webroot').'/web_eolm/files/temp/'); //Path ของ Folder temp ที่สร้างเอาไว้
        $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot').'/web_eolm/files/appvformAJ.docx'); //Path ของ template ที่สร้างเอาไว้
        $model = EolmApprovalform::findOne($id);
        $model1 = EolmStatus::findOne($model["eolm_status_id"]);
        $model3 = EolmBudgetplan::findOne($model["eolm_budp_id"]);
        $model4 = EolmBudgettype::findOne($model["eolm_budt_id"]);

        $eolm_budp_id_1 = '';
        $eolm_budp_id_2 = '';
        if ($model4-> eolm_budt_id==1){
            $eolm_budp_id_1 = '/';
        }elseif ($model4->eolm_budt_id==2){
            $eolm_budp_id_2 = '/';
        }
        $type = EolmType::findOne($model["eolm_type_id"]);
        $t1='';
        $t2='';
        $t3='';
        $t4='';
        if ($type-> eolm_type_id==1){
            $t1 = '/';
        }elseif ($type->eolm_type_id==2){
            $t2 = '/';
        }elseif ($type->eolm_type_id==3){
            $t3 = '/';
        }elseif ($type->eolm_type_id==4){
            $t4 = '/';
        }
        $model5 = EolmExpenditurecategoty::findOne($model["eolm_exp_id"]);
        $model7 = ProjectSub::findOne($model["pro_id"]);
        $model8 = EolmType::findOne($model["eolm_type_id"]);

        $model_loan = EolmLoancontract::find()->where(['eolm_app_id' => $id])->one();
        $modelper1 = EolmApprovalformHasPersonal::find()->where(['eolm_app_id' => $id,'eolm_app_has_person_type_id'=>1])->one();
        $per1 = EofficeMainViewPisPerson::find()->where(['person_id'=>$modelper1["person_id"]])->one();
        $modelper1 = $per1['academic_positions_abb_thai']." ".$per1['person_name']." ".$per1['person_surname'];
        $position = $per1['academic_positions'];


        $v1='';$v2='';$v3='';$v4='';$v5='';$v6='';
        $v4_detail='.....................';$v5_detail='.....................';$v6_detail='.....................';
        $vd1='';$vd2='';$vd3='';$vd4='';$vd5='';$vd6='';$vd7='';$vd8='';$vd9='';
        $vm1='';$vm2='';$vm3='';$vm4='';$vm5='';$vm6='';$vm7='';$vm8='';$vm9='';
        $vehi = EolmBorrowingplansItem::find()->asArray()->where(['eolm_app_id' => $id])->all();

        foreach ($vehi as $v){
            if ($v['eolm_bor_type_id']==1){
                $v1 = '/';
                $vd1 = $v['eolm_bor_amount_date'];
                $vm1 = $v['eolm_bor_amount'];
            }elseif ($v['eolm_bor_type_id']==2){
                $v2 = '/';
                $vd2 = $v['eolm_bor_amount_date'];
                $vm2 = $v['eolm_bor_amount'];
            }elseif ($v['eolm_bor_type_id']==3){
                $v3 = '/';
                $vd3 = $v['eolm_bor_amount_date'];
                $vm3 = $v['eolm_bor_amount'];
            }elseif ($v['eolm_bor_type_id']==4){
                $v4 = '/';
                $v4_detail = $v['eolm_bor_detail'];
                $vd4 = $v['eolm_bor_amount_date'];
                $vm4 = $v['eolm_bor_amount'];
            }elseif ($v['eolm_bor_type_id']==5){
                $v5 = '/';
                $v5_detail = $v['eolm_bor_detail'];
                $vd5 = $v['eolm_bor_amount_date'];
                $vm5 = $v['eolm_bor_amount'];
            }elseif ($v['eolm_bor_type_id']==6){
                $v6 = '/';
                $v6_detail = $v['eolm_bor_detail'];
                $vd6 = $v['eolm_bor_amount_date'];
                $vm6 = $v['eolm_bor_amount'];
            }elseif ($v['eolm_bor_type_id']==7){
                $vd7 = $v['eolm_bor_amount_date'];
                $vm7 = $v['eolm_bor_amount'];
            }elseif ($v['eolm_bor_type_id']==8){
                $vd8 = $v['eolm_bor_amount_date'];
                $vm8 = $v['eolm_bor_amount'];
            }elseif ($v['eolm_bor_type_id']==9){
                $vd9 = $v['eolm_bor_amount_date'];
                $vm9 = $v['eolm_bor_amount'];
            }
        }

        $model_approv1 = EolmSigner::find()->where(['eolm_signer_type_id'=>1])->one();
        $approvper1 = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id'=>$model_approv1["person_id"]])->one();
        $approv1 = $approvper1['academic_positions']." ".$approvper1['person_name']." ".$approvper1['person_surname'];
        $approv1_pos = $approvper1['position_name'];


        //Yii::$app->thaiFormatter->locale = 'th_TH';
        $eolm_app_date=Yii::$app->thaiFormatter->asDate($model->eolm_app_date, 'long')." ";
        $eolm_app_deprture_date=Yii::$app->thaiFormatter->asDate($model->eolm_app_deprture_date, 'long')." ";
        $eolm_app_return_date=Yii::$app->thaiFormatter->asDate($model->eolm_app_return_date, 'long')." ";
        $eolm_app_even_date=Yii::$app->thaiFormatter->asDate($model->eolm_app_event_date, 'long')." ";

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


        $sql3 = 'SELECT * FROM eoffice_eolmv2.eolm_signer  
                    LEFT JOIN eoffice_central.view_pis_person ON eoffice_eolmv2.eolm_signer.person_id = eoffice_central.view_pis_person.person_id 
                    WHERE eoffice_eolmv2.eolm_signer.eolm_signer_type_id =2';
        $approv2s = EolmSigner::findBySql($sql3)->asArray()->all();
        $approv2= "";
        foreach($approv2s as $m){
            if ($m === reset($approv2s)){
                $approv2=$m['PREFIXABB']." ".$m['person_name']." ".$m['person_surname'];
            }else{
                $approv2=$approv2.','.$m['PREFIXABB']." ".$m['person_name']." ".$m['person_surname'];
            }
        }



        $templateProcessor->setValue(
            [
                'eolm_app_id',//1
                'eolm_app_date',//2
                'eolm_app_subject',//3
                'eolm_app_number',//4
                'eolm_app_deprture_date' ,//5
                'eolm_app_return_date' ,//6
                'eolm_app_even_date' ,//6
                //'eolm_app_borrow_money',//7
                'eolm_budget_year',//8
                // 'eolm_type_id',//9
                // 'eolm_link',//10
                // 'eolm_status_id',//11
                'pro_id' ,//12
                'eolm_loa_total_amout',//13
                'eolm_budp_id',//14
                'eolm_exp_id',//15
                'person_id',//16
                'eolm_budp_id_1',//17
                'eolm_budp_id_2',//18
                'v1','v2','v3','v4','v5','v6',
                'vd1','vd2','vd3','vd4','vd5','vd6','vd7','vd8','vd9',
                'vm1','vm2','vm3','vm4','vm5','vm6','vm7','vm8','vm9',
                't1','t2','t3','t4',
                'v4_detail','v5_detail','v6_detail',
                'province',
                'approv1',
                'approv1_pos',
                'approv2',
                'position',

            ],
            [   /*กำหนดค่าที่จะแสดงในเอกสาร*/
                $model->eolm_app_id,//1
                $eolm_app_date,//2
                $model->eolm_app_subject,//3
                $model->eolm_app_number,//4
                $eolm_app_deprture_date,//5
                $eolm_app_return_date,//6
                $eolm_app_even_date,//6
                //$model->eolm_app_borrow_money,//7
                $model->eolm_budget_year,//8
                ///$model8->eolm_type_name,//9
                //  $model->eolm_link,//10
                // $model1->eolm_status_name,//11
                $model7->ProSub_name,//12
                $model_loan->eolm_loa_total_amout,//13
                $model3->eolm_budp_name,//14
                $model5->eolm_exp_name,//15
                $modelper1,//16
                $eolm_budp_id_1,//17
                $eolm_budp_id_2,//18
                $v1,$v2,$v3,$v4,$v5,$v6,
                $vd1,$vd2,$vd3,$vd4,$vd5,$vd6,$vd7,$vd8,$vd9,
                $vm1,$vm2,$vm3,$vm4,$vm5,$vm6,$vm7,$vm8,$vm9,
                $t1,$t2,$t3,$t4,
                $v4_detail,$v5_detail,$v6_detail,
                $province,
                $approv1,
                $approv1_pos,
                $approv2,
                $position,

            ]); // การ setValue หลายๆ ตะวแปรพร้อมกะน

        $templateProcessor->saveAs(Yii::getAlias('@webroot').'/web_eolm/files/appform/แบบฟอร์มขอไปราชการ_'.$model->eolm_app_id.'.docx'); //กำหนด Path ที่จะสร้างไฟล์
        $path =Yii::getAlias('@webroot').'/web_eolm/files/appform/แบบฟอร์มขอไปราชการ_'.$model->eolm_app_id.'.docx'; // สร้าง Link สำหรับ Download ไฟล์ที่แทนที่ข้อมูลแล้ว
        return Yii::$app->response->sendFile($path);
    }

    public function actionGridview(){
        $searchModel=new EolmApprovalformsfSearch();
        $dataProvider=$searchModel->search(Yii::$app->request->queryParams);
        return $this->render('gridview',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider
        ]);
    }
    public function actionApprovalsearch()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmApprovalformsfSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/loancontractin/approvalsearch', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
