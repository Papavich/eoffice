<?php

namespace app\modules\correspondence\models;


use app\modules\correspondence\models\model_main\EofficeCentralViewPisBoardOfDirectors;
use app\modules\correspondence\models\model_main\EofficeCentralViewPisPerson;
use app\modules\correspondence\models\model_main\PersonView;
use yii\data\Pagination;
use yii\helpers\FileHelper;
use Yii;
use yii\helpers\Json;

class MailDAO
{
    public function findMailByKeyword($keyword)
    {
        if ($keyword) {
            $user = User::find()->where('username LIKE "%' . $keyword . '%"')->one();
            if ($user) {
                $result = CmsInbox::find()->from(['cms_inbox', 'cms_outbox', 'user', 'cms_document'])
                    ->where('cms_inbox.inbox_subject LIKE "%' . $keyword . '%"')
                    ->orWhere('cms_inbox.inbox_id = cms_outbox.inbox_id AND cms_inbox.user_id = ' . Yii::$app->user->identity->id)
                    ->orderBy(['cms_inbox.inbox_time' => SORT_DESC])
                    ->groupBy('cms_inbox.inbox_subject')
                    ->all();
                return $result;
            } else {
                $result = CmsInbox::find()->from(['cms_inbox', 'cms_outbox', 'user', 'cms_document'])
                    ->where('cms_inbox.inbox_subject LIKE "%' . $keyword . '%"')
                    ->andWhere('cms_inbox.user_id = ' . Yii::$app->user->identity->id)
                    ->orderBy(['cms_inbox.inbox_time' => SORT_DESC])
                    ->groupBy('cms_inbox.inbox_subject')
                    ->all();
                return $result;
            }
        }
    }

    public static function findUser()
    {
        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        return $user;
    }

