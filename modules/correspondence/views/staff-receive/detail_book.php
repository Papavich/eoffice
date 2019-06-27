<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\modules\correspondence\controllers;
use \app\modules\correspondence\models\AuditTrail;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Html::encode($this->title) . 'รายละเอียดหนังสือ';
$cancelTime = AuditTrail::find()->where(['model_id' => $_GET['id']])
    ->andWhere('field = "check_id"')
    ->andWhere(['new_value' => 2])
    ->andWhere('action = "UPDATE"')->one();
function showDateTimeReadTime($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];

    date_default_timezone_set("Asia/Bangkok");
    date('Y-m-d H:i:s');
    if (substr($strDate, 0, 10) == date('Y-m-d')) {
        return "$strHour:$strMinute";
    } elseif (substr($strDate, 0, 10) < date('Y-m-d') && substr($strDate, 0, 4) == date('Y')) {
        return "$strDay" . " /" . " $strMonthThai $strHour:$strMinute";
    } else {
        return "$strDay" . " /" . " $strMonthThai" . " / " . $strYear;
    }
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

?>
    <section id="middle" style="color: black">
    <div class="wizard" style="padding: 20px">

    <!--<div align="center" id="detail-text">
                <? /*= controllers::t('menu', 'Book Details') */ ?>
            </div>-->

    <div style="padding-left: 20px;">
        <h4 style="margin-bottom: 0">
            <?= Html::a("ทะเบียนหนังสือรับ", ['staff-receive/receive-roll']); ?> >
            <?= Html::a($model_doc->address->address_name, ['staff-receive/receive-roll-in-folder?id=' . $model_doc->address->address_id]); ?>
        </h4><br><br>
    </div>

    <div id="panel-1" class="panel panel-default" style="border: 2px solid grey;">
    <div class="panel-heading">
							<span class="title elipsis">
								<strong style="font-size: 22px;color: black"> <?= controllers::t('menu', 'Book Details') ?></strong>
                                <!-- panel title -->
							</span>

        <!-- right options -->
        <ul class="options pull-right list-inline">
            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                   data-placement="bottom"></a></li>
            <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen"
                   data-placement="bottom"><i class="fa fa-expand"></i></a></li>
        </ul>
        <!-- /right options -->

    </div>

    <!-- panel content -->
    <div class="panel-body">
<?php
if ($model_doc->check->check_id == 2) {
    echo "<span>
                                <h3 style='color: red;margin-bottom: 0px'>เอกสารฉบับนี้ถูกยกเลิกแล้ว
                                <span style='font-size: 12px;'>(" . $cancelTime->created . " )</span>
                                </h3>
                              </span>";
} elseif ($model_doc->check->check_id == 3) {
    echo "<h3 style='color: red'>เอกสารฉบับนี้กำลังรอการอนุมัติ</h3>";
} elseif ($model_doc->check->check_id == 4) {
    echo "<h3 style='color: red'>เอกสารฉบับนี้ผ่านการอนุมัติแล้ว</h3>";
} elseif ($model_doc->check->check_id == 5) {
    echo "<h3 style='color: red'>เอกสารฉบับนี้ไม่อนุมัติ</h3>";
} else if ($model_doc->cmsDeleteRolls) {
    foreach ($model_doc->cmsDeleteRolls as $item) {
        if ($item['status'] == "ทำลายเสร็จสิ้น") {
            echo "<h3 style='color: red'>เอกสารฉบับนี้ถูกทำลายแล้ว</h3>";
        }
    }
}
$roll_id = \app\modules\correspondence\models\CmsDocRollReceive::find()
    ->where('doc_id = "' . $model_doc->doc_id . '"')->one(); ?>
    <p><b><?= controllers::t('menu', 'Speed') ?> :</b> <?= $model_doc->speed->speed_name; ?>
        <span style="padding-right: 5%"></span>
        <b><?= controllers::t('menu', 'Secret') ?> :</b> <?= $model_doc->secret->secret_name; ?>
        <span style="padding-right: 5%"></span>
        <b><?= controllers::t('menu', 'Document type') ?> :</b> <?= $model_doc->type->type_name; ?>
        <span style="padding-right: 5%"></span>
        <b><?= controllers::t('menu', 'Category') ?> :</b> <?= $model_doc->subType->sub_type_name; ?>
    </p>

    <p><b><?= controllers::t('menu', 'Doc Roll Receive ID') ?>
            :</b> <?= substr($roll_id->doc_roll_receive_id, -4); ?>
        <span style="padding-right: 5%"></span>
        <b><?= controllers::t('menu', 'Receive Date') ?>
            :</b> <?= controllers::DateThai($model_doc->receive_date); ?>
    </p>
    <p>
        <b><?= controllers::t('menu', 'Doc From') ?> :</b> <?= $model_doc->docDept->doc_dept_name; ?>
        <span style="padding-right: 5%"></span>
        <b><?= controllers::t('menu', 'Doc Tel') ?> :</b> <?= $model_doc->doc_tel; ?>
    </p>

    <p><b><?= controllers::t('menu', 'Doc Id Regist') ?> :</b> <?= $model_doc->doc_id_regist; ?>
        <span style="padding-right: 5%"></span>
        <b><?= controllers::t('menu', 'Doc Date') ?>
            :</b> <?= controllers::DateThai($model_doc->doc_date); ?></p>
    <p><b><?= controllers::t('menu', 'Doc Subject') ?> :</b> <?= $model_doc->doc_subject; ?></p>
