<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 5/5/2561
 * Time: 22:51
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

class WordController extends Controller
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

    public function actionWordrespon(){

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
        return $this->render('wordrespon',['probudget'=>$probudget,'prosub'=>$prosub,'strategic'=>$strategic,'project'=>$project,
            'strategicIs'=>$strategicIs,'governanceOfYear'=>$governanceOfYear,'governancehaspro'=>$governancehaspro,
            'purpose'=>$purpose,'indicator'=>$indicator,'place'=>$place,'execute'=>$execute,'costplane'=>$costplane,
            'resultexpect'=>$resultexpect,'effect'=>$effect,'problem'=>$problem,'costplaneEng'=>$costplaneEng,'costplaneTh'=>$costplaneTh]);
    }

}