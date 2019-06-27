<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 12/2/2561
 * Time: 21:38
 */

namespace app\modules\pms\controllers;


use app\modules\pms\models\BudgetMain;
use app\modules\pms\models\Model;
use app\modules\pms\models\model_main\EofficeCentralViewPisBoardOfDirectors;
use app\modules\pms\models\ModelExecute;
use app\modules\pms\models\PmsCompact;
use app\modules\pms\models\PmsCompactHasExecute;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsCompactHasTargetgroup;
use app\modules\pms\models\PmsExecute;
use app\modules\pms\models\PmsExecuteHasCost;
use app\modules\pms\models\PmsProblem;
use app\modules\pms\models\PmsProjectSub;
use app\modules\pms\models\PmsProjectsubBudget;
use app\modules\pms\models\PmsProjectsubBudgets;
use app\modules\pms\models\PmsProjectsubBudgetss;
use PHPUnit\Util\Log\JSON;
use yii;
use yii\web\Controller;


class CompactController extends Controller
{
    public function actionCompactplanSelect(){
        $user_id = Yii::$app->user->identity->id;
        $listProsub = PmsProjectSub::find()->where(['compact_save'=>'false','prosub_status_insystem'=>'in_system','prosub_responsible_id'=>$user_id])->all();
        $this->layout ="main_module";
        return $this->render('compactplan_select',['listProsub'=>$listProsub]);
    }

    public function actionCompactbudgetSelect(){
        $user_id = Yii::$app->user->identity->id;
        $listProsub = PmsProjectSub::find()->where(['compact_save'=>'true','prosub_responsible_id'=>$user_id,'prosub_status_place'=>'อนุมัติสำเร็จ'])->all();
        $this->layout ="main_module";
        return $this->render('compactbudget_select',['listProsub'=>$listProsub]);
    }

    public function actionCompactPandbSelect(){
        $user_id = Yii::$app->user->identity->id;
        $listProsub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub  WHERE (pms_project_sub.compact_save = "true_pb" OR (pms_project_sub.compact_save = "false" AND pms_project_sub.prosub_status_insystem = "in_system"))  AND pms_project_sub.prosub_responsible_id = "'.$user_id.'"')
            ->queryAll();
        //$listProsub = PmsProjectSub::find()->where(['compact_save'=>'false','prosub_status_insystem'=>'in_system'])->orWhere(['compact_save'=>'true_pb'])->all();
        $this->layout ="main_module";
        return $this->render('compactpandb_select',['listProsub'=>$listProsub]);
    }

    //-------------- NEW 101

    public function actionAddcompactplan()
    {
        $id = Yii::$app->request->post('id');
        date_default_timezone_set("Asia/Bangkok");
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        //return yii\helpers\Json::encode($id);
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $check = PmsCompactHasProsub::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $modelcompacthasprosub = new PmsCompactHasProsub();
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $datah = EofficeCentralViewPisBoardOfDirectors::find()->select('person_id')->distinct()->all();
        foreach ($datah as $row){
            $datas = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id'=>$row->person_id])->orderBy(['period_describe'=>SORT_DESC])->one();
            //echo $datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")<br>";
            $manager[$row->person_id]=$datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")";
        }
        if ($modelprosub->load(Yii::$app->request->post())) {
            $modelprosub->compact_save = "true";
            $modelprosub->compact_save_date = date("Y-m-d H:i:s");
            $modelprosub->save(false);
            return $this->redirect(['detailcompactplace/detail?id='.$id]);
        }
        $this->layout ="main_module";
        return $this->render('compactplan_add',[
            'modelprosub'=>$modelprosub,'execute'=>$execute,'modelcompacthasprosub'=>$modelcompacthasprosub,
            'prosubbudget'=>$prosubbudget,
            'manager'=>$manager,
        ]);
    }