<?php
if ($model_doc->subType->sub_type_name == "การเงิน" || $model_doc->subType->sub_type_name == "พัสดุ") {
    echo "<p><b>" . controllers::t('menu', 'Money') . " :</b>  " . number_format($model_doc->money, 2) . " บาท
                    <span style=\"padding-right: 5%\"></span>
                    <b>" . controllers::t('menu', 'Fiscal year') . " :</b>  " . MoneyDate($model_doc->doc_date) . "</p>";
}
?>
    <p class='inbox_status'><b><?= controllers::t('menu', 'To') ?> : </b> <br>
        <?php
        $count = 0;
        foreach ($receiver as $i => $rows) {
            if (count($receiver) >= 2) {
                echo "<a href='#ReceiverModal' data-toggle='modal' data-whatever='@mdo'>";
                echo $rows->user->prefix_th . $rows->user->fname . " " . $rows->user->lname . " ";
                echo " " . controllers::t('menu', 'and others');
                echo "</a>";
                break;
            }
            if ($i == 1) {

            } else if (count($receiver) == 1) {
                echo $rows->user->prefix_th . $rows->user->fname . "  " . $rows->user->lname . " &nbsp สถานะ : <span >" .
                    $rows['inbox_status']
                    . "</span> " . ($rows['read_time'] != null ? "(" . showDateTimeReadTime($rows['read_time']) . ")" : "")
                    . "<br>";
            }
            $count++;
        }
        echo "</a>";
        ?>
    </p>
    <div style="border: 2px solid #606060;"></div>
    <p><b><?= controllers::t('menu', 'Address Book') ?> :</b> <?= $model_doc->address->address_name; ?>
    <span style="padding-right: 5%"></span>
