<?php

namespace app\modules\eoffice_consult\controllers;


use Yii;
use app\modules\eoffice_consult\models\ConsultPost;
use app\modules\eoffice_consult\models\ConsultPostSearch;
use app\modules\eoffice_consult\models\ConsultPostStaffSearch;
use app\modules\eoffice_consult\models\ConsultTopicOwner;
use app\modules\eoffice_consult\models\EofficeCentralViewPisUser;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ConsultPostController extends \yii\web\Controller
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

  /**
   * Lists all ConsultPost models.
   * @return mixed
   */
  public function actionIndex()
  {
        $this->layout = "main_modules";
      $searchModel = new ConsultPostSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('index', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);
  }


  public function actionIndex0()
  {
        $this->layout = "main_modules";
      $searchModel = new ConsultPostStaffSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('index0', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);
  }

  /**
   * Displays a single ConsultPost model.
   * @param integer $post_id
   * @param integer $topic_owner_id
   * @param integer $respon_id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionView($post_id, $topic_owner_id, $respon_id)
  {
        $this->layout = "main_modules";
      return $this->render('view', [
          'model' => $this->findModel($post_id, $topic_owner_id, $respon_id),
      ]);
  }

  /**
   * Creates a new ConsultPost model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
      $this->layout = "main_modules";
      $model = new ConsultPost();

      if ($model->load(Yii::$app->request->post())) {
      $owner = ConsultTopicOwner::find()->where(['topic_owner_id' => $_POST['ConsultPost']['topic_owner_id']])->one();
          $model->respon_id = $owner['respon_id'];
          $model->user_id = Yii::$app->user->identity->id;
          $model->save();
          return $this->redirect(['index', 'post_id' => $model->post_id, 'topic_owner_id' => $model->topic_owner_id, 'respon_id' => $model->respon_id]);
      }

      return $this->render('create', [
          'model' => $model,
      ]);
  }

  public function actionTransfer($post_id, $topic_owner_id, $respon_id)
  {
      $this->layout = "main_modules";
      $model = $this->findModel($post_id, $topic_owner_id, $respon_id);

      if ($model->load(Yii::$app->request->post()) ) {
        $model->topic_owner_id = 0;
        $model->respon_id = $_POST['ConsultPost']['respon_id'];
        $model->save(false);

        return $this->render('TransferComplete', [
            'model' => $model,
        ]);
      }

      return $this->render('transfer', [
          'model' => $model,
      ]);
  }

  /**
   * Updates an existing ConsultPost model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $post_id
   * @param integer $topic_owner_id
   * @param integer $respon_id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($post_id, $topic_owner_id, $respon_id)
  {
        $this->layout = "main_modules";
      $model = $this->findModel($post_id, $topic_owner_id, $respon_id);

      if ($model->load(Yii::$app->request->post()) ) {

        $owner = ConsultTopicOwner::find()->where(['topic_owner_id' => $_POST['ConsultPost']['topic_owner_id']])->one();
            $model->respon_id = $owner['respon_id'];
            $model->save();
          return $this->redirect(['index0', 'post_id' => $model->post_id, 'topic_owner_id' => $model->topic_owner_id, 'respon_id' => $model->respon_id]);
      }

      return $this->render('update', [
          'model' => $model,
      ]);
  }

  /**
   * Deletes an existing ConsultPost model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $post_id
   * @param integer $topic_owner_id
   * @param integer $respon_id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($post_id, $topic_owner_id, $respon_id)
  {
        $this->layout = "main_modules";
      $this->findModel($post_id, $topic_owner_id, $respon_id)->delete();

      return $this->redirect(['index']);
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



  /**
   * Finds the ConsultPost model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $post_id
   * @param integer $topic_owner_id
   * @param integer $respon_id
   * @return ConsultPost the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($post_id, $topic_owner_id, $respon_id)
  {
      if (($model = ConsultPost::findOne(['post_id' => $post_id, 'topic_owner_id' => $topic_owner_id, 'respon_id' => $respon_id])) !== null) {
          return $model;
      }

      throw new NotFoundHttpException('The requested page does not exist.');
  }
}
