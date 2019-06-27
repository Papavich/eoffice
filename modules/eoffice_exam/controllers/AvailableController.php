<?php

namespace app\modules\eoffice_exam\controllers;
use Yii;
use yii\web\Controller;
use yii\helpers\Html;
use app\modules\eoffice_exam\models\ExamRoom;
use app\modules\eoffice_exam\models\ExamRoomDetail;
use app\modules\eoffice_exam\models\ExamRoomDetailSearch;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\widgets\DetailView;

class AvailableController extends \yii\web\Controller
{
    public function actionCheckroom()
    {
        $this->layout = "main_modules";
        $model=ExamRoomDetail::find()->all();
        $listData=ArrayHelper::map($model,'rooms_id','rooms_id');
        $model = new ExamRoomDetail();
        return $this->render('availableroom',[
            'model' => $model,
            'listData' => $listData,
        ]);
    }

    public function actionGetvalue()
    {

        $this->layout = "main_modules";
        $session = Yii::$app->session;

        $session['date'] = Yii::$app->request->post('date');
        $session['room'] = $_POST['ExamRoomDetail']['rooms_id'];

        if ($session['date']=='' && $session['room']=='empty'){
            return $this->redirect(['checkroom']);
        }elseif ($session['date']!= NULL && $session['room']=='empty'){
            return $this->redirect(['roomstatus2']);
        }elseif($session['room']!='empty' && $session['date']== NULL){
            return $this->redirect(['roomstatus1']);
        }
    }

    public function actionRoomstatus1() //search ตามห้อง
    {

        $this->layout = "main_modules";
        $session = Yii::$app->session;

        //$model = new ExamRoomDetail;
        //$model->load(Yii::$app->request->post());
        $model = ExamRoomDetail::find()
            ->where(['rooms_id' => $session['room']])
            ->andwhere(['exam_room_status' => '0'])
            ->all();
        foreach ($model as $item) {
            $status = $item->exam_room_status;
            $date = $item->rooms_detail_date;
            $time = $item->rooms_detail_time;
            $room = $item->rooms_id;

        }
        $model = new ExamRoomDetail;
        return $this->redirect('roomview');
    }

    public function actionRoomstatus2() //search ตามวัน
    {

        $this->layout = "main_modules";
        $session = Yii::$app->session;

        //$model = new ExamRoomDetail;
        //$model->load(Yii::$app->request->post());
        $model = ExamRoomDetail::find()
            ->where(['rooms_detail_date' => $session['date']])
            ->andwhere(['exam_room_status' => '0'])
            ->all();
        foreach ($model as $item) {
            $status = $item->exam_room_status;
            $date = $item->rooms_detail_date;
            $time = $item->rooms_detail_time;
            $room = $item->rooms_id;

        }
        $model = new ExamRoomDetail;
        return $this->redirect('roomview');
    }


    public function actionRoomview()
    {
        $this->layout = "main_modules";
        $searchModel = new ExamRoomDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('showrooms',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate() //update value from default page to DB
    {

      /*  $update = new ExamRoomDetail();
        $update->load(Yii::$app->request->post());
        $update = ExamRoomDetail::find()
            ->where(['rooms_detail_date' => $_SESSION['date']])
            ->andWhere(['rooms_detail_time' => $_SESSION['time']])
            ->andWhere(['rooms_id' => $_SESSION['room']])
            ->all();*/


        $model = $this->findModel($_POST['ExamRoomDetail']['rooms_detail_date'],
            $_POST['ExamRoomDetail']['rooms_detail_time'],
            $_POST['ExamRoomDetail']['rooms_id']
            );
        if(isset($_POST)) {
            $model->load(Yii::$app->request->post());
            $update = $model;
            $update->exam_room_status = $_POST['ExamRoomDetail']['exam_room_status'];
            $update->save();
        }

    }

    protected function findModel($date,$time,$room)
    {
        if (($model = ExamRoomDetail::findOne(['rooms_detail_date' => $date, 'rooms_detail_time' => $time, 'rooms_id' => $room])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
