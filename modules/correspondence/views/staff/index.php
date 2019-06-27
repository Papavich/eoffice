<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\correspondence\controllers;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Html::encode($this->title) . 'กระดานข้อความใหม่ประจำวัน';
\Yii::setAlias('@webword', '@web/../modules/correspondence');
$this->registerCss("
div.subnotficationsize {
  display: block;
  color: black;
}
div.subnotficationsize:hover {
  cursor: pointer;
}
.read-inbox{
  background-color: white !important;
}
#snackbar.show {
    visibility: visible;
    position:relative;
    top:10px;
}
#snackbar {
    visibility: hidden;
    position:absolute;
    top: -100px;
    }
");

?>

    <section id="middle" style="padding: 20px">
        <?php

        if ($num == 1) {
            ?>
            <div id="snackbar">
                <div class="alert alert-block alert-danger"
                     style="text-align: center;"><!-- SUCCESS -->
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <a href="delete-roll">
                        <?= controllers::t('menu', 'You have to destroy documents') ?>
                        <?= $count ?>  <?= controllers::t('menu', 'File') ?>
                    </a>
                </div>
            </div>
            <?php
        } ?>
        <script>
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 4000);
        </script>
        <div id="content" class="nopadding-top nopadding-bottom padding-50">

            <div id="panel-1" class="panel panel-default">
                <!-- BOXES -->
                <div class="col-md-1" style="width: 13%">

                </div>
                <div class="row">
                    <!-- Online Box -->
                    <div class="col-md-3 col-sm-6">

                        <!-- BOX -->
                        <div class="box success"><!-- default, danger, warning, info, success -->
                            <div class="box-title"><!-- add .noborder class if box-body is removed -->
                                <h3>
                                    <?php
                                    $model = \app\modules\correspondence\models\CmsDocument::find();
                                    $countQuery = clone $model;
                                    echo $countQuery->count();
                                    ?>
                                    <?= controllers::t('menu', 'All books') ?></h3>
                                <i class="fa fa-globe"></i>
                            </div>
                        </div>
                        <!-- /BOX -->

                    </div>
                    <!-- Profit Box -->
                    <div class="col-md-3 col-sm-6">
                        <!-- BOX -->
                        <div class="box warning"><!-- default, danger, warning, info, success -->
                            <div class="box-title"><!-- add .noborder class if box-body is removed -->
                                <h3>
                                    <?php
                                    $model = \app\modules\correspondence\models\CmsDocRollReceive::find();
                                    $countQuery = clone $model;
                                    echo $countQuery->count();
                                    ?>
                                    <?= controllers::t('menu', 'Received books') ?></h3>
                                <i class="fa fa-book"></i>
                            </div>
                        </div>
                        <!-- /BOX -->
                    </div>
                    <!-- Feedback Box -->
                    <div class="col-md-3 col-sm-6">
                        <!-- BOX -->
                        <div class="box danger"><!-- default, danger, warning, info, success -->
                            <div class="box-title"><!-- add .noborder class if box-body is removed -->
                                <h3>
                                    <?php
                                    $model = \app\modules\correspondence\models\CmsDocRollSend::find();
                                    $countQuery = clone $model;
                                    echo $countQuery->count();
                                    ?>
                                    <?= controllers::t('menu', 'Sent books') ?></h3>
                                <i class="fa fa-send"></i>
                            </div>
                        </div>
                        <!-- /BOX -->
                    </div>
                </div>
                <!-- /BOXES -->
                <div class="row">
                    <div class="col-md-12">
                        <div id="panel-3" class="panel panel-default">
                            <div class="panel-heading">
									<span class="title elipsis">
										<strong><?= controllers::t('menu', 'Reply today') ?></strong>
                                        <!-- panel title -->
									</span>
                            </div>
                            <!-- panel content -->
                            <div class="panel-body">

                                <ul class="list-unstyled list-hover slimscroll height-250"
                                    data-slimscroll-visible="true">
                                    <?php
                                    if ($model_doc) {
                                        foreach ($model_doc as $rows) {
                                            $speed = $rows->doc->speed->speed_id;
                                            $secret = $rows->doc->secret->secret_id;
                                            $status = $rows->outbox->outbox_status;
                                            $class = "";
                                            if ($status) {
                                                $class = "read-inbox";
                                            }
                                            if ($rows->outbox->outbox_trash == 0 && $rows['inbox_trash'] == 0) {
                                                ?>
                                                <li class="<?= $class ?>" style=" border-bottom-style: solid;">
                                                    <div class="col-xs-1 hidden-xs"
                                                         style="margin-right: 0; padding-right: 0; ">
                                                        <img class="img-responsive"
                                                             style="width: 60%;"
                                                             alt="picture"
                                                             src="https://openclipart.org/image/2400px/svg_to_png/202776/pawn.png"
                                                        />
                                                        <!-- src="https://openclipart.org/image/2400px/svg_to_png/202776/pawn.png"
                                                        https://sc5.kku.ac.th/sciIT/doc/2016-May-27-090538.jpg
                                                        border-radius: 10%;
                                                        -->
                                                    </div>
                                                    <?= Html::a('    
                                            <div class="row notficationsize"  style="margin-left: 0;">
                                                <div class="col-md-10 col-sm-10 col-xs-10" style=" padding-left: 0">
                                                <p style="display: inline; line-height: 45px;">
                                                <b>' .
                                                        $rows->outbox->user->prefix_th . $rows->outbox->user->fname . " " . $rows->outbox->user->lname
                                                . '</b>'
                                                .controllers::t('menu','Replied').'<b>"' . $rows->doc->doc_subject . '"</b>  '.
                                                controllers::t('menu','To you when')
                                                .' ' . controllers::DateThaiForMail($rows['inbox_time']) . '
                                                </p>
                                                </div>
                                                
                                            </div>
                                     ', ['mail/read-reply-mail?id=' . $rows->outbox->outbox_id], ['style' => 'color: black', 'class' => 'subnotficationsize']) ?>
                                                </li>
                                                <?php
                                            }
                                        }
                                    } else {
                                        echo "ไม่มีจดหมายถึงคุณ";
                                    }
                                    ?>

                                </ul>
                                <!-- หมายเหตุ -->
                                <hr>
                                <!--                            <div class="row" style="font-size: 13px;">-->
                                <!---->
                                <!--                                <div class="col-md-2">-->
                                <!--                                    <img src="-->
                                <? //= Yii::getAlias('@web/../modules/correspondence/style') ?><!--/images/express1.png"-->
                                <!--                                         width="35px" height="35px"-->
                                <!--                                    />-->
                                <!--                                    ด่วน-->
                                <!--                                </div>-->
                                <!--                                <div class="col-md-2">-->
                                <!--                                    <img src="-->
                                <? //= Yii::getAlias('@web/../modules/correspondence/style') ?><!--/images/express2.png"-->
                                <!--                                         width="35px" height="35px"-->
                                <!--                                    />-->
                                <!--                                    ด่วนมาก-->
                                <!--                                </div>-->
                                <!--                                <div class="col-md-2">-->
                                <!--                                    <img src="-->
                                <? //= Yii::getAlias('@web/../modules/correspondence/style') ?><!--/images/express3.png"-->
                                <!--                                         width="35px" height="35px"-->
                                <!--                                    />-->
                                <!--                                    ด่วนที่สุด-->
                                <!--                                </div>-->
                                <!--                                <div class="col-md-2">-->
                                <!--                                    <img src="-->
                                <? //= Yii::getAlias('@web/../modules/correspondence/style') ?><!--/images/secret1.png"-->
                                <!--                                         width="35px" height="35px"-->
                                <!--                                    />-->
                                <!--                                    ลับ-->
                                <!--                                </div>-->
                                <!--                                <div class="col-md-2">-->
                                <!--                                    <img src="-->
                                <? //= Yii::getAlias('@web/../modules/correspondence/style') ?><!--/images/secret2.png"-->
                                <!--                                         width="35px" height="35px"-->
                                <!--                                    />-->
                                <!--                                    ลับมาก-->
                                <!--                                </div>-->
                                <!--                                <div class="col-md-2">-->
                                <!--                                    <img src="-->
                                <? //= Yii::getAlias('@web/../modules/correspondence/style') ?><!--/images/secret3.png"-->
                                <!--                                         width="35px" height="35px"-->
                                <!--                                    />-->
                                <!--                                    ลับที่สุด-->
                                <!--                                </div>-->
                                <!---->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!-- /panel content -->

                            </div>
                            <!-- /PANEL -->

                        </div>
                        <div class="col-md-12" style="padding: 0; margin: 0">
                            <div id="panel-3" class="panel panel-default">
                                <div class="panel-heading">
									<span class="title elipsis">
										<strong><?= controllers::t('menu', 'Form letter') ?></strong>
                                        <!-- panel title -->
									</span>
                                </div>
                                <!-- panel content -->
                                <div class="panel-body">
                                    <div class="col-md-4">
                                        <?= Html::a('    
                                    <div class="row notficationsize">
                                        <img src="' . Yii::getAlias('@web/../modules/correspondence/style') . '/images/doc_icon.PNG" width="35px" height="35px"
                                />
                                        แบบฟอร์มหนังสือภายใน
                                    </div>
                                     ', \yii\helpers\Url::to(Yii::getAlias('@webword') . '/doc_tem/docinform.doc'), ['style' => 'color: black', 'target' => '_blank', 'class' => 'subnotficationsize']); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= Html::a('    
                                    <div class="row notficationsize">
                                        <img src="' . Yii::getAlias('@web/../modules/correspondence/style') . '/images/doc_icon.PNG" width="35px" height="35px"
                                />
                                        แบบฟอร์มหนังสือภายนอก
                                    </div>
                                     ', \yii\helpers\Url::to(Yii::getAlias('@webword') . '/doc_tem/docoutform.doc'), ['style' => 'color: black', 'target' => '_blank', 'class' => 'subnotficationsize']); ?>
                                    </div>
                                </div>
                                <!-- /panel content -->

                            </div>
                            <!-- /PANEL -->

                        </div>
                    </div>

                </div>

    </section>


<?php
/*$this->registerJsFile("../style/assets/plugins/bootstrap/js/bootstrap.min.js", [
]);


*/ ?>
<?php

$this->registerJs(<<<JS


JS
);
?>