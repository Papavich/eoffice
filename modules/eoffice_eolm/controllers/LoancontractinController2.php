<?php

namespace app\modules\eoffice_eolm\controllers;

use app\modules\eoffice_eolm\components\ModelHelper;
use app\modules\eoffice_eolm\models\Model;
use app\modules\eoffice_eolm\models\EolmLoancontractinSearch;
use Yii;
use app\modules\eoffice_eolm\models\EolmLoancontract;
use app\modules\eoffice_eolm\models\EolmBorrowingplans;
use app\modules\eoffice_eolm\models\EolmBorrowingplansItem;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
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
                    return $this->redirect(['view', 'id' => $model->eolm_app_id]);
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
        EolmBorrowingplansItem::deleteAll(['eolm_app_id' => $id]);
        EolmBorrowingplans::deleteAll(['eolm_app_id' => $id]);

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
                    Yii::$app->session->setFlash( 'success', "แก้ไขสำเร็จ" );
                    return $this->redirect(['view', 'id' => $model->eolm_app_id]);
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


}