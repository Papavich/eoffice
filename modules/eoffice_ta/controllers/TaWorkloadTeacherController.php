<?php

namespace app\modules\eoffice_ta\controllers;

use app\modules\eoffice_ta\models\model_central\ViewPisPerson;
use Yii;
use app\modules\eoffice_ta\models\SubjectOpen;
use app\modules\eoffice_ta\models\TaStatus;
use app\modules\eoffice_ta\models\SectionTeacher;
use app\modules\eoffice_ta\models\Kku30Subject;
use app\modules\eoffice_ta\models\Kku30SectionTeacher;
use app\modules\eoffice_ta\models\Kku30SubjectOpen;
use app\modules\eoffice_ta\models\model_central\ViewPisOpenSubject;
use app\modules\eoffice_ta\models\model_central\ViewPisSubjectSectionTeacher;
use app\modules\eoffice_ta\models\model_central\ViewPisSubjectSection;
//use app\modules\eoffice_ta\models\model_kku30\Kku30SectionTeacher;
//use app\modules\eoffice_ta\models\model_kku30\Kku30SubjectOpen;
//use app\modules\eoffice_ta\models\model_kku30\Kku30Subject;
use app\modules\eoffice_ta\models\TaWorkloadTeacher;
use app\modules\eoffice_ta\models\TaWorkloadTeacherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaWorkloadTeacherController implements the CRUD actions for TaWorkloadTeacher model.
 */
