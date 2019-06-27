<?php

namespace app\modules\requestform\controllers;
use Yii;
use yii\web\Controller;
use app\modules\requestform\models\ReqTemplate;
use yii\web\NotFoundHttpException;

class CreateController extends Controller
{
	public function actionIndex()
	{
		$this->layout = "main_modules";
		return $this->render('index');
	}

	public function actionForm()
	{
		  $this->layout = "main_modules";
      $model = new ReqTemplate();

      if ($model->load(Yii::$app->request->post())) {
          $session = Yii::$app->session;
          $session['name']=$_POST['ReqTemplate']['template_name'];
          $session['category']=$_POST['ReqTemplate']['req_category_category_id'];
          $session['type']=$_POST['ReqTemplate']['req_type_req_type_id'];
      	return $this->render('design', [

      		'model' => $model,
      		]);
      } else {
      	return $this->render('header', [
      		'model' => $model,
      		]);
      }
  }

  public function actionApproval()
  {
      $session = Yii::$app->session;
  	$boxType=$_POST['boxTYPE'];
  	$counter=$_POST['counter'];
  	$req_att = [];
  	$box_att = [];
  	$counter = 0 ;
  	$ref = [];
  	$phd = [];
  	$api = [];
  	$box = [];

  	foreach ($_POST['ref_code'] as $key => $row) {
  		array_push($ref, $row);
  		$counter+=1;
  	}
  	foreach ($_POST['box_name'] as $key => $row) {
  		array_push($phd, $row);
  	}
  	foreach ($_POST['api_code'] as $key => $row) {
  		array_push($api, $row);
  	}
  	foreach ($_POST['box_type'] as $key => $row) {
  		array_push($box, $row);
  	}

  	for ( $i=0; $i < $counter; $i++) {
  		$box_att["ref_code"] = $ref[$i];
  		$box_att["box_name"] = $phd[$i];
  		$box_att["api_code"] = $api[$i];
  		$box_att["box_type"] = $box[$i];
  		array_push($req_att,$box_att);
  	}
  	$session['req_att']= $req_att;
  	$this->layout = "main_modules";
  	$model = new ReqTemplate();
  	return $this->render('approval', [
  		'model' => $model,
  		]);
  }

  public function actionPreview()
  {
      /*
    $session = Yii::$app->session;
    $name = $session['name'];
      $category = $session['category'];
      $type = $session['type'];
      $req_att = $session['req_att'];
      */
  	$req_accept = [];
  	$accept_att = [];
  	$counter = 0 ;
  	$accept = [];
  	foreach ($_POST['accept_value'] as $key => $row) {
  		array_push($accept, $row);
  		$counter+=1;
  	}
  	for ( $i=0; $i < $counter; $i++) {
  		$accept_att["accept_id"] = $accept[$i];
  		array_push($req_accept,$accept_att);
  	}
  	$session['req_accept']= $req_accept;
  	$this->layout = "main_modules";
  	$model = new ReqTemplate();
  	return $this->render('preview', [
  		'model' => $model,
  		]);
  }

  public function actionSave()
  {
      $session = Yii::$app->session;
  	$this->layout = "main_modules";
  	$model = new ReqTemplate;
  	if(isset($_POST)){
  		$model->load(Yii::$app->request->post());
        $template = new ReqTemplate();
        $template->template_name = $session['name'];
        $template->template_attribute = json_encode($session['req_att'], JSON_UNESCAPED_UNICODE);
        $template->template_accept = json_encode($session['req_accept'], JSON_UNESCAPED_UNICODE);
        $template->crby = Yii::$app->user->identity->username;
        $template->crtime = date('H:i:s m-d-Y') ;
        $template->req_type_req_type_id = $session['type'];
        $template->req_category_category_id = $session['category'];
        $template->user_id = Yii::$app->user->identity->id ;
        $template->save();
  		return $this->redirect('index');
  	}
  }
}
