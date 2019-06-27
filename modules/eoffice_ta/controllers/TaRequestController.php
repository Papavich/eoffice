<?php

namespace app\modules\eoffice_ta\controllers;

use app\modules\eoffice_ta\models\TaStatus;
use Yii;
use app\models\Person;
use app\modules\eoffice_ta\models\model_main\PersonView;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\eoffice_ta\models\TaRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaRequestController implements the CRUD actions for TaRequest model.
 */
class TaRequestController extends Controller
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
     * Lists all TaRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->layout = "main_modules";
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaRequest model.
     * @param string $subject_id
     * @param integer $subject_version
     * @param string $term_id
     * @param string $year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView( $s, $ver,$t, $y)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel( $s, $ver,$t, $y),
        ]);
    }

    public function actionView2( $s, $ver,$t, $y)
    {
        $this->layout = "main_modules";
        return $this->render('view2', [
            'model' => $this->findModel( $s, $ver,$t, $y),
        ]);
    }

    /**
     * Creates a new TaRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($s,$t,$y,$ver)
    {
        $model = new TaRequest();
        if ($model->load(Yii::$app->request->post()) ) {
            $model->subject_id = $s;
            $model->subject_version = $ver;
            $model->term_id = $t;
            $model->year = $y;
            $doctorate = $model->degree_doctorate;
            $bachelor = $model->degree_bachelor;
            $master = $model->degree_master;
            $sum = $bachelor+$master+$doctorate;
            $model->amount_ta_all = $sum;
            $model->ta_status_id = TaStatus::START_REQUEST_TA;
            $model->crtime = date('Y-m-d H:i:s');
            $model->crby = Yii::$app->user->id;
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['view',
                's' => $model->subject_id,
                'ver' => $model->subject_version,
                't' => $model->term_id,
                'y' => $model->year]);
        }
        $this->layout = "main_modules";
        return $this->render('create', [
            'model' => $model,
            's_id'=>$s, 't'=>$t,'y'=>$y,
        ]);
    }

    public function actionCreate2($s,$t,$y,$ver)
    {
        $model = new TaRequest();
        if ($model->load(Yii::$app->request->post()) ) {
            $model->subject_id = $s;
            $model->subject_version = $ver;
            $model->term_id = $t;
            $model->year = $y;
            $doctorate = $model->degree_doctorate;
            $bachelor = $model->degree_bachelor;
            $master = $model->degree_master;
            $sum = $bachelor+$master+$doctorate;
            $model->amount_ta_all = $sum;
            $model->ta_status_id = TaStatus::START_REQUEST_TA;
            $model->crtime = date('Y-m-d H:i:s');
            $model->crby = Yii::$app->user->id;
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['view2',
                's' => $model->subject_id,
                'ver' => $model->subject_version,
                't' => $model->term_id,
                'y' => $model->year
            ]);
        }
        $this->layout = "main_modules";
        return $this->render('create2', [
           'model' => $model,
            's_id'=>$s, 't'=>$t,'y'=>$y,

        ]);
    }


    /**
     * Updates an existing TaRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $subject_id
     * @param integer $subject_version
     * @param string $term_id
     * @param string $year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($s,$ver,$t, $y)
    {
        $model = $this->findModel($s,$ver,$t,$y);

        if ($model->load(Yii::$app->request->post()) ) {
            //$model->person_id = $person_id;
            $doctorate = $model->degree_doctorate;
            $bachelor = $model->degree_bachelor;
            $master = $model->degree_master;
            $sum = $bachelor+$master+$doctorate;
            $model->amount_ta_all = $sum;
            $model->subject_id = $s;
            $model->udby = Yii::$app->user->id;
            $model->udtime = date('Y-m-d H:i:s');
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['view',
                's' => $model->subject_id,
                'ver' => $model->subject_version,
                't' => $model->term_id,
                'y' => $model->year]);
        }
        $this->layout = "main_modules";
        return $this->render('update', [
            'model' => $model,
            's_id'=>$s, 't'=>$t,'y'=>$y,
        ]);
    }

    public function actionUpdate2($s,$ver,$t, $y)
    {
        $model = $this->findModel($s,$ver,$t,$y);

        if ($model->load(Yii::$app->request->post()) ) {
            //$model->person_id = $person_id;
            $doctorate = $model->degree_doctorate;
            $bachelor = $model->degree_bachelor;
            $master = $model->degree_master;
            $sum = $bachelor+$master+$doctorate;
            $model->amount_ta_all = $sum;
            $model->subject_id = $s;
            $model->udby = Yii::$app->user->id;
            $model->udtime = date('Y-m-d H:i:s');
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['view2',
                's' => $model->subject_id,
                'ver' => $model->subject_version,
                't' => $model->term_id,
                'y' => $model->year]);
        }
        $this->layout = "main_modules";
        return $this->render('update2', [
            'model' => $model,
           's_id'=>$s, 't'=>$t,'y'=>$y,
        ]);
    }

    /**
     * Deletes an existing TaRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $subject_id
     * @param integer $subject_version
     * @param string $term_id
     * @param string $year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete( $subject_id,$subject_version,$term_id, $year)
    {
        $this->findModel( $subject_id,$subject_version,$term_id, $year)->delete();

        $this->layout = "main_modules";
        return $this->redirect(['index']);
    }

    /**
     * Finds the TaRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $subject_id
     * @param integer $subject_version
     * @param string $term_id
     * @param string $year
     * @return TaRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel( $subject_id,$subject_version, $term_id, $year)
    {
        if (($model = TaRequest::findOne(['subject_id' => $subject_id,'subject_version'=>$subject_version, 'term_id' => $term_id, 'year' => $year])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
