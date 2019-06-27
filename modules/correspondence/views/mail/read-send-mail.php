<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\correspondence\controllers;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Html::encode($this->title) . 'รายละเอียดข้อความ';
$this->registerJsFile('@web/../modules/correspondence/style/js/mail-input.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
if(!\Yii::$app->authManager->isAdmin() && !\Yii::$app->authManager->isStaffGeneral())
$this->registerJsFile('@web/../modules/correspondence/style/js/mail.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<?php \yii\widgets\Pjax::begin(["id" => "pjax-container", 'linkSelector' => 'a:not(.linksWithTarget)']); ?>
    <section id="middle" style="padding: 0px 5px 0px 5px">
        <div style="margin-top: 2%;">
            <!-- Menu mail  -->
            <div class="col-md-12">
                <div class="box box-primary" style="color: black">
                    <div class="box-tools pull-right">
                        <br>
                        <?php
                        if (!\Yii::$app->authManager->isAdmin() && !\Yii::$app->authManager->isStaffGeneral()) {
                            if (isset($newerOfSendMail) && $newerOfSendMail != "") {
                                echo Html::a(' <i class="fa fa-chevron-left"></i>', ['mail/read-send-mail?id=' . $newerOfSendMail]
                                    , ['class' => 'btn btn-default btn-sm','title'=>controllers::t('menu','Previous')]);
                            } else {
                                echo '<button type="button" class="btn btn-default btn-sm disabled">
                                <i class="fa fa-chevron-left"></i>
                              </button>';
                            }
                            if (isset($olderOfSendMail) && $olderOfSendMail != "") {
                                echo Html::a(' <i class="fa fa-chevron-right"></i>', ['mail/read-send-mail?id=' . $olderOfSendMail]
                                    , ['class' => 'btn btn-default btn-sm','title'=>controllers::t('menu','Next')]);
                            } else {
                                echo '<button type="button" class="btn btn-default btn-sm disabled">
                                <i class="fa fa-chevron-right"></i>
                              </button>';
                            }
                        } else {
                            if (Yii::$app->controller->action->id != "read-send-mail") {
                                if (isset($newer) && $newer != "") {
                                    echo Html::a('<i class="fa fa-chevron-left"></i>', ['mail/read-reply-mail?id=' . $newer]
                                        , ['class' => 'btn btn-default btn-sm','title'=>controllers::t('menu','Previous')]);
                                } else {
                                    echo '<button type="button" class="btn btn-default btn-sm disabled">
                                <i class="fa fa-chevron-left"></i>
                              </button>';
                                }
                                if (isset($older) && $older != "") {
                                    echo Html::a('<i class="fa fa-chevron-right"></i>', ['mail/read-reply-mail?id=' . $older]
                                        , ['class' => 'btn btn-default btn-sm','title'=>controllers::t('menu','Next')]);
                                } else {
                                    echo '<button type="button" class="btn btn-default btn-sm disabled">
                                <i class="fa fa-chevron-right"></i>
                              </button>';
                                }
                            } else {
                                if (isset($newerOfSendMail) && $newerOfSendMail != "") {
                                    echo Html::a('<i class="fa fa-chevron-left"></i>', ['mail/read-send-mail?id=' . $newerOfSendMail]
                                        , ['class' => 'btn btn-default btn-sm','title'=>controllers::t('menu','Previous')]);
                                } else {
                                    echo '<button type="button" class="btn btn-default btn-sm disabled">
                                <i class="fa fa-chevron-left"></i>
                              </button>';
                                }
                                if (isset($olderOfSendMail) && $olderOfSendMail != "") {
                                    echo Html::a('<i class="fa fa-chevron-right"></i>', ['mail/read-send-mail?id=' . $olderOfSendMail]
                                        , ['class' => 'btn btn-default btn-sm','title'=>controllers::t('menu','Next')]);
                                } else {
                                    echo '<button type="button" class="btn btn-default btn-sm disabled">
                                <i class="fa fa-chevron-right"></i>
                              </button>';
                                }
                            }
                        }
                        ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-read-info">
                            <h3 style="color: black"><?= $model_document->doc->doc_subject ?></h3>
                            <h5 style="color: black"><?= controllers::t('menu', 'To') ?>: <?php
                                foreach ($model_document->cmsInboxes as $index => $receivers) {
                                    if (count($model_document->cmsInboxes) > 1 && $index > 0) {
                                        echo $receivers->user->prefix_th . $receivers->user->fname . " " . $receivers->user->lname
                                            . " " . controllers::t('menu', 'and others');
                                        echo "<button  type='button' id='show-details-receiver' data-toggle='modal' data-target='.bs-example-modal-lg'>
                                                        <i class='glyphicon glyphicon-collapse-down' style='margin-left: 2px' title='" . controllers::t('menu', 'Show details') . "'></i>
                                                      </button>";
                                        break;
                                    } else if (count($model_document->cmsInboxes) == 1 && $index == 0) {
                                        echo $receivers->user->prefix_th . $receivers->user->fname . " " . $receivers->user->lname;
                                    }
                                }

                                ?>
                                <span class="mailbox-read-time"><?= controllers::DateThai($model_document->outbox_time) ?></span>
                            </h5>
                        </div>
                        <!-- /.mailbox-read-info -->
                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message">
                            <!-- Detail document -->
                            <?= $this->render('detail_document', [
                                'model_document' => $model_document, 'inbox_reply' => $inbox_reply, 'receiver' => $receiver
                            ]) ?>

                            <!-- /.Detail document -->
                        </div>
                    </div>
                    <div class="row padding-50" style="text-align: center">
                        <h1 class="page-header comment">Comments</h1>
                        <section class="comment-list" style="margin-bottom: 10px" id="comments-container">
                            <!-- Comment -->
                            <?php foreach ($inbox_reply as $comments) {

                                if ($comments['message_reply']) {
                                    ?>
                                    <?= $this->render('comments', ['comments' => $comments]) ?>

                                <?php } elseif ($comments['message_approve']) { ?>
                                    <?= $this->render('comment_approve', ['comments' => $comments]) ?>

                                    <?php
                                }
                            }
                            ?>

                            <span id="textCancel" style="display: none">
                            <?= ($inbox_reply ? controllers::t('menu','** Can be canceled within 1 minute (except for approval)')
                                : '');
                            ?>
                            </span>
                        </section>
                        <div style="border: 2px solid grey; margin-bottom: 1%; margin-top: 10px;"></div>
                        <?php
                        // display pagination
                        echo \yii\widgets\LinkPager::widget([
                            'pagination' => $pages,
                        ]);
                        ?>
                    </div>
                </div>
                <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <?= $this->render('form_comment', ['model_document' => $model_document, 'inbox' => false]) ?>

        </div>
        <!-- /.box-footer -->
        </div>
        <!-- /. box -->
        </div>
        <!-- /.col -->
        </div>
    </section>
<?php
if(!\Yii::$app->authManager->isAdmin() && !\Yii::$app->authManager->isStaffGeneral())
{
/** @var TYPE_NAME $docid */
$this->registerJs(<<<JS

// when the DOM is ready        
$(document).ready(function() {
  initializePlugins();
  initializeForwardAndReply();
});

JS
    );
}

?>
    <br><br>
    <!-- List receiver modal -->
<?= $this->render('receiver-modal', ['receiver' => $receiver]) ?>
    <!-- show username sent mail  modal -->
    <div class="modal fade" id="SentMailModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="panel-ui-tan-l1" class="panel panel-default">

                    <div class="panel-heading">
									<span class="elipsis"><!-- panel title -->
                                      <b><?= controllers::t('menu', 'List of recipients') ?></b> <!-- panel title -->
									</span>
                    </div>
                </div>
                <div class="">
                    <!-- panel content -->
                    <div class="modal-body panel-body padding-20" style="margin: 0px">
                        <?php
                        foreach ($model_document->cmsInboxes as $rows) {
                            echo "<b>" .
                                $rows->user->prefix_th . $rows->user->fname . " " . $rows->user->lname
                                . "</b><br>";
                        }
                        ?>
                    </div>
                    <!-- /panel content -->
                </div>
            </div>
        </div>
    </div>
    <script>
        var xmlHttp;
        var message, inbox;

        function send(event) {
            xmlHttp = new XMLHttpRequest();
            var keyword = document.getElementById("keyword").value;

            if (event.keyCode == 13) {  // ��ҡ� Enter
                // document.location = "productDetail2.php?pname=" + keyword;

            } else if (event.keyCode != 40) {
                var url = "search-user?keyword=" + keyword;
                xmlHttp.open("GET", url);
                xmlHttp.onreadystatechange = showListDept;
                xmlHttp.send();
            }
        }

        function showListDept() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                document.getElementById("pname").innerHTML = xmlHttp.responseText;
            }
        }

        function redirectId(mes, ib) {
            message = mes.toString();
            inbox = ib.toString();

        }

    </script>
<?php
$this->registerJs(<<<JS
$('.inbox_status span').each(function(){
  if($(this).html() == 'unread'){
    $(this).css('color', 'red');
     console.log(span);
  }else{
      $(this).css('color', 'green');
  }
});   
    $("#compose-textarea").wysihtml5();
    $("#compose-textarea-forward").wysihtml5();
    $("#optionSend").hide();
    $("#message_content").click(function() {
    $("#optionSend").show();  
    });
 
JS
);
?>
<?php \yii\widgets\Pjax::end() ?>