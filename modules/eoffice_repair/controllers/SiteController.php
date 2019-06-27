<?php

namespace app\modules\eoffice_repair\controllers;

use Yii;
use yii\web\Controller;
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
use yii\db\Query;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $this->layout = "main_modules";

       return $this->render('index');
    }

    public function actionChart()
    {
        $model = new RepairDescription();
        $model = RepairDescription::find()->all();
        $AllRepair = [];
        foreach ($model as $item){
            $rep_desc_id = $item->rep_desc_id;
            $rep_desc_fname = $item->rep_desc_fname;
            $rep_desc_lname= $item->rep_desc_lname;

            array_push($AllRepair,$item);
        }
        echo "<pre>";
        print_r($AllRepair);
        echo "</pre>";


//        $this->render('chart2');
    }

//    public function actionPerson() {
//        $sql = "SELECT rep_desc_fname,rep_desc_lname, COUNT ( rep_desc_id ) AS total
//        FROM repair_description
//        WHERE YEAR (rep_desc_request_date)=".date('Y')."
//        GROUP BY rep_desc_id
//        GROUP BY total DESC
//        LIMIT 10";
//        $connection = Yii::app()->db;
//        $command = $connection->createCommand($sql);
//        $row = $command->queryAll();
//
//        $this->rander('person',array(
//            'row'=>$row,
//        ));
//    }


    public function actionForm()
    {
        {

            $this->layout = "main_modules";


            $desc = new  RepairDescription();
              // $asset = new AssetDetail();
            $status = new RepairStatus();
            $img = new RepairImage();
            // $buliding = new Buildings();



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
                $room->load(Yii::$app->request->post()) && $room->save() &&
                $asset->load(Yii::$app->request->post()) && $asset->save() &&
                $status->load(Yii::$app->request->post()) && $status->save() &&
                $img->load(Yii::$app->request->post()) && $img->save()&&
                $buliding->load(Yii::$app->request->post()) && $buliding->save()


            ) {
                return $this->render('/repairsystem/rep-des/show');

            } else {
                return $this->render('form_repair', [ 'rep' => $desc,
                    'rep2' => $room,
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


    public function actionTese()
    {
    }

    public function actionListRepair()
    {
        $model = new RepairDescription();
        $searchModel = new RepairDescriptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "main_modules";

        return $this->render('list_repair', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

    public function actionEdit()
    {
        $this->layout = "main_modules";
        return $this->render('edit_repair');
    }

    public function actionShowStaff()
    {
        $this->layout = "main_modules";
        return $this->render('show_staff');
    }

    protected function findModelDes($id)
    {
        if (($model = RepairDescription::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


 }


?>