    public function actionEditcompactplan($id)
    {
        date_default_timezone_set("Asia/Bangkok");
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        //$modelcompacthasprosub = PmsCompactHasProsub::find()->where(['id'=>$compact,'pms_project_sub_prosub_code'=>$id])->one();
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $datah = EofficeCentralViewPisBoardOfDirectors::find()->select('person_id')->distinct()->all();
        foreach ($datah as $row){
            $datas = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id'=>$row->person_id])->orderBy(['period_describe'=>SORT_DESC])->one();
            //echo $datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")<br>";
            $manager[$row->person_id]=$datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")";
        }
        if ($modelprosub->load(Yii::$app->request->post())) {
            $modelprosub->compact_save = "true";
            $modelprosub->compact_save_date = date("Y-m-d H:i:s");
            if($modelprosub->prosub_status_place == "รอปรับแก้ไขโครงการ"){
                $modelprosub->prosub_status_place = "ยังไม่ดำเนินการ";
            }
            $modelprosub->save(false);
            return $this->redirect(['detailcompactplace/detail?id='.$id]);

        }
        $this->layout ="main_module";
        return $this->render('compactplan_edit',[
            'modelprosub'=>$modelprosub,'execute'=>$execute,
            'prosubbudget'=>$prosubbudget,
            'manager'=>$manager,
        ]);
    }

    //-------------- END 101

    //-------------- NEW 201

    public function actionSaveexecute(){
        $modelsExecuteCost = Yii::$app->request->post('PmsExecuteHasCost');
        $compact = Yii::$app->request->post('compact');
        $id = Yii::$app->request->post('id');
        $comhasexecute = PmsCompactHasExecute::find()->where(['pms_compact_has_prosub_id'=>$compact])->all();
        $comhasprosub = PmsCompactHasProsub::find()->where(['id'=>$compact])->one();
        PmsExecuteHasCost::deleteAll(['pms_compact_has_prosub_id'=>$compact]);
//        $modelExhasCost = PmsExecuteHasCost::find()->where(['pms_compact_has_prosub_id'=>$compact])->all();
//        $modelExhasCost->delete();
        for ($i=0;$i<sizeof($comhasexecute);$i++){
            echo $comhasexecute[$i]['pms_compact_has_prosub_id']." ".$comhasexecute[$i]['pms_execute_execute_id']." ".$i."-----------------<br>";
            foreach ($modelsExecuteCost[$i] as $key =>$item){
                echo $item['detail']." ".$item['cost']."<br>";
                $model = new PmsExecuteHasCost();
                $model->detail = $item['detail'];
                $model->cost = $item['cost'];
                $model->pms_compact_has_prosub_id = $comhasexecute[$i]['pms_compact_has_prosub_id'];
                $model->pms_execute_execute_id = $comhasexecute[$i]['pms_execute_execute_id'];
                if($item['detail'] != null){
                    $model->save(false);
                }
            }
        }
        if($comhasprosub->status_finance == "รอปรับแก้ไขโครงการ"){
            $comhasprosub->status_finance = "ยังไม่ดำเนินการ";
        }
        $comhasprosub->compact_save = "true";
        $comhasprosub->save();
        return $this->redirect(['detailcompactbudget/detail?id='.$id.'&compact='.$compact]);

    }

    public function actionPreviouscompactbudget(){
        $compact = Yii::$app->request->get('compact');
        $id = Yii::$app->request->get('id');
        $modelcompacthasprosub = PmsCompactHasProsub::find()->where(['id'=>$compact])->one();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $datah = EofficeCentralViewPisBoardOfDirectors::find()->select('person_id')->distinct()->all();
        foreach ($datah as $row){
            $datas = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id'=>$row->person_id])->orderBy(['period_describe'=>SORT_DESC])->one();
            //echo $datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")<br>";
            $manager[$row->person_id]=$datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")";
        }
        $this->layout ="main_module";
        return $this->render('compactbudget_add',[
            'modelcompacthasprosub'=>$modelcompacthasprosub,
            'execute'=>$execute,
            'id'=>$id,
            'compact'=>$compact,
            'manager'=>$manager,
        ]);

    }

