<?php

use yii\helpers\Html;
use app\modules\correspondence\controllers;

?>

<div class="table-responsive mailbox-messages">
    <table class="table table-hover" cellspacing="0" width="100%" style="margin-top: 5px; margin-bottom: 5px;">
        <thead>
        <tr style="padding: 0">
            <th style="padding: 0"></th>
            <th style="padding: 0"></th>
            <th style="padding: 0"></th>
            <th style="padding: 0"></th>
            <th style="padding: 0"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($model_inbox) {
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
                        <tr>
                            <td><input type="checkbox" name="listmails[]"
                                       value="<?= $rows['inbox_id'] ?>"></td>
                            <td class="mailbox-star">
                                <a href="#" onclick="redirectDeleteRoll('<?= $rows['inbox_id'] ?>')"
                                   class="favMail">
                                    <?php
                                    if ($rows['inbox_fav'] == 0) {
                                        echo '<i class="fa fa-star-o text-yellow"></i>';
                                    } else {
                                        echo '<i class="fa fa-star text-yellow"></i>';
                                    }
                                    ?>
                                </a>
                            </td>
                            <div onclick="location.href='readmail'">
                                <td class="mailbox-name">
                                    <?= Html::a("จาก <b>" . $rows->outbox->user->username . "</b>", ['mail/read-mail?id=' . $rows['inbox_id']]) ?>
                                </td>
                                <td class="mailbox-subject">
                                    <?= Html::a("<span style='background-color: #EEEDED; margin-right: 10px' title='ป้ายกำกับ'>"
                                        . $labelName . "</span>  "
                                        . iconv_substr("<b> ที่ " . $rows->doc->doc_id_regist . "</b> | เรื่อง: " . $rows->doc->doc_subject .
                                            " | <span style='font-size: 12px; color: black;'> 
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
                        <tr style="background-color: #F2EDED">
                            <td><input type="checkbox" name="listmails[]"
                                       value="<?= $rows['inbox_id'] ?>"></td>
                            <td class="mailbox-star">
                                <a href="#" onclick="redirectDeleteRoll('<?= $rows['inbox_id'] ?>')"
                                   class="favMail">
                                    <?php
                                    if ($rows['inbox_fav'] == 0) {
                                        echo '<i class="fa fa-star-o text-yellow"></i>';
                                    } else {
                                        echo '<i class="fa fa-star text-yellow"></i>';
                                    }
                                    ?>
                                </a>
                            </td>
                            <div onclick="location.href='readmail'">
                                <td class="mailbox-name">
                                    <?= Html::a("จาก <b>" . $rows->outbox->user->username . "</b>", ['mail/read-mail?id=' . $rows['inbox_id']]) ?>
                                </td>
                                <td class="mailbox-subject">
                                    <?= Html::a("<span style='background-color: #EEEDED; margin-right: 10px' title='ป้ายกำกับ'>"
                                        . $labelName . "</span>  "
                                        . iconv_substr("<b> ที่ " . $rows->doc->doc_id_regist . "</b> | เรื่อง: " . $rows->doc->doc_subject .
                                            " | <span style='font-size: 12px; color: black;'> 
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
            } else {
                //Admin
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
                            <td class="mailbox-star">
                                <a href="#" onclick="redirectDeleteRoll('<?= $rows['inbox_id'] ?>')"
                                   class="favMail">
                                    <?php
                                    if ($rows['inbox_fav'] == 0) {
                                        echo '<i class="fa fa-star-o text-yellow"></i>';
                                    } else {
                                        echo '<i class="fa fa-star text-yellow"></i>';
                                    }
                                    ?>
                                </a>
                            </td>
                            <div>
                                <td class="mailbox-name">
                                    <?= Html::a("จาก <b>" . $rows->outbox->user->username . "</b>", ['mail/read-reply-mail?id=' . $rows->outbox->outbox_id]) ?>
                                </td>
                                <td class="mailbox-subject">
                                    <?= Html::a("<span style='background-color: #EEEDED; margin-right: 10px' title='ป้ายกำกับ'>"
                                        . $labelName . "</span>  "
                                        . iconv_substr("<b> ที่ " . $rows->doc->doc_id_regist . "</b> | เรื่อง: " . $rows->doc->doc_subject .
                                            " | <span style='font-size: 12px; color: black;'> ประเภท:" . $rows->doc->type->type_name . "
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
                            <td class="mailbox-star">
                                <a href="#" onclick="redirectDeleteRoll('<?= $rows['inbox_id'] ?>')"
                                   class="favMail">
                                    <?php
                                    if ($rows['inbox_fav'] == 0) {
                                        echo '<i class="fa fa-star-o text-yellow"></i>';
                                    } else {
                                        echo '<i class="fa fa-star text-yellow"></i>';
                                    }
                                    ?>
                                </a>
                            </td>
                            <div>
                                <td class="mailbox-name">
                                    <?= Html::a("จาก <b>" . $rows->outbox->user->username . "</b>", ['mail/read-reply-mail?id=' . $rows->outbox->outbox_id]) ?>
                                </td>
                                <td class="mailbox-subject">
                                    <?= Html::a("<span style='background-color: #EEEDED; margin-right: 10px' title='ป้ายกำกับ'>"
                                        . $labelName . "</span>  "
                                        . iconv_substr("<b> ที่ " . $rows->doc->doc_id_regist . "</b> | เรื่อง: " . $rows->doc->doc_subject .
                                            " | <span style='font-size: 12px; color: black;'> ประเภท:" . $rows->doc->type->type_name . "
                                                        |ชั้นความเร็ว: <span class='speed'>" . $rows->doc->speed->speed_name . "</span> | ชั้นความลับ: " . $rows->doc->secret->secret_name . " 
                                                        </span>", 0, 500, 'UTF-8') . '...', ['mail/read-reply-mail?id=' . $rows->outbox->outbox_id]); ?>
                                </td>
                                <td class="mailbox-date" style="color: black">
                                    <b><?= controllers::DateThaiForMail($rows['inbox_time']) ?> </b></td>
                            </div>
                        </tr>
                    <?php }
                }
            }
        } else {
            //no have any message

            echo "<div style='margin-top: 10px;'>".
                "<div class=\"col-md-2 col-md-offset-5\" style='color: black; margin-bottom: 10px'>" . controllers::t('menu', 'No sent messages!') ."
                </div></div>";
        }
        ?>
        </tbody>
    </table>
    <div class="pull-right">
        <?php echo \yii\widgets\LinkPager::widget([
            'pagination' => $pages,
            'firstPageLabel' => false,
            'lastPageLabel' => false,
            'prevPageLabel' => '<i class="glyphicon glyphicon-chevron-left"></i>',
            'nextPageLabel' => '<i class="glyphicon glyphicon-chevron-right"></i>',
            'maxButtonCount' => false,

        ]);
        ?>
    </div>
    <!-- /.table -->
</div>