<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/13/2017
 * Time: 1:43 PM
 */

namespace app\modules\personsystem\controllers;
use app\modules\personsystem\models\ViewPisUser;
use app\modules\personsystem\models\ViewStudentFull;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
  public  function actionIndex(){

      //Count แยก ตรีโทเอก กราฟวงกลม
      $studentBachelor = ViewStudentFull::find()->where(['LEVELID'=>'34'])->orWhere(['LEVELID'=>'31'])->count();
      $studentMaster = ViewStudentFull::find()->where(['LEVELID'=>'51'])->orWhere(['LEVELID'=>'54'])->orWhere(['LEVELID'=>'55'])->count();
      $studentPhD = ViewStudentFull::find()->where(['LEVELID'=>'71'])->orWhere(['LEVELID'=>'73'])->orWhere(['LEVELID'=>'77'])->count();
      //Count ตรี แยก สาขา ทุกปี
      $BachelorCS = ViewStudentFull::find()->where(['LEVELID'=>'34'])->orWhere(['LEVELID'=>'31'])->andWhere(['major_code'=>'CS'])->count();
      $BachelorIT = ViewStudentFull::find()->where(['LEVELID'=>'34'])->orWhere(['LEVELID'=>'31'])->andWhere(['major_code'=>'IT'])->count();
      $BachelorGIS = ViewStudentFull::find()->where(['LEVELID'=>'34'])->orWhere(['LEVELID'=>'31'])->andWhere(['major_code'=>'GIS'])->count();
      //Count โท แยก สาขา ทุกปี
      $MasterCS = ViewStudentFull::find()->where(['LEVELID'=>'51'])->orWhere(['LEVELID'=>'54'])->orWhere(['LEVELID'=>'55'])->andWhere(['major_code'=>'CS'])->count();
      $MasterIT = ViewStudentFull::find()->where(['LEVELID'=>'51'])->orWhere(['LEVELID'=>'54'])->orWhere(['LEVELID'=>'55'])->andWhere(['major_code'=>'IT'])->count();
      $MasterGIS = ViewStudentFull::find()->where(['LEVELID'=>'51'])->orWhere(['LEVELID'=>'54'])->orWhere(['LEVELID'=>'55'])->andWhere(['major_code'=>'GIS'])->count();
      //Count เอก แยก สาขา ทุกปี
      $PhDCS = ViewStudentFull::find()->where(['LEVELID'=>'71'])->orWhere(['LEVELID'=>'73'])->orWhere(['LEVELID'=>'77'])->andWhere(['major_code'=>'CS'])->count();
      $PhDIT = ViewStudentFull::find()->where(['LEVELID'=>'71'])->orWhere(['LEVELID'=>'73'])->orWhere(['LEVELID'=>'77'])->andWhere(['major_code'=>'IT'])->count();
      $PhDGIS = ViewStudentFull::find()->where(['LEVELID'=>'71'])->orWhere(['LEVELID'=>'73'])->orWhere(['LEVELID'=>'77'])->andWhere(['major_code'=>'GIS'])->count();


      $this->layout = "main_modules";
      return $this->render('index',[
          'studentBachelor'=>  $studentBachelor ,
          'studentMaster'=>  $studentMaster ,
          'studentPhD'=>  $studentPhD ,
          'BachelorCS'=>  $BachelorCS ,
          'BachelorIT'=>  $BachelorIT ,
          'BachelorGIS'=>  $BachelorGIS ,
          'MasterCS'=>  $MasterCS ,
          'MasterIT'=>  $MasterIT ,
          'MasterGIS'=>  $MasterGIS ,
          'PhDCS'=>  $PhDCS ,
          'PhDIT'=>  $PhDIT ,
          'PhDGIS'=>  $PhDGIS ,
      ]);
    }

}