    public function actionNextcompactbudget(){
        $id = Yii::$app->request->post('id');
        $compact = Yii::$app->request->post('compact');
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($compact);
        if($modelcompacthasprosub->load(Yii::$app->request->post())) {
            $check = PmsCompactHasProsub::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
//            if(Yii::$app->request->post('compact')){
//                $compact = Yii::$app->request->post('compact');
//                $modelcompacthasprosub->id = $compact;
//            }
            if($compact == null){
                $modelcompacthasprosub->round = sizeof($check)+1;
            }
            $modelcompacthasprosub->pms_project_sub_prosub_code = $id;
            $modelcompacthasprosub->status_process = 3;
            $modelcompacthasprosub->save_date = date("Y-m-d H:i:s");
            $modelcompacthasprosub->save(false);
            //PmsCompactHasExecute::deleteAll(['pms_compact_has_prosub_id'=>$modelcompacthasprosub->id]);
            $executecheck = Yii::$app->request->post('executecheck');
            $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
            if($executecheck != null){
                foreach ($execute as $rows){
                    $i = 0;
                    foreach ($executecheck as $row){
                        if($rows->execute_id == $row){
                            $i++;
                            $data = PmsCompactHasExecute::find()->where(['pms_execute_execute_id'=>$row,'pms_compact_has_prosub_id'=>$modelcompacthasprosub->id])->one();
                            if($data){
                            }else{
                                $model = new PmsCompactHasExecute;
                                $model->pms_execute_execute_id = $row;
                                $model->pms_compact_has_prosub_id = $modelcompacthasprosub->id;
                                $model->save();
                            }
                        }
                    }
                    if($i != 1){
                        PmsCompactHasExecute::deleteAll(['pms_compact_has_prosub_id'=>$modelcompacthasprosub->id,'pms_execute_execute_id'=>$rows->execute_id]);
                    }
                }
            }else{
                PmsCompactHasExecute::deleteAll(['pms_compact_has_prosub_id'=>$modelcompacthasprosub->id]);
            }
            $comhasexecute = PmsCompactHasExecute::find()->where(['pms_compact_has_prosub_id'=>$modelcompacthasprosub->id])->all();
            //$modelsExecuteCost = [[new PmsExecuteHasCost]];
            $checkChasE = PmsCompactHasExecute::find()->where(['pms_compact_has_prosub_id'=>$modelcompacthasprosub->id])->all();
            if($checkChasE == null){
                $modelsExecuteCost = [];
            }else{
                foreach ($comhasexecute as $row){
                    $data = PmsExecuteHasCost::find()->where(['pms_compact_has_prosub_id'=>$modelcompacthasprosub->id,'pms_execute_execute_id'=>$row])->all();
                    if($data){
                        $modelsExecuteCost[]=$data;
                    }else{
                        $modelsExecuteCost[]=[new PmsExecuteHasCost()];
                    }
                }
            }

//            for($i = 1 ; $i < sizeof($comhasexecute) ; $i++){
//                $modelsExecuteCost[]=[new PmsExecuteHasCost()];
//            }
            //return yii\helpers\Json::encode($modelsExecuteCost);
            $this->layout ="main_module";
            return $this->render('compactbudget_execute',['modelcompacthasprosub'=>$modelcompacthasprosub,'modelsExecuteCost'=>$modelsExecuteCost,'comhasexecute'=>$comhasexecute,'compact'=>$modelcompacthasprosub->id,'id'=>$id]);
        }
    }

