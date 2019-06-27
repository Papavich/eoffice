<?php

use \yii\helpers\Html;
use app\modules\correspondence\controllers;
use yii\grid\GridView;
use \yii\timeago\TimeAgo;
$this->title = Html::encode($this->title) . 'รายการการส่งหนังสือทางอีเมล';

$this->registerCss("
table tbody tr td a {
  display: block;
  width: 100%;
   color: black;
}
tr.hover {
  cursor: pointer;
}
a:hover{
}
");
?>
    <section id="middle" style="padding: 0px 5px 0px 5px">
        <div style="margin-top: 2%;">
            <!-- Menu mail  -->
            <div class="col-md-12">
                <h3 style="margin-bottom: 0"><?=controllers::t('menu','Entries sent by email')?></h3>
                <br>
                <br>
                <br>
                <div class="box box-primary" style="color: black">
                    <div class="pull-right col-xs-4" id="new-search-area" style="margin-bottom: 15px">
                        <?php $form = \yii\widgets\ActiveForm::begin([
                            'action' => [Yii::$app->controller->action->id],
                            'method' => 'get',
                            'options' => [
                                'style' => 'margin: 0;'
                            ],
                        ]); ?>
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Search ..."
                                   value="<?php echo Yii::$app->request->get('keyword') ?>">
                            <span class="input-group-btn">
                <?= \yii\helpers\Html::submitButton('<i class="fa fa-lg fa-search"></i>'
                    , ['class' => 'btn btn-default',]) ?>
            </span>
                        </div><!-- /input-group -->
                        <input type="hidden" name="id" value="<?= Yii::$app->controller->action->id ?>">
                        <input type="hidden" name="search_by" value="searchBySubject">
                        <?php \yii\widgets\ActiveForm::end(); ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">

                        <?php
                        echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'tableOptions' => [
                                'class' => 'table table-striped table-hover table-bordered',
                                'width' => '100%',
                                'cellspacing' => '0'
                            ],
                            'columns' => [
                                [
                                    'header' => "<input type=\"checkbox\" class=\"group-checkable\"
                                                 data-set=\"#datatable_sample .checkboxes\"/>",
                                    'headerOptions' => ['class' => 'table-checkbox',],
                                    'contentOptions' => ['class' => 'group-checkable'],
                                    // 'name' => 'listQueue[]',
                                    'value' => function ($model, $key, $index, $column) {
                                        return $model['status'] == 0 ? "<input type='checkbox' name='listQueue[]'
                                               value='" . $model['cms_queue_id'] . "'>" : false;

                                    },
                                    'format' => 'raw'
                                ],
                                [
                                    'label' => controllers::t('menu', 'Subject'),
                                    'attribute' => 'outbox.doc.doc_subject',
                                    'contentOptions' => ['class' => 'center'],
                                    'value' => function ($model, $key, $index, $column) {
                                        return Html::a($model->outbox->doc->doc_subject,
                                            ['staff-receive/detail_book?id=' . $model->outbox->doc->doc_id,],
                                            ['target' => '_blank', 'class' => 'linksWithTarget'
                                                , 'title' => controllers::t('menu', 'See more')]);
                                    },
                                    'format' => 'raw'

                                ],
                                [
                                    'label' => controllers::t('menu', 'Receiver'),
                                    'contentOptions' => ['class' => 'center'],
                                    'attribute' => 'outbox.outbox_id',
                                    'value' => function ($model, $key, $index, $column) {
                                        foreach ($model->outbox->cmsInboxes as $items) {
                                            if (count($model->outbox->cmsInboxes) > 1) {
                                                return $items->user->prefix_th.$items->user->fname." ".$items->user->lname .
                                                    " ".controllers::t('menu','and others');
                                                break;
                                            } else {
                                                return $items->user->prefix_th.$items->user->fname." ".$items->user->lname;

                                            }
                                        }
                                    },
                                    'format' => 'raw'
                                ],
                                [
                                    'label' => controllers::t('menu', 'Time'),
                                    'contentOptions' => ['class' => 'center'],
                                    'attribute' => 'outbox.outbox_time',
                                    'value' => function ($model, $key, $index, $column) {
                                        return '' .
                                            TimeAgo::widget(['timestamp' => $model->outbox->outbox_time, 'language' => Yii::$app->language])
                                            . '';
                                    },
                                    'format' => 'raw',
                                ],
                                [
                                    'label' => controllers::t('menu', 'Status'),
                                    'contentOptions' => ['class' => 'center'],
                                    'attribute' => 'status',
                                    'value' => function ($model, $key, $index, $column) {
                                        if ($model['status'] == 0) {
                                            return "<a href='#ReceiverModal' data-toggle='modal' data-whatever='@mdo'
                                                    data='" . $model['cms_queue_id'] . "' class='ReceiverModal'>
                                                    <span class='label label-warning badge' style='font-size:14px'>"
                                                . controllers::t('menu', 'Email not sent to recipient') .
                                                "</span></a>";

                                        } else {
                                            return "<span class='label label-success badge' style='font-size:14px'>"
                                                . controllers::t('menu', 'Sent to the recipient')
                                                . "</span>";
                                        }
                                    },
                                    'format' => 'raw'
                                ],
                                [
                                    'label' => false,
                                    'contentOptions' => ['class' => 'mailbox-date', 'style' => 'color: black'],
                                    'attribute' => 'amount',
                                    'value' => function ($model, $key, $index, $column) {
                                        return "<a href='#ReceiverModal' data-toggle='modal' data-whatever='@mdo'
                                               data='" . $model['cms_queue_id'] . "'
                                               class='ReceiverModal btn btn-3d btn-reveal btn-teal'>
                                                <i class=\"fa fa-eye\"></i>
                                                <span>
                                                   " . controllers::t('menu', 'View all recipients of this book') . "
                                                </span>
                                            </a>";
                                    },
                                    'format' => 'raw',
                                ],
                            ],
                        ]);
                        ?>
                        <br>
                        <button class="btn btn-3d btn-green confirmSend">
                           <?=controllers::t('menu','Send email to unsubscribed email users')?>
                        </button>
                    </div>
                    <br>
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
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="close1">&times;</button>
                    <h4 class="modal-title"><?=controllers::t('menu','All recipients')?></h4>
                </div>
                <div class="modal-body">
                    <div>
                        <table class="table table-hover nomargin">
                            <tbody class="receiverTable">
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <button class="btn btn-3d btn-green confirmSend" style="display: none">
                        ส่งอีเมล
                    </button>

                </div>
            </div>
        </div>
    </div>
