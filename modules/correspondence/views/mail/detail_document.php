<?php
use app\modules\correspondence\controllers;
?>
<div id="panel-1" class="panel panel-default" style="border: 2px solid grey;">
    <div class="panel-heading">
							<span class="title elipsis">
								<strong style="font-size: 22px;color: black"> <?= controllers::t('menu', 'Book Details') ?></strong>
                                <!-- panel title -->
							</span>

        <!-- right options -->
        <ul class="options pull-right list-inline">
            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                   data-placement="bottom"></a></li>
            <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen"
                   data-placement="bottom"><i class="fa fa-expand"></i></a></li>
        </ul>
        <!-- /right options -->

    </div>

    <!-- panel content -->
    <div class="panel-body">
        <?php
        if ($model_document->doc->check->check_id == 2) {
            echo "<h2 style='color: red'>เอกสารฉบับนี้ถูกยกเลิกแล้ว</h2>";
        } elseif ($model_document->doc->check->check_id == 3) {
            echo "<h2 style='color: red'>เอกสารฉบับนี้กำลังรอการอนุมัติ</h2>";
        } elseif ($model_document->doc->check->check_id == 4) {
            echo "<h2 style='color: red'>เอกสารฉบับนี้ผ่านการอนุมัติแล้ว</h2>";
        } elseif ($model_document->doc->check->check_id == 5) {
            echo "<h2 style='color: red'>เอกสารฉบับนี้ไม่อนุมัติ</h2>";
        } elseif ($model_document->doc->cmsDeleteRolls) {
            foreach ($model_document->doc->cmsDeleteRolls as $item) {
                if ($item['status'] == "ทำลายเสร็จสิ้น") {
                    echo "<h2 style='color: red'>เอกสารฉบับนี้ถูกทำลายแล้ว</h2>";
                }else{
                    echo "<h3 style='color: red'>เอกสารฉบับนี้อยู่ระหว่างการทำลาย</h3>";
                }
            }
        }
        ?>
        <p><b><?=controllers::t('menu', 'Speed')?> :</b> <?= $model_document->doc->speed->speed_name; ?>
            <span style="padding-right: 5%"></span>
            <b><?=controllers::t('menu', 'Secret')?> :</b> <?= $model_document->doc->secret->secret_name; ?>
            <span style="padding-right: 5%"></span>
            <b><?=controllers::t('menu', 'Document type')?> :</b> <?= $model_document->doc->type->type_name; ?>
            <span style="padding-right: 5%"></span>
            <b><?=controllers::t('menu', 'Category')?> :</b> <?= $model_document->doc->subType->sub_type_name; ?></p>
        <p>
            <?php

            foreach ($model_document->doc->cmsDocRollReceives as $i) {
                $roll_id = $i->doc_roll_receive_doing;
                echo "<b>".controllers::t('menu', 'Doc Roll Receive ID')." :</b> " . substr($i['doc_roll_receive_id'], -4);
            }
            ?>
            <span style="padding-right: 5%"></span>
            <b><?=controllers::t('menu', 'Receive Date')?> :</b> <?= controllers::DateThai($model_document->doc->receive_date); ?>
            <span style="padding-right: 5%"></span>
        </p>
        <p>
            <b><?=controllers::t('menu', 'Doc From')?>:</b> <?= $model_document->doc->docDept->doc_dept_name; ?>
            <span style="padding-right: 5%"></span>
            <b><?=controllers::t('menu', 'Doc Tel')?>:</b> <?= $model_document->doc->doc_tel; ?>
        </p>
        <p><b><?=controllers::t('menu', 'Doc Id Regist')?>:</b> <?= $model_document->doc->doc_id_regist; ?>
            <span style="padding-right: 5%"></span>
            <b><?=controllers::t('menu', 'Doc Date')?> :</b> <?= controllers::DateThai($model_document->doc->doc_date); ?></p>

        <p><b><?=controllers::t('menu', 'Doc Subject')?>:</b> <?= $model_document->doc->doc_subject; ?></p>

        <div style=" border: 2px solid #606060;"></div>

        <p><b><?=controllers::t('menu', 'Address Book')?> :</b> <?= $model_document->doc->address->address_name; ?> </p>
        <p><b><?=controllers::t('menu', 'Doing')?> :</b> <?= $roll_id; ?> </p>
        <p><b><?=controllers::t('menu', 'File Book')?> : </b><br>
            <?php foreach ($model_document->doc->files as $items) {
                echo \yii\helpers\Html::a($items->file_name, \yii\helpers\Url::to(Yii::getAlias('@web') . '/web_cms/uploads/' .
                    $items->file_path . '/' . $items->file_name),['target' => '_blank','style' => 'font-size: 16px','class' => 'linksWithTarget']);
                echo "<br>";
            }
            ?>
        </p>

        <?php
        if (\Yii::$app->authManager->isAdmin() || \Yii::$app->authManager->isStaffGeneral()) { ?>
            <p class='inbox_status'><b><?=controllers::t('menu','Send to')?> : </b> <br>
                <?php
                $count = 0;
                foreach ($receiver as $rows) {
                    if (count($receiver) >= 2 && $count <= 1) {
                        echo "<a href='#ReceiverModal' data-toggle='modal' data-whatever='@mdo'>";
//                        echo (Yii::$app->controller->action->id == "read-reply-mail" ?
//                                $rows->outbox->user->prefix_th . $rows->outbox->user->fname . " " . $rows->outbox->user->lname
//                                :
//                                $rows->user->prefix_th . $rows->user->fname . " " . $rows->user->lname)." ";
                        echo
                                $rows->user->prefix_th . $rows->user->fname . " " . $rows->user->lname." ";
                        //break;
                    } else if ($count > 2) {
                        echo " ".controllers::t('menu','and others');
                        break;
                    } else if (count($receiver) == 1) {
                        /*echo (Yii::$app->controller->action->id == "read-reply-mail" ?
                                $rows->outbox->user->prefix_th . $rows->outbox->user->fname . " " . $rows->outbox->user->lname
                                :
                                $rows->user->prefix_th . $rows->user->fname . " " . $rows->user->lname) . " &nbsp สถานะ : 
                        <span >" .
                            $rows['inbox_status']." ".$rows->inbox_id
                            ."<span style='font-size: 14px;'>
                                (".controllers::DateThaiForMail($rows['message_reply_time']).")
                              </span> "
                        ."</span><br>";*/
                        echo
                                $rows->user->prefix_th . $rows->user->fname . " " . $rows->user->lname. " &nbsp สถานะ : 
                        <span >" .
                            $rows['inbox_status']
                            ."<span style='font-size: 14px;'>
                                (".controllers::DateThaiForMail($rows['message_reply_time']).")
                              </span> "
                        ."</span><br>";
                    }
                    $count++;
                }
                echo "</a>";

                ?>
            </p>
        <?php } ?>
    </div>
    <!-- /panel content -->
</div>
<!-- /PANEL -->


<?= $this->render('../staff-send/preview-file',['doc_id'=>$model_document->doc->doc_id])?>
<div>
