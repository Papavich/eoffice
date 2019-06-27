<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 21/1/2561
 * Time: 21:18
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\PmsStrategicOfYear;
use app\modules\pms\models\StrategicIssues;
use app\modules\pms\models\Strategic;
use app\modules\pms\models\Year;

use yii;
use yii\web\Controller;


class CustomstrategicController extends Controller
{
    // INSERT UPDATE DELETE STRATEGIC

    public function actionStrategicAdd(){
        $modelstrategic = new Strategic();
        $this->layout ="main_module";
        if(Yii::$app->request->post()){
            $modelstrategic->load(Yii::$app->request->post());
            if($modelstrategic->save()){
                return $this->redirect('strategic-show');
            }
        }
        $modelstrategicissues = StrategicIssues::find()->all();
        return $this->render('strategic_add',['modelstrategic' => $modelstrategic , 'modelstrategicissues' => $modelstrategicissues]);
    }

    public function actionStrategicUpdate($id){
        $array = explode("_",$id);
        $strategic_id =$array[0];
        $strategic_issues_id =$array[1];
        $modelstrategic = Strategic::find()->where(['strategic_id'=>$strategic_id,'strategic_issues_strategic_issues_id'=>$strategic_issues_id])->one();

        $this->layout ="main_module";
        if(Yii::$app->request->post()){
            $modelstrategic->load(Yii::$app->request->post());
            if($modelstrategic->save()){
                return $this->redirect('strategic-show');
            }
        }
        $modelstrategicissues = StrategicIssues::find()->all();
        return $this->render('strategic_update',['modelstrategic' =>$modelstrategic , 'modelstrategicissues' => $modelstrategicissues]);
    }

    public function actionStrategicDelete($id){
        $array = explode("_",$id);
        $strategic_id =$array[0];
        $strategic_issues_id =$array[1];
        $modelstrategic = Strategic::find()->where(['strategic_id'=>$strategic_id,'strategic_issues_strategic_issues_id'=>$strategic_issues_id])->one();
        $this->layout ="main_module";
        if($modelstrategic->delete()){
            return $this->redirect('strategic-show');
        }else{
            echo 'Fale....' ;
        }

    }

    //-------------- END

    // SHOW STRATEGIC

    public function actionStrategicShow(){
        $modelstrategic = new Strategic();
        if(Yii::$app->request->post()){
            $modelstrategic->load(Yii::$app->request->post());
            if($modelstrategic->save()){
                return $this->redirect('strategic-show');
            }
        }
        $modelstrategicissues = StrategicIssues::find()->all();
        $strategic = Strategic::find()->orderBy('strategic_issues_strategic_issues_id')->all();
        $this->layout ="main_module";
        return $this->render('strategic_show',['strategic'=>$strategic,'modelstrategicissues'=>$modelstrategicissues,'modelstrategic'=>$modelstrategic]);
    }

    //-------------- END

    // CHECK  STRATEGIC
    public function actionStrategicCheck(){
        $strategicissues = StrategicIssues::find()->all();
        $dis = Strategic::find()->select(['strategic_issues_strategic_issues_id'])->distinct()->all();
        $strategic = Strategic::find()->orderBy('strategic_issues_strategic_issues_id')->all();
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        $this->layout ="main_module";
        return $this->render('strategic_check',['strategic'=>$strategic,'strategicissues'=>$strategicissues,'dis'=>$dis,'yearNow'=>$yearNow]);
    }

