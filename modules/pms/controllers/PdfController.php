<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 7/2/2561
 * Time: 19:07
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\BudgetMain;
use app\modules\pms\models\File;
use app\modules\pms\models\PmsCompactHasExecute;
use app\modules\pms\models\PmsCompactHasMethod;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsCompactHasTargetgroup;
use app\modules\pms\models\PmsCostPlan;
use app\modules\pms\models\PmsDocument;
use app\modules\pms\models\PmsEffect;
use app\modules\pms\models\PmsExecute;
use app\modules\pms\models\PmsExecuteHasCost;
use app\modules\pms\models\PmsGovernanceHasProjectSub;
use app\modules\pms\models\PmsGovernanceOfYear;
use app\modules\pms\models\PmsIndicator;
use app\modules\pms\models\PmsPlace;
use app\modules\pms\models\PmsProblem;
use app\modules\pms\models\PmsProblemResult;
use app\modules\pms\models\PmsProject;
use app\modules\pms\models\PmsProjectSub;
use app\modules\pms\models\PmsProjectsubBudget;
use app\modules\pms\models\PmsPurpose;
use app\modules\pms\models\PmsResultExpect;
use app\modules\pms\models\PmsResultProblem;
use app\modules\pms\models\PmsResultQuality;
use app\modules\pms\models\PmsResultSuggest;
use app\modules\pms\models\PmsStrategicHasProjectSub;
use app\modules\pms\models\PmsSuggestResult;
use app\modules\pms\models\PmsTargetgroup;
use app\modules\pms\models\Strategic;
use app\modules\pms\models\StrategicIssues;
use app\modules\pms\models\Year;
use app\modules\pms\models\ModelTarget;
use app\modules\pms\models\ModelResultq;
use app\modules\pms\models\ModelProblem;
use app\modules\pms\models\ModelSuggest;
use yii;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;
use Mpdf\Mpdf;



