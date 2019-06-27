<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 28/11/2560
 * Time: 19:05
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\LogPermisInSystem;
use app\modules\pms\models\model_main\EofficeCentralViewPisPerson;
use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use app\modules\pms\models\PmsProjectSub;
use yii;
use yii\web\Controller;

class PermissionController extends Controller{

    public function YearThai(){
        date_default_timezone_set("Asia/Bangkok");
        $time = date("H:i:s");
        $date = date("Y-m-d");
        $dateTh = Yii::$app->formatter->asDate($date, 'medium');
        $year = substr($dateTh, -4,4);
        $yearTh = $year+543;
        $reDate = str_replace($date,$yearTh,$dateTh);
        $reDate = $reDate.", ".$time;
        return $reDate;
    }

    public function actionPermisPrononeSystem()
    {
        $id = Yii::$app->request->get('id');
        $data = PmsProjectSub::findOne($id);
        $data->prosub_status_offer = "รอฝ่ายพัฒนานักศึกษาตรวจสอบ";
        $data->prosub_status_insystem = "wait_in_system";
        $data->save();
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $model->status = "ขออนุมัติ";
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->status_process = 1;
        $model->save(false);
        return $this->redirect(['tablepro/track-project']);
    }

    public function actionPermisPrononeSystemofferStaff()
    {
        $id = Yii::$app->request->get('id');
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $model->status = "ฝ่ายพัฒนานักศึกษาอนุมัติ";
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->status_process = 1;
        $model->save();
        $data = PmsProjectSub::findOne($id);
        $data->prosub_status_offer = "รอหัวหน้าภาคอนุมัติ";
        $data->save();
        return $this->redirect(['tablepro/permis-staff']);
    }

    public function actionPermisPrononeSystemofferManager()
    {
        $id = Yii::$app->request->get('id');
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model->status = "หัวหน้าภาคอนุมัติ";
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->status_process = 1;
        $model->save();
        $data = PmsProjectSub::findOne($id);
        $data->prosub_status_offer = "รองานนโยบายและแผนอนุมัติ";
        $data->save();
        return $this->redirect(['tablepro/permis-manager']);
    }

    // IN SYSTEM
    public function actionPermisPrononeSystemofferPlanner()
    {
        $id = Yii::$app->request->get('id');
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $model->status = "อนุมัติงานนโยบายและแผน";
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->status_process = 1;
        $model->save();
        $data = PmsProjectSub::findOne($id);
        $data->prosub_status_offer = "อนุมัติลงปีงบประมาณสำเร็จ";
        $data->prosub_status_insystem = "in_system";
        $data->save();
        return $this->redirect(['tablepro/permis-planner']);
    }




}