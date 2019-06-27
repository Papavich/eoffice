<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 21/1/2561
 * Time: 0:34
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\StrategicIssues;

use yii;
use yii\web\Controller;


class CustomstrategicissuesController extends Controller
{

    // INSERT UPDATE DELETE StrategicIssues

    public function actionStrategicissuesAdd(){
        $modelstrategicissues = new StrategicIssues();
        $this->layout ="main_module";
        if(Yii::$app->request->post()){
            $modelstrategicissues->load(Yii::$app->request->post());
            if($modelstrategicissues->save()){
                return $this->redirect('strategicissues-show');
            }
        }
        return $this->render('strategicissues_add',['modelstrategicissues' =>$modelstrategicissues]);
    }

    public function actionStrategicissuesUpdate($id){
        $modelstrategicissues = StrategicIssues::findOne($id);
        $this->layout ="main_module";
        if(Yii::$app->request->post()){
            $modelstrategicissues->load(Yii::$app->request->post());
            if($modelstrategicissues->save()){
                return $this->redirect('strategicissues-show');
            }
        }
        return $this->render('strategicissues_update',['modelstrategicissues' =>$modelstrategicissues]);
    }

    public function actionStrategicissuesDelete($id){

        $modelstrategicissues = StrategicIssues::findOne($id);
        $this->layout ="main_module";
        if($modelstrategicissues->delete()){
            return $this->redirect('strategicissues-show');
        }else{
            echo 'Fale....' ;
        }

    }

    //-------------- END

    // SHOW StrategicIssues

    public function actionStrategicissuesShow(){
        $modelstrategicissues = new StrategicIssues();
        $this->layout ="main_module";
        if(Yii::$app->request->post()){
            $modelstrategicissues->load(Yii::$app->request->post());
            if($modelstrategicissues->save()){
                return $this->redirect('strategicissues-show');
            }
        }
        $strategicissues = StrategicIssues::find()->all();
        $this->layout ="main_module";
        return $this->render('strategicissues_show',['strategicissues'=>$strategicissues,'modelstrategicissues'=>$modelstrategicissues]);
    }

    //-------------- END
}