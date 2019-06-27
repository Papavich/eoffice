<?php

namespace app\modules\eoffice_repair\controllers;

use Yii;
use yii\web\Controller;
use app\modules\eoffice_repair\models\EofficeAssetViewAsset;
use app\modules\eoffice_repair\models\EofficeCentralViewPisRoom;
use app\modules\eoffice_repair\models\EofficeCentralViewPisUser;


use app\modules\eoffice_repair\models\RepairDescription;
use app\modules\eoffice_repair\models\RepairImage;
use app\modules\eoffice_repair\models\RepairStatus;
use app\modules\eoffice_repair\models\RepairTracking;
use app\modules\eoffice_repair\models\RepairDescriptionSearch;
use PHPExcel;
use PHPExcel_IOFactory;

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

class Site2Controller extends \yii\web\Controller
{
public function actionIndex()
  {
      $this->layout = "main_modules";
      $TEST = [];
      for ($m = 1 ;$m <= 12 ; $m++) {
          $AllRepair = [];
          if ($m < 10) {
              $model = RepairDescription::find()
                  ->where(['like', 'rep_desc_request_date', '2018-0' . $m . '-%', false])
                  ->all();
              foreach ($model as $item) {
                  $Repair = [];
                  $Repair['rep_desc_id'] = $item->rep_desc_id;
                  $Repair['rep_desc_fname'] = $item->rep_desc_fname;
                  $Repair['rep_desc_lname'] = $item->rep_desc_lname;
                  array_push($AllRepair,$Repair);
              }
              array_push($TEST,$AllRepair);
          }else{
              $model = RepairDescription::find()
                  //->where(['rep_desc_request_date' => '2018-' . '0' . $m . '%'])
                  ->where(['like', 'rep_desc_request_date', '2018-' . $m . '-%', false])
                  ->all();
              foreach ($model as $item) {
                  $Repair = [];
                  $Repair['rep_desc_id'] = $item->rep_desc_id;
                  $Repair['rep_desc_fname'] = $item->rep_desc_fname;
                  $Repair['rep_desc_lname'] = $item->rep_desc_lname;
                  array_push($AllRepair,$Repair);
              }
              array_push($TEST,$AllRepair);
          }
      }

      $month1 = count($TEST[0]);
      $month2 = count($TEST[1]);
      $month3 = count($TEST[2]);
      $month4 = count($TEST[3]);
      $month5 = count($TEST[4]);
      $month6 = count($TEST[5]);
      $month7 = count($TEST[6]);
      $month8 = count($TEST[7]);
      $month9 = count($TEST[8]);
      $month10 = count($TEST[9]);
      $month11 = count($TEST[10]);
      $month12 = count($TEST[11]);

      return $this->render('index',[

          'model' => $model,
          'month1' => $month1,
          'month2' => $month2,
          'month3' => $month3,
          'month4' => $month4,
          'month5' => $month5,
          'month6' => $month6,
          'month7' => $month7,
          'month8' => $month8,
          'month9' => $month9,
          'month10' => $month10,
          'month11' => $month11,
          'month12' => $month12,
          'AllRepair' => $TEST,
      ]);
  }
public function actionYearchart(){
        $this->layout = "main_modules";
        $TEST = [];
        for ($m = 1 ;$m <= 12 ; $m++) {
            $AllRepair = [];
            if ($m < 10) {
                $model = RepairDescription::find()
                    ->where(['like', 'rep_desc_request_date', '2018-0' . $m . '-%', false])
                    ->all();
                foreach ($model as $item) {
                    $Repair = [];
                    $Repair['rep_desc_id'] = $item->rep_desc_id;
                    $Repair['rep_desc_fname'] = $item->rep_desc_fname;
                    $Repair['rep_desc_lname'] = $item->rep_desc_lname;
                    array_push($AllRepair,$Repair);
                }
                array_push($TEST,$AllRepair);
            }else{
                $model = RepairDescription::find()
                    //->where(['rep_desc_request_date' => '2018-' . '0' . $m . '%'])
                    ->where(['like', 'rep_desc_request_date', '2018-' . $m . '-%', false])
                    ->all();
                foreach ($model as $item) {
                    $Repair = [];
                    $Repair['rep_desc_id'] = $item->rep_desc_id;
                    $Repair['rep_desc_fname'] = $item->rep_desc_fname;
                    $Repair['rep_desc_lname'] = $item->rep_desc_lname;
                    array_push($AllRepair,$Repair);
                }
                array_push($TEST,$AllRepair);
            }
        }

        $month1 = count($TEST[0]);
        $month2 = count($TEST[1]);
        $month3 = count($TEST[2]);
        $month4 = count($TEST[3]);
        $month5 = count($TEST[4]);
        $month6 = count($TEST[5]);
        $month7 = count($TEST[6]);
        $month8 = count($TEST[7]);
        $month9 = count($TEST[8]);
        $month10 = count($TEST[9]);
        $month11 = count($TEST[10]);
        $month12 = count($TEST[11]);

        return $this->render('chart',[

            'model' => $model,
            'month1' => $month1,
            'month2' => $month2,
            'month3' => $month3,
            'month4' => $month4,
            'month5' => $month5,
            'month6' => $month6,
            'month7' => $month7,
            'month8' => $month8,
            'month9' => $month9,
            'month10' => $month10,
            'month11' => $month11,
            'month12' => $month12,
            'AllRepair' => $TEST,
        ]);
  }
public function actionMonthchart(){

    $this->layout = "main_modules";
    $month = 5;

    $AllRepair = [];
    $model = RepairDescription::find()
        ->where(['like', 'rep_desc_request_date', '2018-0' . $month . '-%', false])
        ->all();
    foreach ($model as $item) {
        $Repair = [];
        $Repair['rep_desc_id'] = $item->rep_desc_id;
        $Repair['asset_detail_name'] = $item->asset_detail_name;
        $Repair['rep_desc_request_date'] = $item->rep_desc_request_date;
        array_push($AllRepair,$Repair);
    }
    $assetCount = [];
    $modelAsset = RepairDescription::find()
        ->where(['like', 'rep_desc_request_date', '2018-0' . $month . '-%', false])
        ->select('asset_detail_name')
        ->distinct('asset_detail_name')
        ->all();
    foreach ($modelAsset as $item) {
        $asset = [];
        $asset['NAME'] = $item->asset_detail_name;
        $asset['COUNT'] = '';
        array_push($assetCount,$asset);
    }

    for($i = 0 ; $i < count($assetCount) ; $i++){
        $sum = 0;
        for($j = 0 ; $j < count($model);$j++){
            if( $AllRepair[$j]['asset_detail_name'] == $assetCount[$i]['NAME']){
                $sum++;
                $assetCount[$i]['COUNT'] = $sum;
            }
        }
    }

    return $this->render('monthchart',[
        'model' => $model,
        'assetCount' => $assetCount,
    ]);
}
Public function actionExcel()
{
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel(); //สร้างไฟล์ excel
    // Add some data
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'การแจ้งซ่อมต่อเดือน')//กำหนดให้ cell A2 พิมพ์คำว่า Employees Report
        ->setCellValue('A2', 'ชื่อครุภัณฑ์')//กำหนดให้ cell A4 พิมพ์คำว่า employeeNumber
        ->setCellValue('B2', 'จำนวนการแจ้งซ่อม'); //กำหนดให้ cell B4 พิมพ์คำว่า firstName

