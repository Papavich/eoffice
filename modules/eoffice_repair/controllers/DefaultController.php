<?php

namespace app\modules\eoffice_repair\controllers;

use yii\web\Controller;

use Yii;

use app\modules\eoffice_repair\models\EofficeAssetViewAsset;
use app\modules\eoffice_repair\models\EofficeCentralViewPisRoom;

use app\modules\eoffice_repair\models\RepairDescription;
use app\modules\eoffice_repair\models\RepairImage;
use app\modules\eoffice_repair\models\RepairStatus;
use app\modules\eoffice_repair\models\RepairTracking;
use app\modules\eoffice_repair\models\RepairDescriptionSearch;


use kartik\widgets\DepDrop;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;


/**
 * Default controller for the `eoffice_repair` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
      {

          $this->layout = "main_modules";


          $desc = new  RepairDescription();
          $asset = new EofficeAssetViewAsset();
          $status = new RepairStatus();
          $img = new RepairImage();
           $buliding = new EofficeCentralViewPisRoom();



          $desc['rep_desc_fname'] = "ศิริพร";
          $desc['rep_desc_lname'] = "สังข์ปิติกุล";
          $desc['rep_desc_email'] = "siri@gmail.com";
          $desc['rep_desc_tel'] = "088-4853135";
          //  $desc['rep_desc_request_date'] = "2018-03-16";
          $desc['rep_desc_cost'] = "0";

          if ($desc->load(Yii::$app->request->post())) {

              $desc['rep_status_id'] = 1;
              $desc->save();
              $desc['rep_image_id'] = 1;
              $desc->save();
              $desc->rep_desc_request_date=date("Y-m-d");
              // $desc['rep_desc_cost'] = 0;
              // $desc->save();

          }


          $this->layout = "main_modules";

          if ($desc->load(Yii::$app->request->post()) && $desc->save() &&
              //$room->load(Yii::$app->request->post()) && $room->save() &&
              $asset->load(Yii::$app->request->post()) && $asset->save() &&
              $status->load(Yii::$app->request->post()) && $status->save() &&
              $img->load(Yii::$app->request->post()) && $img->save()&&
              $buliding->load(Yii::$app->request->post()) && $buliding->save()


          ) {
              return $this->render('/repairsystem/rep-des/show');

          } else {
              return $this->render('form_repair', [ 'rep' => $desc,
                                                    'rep3' => $asset,
                                                    'rep4' => $status,
                                                    'rep5' => $img,
                                                    'rep6' => $buliding]);

              return $this->render('index');
          }


      }


      $this->layout = "main_modules";

      return $this->render('form_repair');
  }




}
