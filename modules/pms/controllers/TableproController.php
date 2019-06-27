<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 22/11/2560
 * Time: 4:26
 */

namespace app\modules\pms\controllers;

use app\modules\pms\models\BudgetMain;
use app\modules\pms\models\LogPermisInSystem;
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

class TableproController extends Controller
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
    public function YearThai($strDate){
        $dateTh = Yii::$app->formatter->asDate($strDate, 'medium');
        $date = substr($dateTh, -4,4);
        $year = $date+543;
        $reDate = str_replace($date,$year,$dateTh);
        return $reDate;
    }


    public function actionTableWaitInSystem()
    {
        $user_id = Yii::$app->user->identity->id;
        $prosub = PmsProjectSub::find()->where(['prosub_responsible_id'=>$user_id])->all();
        $this->layout ="main_module";
        return $this->render('table_wait_in_system',['prosub'=>$prosub]);
    }

    public function actionTablePermisofferStaffInSystem()
    {
        $prosub = PmsProjectSub::find()->where(['prosub_status_offer'=>"รอฝ่ายพัฒนานักศึกษาตรวจสอบ"])->all();
        $this->layout ="main_module";
        return $this->render('table_permisoffer_staff_in_system',['prosub'=>$prosub]);
    }

    public function actionTablePermisofferManagerInSystem()
    {
        $prosub = PmsProjectSub::find()->where(['prosub_status_offer'=>"รอหัวหน้าภาคอนุมัติ"])->all();
        $this->layout ="main_module";
        return $this->render('table_permisoffer_manager_in_system',['prosub'=>$prosub]);
    }

    public function actionTablePermisofferPlannerInSystem()
    {
        $prosub = PmsProjectSub::find()->where(['prosub_status_offer'=>"รองานนโยบายและแผนอนุมัติ"])->all();
        $this->layout ="main_module";
        return $this->render('table_permisoffer_planner_in_system',['prosub'=>$prosub]);
    }


    public function actionGetstatusJs(){
        $id = Yii::$app->request->get('id');
        $modelLog = LogPermisInSystem::find()->where(['pms_project_sub_prosub_code'=>$id,'status_process'=>1])->all();
        $data="";
        if(sizeof($modelLog) != 0){
            foreach ($modelLog as $row){
                $data=$data."<tr><td>".$row->status."</td><td>".$row->event_date."</td><td>".$row->person."</td><td>".$row->comment."</td></tr>";
            }
        }else{
            $data="<tr><td colspan='4' class='text-center'>ไม่มีประวัติ</td></tr>";
        }
        echo $data;
    }

    public function actionDocCompactJs(){
        $id = Yii::$app->request->get('id');

        $modelLog = PmsCompactHasProsub::find()->where(['pms_project_sub_prosub_code'=>$id,'status_result'=>'เสร็จสิ้น'])->all();
        $prosub = PmsProjectSub::findOne($id);

        $data="";
        if(sizeof($modelLog) != 0){
            foreach ($modelLog as $row){
                if($row->start_date == null){
                    $start_date = $prosub->prosub_start_date;
                }else{
                    $start_date = $row->start_date;
                }
                $data=$data."<tr><td>จัดครั้งที่ ".$row->round.",".$this->YearThai($start_date)."</td><td><a href=\"../tablepro/prosubresult?id=".$row->pms_project_sub_prosub_code."&id_compact=".$row->id."\"><i class=\"glyphicon glyphicon-eye-open\"></i></a></td></tr>";
            }
        }else{
            $data="<tr><td colspan='4' class='text-center'>ไม่พบแบบสรุปโครงการ</td></tr>";
        }
        echo $data;
    }

    public function actionTableAllproject()
    {
        //$dataList = PmsProjectSub::find()->where(['prosub_year'=>'2561','prosub_status_insystem'=>'in_system'])->all();
        $prosub = PmsProjectSub::find()->where(['prosub_status_offer'=>'อนุมัติลงปีงบประมาณสำเร็จ'])->orderBy(['prosub_start_date'=>SORT_DESC])->all();
        $this->layout ="main_module";
        //return yii\helpers\Json::encode($prosub);
        return $this->render('table_all_project',['prosub'=>$prosub]);
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

    public function actionPermisStaff()
    {
        $prosub_offer = PmsProjectSub::find()->where(['prosub_status_offer'=>"รอฝ่ายพัฒนานักศึกษาตรวจสอบ"])->all();
        $prosub_place = $prosub = PmsProjectSub::find()->where(['compact_save'=>'true','prosub_status_place'=>'รอฝ่ายพัฒนานักศึกษาตรวจสอบ'])->all();
        $prosub_budget = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true" AND pms_compact_has_prosub.status_finance = "รอฝ่ายพัฒนานักศึกษาตรวจสอบ"')
            ->queryAll();
        $prosub_pandb = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4" AND pms_compact_has_prosub.status_pandf = "รอฝ่ายพัฒนานักศึกษาตรวจสอบ"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('permis_staff',['prosub_offer'=>$prosub_offer,'prosub_place'=>$prosub_place,'prosub_budget'=>$prosub_budget,'prosub_pandb'=>$prosub_pandb]);
    }

    public function actionPermisManager()
    {
        $prosub_offer = PmsProjectSub::find()->where(['prosub_status_offer'=>"รอหัวหน้าภาคอนุมัติ"])->all();
        $prosub_place = $prosub = PmsProjectSub::find()->where(['compact_save'=>'true','prosub_status_place'=>'รอหัวหน้าภาคอนุมัติ'])->all();
        $prosub_budget = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true" AND pms_compact_has_prosub.status_finance = "รอหัวหน้าภาคอนุมัติ"')
            ->queryAll();
        $prosub_pandb = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4" AND pms_compact_has_prosub.status_pandf = "รอหัวหน้าภาคอนุมัติ"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('permis_manager',['prosub_offer'=>$prosub_offer,'prosub_place'=>$prosub_place,'prosub_budget'=>$prosub_budget,'prosub_pandb'=>$prosub_pandb]);
    }

    public function actionPermisPlanner()
    {
        $prosub_offer = PmsProjectSub::find()->where(['prosub_status_offer'=>"รองานนโยบายและแผนอนุมัติ"])->all();
        $prosub_place = $prosub = PmsProjectSub::find()->where(['compact_save'=>'true','prosub_status_place'=>'รองานนโยบายและแผนอนุมัติ'])->all();
        $prosub_pandb = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4" AND pms_compact_has_prosub.status_pandf = "รองานนโยบายและแผนอนุมัติ"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('permis_planner',['prosub_offer'=>$prosub_offer,'prosub_place'=>$prosub_place,'prosub_pandb'=>$prosub_pandb]);
    }

    public function actionPermisFinance()
    {
       $prosub_budget = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true" AND pms_compact_has_prosub.status_finance = "รอการเงินอนุมัติ"')
            ->queryAll();
        $prosub_pandb = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4" AND pms_compact_has_prosub.status_pandf = "รอการเงินอนุมัติ"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('permis_finance',['prosub_budget'=>$prosub_budget,'prosub_pandb'=>$prosub_pandb]);
    }

    public function actionTrackProject()
    {
        $user_id = Yii::$app->user->identity->id;
        $prosub = PmsProjectSub::find()->where(['prosub_responsible_id'=>$user_id])->all();
        $prosub_place = PmsProjectSub::find()->where(['compact_save'=>'true','prosub_responsible_id'=>$user_id])->all();
        $prosub_budget = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true" AND pms_project_sub.prosub_responsible_id = "'.$user_id.'"')
            ->queryAll();
        $prosub_pandb = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4" AND pms_project_sub.prosub_responsible_id = "'.$user_id.'"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('track_project',['prosub'=>$prosub,
            'prosub_place'=>$prosub_place,
            'prosub_budget'=>$prosub_budget,
            'prosub_pandb'=>$prosub_pandb]);
    }
//------

}