class PdfController extends Controller
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

    public function actionPdfrespon(){

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
//        $this->layout ="main_module";
//        return $this->render('word',['probudget'=>$probudget,'prosub'=>$prosub,'strategic'=>$strategic,'project'=>$project,
//            'strategicIs'=>$strategicIs,'governanceOfYear'=>$governanceOfYear,'governancehaspro'=>$governancehaspro,
//            'purpose'=>$purpose,'indicator'=>$indicator,'place'=>$place,'execute'=>$execute,'costplane'=>$costplane,
//            'resultexpect'=>$resultexpect,'effect'=>$effect,'problem'=>$problem]);
        $mpdf = new Mpdf([
            'format' => 'A4',
            //'default_font' => 'thsarabunnew',
            'default_font' => 'thsarabunnew',
            'table_error_report' => false
        ]); // ขนาด A4 font Garuda

        $mpdf->WriteHTML($this->renderPartial('prosub',['probudget'=>$probudget,'prosub'=>$prosub,'strategic'=>$strategic,'project'=>$project,
            'strategicIs'=>$strategicIs,'governanceOfYear'=>$governanceOfYear,'governancehaspro'=>$governancehaspro,
            'purpose'=>$purpose,'indicator'=>$indicator,'place'=>$place,'execute'=>$execute,'costplane'=>$costplane,
            'resultexpect'=>$resultexpect,'effect'=>$effect,'problem'=>$problem,'costplaneEng'=>$costplaneEng,'costplaneTh'=>$costplaneTh])); // หน้า View สำหรับ export
        $mpdf->Output();

    }

    public function actionCompactplace($id){
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

//        $this->layout ="main_module";
//        return $this->render('compactplace',[
//            'modelprosub'=>$modelprosub,'execute'=>$execute,'modelcompacthasprosub'=>$modelcompacthasprosub,
//            'prosubbudget'=>$prosubbudget,
//            'compact'=>$compact,'budget'=>$budget,'probudget'=>$probudget
//        ]);


        $mpdf = new Mpdf([
            'format' => 'A4',
          /*'default_font' => 'thsarabunnew',*/
           'default_font' => 'thsarabunnew',
           'table_error_report' => false
       ]); // ขนาด A4 font Garuda

       $mpdf->WriteHTML($this->renderPartial('compactplace',[
       'modelprosub'=>$modelprosub,'execute'=>$execute,
           'prosubbudget'=>$prosubbudget,
           'budget'=>$budget,'probudget'=>$probudget
      ])); // หน้า View สำหรับ export
        $mpdf->Output();
    }

    public function actionCompactpandb(){
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



        $mpdf = new Mpdf([
            'format' => 'A4',
            /*'default_font' => 'thsarabunnew',*/
            'default_font' => 'thsarabunnew',
            'table_error_report' => false
        ]); // ขนาด A4 font Garuda

        $mpdf->WriteHTML($this->renderPartial('compactpandb',[
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
        ])); // หน้า View สำหรับ export
        $mpdf->Output();

    }

    public function actionCompactbudget($id,$compact){

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

        $mpdf = new Mpdf([
            'format' => 'A4',
            /*'default_font' => 'thsarabunnew',*/
            'default_font' => 'thsarabunnew',
            'table_error_report' => false
        ]); // ขนาด A4 font Garuda

        $mpdf->WriteHTML($this->renderPartial('compactbudget',[
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
        ])); // หน้า View สำหรับ export
        $mpdf->Output();
    }

    public function actionResult($id,$compact){

        $model_file = new File;
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        $modeldocument = PmsDocument::find()->where(['pms_compact_has_prosub_id'=>$compact])->all();
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($compact);
        $modelsPlace =  PmsPlace::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $governanceOfYear = PmsGovernanceOfYear::find()->distinct()->where(['year'=>$yearNow])->orderBy('governance_id')->all();
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $modelproblem = PmsResultProblem::find()->where(['pms_compact_has_prosub_id'=>$compact])->all();

        $modelsuggest = PmsResultSuggest::find()->where(['pms_compact_has_prosub_id'=>$compact])->all();

        $modelresult = PmsResultQuality::find()->where(['pms_compact_has_prosub_id'=>$compact])->all();


        $modeltarget = PmsCompactHasTargetgroup::find()->where(['pms_compact_has_prosub_id'=>$compact])->all();


        $modelcomhasprosub = PmsCompactHasProsub::findOne($compact);
        $modelcompacthasmethod = PmsCompactHasMethod::find()->where(['pms_compact_has_prosub_id'=>$compact])->all();

        $command = Yii::$app->get('db_pms')->createCommand("SELECT SUM(execute_cost) FROM pms_execute WHERE pms_execute.pms_project_sub_prosub_code = '".$id."'");
        $sumCost = $command->queryScalar();

        $mpdf = new Mpdf([
            'format' => 'A4',
            /*'default_font' => 'thsarabunnew',*/
            'default_font' => 'thsarabunnew',
            'table_error_report' => false
        ]); // ขนาด A4 font Garuda

        $mpdf->WriteHTML($this->renderPartial('result'
            ,['modelprosub'=>$modelprosub,'modelsPlace'=>$modelsPlace,'governanceOfYear'=>$governanceOfYear,
                'modelproblem' => (empty($modelproblem)) ? [new PmsResultProblem] : $modelproblem,
                'modelsuggest' => (empty($modelsuggest)) ? [new PmsResultSuggest] : $modelsuggest,
                'modelresult' => (empty($modelresult)) ? [new PmsResultQuality] : $modelresult,
                'modeltarget' => (empty($modeltarget)) ? [new PmsCompactHasTargetgroup] : $modeltarget,
                'model_file'=>$model_file,
                'modelcomhasprosub'=>$modelcomhasprosub,
                'modelcompacthasmethod'=>$modelcompacthasmethod,
                'sumCost'=>$sumCost,
                'id'=>$id,
                'compact'=>$compact,
                'modelcompacthasprosub'=>$modelcompacthasprosub,
                'modeldocument' => $modeldocument,
            ])); // หน้า View สำหรับ export
        $mpdf->Output();
    }


}