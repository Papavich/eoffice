<?php

namespace app\modules\eoffice_eolm\controllers;

use app\modules\eoffice_eolm\models\EolmApprovalformajSearch;
use app\modules\eoffice_eolm\models\EolmApprovalformajSearch_dis;
use app\modules\eoffice_eolm\models\EolmApprovalformHasPersonal;
use app\modules\eoffice_eolm\models\EolmApprovalformHasStudent;
use app\modules\eoffice_eolm\models\EolmApprovalformsfSearch;
use app\modules\eoffice_eolm\models\EolmApprovalformsfSearch_dis;
use app\modules\eoffice_eolm\models\EolmReceiptHotelDetailsPersonal;
use app\modules\eoffice_eolm\models\EolmReceiptStudentajSearch;
use app\modules\eoffice_eolm\models\model_main\EofficeMainViewStudentFull;
use app\modules\eoffice_eolm\models\Person;
use Yii;
use app\modules\eoffice_eolm\models\EolmReceiptStudent;
use app\modules\eoffice_eolm\models\EolmReceiptStudentSearch;
use app\modules\eoffice_eolm\models\EolmReceiptStudentDetail;
use app\modules\eoffice_eolm\components\ModelHelper;

use app\modules\eoffice_eolm\components\AuthHelper;
use yii\widgets\ActiveForm;
use app\modules\eoffice_eolm\models\ModelDis;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;


/**
 * ReceiptstudentController implements the CRUD actions for EolmReceiptStudent model.
 */
