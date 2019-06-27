<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 21/1/2561
 * Time: 0:34
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\BudgetMain;

use yii;
use yii\web\Controller;


class CustombudgetmainController extends Controller
{

    // INSERT UPDATE DELETE Budgetmain

    public function actionBudgetmainAdd(){
        $modelbudgetmain = new BudgetMain();
        $this->layout ="main_module";
        if(Yii::$app->request->post()){
            $modelbudgetmain->load(Yii::$app->request->post());
            if($modelbudgetmain->save()){
                return $this->redirect('budgetmain-show');
            }
        }
        return $this->render('budgetmain_add',['modelbudgetmain' =>$modelbudgetmain]);
    }

    public function actionBudgetmainUpdate($id){
        $modelbudgetmain = BudgetMain::findOne($id);
        $this->layout ="main_module";
        if(Yii::$app->request->post()){
            $modelbudgetmain->load(Yii::$app->request->post());
            if($modelbudgetmain->save()){
                return $this->redirect('budgetmain-show');
            }
        }
        return $this->render('budgetmain_update',['modelbudgetmain' =>$modelbudgetmain]);
    }

    public function actionBudgetmainDelete($id){

        $modelbudgetmain = BudgetMain::findOne($id);
        $this->layout ="main_module";
        if($modelbudgetmain->delete()){
            return $this->redirect('budgetmain-show');
        }else{
            echo 'Fale....' ;
        }

    }

    //-------------- END

    // SHOW Budgetmain

    public function actionBudgetmainShow(){
        $modelbudgetmain = new BudgetMain();
        $budgetmain = BudgetMain::find()->all();
        $this->layout ="main_module";
        if(Yii::$app->request->post()){
            $modelbudgetmain->load(Yii::$app->request->post());
            if($modelbudgetmain->save(false)){
                return $this->redirect('budgetmain-show');
            }
        }


        //return yii\helpers\Json::encode($budgetmain);

        return $this->render('budgetmain_show',['modelbudgetmain'=>$modelbudgetmain,'budgetmain'=>$budgetmain]);
    }

    //-------------- END
}