<?php
/**
 * Created by PhpStorm.
 * User: VaraPhon
 * Date: 6/27/2017
 * Time: 2:40 PM
 */

namespace app\modules\correspondence\controllers;

use app\modules\correspondence\models\CmsDeleteRoll;
use app\modules\correspondence\models\CmsDocFile;
use app\modules\correspondence\models\CmsDocRollSend;
use app\modules\correspondence\models\CmsDocRollReceive;
use app\modules\correspondence\models\CmsDocSecret;
use app\modules\correspondence\models\CmsDocSpeed;
use app\modules\correspondence\models\CmsDocSubType;
use app\modules\correspondence\models\model_main\EofficeCentralViewPisUser;
use app\modules\correspondence\models\model_main\MajorView;
use app\modules\correspondence\models\model_main\PersonView;
use app\modules\correspondence\models\CmsDocument;
use app\modules\correspondence\models\CmsInbox;
use app\modules\correspondence\models\CmsAddress;
use app\modules\correspondence\models\CmsDocDept;
use app\modules\correspondence\models\CmsDocType;
use app\modules\correspondence\models\DocumentDAO;
use app\modules\correspondence\controllers;
use app\modules\correspondence\models\CmsOutbox;
use app\modules\correspondence\models\DeleterollDAO;
use app\modules\correspondence\models\MailDAO;
use app\modules\correspondence\models\User;
use app\modules\correspondence\models\UserDAO;
use Yii;
use yii\data\Pagination;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

//การออกรายงาน excel จะเรียกใช้ Package 2 ตัวดังนี้
// Microsoft Excel
use PHPExcel;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Fill;
use PHPExcel_Style_Border;
use PHPExcel_IOFactory;
use Mpdf\Mpdf;

class StaffController extends Controller
{


    public function actionIndex()
    {
        $this->layout = "main_module.php";
        $model_doc = new DocumentDAO();
        $checkUser = new UserDAO();
        $num = 0;
        $count = 0;
        $datenow = date("Y-m-d h:m:s");
        $model = \app\modules\correspondence\models\CmsDocument::find()
            ->from(['cms_document'])
            ->leftJoin('cms_delete_roll', ' cms_document.doc_id=cms_delete_roll.doc_id')
            ->leftJoin('cms_doc_roll_send', ' cms_document.doc_id=cms_doc_roll_send.doc_id')
            ->where('"' . $datenow . '"  >= doc_expire')
            ->andWhere('cms_doc_roll_send.doc_id is null')
            ->andWhere('cms_delete_roll.doc_id is null')
            ->orderBy('address_id')
            ->count();
        $getUserFromView = EofficeCentralViewPisUser::findOne(Yii::$app->user->identity->id);
        $user = User::find()->where(['personcode' => $getUserFromView->person_id])->one();
        if ($model > 0) {
            $num = 1;
            $count = $model;
        }
        if($user){
            $checkUser->updateUsername(Yii::$app->user->identity->id);
            return $this->render('index', ['model_doc' => $model_doc->findUserReplyMail(), 'num' => $num,
                'count' => $count,]);
        }else{ //new user login to CMS system
            $checkUser->createUsername(Yii::$app->user->identity->id);
            return $this->render('index', ['model_doc' => $model_doc->findUserReplyMail(), 'num' => $num,
                'count' => $count,]);
        }


    }

    public function actionCircularroolbook()
    {
        $this->layout = "main_module.php";
        return $this->render('circular_roll_book');
    }

    /* ********************************************************* Report ***********************************/
    public function actionGraph()
    {
        $this->layout = "main_module.php";
        return $this->render('graph');
    }

