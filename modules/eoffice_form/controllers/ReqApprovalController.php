<?php

namespace app\modules\eoffice_form\controllers;

use app\modules\eoffice_form\models\ReqApproveGroup;
use app\modules\eoffice_form\models\ReqTracking;
use app\modules\eoffice_form\models\UserRequest;
use app\modules\eoffice_form\models\ViewPisPerson;
use Yii;
use app\modules\eoffice_form\models\ReqApproval;
use app\modules\eoffice_form\models\ReqApprovalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReqApprovalController implements the CRUD actions for ReqApproval model.
 */
class ReqApprovalController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ReqApproval models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new ReqApprovalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReqApproval model.
     * @param integer $user_id
     * @param integer $template_id
     * @param string $cr_date
     * @param integer $cr_term
     * @param integer $cr_year
     * @param integer $approve_group_queue
     * @param integer $approve_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id, $template_id, $cr_date, $cr_term, $cr_year, $approve_group_queue,$approve_queue, $approve_id)
    {
        $this->layout = "main_modules";
        /*
        return $this->render('view', [
            'model' => $this->findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year, $approve_group_queue, $approve_id),
        ]);*/
        $session = Yii::$app->session;
        $session['user_id'] = $user_id;
        $session['template_id'] = $template_id;
        $session['cr_date'] = $cr_date;
        $session['cr_term'] = $cr_term;
        $session['cr_year'] = $cr_year;
        $session['approve_group_queue'] = $approve_group_queue;
        $session['approve_queue'] = $approve_queue;
        $session['approval_id'] = Yii::$app->user->identity->username;

        $model = $this->findUserRequest($user_id, $template_id, $cr_date, $cr_term, $cr_year);
        $AllField = $model->req_json;

        $ApprovalModel = new ReqApproval();

        return $this->render('view', [
            'AllField' => json_decode($AllField, JSON_UNESCAPED_UNICODE),
            'model' => $model,
            'ApprovalModel' => $ApprovalModel,
            'user_id' => $user_id,
            'template_id' => $template_id,
            'cr_date' => $cr_date,
            'cr_term' => $cr_term,
            'cr_year' => $cr_year,

        ]);
    }
