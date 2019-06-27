<?php

namespace app\modules\eoffice_ta\controllers;

//use app\models\Person;
use app\modules\eoffice_ta\models\model_main\PersonView;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\model_main\Person;
use app\models\User;
use app\modules\eoffice_ta\models\SubjectOpen;
use app\modules\eoffice_ta\models\Kku30SubjectOpen;
use app\modules\eoffice_ta\models\TaStatus;
use app\modules\eoffice_ta\models\Term;
use Yii;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\model_main\Studentreg;
use app\modules\eoffice_ta\models\TaRegisterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaRegisterController implements the CRUD actions for TaRegister model.
 */
class TaRegisterController extends Controller
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
                    'choose-active' => ['POST'],
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
     * Lists all TaRegister models.
     * @return mixed
     */
    public function actionIndex()
    {
      /*  $searchModel = new TaRegisterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "main_modules";
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/
        //$model = SubjectOpen::find()->all();
        $model = Kku30SubjectOpen::find()->orderBy(['subject_id'=>SORT_ASC])->all();
        $this->layout = "main_modules";
        return $this->render('index',[
            'model' => $model,
        ]);
    }



    /**
     * Displays a single TaRegister model.
     * @param string $subject_id
     * @param string $person_id
     * @param string $term
     * @param string $year
     * @return mixed
     */
    public function actionView($subject_id, $person_id, $term, $year)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($subject_id, $person_id, $term, $year),
        ]);
    }

    public function actionChooseTa2($s,$t)
    {
        $model = TaRegister::find()->where([
            'subject_id'=>$s,
            'term'=>$t,
            'ta_status_id'=>[
                TaStatus::START_REGISTER_TA ,
                TaStatus::CHOOSE_TA,
                TaStatus::FAIL_CHOOSE_TA
            ]
        ])->all();
        $this->layout = "main_modules";
        return $this->render('choose-ta2', [
            'model' => $model,
            't' => $t, 's'=>$s
        ]);
    }
  /*  public function actionChooseActive($id,$t,$s)
    {
        $std_list = TaRegister::find()->where([
            'subject_id' => $s,
            'term' => $t,
            'ta_status_id' => [
                TaStatus::START_REGISTER_TA,
                TaStatus::CHOOSE_TA,
                TaStatus::FAIL_CHOOSE_TA
            ]
        ])->all();
        $user = Person::findOne(['user_id'=>$id]);
        $u = $user->person_citizen_id;

        $model2 = TaRegister::findOne(['person_id'=>$id,'subject_id'=>$s,'term'=>$t]);
        $term = Term::findOne(['term_id' => $t]);
        $y = $term->year;
        $model = $this->findModel($id, $s, $t, $y);
        if ($model2->save()) {
            //$model2->ta_status_id = 'RG-CH';
            $model2->update($model2->ta_status_id = TaStatus::CHOOSE_TA);
        $this->layout = "main_modules";
        return $this->redirect('choose-ta2', [
            'model' => $std_list,
            's' => $s, 't' => $t,
        ]);
    }
    }*/

    /**
     * Creates a new TaRegister model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id,$y,$t)
    {
        //$u = Person::findOne(Yii::$app->user->id);  ทำแบบนี้ไม่ได้นะ
       // $user = PersonView::findOne(['id' => Yii::$app->user->id]);
        $user = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
        //$per = convert_cyr_string($user->person_id);
        //$per = Yii::$app->formatter->asSpellout($u);
        $per = Yii::$app->formatter->asNtext($user->person_id);
        $per = $user->person_id;
        $model = new TaRegister();
        if ($model->load(Yii::$app->request->post()) ) {
            //$subj = SubjectOpen::findOne($id);  <-----ผิดตรงนี้ จะขึ้น ERROR "must have a primary key."
            $model->subject_id = $id;
            $model->person_id =  $per;
            $model->term = $t;
            $model->year = $y;
            $model->ta_status_id = TaStatus::START_REGISTER_TA;
            $model->crtime = date('Y-m-d H:i:s');
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['index']);
        } else {
            $this->layout = "main_modules";
            return $this->render('create', [
                'model' => $model,
                'id'=>$id,
                't'=>$t,
                'y'=>$y,
                //'u'=>$u,
            ]);
        }
    }

    /**
     * Updates an existing TaRegister model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $subject_id
     * @param string $person_id
     * @param string $term
     * @param string $year
     * @return mixed
     */
    public function actionUpdate($s, $t, $y)
    {
       // $user = PersonView::findOne(['id' => Yii::$app->user->id]);
        $user = EofficeMainUser::findOne(['id' => Yii::$app->user->id]);
        $u = Yii::$app->formatter->asNtext($user->person_id);
        $model = $this->findModel($s, $u, $t, $y);
        if ($model->load(Yii::$app->request->post()) ) {
            $model->udtime = date('Y-m-d H:i:s');
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['view', 'subject_id' => $model->subject_id, 'person_id' => $model->person_id, 'term' => $model->term, 'year' => $model->year]);
        } else {
            $this->layout = "main_modules";
            return $this->render('update', [
                'model' => $model,
                'id'=>$s,
                't'=>$t,
                'y'=>$y,
            ]);
        }
    }

    /**
     * Deletes an existing TaRegister model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $subject_id
     * @param string $person_id
     * @param string $term
     * @param string $year
     * @return mixed
     */
    public function actionDelete($s,$u,$t,$y)
    {
        $this->findModel($s,$u,$t,$y)->delete();

        $this->layout = "main_modules";
        return $this->redirect(['index']);
    }

    /**
     * Finds the TaRegister model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $subject_id
     * @param string $person_id
     * @param string $term
     * @param string $year
     * @return TaRegister the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($s, $u, $t, $y)
    {
        if (($model = TaRegister::findOne(['subject_id' => $s, 'person_id' => $u, 'term' => $t, 'year' => $y])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