    $i = 3; // กำหนดค่า i เป็น 6 เพื่อเริ่มพิมพ์ที่แถวที่ 6

    // Write data from MySQL result
    foreach (RepairDescription::find()->all() as $item) { //วนลูปหาพนักงานทั้งหมด
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $item["asset_detail_name"]);
            //กำหนดให้คอลัมม์ A แถวที่ i พิมพ์ค่าของ employeeNumber
        $month = 5;
        $model = RepairDescription::find()
            ->where(['like', 'rep_desc_request_date', '2018-0' . $month . '-%', false])
            ->where(['asset_detail_name'=>$item["asset_detail_name"]])
            ->all();;
        $count = count($model);
        //query หาชื่อจังหวัดที่มีค่าตรงกับ officeCode ของพนักงาน
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $count);

        $i++;
    }

    // Rename sheet
    //$objPHPExcel->getActiveSheet()->setTitle('Employees');

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    //$objPHPExcel->setActiveSheetIndex(0);

    // Save Excel 2007 file
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('TestDescript.xlsx'); // Save File เป็นชื่อ myData.xlsx
    echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/TestDescript.xlsx'), ['class' => 'btn btn-info']);//สร้าง link download
}
    Public function actionExcel2()
    {
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel(); //สร้างไฟล์ excel
        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'การแจ้งซ่อมต่อปี 2561')//กำหนดให้ cell A2 พิมพ์คำว่า Employees Report
            ->setCellValue('A2', 'เดือน')//กำหนดให้ cell A4 พิมพ์คำว่า employeeNumber
            ->setCellValue('A3', 'มกราคม') //กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('A4', 'กุมภาพันธ์') //กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('A5', 'มีนาคม') //กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('A6', 'เมษายน')//กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('A7', 'พฤษภาคม') //กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('A8', 'มิถุนายน') //กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('A9', 'กรกฎาคม') //กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('A10', 'สิงหาคม')//กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('A11', 'กันยายน') //กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('A12', 'ตุลาคม') //กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('A13', 'พฤศจิกายน') //กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('A14', 'ธันวาคม')//กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('B2', 'จำนวนการแจ้งซ่อม');//กำหนดให้ cell B4 พิมพ์คำว่า firstName

        $i = 3; // กำหนดค่า i เป็น 6 เพื่อเริ่มพิมพ์ที่แถวที่ 6
        // Write data from MySQL result
