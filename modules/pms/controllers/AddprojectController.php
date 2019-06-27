<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 29/1/2561
 * Time: 16:10
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\PmsProject;
use yii;
use yii\web\Controller;

class AddprojectController extends Controller
{
    public function actionProjectyearAdd(){
        $modelproject = new PmsProject;
        if(Yii::$app->request->post()){
            $modelproject->load(Yii::$app->request->post());
            if($modelproject->save()){
                return $this->redirect('projectyear-show');
            }
        }
        $this->layout ="main_module";
        return $this->render('proyear_add',['modelproject'=>$modelproject]);
    }

    public function actionProjectyearUpdate($id){
        $modelproject = PmsProject::findOne($id);

        if(Yii::$app->request->post()){
            $modelproject->load(Yii::$app->request->post());
            if($modelproject->save()){
                return $this->redirect('projectyear-show');
            }
        }
        $this->layout ="main_module";
        return $this->render('proyear_update',['modelproject' => $modelproject]);
    }

    public function actionProjectyearDelete($id){
        $modelproject = PmsProject::findOne($id);
        $this->layout ="main_module";
        if($modelproject->delete()){
            return $this->redirect('projectyear-show');
        }else{
            echo 'Fale....' ;
        }

    }

    public function actionProjectyearShow(){


        $modelproject = new PmsProject;


        if(Yii::$app->request->post()){
            $modelproject->load(Yii::$app->request->post());
            if($modelproject->save()){
                return $this->redirect('projectyear-show');
            }
        }
        $project = PmsProject::find()->orderBy(['project_year'=>SORT_ASC])->all();
        $this->layout ="main_module";
        return $this->render('proyear_show',['project'=>$project,'modelproject'=>$modelproject]);
    }


}