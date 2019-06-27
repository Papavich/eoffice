<?php

namespace app\modules\eoffice_eolmv2\controllers;

use app\modules\eoffice_eolmv2\models\EolmApprovalformajSearch;
use app\modules\eoffice_eolmv2\models\EolmApprovalformajSearch_dis;
use app\modules\eoffice_eolmv2\models\EolmApprovalformajSearch_repay;
use app\modules\eoffice_eolmv2\models\EolmApprovalformsfSearch_dis;
use app\modules\eoffice_eolmv2\models\EolmApprovalformsfSearch_repay;
use Yii;
use app\modules\eoffice_eolmv2\models\EolmRepay;
use app\modules\eoffice_eolmv2\models\EolmRepaySearch;
use app\modules\eoffice_eolmv2\models\EolmApprovalformsfSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RepayController implements the CRUD actions for EolmRepay model.
 */
class RepayformController extends Controller
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
     * Lists all EolmRepay models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmRepaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EolmRepay model.
     * @param integer $eolm_app_id
     * @param string $eolm_repay_date
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($eolm_app_id, $eolm_repay_date)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($eolm_app_id, $eolm_repay_date),
        ]);
    }

    /**
     * Creates a new EolmRepay model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $this->layout = "main_modules";
        $model = new EolmRepay();
        $model->eolm_app_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['approvalsearch'/*'view', 'eolm_app_id' => $model->eolm_app_id, 'eolm_repay_date' => $model->eolm_repay_date*/]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EolmRepay model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $eolm_app_id
     * @param string $eolm_repay_date
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($eolm_app_id, $eolm_repay_date)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($eolm_app_id, $eolm_repay_date);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['approvalsearch'/*'view', 'eolm_app_id' => $model->eolm_app_id, 'eolm_repay_date' => $model->eolm_repay_date*/]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EolmRepay model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $eolm_app_id
     * @param string $eolm_repay_date
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($eolm_app_id, $eolm_repay_date)
    {
        $models=$this->findModel($eolm_app_id, $eolm_repay_date);
        if ($models->delete()) {
            Yii::$app->session->setFlash( 'success', "ลบข้อมูลสำเร็จ" );
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the EolmRepay model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $eolm_app_id
     * @param string $eolm_repay_date
     * @return EolmRepay the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($eolm_app_id, $eolm_repay_date)
    {
        if (($model = EolmRepay::findOne(['eolm_app_id' => $eolm_app_id, 'eolm_repay_date' => $eolm_repay_date])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionApprovalsearch()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmApprovalformsfSearch_repay();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('approvalsearch', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionApprovalajsearch()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmApprovalformajSearch_repay();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('approvalajsearch', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

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
}
