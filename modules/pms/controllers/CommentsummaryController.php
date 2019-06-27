<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 17/12/2560
 * Time: 16:24
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\LogPermisInSystem;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsProjectSub;
use yii;
use yii\web\Controller;

class CommentsummaryController extends Controller
{
    public function actionCommentStaff()
    {
        date_default_timezone_set("Asia/Bangkok");
        $id = Yii::$app->request->post('id');
        $compact = Yii::$app->request->post('compact');
        $comment = Yii::$app->request->post('comment');
        $data = \app\modules\pms\models\PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $data->prosub_operator;
        $datas = \app\modules\pms\models\Person::find()->where(['id'=>$data->prosub_operator])->distinct()->one();
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = date("Y-m-d H:i:s");
        $model->status = "ส่งกลับแก้ไข";
        $model->person = "ฝ่ายพัฒนานักศึกษา";
        $model->comment = $comment;
        $model->status_process = 5;
        $model->pms_compact_has_prosub_id = $compact;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_result ="รอปรับแก้ไขโครงการ";
        $modelCompact->save();
        //Yii::$app->get('db_pms')->createCommand()->update('pms_project_sub', ['prosub_status_offer' => "รอปรับแก้ไขโครงการ",'prosub_comment_offer' => "$comment"],'prosub_code="'.$id.'"')->execute();

        return $this->redirect(['tableprois/table-permissummary-staff']);
    }

    public function actionCommentManager()
    {
        date_default_timezone_set("Asia/Bangkok");
        $id = Yii::$app->request->post('id');
        $compact = Yii::$app->request->post('compact');
        $comment = Yii::$app->request->post('comment');
        $data = \app\modules\pms\models\PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $data->prosub_operator;
        $datas = \app\modules\pms\models\Person::find()->where(['id'=>$data->prosub_operator])->distinct()->one();
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = date("Y-m-d H:i:s");
        $model->status = "ส่งกลับแก้ไข";
        $model->person = "หัวหน้าภาค";
        $model->comment = $comment;
        $model->status_process = 5;
        $model->pms_compact_has_prosub_id = $compact;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_result ="รอปรับแก้ไขโครงการ";
        $model->pms_compact_has_prosub_id = $compact;
        $modelCompact->save();
        //Yii::$app->get('db_pms')->createCommand()->update('pms_project_sub', ['prosub_status_offer' => "รอปรับแก้ไขโครงการ",'prosub_comment_offer' => "$comment"],'prosub_code="'.$id.'"')->execute();
        return $this->redirect(['tableprois/table-permissummary-manager']);
    }

    public function actionCommentPlanner()
    {
        date_default_timezone_set("Asia/Bangkok");
        $id = Yii::$app->request->post('id');
        $compact = Yii::$app->request->post('compact');
        $comment = Yii::$app->request->post('comment');
        $data = \app\modules\pms\models\PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $data->prosub_operator;
        $datas = \app\modules\pms\models\Person::find()->where(['id'=>$data->prosub_operator])->distinct()->one();
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = date("Y-m-d H:i:s");
        $model->status = "ส่งกลับแก้ไข";
        $model->person = "งานนโยบายและแผน";
        $model->comment = $comment;
        $model->status_process = 5;
        $model->pms_compact_has_prosub_id = $compact;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_result ="รอปรับแก้ไขโครงการ";
        $model->pms_compact_has_prosub_id = $compact;
        $modelCompact->save();
        //Yii::$app->get('db_pms')->createCommand()->update('pms_project_sub', ['prosub_status_offer' => "รอปรับแก้ไขโครงการ",'prosub_comment_offer' => "$comment"],'prosub_code="'.$id.'"')->execute();
        return $this->redirect(['tableprois/table-permissummary-planner']);
    }


}