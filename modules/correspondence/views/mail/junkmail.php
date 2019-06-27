<?php
use yii\helpers\Html;
use \app\modules\correspondence\controllers;
$this->title = Html::encode($this->title) . 'จดหมายขยะ';

?>


<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <!-- Menu mail  -->
            <!-- /.col -->
            <div class="col-md-12">
                <div class="box box-primary" style="overflow: inherit">
                    <!-- Mail Header -->
                    <?= $this->render('mail_header', ['model_label' => $model_label]) ?>
                    <!-- /.Mail Header -->
                    <!-- Mail Body -->
                    <div class="table-responsive mailbox-messages">
                        <table id="example" class="table table-hover mail-table" cellspacing="0" width="100%">
                            <thead>
                            <tr style="padding: 0">
                                <th style="padding: 0"></th>
                                <th style="padding: 0"></th>
                                <th style="padding: 0"></th>
                                <th style="padding: 0"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            if (!\Yii::$app->authManager->isAdmin() && !\Yii::$app->authManager->isStaffGeneral()) {
                                foreach ($model_inbox as $rows) {
                                    $labelName = "";
//                                        $currentUser = \app\modules\correspondence\models\User::find()->where(['username' => Yii::$app->user->identity->username])->one();
//                                        $inbox = \app\modules\correspondence\models\CmsInbox::find()
//                                            ->where(['cms_inbox.user_id' => Yii::$app->user->identity->id])
//                                            ->andWhere(['inbox_trash' => 0])
//                                            ->orderBy(['inbox_time' => SORT_DESC])
//                                            ->one();
                                    foreach ($model_label as $label) {
                                        foreach ($label->inboxLabels as $i) {
                                            if ($i['inbox_id'] == $rows['inbox_id']) {
                                                $labelName = $i->label->label_name;
                                            }
                                        }
                                    }
                                    if ($rows->inbox_status == "read") { ?>
                                        <tr style="background-color: #F2EDED">
                                            <td><input type="checkbox" name="listmails[]"
                                                       value="<?= $rows['inbox_id'] ?>"></td>
                                            <div onclick="location.href='readmail'">
                                                <td class="mailbox-name">
                                                    <?= Html::a("จาก <b>" . $rows->outbox->user->username . "</b>", ['mail/read-mail?id=' . $rows['inbox_id']]) ?>
                                                </td>
                                                <td class="mailbox-subject">
                                                    <?= Html::a("<span style='background-color: #EEEDED; margin-right: 10px' title='ป้ายกำกับ'>"
                                                        . $labelName . "</span>  "
                                                        . iconv_substr("<b>" . $rows->doc->doc_subject .
                                                            "</b>  <span style='font-size: 12px; color: black;'> 
                                                            ประเภท:" . $rows->doc->type->type_name . "
                                                        | ชั้นความเร็ว: <span class='speed'>" . $rows->doc->speed->speed_name . "</span> | 
                                                        ชั้นความลับ: " . $rows->doc->secret->secret_name . " 
                                                        </span>", 0, 500, 'UTF-8') . '...', ['mail/read-mail?id=' . $rows['inbox_id']]); ?>
                                                </td>
                                                <td class="mailbox-date" style="color: black">
                                                    <b><?= controllers::DateThaiForMail($rows['inbox_time']) ?> </b></td>
                                            </div>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <td><input type="checkbox" name="listmails[]"
                                                       value="<?= $rows['inbox_id'] ?>"></td>
                                            <div onclick="location.href='readmail'">
                                                <td class="mailbox-name">
                                                    <?= Html::a("จาก <b>" . $rows->outbox->user->username . "</b>", ['mail/read-mail?id=' . $rows['inbox_id']]) ?>
                                                </td>
                                                <td class="mailbox-subject">
                                                    <?= Html::a("<span style='background-color: #EEEDED; margin-right: 10px' title='ป้ายกำกับ'>"
                                                        . $labelName . "</span>  "
                                                        . iconv_substr("<b>" . $rows->doc->doc_subject .
                                                            "</b>  <span style='font-size: 12px; color: black;'> 
                                                               ประเภท:" . $rows->doc->type->type_name . "
                                                        | ชั้นความเร็ว: <span class='speed'>" . $rows->doc->speed->speed_name . "</span> | 
                                                        ชั้นความลับ: " . $rows->doc->secret->secret_name . " 
                                                        </span>", 0, 500, 'UTF-8') . '...', ['mail/read-mail?id=' . $rows['inbox_id']]); ?>
                                                </td>
                                                <td class="mailbox-date" style="color: black">
                                                    <b><?= controllers::DateThaiForMail($rows['inbox_time']) ?> </b></td>
                                            </div>
                                        </tr>
                                    <?php }
                                }
/*********************************************************************************************************************************************************/
                                foreach ($model_outbox as $rows) {
                                    $countMail = \app\modules\correspondence\models\CmsOutbox::find()
                                        ->from(['cms_outbox', 'user'])
                                        ->where(['cms_outbox.user_id' =>$user->id])
                                        ->andWhere(['cms_outbox.outbox_subject'=>$rows['outbox_subject']])
                                        ->andWhere('cms_outbox.user_id = user.id')
                                        ->andWhere('cms_outbox.outbox_trash = 1')
                                        ->count();
                                    ?>
                                    <tr style="background-color: #F2EDED">
                                        <td><input type="checkbox" name="listmailsOutbox[]"
                                                   value="<?= $rows['outbox_id'] ?>"/></td>
                                        <div onclick="location.href='read-send-mail'">
                                            <td class="mailbox-name">
                                                <b> ถึง</b>
                                                <?php
                                                $result = "";
                                                foreach ($rows->cmsInboxes as $index => $item) {
                                                    if (count($rows->cmsInboxes) >= 2 && $index > 0) {
                                                        echo $item->user->username . " และคนอื่น ๆ";
                                                        break;
                                                    } else if (count($rows->cmsInboxes) == 1 && $index == 0) {
                                                        echo $item->user->username;
                                                    }
                                                }
                                                if($countMail>1) echo "(".$countMail.")";
                                                ?>
                                            </td>
                                            <td class="mailbox-subject">
                                                <?= Html::a(iconv_substr("<b>" . $rows['outbox_subject'] .
                                                        "</b>  <span style='font-size: 12px; color: black;'> ประเภท:" . $rows->doc->type->type_name . "
                                                        | ชั้นความเร็ว: " . $rows->doc->speed->speed_name . " | ชั้นความลับ: " . $rows->doc->secret->secret_name . " 
                                                        </span>", 0, 500, 'UTF-8') . '...', ['mail/read-send-mail?id=' . $rows['outbox_id']]); ?>
                                            </td>
                                            <td class="mailbox-date" style="color: black">
                                                <b><?= controllers::DateThaiForMail($rows['outbox_time']) ?> </b></td>
                                        </div>
                                    </tr>
                                    <?php
                                }
                            } else { // Admin
                                foreach ($model_inbox as $rows) {
                                    $labelName = "";
                                    foreach ($model_label as $label) {
                                        foreach ($label->inboxLabels as $i) {
                                            if ($i['inbox_id'] == $rows['inbox_id']) {
                                                $labelName = $i->label->label_name;
                                            }
                                        }
                                    }
                                    if ($rows->outbox->outbox_status) { ?>
                                        <tr style="background-color: #F2EDED">
                                            <td><input type="checkbox" name="listmails[]"
                                                       value="<?= $rows['inbox_id'] ?>"></td>
                                            <div>
                                                <td class="mailbox-name">
                                                    <?= Html::a("จาก <b>" . $rows->outbox->user->username . "</b>", ['mail/read-reply-mail?id=' . $rows->outbox->outbox_id]) ?>
                                                </td>
                                                <td class="mailbox-subject">
                                                    <?= Html::a("<span style='background-color: #EEEDED; margin-right: 10px' title='ป้ายกำกับ'>"
                                                        . $labelName . "</span>  "
                                                        . iconv_substr("<b>" . $rows->doc->doc_subject .
                                                            "</b>  <span style='font-size: 12px; color: black;'> ประเภท:" . $rows->doc->type->type_name . "
                                                        |ชั้นความเร็ว: <span class='speed'>" . $rows->doc->speed->speed_name . "</span> | ชั้นความลับ: " . $rows->doc->secret->secret_name . " 
                                                        </span>", 0, 500, 'UTF-8') . '...', ['mail/read-reply-mail?id=' . $rows->outbox->outbox_id]); ?>
                                                </td>

                                                <td class="mailbox-date" style="color: black">
                                                    <b><?= controllers::DateThaiForMail($rows['inbox_time']) ?> </b></td>
                                            </div>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <td><input type="checkbox" name="listmails[]"
                                                       value="<?= $rows['inbox_id'] ?>"></td>
                                            <div>
                                                <td class="mailbox-name">
                                                    <?= Html::a("จาก <b>" . $rows->outbox->user->username . "</b>", ['mail/read-reply-mail?id=' . $rows->outbox->outbox_id]) ?>
                                                </td>
                                                <td class="mailbox-subject">
                                                    <?= Html::a("<span style='background-color: #EEEDED; margin-right: 10px' title='ป้ายกำกับ'>"
                                                        . $labelName . "</span>  "
                                                        . iconv_substr("<b>" . $rows->doc->doc_subject .
                                                            "</b>  <span style='font-size: 12px; color: black;'> ประเภท:" . $rows->doc->type->type_name . "
                                                        |ชั้นความเร็ว: <span class='speed'>" . $rows->doc->speed->speed_name . "</span> | ชั้นความลับ: " . $rows->doc->secret->secret_name . " 
                                                        </span>", 0, 500, 'UTF-8') . '...', ['mail/read-reply-mail?id=' . $rows->outbox->outbox_id]); ?>
                                                </td>
                                                <td class="mailbox-date" style="color: black">
                                                    <b><?= controllers::DateThaiForMail($rows['inbox_time']) ?> </b></td>
                                            </div>
                                        </tr>
                                    <?php }
                                }
                                foreach ($model_outbox as $rows) {
                                    $countMail = \app\modules\correspondence\models\CmsOutbox::find()
                                        ->from(['cms_outbox', 'user'])
                                        ->where(['cms_outbox.user_id' =>Yii::$app->user->identity->id])
                                        ->andWhere(['cms_outbox.outbox_subject'=>$rows['outbox_subject']])
                                        ->andWhere('cms_outbox.user_id = user.id')
                                        ->andWhere('cms_outbox.outbox_trash = 1')
                                        ->count();
                                    ?>
                                    <tr style="background-color: #F2EDED">
                                        <td><input type="checkbox" name="listmailsOutbox[]"
                                                   value="<?= $rows['outbox_id'] ?>"/></td>
                                        <div onclick="location.href='read-send-mail'">
                                            <td class="mailbox-name">
                                                <b> ถึง</b>
                                                <?php
                                                $result = "";
                                                foreach ($rows->cmsInboxes as $index => $item) {
                                                    if (count($rows->cmsInboxes) >= 2 && $index > 0) {
                                                        echo $item->user->username . " และคนอื่น ๆ";
                                                        break;
                                                    } else if (count($rows->cmsInboxes) == 1 && $index == 0) {
                                                        echo $item->user->username;
                                                    }
                                                    if($countMail>1) echo "(".$countMail.")";
                                                }
                                                ?>
                                            </td>
                                            <td class="mailbox-subject">
                                                <?= Html::a(iconv_substr("<b>" . $rows['outbox_subject'] .
                                                        "</b>  <span style='font-size: 12px; color: black;'> ประเภท:" . $rows->doc->type->type_name . "
                                                        | ชั้นความเร็ว: " . $rows->doc->speed->speed_name . " | ชั้นความลับ: " . $rows->doc->secret->secret_name . " 
                                                        </span>", 0, 500, 'UTF-8') . '...', ['mail/read-send-mail?id=' . $rows['outbox_id']]); ?>
                                            </td>
                                            <td class="mailbox-date" style="color: black">
                                                <b><?= controllers::DateThaiForMail($rows['outbox_time']) ?> </b></td>
                                        </div>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.Mail Body -->
                </form>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.box-body -->
                <br>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<?= $this->render('label_form') ?>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>