    public function actionAddcompactbudget(){
        date_default_timezone_set("Asia/Bangkok");
        $compact = Yii::$app->request->post('compact');
        $id = Yii::$app->request->post('id');
        if($compact){
            $modelcompacthasprosub = PmsCompactHasProsub::findOne($compact);
        }else{
            $modelcompacthasprosub = new PmsCompactHasProsub();
        }

        $executeModel = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $execute =[];
        foreach ($executeModel as $row){
            $data = PmsCompactHasExecute::find()->where(['pms_execute_execute_id'=>$row->execute_id])->all();
            if(!$data){
                $execute[]=$row;
            }
        }

//        return yii\helpers\Json::encode($execute);
//        exit;
        $datah = EofficeCentralViewPisBoardOfDirectors::find()->select('person_id')->distinct()->all();
        foreach ($datah as $row){
            $datas = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id'=>$row->person_id])->orderBy(['period_describe'=>SORT_DESC])->one();
            //echo $datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")<br>";
            $manager[$row->person_id]=$datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")";
        }
        if($modelcompacthasprosub->load(Yii::$app->request->post())) {
            $check = PmsCompactHasProsub::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
//            var_dump($compact);
//            exit;
            if($compact == null){
                $modelcompacthasprosub->round = sizeof($check)+1;
            }
            $modelcompacthasprosub->pms_project_sub_prosub_code = $id;
            $modelcompacthasprosub->status_process = 3;
            $modelcompacthasprosub->save_date = date("Y-m-d H:i:s");
            $modelcompacthasprosub->save(false);

            $executecheck = Yii::$app->request->post('executecheck');
            if($executecheck != null){
                foreach ($executecheck as $row){
                    $model = new PmsCompactHasExecute;
                    $model->pms_execute_execute_id = $row;
                    $model->pms_compact_has_prosub_id = $modelcompacthasprosub->id;
                    $model->save();

                }
            }
            $comhasexecute = PmsCompactHasExecute::find()->where(['pms_compact_has_prosub_id'=>$modelcompacthasprosub->id])->all();
            $modelsExecuteCost = [[new PmsExecuteHasCost]];
            for($i = 1 ; $i < sizeof($comhasexecute) ; $i++){
                $modelsExecuteCost[]=[new PmsExecuteHasCost()];
            }
            $this->layout ="main_module";
            return $this->render('compactbudget_execute',['modelcompacthasprosub'=>$modelcompacthasprosub,'modelsExecuteCost'=>$modelsExecuteCost,'comhasexecute'=>$comhasexecute,'compact'=>$modelcompacthasprosub->id,'id'=>$id]);
        }
        $this->layout ="main_module";
        if($compact){
            return $this->render('compactbudget_add',[
                'modelcompacthasprosub'=>$modelcompacthasprosub,
                'execute'=>$execute,
                'id'=>$id,
                'manager'=>$manager,
            ]);
        }else{
            return $this->render('compactbudget_add',[
                'modelcompacthasprosub'=>$modelcompacthasprosub,
                'execute'=>$execute,
                'id'=>$id,
                'manager'=>$manager,
                'compact'=>$compact,
            ]);
        }


    }

    public function actionEditcompactbudget($id,$compact){
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($compact);
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $datah = EofficeCentralViewPisBoardOfDirectors::find()->select('person_id')->distinct()->all();
        foreach ($datah as $row){
            $datas = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id'=>$row->person_id])->orderBy(['period_describe'=>SORT_DESC])->one();
            //echo $datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")<br>";
            $manager[$row->person_id]=$datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")";
        }
        $this->layout ="main_module";
        return $this->render('compactbudget_add',[
            'id'=>$id,
            'compact'=>$compact,
            'modelcompacthasprosub'=>$modelcompacthasprosub,
            'execute'=>$execute,
            'manager'=>$manager,
        ]);
    }

    public function actionDeletebudget($compact)
    {
        $model = PmsCompactHasProsub::findOne($compact);

        if($model->compact_save == "false"){
            $model->delete();
        }
        $this->redirect(['tablepro/track-project']);
    }

    //-------------- END 201

    //-------------- NEW 104

    public function actionPreviouscompactpandb(){
        $compact = Yii::$app->request->get('compact');
        $id = Yii::$app->request->get('id');
        $modelprosub = PmsProjectSub::findOne($id);
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $modelcompacthasprosub = PmsCompactHasProsub::find()->where(['id'=>$compact])->one();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $datah = EofficeCentralViewPisBoardOfDirectors::find()->select('person_id')->distinct()->all();
        foreach ($datah as $row){
            $datas = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id'=>$row->person_id])->orderBy(['period_describe'=>SORT_DESC])->one();
            //echo $datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")<br>";
            $manager[$row->person_id]=$datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")";
        }
        $this->layout ="main_module";
        return $this->render('compactpandb_add',['modelcompacthasprosub'=>$modelcompacthasprosub,
            'execute'=>$execute,'id'=>$id,'compact'=>$compact,'manager'=>$manager,'modelprosub'=>$modelprosub,'prosubbudget'=>$prosubbudget]);

    }

