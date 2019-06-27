<?php

namespace app\modules\eoffice_ta\controllers;

use app\modules\eoffice_ta\models\TaComparisonGrade;
use app\modules\eoffice_ta\models\TaProperty;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\pms\models\Model;
use kartik\form\ActiveForm;
use Yii;
use app\modules\eoffice_ta\models\model_central\ViewPisEnroll;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\TaStatus;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\TaRegisterSectionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\data\Pagination;

/**
 * TaRegisterSectionController implements the CRUD actions for TaRegisterSection model.
 */
class TaRegisterSectionController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all TaRegisterSection models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaRegisterSectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "main_modules";
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaRegisterSection model.
     * @param string $section
     * @param string $subject_id
     * @param string $person_id
     * @param string $term
     * @param string $year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($section,$subject_id,$subject_version,$person_id, $term, $year)
    {
        $this->layout = "main_modules";
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($section,$subject_id,$subject_version,$person_id, $term, $year),
        ]);
    }

    public function actionDetailList($subject_id,$subject_version,$person_id, $term, $year)
    {
        $model = TaRegisterSection::find()->where(['subject_id'=>$subject_id,'subject_version'=>$subject_version,
            'person_id'=>$person_id,'term'=>$term,'year'=>$year])->all();
        $this->layout = "main_modules";
        $this->layout = "main_modules";
        return $this->render('detail-list', [
            'model' => $model
        ]);
    }

    public function actionDetailBySubj($s,$ver,$u, $t, $y)
    {
        $model = TaRegister::find()->where(['subject_id'=>$s,'subject_version'=>$ver,
            'person_id'=>$u,'term'=>$t,'year'=>$y])->all();
        $this->layout = "main_modules";
        return $this->render('detail-by-subj', [
            'model' => $model,
            's'=>$s,'ver'=>$ver,'u'=>$u,'t'=>$t,'y'=>$y
        ]);
    }
    /**
     * Creates a new TaRegisterSection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


   /* public function actionCreate($id,$ver,$y,$t)
    {
        $modelRegis = new TaRegister();  //$modelUser
        $modelRegisSec = new TaRegisterSection(); //$modelEmp

        if($modelRegis->load(Yii::$app->request->post()) //&&
            //$modelRegisSec->load(Yii::$app->request->post()) &&
           // Model::validateMultiple([$modelRegis,$modelRegisSec])
            )
        {
            $transaction = $modelRegis::getDb()->beginTransaction();
            try {
                $modelRegis->subject_id = $id;
                $modelRegis->subject_version = $ver;
                $modelRegis->term = $t;
                $modelRegis->year = $y;
                $modelRegis->save();
                $count = count(Yii::$app->request->post('section', []));
                $data = \Yii::$app->request->post();
                //Create an array of the products submitted
                for($i = 1; $i < $count; $i++) {
                    $secs []= new TaRegisterSection();

                foreach ($secs as $sec) {
                    $modelRegisSec->section = $data['section'];
                    $modelRegisSec->subject_id = $modelRegis->subject_id;
                    $modelRegisSec->subject_version = $modelRegis->subject_version;
                    $modelRegisSec->term = $modelRegis->term;
                    $modelRegisSec->year = $modelRegis->year;
                    $modelRegisSec->save();
                }}
                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
            }
            $this->layout = "main_modules";
            return $this->redirect(['view',
                'subject_id' => $modelRegisSec->subject_id,
                'subject_version'=>$modelRegisSec->subject_version,
                'term'=>$modelRegisSec->term,'year'=>$modelRegisSec->year,
                'section'=>$modelRegisSec->section,
                ]);
        } else {
            $this->layout = "main_modules";
            return $this->render('create', [
                'model' => $modelRegisSec,
                'modelRegis'=>$modelRegis,
                'id'=>$id,'ver'=>$modelRegisSec->subject_version,'y'=>$y,'t'=>$t,
            ]);
        }
    }*/

    public function actionUpload()
    {
        $model = new TaRegister();

        if (Yii::$app->request->isPost) {
            $model->ta_image = UploadedFile::getInstance($model, 'ta_image');

            $path = Yii::getAlias('@webroot').'/web_ta/images/register';
            if ($model->validate()) {
                $model->ta_image->saveAs($path.'/'. $model->ta_image->baseName . '.' . $model->ta_image->extension);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
//----------------------------------------- start ใช้อันนี้ๆๆ  ---------------------------------------
    public function actionCreate($id,$ver,$y,$t)
    {
        $modelRegis = new TaRegister();

        $model = new TaRegisterSection();

        $model_comparison = new TaComparisonGrade();
        $user = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
        $u = Yii::$app->formatter->asNtext($user->person_id);

        if (Yii::$app->request->post()){
       // if ($modelRegis->load(Yii::$app->request->post())) {
                $modelRegis->person_id = $u;
                $modelRegis->subject_id = $id;
                $modelRegis->subject_version = $ver;
          //  $modelRegis->ta_image = $_POST['ta_image']; //$model->upload($_POST['ta_image'],'ta_image');;
            //$this->render('upload', ['model' => $modelRegis]);
            $modelRegis->term = $t;
            $modelRegis->year = $y;
            $modelRegis->ta_status_id = TaStatus::START_REGISTER_TA;
            $modelRegis->save();   //-----------SAVE REQUEST ลงแล้ว

                /*$up = Yii::getAlias('@webroot').'/web_ta/images/register'.'/'.$_POST['ta_image'];
                 $img = UploadedFile::getInstance();
                 $img->saveAs($up);
                */
           // $uploadPath = Yii::getAlias('@webroot').'/web_ta/images/register/';
            //$file = \yii\web\UploadedFile::getInstanceByName('ta_image');

           /* if (isset($_FILES['ta_image'])) {
                $file->saveAs(Yii::getAlias('@webroot').'/web_ta/images/register/' .$_POST['ta_image']);

                $modelRegis->ta_image = $_POST['ta_image'];
                $modelRegis->save();
            }*/

            //$modelRegis->ta_image = UploadedFile::getInstance($modelRegis, 'ta_image');

          /*  if ($modelRegis->validate()) {
                $modelRegis->ta_image->saveAs($uploadPath.$modelRegis->ta_image->baseName. $modelRegis->ta_image->extension);
            }
*/

                //$file->saveAs($uploadPath . '/' .$modelRegis->ta_image);

              //$modelRegis->ta_image = UploadedFile::getInstance($modelRegis, 'file');


            /*$model_comparison->load(Yii::$app->request->post());
            $model_comparison->person_id = $u;
            $model_comparison->subject_id = $id;
            $model_comparison->subject_version = $ver;
            $model_comparison->term = $t;
            $model_comparison->year = $y;
            $model_comparison->save();*/

      //---------------------------- Insert multiple records of a same table Yii2  -----------
          /* if(sizeof(array_filter($_POST['ta_type_work_id'])) > 0) {
                foreach ($_POST['ta_type_work_id'] as $key => $row) {
                    $model->setIsNewRecord(true);
                    $model->ta_type_work_id = $row;
                    $model->save();
                }
           }*/

            if(sizeof(array_filter($_POST['section'])) > 0){
                    foreach($_POST['section'] as $key2 => $row2){
                        $sec = substr($row2, 0, 2);
                        $t_work = substr($row2, 2, 1);
                        $model->setIsNewRecord(true);
                        $model->section = $sec;
                        $model->ta_type_work_id = $t_work;
                       /* foreach ($_POST['ta_type_work_id'] as $key => $row) {
                            $model->ta_type_work_id = $row;
                        }*/
                        $model->person_id = $modelRegis->person_id;
                        $model->subject_id = $modelRegis->subject_id;
                        $model->subject_version = $modelRegis->subject_version;
                        $model->term = $modelRegis->term;
                        $model->year = $modelRegis->year;
                        $model->ta_status = TaStatus::START_REGISTER_TA;
                        $model->save();

                    }
                }
            $course2 = EofficeCentralRegCourse::findOne(['COURSECODE'=>$id]);
            $Enroll = ViewPisEnroll::findOne([
                'STUDENTID'=>$user->person_id,'COURSEID'=>$course2->COURSEID]);
            $property = TaProperty::findOne(['level_degree'=>'ปริญญาตรี','active_status'=>'1']);
            if (empty($Enroll)){
                $this->layout = "main_modules";
                return $this->redirect(['ta-comparison-grade/create',
                   's'=>$id,
                    'ver'=>$ver,
                    'y'=>$y,
                    't'=>$t,
                    ]);
            }else{
                $this->layout = "main_modules";
                return $this->redirect(['ta-register/index']);
            }
       //---------------------------- Insert multiple records of a same table Yii2  -----------
               // $this->layout = "main_modules";
                //return $this->redirect(['ta-register/index']);
            } else {
                $this->layout = "main_modules";
                return $this->render('create', [
                    'modelRegis' => $modelRegis,
                    //'modelRegisSec' => $model,
                    'model'=>$model,
                    'id'=>$id,
                    'ver'=>$ver,
                    'y'=>$y,
                    't'=>$t,
                   // 'section' => $section,
                ]);
           }
       }

    //-----------------------------------------end ใช้อันนี้ๆๆ  ---------------------------------------




   /* ------------------- Create Multi records --------------------
   public function actionCreate()
    {
        $registration = new Registrations();
        $players = [];
        for ($i = 0; $i < 5; $i++) {
            $players[] = new Players();
        }
        if ($registration->load(Yii::$app->request->post()) {
        $registration->save();
    }

        if (Model::loadMultiple($players, Yii::$app->request->post()) {
        foreach ($players as $player) {
            $player->regsitrationID = $registration->ID;
            $player->save();
        }
    }
        return $this->render('create',[
            'registration'=>$registration,
            'players' => $players,
        ]);
    }
}*/


    /* /* ------------------- Create Multi Table --------------------
     * if($modelEmp->load(Yii::$app->request->post()) &&
       $modelUser->load(Yii::$app->request->post()) &&
       Model::validateMultiple([$modelEmp,$modelUser]))
    {
        if($modelUser->save()){
          $modelEmp->user_id = $modelUser->id;
          $modelEmp->save();
        }
        return $this->redirect(['view', 'id' => $modelEmp->id]);
    } else {
        return $this->render('create', [
            'model' => $modelEmp,
            'modelUser'=>$modelUser
        ]);
    } */



    /**
     * Updates an existing TaRegisterSection model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $section
     * @param string $subject_id
     * @param string $person_id
     * @param string $term
     * @param string $year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionUpdate($id,$ver,$y,$t)
    {*/
     //   $model = new TaRegisterSection();
        //$model = $this->findModel($section,$subject_version, $subject_id, $person_id, $term, $year);

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->layout = "main_modules";
            return $this->redirect(['view', 'section' => $model->section,
                'subject_id' => $model->subject_id,
                'subject_version'=>$subject_version,
                'person_id' => $model->person_id,
                'term' => $model->term, 'year' => $model->year]);
        }
      */
      /*  $this->layout = "main_modules";
        return $this->render('update', [
            //'model' => $model,
        ]);
    }*/

    public function actionUpdate($id,$ver,$y,$t)
    {
        $modelRegis = new TaRegister();
        // $modelRegisSec = new TaRegisterSection();
        $model = new TaRegisterSection();
        $user = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
        $u = Yii::$app->formatter->asNtext($user->person_id);
        //$u = $user->person_id;

        if (Yii::$app->request->post())

            /*Model::validateMultiple([$modelRegisSec, $modelRegis]))*/
        {
            // $RegisSecs = [new TaRegisterSection()];
            // if ($model->load(Yii::$app->request->post())){
            // $count = count(Yii::$app->request->post('section', []));
            //Create an array of the products submitted

            $modelRegis->person_id = $u;
            $modelRegis->subject_id = $id;
            $modelRegis->subject_version = $ver;
            $modelRegis->term = $t;
            $modelRegis->year = $y;
            $modelRegis->ta_status_id = TaStatus::START_REGISTER_TA;
            $modelRegis->save();   //-----------SAVE REQUEST ลงแล้ว

            //  if (Model::loadMultiple($reg_secs, Yii::$app->request->post()) &&
            //$count = (int)count(\Yii::$app->request->post('section'));
            // for($i = 0; $i <= $count; $i++) {
            //    $secs[] = new TaRegisterSection();

            //   $count2 = count(\Yii::$app->request->post('section',[]));
            //  for($i = 0; $i <= $count; $i++) {
            // $secccs[] = \Yii::$app->
            //  if(!isset(Yii::$app->request->post(['section']))&&$model->save()){
            //  $secccs[] = implode(',',$_POST['section']);
            // $sec_tests[] = implode(',',$_GET['section']);

            // $secccs[] = \Yii::$app->request->get('section');
            // $modelRegisSec->load(Yii::$app->request->post());

            /*foreach ($secccs as $sec) {

               $rs = explode(',',$sec);
              foreach($rs as  $item){
                $model->section =  $item;  //$model->attributes = $_POST['Task'][$i];
                $model->person_id = $modelRegis->person_id;
                $model->subject_id = $modelRegis->subject_id;
                $model->subject_version = $modelRegis->subject_version;
                $model->term = $modelRegis->term;
                $model->year = $modelRegis->year;
                $model->ta_status = TaStatus::START_REGISTER_TA;
                $model->save();
              }
          }*/
            // }
            //---------------------------- Insert multiple records of a same table Yii2  -----------

            if(sizeof(array_filter($_POST['section'])) > 0){
                foreach($_POST['section'] as $key2 => $row2){
                    $sec = substr($row2, 0, 2);
                    $t_work = substr($row2, 2, 1);
                    $model->setIsNewRecord(true);
                    $model->section = $sec;
                    $model->ta_type_work_id = $t_work;
                    /* foreach ($_POST['ta_type_work_id'] as $key => $row) {
                         $model->ta_type_work_id = $row;
                     }*/
                    $model->person_id = $modelRegis->person_id;
                    $model->subject_id = $modelRegis->subject_id;
                    $model->subject_version = $modelRegis->subject_version;
                    $model->term = $modelRegis->term;
                    $model->year = $modelRegis->year;
                    $model->ta_status = TaStatus::START_REGISTER_TA;
                    $model->save();

                }
            }

            //---------------------------- Insert multiple records of a same table Yii2  -----------
            $this->layout = "main_modules";
            return $this->redirect(['ta-register/index']);
        } else {
            $this->layout = "main_modules";
            return $this->render('update', [
                'modelRegis' => $modelRegis,
                //'modelRegisSec' => $model,
                'model'=>$model,
                'id'=>$id,
                'ver'=>$ver,
                'y'=>$y,
                't'=>$t,
                // 'section' => $section,
            ]);
        }
    }



    //NonChoose
    public function actionChooseActive($sec,$type,$s,$ver,$u, $t, $y)
    {
        $model = TaRegister::findOne(['person_id'=>$u,'subject_id'=>$s,'term'=>$t,
            'year'=> $y,]);
        $model2 = TaRegisterSection::findOne(['section'=>$sec,'ta_type_work_id'=>$type,
        'person_id'=>$u,'subject_id'=>$s,'term'=>$t,
            'year'=> $y,
             ]);
            $model2->update($model2->ta_status = TaStatus::CHOOSE_TA);
            $model->update($model2->ta_status = TaStatus::CHOOSE_TA);
            $this->layout = "main_modules";
            return $this->redirect(['detail-by-subj',
                's'=>$s,'ver'=>$ver,'u'=>$u,'t'=>$t,'y'=>$y
            ]);

    }
    public function actionCancelActive($sec,$type,$s,$ver,$u, $t, $y)
    {
        $model2 = TaRegisterSection::findOne(['section'=>$sec,'ta_type_work_id'=>$type,
            'person_id'=>$u,'subject_id'=>$s,'term'=>$t,
            'year'=> $y,
        ]);
        $model2->update($model2->ta_status = TaStatus::START_REGISTER_TA);

        $this->layout = "main_modules";
        return $this->redirect(['detail-by-subj',
            's'=>$s,'ver'=>$ver,'u'=>$u,'t'=>$t,'y'=>$y
        ]);

    }
    public function actionNonActive($sec,$type,$s,$ver,$u, $t, $y)
    {
        $model = TaRegister::findOne(['person_id'=>$u,'subject_id'=>$s,'term'=>$t,
            'year'=> $y,]);
        $model2 = TaRegisterSection::findOne(['section'=>$sec,'ta_type_work_id'=>$type,
            'person_id'=>$u,'subject_id'=>$s,'term'=>$t,
            'year'=> $y,
             ]);
        $model2->update($model2->ta_status = TaStatus::FAIL_CHOOSE_TA);
        $model->update($model2->ta_status = TaStatus::CHOOSE_TA);

        $this->layout = "main_modules";
        return $this->redirect(['detail-by-subj',
            's'=>$s,'ver'=>$ver,'u'=>$u,'t'=>$t,'y'=>$y
        ]);

    }
    /**
     * Deletes an existing TaRegisterSection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $section
     * @param string $subject_id
     * @param string $person_id
     * @param string $term
     * @param string $year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($section, $subject_id,$subject_version, $person_id, $term, $year)
    {
        $this->findModel($section, $subject_id,$subject_version, $person_id, $term, $year)->delete();

        $this->layout = "main_modules";
        return $this->redirect(['index']);
    }

/*
    public function actionImageUpload($id)
    {
        $model = new ScbNews();

        $imageFile = UploadedFile::getInstance($model, 'news_image');

        $directory = Yii::getAlias('../web/web_scb/uploads/news') . DIRECTORY_SEPARATOR;
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }

        if ($imageFile) {
            $fileName = date("dmYHis") . '-' . $imageFile;
            $filePath = $directory . $fileName;
            if ($imageFile->saveAs($filePath)) {
                $path = 'news' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;

                return Json::encode([
                    'files' => [
                        [
                            'name' => $fileName,
                            'size' => $imageFile->size,
                            'url' => $path,
                            'thumbnailUrl' => $path,
                            'deleteUrl' => 'image-delete?name=' . $fileName,
                            'deleteType' => 'POST',
                        ],
                    ],
                ]);
            }
        }

        return '';
    }

    public function actionImageDelete($name)
    {
        $directory = Yii::getAlias('../web/ta/uploads/news') . DIRECTORY_SEPARATOR . Yii::$app->session->id;
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }

        $files = FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file) {
            $fileName = basename($file);
            $path = 'news' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
            $output['files'][] = [
                'name' => $fileName,
                'size' => filesize($file),
                'url' => $path,
                'thumbnailUrl' => $path,
                'deleteUrl' => 'image-delete?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        return Json::encode($output);
    }
*/

    /**
     * Finds the TaRegisterSection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $section
     * @param string $subject_id
     * @param string $person_id
     * @param string $term
     * @param string $year
     * @return TaRegisterSection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($section,$subject_id,$subject_version, $person_id, $term, $year)
    {
        if (($model = TaRegisterSection::findOne(['section' => $section,
                'subject_id' => $subject_id, 'subject_version'=>$subject_version,'person_id' => $person_id, 'term' => $term,
                'year' => $year])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