<?php
if ($saver):
    ?>
    <b><?= controllers::t('menu', 'Recorder') ?> :</b>
    <?= $saver->PREFIXNAME . $saver->person_name . " " . $saver->person_surname; ?>
    <?php
        endif;
    ?>
    <span style="padding-right: 5%"></span>
    <b><?= controllers::t('menu', 'Doc Roll Receive Doing') ?>
        :</b> <?= $roll_id->doc_roll_receive_doing; ?> </p>
    <?php
    $docRef = \app\modules\correspondence\models\CmsDocRef::find()->where(['doc_id' => $model_doc->doc_id])->all();
    if ($docRef) {
        echo "<p><b>" . controllers::t('menu', 'Reference number') . " :</b>  ";
        foreach ($docRef as $row) {
            $doc = \app\modules\correspondence\models\CmsDocument::findOne($row['doc_ref']);
            if ($doc->cmsDocRollReceives) {
                echo Html::a("เลขที่ " . $doc->doc_id_regist . " เรื่อง "
                    . $doc->doc_subject,
                    \yii\helpers\Url::to('detail_book?id=' . $doc->doc_id),
                    ['target' => '_blank', 'style' => 'font-size: 16px']);

            } elseif ($doc->cmsDocRollSends) {
                echo Html::a("เลขที่ " . $doc->doc_id_regist . " เรื่อง "
                    . $doc->doc_subject,
                    \yii\helpers\Url::to('../staff-send/detail_book?id=' . $doc->doc_id),
                    ['target' => '_blank', 'style' => 'font-size: 16px']);
            }
            echo "<br>";
        }
        echo "</p>";
    }

    ?>
    <p><b><?= controllers::t('menu', 'File Book') ?> : </b><br>
        <?php
        if ($file) {
            foreach ($file as $items) {
                echo Html::a($items->file_name, \yii\helpers\Url::to(Yii::getAlias('@web') . '/web_cms/uploads/' .
                    $items->file_path . '/' . $items->file_name), ['target' => '_blank', 'style' => 'font-size: 16px']);
                echo "<br>";
            }
        } else {
            echo "ไม่พบไฟล์หนังสือ";
        }
        ?>
    </p>
    </div>
    <!-- /panel content -->

    </div>
    <!-- /PANEL -->
    <?= $this->render('../staff-send/preview-file', ['doc_id' => $_GET['id']]) ?>

    <!------------------------------------------- COMMENT ---------------------------------------------->

    <div class="row padding-50" align="center">
        <h1 class="page-header comment">Comments</h1>
        <section class="comment-list">
            <!-- First Comment -->
            <?php foreach ($inbox_reply as $comments) {
                if ($comments['message_reply']) {
                    ?>
                    <article class="row margin-top-10">
                        <div class="col-md-2 col-sm-2 hidden-xs">
                            <figure class="thumbnail">
                                <img class="img-responsive"
                                     src="https://openclipart.org/image/2400px/svg_to_png/202776/pawn.png"
                                     width="80"/>
                            </figure>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <div class="panel panel-default arrow left">
                                <div class="panel-body">
                                    <header class="text-left">
                                        <div class="comment-user"><i class="fa fa-user"></i>
                                            <?php
                                            $outBoxName = \app\modules\correspondence\models\CmsOutbox::find()
                                                ->where(['cms_outbox.outbox_id' => $comments['outbox_id']])
                                                ->one();
                                            if ($outBoxName->user->username == Yii::$app->user->identity->username) {
                                                echo controllers::t('menu', 'Me');
                                            } else {
                                                echo $outBoxName->user->prefix_th . $outBoxName->user->fname . " " .
                                                    $outBoxName->user->lname;
                                            }
                                            ?>
                                        </div>
                                        <time class="comment-date" datetime="16-12-2014 01:05"><i
                                                    class="fa fa-clock-o"></i>
                                            <?= controllers::DateThai($comments['message_reply_time']) ?>
                                        </time>
                                    </header>
                                    <div class="comment-post">
                                        <p>
                                            <?= $comments['message_reply'] ?>
                                        </p>
                                    </div>
                                    <!-- <p class="text-right "><a href="#" class="btn btn-success btn-sm"><i
                                                     class="fa fa-reply"></i> ตอบกลับ</a></p>-->
                                </div>
                            </div>
                        </div>
                    </article>
                <?php }
            } ?>
            <div style="border: 2px solid grey; margin: 0 0 1% 0"></div>
        </section>
    </div>
    </div>
    <!-- /.mailbox-read-message -->
    <!-- /.box-body -->
    </section>

    <!-- List receiver modal -->
    <div class="modal fade" id="ReceiverModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="panel-ui-tan-l1" class="panel panel-default">

                    <div class="panel-heading">
									<span class="elipsis"><!-- panel title -->
                                        <b>รายชื่อผู้รับ</b> <!-- panel title -->
									</span>
                        <!-- tabs nav -->
                        <ul class="nav nav-tabs pull-right tabsetting">
                            <li class="active">
                                <a href="#ttab1_nobg" data-toggle="tab" aria-expanded="true">
                                    <?= controllers::t('menu', 'read') ?>
                                </a>
                            </li>
                            <li class="">
                                <a href="#ttab2_nobg" data-toggle="tab"
                                   aria-expanded="false"><?= controllers::t('menu', 'unread') ?></a>
                            </li>

                        </ul>
                        <!-- /tabs nav -->
                    </div>
                </div>
                <div class="">
                    <!-- panel content -->
                    <div class="modal-body panel-body padding-20" style="margin: 0px">
                        <!-- tabs content -->
                        <div class="tab-content transparent">
                            <div id="ttab1_nobg" class="tab-pane active"><!-- TAB 1 CONTENT -->
                                <table class="table table-hover nomargin">
                                    <tbody>
                                    <?php
                                    $read = 0;
                                    foreach ($receiver as $rows) {
                                        if ($rows['inbox_status'] == "read") {
                                            echo '
                                            <tr>
                                                <td>' . "<b>" . $rows->user->prefix_th . $rows->user->fname . " " .
                                                $rows->user->lname . "</b>    "
                                                . showDateTimeReadTime($rows['read_time']) . '</td>
                                            </tr>';
                                        } else {
                                            $read++;
                                        }
                                    }
                                    if (count($receiver) == $read) {
                                        echo '<tr>
                                                <td><b>' . controllers::t('menu', 'No user has read') . '</b></td>
                                            </tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div><!-- /TAB 1 CONTENT -->
                            <div id="ttab2_nobg" class="tab-pane"><!-- TAB 2 CONTENT -->
                                <table class="table table-hover nomargin">
                                    <tbody>
                                    <?php
                                    $read = 0;
                                    foreach ($receiver as $rows) {
                                        if ($rows['inbox_status'] == "unread") {
                                            echo '
                                            <tr>
                                                <td>' . "<b>" . $rows->user->prefix_th . $rows->user->fname . " " .
                                                $rows->user->lname . '</b></td>
                                            </tr>';
                                        }
                                    }
                                    if (count($receiver) == $read) {
                                        echo '<tr>
                                                <td><b>' . controllers::t('menu', 'All users have read') . '</b></td>
                                            </tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div><!-- /TAB 2 CONTENT -->
                        </div>
                        <!-- /tabs content -->

                    </div>
                    <!-- /panel content -->
                </div>
            </div>
        </div>
    </div>
    <!-- Reply modal -->
    <div class="modal fade" id="ReplyModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="close1">&times;</button>
                    <h4 class="modal-title">ตอบกลับ</h4>
                </div>
                <div class="modal-body">
                    <form id="ReplyForm" method="post">

                        <!-- <div class="form-group">
                             <label for="recipient-name" class="control-label" >E-mail:</label>
                             <input type="email" class="form-control" id="email" name="email">
                             <p id="emailError" style="color: red;"></p>
                             <p id="emailpattenError" style="color: red;"></p>
                         </div>-->
                        <div class="form-group">

                            <input type="checkbox" name="status" value="read"> อนุมัติ :
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" style="height: 200px"></textarea>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group" align="right">
                                <button type="submit" class="btn btn-success loginsubmit" style="width: 120px;"
                                        value="submit" name="submit" id="submit">ส่ง
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Reply modal -->

    <!-- Forward modal -->
    <div class="modal fade" id="ForwardModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="close1">&times;</button>
                    <h4 class="modal-title">ส่งต่อ</h4>
                </div>
                <div class="modal-body">
                    <form id="ForwardForm" method="post">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <p id="emailError" style="color: red;"></p>
                            <p id="emailpattenError" style="color: red;"></p>
                        </div>
                        <div class="form-group">
                            บุคคลที่เลือก :
                            <textarea class="form-control" style="height: 200px">corres@gmail.com , maam@kkumail.com , jqudo@gmail.com</textarea>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group" align="right">
                                <button type="submit" class="btn btn-success loginsubmit" value="submit"
                                        name="submitForward" id="submitForward" style="width: 120px;">ส่ง
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    /** @var TYPE_NAME $docid */
    $this->registerJs(<<<JS
// $.each(listReceiver,function(index,value) {
//   $('#result').append(value+'<hr>');
// });
$('.inbox_status span').each(function(){
  if($(this).html() == 'unread'){
    $(this).css('color', 'red');
     //  console.log(span);
  }else{
      $(this).css('color', 'green');
  }
});    
JS
    );
    ?>