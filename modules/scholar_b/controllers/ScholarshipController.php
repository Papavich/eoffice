<?php

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\ScbScholarshipTypeHasYear;
use app\modules\scholar_b\models\ScbScholarshipType;
use Yii;
use app\modules\scholar_b\models\ScbEnrollScholarship;
use app\modules\scholar_b\models\ScbEnrollScholarshipSearch;
use app\modules\scholar_b\models\ScbEvidenceFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ScholarshipController implements the CRUD actions for ScbEnrollScholarship model.
 */
class ScholarshipController extends Controller
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
     * Lists all ScbEnrollScholarship models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScbEnrollScholarshipSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ScbEnrollScholarship model.
     * @param string $candidate_id_card
     * @param string $scholarship_id
     * @param integer $scholarship_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($candidate_id_card, $scholarship_id, $scholarship_year)
    {
        return $this->render('view', [
            'model' => $this->findModel($candidate_id_card, $scholarship_id, $scholarship_year),
        ]);
    }

    /**
     * Creates a new ScbEnrollScholarship model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ScbEnrollScholarship();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view',
                'candidate_id_card' => $model->candidate_id_card,
                'scholarship_id' => $model->scholarship_id,
                'scholarship_year' => $model->scholarship_year]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ScbEnrollScholarship model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $candidate_id_card
     * @param string $scholarship_id
     * @param integer $scholarship_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($candidate_id_card, $scholarship_id, $scholarship_year)
    {
        $model = $this->findModel($candidate_id_card, $scholarship_id, $scholarship_year);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'candidate_id_card' => $model->candidate_id_card, 'scholarship_id' => $model->scholarship_id, 'scholarship_year' => $model->scholarship_year]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ScbEnrollScholarship model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $candidate_id_card
     * @param string $scholarship_id
     * @param integer $scholarship_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($candidate_id_card, $scholarship_id, $scholarship_year)
    {
        $this->findModel($candidate_id_card, $scholarship_id, $scholarship_year)->delete();

        return $this->redirect(['index']);
    }

    public function actionDetailScb1($id)
    {
        $this->layout = "main_guest";
        $session = Yii::$app->session;
        $session->open();

        if (isset($session['id_card']) && isset($session['password'])) {
            $this->layout = "main_user";
            //------------
            $scholarship_id = substr($id,4);
            $scholarship_year = str_replace($scholarship_id,"",$id);
            $model = ScbScholarshipTypeHasYear::find()->where(['scholarship_id'=>$scholarship_id,'scholarship_year'=>$scholarship_year])->one();
            return $this->render('detail-scb1', [
                'model' => $model,
            ]);

        }
    }


    public function actionRegister1()
    {
        $this->layout = "main_user";
        $session = Yii::$app->session;
        $session->open();

        if (isset($session['id_card']) && isset($session['password'])) {
            $model_scb = new ScbEnrollScholarship();
            $model_evi_file = new ScbEvidenceFile();


            if ($model_scb->load(Yii::$app->request->post())) {
                $model_scb->candidate_id_card = $session['id_card'];
                $model_scb->scholarship_id = 'P013';
                $model_scb->scholarship_year = 2561;
                $model_scb->save();

                $model_evi_file->load(Yii::$app->request->post());
                $model_evi_file->candidate_id_card = $session['id_card'];
                $model_evi_file->scholarship_id = 'P013';
                $model_evi_file->scholarship_year = 2561;
                $model_evi_file->save();


                return $this->redirect(['view',
                    'candidate_id_card' => $model_scb->candidate_id_card,
                    'scholarshipe_id' => $model_scb->scholarship_id = 'P013',
                    'scholarship_year' => $model_scb->scholarship_year = 2561,
                    'model_scb' => $model_scb,


                ]);
            }

            return $this->render('register1', [
                'model_scb' => $model_scb,
                'model_evi_file' => $model_evi_file,
            ]);
        } else {
            return $this->redirect('login-fail');
        }


    }

    public function actionIndexscb()
    {
        $this->layout = "main_user";
        $session = Yii::$app->session;
        $session->open();

        if (isset($session['id_card']) && isset($session['password'])) {
            $this->layout = "main_user";
            $model = ScbScholarshipType::find()->all();
            return $this->render('indexscb', [
                'model' => $model
            ]);

        } else {
            return $this->redirect('login-fail');
        }
    }


    /**
     * Finds the ScbEnrollScholarship model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $candidate_id_card
     * @param string $scholarship_id
     * @param integer $scholarship_year
     * @return ScbEnrollScholarship the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($candidate_id_card, $scholarship_id, $scholarship_year)
    {
        if (($model = ScbEnrollScholarship::findOne(['candidate_id_card' => $candidate_id_card, 'scholarship_id' => $scholarship_id, 'scholarship_year' => $scholarship_year])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
