<?php
/**
 * Created by PhpStorm.
 * User: VaraPhon
 * Date: 6/27/2017
 * Time: 2:40 PM
 */

namespace app\modules\correspondence\controllers;


use app\modules\correspondence\controllers;
use app\modules\correspondence\models\CmsDocument;
use app\modules\correspondence\models\CmsInbox;
use app\modules\correspondence\models\CmsInboxLabel;
use app\modules\correspondence\models\CmsOutbox;
use app\modules\correspondence\models\CmsQueue;
use app\modules\correspondence\models\FileDAO;
use app\modules\correspondence\models\InboxLabel;
use app\modules\correspondence\models\LabelDAO;
use app\modules\correspondence\models\MailDAO;
use \app\modules\correspondence\models\gridview\MailGridView;
use app\modules\correspondence\models\MailSearch;
use app\modules\correspondence\models\model_main\EofficeCentralViewPisPerson;
use app\modules\correspondence\models\model_main\EofficeCentralViewPisUser;
use app\modules\correspondence\models\User;
use app\modules\correspondence\models\UserDAO;
use Yii;
use yii\data\Pagination;
use yii\db\Expression;
use yii\helpers\Json;
use yii\web\Controller;

class MailController extends Controller
{
    public function actionInbox()
    {
        $this->layout = "main_module";
        $checkUser = new UserDAO();
        $model = new MailDAO();
        $gridView = new MailGridView();
        $getUserFromView = EofficeCentralViewPisUser::findOne(Yii::$app->user->identity->id);
        $user = User::find()->where(['personcode' => $getUserFromView->person_id])->one();
        $searchData = $this->setSearchData();
        $searchModel = new MailSearch();
        if (!\Yii::$app->authManager->isAdmin() && !\Yii::$app->authManager->isStaffGeneral()) {
            $gridColumns = $gridView->gridViewColumsForUser(Yii::$app->request->queryParams);
        } else {
            $gridColumns = $gridView->gridViewColumsForAdmin(Yii::$app->request->queryParams);
        }
        //print_r($searchData);
        if ($user) {
            $checkUser->updateUsername(Yii::$app->user->identity->id);
            $searchModel = new MailSearch();
            $model = $model->findInbox();
            if (Yii::$app->request->get('keyword')) {
                $model_doc = ElasticCmsDocumentController::SearchFromMailController();
                $dataProvider = $searchModel->findInbox(Yii::$app->request->queryParams, $model_doc[0]);
                return $this->render('inbox', [
                    'dataProvider' => $dataProvider[0],
                    'model_label' => $model[1],
                    'pages' => $dataProvider[1],
                    'searchData' => $searchData,
                    'gridColumns' => $gridColumns,
                ]);
            } else {
                $dataProvider = $searchModel->findInbox(Yii::$app->request->queryParams, null);
                return $this->render('inbox', [
                    'dataProvider' => $dataProvider[0],
                    'model_label' => $model[1],
                    'pages' => $dataProvider[1],
                    'searchData' => $searchData,
                    'gridColumns' => $gridColumns,
                ]);
            }

        } else { //new user login to CMS system
            $id = $checkUser->createUsername(Yii::$app->user->identity->id);
            $model = $model->findInbox($id);
            $dataProvider = $searchModel->findInbox(Yii::$app->request->queryParams, null);
            return $this->render('inbox', [
                'dataProvider' => $dataProvider[0],
                'model_label' => $model[1],
                'pages' => $dataProvider[1],
                'searchData' => $searchData,
                'gridColumns' => $gridColumns,
            ]);
        }
    }

