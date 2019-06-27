<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/9/2017
 * Time: 4:54 AM
 */

namespace app\modules\eoffice_ta\controllers;

use app\modules\eoffice_ta\models\Kku30SubjectOpen;
use Yii;
use yii\data\Pagination;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\model_central\ViewPisOpenSubject;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use app\modules\eoffice_ta\models\TaStatus;
use app\modules\eoffice_ta\models\TaProperty;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\eoffice_ta\models\TaDocuments;
use app\modules\eoffice_ta\models\TaDocumentsSearch;
use yii\web\Controller;

class StaffController extends Controller
{

    const DEPT_CS = 2322;
    const FACT_SIENCE = 2;
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionDashboardTa(){
        $this->layout = "main_modules";
        return $this->render('dashboard-ta');
    }
    /*public function actionManageNews(){
        $this->layout = "main_modules";
        return $this->render('manage-news');
    }*/
    public function actionManageDocument(){
        $searchModel = new TaDocumentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = TaDocuments::find()->all();
        $this->layout = "main_modules";
        return $this->render('manage-document', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionSettingCalculate(){
        $this->layout = "main_modules";
        return $this->render('setting-calculate');
    }
    public function actionSettingCalculateFunction(){
        $this->layout = "main_modules";
        return $this->render('setting-calculate-function');
    }

    public function actionCheckWorkLoad(){
        $this->layout = "main_modules";
        return $this->render('check-work-load');
    }

    public function actionCheckWorking(){
        $courses = EofficeCentralRegCourse::find()->where(
            [
                'FACULTYID'=>StaffController::FACT_SIENCE,
                'DEPARTMENTID'=>StaffController::DEPT_CS
            ])->all();
        foreach ($courses as $course) {
            $query = ViewPisOpenSubject::find()->where(['subject_id' => $course->COURSECODE]);
            $countQuery= clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
            $model = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        $this->layout = "main_modules";
        return $this->render('check-working', [
            'model' => $model,
            'pages' => $pages,
        ]);
        }
    }

    public function actionCheckWorkingTaList($s,$ver,$t,$y){
        $query = TaRegister::find()->where(['subject_id'=>$s,
            'subject_version'=>$ver,
            'term'=>$t,'year'=>$y,
            'ta_status_id'=>TaStatus::CHOOSE_TA]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 4]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $this->layout = "main_modules";
        return $this->render('check-working-ta-list', [
            'model' => $model,
            'pages' => $pages,
            's'=>$s,
            'ver'=>$ver,
            't'=>$t,'y'=>$y,
        ]);
    }

    public function actionCheckRequest(){

        $this->layout = "main_modules";
        return $this->render('check-request-ta', [

        ]);
    }
    public function actionCheckMaxPayment(){

        $Hlec = 3;
        $Hlab = 4.5;
        $RB = 50;
        $RG = 50;
        $BP = 200;
        $BG = 400;

        $query = Kku30SubjectOpen::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 5]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $model2 = Kku30SubjectOpen::find()->all();
        foreach ($model2 as $item) {
            $subj_id = $item->subject_id;
            $subj_name = $item->subject->subject_nameeng;
            $subj_ver = $item->subject_version;
            $term = $item->subopen_semester;
            $year = $item->subopen_year;
            $credit = $item->subject->subject_credit . '(' . $item->subject->subject_time . ')';
            $s_times = $item->subject->subject_time;
            $credit_lec = substr($s_times, 0, 1);
            $credit_lec = (float)$credit_lec * 1;
            $credit_lab = substr($s_times, 2, 1);
            $credit_lab = (float)$credit_lab * 0.5;
            $req = TaRequest::findOne(['subject_id' => $subj_id, 'subject_version' => $subj_ver,
                'term_id' => $term, 'year' => $year]);
            if (!empty($req)) {
                $type_work = $req->ta_type_work_id;
            }
        }
        $this->layout = "main_modules";
        return $this->render('check-max-payment', [
            'model' => $model,
            'model2' =>$model2,
            'pages' => $pages,
            'type_work'=>$type_work, 'Hlec'=>$Hlec, 'Hlab'=>$Hlab, 'RB'=>$RB,'RG'=>$RG,
            'BP'=> $BP,'BG'=>$BG,'credit_lab'=>$credit_lab,'credit_lec'=>$credit_lec,
            's_times'=>$s_times,
        ]);
    }

       //$s    ---> รหัสวิชา
       //$ver  ---> เวอร์ชันวิชา
       //$t  --->เทอม
       //$y  --->ปี
       //$wn  --->ภาระงานภาคปก
       //$wv  --->ภาระงานภาคพิเศษ
      //$pn  --->กรอบภาคปก
      //$pv  --->กรอบภาคพิเศษ
       //check-max-payment-view.php
    public function actionCheckMaxPaymentView($s,$ver,$t,$y,$wn,$wv,$pn,$pv,$stdn,$stdv){

        $Hlec = 3;
        $Hlab = 4.5;
        $RB = 50;
        $RG = 50;
        $BP = 200;
        $BG = 400;
        $model = Kku30SubjectOpen::findOne(['subject_id'=>$s,'subject_version'=>$ver,
            'subopen_semester'=>$t
            ,'subopen_year'=>$y]);
        $this->layout = "main_modules";
        return $this->render('check-max-payment-view', [
            's'=>$s,'ver'=>$ver,'t'=>$t,'y'=>$y,'wn'=>$wn,'wv'=>$wv,'pn'=>$pn,'pv'=>$pv,
            'stdn'=>$stdn,'stdv'=>$stdv,
            'model'=>$model,
        ]);
    }

    public function actionCheckMaxPaymentTa(){

        $this->layout = "main_modules";
        return $this->render('check-max-payment-ta', [

        ]);
    }
    public function actionCheckPayment(){ //eoffice_ta/staff/check-payment

        $courses = EofficeCentralRegCourse::find()->where(
            [
                'FACULTYID'=>StaffController::FACT_SIENCE,
                'DEPARTMENTID'=>StaffController::DEPT_CS
            ])->all();
        foreach ($courses as $course) {
            $query = ViewPisOpenSubject::find()->where(['subject_id' => $course->COURSECODE]);
            $countQuery= clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
            $model = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
            $this->layout = "main_modules";
            return $this->render('check-payment', [
                'model' => $model,
                'pages' => $pages,
            ]);
        }

    }
    public function actionCheckPaymentTaList($s,$ver,$t,$y){ //check-payment-ta-list
        $query = TaRegister::find()->where(['subject_id'=>$s,
            'subject_version'=>$ver,
            'term'=>$t,'year'=>$y,
            'ta_status_id'=>TaStatus::CHOOSE_TA]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 4]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $this->layout = "main_modules";
        return $this->render('check-payment-ta-list', [
            'model' => $model,
            'pages' => $pages,
            's'=>$s,
            'ver'=>$ver,
            't'=>$t,'y'=>$y,
        ]);
    }


}