    public function actionGetroll()
    {
        $roll = Yii::$app->request->get('roll');
        $model_create = \app\modules\correspondence\models\CmsDeleteRoll::find()
            ->where(['cms_delete_roll.roll'=>$roll] )
            ->all();
        $data = "";
         //echo $roll;
        foreach ($model_create as $rows) {
            echo ' <tr>';
            echo '<td class="body">' . $rows->doc->address_id . '</td>
                <td class="body">' . $rows->doc->address->address_name . '</td>
                <td class="body">' . $rows->doc->doc_id_regist. '</td>
                <td class="body"> ' . Html::a($rows->doc->doc_subject,
                    ['/correspondence/staff-receive/detail_book?id=' .
                        $rows->doc->doc_id], ['target' => '_blank']) . ' </td>
                <td class="body">' . $rows->doc->subType->sub_type_name . '</td>
                <td class="body">' . $this->DateThai($rows->doc->doc_date) . '</td>
                <td class="body">' . $this->DateThai($rows->doc->doc_expire) . '</td>
                </tr>';
            echo $data;
        }
    }

    public function actionGetstatus()
    {
        $roll = Yii::$app->request->get('roll');
        $model_create = \app\modules\correspondence\models\CmsDeleteRoll::find()
            ->where('roll=' . $roll . '')
            ->limit(1)
            ->all();
        $data = "";
        /* echo $roll;*/
        foreach ($model_create as $rows) {
            if ($rows['status'] == 'รออนุมัติ') {
                echo ' <option value="1">' . $rows['status'] . '</option>
                   <option value="2">กำลังทำลาย</option>
                   <option value="3">ทำลายเสร็จสิ้น</option>';
            }
            if ($rows['status'] == 'กำลังทำลาย') {
                echo ' <option value="2">' . $rows['status'] . '</option>
                   <option value="1">รออนุมัติ</option>
                   <option value="3">ทำลายเสร็จสิ้น</option>';
            }
            if (!empty($model_create)) {
                echo 'มีข้อผิดพลาด';
            }
            echo $data;
        }

    }

    public function actionEditdelete()
    {
        $roll = Yii::$app->request->get('roll');
        $select = Yii::$app->request->get('select');

        $model = new DeleterollDAO();

        $model->Editdeleteroll($roll, $select);
        /*$n = count($add_doc_id);
        for ($i = 0; $i < $n; $i++) {
            echo 'Add:'.$add_doc_id[$i].'';
        }*/
        /* $s = count($remove_doc_id);

         for ($i = 0; $i < $s; $i++) {
             echo 'Remove:'.$remove_doc_id[$i].'' ;
         }*/
        /* echo "success";*/

        return $this->redirect(['../correspondence/staff/delete-roll']);
    }

    public function actionRemoveroll()
    {
        $remove_doc_id = Yii::$app->request->get('remove_doc_id');
        $model = new DeleterollDAO();
        $model->Removedeleteroll($remove_doc_id);
    }

    public function actionGraphsearch()
    {
        $datestart = Yii::$app->request->get('datestart');
        $dateend = Yii::$app->request->get('dateend');
        $booktype = Yii::$app->request->get('booktype');
        $subtype = Yii::$app->request->get('subtype');
        $_SESSION['datestart'] = $datestart;
        $_SESSION['dateend'] = $dateend;
        $_SESSION['booktype'] = $booktype;
        $_SESSION['subtype'] = $subtype;
        /* echo 'หมวดหมู่'.$subtype;
           echo 'ตั้งแต่'.$datestart;
           echo 'ถึง'.$dateend;
           echo 'ประเภท'.$booktype;*/
        $funcT = '\app\modules\\' . Yii::$app->controller->module->id . '\controllers::t';
        echo '<thead> <tr>';
        if ($_SESSION['booktype'] == 1) {
            echo '<th align="center">'. $funcT('menu', 'Order') .'</th>
                  <th>'. $funcT('menu', 'Registration number') .'</th>
                  <th>'. $funcT('menu', 'Book number') .'</th>
                  <th style="width: 150px">'. $funcT('menu', 'Date of receipt') .'</th>';
        }

        elseif ($_SESSION['booktype'] == 2) {
            echo ' <th align="center">'. $funcT('menu', 'Order') .'</th>
                   <th>'. $funcT('menu', 'Sending number') .'</th>
                   <th>'. $funcT('menu', 'Book number') .'</th>
                   <th style="width: 150px">'. $funcT('menu', 'Export date') .'</th>';
        }

        elseif ($_SESSION['booktype'] == 3) {
            echo '  <th align="center">'. $funcT('menu', 'Order') .'</th>
                    <th>'. $funcT('menu', 'Registration number') .'</th>
                    <th>'. $funcT('menu', 'Book number') .'</th>
                    <th style="width: 150px">'. $funcT('menu', 'Book Date') .'</th>';
        }
        echo '<th width="300">'. $funcT('menu', 'From') .'</th>
                  <th width="300">'. $funcT('menu', 'To') .'</th>
                  <th width="500">'. $funcT('menu', 'Title') .'</th>';
        if ($subtype=='ทั้งหมด'){
            echo '<th width="200">'. $funcT('menu', 'Category') .'</th>';
        }
        if ($subtype == 'การเงิน' || $subtype == 'พัสดุ' ||$subtype == 'ทั้งหมด') {
            echo '<th width="100">'. $funcT('menu', 'Money') .'</th>
                  <th width="100">'. $funcT('menu', 'Fiscal year') .'</th>';
        }
        echo '</tr></thead><tbody>';
        if ($booktype == 1) {
            $i=1;
            if ($subtype != 'ทั้งหมด') {
                $model_roll = CmsDocument::find()
                    ->from(['cms_document', 'cms_doc_dept', 'cms_doc_roll_receive', 'cms_doc_type', 'user', 'cms_doc_sub_type', 'cms_outbox'])->
                    where('cms_document.doc_date BETWEEN "' . $datestart . '" AND "' . $dateend . '"')
                    ->andWhere('cms_document.type_id=cms_doc_type.type_id')
                    ->andWhere('cms_doc_dept.doc_dept_id=cms_document.doc_dept_id')
                    ->andWhere('cms_doc_roll_receive.doc_id=cms_document.doc_id')
                    ->andWhere('cms_document.user_id=user.id')
                    ->andWhere('cms_doc_sub_type.sub_type_name="' . $subtype . '"')
                    ->andWhere('cms_doc_sub_type.sub_type_id=cms_document.sub_type_id')
                    ->andWhere('cms_outbox.doc_id=cms_document.doc_id')
                    ->andWhere('cms_outbox.outbox_content IS NULL')
                    ->orderBy(['cms_doc_roll_receive.doc_roll_receive_id' => SORT_ASC])
                    ->all();
            }
            else if ($subtype == 'ทั้งหมด'){
                $model_roll = CmsDocument::find()
                    ->from(['cms_document', 'cms_doc_dept', 'cms_doc_roll_receive', 'cms_doc_type', 'user', 'cms_doc_sub_type', 'cms_outbox'])->
                    where('cms_document.doc_date BETWEEN "' . $datestart . '" AND "' . $dateend . '"')
                    ->andWhere('cms_document.type_id=cms_doc_type.type_id')
                    ->andWhere('cms_doc_dept.doc_dept_id=cms_document.doc_dept_id')
                    ->andWhere('cms_doc_roll_receive.doc_id=cms_document.doc_id')
                    ->andWhere('cms_document.user_id=user.id')
                    ->andWhere('cms_doc_sub_type.sub_type_id=cms_document.sub_type_id')
                    ->andWhere('cms_outbox.doc_id=cms_document.doc_id')
                    ->andWhere('cms_outbox.outbox_content IS NULL')
                    ->orderBy(['cms_doc_roll_receive.doc_roll_receive_id' => SORT_ASC])
                    ->all();
            }
            $data = "";
            foreach ($model_roll as $rows) {
                $model_doc_dept = CmsDocDept::find()->where(['doc_dept_id' => $rows['doc_dept_id']])->one();
                $model_doc = CmsDocument::find()->where(['doc_id' => $rows['doc_id']])->one();
                $model_doc_roll_receive = CmsDocRollReceive::find()->where(['doc_id' => $rows['doc_id']])->one();
                echo '           
                <tr>
                <td align="center">' . $i. '</td>
                <td align="center">' . substr($model_doc_roll_receive->doc_roll_receive_id, -4). '</td>
                <td class="center">' . $rows->doc_id_regist . '</td>
                <td class="center">' . $this->DateThai($rows->doc_date) . '</td>
                <td class="center">' . $rows->docDept->doc_dept_name . '</td>
                <td class="center">';
                $inbox = \app\modules\correspondence\models\CmsInbox::find()
                    ->from(['cms_inbox', 'user'])
                    ->where("cms_inbox.doc_id  = '" . $rows->doc_id . "'")
                    ->andWhere('cms_inbox.user_id = user.id')
                    ->andWhere('cms_inbox.message_reply_time IS NULL')
                    ->andWhere('cms_inbox.message_reply IS NULL')
                    ->all();
                //echo count($inbox);
                foreach ($inbox as $index=>$record) {
                    $model_user_inbox = \app\modules\correspondence\models\User::find()
                        ->where(['id' => $record['user_id']])
                        ->one();
                    $model_user_main= \app\modules\correspondence\models\model_main\EofficeCentralViewPisPerson::find()
                        ->where(['eoffice_central.view_pis_person.person_id' => $model_user_inbox->personcode])
                        ->one();
                    if (count($inbox) == 1 && $index ==0) {
                        echo $model_user_main->PREFIXABB.$model_user_main->person_name."  ".$model_user_main->person_surname;
                    }
                    else if (count($inbox) > 1 && $index ==0) {
                        echo $model_user_main->PREFIXABB.$model_user_main->person_name."  ".$model_user_main->person_surname .
                            " ".controllers::t('menu','and others');
                    }
                }
                echo '</td><td class="center"> ' . Html::a($rows->doc_subject,
                        ['/correspondence/staff-receive/detail_book?id=' .
                            $rows->doc_id], ['target' => '_blank']) . ' </td>';
                if ($subtype=='ทั้งหมด'){
                    echo '<td class="center">'.$rows->subType->sub_type_name. '</td>';
                }
                if ($subtype == 'การเงิน' || $subtype == 'พัสดุ' ) {
                    echo '<td class="center">' . number_format($rows->money, 2) . '</td>
                 <td class="center">' . $this->MoneyDate($rows->receive_date) . '</td>';
                }
                if ($subtype=='ทั้งหมด' && $rows->subType->sub_type_name=='การเงิน'){
                    echo '<td class="center">' . number_format($rows->money, 2) . '</td>
                 <td class="center">' . $this->MoneyDate($rows->receive_date) . '</td>';
                }
                if ($subtype=='ทั้งหมด' &&  $rows->subType->sub_type_name=='พัสดุ'){
                    echo '<td class="center">' . number_format($rows->money, 2) . '</td>
                 <td class="center">' . $this->MoneyDate($rows->receive_date) . '</td>';
                }
                if ($subtype=='ทั้งหมด' &&  $rows->subType->sub_type_name!='การเงิน'&&$rows->subType->sub_type_name!='พัสดุ'){
                    echo '<td class="center">-</td>
                 <td class="center">-</td>';
                }
                echo '</tr>';
                $i++;
            }

            if (count($model_roll) == 0) {
                if ($subtype == 'การเงิน' || $subtype == 'พัสดุ') {
                    echo "<td colspan='9' align='center' style='font-style: italic'>ไม่พบรายการที่ค้นหา</td>";
                }elseif ($subtype=='ทั้งหมด'){
                    echo "<td colspan='10' align='center' style='font-style: italic'>ไม่พบรายการที่ค้นหา</td>";
                }
                else {
                    echo "<td colspan='7' align='center' style='font-style: italic'>ไม่พบรายการที่ค้นหา</td>";
                }
            }
            echo $data;
        }
        else if ($booktype == 2) {
            $data = "";
            $i=1;
            if ($subtype != 'ทั้งหมด') {
                $model_send = CmsDocument::find()
                    ->where('cms_document.sent_date BETWEEN "' . $datestart . '" AND "' . $dateend . '"')
                    ->andWhere('cms_doc_sub_type.sub_type_name="' . $subtype . '"')
                    ->innerJoin('cms_doc_roll_send', 'cms_doc_roll_send.doc_id = cms_document.doc_id')
                    ->innerJoin('cms_doc_dept', 'cms_document.doc_dept_id = cms_doc_dept.doc_dept_id')
                    ->innerJoin('cms_doc_sub_type', 'cms_document.sub_type_id = cms_doc_sub_type.sub_type_id')
                    ->orderBy(['cms_doc_roll_send.doc_roll_send_id' => SORT_ASC])
                    ->all();
            }
            elseif ($subtype == 'ทั้งหมด') {
                $model_send = CmsDocument::find()
                    ->where('cms_document.sent_date BETWEEN "' . $datestart . '" AND "' . $dateend . '"')
                    ->innerJoin('cms_doc_roll_send', 'cms_doc_roll_send.doc_id = cms_document.doc_id')
                    ->innerJoin('cms_doc_dept', 'cms_document.doc_dept_id = cms_doc_dept.doc_dept_id')
                    ->innerJoin('cms_doc_sub_type', 'cms_document.sub_type_id = cms_doc_sub_type.sub_type_id')
                    ->orderBy(['cms_doc_roll_send.doc_roll_send_id' => SORT_ASC])
                    ->all();
            }
           foreach ($model_send as $rows) {
                $cms_doc_roll_send = CmsDocRollSend::find()->where(['doc_id' => $rows['doc_id']])->one();
                $dept ="";
                if (!empty($model_send)) {
                    echo '<tr>
                <td align="center">' . $i . '</td>
                <td align="center">' . substr($cms_doc_roll_send->doc_roll_send_id, -4) . '</td>
                <td class="center">' . $rows['doc_id_regist'] . '</td>
                <td class="center">' . $this->DateThai($rows['sent_date']) . '</td>
                <td class="center">';
                    foreach ($rows->cmsDocRollSends as $dept){
                        echo $dept->doc->docDept->doc_dept_name;
                    }
                        echo '</td>'.
                '<td class="center">' . $rows['doc_from'] . '</td>
                <td class="center">' . Html::a($rows['doc_subject'],
                            ['/correspondence/staff-send/detail_book?id=' . $rows['doc_id']],
                            ['target' => '_blank']) . '</td>';
                    if ($subtype=='ทั้งหมด'){
                        echo '<td class="center">'.$rows->subType->sub_type_name. '</td>';
                    }
                    if ($subtype == 'การเงิน' || $subtype == 'พัสดุ' ) {
                        echo '<td class="center">' . number_format($rows->money, 2) . '</td>
                 <td class="center">' . $this->MoneyDate($rows->receive_date) . '</td>';
                    }
                    if ($subtype=='ทั้งหมด' && $rows->subType->sub_type_name=='การเงิน'){
                        echo '<td class="center">' . number_format($rows->money, 2) . '</td>
                 <td class="center">' . $this->MoneyDate($rows->receive_date) . '</td>';
                    }
                    if ($subtype=='ทั้งหมด' &&  $rows->subType->sub_type_name=='พัสดุ'){
                        echo '<td class="center">' . number_format($rows->money, 2) . '</td>
                 <td class="center">' . $this->MoneyDate($rows->receive_date) . '</td>';
                    }
                    if ($subtype=='ทั้งหมด' &&  $rows->subType->sub_type_name!='การเงิน'&&$rows->subType->sub_type_name!='พัสดุ'){
                        echo '<td class="center">-</td>
                 <td class="center">-</td>';
                    }
                    echo '</tr>';

                } $i++;
            }
            if (count($model_send) == 0) {
                if ($subtype == 'การเงิน' || $subtype == 'พัสดุ') {
                    echo "<td colspan='9' align='center' style='font-style: italic'>ไม่พบรายการที่ค้นหา</td>";
                }
                elseif ($subtype=='ทั้งหมด'){
                    echo "<td colspan='10' align='center' style='font-style: italic'>ไม่พบรายการที่ค้นหา</td>";
                }
                else {
                    echo "<td colspan='7' align='center' style='font-style: italic'>ไม่พบรายการที่ค้นหา</td>";
                }
            }
            echo $data;
        }
        else if ($booktype == 3) {
            $i = 1;
            $datenow = date("Y-m-d H:i:s");
            if ($subtype != 'ทั้งหมด') {
                $model_roll_delete = CmsDocument::find()->
                from(['cms_document', 'cms_doc_dept', 'cms_delete_roll', 'cms_doc_type', 'user', 'cms_doc_sub_type'])->
                where('cms_delete_roll.time_end BETWEEN "' . $datestart . '" AND "' . $dateend . '"')
                    ->andWhere('"' . $datenow . '"  >= doc_expire')
                    ->andWhere('cms_document.type_id=cms_doc_type.type_id')
                    ->andWhere('cms_doc_dept.doc_dept_id=cms_document.doc_dept_id')
                    ->andWhere('cms_delete_roll.doc_id=cms_document.doc_id')
                    ->andWhere('cms_document.user_id=user.id')
                    ->andWhere('cms_delete_roll.status="ทำลายเสร็จสิ้น"')
                    ->andWhere('cms_doc_sub_type.sub_type_name="' . $subtype . '"')
                    ->andWhere('cms_doc_sub_type.sub_type_id=cms_document.sub_type_id')
                    ->orderBy(['cms_delete_roll.delete_id' => SORT_ASC])
                    ->all();
            } elseif ($subtype == 'ทั้งหมด') {
                $model_roll_delete = CmsDocument::find()->
                from(['cms_document', 'cms_doc_dept', 'cms_delete_roll', 'cms_doc_type', 'user', 'cms_doc_sub_type'])->
                where('cms_delete_roll.time_end BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
                    ->andWhere('"' . $datenow . '"  >= doc_expire')
                    ->andWhere('cms_document.type_id=cms_doc_type.type_id')
                    ->andWhere('cms_doc_dept.doc_dept_id=cms_document.doc_dept_id')
                    ->andWhere('cms_delete_roll.doc_id=cms_document.doc_id')
                    ->andWhere('cms_document.user_id=user.id')
                    ->andWhere('cms_delete_roll.status="ทำลายเสร็จสิ้น"')
                    ->andWhere('cms_doc_sub_type.sub_type_id=cms_document.sub_type_id')
                    ->orderBy(['cms_delete_roll.delete_id' => SORT_ASC])
                    ->all();
            }
            $data = "";
            foreach ($model_roll_delete as $rows) {
                $model_receive = CmsDocRollReceive::find()->where(['doc_id' => $rows['doc_id']])->one();
                    echo '<tr><td align="center">' . $i . '</td>
                <td class="center">' . $rows['doc_id_regist'] . '</td>
                <td class="center">' .substr($model_receive->doc_roll_receive_id,-4) . '</td>
                <td class="center">' . $this->DateThai($rows['doc_date']) . '</td>
                <td class="center">' . $rows->docDept->doc_dept_name . '</td>
                <td class="center">';
                    $inbox = CmsInbox::find()
                        ->from(['cms_inbox', 'user'])
                        ->where("cms_inbox.doc_id  = '" . $rows['doc_id'] . "' AND cms_inbox.user_id = user.id")
                        ->andWhere('cms_inbox.message_reply_time IS NULL')
                        ->andWhere('cms_inbox.message_reply IS NULL')
                        ->all();
                foreach ($inbox as $index=>$record) {
                    $model_user_inbox = \app\modules\correspondence\models\User::find()
                        ->where(['id' => $record['user_id']])
                        ->one();
                    $model_user_main= \app\modules\correspondence\models\model_main\EofficeCentralViewPisPerson::find()
                        ->where(['eoffice_central.view_pis_person.person_id' => $model_user_inbox->personcode])
                        ->one();
                    if (count($inbox) == 1 && $index ==0) {
                        echo $model_user_main->PREFIXABB.$model_user_main->person_name."  ".$model_user_main->person_surname;
                    }
                    else if (count($inbox) > 1 && $index ==0) {
                        echo $model_user_main->PREFIXABB.$model_user_main->person_name."  ".$model_user_main->person_surname .
                            " ".controllers::t('menu','and others');
                    }

                }
                    echo '</td> <td class="center"> ' . Html::a($rows['doc_subject'],
                            ['/correspondence/staff-receive/detail_book?id=' . $rows['doc_id']], ['target' => '_blank']) . ' </td>';
                if ($subtype=='ทั้งหมด'){
                    echo '<td class="center">'.$rows->subType->sub_type_name. '</td>';
                }
                if ($subtype == 'การเงิน' || $subtype == 'พัสดุ' ) {
                    echo '<td class="center">' . number_format($rows->money, 2) . '</td>
                 <td class="center">' . $this->MoneyDate($rows->receive_date) . '</td>';
                }
                if ($subtype=='ทั้งหมด' && $rows->subType->sub_type_name=='การเงิน'){
                    echo '<td class="center">' . number_format($rows->money, 2) . '</td>
                 <td class="center">' . $this->MoneyDate($rows->receive_date) . '</td>';
                }
                if ($subtype=='ทั้งหมด' &&  $rows->subType->sub_type_name=='พัสดุ'){
                    echo '<td class="center">' . number_format($rows->money, 2) . '</td>
                 <td class="center">' . $this->MoneyDate($rows->receive_date) . '</td>';
                }
                if ($subtype=='ทั้งหมด' &&  $rows->subType->sub_type_name!='การเงิน'&&$rows->subType->sub_type_name!='พัสดุ'){
                    echo '<td class="center">-</td>
                 <td class="center">-</td>';
                }
                    echo '</tr>';
                    $i++;
            }
            if (count($model_roll_delete) == 0) {
                if ($subtype == 'การเงิน' || $subtype == 'พัสดุ') {
                    echo "<td colspan='9' align='center' style='font-style: italic'>ไม่พบรายการที่ค้นหา</td>";
                }
                elseif ($subtype=='ทั้งหมด'){
                    echo "<td colspan='10' align='center' style='font-style: italic'>ไม่พบรายการที่ค้นหา</td>";
                }
                else {
                    echo "<td colspan='7' align='center' style='font-style: italic'>ไม่พบรายการที่ค้นหา</td>";
                }
                echo '</tr>';
            }
            echo $data;
        }
        echo '</tbody>';
        die();
    }