    public function actionCategory()
    {
        $this->layout = "main_module";
        $model = new MailDAO();
        $searchModel = new MailSearch();
        $gridView = new MailGridView();
        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        $searchData = $this->setSearchData();
        //print_r($searchData);
        if (Yii::$app->request->get('address_id')) {
            if (!\Yii::$app->authManager->isAdmin() && !\Yii::$app->authManager->isStaffGeneral()) {
                $gridColumns = $gridView->gridViewColumsForUser(Yii::$app->request->queryParams);
            } else {
                $gridColumns = $gridView->gridViewColumsForAdmin(Yii::$app->request->queryParams);
            }
            $model = $model->findInbox();
            $dataProvider = $searchModel->findInbox(Yii::$app->request->queryParams, null);
            return $this->render('category', [
                'dataProvider' => $dataProvider[0],
                'model_label' => $model[1],
                'pages' => $dataProvider[1],
                'searchData' => $searchData,
                'gridColumns' => $gridColumns,
            ]);
        } else {
            $gridColumns = $gridView->gridViewCategory(Yii::$app->request->queryParams);
            $model = $model->findInbox();
            $dataProvider = $searchModel->findInboxByCategory(Yii::$app->request->queryParams);
            return $this->render('category', [
                'dataProvider' => $dataProvider[0],
                'model_label' => $model[1],
                'pages' => $dataProvider[1],
                'searchData' => $searchData,
                'gridColumns' => $gridColumns,
            ]);
        }

    }

    public function actionLabels()
    {
        $this->layout = "main_module";
        $gridView = new MailGridView();
        $searchModel = new MailSearch();
        $searchData = $this->setSearchData();
        $user = UserDAO::getCurentUser();
        $model_label = CmsInboxLabel::find()
            ->from(['cms_inbox', 'cms_inbox_label'])
            ->where(['cms_inbox_label.user_id' => UserDAO::getCurentUser()->id])
            ->andWhere(['cms_inbox.inbox_trash' => 0])
            ->groupBy(['cms_inbox_label.inbox_label_id'])
            ->all();

        if (!\Yii::$app->authManager->isAdmin() && !\Yii::$app->authManager->isStaffGeneral()) {
            $gridColumns = $gridView->gridViewColumsForUser(Yii::$app->request->queryParams);
        } else {
            $gridColumns = $gridView->gridViewColumsForAdmin(Yii::$app->request->queryParams);
        }
        $dataProvider = $searchModel->findInbox(Yii::$app->request->queryParams, null);
        return $this->render('labels-mail', [
            'model_label' => $model_label,
            'pages' => $dataProvider[1],
            'searchData' => $searchData,
            'gridColumns' => $gridColumns,
            'user' => $user
        ]);
        /*return $this->render('labels-mail', ['model_inbox' => $model_inbox, 'model_label' => $model_label
        ,'searchData'=>$searchData]);*/
    }

