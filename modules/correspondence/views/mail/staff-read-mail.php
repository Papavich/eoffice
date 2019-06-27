<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\modules\correspondence\controllers;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Html::encode($this->title) . 'รายละเอียดข้อความ';
?>
<section id="middle" style="padding: 0px 5px 0px 5px">
    <div style="margin-top: 2%;">
        <!-- Menu mail  -->
        <?php
        /*        include "menumail.php";
                */ ?>
        <div class="col-md-12">
            <div class="box box-primary" style="color: black">
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h3 style="color: black"><?= $model_outbox->doc->doc_subject ?></h3>
                        <h5 style="color: black">จาก: <?= $model_outbox->user->username ?>
                            <span class="mailbox-read-time">
                                <?php
                                foreach ($model_outbox->cmsInboxes as $inbox) {
                                    echo controllers::DateThai($inbox['inbox_time']);
                                }
                                ?>
                            </span></h5>
                    </div>
                    <!-- /.mailbox-read-info -->
<!--                    <div class="mailbox-controls with-border">-->
<!--                        <div class="btn-group">-->
<!--                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip"-->
<!--                                    data-container="body" title="Delete">-->
<!--                                <i class="fa fa-trash-o"></i></button>-->
<!--                            --><?php ////ถ้าเอกสารไม่ถูกยกเลิก
//                            if ($model_outbox->doc->check->check_id == 1) {
//                                echo '<button type="button" class="btn btn-default btn-sm" data-toggle="modal"
//                                    data-target="#ReplyModal"
//                                    data-whatever="@mdo" id="modal" title="Reply">
//                                <i class="fa fa-reply"></i></button>
//                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
//                                    data-target="#ForwardModal"
//                                    data-whatever="@mdo" id="modal2" title="Forward">
//                                <i class="fa fa-share"></i></button>';
//                            }
//                            ?>
<!---->
<!--                        </div>-->
<!--                        <!-- /.btn-group -->
<!--                    </div>-->
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        <!-- Detail document -->
                        <?= $this->render('detail_document_outbox', [
                            'model_outbox' => $model_outbox, 'inbox_reply' => $inbox_reply
                        ]) ?>
                        <!-- /.Detail document -->
                        <?php
                        if (\Yii::$app->authManager->isAdmin() || \Yii::$app->authManager->isStaffGeneral()) { ?>
                            <p class='inbox_status'><b><?=controllers::t('menu','Send to')?> : </b> <br>
                                <?php
                                $count = 0;
                                foreach ($receiver as $rows) {
                                    if (count($receiver) >= 2 && $count <= 1) {
                                        echo "<a href='#ReceiverModal' data-toggle='modal' data-whatever='@mdo'>";
                                        echo $rows->user->username . " ";
                                        //break;
                                    } else if ($count > 2) {
                                        echo " ".controllers::t('menu','and others');
                                        break;
                                    } else if (count($receiver) == 1) {
                                        echo $rows->user->username . " &nbsp สถานะ : <span >" .
                                            $rows['inbox_status']
                                            . "</span><br>";
                                    }
                                    $count++;
                                }
                                echo "</a>";

                                ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
                        <br> <br> <br> <br>
                        <?php if ($model_outbox->doc->check->check_id != 2) { ?>
                        <div class="row padding-50" align="center">
                            <h1 class="page-header comment">Comments</h1>
                            <section class="comment-list">
                                <!-- Comment -->
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
                                                                    echo $outBoxName->user->username;
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
                </div>
                <!-- /.box-body -->

                <!-- /.box-footer -->
                <div class="box-footer">
                    <?php
                    if (\Yii::$app->authManager->isAdmin() || \Yii::$app->authManager->isStaffGeneral()) {
                        ?>
                        <form action="reply-mail?id=<?= $_GET['id'] ?>" method="POST">
                            <div class="table-responsive">
                                <table class="table nomargin">
                                    <tr>
                                        <td>
                                            <select>
                                                <option><?= controllers::t('menu', 'Reply'); ?></option>
                                                <option><?= controllers::t('menu', 'For word'); ?></option>
                                            </select>
                                        </td>

                                    </tr>
                                </table>
                                <textarea rows="5" class="form-control" placeholder="พิมพ์ข้อความตอบกลับ"
                                          name="comment"></textarea>
                                <input type="hidden" name="inbox_id" value="<?= $_GET['id'] ?>">
                                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>"
                                       value="<?= Yii::$app->request->csrfToken; ?>"/>
                            </div>
                            <div class="pull-right">
                                <button type="submit"
                                        class="btn btn-3d btn-success"><?= controllers::t('menu', 'Send'); ?></button>
                            </div>
                        </form>
                        <?php
                    }
                    ?>

                    <?php } ?>

                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>

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
                            <?php
                            $read = 0;
                            foreach ($receiver as $rows) {
                                if ($rows['inbox_status'] == "read") {
                                    echo "<b>" . $rows->user->username . "</b><br>";
                                } else {
                                    $read++;
                                }
                            }
                            if (count($receiver) == $read) {
                                echo "'.controller::t('menu','No user has read').'";
                            }
                            ?>
                        </div><!-- /TAB 1 CONTENT -->
                        <div id="ttab2_nobg" class="tab-pane"><!-- TAB 2 CONTENT -->
                            <?php
                            $read = 0;
                            foreach ($receiver as $rows) {
                                if ($rows['inbox_status'] == "unread") {
                                    echo "<b>" . $rows->user->username . "</b><br>";
                                }
                            }
                            if (count($receiver) == $read) {
                                echo "controller::t('menu','All users have read')";
                            }
                            ?>
                        </div><!-- /TAB 2 CONTENT -->
                    </div>
                    <!-- /tabs content -->

                </div>
                <!-- /panel content -->
            </div>
        </div>
    </div>
</div>
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
<!--
 <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ReplyModal"
                                data-whatever="@mdo" id="modal"><i class="fa fa-reply"></i> ตอบกลับ
                        </button>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ForwardModal"
                                data-whatever="@mdo" id="modal2"><i class="fa fa-share"></i> ส่งต่อ
                        </button>
<article class="row margin-top-10">
      <div class="col-md-2 col-sm-2 hidden-xs">
          <figure class="thumbnail">
              <img class="img-responsive"
                   src="http://www.iconsfind.com/wp-content/uploads/2016/10/20161014_58006bf8f1610.png"
                   width="100"/>
              <figcaption class="text-center">ผศ.สันติ ทินตะนัย</figcaption>
          </figure>
      </div>
      <div class="col-md-10 col-sm-10">
          <div class="panel panel-default arrow left">
              <div class="panel-body">
                  <header class="text-left">
                      <div class="comment-user"><i class="fa fa-user"></i> ผศ.สันติ
                          ทินตะนัย
                      </div>
                      <time class="comment-date" datetime="16-12-2014 01:05"><i
                                  class="fa fa-clock-o"></i>
                          15 กันยายน 2560 01:05
                      </time>
                  </header>
                  <div class="comment-post">
                      <p>
                          กรุณาตอบกลับด่วนที่สุด
                      </p>
                  </div>
                  <p class="text-right "><a href="#" class="btn btn-success btn-sm"><i
                                   class="fa fa-reply"></i> ตอบกลับ</a></p>
              </div>
          </div>
      </div>
  </article>
-->
<!--  <div style="border: 2px dashed #c7254e; margin: 0 0 2% 10%"></div>

  <article class="row">
      <div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-0 hidden-xs">
          <figure class="thumbnail">
              <img class="img-responsive"
                   src="http://www.iconsfind.com/wp-content/uploads/2016/10/20161014_58006bf8f1610.png"
                   width="100"/>
              <figcaption class="text-center">อาจารย์วชิราวุธ ธรรมวิเศษ</figcaption>
          </figure>
      </div>
      <div class="col-md-9 col-sm-9">
          <div class="panel panel-default arrow left">

              <div class="panel-body">
                  <header class="text-left">
                      <div class="comment-user"><i class="fa fa-user"></i> อาจารย์วชิราวุธ
                          ธรรมวิเศษ
                      </div>
                      <time class="comment-date" datetime="16-12-2014 01:05"><i
                                  class="fa fa-clock-o"></i> 15 กันยายน 2560 01:05
                      </time>
                  </header>
                  <div class="comment-post">
                      <p>
                          รับทราบ
                      </p>
                  </div>
              </div>
          </div>
      </div>
  </article>

  <div style="border: 2px dashed #c7254e; margin: 0 0 2% 10%"></div>

  <article class="row">
      <div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-0 hidden-xs">
          <figure class="thumbnail">
              <img class="img-responsive"
                   src="http://www.iconsfind.com/wp-content/uploads/2016/10/20161014_58006bf8f1610.png"
                   width="100"/>
              <figcaption class="text-center">ผศ.ดร.ธีระยุทธ ทองเครือ</figcaption>
          </figure>
      </div>
      <div class="col-md-9 col-sm-9">
          <div class="panel panel-default arrow left">

              <div class="panel-body">
                  <header class="text-left">
                      <div class="comment-user"><i class="fa fa-user"></i>
                          ผศ.ดร.ธีระยุทธ ทองเครือ
                      </div>
                      <time class="comment-date" datetime="16-12-2014 01:05"><i
                                  class="fa fa-clock-o"></i> 15 กันยายน 2560 01:05
                      </time>
                  </header>
                  <div class="comment-post">
                      <p>
                          รับทราบ
                      </p>
                  </div>
              </div>
          </div>
      </div>
  </article>-->

<!--<div style="border: 2px solid grey; margin: 0 0 1% 0"></div>-->
