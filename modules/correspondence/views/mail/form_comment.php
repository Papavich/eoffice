<?php

use app\modules\correspondence\controllers;
use \app\modules\correspondence\models\model_main\EofficeCentralViewPisUser;

?>
<?php
if (!$inbox) {
    //Reply in read-send-mail.php (Outbox)
    ?>
    <!-- /.box-footer outbox -->
    <div class="box-footer">
        <?php
        if ($model_document->doc->check->check_id == 1 && !$model_document->doc->cmsDeleteRolls) {
            if (!\Yii::$app->authManager->isAdmin() && !\Yii::$app->authManager->isStaffGeneral()) {
                ?>
                <div class="table-responsive">
                    <form method="POST" id="mailForm">
                        <table style="margin-bottom: 10px">
                            <tr>
                                <td>
                                    <select id="sendOption" class="form-control" style=" width: 100px;"
                                            name="sendType">
                                        <option value="reply"><?= controllers::t('menu', 'Reply'); ?></option>
                                        <option value="forward"><?= controllers::t('menu', 'For word'); ?></option>
                                    </select>
                                </td>
                                <td style="padding-left:10px;">
                                    <div id="replyTo">
                                        <?php
                                        $sentTo = "";
                                        foreach ($model_document->cmsInboxes as $index => $receivers) {
                                            if ($index == 0) {
                                                $sentTo = $receivers->user->prefix_th . $receivers->user->fname . " " . $receivers->user->lname;
                                            } else {
                                                $sentTo = $receivers->user->prefix_th . $receivers->user->fname . " " . $receivers->user->lname .
                                                    controllers::t('menu', 'and others') .
                                                    " <button  type='button' id='show-details-receiver' data-toggle='modal' data-target='.bs-example-modal-lg'>
                                                        <i class='glyphicon glyphicon-collapse-down' style='margin-left: 2px' title='" . controllers::t('menu', 'Show details') . "'></i>
                                                      </button>";
                                                break;
                                            }
                                        }
                                        ?>
                                        <?= controllers::t('menu', 'To') . ": " . $sentTo ?>
                                    </div>
                                    <div id="forwadTo" style="display: none">
                                        <input type="text" class="col-xs-12"
                                               placeholder="ระบุคนที่ต้องการส่งถึง"
                                               list="forward-name"
                                               id="keyword-forward" autocomplete="off"
                                               onkeyup="send(event)" style="width: 500px;">
                                        <datalist id="forward-name"></datalist>
                                    </div>
                                </td>

                            </tr>
                        </table>
                        <div id="receiver" style="margin: 20px"></div>
                        <textarea rows="5" class="form-control" placeholder="พิมพ์ข้อความตอบกลับ"
                                  name="comment" id="content"></textarea>
                        <input type="hidden" name="outbox_id" value="<?= $_GET['id'] ?>" id="inbox_id">
                        <input type="hidden" name="page" value="readMail">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>"
                               value="<?= Yii::$app->request->csrfToken; ?>"/>
                </div>
                <span style="display: none; color: red" id="comment-error">ข้อความจะต้องไม่ว่าง !</span>
                <br>
                <button type="button" style="width:100%;"
                        class="btn btn-3d btn-success"
                        id="submitReadSentPage"><?= controllers::t('menu', 'Send'); ?>
                </button>
                <br><br>
                </form>
                <?php
            }

        } else if ($model_document->doc->check->check_id == 3 && !$model_document->doc->cmsDeleteRolls) { //need to approve
            //TODO edit to correct permission  siratpat=>8348, wachi=>108955, somjit=>102298
            //check current is หัวหน้าภาค 8348
            $leader = EofficeCentralViewPisUser::findOne(Yii::$app->user->identity->id);
            //current user have data in boardDirector ?
            if($leader->person->boardDirector) {
                if ($leader->person->boardDirector->position_name == "หัวหน้าภาควิชาวิทยาการคอมพิวเตอร์" &&
                    $leader->person->boardDirector->period_describe == "สมัยปัจจุบัน") {
            //if(Yii::$app->user->identity->username == "108955") {
                    //if current user is LEADER
                    ?>
                    <form method="POST" id="mailApproveForm">
                        <div class="table-responsive">
                            <table style="margin-bottom: 10px">
                                <tr>
                                    <td>
                                        <select id="sendApproveOption" class="form-control" style=" width: 100px;"
                                                name="sendType">
                                            <option value="approve"><?= controllers::t('menu', 'Approve'); ?></option>
                                            <option value="reject"><?= controllers::t('menu', 'Reject'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <textarea rows="5" class="form-control" placeholder="พิมพ์ข้อความ....."
                                      name="comment" id="content"></textarea>
                            <input type="hidden" name="inbox_id" value="<?= $_GET['id'] ?>" id="inbox_id">
                            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>"
                                   value="<?= Yii::$app->request->csrfToken; ?>"/>
                        </div>
                        <div class="pull-right">
                            <button type="submit"
                                    class="btn btn-3d btn-blue"
                                    id="submitApprove"><?= controllers::t('menu', 'Send'); ?></button>
                        </div>
                    </form>
                    <?php
                }
            }
        }
        ?>
    </div>
    <?php
} else {
    //Reply in read-mail.php (Inbox)
    ?>
    <!-- /.box-footer inbox -->
    <div class="box-footer">
        <?php
        if ($model_document->doc->check->check_id == 1 && !$model_document->doc->cmsDeleteRolls) {
            if (!\Yii::$app->authManager->isAdmin() && !\Yii::$app->authManager->isStaffGeneral()) {
                ?>
                <div class="table-responsive">
                    <form method="POST" id="mailForm">
                        <table style="margin-bottom: 10px">
                            <tr>
                                <td>
                                    <select id="sendOption" class="form-control" style=" width: 100px;" name="sendType">
                                        <option value="reply"><?= controllers::t('menu', 'Reply'); ?></option>
                                        <option value="forward"><?= controllers::t('menu', 'For word'); ?></option>
                                    </select>
                                </td>
                                <td style="padding-left:10px;">
                                    <div id="replyTo">
                                        <?= controllers::t('menu', 'To') . ": <b>"
                                        . $model_document->outbox->user->prefix_th . $model_document->outbox->user->fname .
                                        " " . $model_document->outbox->user->lname .
                                        "</b>" ?>
                                    </div>
                                    <div id="forwadTo" style="display: none">
                                        <input type="text" class="col-xs-12" placeholder="ระบุคนที่ต้องการส่งถึง"
                                               list="forward-name"
                                               id="keyword-forward" autocomplete="off"
                                               onkeyup="send(event)" style="width: 500px;">
                                        <datalist id="forward-name"></datalist>
                                    </div>
                                </td>

                            </tr>
                        </table>
                        <div id="receiver" style="margin: 20px"></div>
                        <textarea rows="5" class="form-control" placeholder="พิมพ์ข้อความตอบกลับ"
                                  name="comment" id="content"></textarea>
                        <input type="hidden" name="inbox_id" value="<?= $_GET['id'] ?>" id="inbox_id">
                        <input type="hidden" name="page" value="readMail">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>"
                               value="<?= Yii::$app->request->csrfToken; ?>"/>
                </div>
                <span style="display: none; color: red" id="comment-error">ข้อความจะต้องไม่ว่าง !</span>
                <br>
                <button type="button" style="width:100%;"
                        class="btn btn-3d btn-success" id="submit"><?= controllers::t('menu', 'Send'); ?>
                </button>
                <br><br>
                </form>
                <?php
            }

        } else if ($model_document->doc->check->check_id == 3 && !$model_document->doc->cmsDeleteRolls) { //need to approve
            //TODO edit to correct permission siratpat=>8348, wachi=>108955, somjit=>102298
            $leader = EofficeCentralViewPisUser::findOne(Yii::$app->user->identity->id);
            if($leader->person->boardDirector){
            if ($leader->person->boardDirector->position_name == "หัวหน้าภาควิชาวิทยาการคอมพิวเตอร์" &&
            $leader->person->boardDirector->period_describe == "สมัยปัจจุบัน") {

            //if(Yii::$app->user->identity->username == "108955") {
                    //if current user is LEADER
                    ?>
                    <form method="POST" id="mailApproveForm">
                        <div class="table-responsive">
                            <table style="margin-bottom: 10px">
                                <tr>
                                    <td>
                                        <select id="sendApproveOption" class="form-control" style=" width: 100px;"
                                                name="sendType">
                                            <option value="approve"><?= controllers::t('menu', 'Approve'); ?></option>
                                            <option value="reject"><?= controllers::t('menu', 'Reject'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <textarea rows="5" class="form-control" placeholder="พิมพ์ข้อความ....."
                                      name="comment" id="content"></textarea>
                            <input type="hidden" name="inbox_id" value="<?= $_GET['id'] ?>" id="inbox_id">
                            <input type="hidden" name="page" value="readMail" id="inbox_id">
                            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>"
                                   value="<?= Yii::$app->request->csrfToken; ?>"/>
                        </div>
                        <br>
                        <button type="button" style="width:100%;"
                                class="btn btn-3d btn-success" id="submitApprove"><?= controllers::t('menu', 'Send'); ?>
                        </button>
                    </form>
                    <?php
                }
            }
        }
        ?>
    </div>

    <?php
}
if(Yii::$app->controller->action->id != "read-mail"):
?>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- header modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- body modal -->
            <div class="modal-body">
                <table class="table">
                    <?php
                    echo '';
                    echo '<tr><td>' . controllers::t('menu', 'From') . ': </td><td>'
                        . $model_document->user->prefix_th . $model_document->user->fname . " " . $model_document->user->lname . "</td></tr>";
                    echo '<td>' . controllers::t('menu', 'To') . ': </td><td>';
                    foreach ($model_document->cmsInboxes as $index => $receivers) {
                        echo $receivers->user->prefix_th . $receivers->user->fname . " " . $receivers->user->lname . " ";
                    }
                    echo "</td></tr><td>" . controllers::t('menu', 'Date') . ': </td><td>' . controllers::DateThaiForMail($model_document->outbox_time) . "</td></tr>";
                    echo '<td>' . controllers::t('menu', 'Subject') . ': </td><td>' . $model_document->doc->doc_subject . '</td>';
                    echo '</tr>';
                    ?>
                </table>

            </div>

        </div>
    </div>
</div>
<?php
endif;
?>