<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 5/3/2561
 * Time: 16:29
 */

namespace app\modules\pms\controllers;


use app\modules\pms\models\BudgetMain;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsExecute;
use app\modules\pms\models\PmsProjectSub;
use app\modules\pms\models\PmsProjectsubBudget;
use yii;
use yii\web\Controller;


class DetailcompactplaceController extends Controller
{
    public function actionDetail()
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
        return $this->render('detail_place',[
            'modelprosub'=>$modelprosub,'execute'=>$execute,
            'prosubbudget'=>$prosubbudget,
            'budget'=>$budget,'probudget'=>$probudget
        ]);
    }

    public function actionDetailStaff($id)
    {
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
        return $this->render('detail_place_staff',[
            'modelprosub'=>$modelprosub,'execute'=>$execute,
            'prosubbudget'=>$prosubbudget,
            'budget'=>$budget,'probudget'=>$probudget
        ]);
    }

    public function actionDetailManager($id)
    {
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
        return $this->render('detail_place_manager',[
            'modelprosub'=>$modelprosub,'execute'=>$execute,
            'prosubbudget'=>$prosubbudget,
            'budget'=>$budget,'probudget'=>$probudget
        ]);
    }

    public function actionDetailPlanner($id)
    {
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
        return $this->render('detail_place_planner',[
            'modelprosub'=>$modelprosub,'execute'=>$execute,
            'prosubbudget'=>$prosubbudget,
            'budget'=>$budget,'probudget'=>$probudget
        ]);
    }
}