//        foreach (RepairDescription::find()->all() as $item)  //วนลูปหาพนักงานทั้งหมด
           for ($m = 1;$m<=12;$m++){
            $model = RepairDescription::find()
                ->where(['like', 'rep_desc_request_date', '2018-0' . $m . '-%', false])
                ->all();;
            $count = count($model); //query หาชื่อจังหวัดที่มีค่าตรงกับ officeCode ของพนักงาน
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i , $count);
            $i++;
        }
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('YearChart.xlsx'); // Save File เป็นชื่อ myData.xlsx
        echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/YearChart.xlsx'), ['class' => 'btn btn-info']);//สร้าง link download
    }
public function actionPiechart(){
        $this->layout = "main_modules";
        $TEST = [];
        for ($m = 1 ;$m <= 12 ; $m++) {
            $AllRepair = [];
            if ($m < 10) {
                $model = RepairDescription::find()
                    ->where(['like', 'rep_desc_request_date', '2018-0' . $m . '-%', false])
                    ->all();
                foreach ($model as $item) {
                    $Repair = [];
                    $Repair['rep_desc_id'] = $item->rep_desc_id;
                    $Repair['rep_desc_fname'] = $item->rep_desc_fname;
                    $Repair['rep_desc_lname'] = $item->rep_desc_lname;
                    array_push($AllRepair,$Repair);
                }
                array_push($TEST,$AllRepair);
            }else{
                $model = RepairDescription::find()
                    //->where(['rep_desc_request_date' => '2018-' . '0' . $m . '%'])
                    ->where(['like', 'rep_desc_request_date', '2018-' . $m . '-%', false])
                    ->all();
                foreach ($model as $item) {
                    $Repair = [];
                    $Repair['rep_desc_id'] = $item->rep_desc_id;
                    $Repair['rep_desc_fname'] = $item->rep_desc_fname;
                    $Repair['rep_desc_lname'] = $item->rep_desc_lname;
                    array_push($AllRepair,$Repair);
                }
                array_push($TEST,$AllRepair);
            }
        }

        $month1 = count($TEST[0]);
        $month2 = count($TEST[1]);
        $month3 = count($TEST[2]);
        $month4 = count($TEST[3]);
        $month5 = count($TEST[4]);
        $month6 = count($TEST[5]);
        $month7 = count($TEST[6]);
        $month8 = count($TEST[7]);
        $month9 = count($TEST[8]);
        $month10 = count($TEST[9]);
        $month11 = count($TEST[10]);
        $month12 = count($TEST[11]);

        return $this->render('piechart',[

            'model' => $model,
            'month1' => $month1,
            'month2' => $month2,
            'month3' => $month3,
            'month4' => $month4,
            'month5' => $month5,
            'month6' => $month6,
            'month7' => $month7,
            'month8' => $month8,
            'month9' => $month9,
            'month10' => $month10,
            'month11' => $month11,
            'month12' => $month12,
            'AllRepair' => $TEST,
        ]);
    }

    public function actionForm()
  {
    //{

      $this->layout = "main_modules";

      $desc = new  RepairDescription();
      $asset = new EofficeAssetViewAsset();
      $status = new RepairStatus();
      $img = new RepairImage();
      $buliding = new EofficeCentralViewPisRoom();
      //$user = new EofficeCentrViewPisUser();

  //$model = EofficeCentrViewPisPerson::find()->where(['std' => Yii::$app->user->identity->username])->one();
      $desc['rep_desc_fname'] = Site2Controller::getNameuser(Yii::$app->user->identity->id);
      $desc['rep_desc_lname'] = Site2Controller::getLnameuser(Yii::$app->user->identity->id);
      $desc['rep_desc_email'] = Site2Controller::getEmailuser(Yii::$app->user->identity->id) ;
      $desc['rep_desc_tel'] = Site2Controller::getTeluser(Yii::$app->user->identity->id) ;
      $desc['rep_desc_cost'] = "0";

      if ($desc->load(Yii::$app->request->post())) {

        $desc['rep_status_id'] = 1;
        $desc->rep_desc_request_date=date("Y-m-d");
        // $Yii::$app->user->identity->id
        $getName = EofficeAssetViewAsset::find()->where(['asset_detail_id' => $_POST['RepairDescription']['asset_detail_id']])->one();
        $desc->asset_detail_id = $getName['asset_dept_code_start'];
      //  echo $_POST['RepairDescription']['asset_detail_name'];
        $desc->asset_detail_name = $_POST['RepairDescription']['asset_detail_name'];
        $desc->rep_location = $_POST['building'].'/'.$_POST['RepairDescription']['rep_location'];
        //$desc->save();
        // $desc['rep_desc_cost'] = 0;

         $desc->save();
        if($desc->save()){
          return $this->redirect(['index']);
        }

       }else {
        return $this->render('form', [ 'modeldes' => $desc,
        //  'rep2' => $room,
        'rep3' => $asset,
        'rep4' => $status,
        'rep5' => $img,
        'rep6' => $buliding
        //'rep7' => $user
      ]);
    }



    //
    //
    //   $this->layout = "main_modules";
    //
    //   if ($desc->load(Yii::$app->request->post()) && $desc->save() &&
    //    $asset->load(Yii::$app->request->post()) && $asset->save() &&
    //   $status->load(Yii::$app->request->post()) && $status->save() &&
    //   $img->load(Yii::$app->request->post()) && $img->save()&&
    //   $buliding->load(Yii::$app->request->post()) && $buliding->save()&&
    //   $user->load(Yii::$app->request->post()) && $user->save()
    //
    //
    // ) {
    //   return $this->render('/eoffice_repair/repair-description/list-repair');
    //

    //
    //   return $this->render('index');
    // }

  //
  // }
  //
  //
  // $this->layout = "main_modules";
  //
  // return $this->render('form_repair');
}

