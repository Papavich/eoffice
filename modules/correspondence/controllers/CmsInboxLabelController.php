<?php

namespace app\modules\correspondence\controllers;

use app\modules\correspondence\models\InboxLabel;
use app\modules\correspondence\models\LabelDAO;
use app\modules\correspondence\models\MailDAO;
use app\modules\correspondence\models\UserDAO;
use Yii;
use app\modules\correspondence\models\CmsInboxLabel;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CmsInboxLabelController implements the CRUD actions for CmsInboxLabel model.
 */
class CmsInboxLabelController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    /**
     * Lists all CmsInboxLabel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CmsInboxLabel::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsInboxLabel model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CmsInboxLabel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new CmsInboxLabel();
        $user = MailDAO::findUser();
        if (CmsInboxLabel::find()->where(['user_id' => $user->id])
            ->andWhere(['label_name' => $_POST['CmsInboxLabel']['label_name']])
            ->one()) {
            return "ชื่อป้ายกำกับจะต้องไม่ซ้ำกัน";
        } elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function actionCreateLabel()
    {
        $model = new LabelDAO();
        $data = json_decode(stripslashes($_GET['inboxId']));
        $label = CmsInboxLabel::findOne($_GET['labelId']);
        if ($data) {
            if ($model->createNewLabel($label->inbox_label_id, $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            //ไม่ได้เลือกจดหมายที่ต้องการติดดาว
            return true;
        }

        // echo $label->inbox_label_id;
        // return $this->redirect(['mail/inbox']);
    }

    /**
     * Updates an existing CmsInboxLabel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdateLabel()
    {
        $model = new LabelDAO();
        $data = json_decode(stripslashes($_POST['inboxId']));
        $amountDataFromView = count($data);
        $mailHaveLabel = "";
        $label = CmsInboxLabel::find()->where(['label_name' => $_POST['labelName']])->one();
        /*if ($model->createNewLabel($label->inbox_label_id, $data)) {
            return true;
        } else {
            return false;
        }*/
        foreach ($data as $index=>$id) {
            $model_inbox = InboxLabel::find()->where(['inbox_id'=>$id])->one();

            if($model_inbox && $model_inbox->inbox_id == $data[$index]){
                $mailHaveLabel = $model_inbox->inbox->doc->doc_subject.", ".$mailHaveLabel;
                unset($data[$index]);
            }
            //print_r($data);

        }
        $model->createNewLabel($label->inbox_label_id, $data);
        if($amountDataFromView != count($data)) {
            echo substr($mailHaveLabel, 0, -2);
        }


    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->label_name = $_GET['label_name'];
        if (CmsInboxLabel::find()->where(['user_id' => UserDAO::getCurentUser()->id])
            ->andWhere(['label_name' => $_GET['label_name']])
            ->andWhere('inbox_label_id != "'.$model->inbox_label_id.'"')
            ->one()) {
            return "ชื่อป้ายกำกับจะต้องไม่ซ้ำกัน";
        } elseif ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function actionSetId($id)
    {
        $_SESSION['id_label'] = $id;
        $model = CmsInboxLabel::findOne($id);
        echo Json::encode($model);
    }

    /**
     * Deletes an existing CmsInboxLabel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $inboxLabel = InboxLabel::find()->where(['label_id' => $id])->all();
        foreach ($inboxLabel as $label) {
            $label->delete();
        }
        $this->findModel($id)->delete();
        return true;
    }

    public function actionDeleteMessageInLabel()
    {
        $inbox_id = Yii::$app->request->post('inboxId');
        //echo $inbox_id;
        $inboxLabel = InboxLabel::find()->where(['inbox_id' => $inbox_id])->all();
        echo Json::encode($inboxLabel);
        foreach ($inboxLabel as $label) {
            $label->delete();
        }
    }

    /**
     * Finds the CmsInboxLabel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CmsInboxLabel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsInboxLabel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}