    public function actionNextcompactpandb(){
        $id = Yii::$app->request->post('id');
        $compact = Yii::$app->request->post('compact');
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($compact);
        if($modelcompacthasprosub->load(Yii::$app->request->post())) {
            $check = PmsCompactHasProsub::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
            if($compact == null){
                $modelcompacthasprosub->round = sizeof($check)+1;
            }
            $modelcompacthasprosub->pms_project_sub_prosub_code = $id;
            $modelcompacthasprosub->status_process = 4;
            $modelcompacthasprosub->save_date = date("Y-m-d H:i:s");
            $modelcompacthasprosub->save(false);
            //PmsCompactHasExecute::deleteAll(['pms_compact_has_prosub_id'=>$modelcompacthasprosub->id]);
            $executecheck = Yii::$app->request->post('executecheck');
            $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
            if($executecheck != null){
                foreach ($execute as $rows){
                    $i = 0;
                    foreach ($executecheck as $row){
                        if($rows->execute_id == $row){
                            $i++;
                            $data = PmsCompactHasExecute::find()->where(['pms_execute_execute_id'=>$row,'pms_compact_has_prosub_id'=>$modelcompacthasprosub->id])->one();
                            if($data){
                            }else{
                                $model = new PmsCompactHasExecute;
                                $model->pms_execute_execute_id = $row;
                                $model->pms_compact_has_prosub_id = $modelcompacthasprosub->id;
                                $model->save();
                            }
                        }
                    }
                    if($i != 1){
                        PmsCompactHasExecute::deleteAll(['pms_compact_has_prosub_id'=>$modelcompacthasprosub->id,'pms_execute_execute_id'=>$rows->execute_id]);
                    }
                }
            }else{
                PmsCompactHasExecute::deleteAll(['pms_compact_has_prosub_id'=>$modelcompacthasprosub->id]);
            }
            $comhasexecute = PmsCompactHasExecute::find()->where(['pms_compact_has_prosub_id'=>$modelcompacthasprosub->id])->all();
            //$modelsExecuteCost = [[new PmsExecuteHasCost]];
            $checkChasE = PmsCompactHasExecute::find()->where(['pms_compact_has_prosub_id'=>$modelcompacthasprosub->id])->all();
            if($checkChasE == null){
                $modelsExecuteCost = [];
            }else{
                foreach ($comhasexecute as $row){
                    $data = PmsExecuteHasCost::find()->where(['pms_compact_has_prosub_id'=>$modelcompacthasprosub->id,'pms_execute_execute_id'=>$row])->all();
                    if($data){
                        $modelsExecuteCost[]=$data;
                    }else{
                        $modelsExecuteCost[]=[new PmsExecuteHasCost()];
                    }
                }
            }

//            for($i = 1 ; $i < sizeof($comhasexecute) ; $i++){
//                $modelsExecuteCost[]=[new PmsExecuteHasCost()];
//            }
            //return yii\helpers\Json::encode($modelsExecuteCost);
            $this->layout ="main_module";
            return $this->render('compactpandb_execute',['modelcompacthasprosub'=>$modelcompacthasprosub,'modelsExecuteCost'=>$modelsExecuteCost,'comhasexecute'=>$comhasexecute,'compact'=>$modelcompacthasprosub->id,'id'=>$id]);
        }
    }

