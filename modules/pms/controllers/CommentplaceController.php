<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 17/12/2560
 * Time: 16:24
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\LogPermisInSystem;
use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsProjectSub;
use yii;
use yii\web\Controller;

class CommentplaceController extends Controller
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
        $comment = Yii::$app->request->post('comment');
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $model->status = "ส่งกลับแก้ไข";
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->comment = $comment;
        $model->status_process = 2;
        $model->save();
        $modelProsub = PmsProjectSub::findOne($id);
        $modelProsub->prosub_status_place ="รอปรับแก้ไขโครงการ";
        $modelProsub->save();
        return $this->redirect(['tablepro/permis-staff']);
    }

    public function actionCommentManager()
    {
        $id = Yii::$app->request->post('id');
        $comment = Yii::$app->request->post('comment');
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $model->status = "ส่งกลับแก้ไข";
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->comment = $comment;
        $model->status_process = 2;
        $model->save();
        $modelProsub = PmsProjectSub::findOne($id);
        $modelProsub->prosub_status_place ="รอปรับแก้ไขโครงการ";
        $modelProsub->save();
        return $this->redirect(['tablepro/permis-manager']);
    }

    public function actionCommentPlanner()
    {
        $id = Yii::$app->request->post('id');
        $comment = Yii::$app->request->post('comment');
        $model = new LogPermisInSystem;
        $model->pms_project_sub_prosub_code = $id;
        $model->event_date = $this->YearThai();
        $model->status = "ส่งกลับแก้ไข";
        $person = EofficeCentralViewPisUser::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $model->person = $person->PREFIXNAME.$person->person_fname_th." ".$person->person_lname_th;
        $model->comment = $comment;
        $model->status_process = 2;
        $model->save();
        $modelProsub = PmsProjectSub::findOne($id);
        $modelProsub->prosub_status_place ="รอปรับแก้ไขโครงการ";
        $modelProsub->save();
       return $this->redirect(['tablepro/permis-planner']);
    }
}