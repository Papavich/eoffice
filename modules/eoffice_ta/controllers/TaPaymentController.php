<?php

namespace app\modules\eoffice_ta\controllers;

use Yii;
use app\modules\eoffice_ta\models\TaPayment;
use app\modules\eoffice_ta\models\TaPaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\eoffice_ta\components\Calculation as Calculation;

/**
 * TaPaymentController implements the CRUD actions for TaPayment model.
 */
class TaPaymentController extends Controller
{

    /**
     * {@inheritdoc}
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
     * Lists all TaPayment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaPaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaPayment model.
     * @param string $subject_id
     * @param integer $subject_version
     * @param string $term
     * @param string $year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($subject_id, $subject_version, $term, $year)
    {
        return $this->render('view', [
            'model' => $this->findModel($subject_id, $subject_version, $term, $year),
        ]);
    }

    /**
     * Creates a new TaPayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaPayment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'subject_id' => $model->subject_id, 'subject_version' => $model->subject_version, 'term' => $model->term, 'year' => $model->year]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionAdd($s,$ver,$t,$y,$vip,$nor,$c)
    {
        $levels = [31,34];
        $Calculate = new Calculation();
        $model = new TaPayment();

        if (Yii::$app->request->post()) {
            $A = (int)substr($c, 3, 1); //B
            $B = (int)substr($c, 5, 1); //B
            foreach ($levels as $level) {
                if ($level == 31) {


                    if (($A > 0) && ($B > 0)) {
                        $PaymentMax = $Calculate->getEstimatePaymentMaxALL($s, $ver, $t, $y, $nor);
                        $Wload = $Calculate->getWorkLoadAll($s, $ver, $t, $y, $nor);
                       /* $model->subject_id = $s;
                        $model->subject_version = $ver;
                        $model->term = $t;
                        $model->year = $y;
                        $model->program_id = 31;
                        $model->ta_payment_max = $PaymentMax;
                        $model->workload_value = $Wload;*/
                        $model->save([$model->subject_id = $s,$model->subject_version = $ver,
                            $model->term = $t,$model->year = $y,$model->program_id = 31,
                            $model->ta_payment_max = $PaymentMax,$model->workload_value = $Wload]);
                    } elseif ($B == 0) {
                        $PaymentMax = $Calculate->getEstimatePaymentMaxLec($s, $ver, $t, $y, $nor);
                        $Wload = $Calculate->getWorkLoadLec($s, $ver, $t, $y, $nor);
                        /*$model->subject_id = $s;
                        $model->subject_version = $ver;
                        $model->term = $t;
                        $model->year = $y;
                        $model->program_id = 31;
                        $model->ta_payment_max = $PaymentMax;
                        $model->workload_value = $Wload;*/
                        $model->save([$model->subject_id = $s,$model->subject_version = $ver,
                            $model->term = $t,$model->year = $y,$model->program_id = 31,
                            $model->ta_payment_max = $PaymentMax,$model->workload_value = $Wload]);

                    } elseif ($A == 0) {
                        $PaymentMax = $Calculate->getEstimatePaymentMaxLab($s, $ver, $t, $y, $nor);
                        $Wload = $Calculate->getWorkLoadLab($s, $ver, $t, $y, $nor);
                        /*$model->subject_id = $s;
                        $model->subject_version = $ver;
                        $model->term = $t;
                        $model->year = $y;
                        $model->program_id = 31;
                        $model->ta_payment_max = $PaymentMax;
                        $model->workload_value = $Wload;*/
                        $model->save([$model->subject_id = $s,$model->subject_version = $ver,
                            $model->term = $t,$model->year = $y,$model->program_id = 31,
                            $model->ta_payment_max = $PaymentMax,$model->workload_value = $Wload]);

                    }

                } elseif ($level == 34) {
                   /* $model->subject_id = $s;
                    $model->subject_version = $ver;
                    $model->term = $t;
                    $model->year = $y;

                    $model->program_id = 34;
                    $model->save();*/

                    if (($A > 0) && ($B > 0)) {
                        $PaymentMax = $Calculate->getEstimatePaymentMaxALL($s, $ver, $t, $y, $vip);
                        $Wload = $Calculate->getWorkLoadAll($s, $ver, $t, $y, $vip);
                        //$model->ta_payment_max = $PaymentMax;
                        //$model->workload_value = $Wload;
                        $model->save([$model->subject_id = $s,$model->subject_version = $ver,
                            $model->term = $t,$model->year = $y,$model->program_id = 31,
                            $model->ta_payment_max = $PaymentMax,$model->workload_value = $Wload]);
                    } elseif ($B == 0) {
                        $PaymentMax = $Calculate->getEstimatePaymentMaxLec($s, $ver, $t, $y, $vip);
                        $Wload = $Calculate->getWorkLoadLec($s, $ver, $t, $y, $vip);
                        /*$model->ta_payment_max = $PaymentMax;
                        $model->workload_value = $Wload;
                        $model->save();*/
                        $model->save([$model->subject_id = $s,$model->subject_version = $ver,
                            $model->term = $t,$model->year = $y,$model->program_id = 31,
                            $model->ta_payment_max = $PaymentMax,$model->workload_value = $Wload]);
                    } elseif ($A == 0) {
                        $PaymentMax = $Calculate->getEstimatePaymentMaxLab($s, $ver, $t, $y, $vip);
                        $Wload = $Calculate->getWorkLoadLab($s, $ver, $t, $y, $vip);
                        /*$model->ta_payment_max = $PaymentMax;
                        $model->workload_value = $Wload;
                        $model->save();*/
                        $model->save([$model->subject_id = $s,$model->subject_version = $ver,
                            $model->term = $t,$model->year = $y,$model->program_id = 31,
                            $model->ta_payment_max = $PaymentMax,$model->workload_value = $Wload]);
                    }
                }
            }
        }
        $this->layout = "main_modules";
        return $this->redirect(['staff/check-max-payment-ta']);
    }

    /**
     * Updates an existing TaPayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $subject_id
     * @param integer $subject_version
     * @param string $term
     * @param string $year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($subject_id, $subject_version, $term, $year)
    {
        $model = $this->findModel($subject_id, $subject_version, $term, $year);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'subject_id' => $model->subject_id, 'subject_version' => $model->subject_version, 'term' => $model->term, 'year' => $model->year]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TaPayment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $subject_id
     * @param integer $subject_version
     * @param string $term
     * @param string $year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($subject_id, $subject_version, $term, $year)
    {
        $this->findModel($subject_id, $subject_version, $term, $year)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaPayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $subject_id
     * @param integer $subject_version
     * @param string $term
     * @param string $year
     * @return TaPayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($subject_id, $subject_version, $term, $year)
    {
        if (($model = TaPayment::findOne(['subject_id' => $subject_id, 'subject_version' => $subject_version, 'term' => $term, 'year' => $year])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