class TaWorkloadTeacherController extends Controller
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
     * Lists all TaWorkloadTeacher models.
     * @return mixed
     */
    public function actionIndex($s,$ver,$t,$y)
    {
        $user = ViewPisPerson::findOne(['id' => Yii::$app->user->id]);
        /*$per = Yii::$app->formatter->asNtext($u->person_id);
        echo '<br>'.$per;*/
        $per = $user->person_id;
        $t_name = $user->person_name;
        $t_surname = $user->person_surname;
        $secs = ViewPisSubjectSection::find()->where(
            ['COURSECODE'=>$s,
                'REVISIONCODE'=>$ver,
                'SEMESTER'=>$t,
                'ACADYEAR'=>$y,
                //'OFFICERNAME'=>$t_name,'OFFICERSURNAME'=>$t_surname
            ])->all();

        //$secs = Kku30SectionTeacher::find()->where(['subject_id'=>$s,'subject_version'=>$ver,'subopen_semester'=>$t,'subopen_year'=>$y])->all();
        $subject = ViewPisOpenSubject::findOne(['subject_id'=>$s,
            'REVISIONCODE'=>$ver,'semester_id'=>$t,'year_id'=>$y]);
        //$subject->subject->subject_nameeng;
        $searchModel = new TaWorkloadTeacherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "main_modules";
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'secs' => $secs,
            'subject' => $subject,
            's'=> $s,'ver'=>$ver,'t'=>$t,'y'=>$y,
        ]);
    }

    public function actionIndex2($s,$ver,$t,$y)
    {
        //$user = ViewPisPerson::findOne(['id' => Yii::$app->user->id]);
        /*$per = Yii::$app->formatter->asNtext($u->person_id);
        echo '<br>'.$per;*/
       /* $per = $user->person_id;
        $t_name = $user->person_name;
        $t_surname = $user->person_surname;*/
        $secs = ViewPisSubjectSection::find()->where(
            ['COURSECODE'=>$s,
                'REVISIONCODE'=>$ver,
                'SEMESTER'=>$t,
                'ACADYEAR'=>$y,
                //'OFFICERNAME'=>$t_name,'OFFICERSURNAME'=>$t_surname
            ])->all();

        //$secs = Kku30SectionTeacher::find()->where(['subject_id'=>$s,'subject_version'=>$ver,'subopen_semester'=>$t,'subopen_year'=>$y])->all();
        $subject = ViewPisOpenSubject::findOne(['subject_id'=>$s,
            'REVISIONCODE'=>$ver,'semester_id'=>$t,'year_id'=>$y]);
        //$subject->subject->subject_nameeng;
        $searchModel = new TaWorkloadTeacherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "main_modules";
        return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'secs' => $secs,
            'subject' => $subject,
            's'=> $s,'ver'=>$ver,'t'=>$t,'y'=>$y,
        ]);
    }

    /**
     * Displays a single TaWorkloadTeacher model.
     * @param string $ta_wload_teacher_id
     * @param string $section
     * @param string $subject_id
     * @param integer $subject_version
     * @param string $term
     * @param string $year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ta_wload_teacher_id, $section, $subject_id, $subject_version, $term, $year)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($ta_wload_teacher_id, $section, $subject_id, $subject_version, $term, $year),

        ]);
    }

    public function actionView2($ta_wload_teacher_id, $section, $subject_id, $subject_version, $term, $year)
    {
        $this->layout = "main_modules";
        return $this->render('view2', [
            'model' => $this->findModel($ta_wload_teacher_id, $section, $subject_id, $subject_version, $term, $year),
        ]);
    }

    /**
     * Creates a new TaWorkloadTeacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($sec,$s,$ver,$t,$y)
    {
        $model = new TaWorkloadTeacher();
        $sec = '0'.$sec;
        if ($model->load(Yii::$app->request->post()) ) {
            $model->ta_wload_teacher_id = 'W-S'.$sec.'-'.$s.'-'.$t;
            $model->section = $sec;
            $model->subject_id = $s;
            $model->subject_version = $ver;
            $model->term = $t;
            $model->year = $y;
            $model->ta_status_id = TaStatus::START_REQUEST_TA;
            $model->save();
            return $this->redirect(['view',
                'ta_wload_teacher_id' => $model->ta_wload_teacher_id,
                'section' => $model->section, 'subject_id' => $model->subject_id,
                'subject_version' => $model->subject_version, 'term' => $model->term,
                'year' => $model->year]);
        }

        $this->layout = "main_modules";
        return $this->render('create', [
            'model' => $model,'s'=>$s,
            'ver'=>$ver,'t'=>$t,'y'=>$y,'sec'=>$sec
        ]);
    }


    public function actionCreate2($sec,$s,$ver,$t,$y)
    {
        $model = new TaWorkloadTeacher();
        $sec = '0'.$sec;
        if ($model->load(Yii::$app->request->post()) ) {
            $model->ta_wload_teacher_id = 'W-S'.$sec.'-'.$s.'-'.$t;
            $model->section = $sec;
            $model->subject_id = $s;
            $model->subject_version = $ver;
            $model->term = $t;
            $model->year = $y;
            $model->ta_status_id = TaStatus::START_REQUEST_TA;
            $model->save();
            return $this->redirect(['view2',
                'ta_wload_teacher_id' => $model->ta_wload_teacher_id,
                'section' => $model->section, 'subject_id' => $model->subject_id,
                'subject_version' => $model->subject_version, 'term' => $model->term,
                'year' => $model->year]);
        }

        $this->layout = "main_modules";
        return $this->render('create2', [
            'model' => $model,'s'=>$s,
            'ver'=>$ver,'t'=>$t,'y'=>$y,'sec'=>$sec
        ]);
    }



    /**
     * Updates an existing TaWorkloadTeacher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $ta_wload_teacher_id
     * @param string $section
     * @param string $subject_id
     * @param integer $subject_version
     * @param string $term
     * @param string $year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($sec, $s, $ver, $t, $y)
    {
        $sec = '0'.$sec;
        $wid =  'W-S'.$sec.'-'.$s.'-'.$t;
        $model = $this->findModel($wid, $sec, $s, $ver, $t, $y);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view',
                'ta_wload_teacher_id' => $model->ta_wload_teacher_id,
                'section' => $model->section, 'subject_id' => $model->subject_id,
                'subject_version' => $model->subject_version, 'term' => $model->term,
                'year' => $model->year]);
        }

        $this->layout = "main_modules";
        return $this->render('update', [
            'model' => $model,'s'=>$s,
            'ver'=>$ver,'t'=>$t,'y'=>$y,
        ]);
    }


    public function actionUpdate2($sec, $s, $ver, $t, $y)
    {
        $sec = '0'.$sec;
        $wid =  'W-S'.$sec.'-'.$s.'-'.$t;
        $model = $this->findModel($wid, $sec, $s, $ver, $t, $y);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view2',
                'ta_wload_teacher_id' => $model->ta_wload_teacher_id,
                'section' => $model->section, 'subject_id' => $model->subject_id,
                'subject_version' => $model->subject_version, 'term' => $model->term,
                'year' => $model->year]);
        }

        $this->layout = "main_modules";
        return $this->render('update2', [
            'model' => $model,'s'=>$s,
            'ver'=>$ver,'t'=>$t,'y'=>$y,
        ]);
    }


    /**
     * Deletes an existing TaWorkloadTeacher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ta_wload_teacher_id
     * @param string $section
     * @param string $subject_id
     * @param integer $subject_version
     * @param string $term
     * @param string $year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ta_wload_teacher_id, $section, $subject_id, $subject_version, $term, $year)
    {
        $this->findModel($ta_wload_teacher_id, $section, $subject_id, $subject_version, $term, $year)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaWorkloadTeacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ta_wload_teacher_id
     * @param string $section
     * @param string $subject_id
     * @param integer $subject_version
     * @param string $term
     * @param string $year
     * @return TaWorkloadTeacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ta_wload_teacher_id, $section, $subject_id, $subject_version, $term, $year)
    {
        if (($model = TaWorkloadTeacher::findOne(['ta_wload_teacher_id' => $ta_wload_teacher_id, 'section' => $section, 'subject_id' => $subject_id, 'subject_version' => $subject_version, 'term' => $term, 'year' => $year])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
