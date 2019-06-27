<?php

use yii\helpers\Html;
use \app\modules\correspondence\controllers;

$this->title = Html::encode($this->title) . 'จดหมายขยะ';

?>
<section class="content">
    <div class="content-wrapper">
        <div class="row">
            <!-- Menu mail  -->
            <!-- /.col -->
            <div class="col-md-12">
                <div class="box box-primary" style="overflow: inherit">
                    <!-- Mail Header -->
                    <?= $this->render('mail_header', ['model_label' => $model_label, 'pages' => $pages,
                        'searchData' => $searchData]) ?>
                    <!-- /.Mail Header -->
                    <div class="table-responsive mailbox-messages">
                        <!-- Mail Body -->

                        <?php
                        echo \yii\grid\GridView::widget([
                            'dataProvider' => $dataProvider,
                            'tableOptions' => [
                                'class' => 'table table-hover',
                                'style' => 'margin-top: 5px; margin-bottom: 5px;',
                                'width' => '100%',
                                'cellspacing' => '0'
                            ],
                            'rowOptions' => function ($model) {
                                if ($model instanceof \app\modules\correspondence\models\CmsInbox) {
                                    // it's Inbox
                                    if($model->inbox_status == "unread")
                                    return ['style' => 'background-color: #F2EDED'];
                                } else if ($model instanceof \app\modules\correspondence\models\CmsOutbox) {
                                    // it's Outbox
                                    if ( ($model->outbox_status == "sent" || !is_null($model->outbox_status)))
                                    return ['style' => 'background-color: #FFF'];
                                }
                            },
                            'columns' => $gridColumns,
                        ]);
                        ?> <!-- /.Mail Body -->
                    </div> <!-- /.mail-box-messages -->

                    </form>
                </div> <!-- /.box-primary -->
                <br>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /. content -->
</section>

<?= $this->render('label_form') ?>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<?php
/** @var TYPE_NAME $docid */
$this->registerJs(<<<JS
 $("#w0").children("ul").detach();
    $(".summary").detach().appendTo('#new-search-area');
    $('thead').detach();
    //$('.not-set').parents('tr').css('display','none');
    //$('.not-set').parents('tr').detach();
    //console.log($(".mailbox-name").text());
    // if($(".mailbox-name").text()==""){
    //     console.log($(".mailbox-name").text());
    //     $('.grid-view').html("<div style='color: black'>ไม่มีผลลัพธ์</div>");
    // }
JS
);
?>