    public function actionAddcompactpandb(){

        date_default_timezone_set("Asia/Bangkok");
        $compact = Yii::$app->request->post('compact');
        $id = Yii::$app->request->post('id');
        $modelprosub = PmsProjectSub::findOne($id);
        $modelcompacthasprosub = new PmsCompactHasProsub();
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $datah = EofficeCentralViewPisBoardOfDirectors::find()->select('person_id')->distinct()->all();
        foreach ($datah as $row){
            $datas = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id'=>$row->person_id])->orderBy(['period_describe'=>SORT_DESC])->one();
            //echo $datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")<br>";
            $manager[$row->person_id]=$datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")";
        }
        if($modelcompacthasprosub->load(Yii::$app->request->post())) {

            $check = PmsCompactHasProsub::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
            if(Yii::$app->request->post('compact')){
                $compact = Yii::$app->request->post('compact');
                $modelcompacthasprosub->id = $compact;
            }
            if($compact == null){
                $modelcompacthasprosub->round = sizeof($check)+1;
            }
            $modelcompacthasprosub->pms_project_sub_prosub_code = $id;
            $modelcompacthasprosub->status_process = 4;
            $modelcompacthasprosub->save_date = date("Y-m-d H:i:s");
            $modelcompacthasprosub->save(false);

            $executecheck = Yii::$app->request->post('executecheck');
            if($executecheck != null){
                foreach ($executecheck as $row){
                    $model = new PmsCompactHasExecute;
                    $model->pms_execute_execute_id = $row;
                    $model->pms_compact_has_prosub_id = $modelcompacthasprosub->id;
                    $model->save();

                }
            }
            $comhasexecute = PmsCompactHasExecute::find()->where(['pms_compact_has_prosub_id'=>$modelcompacthasprosub->id])->all();
            $modelsExecuteCost = [[new PmsExecuteHasCost]];
            for($i = 1 ; $i < sizeof($comhasexecute) ; $i++){
                $modelsExecuteCost[]=[new PmsExecuteHasCost()];
            }
            $this->layout ="main_module";
            return $this->render('compactpandb_execute',['modelcompacthasprosub'=>$modelcompacthasprosub,'modelsExecuteCost'=>$modelsExecuteCost,'comhasexecute'=>$comhasexecute,'compact'=>$modelcompacthasprosub->id,'prosubbudget'=>$prosubbudget,'id'=>$id]);
        }
        $this->layout ="main_module";
        if($compact){
            return $this->render('compactpandb_add',['modelcompacthasprosub'=>$modelcompacthasprosub,
                'execute'=>$execute,'id'=>$id,'modelprosub'=>$modelprosub,'prosubbudget'=>$prosubbudget,'manager'=>$manager]);

        }else{
            return $this->render('compactpandb_add',['modelcompacthasprosub'=>$modelcompacthasprosub,
                'execute'=>$execute,'id'=>$id,'modelprosub'=>$modelprosub,
                'prosubbudget'=>$prosubbudget,'manager'=>$manager,
                'compact'=>$compact]);

        }

    }

    public function actionSaveexecutepandb(){
        $modelsExecuteCost = Yii::$app->request->post('PmsExecuteHasCost');
        $compact = Yii::$app->request->post('compact');
        $id = Yii::$app->request->post('id');
        $modelprosub = PmsProjectSub::findOne($id);
        $modelprosub->compact_save = "true_pb";
        $modelprosub->save(false);
        $comhasexecute = PmsCompactHasExecute::find()->where(['pms_compact_has_prosub_id'=>$compact])->all();
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($compact);
        PmsExecuteHasCost::deleteAll(['pms_compact_has_prosub_id'=>$compact]);
        $modelcompacthasprosub->load(Yii::$app->request->post());
        for ($i=0;$i<sizeof($comhasexecute);$i++){
            echo $comhasexecute[$i]['pms_compact_has_prosub_id']." ".$comhasexecute[$i]['pms_execute_execute_id']." ".$i."-----------------<br>";
            foreach ($modelsExecuteCost[$i] as $key =>$item){
                echo $item['detail']." ".$item['cost']."<br>";
                $model = new PmsExecuteHasCost();
                $model->detail = $item['detail'];
                $model->cost = $item['cost'];
                $model->pms_compact_has_prosub_id = $comhasexecute[$i]['pms_compact_has_prosub_id'];
                $model->pms_execute_execute_id = $comhasexecute[$i]['pms_execute_execute_id'];
                if($item['detail'] != null){
                    $model->save(false);
                }
            }
        }
        if($modelcompacthasprosub->status_pandf == "รอปรับแก้ไขโครงการ"){
            $modelcompacthasprosub->status_pandf = "ยังไม่ดำเนินการ";
        }
        $modelcompacthasprosub->compact_save = "true";
        $modelcompacthasprosub->save(false);
        return $this->redirect(['detailcompactpandb/detail?id='.$id.'&compact='.$compact]);

    }

    public function actionEditcompactpandb($id,$compact){
        $modelprosub = PmsProjectSub::findOne($id);
        $prosubbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($compact);
        $execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $datah = EofficeCentralViewPisBoardOfDirectors::find()->select('person_id')->distinct()->all();
        foreach ($datah as $row){
            $datas = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id'=>$row->person_id])->orderBy(['period_describe'=>SORT_DESC])->one();
            //echo $datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")<br>";
            $manager[$row->person_id]=$datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")";
        }
        $this->layout ="main_module";
        return $this->render('compactpandb_add',[
            'modelprosub'=>$modelprosub,
            'id'=>$id,
            'compact'=>$compact,
            'modelcompacthasprosub'=>$modelcompacthasprosub,
            'execute'=>$execute,
            'prosubbudget'=>$prosubbudget,
            'manager'=>$manager,
        ]);
    }

