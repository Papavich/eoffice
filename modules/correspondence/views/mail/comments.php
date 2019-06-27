<?php
use app\modules\correspondence\controllers;
?>
<article class="row margin-top-10 line-comment" style="margin-bottom: 15px">
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
                            echo $outBoxName->user->prefix_th.$outBoxName->user->fname." ".$outBoxName->user->lname;
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
        <div class="pull-right comment-item" style="margin-bottom: 15px">
            <?php
            //check time for cancel message
            if ($comments['message_reply_time'] &&
            ($outBoxName->user->username == Yii::$app->user->identity->username) &&
                substr($comments['message_reply_time'],0,10) == date('Y-m-d') ) {
                date_default_timezone_set('Asia/Bangkok');
                $date1 = new \DateTime(date('Y-m-d  H:i:s', strtotime($comments['message_reply_time'])));
                $date2 = new \DateTime(date('Y-m-d  H:i:s', strtotime(date('Y-m-d H:i:s'))));
               if ($date1->diff($date2)->i <= 1)
                {
                    ?>
                    <input type="hidden" class="comment-dateTime"  data-content="<?=date('Y-m-d H:i:s')?>"
                           id="<?= $comments['message_reply_time'] ?>" value="<?= $comments['inbox_id'] ?>">
                    <a href="#bottom"
                       class="undoSend" onclick="redirectId('<?= $comments['inbox_id'] ?>',
                            '<?= $_GET['id'] ?>')" id="<?= $comments['inbox_id'] ?>"
                       style="display: none">
                        <?=controllers::t('menu','Unsend')?>
                    </a>
                <?php
                }
            }
            ?>

        </div>
    </div>
</article>
