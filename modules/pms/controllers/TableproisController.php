<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 17/12/2560
 * Time: 14:20
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\LogPermisInSystem;
use app\modules\pms\models\PmsCompactHasProsub;
use yii;
use yii\helpers\Html;
use yii\web\Controller;
use app\modules\pms\models\PmsProjectSub;

class TableproisController extends Controller
{



    //-------------------  project out system

    public function actionTableInSystem()
    {
        $user_id = Yii::$app->user->identity->id;
        $prosub = PmsProjectSub::find()->where(['prosub_status_insystem'=>"in_system",'prosub_responsible_id'=>$user_id])->all();
        $this->layout ="main_module";
        return $this->render('table_in_system',['prosub'=>$prosub]);
    }

    public function actionTablePermisStaffInSystem()
    {
        $prosub = PmsProjectSub::find()->where(['prosub_status_insystem'=>"wait_plan_project"])->all();
        $this->layout ="main_module";
        return $this->render('table_in_system_staff',['prosub'=>$prosub]);
    }

    public function actionTablePermisManagerInSystem()
    {
        $prosub = PmsProjectSub::find()->where(['prosub_status_insystem'=>"wait_plan_project"])->all();
        $this->layout ="main_module";
        return $this->render('table_in_system_manager',['prosub'=>$prosub]);
    }

    public function actionTablePermisPlannerInSystem()
    {
        $prosub = PmsProjectSub::find()->where(['prosub_status_insystem'=>"wait_plan_project"])->all();
        $this->layout ="main_module";
        return $this->render('table_in_system_planner',['prosub'=>$prosub]);
    }

    public function actionTablePermisFinanceInSystem()
    {
        $prosub = PmsProjectSub::find()->where(['prosub_status_insystem'=>"wait_plan_project"])->all();
        $this->layout ="main_module";
        return $this->render('table_in_system_finance',['prosub'=>$prosub]);
    }

    //-------------------  responsible

    public function actionTableCompactPlace()
    {
        $user_id = Yii::$app->user->identity->id;
        $prosub = PmsProjectSub::find()->where(['compact_save'=>'true','prosub_responsible_id'=>$user_id])->all();
        $this->layout ="main_module";
        return $this->render('table_compact_place',['prosub'=>$prosub]);
    }

    public function actionTableCompactBudget()
    {
        $user_id = Yii::$app->user->identity->id;
        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true" AND pms_project_sub.prosub_responsible_id = "'.$user_id.'"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('table_compact_budget',['prosub'=>$prosub]);
    }

    public function actionTableCompactPandb()
    {
        $user_id = Yii::$app->user->identity->id;
        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4" AND pms_project_sub.prosub_responsible_id = "'.$user_id.'"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('table_compact_pandb',['prosub'=>$prosub]);
    }

    public function actionTableSummary()
    {

        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE  summary_save ="true"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('table_summary',['prosub'=>$prosub]);
    }

    //-------------------  place

    public function actionTablePermisplaceStaff()
    {
        $prosub = PmsProjectSub::find()->where(['compact_save'=>'true'])->all();
        $this->layout ="main_module";
        return $this->render('table_permisplace_staff',['prosub'=>$prosub]);
    }

    public function actionTablePermisplaceManager()
    {
        $prosub = PmsProjectSub::find()->where(['compact_save'=>'true'])->all();
        $this->layout ="main_module";
        return $this->render('table_permisplace_manager',['prosub'=>$prosub]);
    }

    public function actionTablePermisplacePlanner()
    {
        $prosub = PmsProjectSub::find()->where(['compact_save'=>'true'])->all();
        $this->layout ="main_module";
        return $this->render('table_permisplace_planner',['prosub'=>$prosub]);
    }

    //-------------------  budget

    public function actionTablePermisbudgetStaff()
    {
        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('table_permisbudget_staff',['prosub'=>$prosub]);
    }

    public function actionTablePermisbudgetManager()
    {
        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('table_permisbudget_manager',['prosub'=>$prosub]);
    }

    public function actionTablePermisbudgetFinance()
    {
        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('table_permisbudget_finance',['prosub'=>$prosub]);
    }

    //-------------------  place and budget

    public function actionTablePermispandbStaff()
    {
        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('table_permispandb_staff',['prosub'=>$prosub]);
    }

    public function actionTablePermispandbManager()
    {
        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('table_permispandb_manager',['prosub'=>$prosub]);
    }

    public function actionTablePermispandbPlanner()
    {
        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('table_permispandb_planner',['prosub'=>$prosub]);
    }

    public function actionTablePermispandbFinance()
    {
        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('table_permispandb_finance',['prosub'=>$prosub]);
    }


    //-------------------  summary

    public function actionTablePermissummaryStaff()
    {
        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_compact_has_prosub.summary_save = "true"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('table_permissummary_staff',['prosub'=>$prosub]);
    }

    public function actionTablePermissummaryManager()
    {
        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_compact_has_prosub.summary_save = "true"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('table_permissummary_manager',['prosub'=>$prosub]);
    }

    public function actionTablePermissummaryPlanner()
    {
        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_compact_has_prosub.summary_save = "true"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('table_permissummary_planner',['prosub'=>$prosub]);
    }

    //-------------------  end

    //--------------------  JS

    public function actionGetstatusplaceJs(){
        $id = Yii::$app->request->get('id');
        $modelLog = LogPermisInSystem::find()->where(['pms_project_sub_prosub_code'=>$id,'status_process'=>2])->all();
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

    public function actionGetstatusbudgetJs(){
        $id = Yii::$app->request->get('id');
        $id_pro = substr($id, 0, 17);
        $compact = substr($id, 18);

        $modelLog = LogPermisInSystem::find()->where(['pms_project_sub_prosub_code'=>$id_pro,'status_process'=>3,'pms_compact_has_prosub_id'=>$compact])->all();
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

    public function actionGetstatuspandbJs(){
        $id = Yii::$app->request->get('id');
        $id_pro = substr($id, 0, 17);
        $compact = substr($id, 18);

        $modelLog = LogPermisInSystem::find()->where(['pms_project_sub_prosub_code'=>$id_pro,'status_process'=>4,'pms_compact_has_prosub_id'=>$compact])->all();
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

    public function actionGetstatussummaryJs(){
        $id = Yii::$app->request->get('id');
        $id_pro = substr($id, 0, 17);
        $compact = substr($id, 18);

        $modelLog = LogPermisInSystem::find()->where(['pms_project_sub_prosub_code'=>$id_pro,'status_process'=>5,'pms_compact_has_prosub_id'=>$compact])->all();
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



    public function actionTableDoc(){
//        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.prosub_status_offer = "อนุมัติลงปีงบประมาณสำเร็จ"')
//            ->queryAll();
        $prosub = PmsProjectSub::find()->where(['prosub_status_offer'=>'อนุมัติลงปีงบประมาณสำเร็จ'])->orderBy(['prosub_start_date'=>SORT_DESC])->all();
        $this->layout ="main_module";
        //return yii\helpers\Json::encode($prosub);
        return $this->render('table_all_project',['prosub'=>$prosub]);

    }

}