<?php

namespace app\modules\eoffice_ta\controllers;

use app\modules\eoffice_ta\models\TaRuleApproach;
use app\modules\eoffice_ta\models\TaTypeRule;
use Yii;
use app\modules\eoffice_ta\models\TaCalculation;
use app\modules\eoffice_ta\models\TaCalculationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\eoffice_ta\models\TaOperator;

/**
 * TaCalculationController implements the CRUD actions for TaCalculation model.
 */
class TaCalculationController extends Controller
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
     * Lists all TaCalculation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaCalculationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "main_modules";
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaCalculation model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEstimatePaymentTa()
    {
        $RuleApproach = TaRuleApproach::findOne(
            ['ta_type_rule_id'=>TaTypeRule::TYPE_R_CREDIT,
                'active_statuss'=>TaRuleApproach::APPROACH_ACTIVE
            ]);
        //$oper = TaOperator::find()->where([''])->all();
        $this->layout = "main_modules";
        return $this->render('estimate-payment-ta',[
            'RuleApproach' => $RuleApproach,
            //'Calculate' =>$Calculate,
        ]);
    }
    public function actionView($id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionNumberta($symbol_value)
    {
        $test= \Yii::$app->request->get('symbol_value');
        $t = \Yii::$app->request->get('symbol_value');
        $Text = $symbol_value+20;
       // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "main_modules";
        return $this->redirect(['test',
           // 'searchModel' => $searchModel,
            //'dataProvider' => $dataProvider,
            'Text' => $Text,
        ]);
    }
    public function actionTest()
    {
       $RuleApproach = TaRuleApproach::findOne(
            ['ta_type_rule_id'=>TaTypeRule::TYPE_R_NUMBER_OF_TA,
                'active_statuss'=>TaRuleApproach::APPROACH_ACTIVE
            ]);

       /* $Main = TaCalculation::findOne(['status_symbol'=>TaCalculation::SYMBOL_MAIN_OR_ANSWER]);
        $Variable = TaCalculation::findOne(['status_symbol'=>TaCalculation::SYMBOL_VARIABLE]);
        $Operator = TaCalculation::findOne(['status_symbol'=>TaCalculation::SYMBOL_OPERATOR]);
       */
        $Calculate = TaCalculation::find()->where(['ta_rule_id' => $RuleApproach->ta_rule_approach_id])
            ->orderBy(['order'=>SORT_ASC])->all();
        $this->layout = "main_modules";
        return $this->render('test',[
            'RuleApproach' => $RuleApproach,
            'Calculate' =>$Calculate,
        ]);
    }



    /**
     * Creates a new TaCalculation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaCalculation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->layout = "main_modules";
            return $this->redirect(['view', 'id' => $model->ta_calculate_id]);
        }

        $this->layout = "main_modules";
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TaCalculation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->layout = "main_modules";
            return $this->redirect(['view', 'id' => $model->ta_calculate_id]);
        }

        $this->layout = "main_modules";
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TaCalculation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaCalculation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaCalculation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaCalculation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