<?php
/** @var TYPE_NAME $docid */
$this->registerJs(<<<JS
    var roll;
    $('.pagination').addClass('pull-right');
    $('#example').DataTable( {
    "ordering": false
    });
    $('.group-checkable').click(function() {
      $("input[name='listQueue[]']").prop('checked', this.checked);
    });
    $(".ReceiverModal").click(function () {
      
        roll = $(this).attr("data");
        $.ajax({
            url: 'get-receiver',
            data: {
                'outbox': roll
            },
            type: "get",
            beforeSend: function () {
                $('.receiverTable').empty();
            },
            success: function (data) {
                $('.receiverTable').html(data);
                // $('.buttonSendMail').each(function () {
                //
                //     if ($(this).attr('data-id') == '1') {
                //         $('.confirmSend').show();
                //         console.log($(this).attr('data-id'));
                //     }
                // });
            }

        });
    });
       $(".confirmSend").click(function () {
            if($('.group-checkable').is(':checked') || $("input[name='listQueue[]']").is(':checked')){
            let iid = $("input[name='listQueue[]']:checked").map(function () {
                return $(this).attr("value");
            }).get();
            let q_id = JSON.stringify(iid);
            //console.log(" "+q_id);
            swal({
                title: "ท่านต้องการส่งเมลถึงผู้ใช้ทั้งหมดนี้ใช่หรือไม่?",
                text: "ท่านไม่สามารถกู้คืนได้หากยกเลิก",
                icon: "warning",
                buttons: ["ไม่ ฉันไม่ต้องการ", "ใช่ ฉันต้องการ"],
            })
                .then(willDelete => {
                        if (willDelete) {
                            return $.ajax({
                                url: 'broadcast-mail',
                                type: 'POST',
                                data: {
                                    'id': q_id
                                }, beforeSend: function () {
                                    $('#ReceiverModal').removeClass('in');
                                    NProgress.configure({showSpinner: false});
                                    NProgress.start();
                                    $('body').loading({
                                        stoppable: false,
                                        theme: 'light',
                                        message: 'กรุณารอสักครู่..'
                                    });
                                },
                                success: function () {
                                    NProgress.done();
                                  window.location.reload();
                                }
                            });
                        }
                    }
                );
        }
        });            
  

JS
);
?>