//change format date
    public
    function DateThai($strDate)
    {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear ";
    }

    public function DateThaifull($strDate)
    {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear ";
    }

    public function MoneyDate($strDate)
    {
        $mm = date("n", strtotime($strDate));  //เดือนปัจจุบัน
        $yearbudget = date("Y", strtotime($strDate)) + 543;  //ปีปัจจุบัน
        $show='';
        $m = $mm;
        $y = $yearbudget;

        //เริ่มตรวจสอบเงื่อนไข

        if ($m >= 10) {
            $show = $y + 1;
        } else {
            if ($m >= 1) {
                $show = $y;
            }
        }
        return $show;
    }

//สร้างAction ดังนี้
    public function actionExcel()
    {
        // Create new PHPExcel object
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

// Set properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

        $BStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
        /*if money or material border font fill*/
        if ('' . $_SESSION['subtype'] . '' == 'การเงิน' || '' . $_SESSION['subtype'] . '' == 'พัสดุ'|| '' . $_SESSION['subtype'] . '' == 'ทั้งหมด') {
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
            $objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getFill()->getStartColor()->setARGB('ffb400');
            $objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getFont()->setBold(true);
            /*เส้นดำ*/
            $objPHPExcel->getActiveSheet()->getStyle('A4:J20')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('A5:J20')->applyFromArray($BStyle);
            $objPHPExcel->getDefaultStyle()->applyFromArray($style);
            $objPHPExcel->getActiveSheet()->getStyle("A2:J2")->applyFromArray($style);
            $objPHPExcel->getActiveSheet()->getStyle("A4:J4")->applyFromArray($style);
            $objPHPExcel->getActiveSheet()->getStyle("I5:J99")->applyFromArray($style);

        } else {
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:H2');
            $objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getFill()->getStartColor()->setARGB('ffb400');
            $objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getFont()->setBold(true);
            /*เส้นดำ*/
            $objPHPExcel->getActiveSheet()->getStyle('A4:H30')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('A5:E16')->applyFromArray($BStyle);
            $objPHPExcel->getDefaultStyle()->applyFromArray($style);
            $objPHPExcel->getActiveSheet()->getStyle("A2:H2")->applyFromArray($style);
            $objPHPExcel->getActiveSheet()->getStyle("A4:J4")->applyFromArray($style);
            $objPHPExcel->getActiveSheet()->getStyle("I5:J99")->applyFromArray($style);

        }
        // Add some data


        $objPHPExcel->getActiveSheet()->getRowDimension('1:50')->setRowHeight(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);

        date_default_timezone_set("Asia/Bangkok");
        $datenow = date("Y-m-d H:i:s");
        $datenowfull = $this->DateThaifull($datenow);
        $datestartfull = $this->DateThaifull($_SESSION['datestart']);
        $dateendfull = $this->DateThaifull($_SESSION['dateend']);
        $funcT = '\app\modules\\' . Yii::$app->controller->module->id . '\controllers::t';

// Add some data
        if ($_SESSION['booktype'] == 1) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A2', 'การออกรายงานทะเบียนหนังสือรับ ประจำวันที่ ' . $datenowfull . ' (ระหว่างวันที่ ' .
                    $datestartfull . ' ถึง ' . $dateendfull . ') หมวดหมู่ ' . $_SESSION['subtype'] . '')//กำหนดให้ cell A2 พิมพ์คำว่า Employees Report
                ->setCellValue('A4', $funcT('menu', 'Order'))
                ->setCellValue('B4', $funcT('menu', 'Reception number'))//กำหนดให้ cell A4 พิมพ์คำว่า employeeNumber
                ->setCellValue('C4', $funcT('menu', 'Book number'))//กำหนดให้ cell A4 พิมพ์คำว่า employeeNumber
                ->setCellValue('D4', $funcT('menu', 'Date of receipt'))//กำหนดให้ cell B4 พิมพ์คำว่า firstName
                ->setCellValue('E4', $funcT('menu', 'From'))//กำหนดให้ cell C4 พิมพ์คำว่า lastName
                ->setCellValue('F4', $funcT('menu', 'To'))//กำหนดให้ cell D4 พิมพ์คำว่า extension
                ->setCellValue('G4', $funcT('menu', 'Title'))//กำหนดให้ cell E4 พิมพ์คำว่า email
                /* ->setCellValue('G4', 'หมวดหมู่')*/
                ->setCellValue('H4', $funcT('menu', 'Address Name'));
            if ('' . $_SESSION['subtype'] . '' == 'การเงิน' || '' . $_SESSION['subtype'] . '' == 'พัสดุ'
                || '' . $_SESSION['subtype'] . '' == 'ทั้งหมด') {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('I4', $funcT('menu', 'Money'))
                    ->setCellValue('J4', $funcT('menu', 'Fiscal year'));
            }
            $i = 5; // กำหนดค่า i เป็น 6 เพื่อเริ่มพิมพ์ที่แถวที่ 6
        } else if ($_SESSION['booktype'] == 2) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->
                setCellValue('A2', 'การออกรายงานทะเบียนหนังสือส่ง ประจำวันที่ ' . $datenowfull . ' (ระหว่างวันที่ ' .
                    $datestartfull . ' ถึง ' . $dateendfull . ') หมวดหมู่ ' . $_SESSION['subtype'] . '')//กำหนดให้ cell A2 พิมพ์คำว่า Employees Report
                ->setCellValue('A4', $funcT('menu', 'Order'))
                ->setCellValue('B4', $funcT('menu', 'Sending number'))//กำหนดให้ cell A4 พิมพ์คำว่า employeeNumber
                ->setCellValue('C4', $funcT('menu', 'Book number'))//กำหนดให้ cell A4 พิมพ์คำว่า employeeNumber
                ->setCellValue('D4', $funcT('menu', 'Export date'))//กำหนดให้ cell B4 พิมพ์คำว่า firstName
                ->setCellValue('E4', $funcT('menu', 'From'))//กำหนดให้ cell C4 พิมพ์คำว่า lastName
                ->setCellValue('F4', $funcT('menu', 'To'))//กำหนดให้ cell D4 พิมพ์คำว่า extension
                ->setCellValue('G4', $funcT('menu', 'Title'))//กำหนดให้ cell E4 พิมพ์คำว่า email
                /*   ->setCellValue('G4', 'หมวดหมู่')*/
                ->setCellValue('H4', $funcT('menu', 'Address Name'));
            if ('' . $_SESSION['subtype'] . '' == 'การเงิน' || '' . $_SESSION['subtype'] . '' == 'พัสดุ'
                || '' . $_SESSION['subtype'] . '' == 'ทั้งหมด') {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('I4', $funcT('menu', 'Money'))
                    ->setCellValue('J4', $funcT('menu', 'Fiscal year'));
            }
            $i = 5; // กำหนดค่า i เป็น 6 เพื่อเริ่มพิมพ์ที่แถวที่ 6
        } else if ($_SESSION['booktype'] == 3) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A2', 'การออกรายงานทะเบียนหนังสือทำลาย ประจำวันที่ ' . $datenowfull . ' (ระหว่างวันที่ ' .
                    $datestartfull . ' ถึง ' . $dateendfull . ') หมวดหมู่ ' . $_SESSION['subtype'] . '')//กำหนดให้ cell A2 พิมพ์คำว่า Employees Report
                ->setCellValue('A4', $funcT('menu', 'Order'))
                ->setCellValue('B4', $funcT('menu', 'Reception number'))//กำหนดให้ cell A4 พิมพ์คำว่า employeeNumber
                ->setCellValue('C4', $funcT('menu', 'Book number'))//กำหนดให้ cell A4 พิมพ์คำว่า employeeNumber
                ->setCellValue('D4', $funcT('menu', 'Date of receipt'))//กำหนดให้ cell B4 พิมพ์คำว่า firstName
                ->setCellValue('E4', $funcT('menu', 'From'))//กำหนดให้ cell C4 พิมพ์คำว่า lastName
                ->setCellValue('F4', $funcT('menu', 'To'))//กำหนดให้ cell D4 พิมพ์คำว่า extension
                ->setCellValue('G4', $funcT('menu', 'Title'))//กำหนดให้ cell E4 พิมพ์คำว่า email
                /*->setCellValue('G4', 'หมวดหมู่')*/
                ->setCellValue('H4', $funcT('menu', 'Address Name'));
            if ('' . $_SESSION['subtype'] . '' == 'การเงิน' || '' . $_SESSION['subtype'] . '' == 'พัสดุ'
                || '' . $_SESSION['subtype'] . '' == 'ทั้งหมด') {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('I4', $funcT('menu', 'Money'))
                    ->setCellValue('J4', $funcT('menu', 'Fiscal year'));
            }
            $i = 5; // กำหนดค่า i เป็น 6 เพื่อเริ่มพิมพ์ที่แถวที่ 6
        }
