<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 22/11/2560
 * Time: 5:03
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\PmsProject;
use app\modules\pms\models\PmsProjectSub;
use app\modules\pms\models\PmsProjectsubBudgets;
use app\modules\pms\models\PmsProjectsubBudgetss;
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
use app\modules\pms\models\StrategicIssues;
use yii;
use yii\web\Controller;

class DetailinproController extends Controller
{
    public function actionDetailproget(){
        $id = Yii::$app->request->get('SKftR9');
        return $this->redirect('../detailpro/detailpro',['id'=>$id]);
    }

    public function actionDetailpro(){
        $id = Yii::$app->request->get('id');
        $prosub = PmsProjectSub::findOne($id);
        $project = PmsProject::findOne($prosub->pms_project_project_code);
        $strategichaspro = PmsStrategicHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->one();
        if($strategichaspro){
            $strategic = "";
            $strategicIs = StrategicIssues::find()->where(['strategic_issues_id'=>$strategichaspro->strategic_issues_id])->one();
        }else{
            $strategic = "";
            $strategicIs = "";
        }

        $governance = PmsGovernance::find()->where(['governance_status'=>'active'])->all();
        $governancehaspro = PmsGovernanceHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $purpose = PmsPurpose::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $indicator = PmsIndicator::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $place = PmsPlace::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $costplane = PmsCostPlan::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $resultexpect = PmsResultExpect::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $effect = PmsEffect::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $problem = PmsProblem::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudgets = PmsProjectsubBudgets::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudgetss = PmsProjectsubBudgetss::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
//        foreach ($prosubbudget as $rows){
//            $prosubbudgetsub = PmsBudgetSub::find()->where(['budgetsub_id'=>$rows['pms_budget_sub_budgetsub_id']])->one();
//            echo "=".$prosubbudgetsub->budgetsub_name." ".$rows['pms_projectsub_budget_limit']."<br>";
//        }
        $this->layout ="main_module";
        return $this->render('word_is',['prosubbudgets'=>$prosubbudgets,'prosubbudgetss'=>$prosubbudgetss,'strategichaspro'=>$strategichaspro,'prosub'=>$prosub,'strategic'=>$strategic,'project'=>$project,
            'strategicIs'=>$strategicIs,'governance'=>$governance,'governancehaspro'=>$governancehaspro,
            'purpose'=>$purpose,'indicator'=>$indicator,'place'=>$place,'execute'=>$execute,'costplane'=>$costplane,
            'resultexpect'=>$resultexpect,'effect'=>$effect,'prosubbudget'=>$prosubbudget,'problem'=>$problem]);

    }

    public function actionDetailprostaff(){
        $id = Yii::$app->request->get('id');
        $prosub = PmsProjectSub::findOne($id);
        $project = PmsProject::findOne($prosub->pms_project_project_code);
        $strategichaspro = PmsStrategicHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->one();
        if($strategichaspro){
            $strategic = "";
            $strategicIs = StrategicIssues::find()->where(['strategic_issues_id'=>$strategichaspro->strategic_issues_id])->one();
        }else{
            $strategic = "";
            $strategicIs = "";
        }
        $governance = PmsGovernance::find()->where(['governance_status'=>'active'])->all();
        $governancehaspro = PmsGovernanceHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $purpose = PmsPurpose::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $indicator = PmsIndicator::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $place = PmsPlace::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $costplane = PmsCostPlan::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $resultexpect = PmsResultExpect::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $effect = PmsEffect::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $problem = PmsProblem::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudgets = PmsProjectsubBudgets::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudgetss = PmsProjectsubBudgetss::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
//        foreach ($prosubbudget as $rows){
//            $prosubbudgetsub = PmsBudgetSub::find()->where(['budgetsub_id'=>$rows['pms_budget_sub_budgetsub_id']])->one();
//            echo "=".$prosubbudgetsub->budgetsub_name." ".$rows['pms_projectsub_budget_limit']."<br>";
//        }

        $this->layout ="main_module";
        $this->view->params['page'] = 'editform';
        $this->view->params['active'] = '';
        return $this->render('word_is_staff',['prosubbudgets'=>$prosubbudgets,'prosubbudgetss'=>$prosubbudgetss,'strategichaspro'=>$strategichaspro,'prosub'=>$prosub,'strategic'=>$strategic,'project'=>$project,
            'strategicIs'=>$strategicIs,'governance'=>$governance,'governancehaspro'=>$governancehaspro,
            'purpose'=>$purpose,'indicator'=>$indicator,'place'=>$place,'execute'=>$execute,'costplane'=>$costplane,
            'resultexpect'=>$resultexpect,'effect'=>$effect,'prosubbudget'=>$prosubbudget,'problem'=>$problem]);

    }