    public function actionStrategicJs(){
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        $year = Yii::$app->request->get('year');

        $dis = Strategic::find()->select(['strategic_issues_strategic_issues_id'])->distinct()->all();
        $strategic = PmsStrategicOfYear::find()->where(['year'=>$year])->all();
        $strategicAll = Strategic::find()->all();
        $strategicShow="";

        foreach ($dis as $key => $rows2) {
            $data = StrategicIssues::findOne($rows2->strategic_issues_strategic_issues_id);
            $strategicShow = $strategicShow." <div class=\"col-md-12 col-sm-12\">ประเด็นยุทธศาสตร์ที่ " . $data->strategic_issues_id . " " . $data->strategic_issues_name . "<br></div>";

            if(sizeof($strategic)==0){
                foreach ($strategicAll as $rows){
                    if($rows2->strategic_issues_strategic_issues_id==$rows->strategic_issues_strategic_issues_id) {
                        $strategicShow = $strategicShow."<div class=\"col-md-6 col-sm-6\">
                            <label class=\"checkbox\">
                                <input type=\"checkbox\" name=\"strategiccheck[]\" value=\"". $rows->strategic_issues_strategic_issues_id.$rows->strategic_id."\">
                                <i></i>".$rows->strategic_name."
                            </label>
                        </div>";
                    }
                }
            }
            else{
                $strategicAllIn = Strategic::find()->where(['strategic_issues_strategic_issues_id'=>$data->strategic_issues_id])->all();
                foreach ($strategicAllIn as $key => $items){
                    $count = 0;
                    //foreach ($strategic as $keys => $rows){
//                    $strategicCheck = PmsStrategicOfYear::find()->where(['year'=>$year],['strategic_issues_id'=>$items['strategic_issues_strategic_issues_id']],['strategic_id'=>$items['strategic_id']])->one();
                    $strategicCheck = PmsStrategicOfYear::find()->where(['year'=>$year,'strategic_issues_id'=>$items['strategic_issues_strategic_issues_id'],'strategic_id'=>$items['strategic_id']])->one();
                    //}
                    if($year <=$yearNow){
                        if($strategicCheck) {
                            $strategicShow = $strategicShow . "<div class=\"col-md-6 col-sm-6\">
                                <label class=\"checkbox\">
                                    <input type=\"checkbox\" checked name=\"strategiccheck[]\" disabled='disabled' value=\"" . $items->strategic_issues_strategic_issues_id .$items->strategic_id . "\">
                                    <i></i>" . $items->strategic_name . "
                                </label>
                            </div>";
                        }else{
                            $strategicShow = $strategicShow . "<div class=\"col-md-6 col-sm-6\">
                                <label class=\"checkbox\">
                                    <input type=\"checkbox\" name=\"strategiccheck[]\" disabled='disabled' value=\"" . $items->strategic_issues_strategic_issues_id .$items->strategic_id . "\">
                                    <i></i>" . $items->strategic_name . "
                                </label>
                            </div>";
                        }
                    }else{
                        if($strategicCheck) {
                            $strategicShow = $strategicShow . "<div class=\"col-md-6 col-sm-6\">
                                <label class=\"checkbox\">
                                    <input type=\"checkbox\" checked name=\"strategiccheck[]\" value=\"" . $items->strategic_issues_strategic_issues_id .$items->strategic_id . "\">
                                    <i></i>" . $items->strategic_name . "
                                </label>
                            </div>";
                        }else{
                            $strategicShow = $strategicShow . "<div class=\"col-md-6 col-sm-6\">
                                <label class=\"checkbox\">
                                    <input type=\"checkbox\" name=\"strategiccheck[]\" value=\"" . $items->strategic_issues_strategic_issues_id .$items->strategic_id . "\">
                                    <i></i>" . $items->strategic_name . "
                                </label>
                            </div>";
                        }
                    }

                }
            }
            $strategicShow = $strategicShow."<div class=\"col-md-12 col-sm-12\"><br></div>";
        }
        echo $strategicShow;

    }

    public function actionSavecheck(){
        $year = Yii::$app->request->post('year');
        $strategic = Yii::$app->request->post('strategiccheck');
        //$strategicissuescheck = Yii::$app->request->post('strategicissuescheck');

        PmsStrategicOfYear::deleteAll(['year'=>$year]);

        if($strategic != null && $year != null){
            foreach ($strategic as $key => $item) {
                $tmp = new PmsStrategicOfYear;
//                echo $tmp->year = $year."<br>";
//                $strategicSub = substr($item, 1);
//                $strategicissuesSub = substr($item, 0,1);
//                echo $tmp->strategic_issues_id = $strategicissuesSub."<br>";
//                echo $tmp->strategic_id = $strategicSub."<br>";
                $tmp->year = $year;
                $strategicSub = substr($item, 1);
                $strategicissuesSub = substr($item, 0,1);
                $tmp->strategic_issues_id = $strategicissuesSub;
                $tmp->strategic_id = $strategicSub;
                $tmp->save();
            }

        }
        return $this->redirect('strategic-check');
    }
    //-------------- END
}