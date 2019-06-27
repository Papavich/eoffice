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
<?php \yii\widgets\Pjax::begin(["id"=>"pjax-container",'linkSelector' => 'a:not(.linksWithTarget)']); ?>
<section id="middle" style="padding: 0px 5px 0px 5px">
    <div style="margin-top: 2%;">
        <!-- Menu mail  -->
        <div class="col-md-12">
            <div class="box box-primary" style="color: black">
                <div class="box-tools pull-right">
                    <br>
                    <?php
                    if(isset($newer)&& $newer!=""){
                        echo Html::a(' <i class="fa fa-chevron-left"></i>', ['mail/read-mail?id=' . $newer]
                            ,['class'=>'btn btn-default btn-sm','title'=>controllers::t('menu','Previous')]);
                    }else{
                        echo '<button type="button" class="btn btn-default btn-sm disabled">
                                <i class="fa fa-chevron-left"></i>
                              </button>';
                    }
                    if(isset($older)&& $older!=""){
                        echo Html::a(' <i class="fa fa-chevron-right"></i>', ['mail/read-mail?id=' . $older]
                            ,['class'=>'btn btn-default btn-sm','title'=>controllers::t('menu','Next')]);
                    }else{
                        echo '<button type="button" class="btn btn-default btn-sm disabled">
                                <i class="fa fa-chevron-right"></i>
                              </button>';
                    }
                    ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h3 style="color: black"><?= $model_document->doc->doc_subject ?></h3>
                            <?=controllers::t('menu', 'From').' '.$model_document->outbox->user->prefix_th.$model_document->outbox->user->fname." ".$model_document->outbox->user->lname?>
                            <span class="mailbox-read-time"><?= controllers::DateThai($model_document->inbox_time) ?></span></h5>
                    </div>
                    <div class="mailbox-read-message">
                        <!-- Detail document -->
                        <?= $this->render('detail_document', [
                            'model_document' => $model_document,'inbox_reply'=>$inbox_reply, 'receiver' => $receiver
                        ]) ?>
                        <!-- /.Detail document -->
                    </div>
                </div>
                        <!-- Comment -->
                        <?= $this->render('main_comment', [
                            'model_inbox' => $model_document,'inbox_reply'=>$inbox_reply
                            ,  'pages' => $pages,'model_document' => $model_document
                        ]) ?>
                        <!-- /.Comment -->
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->

</section>

<!-- List receiver modal -->
<?=$this->render('receiver-modal',['receiver'=>$receiver])?>
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
<?php \yii\widgets\Pjax::end() ?>
