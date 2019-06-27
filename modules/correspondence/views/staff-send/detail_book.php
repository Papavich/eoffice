<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\correspondence\controllers;
use app\modules\correspondence\models\AuditTrail;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Html::encode($this->title) . 'รายละเอียดหนังสือ';
\Yii::setAlias('@webword', '@web/../modules/correspondence');
function MoneyDate($strDate)
{
    $mm = date("n", strtotime($strDate));  //เดือนปัจจุบัน
    $yearbudget = date("Y", strtotime($strDate)) + 543;  //ปีปัจจุบัน

    $m = $mm;
    $y = $yearbudget;

    //เริ่มตรวจสอบเงื่อนไข

    if ($m >= 10) {
        $show = $y + 1;
    } else {
        if ($m >= 1) {
            $show = $y;
        }

    }
    return $show;
}
$cancelTime = AuditTrail::find()->where(['model_id'=>$_GET['id']])
    ->andWhere('field = "check_id"')
    ->andWhere(['new_value'=> 2])
    ->andWhere('action = "UPDATE"')->one();
?>

    <section id="middle" style="color: black">
        <div class="wizard" style="padding: 20px">

            <!--<div align="center" id="detail-text">
                <? /*=controllers::t('menu', 'Book Details')*/ ?>
            </div>-->

            <div style="padding-left: 20px;">
                <h4 style="margin-bottom: 0">
                    <?= Html::a("ทะเบียนหนังสือส่ง", ['staff-send/send-roll']); ?> >
                    <?= Html::a($model_doc->address->address_name, ['staff-send/send-roll-in-folder?id=' . $model_doc->address->address_id]); ?>
                </h4><br><br>
            </div>

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
                    if ($model_doc->check->check_id == 2) {
                        echo "<span>
                                <h3 style='color: red;margin-bottom: 0px'>เอกสารฉบับนี้ถูกยกเลิกแล้ว
                                <span style='font-size: 12px;'>(".$cancelTime->created." )</span>
                                </h3>
                              </span>";
                    } elseif ($model_doc->check->check_id == 3) {
                        echo "<h3 style='color: red'>เอกสารฉบับนี้กำลังรอการอนุมัติ</h3>";
                    } elseif ($model_doc->check->check_id == 4) {
                        echo "<h3 style='color: red'>เอกสารฉบับนี้ผ่านการอนุมัติแล้ว</h3>";
                    } elseif ($model_doc->check->check_id == 5) {
                        echo "<h3 style='color: red'>เอกสารฉบับนี้ไม่อนุมัติ</h3>";
                    } else if ($model_doc->cmsDeleteRolls) {
                        foreach ($model_doc->cmsDeleteRolls as $item) {
                            if ($item['status'] == "ทำลายเสร็จสิ้น") {
                                echo "<h3 style='color: red'>เอกสารฉบับนี้ถูกทำลายแล้ว</h3>";
                            }
                        }
                    }
                    $roll_id = \app\modules\correspondence\models\CmsDocRollSend::find()
                        ->where('doc_id = "' . $model_doc->doc_id . '"')->one(); ?>
                    <p><b><?= controllers::t('menu', 'Speed') ?> :</b> <?= $model_doc->speed->speed_name; ?>
                        <span style="padding-right: 5%"></span>
                        <b><?= controllers::t('menu', 'Secret') ?> :</b> <?= $model_doc->secret->secret_name; ?>
                        <span style="padding-right: 5%"></span>
                        <b><?= controllers::t('menu', 'Document type') ?> :</b> <?= $model_doc->type->type_name; ?>
                        <span style="padding-right: 5%"></span>
                        <b><?= controllers::t('menu', 'Category') ?> :</b> <?= $model_doc->subType->sub_type_name; ?>
                    </p>

                    <p><b><?= controllers::t('menu', 'Doc Roll Send ID') ?>:</b> <?= substr($roll_id->doc_roll_send_id, -4); ?>
                        <span style="padding-right: 5%"></span>
                        <b><?= controllers::t('menu', 'Export date') ?>:</b> <?= controllers::DateThai($model_doc->sent_date); ?>
                        <span style="padding-right: 5%"></span>
                        <b><?= controllers::t('menu', 'To') ?> :</b> <?= $model_doc->docDept->doc_dept_name; ?>
                        <span style="padding-right: 5%"></span>
                    </p>

                     <p>
                        <b><?= controllers::t('menu', 'From') ?> :</b> <?= $model_doc->doc_from; ?>
                        <span style="padding-right: 5%"></span>
                        <b><?= controllers::t('menu', 'Doc Tel') ?>:</b> <?= $model_doc->doc_tel; ?>
                    </p>

                    <p><b><?= controllers::t('menu', 'Doc Id Regist') ?> :</b> <?= $model_doc->doc_id_regist; ?>
                        <span style="padding-right: 5%"></span>
                        <b><?= controllers::t('menu', 'Doc Date') ?>:</b> <?= controllers::DateThai($model_doc->doc_date); ?>
                    </p>

                    <p><b><?= controllers::t('menu', 'Doc Subject') ?>:</b> <?= $model_doc->doc_subject; ?></p>

                    <?php
                    if ($model_doc->subType->sub_type_name == "การเงิน" || $model_doc->subType->sub_type_name == "พัสดุ") {
                        echo "<p><b>" . controllers::t('menu', 'Money') . " :</b>  " . number_format($model_doc->money, 2) . " บาท 
                    <span style=\"padding-right: 5%\"></span>
                    <b>" . controllers::t('menu', 'Fiscal year') . " :</b>  " . MoneyDate($model_doc->doc_date) . "</p>";
                    }
                    ?>

                    <div style=" border: 2px solid #606060;"></div>

                    <p><b><?= controllers::t('menu', 'Address Book') ?> :</b> <?= $model_doc->address->address_name; ?>
                        <span style="padding-right: 2%"></span>
                        <span style="padding-right:2%"></span>
                        <b><?= controllers::t('menu', 'Recorder') ?> :</b>
                        <?= $saver->PREFIXNAME.$saver->person_name." ".$saver->person_surname; ?>
                        <span style="padding-right:2%"></span>
                        <b><?= controllers::t('menu', 'Doc Roll Receive Doing') ?>:</b> <?= $roll_id->doc_roll_send_doing; ?>
                    </p>

                    <?php
                    $docRef = \app\modules\correspondence\models\CmsDocRef::find()->where(['doc_id' => $model_doc->doc_id])->all();
                    if ($docRef) {
                        echo "<p><b>" . controllers::t('menu', 'Reference number') . " :</b>  ";
                        foreach ($docRef as $row) {
                            $doc = \app\modules\correspondence\models\CmsDocument::findOne($row['doc_ref']);
                            if ($doc->cmsDocRollReceives) {
                                echo Html::a("เลขที่ " . $doc->doc_id_regist . " เรื่อง "
                                    . $doc->doc_subject,
                                    \yii\helpers\Url::to('../staff-receive/detail_book?id=' . $doc->doc_id),
                                    ['target' => '_blank', 'style' => 'font-size: 16px']);

                            } elseif ($doc->cmsDocRollSends) {
                                echo Html::a("เลขที่ " . $doc->doc_id_regist . " เรื่อง "
                                    . $doc->doc_subject,
                                    \yii\helpers\Url::to('detail_book?id=' . $doc->doc_id),
                                    ['target' => '_blank', 'style' => 'font-size: 16px']);
                            }
                            echo "<br>";
                        }
                        echo "</p>";
                    }

                    ?>
                    <p><b><?= controllers::t('menu', 'File Book') ?> : </b><br>
                        <?php
                        foreach ($file as $items) {
                            echo Html::a($items->file_name, \yii\helpers\Url::to(Yii::getAlias('@web') . '/web_cms/uploads/' .
                                $items->file_path . '/' . $items->file_name), ['target' => '_blank', 'style' => 'font-size: 16px']);
                            echo "<br>";
                        }
                        ?>
                    </p>
                </div>
                <!-- /panel content -->
            </div>
            <!-- /PANEL -->
            <?= $this->render('preview-file',['doc_id'=>$_GET['id']])?>
        </div>
    </section>

<?php
/** @var TYPE_NAME $docid */
$this->registerJs(<<<JS

$('.inbox_status span').each(function(){
  if($(this).html() == 'unread'){
    $(this).css('color', 'red');
     //console.log(span);
  }else{
      $(this).css('color', 'green');
  }
});    
JS
);
?>