<?php

use yii\helpers\Html;
use app\modules\scholar_b\controllers;
use yii\widgets\LinkPager;
use app\modules\scholar_b\components\AuthHelper;



$this->registerJsFile('@web/web_scb/js/main.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/web_scb/js/sweetalert.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?= Html::csrfMetaTags() ?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Event') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Event') ?></li>
    </ol>
</header>
<!-- /page title -->

<div class="scb-calendar-index">
    <div class="panel-body">
        <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Staff) { ?>
        <!-- TYPE ADMIN-->
        <p>
            <?= Html::a(controllers::t('label', 'Create Calendar'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <!-- END ADMIN-->
        <?php } ?>


        <table class="table table-bordered nomargin">
            <thead>
            <tr class="active">
                <th style="width: 5%"><p align="center" style="margin: 0px"><?= controllers::t('label', 'No.') ?></th>
                <th style="width: 20%"><p align="center"
                                          style="margin: 0px"><?= controllers::t('label', 'Topic') ?></th>
                <th style="width: 35%"><p align="center"
                                          style="margin: 0px"><?= controllers::t('label', 'Activities') ?></th>
                <th width="20%"><p align="center" style="margin: 0px"><?= controllers::t('label', 'Date') ?></th>
                <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Staff) { ?>
                <th width="15%"><p align="center" style="margin: 0px">#</p></th>
                <?php } ?>

            </tr>
            </thead>

            <tbody>
            <?php foreach ($data as $i => $item) { ?>
            <tr>
                <td><p align="center" style="margin: 0px"><?= $i + 1 ?></td>
                <td><?= $item->calendar_topic ?></td>
                <td><?= $item->calendar_detail ?></td>
                <td><?= Yii::$app->formatter->asDate($item->calendar_date_start, 'medium') ?>
                    - <?= Yii::$app->formatter->asDate($item->calendar_date_end, 'medium') ?></td>

                <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Staff) { ?>
                <td align="center">

                    <a href="../calendar/update?id=<?= $item->calendar_id ?>" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i> <?= controllers::t('label', 'Edit') ?>
                    </a>

                    <button onclick="deletecalendar('<?php echo $item->calendar_id ?>','<?= $i ?>')"
                            class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i><?= controllers::t('label', 'Delete') ?>
                    </button>

                    <?= Html::a('<i class="fa fa-trash"></i> ', ['deletecalendar', 'id' => $item->calendar_id], [
                        'style' => 'display:none;', 'id' => 'deletecalendar' . $i,
                        'data' => [
                            'method' => 'post',
                        ],
                    ]) ?>

                </td>
                <!--END ADMIN -->
            </tr>
            <?php } ?>

            </tbody>
            <?php } ?>
        </table>

        <!-- pagination -->
        <div class="text-center">
            <?php
            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>
        </div>
        <!-- end pagination -->

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
  function deletecalendar (key, id) {
    swal({
      title: 'ยืนยันการลบ?',
      icon: 'warning',
      dangerMode: true,
      buttons: {
        okay: 'ตกลง',
        cancel: 'ยกเลิก'

      }
    }).then((value) => {
      switch (value) {
      case
        'okay'
      :
        $('#deletecalendar' + id).get(0).click()
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
