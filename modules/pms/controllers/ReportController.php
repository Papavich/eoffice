<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 28/1/2561
 * Time: 16:07
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\BudgetMain;
use app\modules\pms\models\PmsCompactHasExecute;
use app\modules\pms\models\PmsCompactHasMethod;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsCompactHasTargetgroup;
use app\modules\pms\models\PmsDocument;
use app\modules\pms\models\PmsExecuteHasCost;
use app\modules\pms\models\PmsGovernanceOfYear;
use app\modules\pms\models\PmsProject;
use app\modules\pms\models\PmsProjectSub;
use app\modules\pms\models\PmsProjectsubBudgets;
use app\modules\pms\models\PmsProjectsubBudgetss;
use app\modules\pms\models\PmsResultProblem;
use app\modules\pms\models\PmsResultQuality;
use app\modules\pms\models\PmsResultSuggest;
use app\modules\pms\models\PmsStrategicIssues;
use app\modules\pms\models\PmsStrategic;
use app\modules\pms\models\PmsGovernance;
use app\modules\pms\models\PmsBudgetMain;
use app\modules\pms\models\PmsBudgetSub;
use app\modules\pms\models\PmsStrategicHasProjectSub;
use app\modules\pms\models\PmsGovernanceHasProjectSub;
use app\modules\pms\models\PmsPurpose;
use app\modules\pms\models\PmsIndicator;
use app\modules\pms\models\PmsPlace;
use app\modules\pms\models\PmsExecute;
use app\modules\pms\models\PmsPayment;
use app\modules\pms\models\PmsResultExpect;
use app\modules\pms\models\PmsEffect;
use app\modules\pms\models\PmsProblem;
use app\modules\pms\models\PmsCostPlan;
use app\modules\pms\models\PmsProjectsubBudget;
use app\modules\pms\models\dao;
use app\modules\pms\models\Strategic;
use app\modules\pms\models\StrategicIssues;
use yii;
use yii\web\Controller;
use Mpdf\Mpdf;

class ReportController extends Controller
{

    public function actionFindreport(){
        $this->layout ="main_module";
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        $dataList = PmsProjectSub::find()->where(['prosub_year'=>$yearNow])->all();
        if(Yii::$app->request->post()){
            $format = Yii::$app->request->post('format');
            $year = Yii::$app->request->post('year');
            $id = Yii::$app->request->post('id');
            if($format == 1){
                if($id){
                    $dataList = PmsProjectSub::find()->where(['prosub_code'=>$id])->all();
                }else{
                    $dataList = PmsProjectSub::find()->where(['prosub_year'=>$year])->all();
                }
                return $this->render('find_report',['dataList'=>$dataList,'format'=>$format,'year'=>$year]);
            }else if($format == 2){
                if($id){
                    $dataList = PmsProjectSub::find()->where(['prosub_code'=>$id,'compact_save'=>'true'])->all();
                }else{
                    $dataList = PmsProjectSub::find()->where(['prosub_year'=>$year,'compact_save'=>'true'])->all();
                }
                return $this->render('find_report',['dataList'=>$dataList,'format'=>$format,'year'=>$year]);
            }else if($format == 3){
                if($id){
                    $dataList = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true" AND pms_project_sub.prosub_code ="'.$id.'"')
                        ->queryAll();
                }else{
                    $dataList = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true" AND pms_project_sub.prosub_year ="'.$year.'"')
                        ->queryAll();
                }
                return $this->render('find_report',['dataList'=>$dataList,'format'=>$format,'year'=>$year]);
            }else if($format == 4){
                if($id){
                    $dataList = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_project_sub.prosub_code ="'.$id.'"')
                        ->queryAll();
                }else{
                    $dataList = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_project_sub.prosub_year ="'.$year.'"')
                        ->queryAll();
                }
                return $this->render('find_report',['dataList'=>$dataList,'format'=>$format,'year'=>$year]);
            }else if($format == 5){

                if($id){
                    $dataList = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_compact_has_prosub.status_result = "เสร็จสิ้น" AND pms_project_sub.prosub_code ="'.$id.'"')
                        ->queryAll();
                }else{
                    $dataList = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_compact_has_prosub.status_result = "เสร็จสิ้น" AND pms_project_sub.prosub_year ="'.$year.'"')
                        ->queryAll();
                }
                return $this->render('find_report',['dataList'=>$dataList,'format'=>$format,'year'=>$year]);
            }else if($format == 6){

                $dataList = PmsProjectSub::find()->where(['prosub_year'=>$year,'prosub_status_insystem'=>'in_system'])->all();
                return $this->render('find_report',['dataList'=>$dataList,'format'=>$format,'year'=>$year]);
            }
        }

        return $this->render('find_report',['dataList'=>$dataList,'yearNow'=>$yearNow]);
    }