    public function actionDetailproplanner(){
        $id = Yii::$app->request->get('id');
        $prosub = PmsProjectSub::findOne($id);
        $project = PmsProject::findOne($prosub->pms_project_project_code);
        $strategichaspro = PmsStrategicHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->one();
        if($strategichaspro){
            $strategic = "";
            $strategicIs = StrategicIssues::find()->where(['strategic_issues_id'=>$strategichaspro->strategic_issues_id])->one();
        }else{
            $strategic = "";
            $strategicIs = "";
        }
        $governance = PmsGovernance::find()->where(['governance_status'=>'active'])->all();
        $governancehaspro = PmsGovernanceHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $purpose = PmsPurpose::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $indicator = PmsIndicator::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $place = PmsPlace::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $costplane = PmsCostPlan::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $resultexpect = PmsResultExpect::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $effect = PmsEffect::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $problem = PmsProblem::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudgets = PmsProjectsubBudgets::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudgetss = PmsProjectsubBudgetss::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
//        foreach ($prosubbudget as $rows){
//            $prosubbudgetsub = PmsBudgetSub::find()->where(['budgetsub_id'=>$rows['pms_budget_sub_budgetsub_id']])->one();
//            echo "=".$prosubbudgetsub->budgetsub_name." ".$rows['pms_projectsub_budget_limit']."<br>";
//        }

        $this->layout ="main_module";
        return $this->render('word_is_planner',['prosubbudgets'=>$prosubbudgets,'prosubbudgetss'=>$prosubbudgetss,'strategichaspro'=>$strategichaspro,'prosub'=>$prosub,'strategic'=>$strategic,'project'=>$project,
            'strategicIs'=>$strategicIs,'governance'=>$governance,'governancehaspro'=>$governancehaspro,
            'purpose'=>$purpose,'indicator'=>$indicator,'place'=>$place,'execute'=>$execute,'costplane'=>$costplane,
            'resultexpect'=>$resultexpect,'effect'=>$effect,'prosubbudget'=>$prosubbudget,'problem'=>$problem]);

    }

    public function actionDetailprofinance(){
        $id = Yii::$app->request->get('id');
        $prosub = PmsProjectSub::findOne($id);
        $project = PmsProject::findOne($prosub->pms_project_project_code);
        $strategichaspro = PmsStrategicHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->one();
        if($strategichaspro){
            $strategic = "";
            $strategicIs = StrategicIssues::find()->where(['strategic_issues_id'=>$strategichaspro->strategic_issues_id])->one();
        }else{
            $strategic = "";
            $strategicIs = "";
        }
        $governance = PmsGovernance::find()->where(['governance_status'=>'active'])->all();
        $governancehaspro = PmsGovernanceHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $purpose = PmsPurpose::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $indicator = PmsIndicator::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $place = PmsPlace::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $costplane = PmsCostPlan::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $resultexpect = PmsResultExpect::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $effect = PmsEffect::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $problem = PmsProblem::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudgets = PmsProjectsubBudgets::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudgetss = PmsProjectsubBudgetss::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
//        foreach ($prosubbudget as $rows){
//            $prosubbudgetsub = PmsBudgetSub::find()->where(['budgetsub_id'=>$rows['pms_budget_sub_budgetsub_id']])->one();
//            echo "=".$prosubbudgetsub->budgetsub_name." ".$rows['pms_projectsub_budget_limit']."<br>";
//        }

        $this->layout ="main_module";

        return $this->render('word_is_finance',['prosubbudgets'=>$prosubbudgets,'prosubbudgetss'=>$prosubbudgetss,'strategichaspro'=>$strategichaspro,'prosub'=>$prosub,'strategic'=>$strategic,'project'=>$project,
            'strategicIs'=>$strategicIs,'governance'=>$governance,'governancehaspro'=>$governancehaspro,
            'purpose'=>$purpose,'indicator'=>$indicator,'place'=>$place,'execute'=>$execute,'costplane'=>$costplane,
            'resultexpect'=>$resultexpect,'effect'=>$effect,'prosubbudget'=>$prosubbudget,'problem'=>$problem]);

    }

    public function actionDetailpromanager(){
        $id = Yii::$app->request->get('id');
        $prosub = PmsProjectSub::findOne($id);
        $project = PmsProject::findOne($prosub->pms_project_project_code);
        $strategichaspro = PmsStrategicHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->one();
        if($strategichaspro){
            $strategic = "";
            $strategicIs = StrategicIssues::find()->where(['strategic_issues_id'=>$strategichaspro->strategic_issues_id])->one();
        }else{
            $strategic = "";
            $strategicIs = "";
        }
        $governance = PmsGovernance::find()->where(['governance_status'=>'active'])->all();
        $governancehaspro = PmsGovernanceHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $purpose = PmsPurpose::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $indicator = PmsIndicator::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $place = PmsPlace::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $costplane = PmsCostPlan::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $resultexpect = PmsResultExpect::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $effect = PmsEffect::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $problem = PmsProblem::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudgets = PmsProjectsubBudgets::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
        $prosubbudgetss = PmsProjectsubBudgetss::find()->where(['pms_project_sub_prosub_code'=>$prosub->prosub_code])->all();
//        foreach ($prosubbudget as $rows){
//            $prosubbudgetsub = PmsBudgetSub::find()->where(['budgetsub_id'=>$rows['pms_budget_sub_budgetsub_id']])->one();
//            echo "=".$prosubbudgetsub->budgetsub_name." ".$rows['pms_projectsub_budget_limit']."<br>";
//        }

        $this->layout ="main_module";
        return $this->render('word_is_manager',['prosubbudgets'=>$prosubbudgets,'prosubbudgetss'=>$prosubbudgetss,'strategichaspro'=>$strategichaspro,'prosub'=>$prosub,'strategic'=>$strategic,'project'=>$project,
            'strategicIs'=>$strategicIs,'governance'=>$governance,'governancehaspro'=>$governancehaspro,
            'purpose'=>$purpose,'indicator'=>$indicator,'place'=>$place,'execute'=>$execute,'costplane'=>$costplane,
            'resultexpect'=>$resultexpect,'effect'=>$effect,'prosubbudget'=>$prosubbudget,'problem'=>$problem]);

    }
}