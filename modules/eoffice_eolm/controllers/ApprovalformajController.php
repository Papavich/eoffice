<?php

namespace app\modules\eoffice_eolm\controllers;

use app\modules\eoffice_eolm\models\EolmApprovalform_approvSearch;
use app\modules\eoffice_eolm\models\EolmApprovalformajSearch_loan;
use app\modules\eoffice_eolm\models\EolmApprovalformHasStudent;
use app\modules\eoffice_eolm\models\EolmApprovalformHasVehicle;
use app\modules\eoffice_eolm\models\EolmApprovalformsfSearch;
use app\modules\eoffice_eolm\models\EolmLoancontract;
use Yii;
use app\modules\eoffice_eolm\components\ModelHelper;
use app\modules\eoffice_eolm\models\EolmApprovalform;
use app\modules\eoffice_eolm\models\EolmApprovalformajSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\eoffice_eolm\models\EolmBudgettype;
use app\modules\eoffice_eolm\models\EolmBudgetplan;
use app\modules\eoffice_eolm\models\EolmExpenditurecategoty;
use app\modules\eoffice_eolm\models\EolmStatus;
use app\modules\eoffice_eolm\models\ProjectSub;
use app\modules\eoffice_eolm\models\EolmType;
use app\modules\eoffice_eolm\models\EolmApprovalformHasProvince;
use app\modules\eoffice_eolm\models\EolmApprovalformHasPersonal;
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
class ApprovalformajController extends Controller
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
        $searchModel = new EolmApprovalformajSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndex2()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmApprovalform_approvSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index2', [
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


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

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
            /*if ($model->eolm_budt_id == 3){
                Yii::$app->session->setFlash( 'success', "แก้ไขสำเร็จ" );
                return $this->redirect('index');

            }else{*/
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
            //เรียกข้อมูล ผู้ขออนุมัติ ที่จัดเก็บไว้
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
    public function actionChecked_ok($id)
    {
        Yii::$app->db_eolm->createCommand()
            ->update('eolm_approvalform', ['eolm_status_id' => 3], 'eolm_app_id ='.$id)
            ->execute();
        Yii::$app->session->setFlash( 'success', "อนุมัติเรียบร้อย" );
        return $this->redirect(['index2']);
    }
    public function actionChecked_no($id)
    {
        Yii::$app->db_eolm->createCommand()
            ->update('eolm_approvalform', ['eolm_status_id' => 4], 'eolm_app_id ='.$id)
            ->execute();
        Yii::$app->session->setFlash( 'success', "ไม่อนุมัติ" );
        return $this->redirect(['index2']);
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
        $model5 = EolmExpenditurecategoty::findOne($model["eolm_exp_id"]);
        $model7 = ProjectSub::findOne($model["pro_id"]);
        $model8 = EolmType::findOne($model["eolm_type_id"]);
        $templateProcessor->setValue(
            [
                'eolm_app_id',
                'eolm_app_date',
                'eolm_app_subject',
                'eolm_app_number',
                'eolm_app_deprture_date' ,
                'eolm_app_retuen_date' ,
                'eolm_app_borrow_money',
                'eolm_budget_year',
                'eolm_type_id',
                'eolm_link',
                'eolm_status_id',
                'eolm_prot_id' ,
                'eolm_budp_id',
                'eolm_budt_id',
                'eolm_exp_id',

                'pro_id',/*
                'crby',
                'crtime',
                'udby',
                'udtime',*/
            ],
            [   /*กำหนดค่าที่จะแสดงในเอกสาร*/
                $model->eolm_app_id,
                $model->eolm_app_date,
                $model->eolm_app_subject,
                $model->eolm_app_number,
                $model->eolm_app_deprture_date,
                $model->eolm_app_retuen_date,
                $model->eolm_app_borrow_money,
                $model->eolm_budget_year,
                $model8->eolm_type_name,
                $model->eolm_link,
                $model1->eolm_status_name,
                $model3->eolm_budp_name,
                $model4->eolm_budt_name,
                $model5->eolm_exp_name,
                $model7->ProSub_name,
                $model->crby,
                $model->crtime,
                $model->udby,
                $model->udtime
            ]); // การ setValue หลายๆ ตะวแปรพร้อมกะน

        //$templateProcessor->setValue('emp_employeeNumber', '1002'); การ setValue ทีล่ะตัว
        $templateProcessor->saveAs(Yii::getAlias('@webroot').'/web_eolm/files/appform/appvform_result_'.$model->eolm_app_id.'.docx'); //กำหนด Path ที่จะสร้างไฟล์
        //$link= Url::to(Yii::getAlias('@web').'/web_eolm/files/appform/appvform_result_'.$model->eolm_app_id.'.docx', 'https')/*, ['class' => 'btn btn-info'])*/; // สร้าง Link สำหรับ Download ไฟล์ที่แทนที่ข้อมูลแล้ว
        echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web').'/web_eolm/files/appform/appvform_result_'.$model->eolm_app_id.'.docx'), ['class' => 'btn btn-info']); // สร้าง Link สำหรับ Download ไฟล์ที่แทนที่ข้อมูลแล้ว
        // $l=Yii::$app->urlManager->createUrl('/web_eolm/files/appform/appvform_result_'.$model->eolm_app_id.'.docx');
        //Yii::$app->getRequest()->$l;
    }

    public function actionGridview(){
        $searchModel=new EolmApprovalformajSearch();
        $dataProvider=$searchModel->search(Yii::$app->request->queryParams);
        return $this->render('gridview',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider
        ]);
    }
    public function actionApprovalajsearch()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmApprovalformajSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/loancontractin/approvalajsearch', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
