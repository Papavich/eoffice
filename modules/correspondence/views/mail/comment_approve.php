<?php
use app\modules\correspondence\controllers;
?>
<?php \yii\widgets\Pjax::begin(["id"=>"comment-container"]); ?>
<article class="row margin-top-10 line-comment">
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
                        <?= controllers::DateThai($comments['approve_time']) ?>
                    </time>
                </header>
                <div class="comment-post">
                    <p>
                        <?= $comments['message_approve'] ?>
                    </p>
                </div>
                <!-- <p class="text-right "><a href="#" class="btn btn-success btn-sm"><i
                                 class="fa fa-reply"></i> ตอบกลับ</a></p>-->
            </div>
        </div>
    </div>
</article>