class ReceiptstudentController extends Controller
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
     * Lists all EolmReceiptStudent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmReceiptStudentSearch();
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
    public function actionIndexaj()
    {
        $this->layout = "main_modules";
        $searchModel = new EolmReceiptStudentajSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EolmReceiptStudent model.
     * @param integer $eolm_app_id
     * @param integer $person_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($eolm_app_id, $person_id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($eolm_app_id, $person_id),
        ]);
    }

    /**
     * Creates a new EolmReceiptStudent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate($id)
    {
        $this->layout = "main_modules";
        $model = ModelHelper::create(new EolmReceiptStudent);
        $modelsAddress = [new EolmReceiptStudentDetail];
        //$model->eolm_app_id = $id;

        if ($model->load(Yii::$app->request->post())) {
            $model->eolm_app_id=$id;
            $modelsAddress = ModelDis::createMultiple(EolmReceiptStudentDetail::classname());
            ModelDis::loadMultiple($modelsAddress, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = ModelDis::validateMultiple($modelsAddress) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsAddress as $modelAddress) {
                            $modelAddress->eolm_app_id = $model->eolm_app_id;
                            $modelAddress->person_id = $model->person_id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
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

                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'modelsAddress' => (empty($modelsAddress)) ? [new EolmReceiptStudentDetail] : $modelsAddress
        ]);
    }

    /**
     * Updates an existing EolmReceiptStudent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $eolm_app_id
     * @param integer $person_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($eolm_app_id,$person_id)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($eolm_app_id,$person_id);

        $model = ModelHelper::update($model);
        $model->eolm_app_id = $eolm_app_id;
        $modelsAddress = $model->eolmReceiptStudentDetails;

        if ($model->load(Yii::$app->request->post())) {
            EolmReceiptStudentDetail::deleteAll(['person_id' => $person_id]);
            $modelsAddress = ModelDis::createMultiple(EolmReceiptStudentDetail::classname());
            ModelDis::loadMultiple($modelsAddress, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = ModelDis::validateMultiple($modelsAddress) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsAddress as $modelAddress) {
                            $modelAddress->eolm_app_id = $model->eolm_app_id;
                            $modelAddress->person_id = $model->person_id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
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

                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
            'modelsAddress' => (empty($modelsAddress)) ? [new EolmReceiptStudentDetail] : $modelsAddress
        ]);
    }

    /**
     * Deletes an existing EolmReceiptStudent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $eolm_app_id
     * @param integer $person_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($eolm_app_id, $person_id)
    {
        $this->layout = "main_modules";

        $models = $this->findModel($eolm_app_id, $person_id);
        if ($models->delete()) {
            Yii::$app->session->setFlash( 'success', "ลบข้อมูลสำเร็จ" );
            return $this->redirect(['index','id'=>$eolm_app_id]);
        }


    }

    /**
     * Finds the EolmReceiptStudent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $eolm_app_id
     * @param integer $person_id
     * @return EolmReceiptStudent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($eolm_app_id,$person_id)
    {
        if (($model = EolmReceiptStudent::findOne(['eolm_app_id' => $eolm_app_id, 'person_id' => $person_id])) !== null) {
            return $model;
        }


        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionStd() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getSubCatList($cat_id);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    public function getSubCatList($id)
    {
        $posts = EolmApprovalformHasStudent::find()
            ->where(['eolm_app_id' => $id])
            ->orderBy('id DESC')
            ->all();

        if (!empty($posts)) {
            foreach($posts as $post) {
                echo "<option value='".$post->person_id."'>".$post->STUDENTID."</option>";
            }
        } else {
            echo "<option>-</option>";
        }

    }
    public function actionExcel($eolm_app_id,$person_id) {

        $per1 = EofficeMainViewStudentFull::find()->where(['STUDENTID'=>$person_id])->one();
        $person = $per1['PREFIXNAME']." ".$per1['STUDENTNAME']." ".$per1['STUDENTSURNAME'];
        $position = $per1['STUDENTCODE'];
        $major=$per1['branch_name'];


        //$mon='รวมทั้งสิ้น (ตัวอักษร) (-'.$model->eolm_dis_total_text.'-)';
        $sql1 = 'SELECT * FROM eoffice_olm.eolm_receipt_student where eolm_app_id = '.$eolm_app_id.' and person_id = '.$person_id;
        $model1 = EolmReceiptStudent::findBySql($sql1)->one();

        $sql2 = 'SELECT * FROM eoffice_olm.eolm_receipt_student_detail where eolm_app_id = '.$eolm_app_id.' and person_id = '.$person_id;
        $models = EolmReceiptStudentDetail::findBySql($sql2)->asArray()->all();

        $n=Yii::getAlias('@webroot').'/web_eolm/files/111std.xlsx';
        $objReader = new \PHPExcel_Reader_Excel2007();
        $objPHPExcel = $objReader->load($n);
        //set value

        $i = 6; // กำหนดค่า i เป็น 8 เพื่อเริ่มพิมพ์ที่แถวที่ 8

        // Write data from MySQL result
        foreach($models as $item){ //วนลูปหาพนักงานทั้งหมด
            $Weddingdate = new \DateTime($item['eolm_rec_std_detail_date']);
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $Weddingdate->format('d-m-Y'));
            //กำหนดให้คอลัมม์ A แถวที่ i พิมพ์ค่าของ employeeNumber
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $item['eolm_rec_std_detail_detail']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $item['eolm_rec_std_detail_amount']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $item['eolm_rec_std_detail_note']);
            /*
             */

            $i++;
        }
        $objPHPExcel->getActiveSheet()->setCellValue('c12', $model1['eolm_rec_std_total']);
        $objPHPExcel->getActiveSheet()->setCellValue('A14', 'รวมทั้งสิ้น (ตัวอักษร) '.$model1['eolm_rec_std_text']);
        $objPHPExcel->getActiveSheet()->SetCellValue('A15','    ข้าพเจ้า '.$person.' รหัส '.$position.' เป็นนักศึกษาภาควิชาวิทยาการคอมพิวเตอร์ ระดับปริญญาตรี สาขาวิชา '.$major.'กอง คณะวิทยาศาสตร์ มหาวิทยาลัยขอนแก่น ขอรับรองว่ารายจ่ายข้างต้นนี้ไม่อาจเรียกใบเสร็จรับเงินจากผู้รับเงินได้ และข้าพเจ้าได้จ่ายไปในงานราชการโดยแท้');
        $objPHPExcel->getActiveSheet()->setCellValue('C19', '( '.$person.' )');
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

}
