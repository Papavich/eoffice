<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 6/3/2561
 * Time: 13:04
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\BudgetMain;
use app\modules\pms\models\PmsCompactHasExecute;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsExecute;
use app\modules\pms\models\PmsExecuteHasCost;
use app\modules\pms\models\PmsProjectSub;
use app\modules\pms\models\PmsProjectsubBudget;
use yii;
use yii\web\Controller;


class DetailcompactbudgetController extends Controller
{
    public function actionDetail()
    {
//        echo "sdfsdf";
//        exit;
        $id = Yii::$app->request->get('id');
        $compact =Yii::$app->request->get('compact');

        date_default_timezone_set("Asia/Bangkok");
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($compact);
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        //$budget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->one();
        $comhasexecute = PmsCompactHasExecute::find()->where(['pms_compact_has_prosub_id'=>$compact])->all();
        $modelsExecute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $probudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();

        $countComhasexecute ="";
        foreach ($comhasexecute as $key => $row){
            if(sizeof($comhasexecute)==1){
                $countComhasexecute = "1";
                break;
            }else if($key == sizeof($comhasexecute)-1){
                $i = $key +1;
                $countComhasexecute = $countComhasexecute." และ".$i;
            }else{
                $i = $key +1;
                $countComhasexecute = $countComhasexecute." ".$i;
            }
        }

        foreach ($comhasexecute as $key => $row){
            $data = PmsExecuteHasCost::find()->where(['pms_compact_has_prosub_id'=>$row->pms_compact_has_prosub_id,'pms_execute_execute_id'=>$row->pms_execute_execute_id])->all();
//echo var_dump($data)."<br>";
            if($data){
                $modelsExecuteCost[$key]=$data;
            }else{
                $modelsExecuteCost[$key]=[new PmsExecuteHasCost()];
            }

        }

        //return yii\helpers\Json::encode($comhasexecute);
        $budget ="";
        foreach ($prosubbudget as $key => $row){
            $data = BudgetMain::find()->where(['budget_id'=>$row->budget_main])->one();
            if(sizeof($prosubbudget)==1){
                $budget = $budget.$data->budget_name;
            }else if(sizeof($prosubbudget)-1==$key){
                $budget = $budget." และ".$data->budget_name;
            }else{
                $budget = $budget." ".$data->budget_name;
            }
        }

        $this->layout ="main_module";
        return $this->render('detail_budget',[
            'modelprosub'=>$modelprosub,'execute'=>$execute,'modelcompacthasprosub'=>$modelcompacthasprosub,
            'prosubbudget'=>$prosubbudget,
            'modelsExecute' => $modelsExecute,
            'modelsExecuteCost' => $modelsExecuteCost,
            'comhasexecute'=>$comhasexecute,
            'budget'=>$budget,
            'compact'=>$compact,
            'probudget'=>$probudget,'countComhasexecute'=>$countComhasexecute,
        ]);
    }

    public function actionDetailStaff($id,$compact)
    {
        date_default_timezone_set("Asia/Bangkok");
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($compact);
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        //$budget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->one();
        $comhasexecute = PmsCompactHasExecute::find()->where(['pms_compact_has_prosub_id'=>$compact])->all();
        $modelsExecute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $probudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();

        $countComhasexecute ="";
        foreach ($comhasexecute as $key => $row){
            if(sizeof($comhasexecute)==1){
                $countComhasexecute = "1";
                break;
            }else if($key == sizeof($comhasexecute)-1){
                $i = $key +1;
                $countComhasexecute = $countComhasexecute." และ".$i;
            }else{
                $i = $key +1;
                $countComhasexecute = $countComhasexecute." ".$i;
            }
        }

        foreach ($comhasexecute as $key => $row){
            $data = PmsExecuteHasCost::find()->where(['pms_compact_has_prosub_id'=>$row->pms_compact_has_prosub_id,'pms_execute_execute_id'=>$row->pms_execute_execute_id])->all();
//echo var_dump($data)."<br>";
            if($data){
                $modelsExecuteCost[$key]=$data;
            }else{
                $modelsExecuteCost[$key]=[new PmsExecuteHasCost()];
            }

        }

        //return yii\helpers\Json::encode($comhasexecute);
        $budget ="";
        foreach ($prosubbudget as $key => $row){
            $data = BudgetMain::find()->where(['budget_id'=>$row->budget_main])->one();
            if(sizeof($prosubbudget)==1){
                $budget = $budget.$data->budget_name;
            }else if(sizeof($prosubbudget)-1==$key){
                $budget = $budget." และ".$data->budget_name;
            }else{
                $budget = $budget." ".$data->budget_name;
            }
        }

        $this->layout ="main_module";
        return $this->render('detail_budget_staff',[
            'modelprosub'=>$modelprosub,'execute'=>$execute,'modelcompacthasprosub'=>$modelcompacthasprosub,
            'prosubbudget'=>$prosubbudget,
            'modelsExecute' => $modelsExecute,
            'modelsExecuteCost' => $modelsExecuteCost,
            'comhasexecute'=>$comhasexecute,
            'budget'=>$budget,
            'compact'=>$compact,
            'probudget'=>$probudget,'countComhasexecute'=>$countComhasexecute,
        ]);
    }