    public function actionFindreportJs(){
        $year = Yii::$app->request->get('year');

        if($year == 0){
            echo "<option selected='selected' value='0'>กรุณาเลือกปีงบประมาณ</option>";
        }else{
            $data = PmsProjectSub::find()->where(['prosub_year'=>$year])->all();
            if($data){
                $content = "<option selected='selected' value='0'>เลือกโครงการ</option>";
                foreach ($data as $row){
                    $content = $content."<option value='".$row->prosub_code."'>".$row->prosub_name."</option>";
                }
                echo $content;
            }else{
                echo "<option selected='selected' value='0'>ไม่พบโครงการ</option>";
            }
        }


    }

    public function actionTest(){
        $modelprosub = new PmsProjectSub();
        $this->layout ="main_module";
        return $this->render('test',['modelprosub'=>$modelprosub]);

    }

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

    public function actionProsub(){
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        $id = Yii::$app->request->get('id');
        $prosub = PmsProjectSub::findOne($id);
        $project = PmsProject::findOne($prosub->pms_project_project_code);
        //$strategichaspro = PmsStrategicHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->one();
        $strategicIs = StrategicIssues::find()->where(['strategic_issues_id'=>$prosub->strategic_issues_id])->one();
        $strategic = Strategic::find()->where(['strategic_id'=>$prosub->strategic_id])->one();
        $governanceOfYear = PmsGovernanceOfYear::find()->distinct()->where(['year'=>$yearNow])->orderBy('governance_id')->all();
        $governancehaspro = PmsGovernanceHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $purpose = PmsPurpose::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $indicator = PmsIndicator::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $place = PmsPlace::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $costplane = PmsCostPlan::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $resultexpect = PmsResultExpect::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $effect = PmsEffect::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $problem = PmsProblem::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $probudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();

        $command = Yii::$app->get('db_pms')->createCommand("SELECT sum(cost_price) FROM pms_cost_plan WHERE pms_project_sub_prosub_code='".$id."'");
        $costplaneEng = $command->queryScalar();
        $costplaneTh = $this->Number($costplaneEng);

        $this->layout ="main_module";
        return $this->render('preview_prosub',['probudget'=>$probudget,'prosub'=>$prosub,'strategic'=>$strategic,'project'=>$project,
            'strategicIs'=>$strategicIs,'governanceOfYear'=>$governanceOfYear,'governancehaspro'=>$governancehaspro,
            'purpose'=>$purpose,'indicator'=>$indicator,'place'=>$place,'execute'=>$execute,'costplane'=>$costplane,
            'resultexpect'=>$resultexpect,'effect'=>$effect,'problem'=>$problem,'costplaneEng'=>$costplaneEng,'costplaneTh'=>$costplaneTh]);

    }

    public function actionCompactplace()
    {
        $id = Yii::$app->request->get('id');
        //$compact = Yii::$app->request->get('compact');

        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        //$modelcompacthasprosub = PmsCompactHasProsub::find()->where(['id'=>$compact,'pms_project_sub_prosub_code'=>$id])->one();
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->distinct(['budget_main'])->all();
        $probudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();

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
        //return yii\helpers\Json::encode($prosubbudget);
        $this->layout ="main_module";
        return $this->render('preview_compactplace',[
            'modelprosub'=>$modelprosub,'execute'=>$execute,
            'prosubbudget'=>$prosubbudget,
            'budget'=>$budget,'probudget'=>$probudget
        ]);
    }

