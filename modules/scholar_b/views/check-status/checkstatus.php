<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 30/4/2561
 * Time: 23:18
 */

use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use app\modules\scholar_b\controllers;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->registerJsFile('@web/ckeditor/ckeditor.js');
$this->registerJsFile('@web/web_scb/js/tabmenu.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?= Html::csrfMetaTags() ?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'List Approve') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class="active"><?= controllers::t('label', 'List Approve') ?></a></li>
    </ol>
</header>
<!-- /page title -->
<div id="content" class="padding-20">
    <div class="panel-body">
        <div class="tabs nomargin">
            <!-- tabs -->
            <ul class="nav nav-tabs nav-justified tabmenu">
                <li class="active">
                    <a href="#jtab1_nobg" data-toggle="tab" aria-expanded="false">
                        <i class="fa fa-check"></i> อนุมัติโปรเจค
                    </a>
                </li>
                <li class="">
                    <a href="#jtab2_nobg" data-toggle="tab" aria-expanded="false">
                        <i class="fa fa-check"></i> อนุมัติผลงาน
                    </a>
                </li>
            </ul>

            <!-- tabs content -->
            <div class="tab-content transparent">
                <div id="jtab1_nobg" class="tab-pane active">
                    <table class="table table-striped table-responsive">
                        <thead>
                        <tr>
                            <th width="20%">
                                <p align="center" style="margin: 0px">ชื่อโปรเจค</p>
                            </th>
                            <th width="15%">ดาวน์โหลดโปรเจค</th>
                            <th width="10%">
                                <p align="center" style="margin: 0px"></p>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($project as $key => $item) { ?>
                        <tr>
                            <?php if ($item->pro_status == 0) { ?>
                            <td>
                                <a href="<?php echo Url::toRoute(['project/view', 'project_code' => $item->project_code]); ?>">
                                    <?= $item->project_name ?>
                                </a>
                            </td>
                            <td>
                                <?php echo Html::a(' ' . controllers::t('label', 'Click for Download', ['class' => 'btn btn-primary']), '@web/web_scb/uploads/project/' . $item->project_file, ['class' => 'glyphicon glyphicon-download-alt btn btn-default btn-sm']) ?>
                            </td>
                            <td>
                                <?= Html::a('<i class="fa fa-check-square-o"></i>' . controllers::t('label', ' Approve'), [
                                    'checkproject', 'project_code' => $item->project_code],
                                    ['style' => 'color:green;']) ?>

                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                        <?php } ?>
                    </table>

                </div>


                <!-- Start TAB2 -->
                <div id="jtab2_nobg" class="tab-pane">
                    <table class="table table-striped table-responsive">
                        <thead>
                        <tr>
                            <th width="20%">
                                <p align="center" style="margin: 0px">ชื่อผลงาน</p>
                            </th>
                            <th width="15%">ดาวน์โหลดโปรเจค</th>
                            <th width="10%">
                                <p align="center" style="margin: 0px"></p>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $count = 1;
                        foreach ($portfolio as $key => $item) { ?>
                        <tr>
                            <?php if ($item->port_status == 0) { ?>
                            <td>
                                <a href="<?php echo Url::toRoute(['portfolio/view', 'id_portfolio' => $item->id_portfolio]); ?>">
                                    <?= $item->port_name ?>
                                </a>
                            </td>
                            <td>
                                <?php echo Html::a(' ' . controllers::t('label', 'Click for Download', ['class' => 'btn btn-primary']), '@web/web_scb/uploads/project/' . $item->port_file, ['class' => 'glyphicon glyphicon-download-alt btn btn-default btn-sm']) ?>
                            </td>
                            <td>
                                <?= Html::a('<i class="fa fa-check-square-o"></i>' . controllers::t('label', ' Approve'), [
                                    'checkport', 'id_portfolio' => $item->id_portfolio],
                                    ['style' => 'color:green;']) ?>

                            </td>
                            <?php } ?>
                        </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Get all flash messages and loop through them -->
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>

<script>

  function approveProject (key, id) {
    swal({
      title: 'ยืนยันการอนุมัติคำร้อง?',
      icon: 'warning',
      buttons: {
        okay: 'ตกลง',
        cancel: 'ยกเลิก'

      }
    })
      .then((value) = > {
      switch (value) {
      case
        'okay'
      :
        $('#0' + id).get(0).click()
        break

      case
        'cancel'
      :
        break
      }
    }
  )
  }

  function approvePort (key, id) {
    swal({
      title: 'ยืนยันการอนุมัติคำร้อง?',
      icon: 'warning',
      buttons: {
        okay: 'ตกลง',
        cancel: 'ยกเลิก'

      }
    })
      .then((value) = > {
      switch (value) {
      case
        'okay'
      :
        $('#1' + id).get(0).click()
        break

      case
        'cancel'
      :
        break
      }
    }
  )
  }

</script>