public function actionForm2()
{
//{

  $this->layout = "main_modules";

  $desc = new  RepairDescription();
  $asset = new EofficeAssetViewAsset();
  $status = new RepairStatus();
  $img = new RepairImage();
  $buliding = new EofficeCentralViewPisRoom();
  //$user = new EofficeCentrViewPisUser();

//$model = EofficeCentrViewPisPerson::find()->where(['std' => Yii::$app->user->identity->username])->one();
  $desc['rep_desc_fname'] = Site2Controller::getNameuser(Yii::$app->user->identity->id);
  $desc['rep_desc_lname'] = Site2Controller::getLnameuser(Yii::$app->user->identity->id);
  $desc['rep_desc_email'] = Site2Controller::getEmailuser(Yii::$app->user->identity->id) ;
  $desc['rep_desc_tel'] = Site2Controller::getTeluser(Yii::$app->user->identity->id) ;
  $desc['rep_desc_cost'] = "0";

  if ($desc->load(Yii::$app->request->post())) {

    $desc['rep_status_id'] = 1;
    $desc->rep_desc_request_date=date("Y-m-d");
    // $Yii::$app->user->identity->id
    // $getName = EofficeAssetViewAsset::find()->where(['asset_detail_id' => $_POST['RepairDescription']['asset_detail_id']])->one();
    // $desc->asset_detail_id = $getName['asset_dept_code_start'];
    $desc->save();
    // $desc['rep_desc_cost'] = 0;
    // $desc->save();
    if($desc->save()){
      return $this->redirect(['index']);
    }

   }else {
    return $this->render('form', [ 'modeldes' => $desc,
    //  'rep2' => $room,
    'rep3' => $asset,
    'rep4' => $status,
    'rep5' => $img,
    'rep6' => $buliding
    //'rep7' => $user
  ]);
}



//
//
//   $this->layout = "main_modules";
//
//   if ($desc->load(Yii::$app->request->post()) && $desc->save() &&
//    $asset->load(Yii::$app->request->post()) && $asset->save() &&
//   $status->load(Yii::$app->request->post()) && $status->save() &&
//   $img->load(Yii::$app->request->post()) && $img->save()&&
//   $buliding->load(Yii::$app->request->post()) && $buliding->save()&&
//   $user->load(Yii::$app->request->post()) && $user->save()
//
//
// ) {
//   return $this->render('/eoffice_repair/repair-description/list-repair');
//

//
//   return $this->render('index');
// }

//
// }
//
//
// $this->layout = "main_modules";
//
// return $this->render('form_repair');
}
// public function actionForm()
//   {
//     //{
//
//       $this->layout = "main_modules";
//
//       $desc = new  RepairDescription();
//       $asset = new EofficeAssetViewAsset();
//       $status = new RepairStatus();
//       $img = new RepairImage();
//       $buliding = new EofficeCentralViewPisRoom();
//       //$user = new EofficeCentrViewPisUser();
//
//   //$model = EofficeCentrViewPisPerson::find()->where(['std' => Yii::$app->user->identity->username])->one();
//       $desc['rep_desc_fname'] = Site2Controller::getNameuser(Yii::$app->user->identity->id);
//       $desc['rep_desc_lname'] = Site2Controller::getLnameuser(Yii::$app->user->identity->id);
//       $desc['rep_desc_email'] = Site2Controller::getEmailuser(Yii::$app->user->identity->id) ;
//       $desc['rep_desc_tel'] = Site2Controller::getTeluser(Yii::$app->user->identity->id) ;
//       $desc['rep_desc_cost'] = "0";
//
//
//       if ($desc->load(Yii::$app->request->post())) {
//
//         try{
//           $desc['rep_status_id'] = 1;
//           $desc->rep_desc_request_date=date("Y-m-d");
//           // $Yii::$app->user->identity->id
//           $getName = EofficeAssetViewAsset::find()->where(['asset_detail_id' => $_POST['RepairDescription']['asset_detail_id']])->one();
//           $desc->asset_detail_id = $getName['asset_dept_code_start'];
//
//           if($desc->save()){
//             return $this->redirect(['index']);
//           }
//         }catch(Exception $e){
//           echo $e->getMessage();
//         }
//         // $desc['rep_desc_cost'] = 0;
//         // $desc->save();
//
//        }else {
//         return $this->render('form_repair', [ 'rep' => $desc,
//         //  'rep2' => $room,
//         'rep3' => $asset,
//         'rep4' => $status,
//         'rep5' => $img,
//         'rep6' => $buliding
//         //'rep7' => $user
//       ]);
//     }
//
//
//
//     //
//     //
//     //   $this->layout = "main_modules";
//     //
//     //if ($desc->load(Yii::$app->request->post()) && $desc->save() &&
//     //    $asset->load(Yii::$app->request->post()) && $asset->save() &&
//     //   $status->load(Yii::$app->request->post()) && $status->save() &&
//     //   $img->load(Yii::$app->request->post()) && $img->save()&&
//     //   $buliding->load(Yii::$app->request->post()) && $buliding->save()&&
//     //   $user->load(Yii::$app->request->post()) && $user->save()
//     //
//     //
//     // ) {
//     //   return $this->render('/eoffice_repair/repair-description/list-repair');
//     //
//
//     //
//     //   return $this->render('index');
//     // }
//
//   //
//   // }
//   //
//   //
//   // $this->layout = "main_modules";
//   //
//   // return $this->render('form_repair');
// }

