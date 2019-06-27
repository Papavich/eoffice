<?php

namespace app\modules\repairsystem\controllers;

use Yii;
use yii\web\Controller;
use app\modules\repairsystem\models\RepDes;
use app\modules\repairsystem\models\Building;
use app\modules\repairsystem\models\RepairStatus;
use app\modules\repairsystem\models\RepairPhoto;
use app\modules\repairsystem\models\Room;
use app\modules\repairsystem\models\AssetTypeDepartment;

// use common\models\Building;
// use common\models\Room;



use kartik\widgets\DepDrop;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Default controller for the `repair` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
      $model = new  RepDes();
      $modelb = new AssetTypeDepartment();
      $modelc = new Building();
      $modeld = new Room();
      $modele = new RepairStatus();
      $modelg = new RepairPhoto();


      $model['fname'] = "ศิริพร";
      $model['lname'] = "สังข์ปิติกุล";
      $model['email'] = "siri@gmail.com";
      $model['tel'] = "088-4853135";
      $model['rep_date'] = "2017-11-06";

      if($model->load(Yii::$app->request->post())){

          $model['rep_status_id'] = 1;
          $model->save();
          $model['rep_photo_id'] = 1;
          $model->save();

      }



    $this->layout = "main_module";

    if($model->load(Yii::$app->request->post()) && $model->save() &&
    $modelb->load(Yii::$app->request->post()) && $modelb->save()&&
    $modelc->load(Yii::$app->request->post()) && $modelc->save()&&
    $modeld->load(Yii::$app->request->post()) && $modeld->save()&&
    $modele->load(Yii::$app->request->post()) && $modele->save()&&
    $modelg->load(Yii::$app->request->post()) && $modelg->save()

  ){
        echo "Success!!!!!!!!!";

    }else{
      return $this->render('index',['modelrep'=>$model,'modelrep2'=>$modelb,'modelrep3'=>$modelc,'modelrep4'=>$modeld,'modelrep5'=>$modele,'modelrep6'=>$modelg]);

    }
  }

  // public function actionTest()
  // {
  //   $model = new  RepDes();
  //   // $modelb = new AssetTypeDepartment();
  //   // $modelc = new Building();
  //   // $modeld = new Room();
  //   // $modele = new RepairStatus();
  //   // $modelg = new RepairPhoto();
  //
  //
  // $this->layout = "main_module";
  //   return $this->render('test',['model'=>$model]);

  }