    /* ****************************************** ReadMail ***************************************** */
    public function actionReadMail($id)
    {
        //read mail from inbox menu and when user click this mail system will update status = read
        $this->layout = "main_module";
        $mailDAO = new MailDAO();
        if (!\Yii::$app->authManager->isAdmin() && !\Yii::$app->authManager->isStaffGeneral()) {
            $mailDAO->openMail($id);
        }
        $receiver = $mailDAO->findReceiverByInbox($id);
        $inboxDocId = CmsInbox::find()->where('inbox_id = "' . $id . '"')->one();
        $query = CmsInbox::find()->where(['doc_id' => $inboxDocId->doc_id])
            ->andWhere('message_reply IS NOT NULL OR message_approve IS NOT NULL')
            ->orderBy(['message_reply_time' => SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 3]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        //var_dump($models);
        $tabBar = $this->getNewAndOld($id);
        return $this->render('read-mail', ['model_document' => CmsInbox::findOne($id)
            , 'inbox_reply' => $models, 'pages' => $pages, 'receiver' => $receiver,
            'newer' => $tabBar[0], 'older' => $tabBar[1]]);

    }

    public function actionReadSendMail($id)
    {
        //read sent mail from outbox
        $this->layout = "main_module";
        $model_outbox = CmsOutbox::findOne($id);
        if ($model_outbox)
        {
            $query = CmsInbox::find()->where(['doc_id' => $model_outbox->doc_id])
                ->andWhere('message_reply IS NOT NULL OR message_approve IS NOT NULL')
                ->orderBy(['message_reply_time' => SORT_DESC]);
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 3]);
            $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
            $mailDAO = new MailDAO();
            if (\Yii::$app->authManager->isAdmin() || \Yii::$app->authManager->isStaffGeneral()) {
                $receiver = $mailDAO->findReceiverByInbox($id);
            } else {
                $receiver = CmsOutbox::find()
                    ->where(['user_id' => Yii::$app->user->identity->username])
                    ->groupBy('user_id')
                    ->all();
            }
            $tabBar = $this->getNewAndOld($id);
            return $this->render('read-send-mail', ['model_document' => $model_outbox
                , 'inbox_reply' => $models, 'pages' => $pages, 'receiver' => $receiver,
                'newerOfSendMail' => $tabBar[0], 'olderOfSendMail' => $tabBar[1]]);
        }else{
            return $this->redirect('sent-mail');
        }

    }

    public function actionReadReplyMail($id)
    {
        //staff click notification to see what user reply in /staff/index
        $this->layout = "main_module";
        $model_outbox = CmsOutbox::findOne($id);
//        $inbox_reply = CmsInbox::find()->where(['doc_id' => $model_outbox->doc_id])
//            ->orderBy(['message_reply_time' => SORT_DESC]);
        $inbox_reply = CmsInbox::find()->where(['doc_id' => $model_outbox->doc_id])
            ->andWhere('message_reply IS NOT NULL OR message_approve IS NOT NULL')
            ->orderBy(['message_reply_time' => SORT_DESC]);
        $countQuery = clone $inbox_reply;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 3]);
        $models = $inbox_reply->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $mailDAO = new MailDAO();
        $mailDAO->updateOutboxStatus($id);
        $receiver = $mailDAO->findReceiver($model_outbox->doc_id);
        //echo Json::encode($receiver);
        $tabBar = $this->getNewAndOldForAdmin($id);
        return $this->render('read-send-mail', [
            'model_document' => $model_outbox,
            'pages' => $pages, 'receiver' => $receiver,
            'inbox_reply' => $models,
            'newer' => $tabBar[0], 'older' => $tabBar[1]]);
    }

    public function actionUpdateReadAll()
    {
        $mailDAO = new MailDAO();
        $data = json_decode(stripslashes($_POST['id']));
        //print_r( $data);
        $mailDAO->readAllMail($data);
    }

    /* ****************************************** Reply ***************************************** */
    public function actionReplyMail()
    {
        $this->layout = "main_module";
        $replyMail = new MailDAO();
        if ($_POST['sendType'] == "reply") {
            $replyMail->replyMail($_POST['inbox_id'], $_POST['comment']);
        }
    }

    public function actionReplyMailFromSentPage()
    {
        //ตอบกลับในหน้า read send mail
        $replyMail = new MailDAO();
        $replyMail->replyFromSentPage($_POST['inbox_id'], $_POST['comment']);
        // $inbox_reply = CmsInbox::find()->where(['doc_id' => CmsInbox::findOne($_POST['inbox_id'])->doc_id])->all();

        $model_outbox = CmsOutbox::findOne($_POST['inbox_id']);
        $inbox_reply = CmsInbox::find()->where('doc_id = "' . $model_outbox->doc_id . '"')->all();
        $mailDAO = new MailDAO();
        if (Yii::$app->user->identity->username == "admin") {
            $receiver = $mailDAO->findReceiverByInbox($_POST['inbox_id']);
        } else {
            $receiver = CmsOutbox::find()->where(['user_id' => Yii::$app->user->identity->username])->all();
        }

//        return $this->render('read-send-mail', ['model_outbox' => $model_outbox
//            , 'inbox_reply' => $inbox_reply, 'receiver' => $receiver]);

    }

    /* ****************************************** Cancel ***************************************** */
    public function actionCancelMessage($message, $inbox)
    {
        $inboxx = CmsInbox::findOne($message);
        $outboxId = $inboxx->outbox_id;
        $label = InboxLabel::find()->where(['inbox_id' => $message])->all();
        foreach ($label as $item) {
            $item->delete();
        }
        $outbox = CmsOutbox::findOne($outboxId);
        $inboxx->delete();
        $outbox->delete();
        // return $this->redirect(['read-mail?id=' . $inbox . '#bottom']);
    }

    public function actionCancelMessageInSentMail($message, $inbox)
    {
        $inboxx = CmsInbox::findOne($message);
        $outboxId = $inboxx->outbox_id;
        $label = InboxLabel::find()->where(['inbox_id' => $message])->all();
        foreach ($label as $item) {
            $item->delete();
        }
        $outbox = CmsOutbox::findOne($outboxId);
        $inboxx->delete();
        $outbox->delete();
        return $this->redirect(['read-send-mail?id=' . $inbox . '#bottom']);
    }

    /* ****************************************** Forward ***************************************** */
    public function actionForwardMail()
    {
        $model = new MailDAO();
        $data = json_decode(stripslashes($_POST['listmail']));
        $inbox_id = $_POST['inbox_id'];
        $content = $_POST['comment'];
        //echo $inbox_id . " " . $content . " " . $_POST['listmail'];
        $model->forwardMail($data, $inbox_id, $content);
        // return $this->redirect(['read-mail?id=' . $inbox_id . '#bottom']);
    }

    public function actionDetail_book($id)
    {
        $this->layout = "main_module.php";
        return $this->redirect(['staff-receive/detail_book?id=' . $id]);


    }

    /* ****************************************** APPROVE ***************************************** */
    public function actionApproveBook()
    {
        $inbox_id = $_POST['inbox_id'];
        $content = $_POST['comment'];
        $status = $_POST['sendType'];
        $approve = new MailDAO();
        if ($approve->approveMail($inbox_id, $content, $status)) {
            echo $inbox_id . " " . $content . " " . $status;
        }
        //
    }

    /* ****************************************** Create ***************************************** */

    public function actionCreateInbox()
    {
        $model = new MailDAO();
        $model_doc = CmsDocument::findOne($_GET['id']);
        if (!empty($_POST["list_mail"])) {
            $listmail = $this->pasePersoncodeToId($_POST["list_mail"]);
            $model->createOutbox($listmail, $model_doc->doc_subject, $model_doc->doc_id, null);
            //   $this->sendMail($listmail,$docId);
        }
        return $this->redirect(array('staff-receive/detail_book', 'id' => $model_doc->doc_id));
    }

    public function pasePersoncodeToId(Array $personCode)
    {
        $checkUser = new UserDAO();
        $listmail = array();
        //แปลง  personcode เป็น user.id
        //get id from view_pis_person
        foreach ($personCode as $userId) {
            /*            if (User::findOne($userId)) { //มีข้อมูล user ใน db แล้ว
                            $id = User::findOne($userId);
                            array_push($listmail, $id->id);
                        } else {
                            $newUser = $checkUser->createUsername($userId);
                            array_push($listmail, $newUser);
                        }*/
            $viewPisUser = EofficeCentralViewPisPerson::findOne($userId); //call View
            $newUser = User::find()->where(['personcode' => $viewPisUser->person_id])->one();
            if ($newUser) { //มีข้อมูล user ใน db แล้ว
                $id = User::findOne($newUser->id);
                array_push($listmail, $id->id);
            } else {
                $newUser = $checkUser->createUsername($userId);
                array_push($listmail, $newUser);
            }
        }
        print_r($listmail);
        return $listmail;
    }

    public function actionCreateNewInboxFromEditReceive()
    {
        //$_POST['userList'] = personcode
        $personCode = json_decode(stripslashes($_POST['userList']));
        $listmail = $this->pasePersoncodeToId($personCode);
        $mail = new MailDAO();
        $model_doc = CmsDocument::findOne($_POST['docId']);
        //print_r($listmail);
        $mail->createOutbox($listmail, $model_doc->doc_subject
            , $model_doc->doc_id, null);
        //$this->sendNotificationToMail($listmail, $model_doc->doc_id);
    }

    public function actionSentMail()
    {
        $this->layout = "main_module.php";
        $user = new MailDAO();
        $gridView = new MailGridView();
        $model_label = CmsInboxLabel::find()->where(['user_id' => UserDAO::getCurentUser()->id])
            ->all();
        // return $this->render('sent-mail', ['model_outbox' => $model_outbox, 'user' => $user]);
        $searchData = $this->setSearchData();
        $searchModel = new MailSearch();
        $gridColumns = $gridView->gridViewColumsOutbox(Yii::$app->request->queryParams);

        if (Yii::$app->request->get('keyword')) {
            $model_doc = ElasticCmsDocumentController::SearchFromMailController();
            $dataProvider = $searchModel->findOutbox(Yii::$app->request->queryParams, $model_doc[0]);
            return $this->render('sent-mail', [
                'dataProvider' => $dataProvider[0],
                'model_label' => $model_label,
                'pages' => $dataProvider[1],
                'searchData' => $searchData,
                'gridColumns' => $gridColumns,
            ]);
        } else {
            $dataProvider = $searchModel->findOutbox(Yii::$app->request->queryParams, null);
            return $this->render('sent-mail', [
                'dataProvider' => $dataProvider[0],
                'model_label' => $model_label,
                'pages' => $dataProvider[1],
                'searchData' => $searchData,
                'gridColumns' => $gridColumns,
            ]);
        }

    }

    public function actionSearchMail($keyword)
    {
        $this->layout = "main_module.php";
        $mailDAO = new MailDAO();
        $result = $mailDAO->findMailByKeyword($keyword);
        return $this->render('search', ['result' => $result]);
    }

    /* ****************************************** Favmail ***************************************** */
    public function actionFavmail()
    {
        $this->layout = "main_module.php";
        /* $mailDAO = new MailDAO();
         $favMail = $mailDAO->findByFavMail();*/
        $gridView = new MailGridView();
        $searchModel = new MailSearch();
        $model_label = CmsInboxLabel::find()->where(['user_id' => UserDAO::getCurentUser()->id])
            ->all();
        $searchData = $this->setSearchData();

        if (!\Yii::$app->authManager->isAdmin() && !\Yii::$app->authManager->isStaffGeneral()) {
            $gridColumns = $gridView->gridViewColumsForUser(Yii::$app->request->queryParams);
        } else {
            $gridColumns = $gridView->gridViewColumsForAdmin(Yii::$app->request->queryParams);
        }
        if (Yii::$app->request->get('keyword')) {
            $model_doc = ElasticCmsDocumentController::SearchFromMailController();
            $dataProvider = $searchModel->findByFavMail(Yii::$app->request->queryParams, $model_doc[0]);
            return $this->render('fav_mail', [
                'dataProvider' => $dataProvider[0],
                'model_label' => $model_label,
                'pages' => $dataProvider[1],
                'searchData' => $searchData,
                'gridColumns' => $gridColumns,
            ]);
        } else {
            $dataProvider = $searchModel->findByFavMail(Yii::$app->request->queryParams, null);
            return $this->render('fav_mail', [
                'dataProvider' => $dataProvider[0],
                'model_label' => $model_label,
                'pages' => $dataProvider[1],
                'searchData' => $searchData,
                'gridColumns' => $gridColumns,
            ]);
        }
        //return $this->render('fav_mail', ['model_inbox' => $favMail, 'model_label' => $model_label]);
    }

    public function actionUpdateFavmail()
    {
        $mailDAO = new MailDAO();
        $data = json_decode(stripslashes($_POST['id']));
        //print_r( $data);
        $mailDAO->updateFavMail($data);

    }

    public function actionUpdateUnfavmail()
    {
        $mailDAO = new MailDAO();
        $data = json_decode(stripslashes($_POST['id']));
        //print_r( $data);
        $mailDAO->updateUnFavMail($data);

    }

    /* ****************************************** Drafmail ***************************************** */
    public function actionDrafmail()
    {
        $this->layout = "main_module.php";
        return $this->render('drafmail');
    }

    /* ****************************************** Junkmail ***************************************** */
    public function actionJunkmail()
    {
        $this->layout = "main_module.php";
        $searchModel = new MailSearch();
        $gridView = new MailGridView();
        $searchData = $this->setSearchData();
        $model_label = CmsInboxLabel::find()->where(['user_id' => UserDAO::getCurentUser()->id])
            ->all();

        if (!\Yii::$app->authManager->isAdmin() && !\Yii::$app->authManager->isStaffGeneral()) {
            $gridColumns = $gridView->gridViewJunkMailUser();
        } else {
            $gridColumns = $gridView->gridViewJunkMailAdmin();
        }
        if (Yii::$app->request->get('keyword')) {
            $model_doc = ElasticCmsDocumentController::SearchFromMailController();
            $dataProvider = $searchModel->findByJunkMail(Yii::$app->request->queryParams, $model_doc[0]);
            return $this->render('junkmail-gridview', [
                'dataProvider' => $dataProvider[0],
                'model_label' => $model_label,
                'pages' => $dataProvider[1],
                'searchData' => $searchData,
                'gridColumns' => $gridColumns,
            ]);
        } else {
            $dataProvider = $searchModel->findByJunkMail(Yii::$app->request->queryParams, null);
            return $this->render('junkmail-gridview', [
                'dataProvider' => $dataProvider[0],
                'model_label' => $model_label,
                'pages' => $dataProvider[1],
                'searchData' => $searchData,
                'gridColumns' => $gridColumns,
            ]);
        }

    }

    public function actionUpdateJunkmail()
    {
        $mailDAO = new MailDAO();
        $data = json_decode(stripslashes($_POST['data']));
        $index = sizeof($data);
        echo $data[$index - 1];
        if ($data[$index - 1] == "sent-mail") {
            unset($data[$index - 1]);
            print_r($data);
            $mailDAO->updateOutboxJunkmail($data);
        } else {
            $mailDAO->updateInboxJunkmail($data);
        }

    }

    public function actionDeleteJunkmail()
    {
        $mailDAO = new MailDAO();
        if (isset($_POST['mail'])) {
            $data = json_decode(stripslashes($_POST['mail']));
            $mailDAO->deleteJunkmail($data);
        }
        echo print_r($data);

    }


    /* ****************************************** Notification ***************************************** */
    public function sendNotificationToMail(Array $listmail, $docId)
    {
        //loop send mail to user
        foreach ($listmail as $user_id) {
            $user_email = User::findOne($user_id);
            $from = CmsInbox::find()->from(['cms_inbox', 'cms_document'])->where('cms_document.doc_id = "' . $docId . '"')
                ->andWhere('cms_document.doc_id = cms_inbox.doc_id')
                ->andWhere('cms_inbox.user_id = ' . $user_email->id . '')->one();
            Yii::$app->mailer->compose(['html' => '@app/modules/correspondence/mail/layouts/notificationMail-html'],
                ['fullname' => $user_email->username, 'from' => $from->doc->docDept->doc_dept_name
                    , 'subject' => $from->doc->doc_subject, 'doc_id' => $from->inbox_id
                ])//สามารพเลือกเฉพาะ html หรือ text ในการส่ง
            ->setFrom(['tedtesteoffice@gmail.com' => 'E-office CS KKU'])
                ->setTo($user_email->email)
                ->setSubject($from->doc->doc_subject)
                ->send();
        }
        //loop send mail to user

        /*        foreach ($_POST["list_mail"] as $user_id) {
                    echo $user_id;
                    $user_email = User::findOne($user_id);
                    $from = CmsInbox::find()->from(['cms_inbox', 'cms_document'])->where('cms_document.doc_id = "' . $_SESSION['idDocReceiveInsert'] . '"')
                        ->andWhere('cms_document.doc_id = cms_inbox.doc_id')
                        ->andWhere('cms_inbox.user_id = ' . $user_email->id . '')->one();
                    Yii::$app->mailer->compose(['html' => '@app/modules/correspondence/mail/layouts/notificationMail-html'],
                        ['fullname' => $user_email->username, 'from' => $from->doc->docDept->doc_dept_name
                            , 'subject' => $from->doc->doc_subject, 'doc_id' => $from->inbox_id
                        ])//สามารพเลือกเฉพาะ html หรือ text ในการส่ง
                    ->setFrom(['tedtesteoffice@gmail.com' => 'E-office CS KKU'])
                        ->setTo($user_email->email)
                        ->setSubject($from->doc->doc_subject)
                        ->send();
                }*/
    }

    public function actionBroadcastMail()
    {
        $this->layout = "main_module.php";
        $model_mail = CmsQueue::find()->orderBy(['status' => SORT_ASC]);
        $countQuery = clone $model_mail;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        $models = $model_mail->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $listmail = array();
        if (isset($_POST['id'])) {
            $id = json_decode(stripslashes($_POST['id']));
            foreach ($id as $items) {
                $queue = CmsQueue::findOne($items);
                foreach ($queue->outbox->cmsInboxes as $item) {
                    array_push($listmail, $item->user->id);
                }
                $this->sendMail($listmail, $queue->outbox->doc->doc_id);
                $queue->status = 1;
                $queue->save();
            }
            //  $this->sendMail($data, $queue->outbox->doc->doc_id);
            // $queue->status = 1;
            // $queue->save();
            print_r($listmail);
        }
        if (Yii::$app->request->get('keyword')) {
            $model_doc = ElasticCmsDocumentController::SearchFromMailController();
            $searchModel = new MailSearch();
            $dataProvider = $searchModel->findQueue(Yii::$app->request->queryParams, $model_doc[0]);
            return $this->render('broadcast-mail', [
                'dataProvider' => $dataProvider[0],
                'pages' => $dataProvider[1],
                'searchData' => $model_doc[1],

            ]);

        } else {
            $searchData = $this->setSearchData();
            $searchModel = new MailSearch();
            $dataProvider = $searchModel->findQueue(Yii::$app->request->queryParams, null);
            return $this->render('broadcast-mail', [
                'dataProvider' => $dataProvider[0],
                'pages' => $dataProvider[1],
                'searchData' => $searchData,

            ]);
        }

        //  return $this->render('broadcast-mail', ['model_mail' => $models, 'pages' => $pages,]);
    }

    public function sendMail(Array $listmail, $docId)
    {
        //loop send mail to user
        foreach ($listmail as $user_id) {
            $user_email = User::findOne($user_id);
            $from = CmsInbox::find()->from(['cms_inbox', 'cms_document'])->where('cms_document.doc_id = "' . $docId . '"')
                ->andWhere('cms_document.doc_id = cms_inbox.doc_id')
                ->andWhere('cms_inbox.user_id = ' . $user_email->id . '')->one();
            Yii::$app->mailer->compose(['html' => '@app/modules/correspondence/mail/layouts/notificationMail-html'],
                ['fullname' => $user_email->fname . " " . $user_email->lname, 'from' => $from->doc->docDept->doc_dept_name
                    , 'subject' => $from->doc->doc_subject, 'doc_id' => $from->inbox_id
                ])//สามารพเลือกเฉพาะ html หรือ text ในการส่ง
            ->setFrom(['tedtesteoffice@gmail.com' => 'E-office CS KKU'])
                ->setTo($user_email->email)
                ->setSubject($from->doc->doc_subject)
                ->send();
        }
        //  return $this->redirect(['staff-receive/detail_book?id=' . $_SESSION['idDocReceiveInsert']]);
    }

    public function actionGetReceiver($outbox)
    {
        $model_mail = CmsQueue::findOne($outbox);
        if ($model_mail) {
            foreach ($model_mail->outbox->cmsInboxes as $items) {
                echo '<tr>';
                echo "<td>" . "- <b><span class='username' id='" . $items->user->id . "'>
                     " . $items->user->prefix_th . $items->user->fname . " " . $items->user->lname . "
                     </span></b>" . "</td>";
                echo "<td><span style='display: none' class='buttonSendMail' 
                data-id='" . $model_mail->status . "'></span></td>";
                echo "<td><span>" . controllers::t('menu', $items->inbox_status)
                    . ($items->inbox_status == "read" ? " (" . $items->read_time . ")" : '') .
                    "</span></td>";
                echo '<td><input type="checkbox" name="list_mail[]" value="' . $items->user->id . '" checked style="display:none"/></td>';
                echo '</tr>';
            }
        } else {
            echo "ไม่มีผู้รับ";
        }
    }

    /* ********************************** AJAX QUERY  *******************************************/
    public function actionSearchUser()
    {
        $model_from_dept = User::find()
            ->orFilterWhere(['like', 'username', $_GET['keyword']])
            ->orFilterWhere(['like', 'fname', $_GET['keyword']])
            ->orFilterWhere(['like', 'lname', $_GET['keyword']])
            ->groupBy(['personcode'])
            ->all();
        if ($model_from_dept) {
            foreach ($model_from_dept as $row) {
                echo "<option data-customvalue='" . $row["id"] . "'>
                " . $row["username"] . "  (" . $row["prefix_th"] . $row["fname"] . " " . $row["lname"] . ")</option>";
            }
        }
    }

    public function getNewAndOld($id)
    {
        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        if (CmsInbox::findOne($id)) {
            $newer = "";
            $older = "";
            $now = CmsInbox::findOne($id);
            $new = CmsInbox::find()
                ->where(['user_id' => $user->id])
                ->andWhere("inbox_time>'$now->inbox_time'")
                ->andWhere("inbox_trash=0")
                ->orderBy(['inbox_time' => SORT_ASC])
                ->all();
            $old = CmsInbox::find()
                ->where(['user_id' => $user->id])
                ->andWhere("inbox_time<'$now->inbox_time'")
                ->andWhere("inbox_trash=0")
                ->orderBy(['inbox_time' => SORT_DESC])
                ->all();
            foreach ($new as $y => $newerr) {
                if ($y == 0) {
                    $newer = $newerr['inbox_id'];
                }
            }
            foreach ($old as $x => $olderr) {
                if ($x == 0) {
                    $older = $olderr['inbox_id'];
                }
            }
            // print_r($tabBar);
            return array($newer, $older);
        } else {
            $newer = "";
            $older = "";
            $now = CmsOutbox::findOne($id);
            $new = CmsOutbox::find()
                ->where(['user_id' => $user->id])
                ->andWhere("outbox_time>'$now->outbox_time'")
                ->andWhere("outbox_trash=0")
                ->orderBy(['outbox_time' => SORT_ASC])
                ->all();
            $old = CmsOutbox::find()
                ->where(['user_id' => $user->id])
                ->andWhere("outbox_time<'$now->outbox_time'")
                ->andWhere("outbox_trash=0")
                ->orderBy(['outbox_time' => SORT_DESC])
                ->all();
            foreach ($new as $y => $newerr) {
                if ($y == 0) {
                    $newer = $newerr['outbox_id'];
                }
            }
            foreach ($old as $x => $olderr) {
                if ($x == 0) {
                    $older = $olderr['outbox_id'];
                }
            }
            return array($newer, $older);
        }
    }

    public function getNewAndOldForAdmin($id)
    {
        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        $newer = "";
        $older = "";
        $now = CmsInbox::find()->where(['outbox_id' => $id])->one();
        $new = CmsInbox::find()
            ->where(['user_id' => $user->id])
            ->andWhere("inbox_time>'$now->inbox_time'")
            ->andWhere("inbox_trash=0")
            ->orderBy(['inbox_time' => SORT_ASC])
            ->all();
        $old = CmsInbox::find()
            ->where(['user_id' => $user->id])
            ->andWhere("inbox_time<'$now->inbox_time'")
            ->andWhere("inbox_trash=0")
            ->orderBy(['inbox_time' => SORT_DESC])
            ->all();
        foreach ($new as $y => $newerr) {
            if ($y == 0) {
                $newer = $newerr['outbox_id'];
            }
        }
        foreach ($old as $x => $olderr) {
            if ($x == 0) {
                $older = $olderr['outbox_id'];
            }
        }
        return array($newer, $older);

    }

    public function actionAjaxGetServerTime($timeComment)
    {
        date_default_timezone_set('Asia/Bangkok');
        //return date('Y-m-d H:i:s');$timeComment
        //  echo date('Y-m-d H:i:s'); // 0
        $date1 = new \DateTime(date('Y-m-d  H:i:s', strtotime($timeComment)));
        $date2 = new \DateTime(date('Y-m-d  H:i:s', strtotime(date('Y-m-d H:i:s'))));
        //var_dump($date2 < $date1);
        if ($date1->diff($date2)->i >= 1) {
            return "false";//เวลาที่คอมเม้นกับเวลาปัจจุบันเกิน 1 นาที
        } else {
            return "true";
        }
    }

    public function setSearchData()
    {
        $request = Yii::$app->request;
        $sort = $request->get('sort');
        $labelId = $request->get('id');
        $type = $request->get('type');
        //ข้อมูลเอาไปใช้แสดง Input search ที่่เคยกรอก
        $searchData = [
            'sort' => $sort,
            'id' => $labelId,

        ];
        return $searchData;
    }
}

?>