    public function actionDeletepandb($compact)
    {
        $model = PmsCompactHasProsub::findOne($compact);

        if($model->compact_save == "false"){
            $model->delete();
        }
        $this->redirect(['tablepro/track-project']);
    }

    //-------------- END 104

    //-------------- JS

    public function actionBudgetJs(){
        $id = Yii::$app->request->get('prosub');
        $model = PmsCompactHasProsub::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $data = "";
        foreach ($model as $key => $row){

            $stg ="".$row['start_date'];
            $date = substr($stg, 0, 10);


//            $i = $key +1;
//            $stg ="".$row->time_start;
//            $date = substr($stg, 0, 10);
            $data = $data."<option value='".$row->id."'>รอบที่ ".$row['round']." ".$date."</option>";
        }

        $data = $data."";
        echo $data;
    }

    public function actionRulebuget()
    {

        $execute = Yii::$app->request->get('PmsCompactHasExecute');
        $cost = Yii::$app->request->get('PmsExecuteHasCost');


        $result = "";
        $executeFalse = [];
        foreach($execute as $key => $item){
            $modelExecute = PmsExecute::findOne($item['pms_execute_execute_id']);
            $budgetLimit = $modelExecute->execute_cost;
            $costSum = 0;
            foreach ($cost[$key] as $row){

                $costSum = $costSum + $row['cost'];
            }
            if($costSum > $budgetLimit){
                $executeFalse[]=$item['pms_execute_execute_id'];
            }

        }

        $countExecute = sizeof($executeFalse);
        $countExecuteIndex = sizeof($executeFalse)-1;
        if($countExecute == 1){
            foreach($executeFalse as $rows){
                $modelExecute = PmsExecute::findOne($rows);
                $result = $result."กิจกรรมที่ ".$modelExecute->execute_no." ".$modelExecute->execute_name;
            }
            $result = $result." เกินงบประมาณที่กำหนด";
        }else if($countExecute > 1){
            foreach($executeFalse as $key => $rows){
                $modelExecute = PmsExecute::findOne($rows);
                if($key == 0){
                    $result = $result."กิจกรรมที่ ".$modelExecute->execute_no." ".$modelExecute->execute_name;
                }else if($countExecuteIndex == $key){
                    $result = $result." และกิจกรรมที่ ".$modelExecute->execute_no." ".$modelExecute->execute_name;
                }else{
                    $result = $result.", กิจกรรมที่ ".$modelExecute->execute_no." ".$modelExecute->execute_name;
                }
            }
            $result = $result." เกินงบประมาณที่กำหนด";
        }else{
            $result = "true";
        }

        echo $result;
        exit;
        exit;
//        $id_compact = Yii::$app->request->get('compact');
//        $cost = Yii::$app->request->get('PmsExecuteHasCost');
//
//
//        $costCompact = 0;
//        $id_prosub = Yii::$app->request->get('id');
//        $modelCompact = PmsCompactHasProsub::find()->where(['pms_project_sub_prosub_code'=>$id_prosub])->all();
//        if($modelCompact){
//            foreach ($modelCompact as $rows){
//                if($rows->id != $id_compact){
//                    $modelCost = PmsExecuteHasCost::find()->where(['pms_compact_has_prosub_id'=>$rows->id])->all();
//                    if($modelCost){
//                        foreach ($modelCost as $row_cost){
//                            $costCompact = $costCompact + $row_cost->cost;
//                        }
//                    }
//                }
//
//            }
//        }
//
//        $costSum = 0;
//        foreach ($cost as $row){
//            if(is_array($row)){
//                foreach ($row as $item){
//                    if($item['cost']){
//                        $costSum = $costSum + $item['cost'];
//                    }
//
//                }
//            }
//        }
//        $costUse = $costSum + $costCompact;
//        $budgetLimit = 0;
//        $modelProBudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code'=>$id_prosub])->all();
//        foreach ($modelProBudget as $cost_limit){
//            $budgetLimit = $budgetLimit + $cost_limit->budget_limit;
//        }
//        //echo $costUse;
//        if($costUse <= $budgetLimit){
//            echo "true";
//        }else{
//            echo "false";
//        }

    }


}