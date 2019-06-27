<?php

use yii\helpers\Html;
use app\modules\correspondence\controllers;
use yii\grid\GridView;

$this->title = Html::encode($this->title) . 'กล่องจดหมาย';
?>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <div class="table-responsive mailbox-messages">
        <?php
        if ((!\Yii::$app->authManager->isAdmin() && !\Yii::$app->authManager->isStaffGeneral())) {
            ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'rowOptions' => function ($model) {
                    if ($model instanceof \app\modules\correspondence\models\CmsInbox) {
                        // it's Inbox
                        if($model->inbox_status == "unread")
                        return ['style' => 'background-color: #F2EDED'];
                    } else if ($model instanceof \app\modules\correspondence\models\CmsOutbox
                       )  {
                        // it's Outbox
                        if($model->outbox_status == "sent" || !is_null($model->outbox_status))
                            return ['style' => (Yii::$app->controller->action->id == "sent-mail" ?
                                'background-color: #FFF':'background-color: #F2EDED')];
                    }else{
                        echo "it's Outbox";
                    }
                },
                'tableOptions' => [
                    'class' => 'table table-hover',
                    'style' => 'margin-top: 5px; margin-bottom: 5px;',
                    'width' => '100%',
                    'cellspacing' => '0'
                ],
                'columns' => $gridColumns,
            ]); ?>
            <?php
        } else {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'rowOptions' => function ($model) {
                    if ($model instanceof \app\modules\correspondence\models\CmsInbox) {
                        // it's Inbox
                        //echo $model->outbox->outbox_id.' '.$model->outbox->outbox_status."<br>";
                        if(!$model->outbox->outbox_status){
                            return ['style' => 'background-color: #F2EDED'];
                        }

                    } else if ($model instanceof \app\modules\correspondence\models\CmsOutbox)  {
                        // it's Outbox
                        if($model->outbox_status == "sent" || !is_null($model->outbox_status))
                        return ['style' => (Yii::$app->controller->action->id == "sent-mail" ?
                            'background-color: #FFF':'background-color: #F2EDED')];
                    }
                },
                'tableOptions' => [
                    'class' => 'table table-hover',
                    'style' => 'margin-top: 5px; margin-bottom: 5px;',
                    'width' => '100%',
                    'cellspacing' => '0'
                ],
                'columns' => $gridColumns,
            ]);
        }
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

    </div>
    <!-- /.content -->
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
   $("#w1").children("ul").detach();
   $(".summary").detach().appendTo('#new-search-area');
   $('thead .grid-view').detach();
   $('.grid-view thead').detach();
JS
);
?>