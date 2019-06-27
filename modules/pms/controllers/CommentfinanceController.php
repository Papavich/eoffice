<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 17/12/2560
 * Time: 16:23
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\LogPermisInSystem;
use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use app\modules\pms\models\PmsCompactHasProsub;
use yii;
use yii\web\Controller;

class CommentfinanceController extends Controller
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

    public function actionCommentStaff()
    {
        $id = Yii::$app->request->post('id');
        $compact = Yii::$app->request->post('compact');
        $comment = Yii::$app->request->post('comment');
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $model->status = "ส่งกลับแก้ไข";
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->comment = $comment;
        $model->pms_compact_has_prosub_id = $compact;
        $model->status_process = 3;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_finance ="รอปรับแก้ไขโครงการ";
        $modelCompact->save();
        return $this->redirect(['tablepro/permis-staff']);
    }

    public function actionCommentManager()
    {
        $id = Yii::$app->request->post('id');
        $compact = Yii::$app->request->post('compact');
        $comment = Yii::$app->request->post('comment');
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $model->status = "ส่งกลับแก้ไข";
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->comment = $comment;
        $model->pms_compact_has_prosub_id = $compact;
        $model->status_process = 3;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_finance ="รอปรับแก้ไขโครงการ";
        $modelCompact->save();
        return $this->redirect(['tablepro/permis-manager']);
    }

    public function actionCommentFinance()
    {
        $id = Yii::$app->request->post('id');
        $compact = Yii::$app->request->post('compact');
        $comment = Yii::$app->request->post('comment');
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $model->status = "ส่งกลับแก้ไข";
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->comment = $comment;
        $model->pms_compact_has_prosub_id = $compact;
        $model->status_process = 3;
        $model->save();
        $modelCompact = PmsCompactHasProsub::findOne($compact);
        $modelCompact->status_finance ="รอปรับแก้ไขโครงการ";
        $modelCompact->save();
        return $this->redirect(['tablepro/permis-finance']);
    }
}