<?php

namespace app\modules\eoffice_form\controllers;

use Yii;
use app\modules\eoffice_form\models\Considered;
use app\modules\eoffice_form\models\ConsideredSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\eoffice_form\models\UserRequest;

/**
 * ConsideredController implements the CRUD actions for Considered model.
 */
class ConsideredController extends Controller
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
     * Lists all Considered models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new ConsideredSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Considered model.
     * @param integer $user_id
     * @param integer $template_id
     * @param string $cr_date
     * @param integer $cr_term
     * @param integer $cr_year
     * @param integer $approve_group_queue
     * @param integer $approve_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id, $template_id, $cr_date, $cr_term, $cr_year, $approve_group_queue, $approve_id)
    {

        $this->layout = "main_modules";

        $getFormValue = UserRequest::find()->where(['user_id' => $user_id,
            'template_id' => $template_id,
            'cr_date' => $cr_date,
            'cr_term' => $cr_term,
            'cr_year' => $cr_year])->all();
        foreach ($getFormValue as $item) {
            $AllField = $item->req_json;
        }

        return $this->render('view', [
            'AllField' => json_decode($AllField, JSON_UNESCAPED_UNICODE),
            'model' => $this->findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year, $approve_group_queue, $approve_id),

            'user_id' => $user_id,
            'template_id' => $template_id,
            'cr_date' => $cr_date,
            'cr_term' => $cr_term,
            'cr_year' => $cr_year,
        ]);
    }

    /**
     * Finds the Considered model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $template_id
     * @param string $cr_date
     * @param integer $cr_term
     * @param integer $cr_year
     * @param integer $approve_group_queue
     * @param integer $approve_id
     * @return Considered the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year, $approve_group_queue, $approve_id)
    {
        if (($model = Considered::findOne(['user_id' => $user_id, 'template_id' => $template_id, 'cr_date' => $cr_date, 'cr_term' => $cr_term, 'cr_year' => $cr_year, 'approve_group_queue' => $approve_group_queue, 'approve_id' => $approve_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
