<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 17/12/2560
 * Time: 13:25
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\LogPermisInSystem;
use app\modules\pms\models\Person;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsProjectSub;
use yii;
use yii\web\Controller;

class PermissionsummaryController extends Controller
{
    public function actionPermis()
    {date_default_timezone_set("Asia/Bangkok");
        $id = Yii::$app->request->get('id');
        $compact = Yii::$app->request->get('compact');
        $data = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $data->prosub_operator;
        $datas = Person::find()->where(['id'=>$data->prosub_operator])->distinct()->one();
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = date("Y-m-d H:i:s");
        $model->status = "ขออนุมัติ";
        $model->person = $datas->name_title.$datas->first_name."  ".$datas->last_name;
        $model->status_process = 5;
        $model->pms_compact_has_prosub_id = $compact;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_result ="รอฝ่ายพัฒนานักศึกษาตรวจสอบ";
        $modelCompact->save();
//        Yii::$app->get('db_pms')->createCommand()->update('pms_project_sub', ['prosub_status_place' => "รอฝ่ายพัฒนานักศึกษาตรวจสอบ"],'prosub_code="'.$id.'"')->execute();

        return $this->redirect(['detailprosubresult/detail?id='.$id.'&id_compact='.$compact]);
    }

    public function actionPermisStaff()
    {date_default_timezone_set("Asia/Bangkok");
        $id = Yii::$app->request->get('id');
        $compact = Yii::$app->request->get('compact');
        $data = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        //$data->prosub_operator;
        //$datas = \app\modules\pms\models\Person::find()->where(['id'=>$data->prosub_operator])->distinct()->one();
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = date("Y-m-d H:i:s");
        $model->status = "ฝ่ายพัฒนานักศึกษาอนุมัติ";
        $model->person = "ฝ่ายพัฒนานักศึกษา";
        $model->status_process = 5;
        $model->pms_compact_has_prosub_id = $compact;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_result ="รอหัวหน้าภาคอนุมัติ";
        $modelCompact->save();
        //Yii::$app->get('db_pms')->createCommand()->update('pms_project_sub', ['prosub_status_offer' => "รอหัวหน้าภาคอนุมัติ"],'prosub_code="'.$id.'"')->execute();

        return $this->redirect(['tableprois/table-permissummary-staff']);
    }

    public function actionPermisManager()
    {date_default_timezone_set("Asia/Bangkok");
        $id = Yii::$app->request->get('id');
        $compact = Yii::$app->request->get('compact');
        $data = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $data->prosub_operator;
        //$datas = \app\modules\pms\models\Person::find()->where(['id'=>$data->prosub_operator])->distinct()->one();
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = date("Y-m-d H:i:s");
        $model->status = "หัวหน้าภาคอนุมัติ";
        $model->person = "หัวหน้าภาค";
        $model->status_process = 5;
        $model->pms_compact_has_prosub_id = $compact;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_result ="รองานนโยบายและแผนอนุมัติ";
        $modelCompact->save();
        //Yii::$app->get('db_pms')->createCommand()->update('pms_project_sub', ['prosub_status_offer' => "รอหัวหน้าภาคอนุมัติ"],'prosub_code="'.$id.'"')->execute();

        return $this->redirect(['tableprois/table-permissummary-manager']);
    }

    public function actionPermisPlanner()
    {date_default_timezone_set("Asia/Bangkok");
        $id = Yii::$app->request->get('id');
        $compact = Yii::$app->request->get('compact');
        $data = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $data->prosub_operator;
        //$datas = \app\modules\pms\models\Person::find()->where(['id'=>$data->prosub_operator])->distinct()->one();
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = date("Y-m-d H:i:s");
        $model->status = "งานนโยบายและแผนอนุมัติ";
        $model->person = "งานนโยบายและแผน";
        $model->status_process = 5;
        $model->pms_compact_has_prosub_id = $compact;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_result ="อนุมัติสำเร็จ";
        $modelCompact->save();
        //Yii::$app->get('db_pms')->createCommand()->update('pms_project_sub', ['prosub_status_offer' => "รอหัวหน้าภาคอนุมัติ"],'prosub_code="'.$id.'"')->execute();

        return $this->redirect(['tableprois/table-permissummary-planner']);
    }


}