<?php

namespace app\modules\requestform\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Session;
use app\modules\requestform\models\ReqTemplate;
use app\modules\requestform\models\ReqForm;
use app\modules\requestform\models\ReqFlow;
use app\modules\requestform\models\ReqDetail;
use app\modules\requestform\models\ReqApprove;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

class FillingController extends \yii\web\Controller
{
  public function actionIndex()
  {
    $this->layout = "main_modules";
    return $this->render('index');
  }

  public function actionCreate()
  {
    $this->layout = "main_modules";
    $model = new ReqTemplate();
    $value = new ReqForm();

    if ($model->load(Yii::$app->request->post())) {
        $session = Yii::$app->session;
        $session['template_id']=$_POST['ReqTemplate']['template_id'];
      $model = ReqTemplate::find()->where(['template_id' => $session['template_id']])->all();
      foreach ($model as $item) {
        $req_name = $item->template_name;
        $req_att = $item->template_attribute;
        $req_accept = $item->template_accept;
      }
      return $this->render('input', [
       'model' => $model,
       'value' => $value,
       //'template_id' => $template_id,
       'req_name' => $req_name,
       'req_att' => $req_att,
       'req_accept' => $req_accept,
       ]);
    } else {
     return $this->render('create', [
      'model' => $model,
      ]);
   }
 }



 public function actionGetInput()
 {
     $session = Yii::$app->session;
  $box_key = [];
  $box_value = [];
  $form_value = [];
  $box_att = [];
  $counter = 0 ;

  foreach ($_POST['box_name'] as $key => $row) {
    array_push($box_key, $row);
    $counter+=1;
  }
  foreach ($_POST['box_value'] as $key => $row) {
    array_push($box_value, $row);
  }
  for ( $i=0; $i < $counter; $i++) {
    $box_att["box_name"] = $box_key[$i];
    $box_att["box_value"] = $box_value[$i];
    array_push($form_value,$box_att);
  }
  $session['form_value']= $form_value;
  $this->layout = "main_modules";
  $model = new ReqForm();
     return $this->render('confirm', [
       'model' => $model,
       //'form_value' => $form_value,
       //'template_id' => $template_id,
       ]);
   }

   public function actionSave()
   {
       $session = Yii::$app->session;
     $template_id=$session['template_id'];
     $this->layout = "main_modules";
     $model = new ReqForm;
     if(isset($_POST)){
       $model->load(Yii::$app->request->post());
         $form = new ReqForm();
         $form->req_template_template_id =  $session['template_id'];
         $form->user_id =  Yii::$app->user->identity->id ;
         $form->form_value = json_encode($session['form_value'], JSON_UNESCAPED_UNICODE);
       $form->save();
       $form_id = $form->form_id;
       return $this->redirect(['insert-flow',
         'form_id' => $form_id,
         'template_id' => $template_id,
         ]);
  }
}
public function actionInsertFlow($form_id,$template_id)
{
  $this->layout = "main_modules";
  $model = new ReqFlow();
  if(isset($_POST)){
    $model->load(Yii::$app->request->post());
    $flow = new ReqFlow();
    $flow->flow_status = "กำลังดำเนินการ";
    $flow->flow_startdate = (date('Y-m-d H:i:s'));
    $flow->req_form_form_id = $form_id;
    $flow->save();
    $flow_id = $flow->flow_id;
    return $this->redirect(['insert-approve',
      'form_id' => $form_id,
      'template_id' => $template_id,
      'flow_id' => $flow_id,
      ]);
  }else{
    echo "fail";
  }
}

public function actionInsertApprove($form_id,$template_id,$flow_id)
{
  $this->layout = "main_modules";
  $model = new ReqApprove();
  if(isset($_POST)){
    $model->load(Yii::$app->request->post());
    $model = ReqTemplate::find()->where(['template_id' => $template_id])->all();
    $count = 0;
    foreach ($model as $item) {
      $template_accept = $item->template_accept;
    }
    $fetch = json_decode($template_accept, true);
    $jsonLenght = count(json_decode($template_accept, true));
    for($i=0 ; $i < $jsonLenght; $i++){
      $approve = new ReqApprove();
      //$tracking->form_id = $form_id;
      $approve_id = $fetch[$i]['accept_id'];
      $approve->approve_id = $approve_id;
      $approve->req_flow_flow_id = $flow_id;
      $approve->approve_status = 'รอการพิจารณา';
      $approve->approve_receivedate = (date('Y-m-d H:i:s'));
      $approve->approve_queue = ($i+1);
      if ($i == 0){
          $approve->approve_visible = 1;
      }else{
          $approve->approve_visible = 0;
      }
      $approve->save();
    }
    return $this->redirect('index');
  }else{
    echo "fail";
  }
}
}
