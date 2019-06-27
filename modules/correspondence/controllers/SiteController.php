<?php

namespace app\modules\correspondence\controllers;

use app\modules\correspondence\models\CmsDeleteRoll;
use app\modules\correspondence\models\CmsDocFile;
use app\modules\correspondence\models\CmsDocRef;
use app\modules\correspondence\models\CmsDocRollReceive;
use app\modules\correspondence\models\CmsDocRollSend;
use app\modules\correspondence\models\CmsDocument;
use app\modules\correspondence\models\CmsFile;
use app\modules\correspondence\models\CmsInbox;
use app\modules\correspondence\models\CmsOutbox;
use app\modules\correspondence\models\CmsQueue;
use app\modules\correspondence\models\DocumentDAO;
use app\modules\correspondence\models\InboxLabel;
use Yii;
use app\modules\correspondence\models\CmsDocCheck;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SiteController implements the CRUD actions for CmsDocCheck model.
 */
class SiteController extends Controller
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
     * Lists all CmsDocCheck models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_module";
        return $this->render('index');
    }
    public function actionClearDb()
    {
        $model_inbox = CmsInbox::find()->all();
        $model_outbox = CmsOutbox::find()->all();
        $model_label = InboxLabel::find()->all();
        $model_doc_roll_receive = CmsDocRollReceive::find()->all();
        $model_doc_roll_send = CmsDocRollSend::find()->all();
        $model_doc_file = CmsDocFile::find()->all();
        $model_doc_ref = CmsDocRef::find()->all();
        $model_doc = CmsDocument::find()->all();
        $model_quere = CmsQueue::find()->all();
        $model_delete_roll = CmsDeleteRoll::find()->all();

        foreach ($model_quere as $i){
            $i->delete();
        }
        foreach ($model_delete_roll as $i){
            $i->delete();
        }
        foreach ($model_doc_file as $item) {
            $doc_file = CmsDocFile::find()->where(
                ['file_id' => $item['file_id']]
            )->one();
            $doc_file->delete();
            $model_file = CmsFile::findOne($item['file_id']);
            $model_file->delete();
        }
        foreach ($model_label as $label) {
            $label->delete();
        }
        foreach ($model_inbox as $inbox) {
            $inbox->delete();
        }
        foreach ($model_outbox as $outbox) {
            $outbox->delete();
        }
        foreach ($model_doc_roll_receive as $roll) {
            $roll->delete();
        }
        foreach ($model_doc_roll_send as $roll) {
            $roll->delete();
        }
        foreach ($model_doc_ref as $roll) {
            $roll->delete();
        }
        foreach ($model_doc as $doc) {
            $doc->delete();
        }
    }
    /*
     * check permission and role

    if(\Yii::$app->authManager->isAdmin()){
        return $this->redirect('../staff/index');
    }elseif (\Yii::$app->authManager->isStaffFinance()){

    }elseif (\Yii::$app->authManager->isStudent()){

    }elseif (\Yii::$app->authManager->isStaffGeneral()){

    }elseif (\Yii::$app->authManager->isStaffGs()){

    }elseif (\Yii::$app->authManager->isParent()){

    }else{
        return $this->render('index');
    }*/
}
