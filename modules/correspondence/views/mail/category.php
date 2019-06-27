<?php

use yii\helpers\Html;
use app\modules\correspondence\controllers;
use yii\grid\GridView;
use yii\widgets\Pjax;
$this->title = Html::encode($this->title) . 'หมวดหมู่ข้อความ';
?>

<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<section class="content">
    <div class="content-wrapper">
        <div class="row">
            <!-- Menu mail  -->
            <!-- /.col -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- Mail Header -->
                    <div class="box-header with-border">
                        <div class="col-xs-6">
                            <h3 style="color: black">
                                <?= Html::a( $this->title, ['mail/category']); ?>
                                <?php
                                if(Yii::$app->request->get('address_id')):
                                ?>
                                >
                                <?= Html::a(\app\modules\correspondence\models\CmsAddress::findOne($_GET['address_id'])->address_name, ['mail/category?address_id=' . $_GET['address_id']]); ?>
                                <?php endif; ?>
                            </h3>
                        </div>
                        <div class=" box-tools pull-right" id="new-search-area">
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <div class="mail-options">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                <b><?=controllers::t('menu','Change view')?></b>
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu scrollable-menu" role="menu">
                                <li><a href="category""><i class="fa fa-caret-right"></i><?=controllers::t('menu','show by document file and category')?></a></li>
                                <li><a href="inbox"><i class="fa fa-caret-right"></i> <?=controllers::t('menu','normal')?></a></li>
                            </ul>
                            <div style="float: left; margin-top: 5px">
                                <span id="filterMail" style="color: #000;"></span>
                            </div>
                        </div>
                        <div class="pull-right">
                            <?php echo \yii\widgets\LinkPager::widget([
                                'pagination' => $pages,
                                'firstPageLabel' => false,
                                'lastPageLabel' => false,
                                'prevPageLabel' => '<i class="glyphicon glyphicon-chevron-left" style="height: 5px"></i>',
                                'nextPageLabel' => '<i class="glyphicon glyphicon-chevron-right"></i>',
                                'maxButtonCount' => false,

                            ]);
                            ?>
                        </div>
                    </div>
                    <div style="border: 0.5px solid #F2F0F0; margin-top: 5px"></div>
                    <!-- /.Mail Header -->
                    <!-- Mail Body -->
                        <?php
                            echo GridView::widget([
                                'dataProvider' => $dataProvider,
                                'tableOptions' => [
                                    'class' => 'table table-hover',
                                    'style'=>'margin-top: 5px; margin-bottom: 5px;',
                                    'width'=>'100%',
                                    'cellspacing'=> '0'
                                ],
                                'rowOptions' => function ($model) {
                                    if ($model instanceof \app\modules\correspondence\models\CmsInbox) {
                                        // it's Inbox
                                        //echo $model->outbox->outbox_id.' '.$model->outbox->outbox_status."<br>";
                                        if($model->inbox_status == "unread"){
                                            return ['style' => 'background-color: #F2EDED'];
                                        }

                                    }
                                },
                                'columns' => $gridColumns,
                            ]);

                        ?>

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
                    <!-- /.Mail Body -->
                    <!-- /.mail-box-messages -->
                </div>

                <!-- /.box-body -->
                <div class="box-footer no-padding">
                </div>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<?= $this->render('label_form') ?>
<script>
    var pass_id;
    function redirectDeleteRoll(id) {
        pass_id = id;

    }
</script>

<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<!-- Page Script -->
<?php
//$this->registerJsFile("@web/assets/plugins/bootstrap/js/bootstrap.min.js", [
//]);
?>
<?php
/** @var TYPE_NAME $docid */
$this->registerJs(<<<JS
 $("#w0").children("ul").detach();
    $(".summary").detach().appendTo('#new-search-area');
    $('.pagination').css('margin','0px');
    var url = window.location.href;
    var curentUrl = url.split('/');
    if(curentUrl[7].substr(9) !== "")
    $('thead').detach();
JS
);
?>