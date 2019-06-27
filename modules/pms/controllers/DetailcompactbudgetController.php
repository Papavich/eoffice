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
    public function Number($numbers){
        $number = $numbers.".00";

        $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
        $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
        $number = str_replace(",","",$number);
        $number = str_replace(" ","",$number);
        $number = str_replace("บาท","",$number);
        $number = explode(".",$number);
        if(sizeof($number)>2){
            return 'ทศนิยมหลายตัวนะจ๊ะ';
            exit;
        }
        $strlen = strlen($number[0]);
        $convert = '';
        for($i=0;$i<$strlen;$i++){
            $n = substr($number[0], $i,1);
            if($n!=0){
                if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; }
                elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; }
                elseif($i==($strlen-2) AND $n==1){ $convert .= ''; }
                else{ $convert .= $txtnum1[$n]; }
                $convert .= $txtnum2[$strlen-$i-1];
            }
        }

        $convert .= 'บาท';
        if($number[1]=='0' OR $number[1]=='00' OR
            $number[1]==''){
            $convert .= 'ถ้วน';
        }else{
            $strlen = strlen($number[1]);
            for($i=0;$i<$strlen;$i++){
                $n = substr($number[1], $i,1);
                if($n!=0){
                    if($i==($strlen-1) AND $n==1){$convert
                        .= 'เอ็ด';}
                    elseif($i==($strlen-2) AND
                        $n==2){$convert .= 'ยี่';}
                    elseif($i==($strlen-2) AND
                        $n==1){$convert .= '';}
                    else{ $convert .= $txtnum1[$n];}
                    $convert .= $txtnum2[$strlen-$i-1];
                }
            }
            $convert .= 'สตางค์';
        }

        return $convert;
        //echo  "-------".$convert."---------";

    }

    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');
        $compact =Yii::$app->request->get('compact');

        date_default_timezone_set("Asia/Bangkok");
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        //return yii\helpers\Json::encode($modelprosub);
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

        $command = Yii::$app->get('db_pms')->createCommand("SELECT sum(cost) FROM pms_execute_has_cost WHERE pms_compact_has_prosub_id='".$compact."'");
        $costplaneEng = $command->queryScalar();
        $costplaneTh = $this->Number($costplaneEng);

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
            'costplaneEng'=>$costplaneEng,
            'costplaneTh'=>$costplaneTh,
        ]);
    }

    public function actionDetailStaff()
    {
        $id = Yii::$app->request->get('id');
        $compact =Yii::$app->request->get('compact');

        date_default_timezone_set("Asia/Bangkok");
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        //return yii\helpers\Json::encode($modelprosub);
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

        $command = Yii::$app->get('db_pms')->createCommand("SELECT sum(cost) FROM pms_execute_has_cost WHERE pms_compact_has_prosub_id='".$compact."'");
        $costplaneEng = $command->queryScalar();
        $costplaneTh = $this->Number($costplaneEng);

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
            'costplaneEng'=>$costplaneEng,
            'costplaneTh'=>$costplaneTh,
        ]);
    }



    public function actionDetailManager($id,$compact)
    {
        $id = Yii::$app->request->get('id');
        $compact =Yii::$app->request->get('compact');

        date_default_timezone_set("Asia/Bangkok");
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        //return yii\helpers\Json::encode($modelprosub);
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

        $command = Yii::$app->get('db_pms')->createCommand("SELECT sum(cost) FROM pms_execute_has_cost WHERE pms_compact_has_prosub_id='".$compact."'");
        $costplaneEng = $command->queryScalar();
        $costplaneTh = $this->Number($costplaneEng);

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
            'costplaneEng'=>$costplaneEng,
            'costplaneTh'=>$costplaneTh,
        ]);
    }


    public function actionDetailFinance()
    {
        $id = Yii::$app->request->get('id');
        $compact =Yii::$app->request->get('compact');

        date_default_timezone_set("Asia/Bangkok");
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        //return yii\helpers\Json::encode($modelprosub);
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

        $command = Yii::$app->get('db_pms')->createCommand("SELECT sum(cost) FROM pms_execute_has_cost WHERE pms_compact_has_prosub_id='".$compact."'");
        $costplaneEng = $command->queryScalar();
        $costplaneTh = $this->Number($costplaneEng);

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
            'costplaneEng'=>$costplaneEng,
            'costplaneTh'=>$costplaneTh,
        ]);
    }

}