    public function actionDetailManager($id,$compact)
    {
        date_default_timezone_set("Asia/Bangkok");
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($compact);
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        //$budget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->one();
        $comhasexecute = PmsCompactHasExecute::find()->where(['pms_compact_has_prosub_id'=>$compact])->all();
        $modelsExecute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $probudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();

        $countComhasexecute ="";
        foreach ($comhasexecute as $key => $row){
            if(sizeof($comhasexecute)==1){
                $countComhasexecute = "1";
                break;
            }else if($key == sizeof($comhasexecute)-1){
                $i = $key +1;
                $countComhasexecute = $countComhasexecute." และ".$i;
            }else{
                $i = $key +1;
                $countComhasexecute = $countComhasexecute." ".$i;
            }
        }

        foreach ($comhasexecute as $key => $row){
            $data = PmsExecuteHasCost::find()->where(['pms_compact_has_prosub_id'=>$row->pms_compact_has_prosub_id,'pms_execute_execute_id'=>$row->pms_execute_execute_id])->all();
//echo var_dump($data)."<br>";
            if($data){
                $modelsExecuteCost[$key]=$data;
            }else{
                $modelsExecuteCost[$key]=[new PmsExecuteHasCost()];
            }

        }

        //return yii\helpers\Json::encode($comhasexecute);
        $budget ="";
        foreach ($prosubbudget as $key => $row){
            $data = BudgetMain::find()->where(['budget_id'=>$row->budget_main])->one();
            if(sizeof($prosubbudget)==1){
                $budget = $budget.$data->budget_name;
            }else if(sizeof($prosubbudget)-1==$key){
                $budget = $budget." และ".$data->budget_name;
            }else{
                $budget = $budget." ".$data->budget_name;
            }
        }

        $this->layout ="main_module";
        return $this->render('detail_budget_manager',[
            'modelprosub'=>$modelprosub,'execute'=>$execute,'modelcompacthasprosub'=>$modelcompacthasprosub,
            'prosubbudget'=>$prosubbudget,
            'modelsExecute' => $modelsExecute,
            'modelsExecuteCost' => $modelsExecuteCost,
            'comhasexecute'=>$comhasexecute,
            'budget'=>$budget,
            'compact'=>$compact,
            'probudget'=>$probudget,'countComhasexecute'=>$countComhasexecute,
        ]);
    }


    public function actionDetailFinance($id,$compact)
    {
        date_default_timezone_set("Asia/Bangkok");
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($compact);
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        //$budget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->one();
        $comhasexecute = PmsCompactHasExecute::find()->where(['pms_compact_has_prosub_id'=>$compact])->all();
        $modelsExecute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $probudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();

        $countComhasexecute ="";
        foreach ($comhasexecute as $key => $row){
            if(sizeof($comhasexecute)==1){
                $countComhasexecute = "1";
                break;
            }else if($key == sizeof($comhasexecute)-1){
                $i = $key +1;
                $countComhasexecute = $countComhasexecute." และ".$i;
            }else{
                $i = $key +1;
                $countComhasexecute = $countComhasexecute." ".$i;
            }
        }

        foreach ($comhasexecute as $key => $row){
            $data = PmsExecuteHasCost::find()->where(['pms_compact_has_prosub_id'=>$row->pms_compact_has_prosub_id,'pms_execute_execute_id'=>$row->pms_execute_execute_id])->all();
//echo var_dump($data)."<br>";
            if($data){
                $modelsExecuteCost[$key]=$data;
            }else{
                $modelsExecuteCost[$key]=[new PmsExecuteHasCost()];
            }

        }

        //return yii\helpers\Json::encode($comhasexecute);
        $budget ="";
        foreach ($prosubbudget as $key => $row){
            $data = BudgetMain::find()->where(['budget_id'=>$row->budget_main])->one();
            if(sizeof($prosubbudget)==1){
                $budget = $budget.$data->budget_name;
            }else if(sizeof($prosubbudget)-1==$key){
                $budget = $budget." และ".$data->budget_name;
            }else{
                $budget = $budget." ".$data->budget_name;
            }
        }

        $this->layout ="main_module";
        return $this->render('detail_budget_finance',[
            'modelprosub'=>$modelprosub,'execute'=>$execute,'modelcompacthasprosub'=>$modelcompacthasprosub,
            'prosubbudget'=>$prosubbudget,
            'modelsExecute' => $modelsExecute,
            'modelsExecuteCost' => $modelsExecuteCost,
            'comhasexecute'=>$comhasexecute,
            'budget'=>$budget,
            'compact'=>$compact,
            'probudget'=>$probudget,'countComhasexecute'=>$countComhasexecute,
        ]);
    }

}