// Miscellaneous glyphs, UTF-8
        if ($_SESSION['booktype'] == 1) {
            $num=1;
            if ($_SESSION['subtype'] != 'ทั้งหมด') {
            $model_roll = CmsDocument::find()
                ->from(['cms_document', 'cms_doc_dept', 'cms_doc_roll_receive', 'cms_doc_type', 'user', 'cms_doc_sub_type','cms_outbox'])
                ->where('cms_document.doc_date BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
                ->andWhere('cms_document.type_id=cms_doc_type.type_id')
                ->andWhere('cms_doc_dept.doc_dept_id=cms_document.doc_dept_id')
                ->andWhere('cms_doc_roll_receive.doc_id=cms_document.doc_id')
                ->andWhere('cms_document.user_id=user.id')
                ->andWhere('cms_doc_sub_type.sub_type_name="' . $_SESSION['subtype'] . '"')
                ->andWhere('cms_doc_sub_type.sub_type_id=cms_document.sub_type_id')
                ->andWhere('cms_outbox.doc_id=cms_document.doc_id')
                ->andWhere('cms_outbox.outbox_content IS NULL')
                ->orderBy(['cms_doc_roll_receive.doc_roll_receive_id' => SORT_ASC])
                ->all();
            }
            elseif ($_SESSION['subtype']  == 'ทั้งหมด') {
                $model_roll = CmsDocument::find()
                    ->from(['cms_document', 'cms_doc_dept', 'cms_doc_roll_receive', 'cms_doc_type', 'user', 'cms_doc_sub_type','cms_outbox'])
                    ->where('cms_document.doc_date BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
                    ->andWhere('cms_document.type_id=cms_doc_type.type_id')
                    ->andWhere('cms_doc_dept.doc_dept_id=cms_document.doc_dept_id')
                    ->andWhere('cms_doc_roll_receive.doc_id=cms_document.doc_id')
                    ->andWhere('cms_document.user_id=user.id')
                    ->andWhere('cms_doc_sub_type.sub_type_id=cms_document.sub_type_id')
                    ->andWhere('cms_outbox.doc_id=cms_document.doc_id')
                    ->andWhere('cms_outbox.outbox_content IS NULL')
                    ->orderBy(['cms_doc_roll_receive.doc_roll_receive_id' => SORT_ASC])
                    ->all();
            }
            foreach ($model_roll as $item) { //วนลูปหาพนักงานทั้งหมด
                $model_doc_dept = CmsDocDept::find()->where(['doc_dept_id' => $item['doc_dept_id']])->one();
                $model_user = User::find()->where(['id' => $item['user_id']])->one();
                $model_doc = CmsDocument::find()->where(['doc_id' => $item['doc_id']])->one();
                $cms_doc_roll_receive = \app\modules\correspondence\models\CmsDocRollReceive::find()->where(['doc_id' => $item['doc_id']])->one();
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i,$num);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, substr($cms_doc_roll_receive->doc_roll_receive_id, -4));
                $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $item["doc_id_regist"]);
                $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->getAlignment()->setWrapText(true);
                //กำหนดให้คอลัมม์ A แถวที่ i พิมพ์ค่าของ employeeNumber
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $this->DateThai($item['receive_date']));
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $model_doc_dept->doc_dept_name);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setWrapText(true);

                $inbox = \app\modules\correspondence\models\CmsInbox::find()
                    ->from(['cms_inbox', 'user'])
                    ->where("cms_inbox.doc_id  = '" . $item['doc_id'] . "' AND cms_inbox.user_id = user.id")
                    ->andWhere('cms_inbox.message_reply_time IS NULL')
                    ->andWhere('cms_inbox.message_reply IS NULL')
                    ->all();

                $string = "";
                if ($inbox) {
                    foreach ($inbox as $items) {
                        $model_user_inbox = \app\modules\correspondence\models\User::find()
                            ->where(['id' => $items['user_id']])
                            ->one();
                        $model_user_main= \app\modules\correspondence\models\model_main\EofficeCentralViewPisPerson::find()
                            ->where(['eoffice_central.view_pis_person.person_id' => $model_user_inbox->personcode])
                            ->one();
                        $string = $model_user_main->PREFIXABB.$model_user_main->person_name."  ".$model_user_main->person_surname. ", " . $string;
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $i,
                        substr($string, 0, -2)
                    );
                } else {
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $i,
                        " "
                    );

                }

                $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $item["doc_subject"]);
                $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getAlignment()->setWrapText(true);
                /*$objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $model_doc->subType->sub_type_name);*/
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $model_doc->address->address_id . ',' . $model_doc->address->address_name);
                $objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getAlignment()->setWrapText(true);
                if ('' . $_SESSION['subtype'] . '' == 'การเงิน' || '' . $_SESSION['subtype'] . '' == 'พัสดุ') {
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, number_format($item['money']));
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $this->MoneyDate($item['doc_date']));
                }
                if ($_SESSION['subtype']=='ทั้งหมด' && $item->subType->sub_type_name=='การเงิน'){
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, number_format($item['money']));
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $this->MoneyDate($item['doc_date']));
                }
                if ($_SESSION['subtype']=='ทั้งหมด' &&  $item->subType->sub_type_name=='พัสดุ'){
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, number_format($item['money']));
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $this->MoneyDate($item['doc_date']));
                }
                if ($_SESSION['subtype']=='ทั้งหมด' &&  $item->subType->sub_type_name!='การเงิน'&&$item->subType->sub_type_name!='พัสดุ'){
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i,'');
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, '');
                }
                $i++;
                $num++;
            }
        } else if ($_SESSION['booktype'] == 2) {
            $num=1;
            if ($_SESSION['subtype'] != 'ทั้งหมด') {
                $model_doc = \app\modules\correspondence\models\CmsDocument::find()->
                from(['cms_document', 'cms_doc_type', 'cms_doc_dept', 'cms_doc_roll_send', 'cms_doc_sub_type'])->
                where('cms_document.sent_date BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
                    ->andWhere('cms_document.type_id = cms_doc_type.type_id')
                    ->andWhere('cms_doc_dept.doc_dept_id = cms_document.doc_dept_id')
                    ->andWhere('cms_doc_roll_send.doc_id = cms_document.doc_id')
                    ->andWhere('cms_doc_sub_type.sub_type_name="' . $_SESSION['subtype'] . '"')
                    ->andWhere('cms_doc_sub_type.sub_type_id=cms_document.sub_type_id')
                    ->orderBy(['cms_doc_roll_send.doc_roll_send_id' => SORT_ASC])
                    ->all();
            }elseif ($_SESSION['subtype']  == 'ทั้งหมด') {
                $model_doc = \app\modules\correspondence\models\CmsDocument::find()->
                from(['cms_document', 'cms_doc_type', 'cms_doc_dept', 'cms_doc_roll_send', 'cms_doc_sub_type'])->
                where('cms_document.sent_date BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
                    ->andWhere('cms_document.type_id = cms_doc_type.type_id')
                    ->andWhere('cms_doc_dept.doc_dept_id = cms_document.doc_dept_id')
                    ->andWhere('cms_doc_roll_send.doc_id = cms_document.doc_id')
                    ->andWhere('cms_doc_sub_type.sub_type_id=cms_document.sub_type_id')
                    ->orderBy(['cms_doc_roll_send.doc_roll_send_id' => SORT_ASC])
                    ->all();
            }
            foreach ($model_doc as $item) { //วนลูปหาพนักงานทั้งหมด
                $model_doc_to_dept = \app\modules\correspondence\models\CmsDocDept::find()->where(['doc_dept_id' => $item['doc_dept_id']])->one();
                $model_user = \app\modules\correspondence\models\User::find()->where(['id' => $item['user_id']])->one();
                $model_doc = \app\modules\correspondence\models\CmsDocument::find()->where(['doc_id' => $item['doc_id']])->one();
                $cms_doc_roll_send = \app\modules\correspondence\models\CmsDocRollSend::find()->where(['doc_id' => $item['doc_id']])->one();
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i,$num);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, substr($cms_doc_roll_send->doc_roll_send_id, -4));
                $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $item["doc_id_regist"]);
                $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->getAlignment()->setWrapText(true);
                //กำหนดให้คอลัมม์ A แถวที่ i พิมพ์ค่าของ employeeNumber
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $this->DateThai($item['sent_date']));
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $item["doc_from"]);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $model_doc_to_dept->doc_dept_name);
                $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $item["doc_subject"]);
                $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getAlignment()->setWrapText(true);
                /*$objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $model_doc->subType->sub_type_name);*/
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $model_doc->address->address_id . ',' . $model_doc->address->address_name);
                $objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getAlignment()->setWrapText(true);
                if ('' . $_SESSION['subtype'] . '' == 'การเงิน' || '' . $_SESSION['subtype'] . '' == 'พัสดุ') {
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, number_format($item['money']));
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $this->MoneyDate($item['doc_date']));
                }
                if ($_SESSION['subtype']=='ทั้งหมด' && $item->subType->sub_type_name=='การเงิน'){
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, number_format($item['money']));
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $this->MoneyDate($item['doc_date']));
                }
                if ($_SESSION['subtype']=='ทั้งหมด' &&  $item->subType->sub_type_name=='พัสดุ'){
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, number_format($item['money']));
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $this->MoneyDate($item['doc_date']));
                }
                if ($_SESSION['subtype']=='ทั้งหมด' &&  $item->subType->sub_type_name!='การเงิน'&&$item->subType->sub_type_name!='พัสดุ'){
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i,'');
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, '');
                }
                $i++;
                $num++;
            }
        } else if ($_SESSION['booktype'] == 3) {
            $num=1;
            $datenow = date("Y-m-d h:m:s");
            if ($_SESSION['subtype'] != 'ทั้งหมด') {
            $model_roll = \app\modules\correspondence\models\CmsDocument::find()->
            from(['cms_document', 'cms_doc_dept', 'cms_delete_roll', 'cms_doc_type', 'user', 'cms_doc_sub_type'])->
            where('cms_delete_roll.time_end BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
                ->andWhere('"' . $datenow . '"  >= doc_expire')
                ->andWhere('cms_document.type_id=cms_doc_type.type_id')
                ->andWhere('cms_doc_dept.doc_dept_id=cms_document.doc_dept_id')
                ->andWhere('cms_delete_roll.doc_id=cms_document.doc_id')
                ->andWhere('cms_document.user_id=user.id')
                ->andWhere('cms_delete_roll.status="ทำลายเสร็จสิ้น"')
                ->andWhere('cms_doc_sub_type.sub_type_name="' . $_SESSION['subtype'] . '"')
                ->andWhere('cms_doc_sub_type.sub_type_id=cms_document.sub_type_id')
                ->orderBy(['cms_delete_roll.delete_id' => SORT_ASC])
                ->all();
            }elseif ($_SESSION['subtype']  == 'ทั้งหมด') {
                $model_roll = \app\modules\correspondence\models\CmsDocument::find()->
                from(['cms_document', 'cms_doc_dept', 'cms_delete_roll', 'cms_doc_type', 'user', 'cms_doc_sub_type'])->
                where('cms_delete_roll.time_end BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
                    ->andWhere('"' . $datenow . '"  >= doc_expire')
                    ->andWhere('cms_document.type_id=cms_doc_type.type_id')
                    ->andWhere('cms_doc_dept.doc_dept_id=cms_document.doc_dept_id')
                    ->andWhere('cms_delete_roll.doc_id=cms_document.doc_id')
                    ->andWhere('cms_document.user_id=user.id')
                    ->andWhere('cms_delete_roll.status="ทำลายเสร็จสิ้น"')
                    ->andWhere('cms_doc_sub_type.sub_type_id=cms_document.sub_type_id')
                    ->orderBy(['cms_delete_roll.delete_id' => SORT_ASC])
                    ->all();
            }
            foreach ($model_roll as $item) { //วนลูปหาพนักงานทั้งหมด
                $cms_doc_roll_receive = \app\modules\correspondence\models\CmsDocRollReceive::find()->where(['doc_id' => $item['doc_id']])->one();
                $model_doc = \app\modules\correspondence\models\CmsDocument::find()->where(['doc_id' => $item['doc_id']])->one();
                $model_doc_dept = \app\modules\correspondence\models\CmsDocDept::find()->where(['doc_dept_id' => $item['doc_dept_id']])->one();
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i,$num);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, substr($cms_doc_roll_receive->doc_roll_receive_id, -4));
                $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $item["doc_id_regist"]);
                $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->getAlignment()->setWrapText(true);
                //กำหนดให้คอลัมม์ A แถวที่ i พิมพ์ค่าของ employeeNumber
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $this->DateThai($item['doc_date']));
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $model_doc_dept->doc_dept_name);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setWrapText(true);


                $inbox = \app\modules\correspondence\models\CmsInbox::find()
                    ->from(['cms_inbox', 'user'])
                    ->where("cms_inbox.doc_id  = '" . $item['doc_id'] . "' AND cms_inbox.user_id = user.id")
                    ->andWhere('cms_inbox.message_reply_time IS NULL')
                    ->andWhere('cms_inbox.message_reply IS NULL')
                    ->all();

                $string = "";
                if ($inbox) {
                    foreach ($inbox as $items) {
                        $model_user_inbox = \app\modules\correspondence\models\User::find()
                            ->where(['id' => $items['user_id']])
                            ->one();
                        $model_user_main= \app\modules\correspondence\models\model_main\EofficeCentralViewPisPerson::find()
                            ->where(['eoffice_central.view_pis_person.person_id' => $model_user_inbox->personcode])
                            ->one();
                        $string = $model_user_main->PREFIXABB.$model_user_main->person_name."  ".$model_user_main->person_surname  . ", " . $string;
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $i,
                        substr($string, 0, -2)
                    );
                } else {
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $i,
                        " "
                    );

                }

                $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $item["doc_subject"]);
                $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getAlignment()->setWrapText(true);
                /* $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $model_doc->subType->sub_type_name);*/
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $model_doc->address->address_id . ',' . $model_doc->address->address_name);
                $objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getAlignment()->setWrapText(true);
                if ('' . $_SESSION['subtype'] . '' == 'การเงิน' || '' . $_SESSION['subtype'] . '' == 'พัสดุ') {
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, number_format($item['money']));
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $this->MoneyDate($item['doc_date']));
                }
                if ($_SESSION['subtype']=='ทั้งหมด' && $item->subType->sub_type_name=='การเงิน'){
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, number_format($item['money']));
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $this->MoneyDate($item['doc_date']));
                }
                if ($_SESSION['subtype']=='ทั้งหมด' &&  $item->subType->sub_type_name=='พัสดุ'){
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, number_format($item['money']));
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $this->MoneyDate($item['doc_date']));
                }
                if ($_SESSION['subtype']=='ทั้งหมด' &&  $item->subType->sub_type_name!='การเงิน'&&$item->subType->sub_type_name!='พัสดุ'){
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i,'');
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, '');
                }
                $i++;
                $num++;
            }
        }