    public function findInbox()
    {
        $model_inbox = CmsInbox::find()
            ->where(['cms_inbox.user_id' => UserDAO::getCurentUser()->id])
            ->andWhere(['inbox_trash' => 0]);
        $countQuery = clone $model_inbox;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 15,]);
        $models = $model_inbox->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $model_label = CmsInboxLabel::find()->where(['user_id' => UserDAO::getCurentUser()->id])
            ->all();
        return array($models, $model_label, $pages);
    }

    public function findReceiver($id)
    {
        $receiver = CmsInbox::find()
            ->from(['cms_inbox', 'user'])
            ->where("cms_inbox.doc_id  = '" . $id . "' AND cms_inbox.user_id = user.id")
            ->andWhere('inbox_status IS NOT NULL')
            //->andWhere('inbox_trash = 0 OR inbox_trash')
            ->groupBy('user.username')
            ->orderBy(['inbox_status' => SORT_ASC])
            ->all();
        return $receiver;
    }

    public function findNotReceiver($id)
    {
        $receiver = User::find()
            ->where("cms_inbox.doc_id  = '" . $id . "'")
            ->leftJoin('cms_inbox', 'cms_inbox.user_id = user.id')
            ->groupBy('user.username')
            ->all();
        if (!$receiver) {
            //แสดงว่าเอกสารนั้นยังไม่เคยส่งถึงใครเลย
//            $userFromView = $this->getCurrentOfTeacher();
//            //get current of board director
//            $boardDirector = $this->getCurrentOfBoardDirector();
            $userFromView = EofficeCentralViewPisPerson::find()
                ->all();
            //get current of board director
            $boardDirector = EofficeCentralViewPisPerson::find()
                ->all();
            return array($userFromView,$boardDirector);
        } else {
            $personcode = [];
            foreach ($receiver as $i){
                array_push($personcode,$i->personcode);
            }
            //echo Json::encode($personcode);
            //get current of board director
            $boardDirector = $this->getCurrentOfBoardDirectorIsNotReceiver($personcode);
            foreach ($boardDirector as $i){
                array_push($personcode,$i->person_id);
            }
            //echo Json::encode($personcode);
            $userFromView =  EofficeCentralViewPisPerson::find()
                ->where(['not in','eoffice_central.view_pis_person.person_id',$personcode])
                ->all();
            return array($userFromView,$boardDirector);
          // return $userFromView;
        }

    }

    public function getCurrentOfBoardDirectorIsNotReceiver(Array $person_id)
    {
        $boardDirector = EofficeCentralViewPisBoardOfDirectors::find()
            ->where(['not in', 'eoffice_central.view_pis_board_of_directors.person_id', $person_id])
            ->orderBy(['period_describe' => SORT_DESC])->all();
        $personcode = [];
        foreach ($boardDirector as $i) {
            array_push($personcode, $i->period_describe . "," . $i->person_id);
        }
        //$personcode = ["สมัยที่ 5 (2553-2556), 25"];
        $temp=[];
        date_default_timezone_set('Asia/Bangkok');
        foreach ($personcode as $y => $i) {
            //ดึงตัแหน่งของวงเล็บเพื่อที่จะเอาปี
            $first = strpos($personcode[$y], "(");
            $last = strpos($personcode[$y], ")");
            if (substr($personcode[$y], $first, $last)) {
                $currentPeriod = substr($personcode[$y], $first + 6, $last);
                $currentPeriod = substr($currentPeriod, 0, strpos($currentPeriod, ")"));
                //เช็ดปีที่ระยะเวลาบวกลบไม่เกิน 3 ปี
                $year = date('Y') + 543;
                //ตรวจสอบว่าสมัยที่ดำรงยังเกินไม่ครบกำหนดเช่น สมัยที่ 1 (2560-2561) 6เดือน
                if ((int)$currentPeriod - (int)$year > -1) {
//                    echo substr($personcode[$y], strpos($personcode[$y], ",") + 1)
//                        . " " . $currentPeriod . " " . $year
//                        . "<br>";
                    $temp[$y] = substr($personcode[$y], strpos($personcode[$y], ",") + 1);
                }
            }

        }
        $boardDirector = EofficeCentralViewPisBoardOfDirectors::find()
            ->where(['not in', 'eoffice_central.view_pis_board_of_directors.person_id', $person_id])
            ->groupBy(['eoffice_central.view_pis_board_of_directors.person_id'])
            ->all();
        return $boardDirector;

    }
   /* public function getCurrentOfTeacherIsNotReceiver(Array $person_id)
    {
        $currentOfTeacher = EofficeCentralViewPisBoardOfDirectors::find()
            ->where(['not in', 'eoffice_central.view_pis_board_of_directors.person_id', $person_id])
            ->orderBy(['period_describe' => SORT_DESC])->all();
        $personcode = [];
        foreach ($currentOfTeacher as $i) {
            array_push($personcode, $i->period_describe . "," . $i->person_id);
        }
        date_default_timezone_set('Asia/Bangkok');
        $temp =[];
        foreach ($personcode as $y => $i) {
            //ดึงตัแหน่งของวงเล็บเพื่อที่จะเอาปี
            $first = strpos($personcode[$y], "(");
            $last = strpos($personcode[$y], ")");
            if (substr($personcode[$y], $first, $last)) {
                $currentPeriod = substr($personcode[$y], $first + 6, $last);
                $currentPeriod = substr($currentPeriod, 0, strpos($currentPeriod, ")"));
                //เช็ดปีที่ระยะเวลาบวกลบไม่เกิน 3 ปี
                $year = date('Y') + 543;
                //ตรวจสอบว่าสมัยที่ดำรงยังเกินไม่ครบกำหนดเช่น สมัยที่ 1 (2560-2561) 6เดือน
                if ((int)$currentPeriod - (int)$year > -1) {
//                    echo substr($personcode[$y], strpos($personcode[$y], ",") + 1)
//                        . "<br>";
                    //add person_id to array
                    $period = substr($personcode[$y], 0,strpos($personcode[$y], ","));
                    $temp[$y] = substr($personcode[$y], strpos($personcode[$y], ",") + 1);
                }
            }

        }
        echo $period." <-";
        $currentOfTeacher = EofficeCentralViewPisPerson::find()
            ->from(['eoffice_central.view_pis_board_of_directors','eoffice_central.view_pis_person'])
            ->where(['in', 'eoffice_central.view_pis_person.person_id', $temp])
           ->andWhere(['eoffice_central.view_pis_person.period_describe'=>$period])
            ->groupBy(['eoffice_central.view_pis_person.person_id'])
            ->all();
        echo Json::encode($temp);
        return $currentOfTeacher;

    }*/
    public function getCurrentOfBoardDirector()
    {
        $boardDirector = EofficeCentralViewPisBoardOfDirectors::find()
            ->orderBy(['period_describe' => SORT_DESC])->all();
        $personcode = [];
        foreach ($boardDirector as $i) {
            array_push($personcode, $i->period_describe . "," . $i->person_id);
        }
        //$personcode = ["สมัยที่ 5 (2553-2556), 25"];
        date_default_timezone_set('Asia/Bangkok');
        foreach ($personcode as $y => $i) {
            //ดึงตัแหน่งของวงเล็บเพื่อที่จะเอาปี
            $first = strpos($personcode[$y], "(");
            $last = strpos($personcode[$y], ")");
            if (substr($personcode[$y], $first, $last)) {
                $currentPeriod = substr($personcode[$y], $first + 6, $last);
                $currentPeriod = substr($currentPeriod, 0, strpos($currentPeriod, ")"));
                //เช็ดปีที่ระยะเวลาบวกลบไม่เกิน 3 ปี
                $year = date('Y') + 543;
                //ตรวจสอบว่าสมัยที่ดำรงยังเกินไม่ครบกำหนดเช่น สมัยที่ 1 (2560-2561) 6เดือน
                if ((int)$currentPeriod - (int)$year > -1) {
//                    echo substr($personcode[$y], strpos($personcode[$y], ",") + 1)
//                        . " " . $currentPeriod . " " . $year
//                        . "<br>";
                    $personcode[$y] = substr($personcode[$y], strpos($personcode[$y], ",") + 1);
                }
            }

        }
        $boardDirector = EofficeCentralViewPisBoardOfDirectors::find()
            ->where(['in', 'eoffice_central.view_pis_board_of_directors.person_id', $personcode])
            ->groupBy(['eoffice_central.view_pis_board_of_directors.person_id'])
            ->all();
        return $boardDirector;

    }
    public function getCurrentOfTeacher()
    {
        $currentOfTeacher = EofficeCentralViewPisBoardOfDirectors::find()
            ->orderBy(['period_describe' => SORT_DESC])->all();
        $personcode = [];
        foreach ($currentOfTeacher as $i) {
            array_push($personcode, $i->period_describe . "," . $i->person_id);
        }
        date_default_timezone_set('Asia/Bangkok');
        foreach ($personcode as $y => $i) {
            //ดึงตัแหน่งของวงเล็บเพื่อที่จะเอาปี
            $first = strpos($personcode[$y], "(");
            $last = strpos($personcode[$y], ")");
            if (substr($personcode[$y], $first, $last)) {
                $currentPeriod = substr($personcode[$y], $first + 6, $last);
                $currentPeriod = substr($currentPeriod, 0, strpos($currentPeriod, ")"));
                //เช็ดปีที่ระยะเวลาบวกลบไม่เกิน 3 ปี
                $year = date('Y') + 543;
                //ตรวจสอบว่าสมัยที่ดำรงยังเกินไม่ครบกำหนดเช่น สมัยที่ 1 (2560-2561) 6เดือน
                if ((int)$currentPeriod - (int)$year > -1) {
//                    echo substr($personcode[$y], strpos($personcode[$y], ",") + 1)
//                        . " " . $currentPeriod . " " . $year
//                        . "<br>";
                    $personcode[$y] = substr($personcode[$y], strpos($personcode[$y], ",") + 1);
                }
            }

        }
        $currentOfTeacher = EofficeCentralViewPisPerson::find()
            ->where(['not in', 'eoffice_central.view_pis_person.person_id', $personcode])
            ->groupBy(['eoffice_central.view_pis_person.person_id'])
            ->all();
        return $currentOfTeacher;

    }
    public function findByFavMail()
    {
        $user = $this->findUser();
        $favMail = CmsInbox::find()->where(['inbox_fav' => 1])
            ->andWhere('cms_inbox.user_id = ' . $user->id)
            ->andWhere(['<>', 'cms_inbox.inbox_trash', 1]);
        $countQuery = clone $favMail;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 15,]);
        $models = $favMail->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return array($models, $pages);
    }

    public function findByJunkMail()
    {
        $user = UserDAO::getCurentUser();
        $junkInboxMail = CmsInbox::find()->where(['inbox_trash' => 1])
            ->andWhere('cms_inbox.user_id = ' . $user->id)
            ->all();
//        $junkOutboxMail = CmsOutbox::find()->where(['outbox_trash' => 1])
//            ->andWhere(['user_id' => $user->id])
//            ->all();
        $junkOutboxMail = CmsOutbox::find()
            ->from(['cms_outbox', 'cms_inbox', 'user'])
            ->distinct()
            ->where(['cms_outbox.user_id' => $user->id])
            ->andWhere('cms_outbox.user_id = user.id')
            ->andWhere('cms_outbox.outbox_id = cms_inbox.outbox_id')
            ->andWhere(['cms_outbox.outbox_trash' => 1])
            ->groupBy('cms_outbox.outbox_subject')
            ->all();
        return array($junkInboxMail, $junkOutboxMail);
    }

    public function findReceiverByInbox($outboxId)
    {
        $receiver = CmsInbox::find()
            ->where(['outbox_id' => $outboxId])
            ->groupBy('user_id')
            ->all();
        return $receiver;
    }

    public function findReceiverByOutbox($outboxId)
    {
        $receiver = CmsInbox::find()
            ->where(['cms_inbox.user_id' => UserDAO::getCurentUser()->id])//1
            ->andWhere(['cms_inbox.outbox_id' => $outboxId])
            ->all();
        return $receiver;
    }

    /* ************************************* CREATE *********************************************** */
    public function createOutbox(Array $listmail, $subject, $doc_id, $comment)
    {
        date_default_timezone_set("Asia/Bangkok");
        //$user = $this->findUser();
        $user = UserDAO::getCurentUser();
        $model_outbox = new CmsOutbox();
        $model_outbox->outbox_id = "OBID" . date('YmdHis').$user->id;
        $model_outbox->outbox_status = null;
        $model_outbox->outbox_subject = $subject;
        $model_outbox->outbox_content = $comment;
        $model_outbox->outbox_time = date('Y-m-d H:i:s');
        $model_outbox->doc_id = $doc_id;
        $model_outbox->user_id = $user->id;
        $model_outbox->outbox_trash = 0;
        if ($model_outbox->save()) {
            $model_queue = new CmsQueue();
            $model_queue->status = 0;
            $model_queue->outbox_doc_id = $doc_id;
            $model_queue->outbox_user_id = $user->id;
            $model_queue->outbox_id = $model_outbox->outbox_id;
            $model_queue->save();
        }
        //echo  $subject." ".$doc_id." ".$comment." ";
        $this->createInbox($listmail, $subject, $doc_id, $model_outbox->outbox_id);
    }

    public function createOutboxReply($doc_id, $subject, $comment)
    {
        date_default_timezone_set("Asia/Bangkok");
        $user = UserDAO::getCurentUser();
        $model_outbox = new CmsOutbox();
        $model_outbox->outbox_id = "OBID" . date('YmdHis').$user->id;
        $model_outbox->outbox_status = null;
        $model_outbox->outbox_subject = $subject;
        $model_outbox->outbox_content = $comment;
        $model_outbox->outbox_time = date('Y-m-d H:i:s');
        $model_outbox->doc_id = $doc_id;
        $model_outbox->user_id = $user->id;
        $model_outbox->outbox_trash = 0;
        $model_outbox->save();
        return $model_outbox->outbox_id;
    }

    public function createInbox(Array $listmail, $subject, $doc_id, $outbox_id)
    {
        date_default_timezone_set("Asia/Bangkok");
        $model = new CmsInbox();
        //if listmail is not empty, next we will find id of user and get user_id
        if (!empty($listmail)) {
            foreach ($listmail as $user_id) {
                //echo $subject . " " . $doc_id;
                $model->setIsNewRecord(true);
                $model->inbox_id = "IBID" . date('Ymd') . gettimeofday()["usec"].$user_id;
                $model->inbox_status = "unread";
                $model->inbox_content = $subject;
                $model->inbox_subject = $subject;
                $model->inbox_time = date('Y-m-d H:i:s');
                $model->user_id = User::findOne($user_id)->id;
                $model->doc_id = CmsDocument::findOne($doc_id)->doc_id;
                $model->approve_status = null;
                $model->approve_time = null;
                $model->approve_by = null;
                $model->message_reply_time = null;
                $model->message_approve = null;
                $model->message_reply = null;
                $model->inbox_fav = 0;
                $model->inbox_trash = 0;
                $model->outbox_id = $outbox_id;
                $model->read_time = null;
                $model->save();
            }
        }
        return true;
    }

    public function createInboxReply($userId, $subject, $doc_id, $comment)
    {
        $outbox_id = $this->createOutboxReply($doc_id, $subject, $comment);
        //echo $outbox_id;
        date_default_timezone_set("Asia/Bangkok");
        $model = new CmsInbox();
        //if listmail is not empty, next we will find id of user and get user_id
        $model->inbox_id = "IBID" . date('Ymd') . gettimeofday()["usec"].$userId;
        $model->inbox_status = null;
        $model->inbox_content = $subject;
        $model->inbox_subject = $subject;
        $model->inbox_time = date('Y-m-d H:i:s');
        $model->user_id = User::findOne($userId)->id;
        $model->doc_id = CmsDocument::findOne($doc_id)->doc_id;
        $model->approve_status = null;
        $model->approve_time = null;
        $model->approve_by = null;
        $model->message_reply_time = date('Y-m-d H:i:s');
        $model->message_approve = null;
        $model->message_reply = $comment;
        $model->inbox_fav = 0;
        $model->inbox_trash = 0;
        $model->outbox_id = $outbox_id;
        $model->read_time = null;
        $model->save();
        return true;
    }

    public function createInboxApprove($userId, $approveBy, $subject, $doc_id, $comment, $status)
    {
        $outbox_id = $this->createOutboxReply($doc_id, $subject, $comment);
        //echo $outbox_id;
        date_default_timezone_set("Asia/Bangkok");
        $model = new CmsInbox();
        //if listmail is not empty, next we will find id of user and get user_id
        $model->inbox_id = "IBID" . date('Ymd') . gettimeofday()["usec"].$userId;
        $model->inbox_status = null;
        $model->inbox_content = $subject;
        $model->inbox_subject = $subject;
        $model->inbox_time = date('Y-m-d H:i:s');
        $model->user_id = User::findOne($userId)->id;
        $model->doc_id = CmsDocument::findOne($doc_id)->doc_id;
        $model->approve_status = $status;
        $model->approve_time = date('Y-m-d H:i:s');
        $model->approve_by = User::findOne($approveBy)->id;
        $model->message_approve = $comment;
        $model->message_reply_time = null;
        $model->message_reply = null;
        $model->inbox_fav = 0;
        $model->inbox_trash = 0;
        $model->outbox_id = $outbox_id;
        if ($model->save()) {
            return true;
        }
    }

    public function createInboxReplies($userId, $subject, $doc_id, $comment)
    {
        //จดหมายนั้นเกี่ยวข้องกับ user หลายคน
        $outbox_id = $this->createOutboxReply($doc_id, $subject, $comment);
        //echo $outbox_id;
        date_default_timezone_set("Asia/Bangkok");
        $model = new CmsInbox();
        //if listmail is not empty, next we will find id of user and get user_id
        //กรณีการตอบกลับไม่ใช่การตอบกลับจากจดหมายที่ถูก forward มา
        $model->inbox_id = "IBID" . date('Ymd') . gettimeofday()["usec"].$userId;
        $model->inbox_status = null;
        $model->inbox_content = $subject;
        $model->inbox_subject = $subject;
        $model->inbox_time = date('Y-m-d H:i:s');
        $model->user_id = User::findOne($userId)->id;
        $model->doc_id = CmsDocument::findOne($doc_id)->doc_id;
        $model->approve_status = null;
        $model->approve_time = null;
        $model->approve_by = null;
        $model->message_reply_time = date('Y-m-d H:i:s');
        $model->message_approve = null;
        $model->message_reply = $comment;
        $model->inbox_fav = 0;
        $model->inbox_trash = 0;
        $model->outbox_id = $outbox_id;
        $model->read_time = null;
        $model->save();
    }

    /* ************************************* REPLY *********************************************** */
    public function replyMail($inbox_id, $comment)
    {
        //reply already
        //if this mail reply already we will create new inbox and outbox
        $model_inbox = CmsInbox::findOne($inbox_id);
        $this->createInboxReply($model_inbox->outbox->user_id, $model_inbox->inbox_subject
            , $model_inbox->doc_id, $comment);
        //$this->sendNotificationReplyToMail($model_inbox->outbox->user_id,$model_inbox->doc->doc_id,$model_inbox->user_id);
        return true;
    }

    public function replyFromSentPage($inbox_id, $comment)
    {

        $model_outbox = CmsOutbox::findOne($inbox_id);
        //echo $model_inbox->user_id;
        foreach ($model_outbox->cmsInboxes as $user) {
            $this->createInboxReply($user['user_id'], $model_outbox->outbox_subject, $model_outbox->doc_id, $comment);
            //$this->createInboxReply($listMail, $model_outbox->outbox_subject, $model_outbox->doc_id, $comment);
        }

    }

    public function openMail($id)
    {
        $user = $this->findUser();
        $model_inbox = CmsInbox::find()->where(['inbox_id' => $id])
            ->andWhere(['user_id' => $user->id])->one();
        date_default_timezone_set("Asia/Bangkok");
        $model_inbox->inbox_status = "read";
        $model_inbox->read_time = date('Y-m-d H:i:s');
        if ($model_inbox->save()) {
            return true;
        }
        return false;
    }

    public function readAllMail(Array $id)
    {
        $user = $this->findUser();
        foreach ($id as $mailID) {
            $model_inbox = CmsInbox::find()->where(['inbox_id' => $mailID])
                ->andWhere(['user_id' => $user->id])->one();
            date_default_timezone_set("Asia/Bangkok");
            $model_inbox->inbox_status = "read";
            $model_inbox->read_time = date('Y-m-d H:i:s');
            $model_inbox->save();
        }

    }

    /* ************************************* FORWARD *********************************************** */
    public function forwardMail(Array $listmail, $inboxId, $comment)
    {
        $inbox = CmsInbox::findOne($inboxId);
        $this->createOutbox($listmail, $inbox->doc->doc_subject, $inbox->doc->doc_id, $comment);
        $this->sendNotificationToMail($listmail, $inbox->doc->doc_id);
        return true;
    }

    /* ************************************* APPROVE *********************************************** */
    public function approveMail($inboxId, $comment, $status)
    {
        $inbox = CmsInbox::findOne($inboxId);
        $doc = CmsDocument::findOne($inbox->doc->doc_id);
        if ($status == "approve") {
            $doc->check_id = 4; //approve
        } else {
            $doc->check_id = 5; //reject
        }
        $doc->save();
        $this->createInboxApprove($inbox->outbox->user->id, $inbox->user->id, $doc->doc_subject, $doc->doc_id
            , $comment, $status);
        //$inbox->outbox->user->id คือ inbox นั้นมาจากใคร
        //,$inbox->user->id = inbox ของใคร
        //$status = สถานะการอนุมัติ
        $this->sendNotificationApproveToMail($inbox->outbox->user->id, $doc->doc_id, $status);

        return true;
    }

    /* ************************************* UPDATE *********************************************** */
    public function updateFavMail(Array $id)
    {
        foreach ($id as $mailID) {
            if (count($id) == 1) {
                //one mail need to update
                $favMail = CmsInbox::findOne($mailID);
                if ($favMail->inbox_fav == 0) {
                    $favMail->inbox_fav = 1;
                } else {
                    $favMail->inbox_fav = 0;
                }
                $favMail->save();
            } else {
                //many mail need to update
                $favMail = CmsInbox::findOne($mailID);
                $favMail->inbox_fav = 1;
                $favMail->save();
            }
        }
    }

    public function updateUnFavMail(Array $id)
    {
        foreach ($id as $mailID) {
            $favMail = CmsInbox::findOne($mailID);
            $favMail->inbox_fav = 0;
            $favMail->save();
        }
    }

    public function updateInboxJunkmail(Array $listmail)
    {
        if (!empty($listmail)) {
            foreach ($listmail as $id) {
                $junkMail = CmsInbox::findOne($id);
                $junkMail->inbox_trash = 1;
                if ($junkMail->save()) {

                } else {
                    $this->updateOutboxJunkmail($listmail);
                }
            }
            echo "success";
        }
    }

    public function updateOutboxJunkmail(Array $listmail)
    {
        if (!empty($listmail)) {
            /*            foreach ($listmail as $subject) {
                            $junkMail = CmsOutbox::find()
                                ->where(['doc_id' => $subject])
                                ->andWhere(['user_id'=>$this->findUser()->id])
                                ->all();
                            foreach ($junkMail as $mail) {
                                $mail->outbox_trash = 1;
                                $mail->save();
                            }
                        }*/
            foreach ($listmail as $outbox) {
                $junkMail = CmsOutbox::find()
                    ->where(['outbox_id' => $outbox])
                    ->andWhere(['user_id' => $this->findUser()->id])
                    ->one();
                $junkMail->outbox_trash = 1;
                $junkMail->save();

            }
            echo "success";
        }
    }

    public function updateOutboxStatus($id)
    {
        $model_outbox = CmsOutbox::findOne($id);
        $model_outbox->outbox_status = "sent";
        $model_outbox->save();
    }

    /* ************************************* DELETE *********************************************** */
    public function deleteJunkmail(Array $listmail)
    {
        //listmail = inbox_id OR outbox_id
        //type = type of mail
        $result = "";
        if (!empty($listmail)) {
            foreach ($listmail as $id) {
                if (CmsInbox::findOne($id)) {
                    $junkMailInbox = CmsInbox::findOne($id);
                    echo $junkMailInbox->outbox_id . " inbox ";
                    $junkOutboxMail = CmsOutbox::find()->where(['outbox_id' => $junkMailInbox->outbox_id])->one();
                    $queue = CmsQueue::find()->where(['outbox_id' => $junkMailInbox->outbox_id])->one();
                    if ($junkOutboxMail) {
                        $junkMailInbox->inbox_trash = 2;
                        $junkMailInbox->save();
                    }
                    if ($queue) { //outbox นั้นถูกบันทึกไว้ในคิวแต่ยังไม่ได้ส่งก็จะลบ
                        if (InboxLabel::find()->where(['inbox_id' => $junkMailInbox->inbox_id])->one()) {
                            InboxLabel::find()->where(['inbox_id' => $junkMailInbox->inbox_id])->one()->delete();
                        }
                        if ($junkOutboxMail->outbox_trash == 2 && $junkMailInbox->inbox_trash == 2 && !is_bool($queue)) {
                            $queue->delete();
                            $junkMailInbox->delete();
                            $junkOutboxMail->delete();
                        }
//                        else { //outbox นั้นถูกบันทึกไว้ในคิวแต่ยังไม่ได้ส่งก็จะลบ
//                            $junkMailInbox->delete();
//                            $junkOutboxMail->delete();
//                        }
                    }
                } else {
                    //วนลูป outbox ทั้งหมดที่รับมาจาก view
                    $outboxSubject = CmsOutbox::findOne($id);
                    echo $outboxSubject->outbox_subject . " - if2 ";
                    $junkMail = CmsOutbox::find()->where(['outbox_subject' => $outboxSubject->outbox_subject])->all();
                    foreach ($junkMail as $mail) {
                        $queue = CmsQueue::find()->where(['outbox_id' => $mail->outbox_id])->one();
                        if ($mail->outbox_trash == 2) {
                            $inbox = CmsInbox::find()->where(['outbox_id' => $mail->outbox_id])->all();
                            foreach ($inbox as $item) {
                                //วนลูป inbox ทั้งหมดที่รับมาจาก view
                                if ($item['inbox_trash'] == 2 && !is_bool($queue)) {
                                    if (InboxLabel::find()->where(['inbox_id' => $item->inbox_id])->one()) {
                                        InboxLabel::find()->where(['inbox_id' => $item->inbox_id])->one()->delete();
                                    }
                                    $queue->delete();
                                    $item->delete();
                                    $mail->delete();
                                }
                            }
                        } else {
                            $mail->outbox_trash = 2;
                            $mail->save();
                        }
                    }
                }
            }
            /*else if ($type == "out") {
                foreach ($listmail as $id) {
                    //วนลูป outbox ทั้งหมดที่รับมาจาก view
                    $outboxSubject = CmsOutbox::findOne($id);
                    echo $outboxSubject->outbox_subject . " - if2 ";
                    $junkMail = CmsOutbox::find()->where(['outbox_subject' => $outboxSubject->outbox_subject])->all();
                    foreach ($junkMail as $mail) {
                        $queue = CmsQueue::find()->where(['outbox_id' => $mail->outbox_id])->one();
                        if ($mail->outbox_trash == 2) {
                            $inbox = CmsInbox::find()->where(['outbox_id' => $mail->outbox_id])->all();
                            foreach ($inbox as $item) {
                                //วนลูป inbox ทั้งหมดที่รับมาจาก view
                                if ($item['inbox_trash'] == 2 && !is_bool($queue)) {
                                    $queue->delete();
                                    $item->delete();
                                    $mail->delete();
                                }
                            }
                        } else {
                            $mail->outbox_trash = 2;
                            $mail->save();
                        }
                    }

                    else {
                        $inbox = CmsInbox::find()->where(['outbox_id' => $id])->all();
                        foreach ($inbox as $item) {
                            //วนลูป inbox ทั้งหมดที่รับมาจาก view
                            if ($item['inbox_trash'] == 2  && $queue == 0) {
                                $queue->delete();
                                $item->delete();
                                $junkOutboxMail->delete();
                            }
                        }
                        $junkOutboxMail->outbox_trash = 2;
                        $junkOutboxMail->save();
                      }

                    $result = "out";
                }
            }*/
        }
        return $result . "-model";
    }

    public function sendNotificationToMail(Array $listmail, $docId)
    {
        //loop send mail to user
        foreach ($listmail as $user_id) {
            $user_email = User::findOne($user_id);
            $from = CmsInbox::find()->from(['cms_inbox', 'cms_document'])->where('cms_document.doc_id = "' . $docId . '"')
                ->andWhere('cms_document.doc_id = cms_inbox.doc_id')
                ->andWhere('cms_inbox.user_id = ' . $user_email->id . '')->one();
            Yii::$app->mailer->compose(['html' => '@app/modules/correspondence/mail/layouts/notificationMail-html'],
                ['fullname' => $user_email->fname . " " . $user_email->lname,
                    'from' => $from->doc->docDept->doc_dept_name
                    , 'subject' => $from->doc->doc_subject, 'doc_id' => $from->inbox_id
                ])//สามารพเลือกเฉพาะ html หรือ text ในการส่ง
            ->setFrom(['tedtesteoffice@gmail.com' => 'E-office CS KKU'])
                ->setTo($user_email->email)
                ->setSubject($from->doc->doc_subject)
                ->send();
        }
    }

    public function sendNotificationApproveToMail($user_id, $docId, $approve)
    {
        //loop send mail to user
        $user_email = User::findOne($user_id);
        $from = CmsInbox::find()->from(['cms_inbox', 'cms_document'])->where('cms_document.doc_id = "' . $docId . '"')
            ->andWhere('cms_document.doc_id = cms_inbox.doc_id')
            ->andWhere('cms_inbox.user_id = ' . $user_email->id . '')->one();
        Yii::$app->mailer->compose(['html' => '@app/modules/correspondence/mail/layouts/notificationApproveMail-html'],
            ['subject' => $from->doc->doc_subject,
                'doc_id' => $from->outbox_id,
                'approve' => $approve
            ])
            ->setFrom(['tedtesteoffice@gmail.com' => 'E-office CS KKU'])
            ->setTo($user_email->email)
            ->setSubject($from->doc->doc_subject)
            ->send();

    }

    public function sendNotificationReplyToMail($user_id, $docId, $sender)
    {
        //loop send mail to user

        $user_email = User::findOne($user_id);
        $sennder = User::findOne($sender);
        $from = CmsInbox::find()->from(['cms_inbox', 'cms_document'])->where('cms_document.doc_id = "' . $docId . '"')
            ->andWhere('cms_document.doc_id = cms_inbox.doc_id')
            ->andWhere('cms_inbox.user_id = ' . $user_email->id . '')->one();
        // echo $user_id." ".$docId." ".$from->inbox_id." ". $from->doc->doc_subject;
        Yii::$app->mailer->compose(['html' => '@app/modules/correspondence/mail/layouts/notificationReplyMail-html'],
            ['fullname' => $user_email->username, 'subject' => $from->doc->doc_subject
                , 'doc_id' => $from->inbox_id, 'sender' => $sennder->username
            ])//สามารพเลือกเฉพาะ html หรือ text ในการส่ง
        ->setFrom(['tedtesteoffice@gmail.com' => 'E-office CS KKU'])
            ->setTo($user_email->email)
            ->setSubject($from->doc->doc_subject)
            ->send();

    }
}