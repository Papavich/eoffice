<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\correspondence\models\CmsDocType;
use \app\modules\correspondence\controllers;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */
$funcT = '\app\modules\\' . Yii::$app->controller->module->id . '\controllers::t';
function DateThaifull($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}
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

function MoneyDate($strDate)
{
    $mm = date("n", strtotime($strDate));  //เดือนปัจจุบัน
    $yearbudget = date("Y", strtotime($strDate)) + 543;  //ปีปัจจุบัน

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
date_default_timezone_set("Asia/Bangkok");
$namefile = "report".date("Ymd_is");

?>

<head>

    <title><?= $namefile?></title>
    <style>
        body {
        }

        .head {
            font-size: 11pt;
            text-align: center;
        }

        table {
            border-collapse: collapse;
        }

        table, td, th {
            text-align: left;
            border: 1px solid black;
            padding: 2px 5px 2px 5px;
        }

        tr th {
            font-size: 10pt;
            text-align: center;
        }

        .body {
            line-height: 16pt;
            font-size: 10pt;
        }

        .fa-smile-o:before {
            content: "\f118";
        }
    </style>
</head>
<body>
<?php
$model_roll = '';
$model_doc = '';
if ($_SESSION['booktype'] == 1) { ?>
    <div class="head">
        <b>การออกรายงานทะเบียนหนังสือรับ ประจำวันที่ <?php
            date_default_timezone_set("Asia/Bangkok");
            $datenow = date("Y-m-d H:i:s");
            echo DateThaifull($datenow); ?>
            ระหว่างวันที่ <?php echo '(' . DateThaifull($_SESSION['datestart']) . ' ถึง ' .
                DateThaifull($_SESSION['dateend']) . ') หมวดหมู่ ' . $_SESSION['subtype'] . '' ?>
        </b>
    </div>
<?php }
if ($_SESSION['booktype'] == 2) { ?>
    <div class="head">
        <b>การออกรายงานทะเบียนหนังสือส่ง ประจำวันที่ <?php
            date_default_timezone_set("Asia/Bangkok");
            $datenow = date("Y-m-d H:i:s");
            echo DateThaifull($datenow); ?>
            ระหว่างวันที่ <?php echo '(' . DateThaifull($_SESSION['datestart']) . ' ถึง '
                . DateThaifull($_SESSION['dateend']) . ') หมวดหมู่ ' . $_SESSION['subtype'] . '' ?>
        </b>
    </div>
<?php } ?>
<?php
if ($_SESSION['booktype'] == 3) { ?>
    <div class="head">
        <b>การออกรายงานทะเบียนหนังสือทำลาย ประจำวันที่ <?php
            date_default_timezone_set("Asia/Bangkok");
            $datenow = date("Y-m-d H:i:s");
            echo DateThaifull($datenow); ?>
            ระหว่างวันที่ <?php echo '(' . DateThaifull($_SESSION['datestart']) . ' ถึง ' .
                DateThaifull($_SESSION['dateend']) . ') หมวดหมู่ ' . $_SESSION['subtype'] . '' ?>
        </b>
    </div>
<?php } ?>
<!--style="overflow:wrap;"-->
<table width="100%">
    <thead>
    <tr>
        <?php
        if ($_SESSION['booktype'] == 1) {
            ?>
            <th><?= $funcT('menu', 'Order')?></th>
            <th><?= $funcT('menu', 'Reception number')?></th>
            <th style="width: 100px"><?= $funcT('menu', 'Date of receipt') ?></th>
        <?php } ?>

        <?php
        if ($_SESSION['booktype'] == 2) {
            ?>
            <th><?= $funcT('menu', 'Order')?></th>
            <th><?= $funcT('menu', 'Sending number') ?></th>
            <th style="width: 100px"><?= $funcT('menu', 'Export date')?></th>
        <?php } ?>
        <?php
        if ($_SESSION['booktype'] == 3) {
            ?>
            <th><?= $funcT('menu', 'Order')?></th>
            <th><?= $funcT('menu', 'Reception number')?></th>
            <th style="width: 100px"><?= $funcT('menu', 'Book Date')?></th>
        <?php } ?>
        <th style="width: 150px"><?= $funcT('menu', 'Book number')?></th>
        <th style="width: 150px"><?= $funcT('menu', 'From')?></th>
        <th style="width: 170px"><?= $funcT('menu', 'To')?></th>
        <th style="width: 200px"><?= $funcT('menu', 'Title')?></th>
        <!--<th style="width:80px">หมวดหมู่</th>-->
        <th><?= $funcT('menu', 'Address Name')?></th>
        <?php if ('' . $_SESSION['subtype'] . '' == 'การเงิน' || '' . $_SESSION['subtype'] . '' == 'พัสดุ'|| '' . $_SESSION['subtype'] . '' == 'ทั้งหมด') {
            echo '<th style="width: 80px">'.$funcT('menu', 'Money').'</th>';
            echo '<th>'.$funcT('menu', 'Fiscal year').'</th>';
        } ?>
    </tr>
    </thead>
    <?php
    $i = 1;
    if ($_SESSION['booktype'] == 1) {
        if ($_SESSION['subtype'] != 'ทั้งหมด') {
            $model_roll = \app\modules\correspondence\models\CmsDocument::find()
                ->from(['cms_document', 'cms_doc_dept', 'cms_doc_roll_receive', 'cms_doc_type', 'user', 'cms_doc_sub_type', 'cms_outbox'])->
                where('cms_document.doc_date BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
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
        } else if ($_SESSION['subtype'] == 'ทั้งหมด') {
            $model_roll = \app\modules\correspondence\models\CmsDocument::find()
                ->from(['cms_document', 'cms_doc_dept', 'cms_doc_roll_receive', 'cms_doc_type', 'user', 'cms_doc_sub_type', 'cms_outbox'])->
                where('cms_document.doc_date BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
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
            $model_doc_roll_receive = \app\modules\correspondence\models\CmsDocRollReceive::find()->where(['doc_id' => $rows['doc_id']])->one();
            $model_doc = \app\modules\correspondence\models\CmsDocument::find()->where(['doc_id' => $rows['doc_id']])->one();
            if (!empty($model_doc)) {
                ?>
                <tr>
                <td class="body" align="center">
                    <?php
                    echo $i;
                    ?>

                </td>
                <td class="body">
                    <?php
                    echo substr($model_doc_roll_receive->doc_roll_receive_id, -4);
                    ?>

                </td>
                <td class="body">
                    <?php
                    echo DateThai($rows['receive_date']);
                    ?>
                </td>

                <td class="body">
                    <?= $rows['doc_id_regist']; ?>
                </td>
                <td class="body">

                    <?php
                    /*  $url = Yii::getAlias('../modules/correspondence').'/THSplitLib/segment.php';
                      require_once($url);
                      $segment = new Segment();

                      $model_doc_from_dept = \app\modules\correspondence\models\CmsDocDept::find()
                          ->where(['doc_dept_id' => $rows['doc_dept_id']])->one();
                      $doc_from = $model_doc_from_dept->doc_dept_name;
                      $result1 = $segment->get_segment_array($doc_from);
                      echo implode('', $result1);*/
                    $model_doc_from_dept = \app\modules\correspondence\models\CmsDocDept::find()
                        ->where(['doc_dept_id' => $rows['doc_dept_id']])->one();
                    echo $model_doc_from_dept->doc_dept_name;
                    ?>
                </td>
                <td class="body">
                    <?php
                    $inbox = \app\modules\correspondence\models\CmsInbox::find()
                        ->from(['cms_inbox', 'user'])
                        ->where("cms_inbox.doc_id  = '" . $rows['doc_id'] . "' AND cms_inbox.user_id = user.id")
                        ->andWhere('cms_inbox.message_reply_time IS NULL')
                        ->andWhere('cms_inbox.message_reply IS NULL')
                        ->all();
                    foreach ($inbox as $items) {
                        $model_user_inbox = \app\modules\correspondence\models\User::find()
                            ->where(['id' => $items['user_id']])
                            ->one();
                        $model_user_main= \app\modules\correspondence\models\model_main\EofficeCentralViewPisPerson::find()
                            ->where(['eoffice_central.view_pis_person.person_id' => $model_user_inbox->personcode])
                            ->one();
                       /* if (!empty($model_user_main)){
                            echo $model_user_main->PREFIXNAME.$model_user_main->person_name."  ".$model_user_main->person_surname.'<br>';
                        }*/
                      /* echo $items->user->prefix_th.$items->user->fname.'  '.$items->user->lname.'<br>';*/
                        echo  $model_user_main->PREFIXABB.$model_user_main->person_name."  ".$model_user_main->person_surname.'<br>';
                       /* echo $model_user_inbox->personcode.'<br>';*/

                        /*echo $model_user->prefix_th . $model_user->person_fname_th . ' ' .
                            $model_user->person_lname_th . '<br>';*/

                    } ?>
                </td>
                <td class="body"><?php echo $rows['doc_subject'] ?></td>
                <td class="body"><?php echo $model_doc->address->address_id . ',' . $model_doc->address->address_name ?></td>
                <?php if ('' . $_SESSION['subtype'] . '' == 'การเงิน' || '' . $_SESSION['subtype'] . '' == 'พัสดุ') {
                    echo '
                <td class="body">' . number_format($rows['money'], 2) . '</td>
                <td class="body">' . MoneyDate($rows['doc_date']) . '</td> 
                ';}
                    if ($_SESSION['subtype']=='ทั้งหมด' && $rows->subType->sub_type_name=='การเงิน'){
                        echo '<td class="body">' . number_format($rows->money, 2) . '</td>
                 <td class="body">' . MoneyDate($rows->receive_date) . '</td>';
                    }
                    if ($_SESSION['subtype']=='ทั้งหมด' &&  $rows->subType->sub_type_name=='พัสดุ'){
                        echo '<td class="body">' . number_format($rows->money, 2) . '</td>
                 <td class="body">' . MoneyDate($rows->receive_date) . '</td>';
                    }
                    if ($_SESSION['subtype']=='ทั้งหมด' &&  $rows->subType->sub_type_name!='การเงิน'&&$rows->subType->sub_type_name!='พัสดุ'){
                        echo '<td class="body">-</td>
                 <td class="body">-</td>';
                    }
            } ?>

            </tr>

            <?php
            $i++;
        }

    }
    else if ($_SESSION['booktype'] == 2) {
        $i = 1;
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
        } elseif ($_SESSION['subtype'] == 'ทั้งหมด') {
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
        foreach ($model_doc as $rows) {
            $model_doc_to_dept = \app\modules\correspondence\models\CmsDocDept::find()->where(['doc_dept_id' => $rows['doc_dept_id']])->one();
            $model_user = \app\modules\correspondence\models\User::find()->where(['id' => $rows['user_id']])->one();
            $model_doc = \app\modules\correspondence\models\CmsDocument::find()->where(['doc_id' => $rows['doc_id']])->one();
            $cms_doc_roll_send = \app\modules\correspondence\models\CmsDocRollSend::find()->where(['doc_id' => $rows['doc_id']])->one();
            if (!empty($model_doc)) {
                ?>
                <tr>
                    <td class="body" align="center">
                        <?php
                        echo $i;
                        ?>

                    </td>
                    <td class="body">
                        <?php

                        echo substr($cms_doc_roll_send->doc_roll_send_id, -4);
                        ?>
                    </td>
                    <td class="body">
                        <?php
                        echo DateThai($rows['sent_date']);
                        ?>
                    </td>

                    <td class="body">
                        <?= $rows['doc_id_regist']; ?>
                    </td>
                    <td class="body">
                        <?php
                        echo $rows['doc_from']
                        ?>
                    </td>
                    <td class="body">

                        <?php
                        /* $url = Yii::getAlias('../modules/correspondence').'/THSplitLib/segment.php';
                         require_once($url);
                         $segment = new Segment();

                         $model_doc_from_dept = \app\modules\correspondence\models\CmsDocDept::find()
                             ->where(['doc_dept_id' => $rows['doc_dept_id']])->one();
                         $doc_from = $model_doc_from_dept->doc_dept_name;
                         $result1 = $segment->get_segment_array($doc_from);
                         echo implode('  ', $result1);*/
                        echo $model_doc_to_dept->doc_dept_name;
                        ?>
                    </td>
                    <td class="body">

                        <?php
                        /*   $segment = new Segment();
                           $txt = $rows['doc_subject'];

                           $result = $segment->get_segment_array($txt);

                           echo implode('  ', $result);*/
                        echo $rows['doc_subject'];
                        ?>

                    </td>
                    <!--  <td class="body"> <?php
                    /*                        echo
                                            $model_doc->subType->sub_type_name */ ?>
                    </td>-->
                    <td class="body">
                        <?php
                        echo $model_doc->address->address_id . ',' . $model_doc->address->address_name
                        ?>

                    </td>
                    <?php if ('' . $_SESSION['subtype'] . '' == 'การเงิน' || '' . $_SESSION['subtype'] . '' == 'พัสดุ') {
                        echo '
                <td class="center">' . number_format($rows['money'], 2) . '</td>
                 <td class="center">' . MoneyDate($rows['doc_date']) . '</td>
               ';

                    }
                    if ($_SESSION['subtype']=='ทั้งหมด' && $rows->subType->sub_type_name=='การเงิน'){
                        echo '<td class="body">' . number_format($rows->money, 2) . '</td>
                 <td class="body">' . MoneyDate($rows->receive_date) . '</td>';
                    }
                    if ($_SESSION['subtype']=='ทั้งหมด' &&  $rows->subType->sub_type_name=='พัสดุ'){
                        echo '<td class="body">' . number_format($rows->money, 2) . '</td>
                 <td class="body">' . MoneyDate($rows->receive_date) . '</td>';
                    }
                    if ($_SESSION['subtype']=='ทั้งหมด' &&  $rows->subType->sub_type_name!='การเงิน'&&$rows->subType->sub_type_name!='พัสดุ'){
                        echo '<td class="body">-</td>
                 <td class="body">-</td>';
                    }
                    ?>
                </tr>

                }
                <?php

            }
            $i++;
        }
        ?>

        <?php

    }


    else{
    $i = 1;
    $datenow = date("Y-m-d h:m:s");
    if ($_SESSION['subtype'] != 'ทั้งหมด') {
        $model_doc_count = \app\modules\correspondence\models\CmsDocument::find()->
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
    } elseif ($_SESSION['subtype'] == 'ทั้งหมด') {
        $model_doc_count = \app\modules\correspondence\models\CmsDocument::find()->
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
    foreach ($model_doc_count as $rows) {
    $model_doc_roll_receive = \app\modules\correspondence\models\CmsDocRollReceive::find()->where(['doc_id' => $rows['doc_id']])->one();
    $model_doc = \app\modules\correspondence\models\CmsDocument::find()->where(['doc_id' => $rows['doc_id']])->one();
    if (!empty($model_doc)) {
    ?>
    <tr>
        <td class="body" align="center">
            <?php
            echo $i;
            ?>

        </td>
        <td class="body">
            <?php

            echo substr($model_doc_roll_receive->doc_roll_receive_id, -4);
            ?>
        </td>
        <td class="body">
            <?php
            echo DateThai($rows['doc_date']);
            ?>
        </td>

        <td class="body">
            <?= $rows['doc_id_regist']; ?>
        </td>
        <td class="body">

            <?php
            /* $url = Yii::getAlias('../modules/correspondence').'/THSplitLib/segment.php';
             require_once($url);
             $segment = new Segment();

             $model_doc_from_dept = \app\modules\correspondence\models\CmsDocDept::find()
                 ->where(['doc_dept_id' => $rows['doc_dept_id']])->one();
             $doc_from = $model_doc_from_dept->doc_dept_name;
             $result1 = $segment->get_segment_array($doc_from);
             echo implode('  ', $result1);*/
            $model_doc_from_dept = \app\modules\correspondence\models\CmsDocDept::find()
                ->where(['doc_dept_id' => $rows['doc_dept_id']])->one();
            echo $model_doc_from_dept->doc_dept_name;
            ?>
        </td>
        <td class="body">
            <?php
            $inbox = \app\modules\correspondence\models\CmsInbox::find()
                ->from(['cms_inbox', 'user'])
                ->where("cms_inbox.doc_id  = '" . $rows['doc_id'] . "' AND cms_inbox.user_id = user.id")
                ->andWhere('cms_inbox.message_reply_time IS NULL')
                ->andWhere('cms_inbox.message_reply IS NULL')
                ->all();
            foreach ($inbox as $items) {
                $model_user_inbox = \app\modules\correspondence\models\User::find()
                    ->where(['id' => $items['user_id']])
                    ->one();
                $model_user_main= \app\modules\correspondence\models\model_main\EofficeCentralViewPisPerson::find()
                    ->where(['eoffice_central.view_pis_person.person_id' => $model_user_inbox->personcode])
                    ->one();
                echo  $model_user_main->PREFIXABB.$model_user_main->person_name."  ".$model_user_main->person_surname.'<br>';
            } ?>
        </td>
        <td class="body">

            <?php
            /* $segment = new Segment();
             $txt = $rows['doc_subject'];

             $result = $segment->get_segment_array($txt);

             echo implode(' ', $result);*/
            echo $rows['doc_subject'];
            ?>

        </td>

        <!--<td class="body"> <?php
        /*            echo
                    $model_doc->subType->sub_type_name */ ?>
        </td>-->
        <td class="body">
            <?php
            echo $model_doc->address->address_id . ',' . $model_doc->address->address_name
            ?>

        </td class="body">
        <?php if ('' . $_SESSION['subtype'] . '' == 'การเงิน' || '' . $_SESSION['subtype'] . '' == 'พัสดุ') {
            echo '
                <td class="center">' . number_format($rows['money'], 2) . '</td>
                 <td class="center">' . MoneyDate($rows['doc_date']) . '</td>
               ';
        }
        if ($_SESSION['subtype']=='ทั้งหมด' && $rows->subType->sub_type_name=='การเงิน'){
            echo '<td class="body">' . number_format($rows->money, 2) . '</td>
                 <td class="body">' . MoneyDate($rows->receive_date) . '</td>';
        }
        if ($_SESSION['subtype']=='ทั้งหมด' &&  $rows->subType->sub_type_name=='พัสดุ'){
            echo '<td class="body">' . number_format($rows->money, 2) . '</td>
                 <td class="body">' . MoneyDate($rows->receive_date) . '</td>';
        }
        if ($_SESSION['subtype']=='ทั้งหมด' &&  $rows->subType->sub_type_name!='การเงิน'&&$rows->subType->sub_type_name!='พัสดุ'){
            echo '<td class="body">-</td>
                 <td class="body">-</td>';
        }
        }
        $i++;
        }
        }
        ?>

    </tr>

</table>

<?php

if (count($model_roll) == 0 || count($model_doc) == 0) {
    echo "<p align='center' style='font-size: 14px'>ไม่พบรายการที่ค้นหา</p>";
}


if ($_SESSION['booktype'] == 1) {
    if ($_SESSION['subtype'] != 'ทั้งหมด') {
        $model_roll_count = \app\modules\correspondence\models\CmsDocument::find()
            ->from(['cms_document', 'cms_doc_dept', 'cms_doc_roll_receive', 'cms_doc_type', 'user', 'cms_doc_sub_type', 'cms_outbox'])->
            where('cms_document.doc_date BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
            ->andWhere('cms_document.type_id=cms_doc_type.type_id')
            ->andWhere('cms_doc_dept.doc_dept_id=cms_document.doc_dept_id')
            ->andWhere('cms_doc_roll_receive.doc_id=cms_document.doc_id')
            ->andWhere('cms_document.user_id=user.id')
            ->andWhere('cms_doc_sub_type.sub_type_name="' . $_SESSION['subtype'] . '"')
            ->andWhere('cms_doc_sub_type.sub_type_id=cms_document.sub_type_id')
            ->andWhere('cms_outbox.doc_id=cms_document.doc_id')
            ->andWhere('cms_outbox.outbox_content IS NULL')
            ->orderBy(['cms_doc_roll_receive.doc_roll_receive_id' => SORT_ASC])
            ->count();
    } elseif ($_SESSION['subtype'] == 'ทั้งหมด') {
        $model_roll_count = \app\modules\correspondence\models\CmsDocument::find()
            ->from(['cms_document', 'cms_doc_dept', 'cms_doc_roll_receive', 'cms_doc_type', 'user', 'cms_doc_sub_type', 'cms_outbox'])->
            where('cms_document.doc_date BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
            ->andWhere('cms_document.type_id=cms_doc_type.type_id')
            ->andWhere('cms_doc_dept.doc_dept_id=cms_document.doc_dept_id')
            ->andWhere('cms_doc_roll_receive.doc_id=cms_document.doc_id')
            ->andWhere('cms_document.user_id=user.id')
            ->andWhere('cms_doc_sub_type.sub_type_id=cms_document.sub_type_id')
            ->andWhere('cms_outbox.doc_id=cms_document.doc_id')
            ->andWhere('cms_outbox.outbox_content IS NULL')
            ->orderBy(['cms_doc_roll_receive.doc_roll_receive_id' => SORT_ASC])
            ->count();
    }
    echo 'รวมเอกสารทั้งหมดทั้งสิ้น : ' . $model_roll_count . ' ฉบับ';
} else if ($_SESSION['booktype'] == 2) {
    if ($_SESSION['subtype'] != 'ทั้งหมด') {
        $model_doc_count = \app\modules\correspondence\models\CmsDocument::find()->
        from(['cms_document', 'cms_doc_type', 'cms_doc_dept', 'cms_doc_roll_send', 'cms_doc_sub_type'])->
        where('cms_document.doc_date BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
            ->andWhere('cms_document.type_id = cms_doc_type.type_id')
            ->andWhere('cms_doc_dept.doc_dept_id = cms_document.doc_dept_id')
            ->andWhere('cms_doc_roll_send.doc_id = cms_document.doc_id')
            ->andWhere('cms_doc_sub_type.sub_type_name="' . $_SESSION['subtype'] . '"')
            ->andWhere('cms_doc_sub_type.sub_type_id=cms_document.sub_type_id')
            ->orderBy(['cms_doc_roll_send.doc_roll_send_id' => SORT_ASC])
            ->count();
    } elseif ($_SESSION['subtype'] == 'ทั้งหมด') {
        $model_doc_count = \app\modules\correspondence\models\CmsDocument::find()->
        from(['cms_document', 'cms_doc_type', 'cms_doc_dept', 'cms_doc_roll_send', 'cms_doc_sub_type'])->
        where('cms_document.doc_date BETWEEN "' . $_SESSION['datestart'] . '" AND "' . $_SESSION['dateend'] . '"')
            ->andWhere('cms_document.type_id = cms_doc_type.type_id')
            ->andWhere('cms_doc_dept.doc_dept_id = cms_document.doc_dept_id')
            ->andWhere('cms_doc_roll_send.doc_id = cms_document.doc_id')
            ->andWhere('cms_doc_sub_type.sub_type_id=cms_document.sub_type_id')
            ->orderBy(['cms_doc_roll_send.doc_roll_send_id' => SORT_ASC])
            ->count();
    }
    echo 'รวมเอกสารทั้งหมดทั้งสิ้น : ' . $model_doc_count . ' ฉบับ';
} else {
    $datenow = date("Y-m-d H:i:s");
    if ($_SESSION['subtype'] != 'ทั้งหมด') {
        $model_doc_count = \app\modules\correspondence\models\CmsDocument::find()->
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
            ->count();
    } elseif ($_SESSION['subtype'] == 'ทั้งหมด') {
        $model_doc_count = \app\modules\correspondence\models\CmsDocument::find()->
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
            ->count();
    }
    echo 'รวมเอกสารทั้งหมดทั้งสิ้น : ' . $model_doc_count . ' ฉบับ';
}
?>
</body>