public function actionGetRate($positionId){
  $position = EofficeAssetViewAsset::find()->where(['asset_detail_id' => $positionId])->one();
  $asset_name = $position['asset_detail_name'];
  $position = EofficeCentralViewPisRoom::find()->where(['rooms_id' => $position['asset_detail_room']])->one();
  //array_push($position,$asset_name);
  $position['room_type_id'] = $asset_name;
  echo Json::encode($position);
}


public static function getNameuser($user_id){
    $name = EofficeCentralViewPisUser::find()->select(['student_fname_th','person_fname_th'])->where(['id'=>$user_id])->one();
    $nameuser = \Yii::$app->user->identity->username;
    if($name->student_fname_th!=null){
        $nameuser = $name->student_fname_th;
    }elseif ($name->person_fname_th!=null){
        $nameuser = $name->person_fname_th;
    }
    return $nameuser;
}
public static function getLnameuser($user_id){
    $lname = EofficeCentralViewPisUser::find()->select(['student_lname_th','person_lname_th'])->where(['id'=>$user_id])->one();
    $lnameuser = \Yii::$app->user->identity->username;
    if($lname->student_lname_th!=null){
        $lnameuser = $lname->student_lname_th;
    }elseif ($lname->person_lname_th!=null){
        $lnameuser = $lname->person_lname_th;
    }
    return $lnameuser;
}
public static function getEmailuser($user_id){
    $email = EofficeCentralViewPisUser::find()->select(['email','STUDENTEMAIL'])->where(['id'=>$user_id])->one();
    $emailuser = \Yii::$app->user->identity->username;
    if($email->email!=null){
        $emailuser = $email->email;
    }elseif ($email->STUDENTEMAIL!=null){
        $emailuser = $email->STUDENTEMAIL;
    }  else
          $emailuser = "-";
    return $emailuser;
}
public static function getTeluser($user_id){
    $tel = EofficeCentralViewPisUser::find()->select(['person_mobile','STUDENTMOBILE'])->where(['id'=>$user_id])->one();
    $teluser = \Yii::$app->user->identity->username;

    if($tel->person_mobile!=null){
        $teluser = $tel->person_mobile;
    }elseif ($tel->STUDENTMOBILE!=null){
        $teluser = $tel->STUDENTMOBILE;
    }
    else
        $teluser = "-";
    return $teluser;
}
}
