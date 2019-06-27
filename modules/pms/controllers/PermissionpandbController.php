<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 17/12/2560
 * Time: 13:25
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\LogPermisInSystem;
use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use app\modules\pms\models\Person;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsProjectSub;
use yii;
use yii\web\Controller;

class PermissionpandbController extends Controller
{
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

    public function actionPermis(){
        $id = Yii::$app->request->get('id');
        $compact = Yii::$app->request->get('compact');
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $model->status = "ขออนุมัติ";
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->status_process = 4;
        $model->pms_compact_has_prosub_id = $compact;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_pandf ="รอฝ่ายพัฒนานักศึกษาตรวจสอบ";
        $modelCompact->save();
        return $this->redirect(['tablepro/track-project']);
    }

    public function actionPermisStaff(){
        $id = Yii::$app->request->get('id');
        $compact = Yii::$app->request->get('compact');
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $model->status = "ฝ่ายพัฒนานักศึกษาอนุมัติ";
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->status_process = 4;
        $model->pms_compact_has_prosub_id = $compact;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_pandf ="รอหัวหน้าภาคอนุมัติ";
        $modelCompact->save();
        return $this->redirect(['tablepro/permis-staff']);
    }

    public function actionPermisManager(){
        $id = Yii::$app->request->get('id');
        $compact = Yii::$app->request->get('compact');
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $model->status = "หัวหน้าภาคอนุมัติ";
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->status_process = 4;
        $model->pms_compact_has_prosub_id = $compact;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_pandf ="รองานนโยบายและแผนอนุมัติ";
        $modelCompact->save();
        return $this->redirect(['tablepro/permis-manager']);
    }

    public function actionPermisPlanner(){
        $id = Yii::$app->request->get('id');
        $compact = Yii::$app->request->get('compact');
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $model->status = "งานนโยบายและแผนอนุมัติ";
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->status_process = 4;
        $model->pms_compact_has_prosub_id = $compact;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_pandf ="รอการเงินอนุมัติ";
        $modelCompact->save();
        return $this->redirect(['tablepro/permis-planner']);
    }

    public function actionPermisFinance(){
        $id = Yii::$app->request->get('id');
        $compact = Yii::$app->request->get('compact');
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $model->status = "การเงินอนุมัติ";
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->status_process = 4;
        $model->pms_compact_has_prosub_id = $compact;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_pandf ="อนุมัติสำเร็จ";
        $modelCompact->save();
        return $this->redirect(['tablepro/permis-finance']);
    }
}