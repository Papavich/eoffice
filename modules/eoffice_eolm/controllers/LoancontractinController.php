<?php

namespace app\modules\eoffice_eolm\controllers;

use app\modules\eoffice_eolm\components\AuthHelper;
use app\modules\eoffice_eolm\components\ModelHelper;
use app\modules\eoffice_eolm\models\EolmApprovalform;
use app\modules\eoffice_eolm\models\EolmApprovalformHasPersonal;
use app\modules\eoffice_eolm\models\EolmBudgettype;
use app\modules\eoffice_eolm\models\Model;
use app\modules\eoffice_eolm\models\EolmLoancontractinSearch;
use app\modules\eoffice_eolm\models\model_main\EofficeMainViewPisPerson;
use Yii;
use app\modules\eoffice_eolm\models\EolmLoancontract;
use app\modules\eoffice_eolm\models\EolmBorrowingplans;
use app\modules\eoffice_eolm\models\EolmBorrowingplansItem;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use yii\helpers\Html;
use yii\helpers\Url;
/**
 * LoancontractinController implements the CRUD actions for EolmLoancontract model.
 */
class LoancontractinController extends Controller{
    /**
     * Lists all EolmLoancontract models.
     * @return mixed
     */
    public function actionIndex()
{   $this->layout = "main_modules";
    $searchModel = new EolmLoancontractinSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
}

    /**
     * Displays a single EolmLoancontract model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
{   $this->layout = "main_modules";
    $model = $this->findModel($id);
    $houses = $model->eolmBorrowingplans;

    return $this->render('view', [
        'model' => $model,
        'houses' => $houses,
    ]);
}

    /**
     * Creates a new EolmLoancontract model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $this->layout = "main_modules";
        $model =  ModelHelper::create(new EolmLoancontract);
        $modelsBorrow = [new EolmBorrowingplans];
        $modelsDetail = [[new EolmBorrowingplansItem]];
        $model->eolm_app_id = $id;

        if ($model->load(Yii::$app->request->post())) {

            $modelsBorrow = Model::createMultiple(EolmBorrowingplans::classname());
            Model::loadMultiple($modelsBorrow, Yii::$app->request->post());

            // validate loancontract and borrowingplans models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsBorrow) && $valid;

            if (isset($_POST['EolmBorrowingplansItem'][0][0])) {
                foreach ($_POST['EolmBorrowingplansItem'] as $indexBorrow => $details) {
                    foreach ($details as $indexDetail => $detail) {
                        $data['EolmBorrowingplansItem'] = $detail;
                        $modelDetail = new EolmBorrowingplansItem;
                        $modelDetail->load($data);
                        $modelsDetail[$indexBorrow][$indexDetail] = $modelDetail;
                        $valid = $modelDetail->validate();
                    }
                }
            }

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsBorrow as $indexBorrow => $modelBorrow) {

                            if ($flag === false) {
                                break;
                            }

                            $modelBorrow->eolm_app_id = $model->eolm_app_id;

                            if (!($flag = $modelBorrow->save(false))) {
                                break;
                            }

                            if (isset($modelsDetail[$indexBorrow]) && is_array($modelsDetail[$indexBorrow])) {
                                foreach ($modelsDetail[$indexBorrow] as $indexDetail => $modelDetail) {
                                    $modelDetail->eolm_app_id = $model->eolm_app_id;
                                    $modelDetail->eolm_bor_periods = $modelBorrow->eolm_bor_periods;
                                    if (!($flag = $modelDetail->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash( 'success', "บันทึกสำเร็จ" );

                        $userType=AuthHelper::getUserType();
                        if ($userType==AuthHelper::TYPE_ADMIN){
                            return $this->redirect(['approvalformsf/index']);
                        }elseif ($userType==AuthHelper::TYPE_TEACHER){
                            return $this->redirect(['approvalformaj/index']);
                        }elseif ($userType == AuthHelper::TYPE_APPROVERS){
                        return $this->redirect(['approvalformaj/index2']);
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
            'modelsBorrow' => (empty($modelsBorrow)) ? [new EolmBorrowingplans] : $modelsBorrow,
            'modelsDetail' => (empty($modelsDetail)) ? [[new EolmBorrowingplansItem]] : $modelsDetail,
        ]);
    }

    /**
     * Updates an existing EolmLoancontract model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = "main_modules";

        /*if (!empty($modelsBorrow)) {
            foreach ($modelsBorrow as $indexBorrow => $modelBorrow) {
                $de1 = EolmBorrowingplansItem::find()->where(['eolm_app_id' => $id, 'eolm_bor_periods' => $modelBorrow->eolm_bor_periods,'eolm_bor_type_id'=>1])->one();
                if ($de1!=null) {
                    $modelBorrow->eolm_bor_type_id1 = $de1->eolm_bor_type_id;
                    $modelBorrow->eolm_bor_detail1 = $de1->eolm_bor_detail;
                    $modelBorrow->eolm_bor_amount_date1 = $de1->eolm_bor_amount_date;
                    $modelBorrow->eolm_bor_amount1 = $de1->eolm_bor_amount;
                    $modelBorrow->eolm_bor_note1 = $de1->eolm_bor_note;
                }
            }
        }*/