// Rename sheet
        /*    $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(-1);*/
        $objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="report'.date("Ymd_is").'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    /*-------------------------------------------PDF-----------------------------------------------------*/

    public
    function actionPdf()
    {
        if ($_SESSION['booktype'] == 1) {
            $model_doc = CmsDocument::find()->
            from(['cms_document', 'cms_doc_type', 'cms_doc_dept', 'user', 'cms_inbox', 'cms_doc_roll_receive'])->
            where('cms_document.doc_date BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
                ->andWhere('cms_document.type_id = cms_doc_type.type_id ')
                ->andWhere('cms_doc_dept.doc_dept_id = cms_document.doc_dept_id')
                ->andWhere('cms_inbox.doc_id = cms_document.doc_id')
                ->andWhere('cms_doc_roll_receive.doc_id = cms_document.doc_id')
                ->andWhere('cms_inbox.user_id=user.id')
                ->orderBy(['cms_doc_roll_receive.doc_roll_receive_id' => SORT_ASC])
                ->all();
        } else {
            $model_doc = CmsDocument::find()->
            from(['cms_document', 'cms_doc_type', 'cms_doc_dept', 'cms_doc_roll_send'])->
            where('cms_document.doc_date BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
                ->andWhere('cms_document.type_id = cms_doc_type.type_id')
                ->andWhere('cms_doc_dept.doc_dept_id = cms_document.doc_dept_id')
                ->andWhere('cms_doc_roll_send.doc_id = cms_document.doc_id')
                ->orderBy(['cms_doc_roll_send.doc_roll_send_id' => SORT_ASC])
                ->all();
        }


        $mpdf = new Mpdf([
            'format' => 'A4-L',
            /*'default_font' => 'thsarabunnew',*/
            'default_font' => 'Garuda',
            'table_error_report' => false
        ]); // ขนาด A4 font Garuda

        $mpdf->WriteHTML($this->renderPartial('_reportView', ['model_doc' => $model_doc])); // หน้า View สำหรับ export
        $mpdf->Output();
        exit();
    }


    /* ************************************ Delete  ********************************** */
    public
    function actionDeleteRoll()
    {
        $model_file = CmsDocFile::find()->all();
        $model_roll = CmsDocRollReceive::find()->all();
        $model_inbox = CmsInbox::find()->all();
        $model_secret = CmsDocSecret::find()->all();
        $model_speed = CmsDocSpeed::find()->all();
        $model_from_dept = CmsDocDept::find()->all();
        $model_doc = CmsDocument::find()->all();
        $model_doc_delete = CmsDeleteRoll::find()->all();
        $model_address = CmsAddress::find()->all();

        $this->layout = "main_module.php";
        return $this->render('delete_roll', [
            'model_file' => $model_file, 'model_secret' => $model_secret, 'model_speed' => $model_speed,
            'model_from_dept' => $model_from_dept
            , 'model_roll' => $model_roll, 'model_inbox' => $model_inbox,
            'model_doc' => $model_doc,
            'model_doc_delete' => $model_doc_delete, 'model_address' => $model_address,

        ]);
    }

    /* public function actionDataDelete()
     {
         $edit = Yii::$app->request->get('edit');;
         return $edit;
     }*/

    public
    function actionCreatedeleteroll()
    {
        $doc_id = Yii::$app->request->get('doc_id');

        $model = new DeleterollDAO();
        if (!empty($doc_id)) {
            $model->createDeleteroll($doc_id);
            /* $n = count($doc_id);
             for ($i = 0; $i < $n; $i++) {
                 echo $doc_id[$i] . ',';
             }
             echo "success";*/
        }

        return $this->redirect(['../correspondence/staff/delete-roll']);

    }

    public
    function actionDeleteDestroyroll()
    {
        $model = new DeleterollDAO();
        $model->Deleteroll($_GET['roll']);
    }


    public
    function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    protected
    function findModel($id)
    {
        if (($model = DocRoll::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected
    function findModelDocument($id)
    {
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected
    function findModelDocFile($file_id, $doc_id)
    {
        if (($model = DocFile::findOne(['file_id' => $file_id, 'doc_id' => $doc_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private
    function findDocRollId()
    {
        $connection = \Yii::$app->db;
        $model_roll = $connection->createCommand('SELECT * FROM cms_doc_roll_receive ORDER BY doc_roll_receive_id DESC LIMIT 1');
        $id_roll = $model_roll->queryAll();
        if ($id_roll != null) {
            foreach ($id_roll as $rows) {
                return $rows['doc_roll_receive_id'];
            }
        }

    }

}

?>