    public function actionCompactbudget()
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
        return $this->render('preview_compactbudget',[
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

    public function actionCompactpandb()
    {
        $id = Yii::$app->request->get('id');
        $compact =Yii::$app->request->get('compact');
        date_default_timezone_set("Asia/Bangkok");
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($compact);
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
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
            if($data){
                $modelsExecuteCost[$key]=$data;
            }else{
                $modelsExecuteCost[$key]=[new PmsExecuteHasCost()];
            }
        }
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
        return $this->render('preview_compactpandb',[
            'modelprosub'=>$modelprosub,'execute'=>$execute,'modelcompacthasprosub'=>$modelcompacthasprosub,
            'prosubbudget'=>$prosubbudget,
            'modelsExecute' => $modelsExecute,
            //'modelsExecuteCost' => $modelsExecuteCost,
            'comhasexecute'=>$comhasexecute,
            'budget'=>$budget,
            'compact'=>$compact,
            'probudget'=>$probudget,'countComhasexecute'=>$countComhasexecute,
            'costplaneEng'=>$costplaneEng,
            'costplaneTh'=>$costplaneTh,
        ]);
    }

    public function actionProsubresult()
    {
        $id = Yii::$app->request->get('id');
        $id_compact = Yii::$app->request->get('id_compact');

        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        $modeldocument = PmsDocument::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($id_compact);
        $modelsPlace =  PmsPlace::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $governanceOfYear = PmsGovernanceOfYear::find()->distinct()->where(['year'=>$yearNow])->orderBy('governance_id')->all();
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $modelproblem = PmsResultProblem::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
//        if($modelproblem == null){
//            $modelproblem = [new PmsResultProblem];
//        }
        $modelsuggest = PmsResultSuggest::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
//        if($modelsuggest == null){
//            $modelsuggest = [new PmsResultSuggest];
//        }
        $modelresult = PmsResultQuality::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
//        if($modelresult == null){
//            $modelresult = [new PmsResultQuality];
//        }

        $modeltarget = PmsCompactHasTargetgroup::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
//        if($modeltarget == null){
//            $modeltarget = [new PmsCompactHasTargetgroup];
//        }

        $modelcomhasprosub = PmsCompactHasProsub::findOne($id_compact);
        $modelcompacthasmethod = PmsCompactHasMethod::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();

        $command = Yii::$app->get('db_pms')->createCommand("SELECT SUM(execute_cost) FROM pms_execute WHERE pms_execute.pms_project_sub_prosub_code = '".$id."'");
        $sumCost = $command->queryScalar();

        $this->layout ="main_module";
        return $this->render('preview_result'
            ,['modelprosub'=>$modelprosub,'modelsPlace'=>$modelsPlace,'governanceOfYear'=>$governanceOfYear,
                'modelproblem' => (empty($modelproblem)) ? [new PmsResultProblem] : $modelproblem,
                'modelsuggest' => (empty($modelsuggest)) ? [new PmsResultSuggest] : $modelsuggest,
                'modelresult' => (empty($modelresult)) ? [new PmsResultQuality] : $modelresult,
                'modeltarget' => (empty($modeltarget)) ? [new PmsCompactHasTargetgroup] : $modeltarget,
                'modelcomhasprosub'=>$modelcomhasprosub,
                'modelcompacthasmethod'=>$modelcompacthasmethod,
                'sumCost'=>$sumCost,
                'id'=>$id,
                'id_compact'=>$id_compact,
                'modelcompacthasprosub'=>$modelcompacthasprosub,
                'modeldocument' => $modeldocument,
            ]);
    }

    public function actionReportOfYear()
    {
        $year = Yii::$app->request->get('year');
        $dataList = PmsProjectSub::find()->where(['prosub_year'=>$year,'prosub_status_insystem'=>'in_system'])->all();
//        return $this->render('report_of_year',['dataList'=>$dataList,'year'=>$year]);


        $mpdf = new Mpdf([
            'format' => 'A4-L',
            /*'default_font' => 'thsarabunnew',*/
            'default_font' => 'thsarabunnew',
            'table_error_report' => false
        ]); // ขนาด A4 font Garuda

        $mpdf->WriteHTML($this->renderPartial('report_of_year',['dataList'=>$dataList,'year'=>$year])); // หน้า View สำหรับ export
        $mpdf->Output();
    }


}