/*
    public function actionApprove()
    {
        $this->layout = "main_modules";

        return $this->render('view', [
        ]);
    }*/

    /**
     * Creates a new ReqApproval model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    /*
    public function actionCreate()
    {
        $model = new ReqApproval();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'template_id' => $model->template_id, 'cr_date' => $model->cr_date, 'cr_term' => $model->cr_term, 'cr_year' => $model->cr_year, 'approve_group_queue' => $model->approve_group_queue, 'approve_id' => $model->approve_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ReqApproval model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $template_id
     * @param string $cr_date
     * @param integer $cr_term
     * @param integer $cr_year
     * @param integer $approve_group_queue
     * @param integer $approve_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found

    public function actionUpdate($user_id, $template_id, $cr_date, $cr_term, $cr_year, $approve_group_queue, $approve_id)
    {
        $model = $this->findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year, $approve_group_queue, $approve_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'template_id' => $model->template_id, 'cr_date' => $model->cr_date, 'cr_term' => $model->cr_term, 'cr_year' => $model->cr_year, 'approve_group_queue' => $model->approve_group_queue, 'approve_id' => $model->approve_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ReqApproval model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $template_id
     * @param string $cr_date
     * @param integer $cr_term
     * @param integer $cr_year
     * @param integer $approve_group_queue
     * @param integer $approve_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found

    public function actionDelete($user_id, $template_id, $cr_date, $cr_term, $cr_year, $approve_group_queue, $approve_id)
    {
        $this->findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year, $approve_group_queue, $approve_id)->delete();

        return $this->redirect(['index']);
    }

    */

    public function actionTransfer()
    {
        $session = Yii::$app->session;
        $this->layout = "main_modules";

        $model = new ReqApproval();
        if ($model->load(Yii::$app->request->post())) {

           $getPerson = ViewPisPerson::find()
               ->where(['person_card_id' => $_POST['ReqApproval']['approve_id']])
               ->one();

            $groot = ReqApproval::find()->where(['user_id' => $session['user_id'],
                'template_id' => $session['template_id'],
                'cr_date' => $session['cr_date'],
                'cr_term' => $session['cr_term'],
                'cr_year' => $session['cr_year'],
                'approve_group_queue' => $session['approve_group_queue'],
                'approve_id' => $session['approval_id']])->one();

            $groot['approve_id'] = $_POST['ReqApproval']['approve_id'];
            $groot['approve_name'] = $getPerson['PREFIXABB'].' '.$getPerson['person_name'].' '.$getPerson['person_surname'];
            $groot->save();

        }else{
            return $this->render('transfer', [
                'model' => $model,
            ]);
        }



    }


    public function actionApprove()
    {
        $this->layout = "main_modules";
        $session = Yii::$app->session;


        $groot = ReqApproval::find()->where(['user_id' => $session['user_id'],
            'template_id' => $session['template_id'],
            'cr_date' => $session['cr_date'],
            'cr_term' => $session['cr_term'],
            'cr_year' => $session['cr_year'],
            'approve_group_queue' => $session['approve_group_queue'],
            'approve_id' => $session['approval_id']])->one();
        $groot['approve_status'] = $_POST['ReqApproval']['approve_status'];
        $groot['approve_comment'] = $_POST['ReqApproval']['approve_comment'];
        $groot['approve_enddate'] = date('Y-m-d');
        $groot->save();

        if ($_POST['ReqApproval']['approve_status'] == 'ไม่ผ่านการพิจารณา') {
            $this->RequestReject();
        }else {
            $this->RequestAccept();
        }

        return $this->redirect(['considered/index']);
    }


    protected function RequestReject()
    {
        $session = Yii::$app->session;
        $queryGroup = ReqApproveGroup::find()->where([
            'user_id' => $session['user_id'],
            'template_id' => $session['template_id'],
            'cr_date' => $session['cr_date'],
            'cr_term' => $session['cr_term'],
            'cr_year' => $session['cr_year'],
            'approve_group_queue' => $session['approve_group_queue']])->one();
        $queryGroup['approve_group_status'] = 'ไม่ผ่านการพิจารณา';
        $queryGroup['approve_group_enddate'] = date('Y-m-d');
        $queryGroup->save();

        $queryTacking = ReqTracking::find()->where([
            'user_id' => $session['user_id'],
            'template_id' => $session['template_id'],
            'cr_date' => $session['cr_date'],
            'cr_term' => $session['cr_term'],
            'cr_year' => $session['cr_year']])->one();
        $queryTacking['req_status'] = 'ไม่ผ่านการพิจารณา';
        $queryTacking['req_enddate'] = date('Y-m-d');
        $queryTacking->save();

        return $this->redirect(['considered/index']);
    }


    protected function RequestAccept()
    {
        $session = Yii::$app->session;
        $checkGroup = ReqApproval::find()->where([
            'user_id' => $session['user_id'],
            'template_id' => $session['template_id'],
            'cr_date' => $session['cr_date'],
            'cr_term' => $session['cr_term'],
            'cr_year' => $session['cr_year'],
            'approve_group_queue' => $session['approve_group_queue'],
            'approve_status' => 'กำลังดำเนินการ'])->all();


        if(count($checkGroup) == 0){ //ถ้าทุกคนเซ็นต์หมดแล้ว ให้ไปอัพเดต Approve Group
            $queryGroup = ReqApproveGroup::find()->where([
                'user_id' => $session['user_id'],
                'template_id' => $session['template_id'],
                'cr_date' => $session['cr_date'],
                'cr_term' => $session['cr_term'],
                'cr_year' => $session['cr_year'],
                'approve_group_queue' => $session['approve_group_queue']])->one();
            $queryGroup['approve_group_status'] = 'ผ่านการพิจารณา';
            $queryGroup['approve_group_enddate'] = date('Y-m-d');
            $queryGroup->save();

            $queryGroup = ReqApproveGroup::find()->where([
                'user_id' => $session['user_id'],
                'template_id' => $session['template_id'],
                'cr_date' => $session['cr_date'],
                'cr_term' => $session['cr_term'],
                'cr_year' => $session['cr_year']])->all();

            if($session['approve_group_queue']+1 > count($queryGroup)){
                $queryTacking = ReqTracking::find()->where([
                    'user_id' => $session['user_id'],
                    'template_id' => $session['template_id'],
                    'cr_date' => $session['cr_date'],
                    'cr_term' => $session['cr_term'],
                    'cr_year' => $session['cr_year']])->one();
                $queryTacking['req_status'] = 'ผ่านการพิจารณา';
                $queryTacking['req_enddate'] = date('Y-m-d');
                $queryTacking->save();
            }else{
                $queryGroup = ReqApproveGroup::find()->where([
                    'user_id' => $session['user_id'],
                    'template_id' => $session['template_id'],
                    'cr_date' => $session['cr_date'],
                    'cr_term' => $session['cr_term'],
                    'cr_year' => $session['cr_year'],
                    'approve_group_queue' => $session['approve_group_queue']+1])->one();
                $queryGroup['approve_group_visible'] = 'Visible';
                $queryGroup->save();

                $queryApproval = ReqApproval::find()->where([
                    'user_id' => $session['user_id'],
                    'template_id' => $session['template_id'],
                    'cr_date' => $session['cr_date'],
                    'cr_term' => $session['cr_term'],
                    'cr_year' => $session['cr_year'],
                    'approve_queue' => 1,
                    'approve_group_queue' => $session['approve_group_queue']+1])->one();
                $queryApproval['approve_visible'] = 'Visible';
                $queryApproval->save();
            }
        }else{
            $queryApproval = ReqApproval::find()->where([
                'user_id' => $session['user_id'],
                'template_id' => $session['template_id'],
                'cr_date' => $session['cr_date'],
                'cr_term' => $session['cr_term'],
                'cr_year' => $session['cr_year'],
                'approve_group_queue' => $session['approve_group_queue'],
                'approve_queue' => $session['approve_queue']+1])->one();
            $queryApproval['approve_visible'] = 'Visible';
            $queryApproval->save();
        }

        return $this->redirect(['considered/index']);

    }


    /**
     * Finds the ReqApproval model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $template_id
     * @param string $cr_date
     * @param integer $cr_term
     * @param integer $cr_year
     * @param integer $approve_group_queue
     * @param integer $approve_id
     * @return ReqApproval the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year, $approve_group_queue, $approve_id)
    {
        if (($model = ReqApproval::findOne(['user_id' => $user_id, 'template_id' => $template_id, 'cr_date' => $cr_date, 'cr_term' => $cr_term, 'cr_year' => $cr_year, 'approve_group_queue' => $approve_group_queue, 'approve_id' => $approve_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findUserRequest($user_id, $template_id, $cr_date, $cr_term, $cr_year)
    {
        if (($model = UserRequest::findOne(['user_id' => $user_id, 'template_id' => $template_id, 'cr_date' => $cr_date, 'cr_term' => $cr_term, 'cr_year' => $cr_year])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