        $model = $this->findModel($id);
        $model = ModelHelper::update($model);
        $modelsBorrow = $model->eolmBorrowingplans;
        $modelsDetail = [];
        $oldDetails = [];
        if (!empty($modelsBorrow)) {
            foreach ($modelsBorrow as $indexBorrow => $modelBorrow) {
                $details = $modelBorrow->eolmBorrowingplansItems;
                $modelsDetail[$indexBorrow] = $details;
                $oldDetails = ArrayHelper::merge(ArrayHelper::index($details, 'eolm_bor_periods'), $oldDetails);
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            EolmBorrowingplans::deleteAll(['eolm_app_id' => $id]);

            $modelsBorrow = Model::createMultiple(EolmBorrowingplans::classname());
            Model::loadMultiple($modelsBorrow, Yii::$app->request->post());


            // validate loancontract and borrowingplans models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsBorrow) && $valid;

            if (isset($_POST['EolmBorrowingplansItem'][0])) {
                foreach ($_POST['EolmBorrowingplansItem'] as $indexBorrow => $details) {
                    foreach ($details as $indexDetail => $detail) {
                        $data['EolmBorrowingplansItem'] = $detail;
                        $modelDetail = new EolmBorrowingplansItem;
                        $modelDetail->load($data);
                        $modelsDetail[$indexBorrow][$indexDetail] = $modelDetail;
                        $valid = $modelDetail->validate();
                    }
                }
            }

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsBorrow as $indexBorrow => $modelBorrow) {

                            if ($flag === false) {
                                break;
                            }

                            $modelBorrow->eolm_app_id = $model->eolm_app_id;

                            if (!($flag = $modelBorrow->save(false))) {
                                break;
                            }

                            if (isset($modelsDetail[$indexBorrow]) && is_array($modelsDetail[$indexBorrow])) {
                                foreach ($modelsDetail[$indexBorrow] as $indexDetail => $modelDetail) {
                                    $modelDetail->eolm_app_id = $model->eolm_app_id;
                                    $modelDetail->eolm_bor_periods = $modelBorrow->eolm_bor_periods;
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

                        $userType=AuthHelper::getUserType();
                        if ($userType==AuthHelper::TYPE_ADMIN){
                             return $this->redirect(['approvalformsf/index']);
                        }elseif ($userType==AuthHelper::TYPE_TEACHER){
                            return $this->redirect(['approvalformaj/index']);
                        }elseif ($userType == AuthHelper::TYPE_APPROVERS){
                            return $this->redirect(['approvalformaj/index2']);
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
            /*'data' => $data,*/
            'modelsBorrow' => (empty($modelsBorrow)) ? [new EolmBorrowingplans] : $modelsBorrow,
            'modelsDetail' => (empty($modelsDetail)) ? [[new EolmBorrowingplansItem]] : $modelsDetail
        ]);
    }

    /**
     * Deletes an existing EolmLoancontract model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        EolmBorrowingplansItem::deleteAll(['eolm_app_id' => $id]);
        EolmBorrowingplans::deleteAll(['eolm_app_id' => $id]);
        //$name = "ชื่อเรื่อง";
        //$name = $model->first_name;

        if ($model->delete()) {
            Yii::$app->session->setFlash( 'success', "ลบข้อมูลสำเร็จ" );
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the EolmLoancontract model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EolmLoancontract the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EolmLoancontract::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionWord($id) /*function ปริ้น word */
    {   $model = EolmLoancontract::findOne($id);
        if ($model['eolm_loa_total_amout']<=30000){
            Settings::setTempDir(Yii::getAlias('@webroot').'/web_eolm/files/temp/'); //Path ของ Folder temp ที่สร้างเอาไว้
            $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot').'/web_eolm/files/loan.docx'); //Path ของ template ที่สร้างเอาไว้

        }else{
            Settings::setTempDir(Yii::getAlias('@webroot').'/web_eolm/files/temp/'); //Path ของ Folder temp ที่สร้างเอาไว้
            $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot').'/web_eolm/files/loankku.docx'); //Path ของ template ที่สร้างเอาไว้

        }

        $model_app = EolmApprovalform::findOne($id);

        $modelper1 = EolmApprovalformHasPersonal::find()->where(['eolm_app_id' => $id,'eolm_app_has_person_type_id'=>1])->one();
        $per1 = EofficeMainViewPisPerson::find()->where(['person_id'=>$modelper1["person_id"]])->one();
        $person_id = $per1['academic_positions_abb_thai']." ".$per1['person_name']." ".$per1['person_surname'];
        $position = $per1['academic_positions_abb_thai'];
        $email=$per1['person_email'];
        $dept=$per1['DEPARTMENTNAME'];
        $model4 = EolmBudgettype::findOne($model_app["eolm_budt_id"]);
        $b1 = '';
        $b2 = '';
        if ($model4-> eolm_budt_id==1){
            $b1 = '/';
        }elseif ($model4->eolm_budt_id==2){
            $b2 = '/';
        }
        $vehi = EolmBorrowingplansItem::find()->asArray()->where(['eolm_app_id' => $id])->all();
        $m1=0;
        $m2=0;
        $m3=0;
        $s1='';
        $s2='';
        $s3='';
        $du1='....................';
        $du2='....................';
        $du3='....................';
        $dr1='....................';
        $dr2='....................';
        $dr3='....................';
        foreach ($vehi as $v){
            if ($v['eolm_bor_periods']==1){
                $s1='/';
                $m1 = $m1+$v['eolm_bor_amount'];
            }elseif ($v['eolm_bor_periods']==2){
                $s2='/';
                $m2 = $m2+$v['eolm_bor_amount'];
            }elseif ($v['eolm_bor_periods']==3){
                $s2='/';
                $m3 = $m3+$v['eolm_bor_amount'];
            }
        }
        if ($m1==0){
             $m1='............';
        }if ($m2==0){
             $m2='............';
        }if ($m3==0){
             $m3='............';
        }
        $ve = EolmBorrowingplans::find()->asArray()->where(['eolm_app_id' => $id])->all();
        foreach ($ve as $v){
            if ($v['eolm_bor_periods']==1){
                $du1 = Yii::$app->thaiFormatter->asDate($v['eolm_bor_date_spent'], 'long')." ";
                $dr1 = Yii::$app->thaiFormatter->asDate($v['eolm_bor_date_repay'], 'long')." ";
            }elseif ($v['eolm_bor_periods']==2){
                $du2 = Yii::$app->thaiFormatter->asDate($v['eolm_bor_date_spent'], 'long')." ";
                $dr2 = Yii::$app->thaiFormatter->asDate($v['eolm_bor_date_repay'], 'long')." ";
            }elseif ($v['eolm_bor_periods']==3){
                $du3 = Yii::$app->thaiFormatter->asDate($v['eolm_bor_date_spent'], 'long')." ";
                $dr3 = Yii::$app->thaiFormatter->asDate($v['eolm_bor_date_repay'], 'long')." ";
            }
        }
        $templateProcessor->setValue(
            [
                'person_id',
                'position',
                'money',
                'approvers',
                'app_number',
                'app_date',
                'loan_number',
                'loan_date',
                'email',
                'dept',
                'b1',
                'b2',
                'total',
                'text','m1','m2','m3',
                'du1',
                'du2',
                'du3',
                'dr1',
                'dr2',
                'dr3',
                's1',
                's2',
                's3',
                'subject',

            ],
            [
                $person_id,
                $position,
                $model->eolm_loa_total_amout,
                $model->eolm_loa_approvers,
                $model_app->eolm_app_number,
                Yii::$app->thaiFormatter->asDate($model_app->eolm_app_date, 'long')." ",
                $model->eolm_loa_number,
                Yii::$app->thaiFormatter->asDate($model->eolm_loa_date, 'long')." ",
                $email,
                $dept,
                $b1,
                $b2,
                $model->eolm_loa_total_amout,
                $model->eolm_loa_total_text,
                $m1,
                $m2,
                $m3,
                $du1,
                $du2,
                $du3,
                $dr1,
                $dr2,
                $dr3,
                $s1,
                $s2,
                $s3,
                $model_app->eolm_app_subject,







            ]); // การ setValue หลายๆ ตะวแปรพร้อมกะน

        $templateProcessor->saveAs(Yii::getAlias('@webroot').'/web_eolm/files/appform/สัญญายืมเงิน_'.$model->eolm_app_id.'.docx'); //กำหนด Path ที่จะสร้างไฟล์
        $path =Yii::getAlias('@webroot').'/web_eolm/files/appform/สัญญายืมเงิน_'.$model->eolm_app_id.'.docx'; // สร้าง Link สำหรับ Download ไฟล์ที่แทนที่ข้อมูลแล้ว
        return Yii::$app->response->sendFile($path);
    }



}