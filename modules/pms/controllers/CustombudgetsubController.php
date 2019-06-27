<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 21/1/2561
 * Time: 21:18
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\BudgetMain;
use app\modules\pms\models\BudgetSub;

use yii;
use yii\web\Controller;


class CustombudgetsubController extends Controller
{
    // INSERT UPDATE DELETE BudgetSub

    public function actionBudgetsubAdd(){
        $modelbudgetsub = new BudgetSub();
        $this->layout ="main_module";
        if(Yii::$app->request->post()){
            $modelbudgetsub->load(Yii::$app->request->post());
            if($modelbudgetsub->save()){
                return $this->redirect('budgetsub-show');
            }
        }
        $modelBudgetmain = BudgetMain::find()->all();
        return $this->render('budgetsub_add',['modelbudgetsub' => $modelbudgetsub , 'modelBudgetmain' => $modelBudgetmain]);
    }

    public function actionBudgetsubUpdate($id){
        $array = explode("_",$id);
        $budgetsub_id =$array[0];
        $budgetmain_id =$array[1];
        $modelbudgetsub = BudgetSub::find()->where(['budget_id'=>$budgetsub_id,'budget_main_budget_id'=>$budgetmain_id])->one();

        $this->layout ="main_module";
        if(Yii::$app->request->post()){
            $modelbudgetsub->load(Yii::$app->request->post());
            if($modelbudgetsub->save()){
                return $this->redirect('budgetsub-show');
            }
        }
        $modelBudgetmain = BudgetMain::find()->all();
        return $this->render('budgetsub_update',['modelbudgetsub' =>$modelbudgetsub , 'modelBudgetmain' => $modelBudgetmain]);
    }

    public function actionBudgetsubDelete($id){
        $array = explode("_",$id);
        $budgetsub_id =$array[0];
        $budgetmain_id =$array[1];
        $modelbudgetsub = BudgetSub::find()->where(['budget_id'=>$budgetsub_id,'budget_main_budget_id'=>$budgetmain_id])->one();
        $this->layout ="main_module";
        if($modelbudgetsub->delete()){
            return $this->redirect('budgetsub-show');
        }else{
            echo 'Fale....' ;
        }

    }

    //-------------- END

    // SHOW BudgetSub

    public function actionBudgetsubShow(){
        $modelbudgetsub = new BudgetSub();
        if(Yii::$app->request->post()){
            $modelbudgetsub->load(Yii::$app->request->post());
            if($modelbudgetsub->save(false)){
                return $this->redirect('budgetsub-show');
            }
        }
        $modelBudgetmain = BudgetMain::find()->all();
        $budgetsub = BudgetSub::find()->orderBy('budget_main_budget_id')->all();
        $this->layout ="main_module";
        return $this->render('budgetsub_show',['budgetsub'=>$budgetsub,'modelBudgetmain'=>$modelBudgetmain,'modelbudgetsub'=>$modelbudgetsub]);
    }

    //-------------- END


}