<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 10/1/2561
 * Time: 1:08
 */

namespace app\modules\pms\controllers;
use app\modules\eoffice_eolm\models\Model;
use app\modules\pms\models\Governance;
use app\modules\pms\models\Year;
use app\modules\pms\models\PmsGovernanceOfYear;

use yii;
use yii\web\Controller;

use app\modules\pms\models\Address;
use app\modules\pms\models\Customer;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\modules\pms\models;



class CustomgovernanceController extends Controller
{
    // INSERT UPDATE DELETE GOVERNANCE


    public function actionGovernanceAdd(){
        $modelgovernance = new Governance();
        $this->layout ="main_module";
        if(Yii::$app->request->post()){
            $modelgovernance->load(Yii::$app->request->post());
            if($modelgovernance->save()){
                return $this->redirect('governance-show');
            }
        }
        return $this->render('governance_add',['modelgovernance' =>$modelgovernance]);
    }

    public function actionGovernanceUpdate($id){
        $modelgovernance = Governance::findOne($id);
        $this->layout ="main_module";
        if(Yii::$app->request->post()){
            $modelgovernance->load(Yii::$app->request->post());
            if($modelgovernance->save()){
                return $this->redirect('governance-show');
            }
        }
        return $this->render('governance_update',['modelgovernance' =>$modelgovernance]);
    }

    public function actionGovernanceDelete($id){
        $modelgovernance = Governance::findOne($id);
        $this->layout ="main_module";
        if($modelgovernance->delete()){
            return $this->redirect('governance-show');
        }else{
            echo 'Fale....' ;
        }
    }

    //-------------- END

    // SHOW GOVERNANCE

    public function actionGovernanceShow(){
        $modelgovernance = new Governance();
        if(Yii::$app->request->post()){
            $modelgovernance->load(Yii::$app->request->post());
            if($modelgovernance->save()){
                return $this->redirect('governance-show');
            }
        }
        $governance = Governance::find()->all();
        $this->layout ="main_module";
        return $this->render('governance_show',['governance'=>$governance,'modelgovernance'=>$modelgovernance]);
    }

    //-------------- END

    // CHECK  GOVERNANCE
    public function actionGovernanceCheck(){
        $governance = Governance::find()->all();
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        $this->layout ="main_module";
        return $this->render('governance_check',['governance'=>$governance,'yearNow'=>$yearNow]);
    }

    public function actionGovernanceJs(){
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        $year = Yii::$app->request->get('year');
        $governance = PmsGovernanceOfYear::find()->where(['year'=>$year])->all();
        $governanceAll = Governance::find()->all();
        $governanceShow="";
        if(sizeof($governance)==0){
            foreach ($governanceAll as $key => $item){
                $governanceShow = $governanceShow."<div class='col-md-6 col-sm-6'><label class='checkbox'><input type='checkbox' name='governancecheck[]' value='".$item['governance_id']."'><i></i>".$item['governance_name']."</label></div>";
            }
            echo $governanceShow;
        }
        else{
            foreach ($governanceAll as $key => $item){
                $count = 0;
                if($year <=$yearNow){
                    foreach ($governance as $rows){
                        if($rows['governance_id'] == $item['governance_id']){
                            $governanceShow = $governanceShow."<div class='col-md-6 col-sm-6'><label class='checkbox'><input type='checkbox' disabled='disabled' checked name='governancecheck[]' value='".$item['governance_id']."'><i></i>".$item['governance_name']."</label></div>";
                        }
                        else{
                            $count = $count +1;
                        }
                        if($count == sizeof($governance)){
                            $governanceShow = $governanceShow."<div class='col-md-6 col-sm-6'><label class='checkbox'><input type='checkbox' disabled='disabled' name='governancecheck[]' value='".$item['governance_id']."'><i></i>".$item['governance_name']."</label></div>";
                        }
                    }
                }else{
                    foreach ($governance as $rows){
                        if($rows['governance_id'] == $item['governance_id']){
                            $governanceShow = $governanceShow."<div class='col-md-6 col-sm-6'><label class='checkbox'><input type='checkbox' checked name='governancecheck[]' value='".$item['governance_id']."'><i></i>".$item['governance_name']."</label></div>";
                        }
                        else{
                            $count = $count +1;
                        }
                        if($count == sizeof($governance)){
                            $governanceShow = $governanceShow."<div class='col-md-6 col-sm-6'><label class='checkbox'><input type='checkbox' name='governancecheck[]' value='".$item['governance_id']."'><i></i>".$item['governance_name']."</label></div>";
                        }
                    }
                }

            }
            echo $governanceShow;
        }
    }

    public function actionSavecheck(){
        $year = Yii::$app->request->post('year');
        $governance = Yii::$app->request->post('governancecheck');
        PmsGovernanceOfYear::deleteAll(['year'=>$year]);
        if($governance != null && $year != null){

            foreach ($governance as $item) {
                $tmp = new PmsGovernanceOfYear();
                $tmp->year = $year;
                $tmp->governance_id = $item;
                $tmp->save();
            }
        }


        return $this->redirect('governance-check');
    }
    //-------------- END


    ///////////////////////////////////////////////////
    public function actionCreate()
    {
        $this->layout ="main_module";
        $modelCustomer = new Customer;
    //    $modelCustomer->first_name = "222";
    //    $modelCustomer->last_name = "3333";
    //    $modelCustomer->save();
    //
    //    echo $modelCustomer->id."llll";
    //    exit;
        $modelsAddress = [new Address];
        if ($modelCustomer->load(Yii::$app->request->post())) {
            $modelsAddress = models\Model::createMultiple(Address::classname(), $modelsAddress);
            models\Model::loadMultiple($modelsAddress, Yii::$app->request->post());

            $modelCustomer->save();
            foreach ($modelsAddress as $modelsAddresss){
                $modelsAddressS = new Address;
                $modelsAddressS->customer_id = $modelCustomer->id;
                $modelsAddressS->full_name = $modelsAddresss->full_name;
                echo $modelsAddresss->full_name."<br>";
                $modelsAddressS->save();
            }
            return $this->redirect(['view']);


        }

        return $this->render('create', [
            'modelCustomer' => $modelCustomer,
            'modelsAddress' => (empty($modelsAddress)) ? [new Address] : $modelsAddress
        ]);
    }

    public function actionUpdate($id)
    {
        $this->layout ="main_module";
        $modelCustomer = Customer::findOne($id);
        $modelsAddress = $modelCustomer->addresses;

        if ($modelCustomer->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsAddress, 'id', 'id');
            $modelsAddress = models\Model::createMultiple(Address::classname(), $modelsAddress);
            models\Model::loadMultiple($modelsAddress, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsAddress, 'id', 'id')));

            // validate all models
            $valid = $modelCustomer->validate();
            $valid = models\Model::validateMultiple($modelsAddress) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelCustomer->save(false)) {
                        if (!empty($deletedIDs)) {
                            Address::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsAddress as $modelAddress) {
                            $modelAddress->customer_id = $modelCustomer->id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect('view');
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelCustomer' => $modelCustomer,
            'modelsAddress' => (empty($modelsAddress)) ? [new Address] : $modelsAddress
        ]);
    }


    public function actionView()
    {
        $model = Customer::find()->all();

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}