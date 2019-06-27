<?php

/* @var $this yii\web\View */


use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\timeago\TimeAgo;
use yii\widgets\ActiveForm;


$this->title = controllers::t( 'menu', 'Requesting' );

//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- FORUM 1คำร้องที่ปรึกษา -->
<?php foreach ($modelAdviserRequest as $key => $item) { ?>
    <div class="panel panel-clean" id="panel-misc-portlet-l4">
        <div class="panel-heading">
									<span class="elipsis"><!-- panel title -->
										<strong style="font-size: large"><?= controllers::t( 'label', 'Request Adviser' ) ?></strong>
                                        (<?php echo TimeAgo::widget( ['timestamp' => $item->crtime . "GMT+7", 'language' => Yii::$app->language] ) ?>
                                        )
									</span>
            <!-- right options -->
            <ul class="options pull-right relative list-unstyled">
                <?php $form = ActiveForm::begin( ['options' => []] ) ?>
                <li class="hidden"><?= Html::submitButton( '', ['id' => 'RABtn' . $key, 'value' => $item->id, 'method' => 'post'] ) ?></li>
                <?= Html::input( 'hidden', 'comment', '', ['id' => 'commentRA' . $key] ) ?>
                <?php ActiveForm::end() ?>
                <li class="inline-block"><?= Html::button( '<i class="fa fa-check-square-o"></i>' . controllers::t( 'label', 'Accept' ) . '', ['class' => 'btn btn-success btn-xs white',
                        'id' => 'approveRABtn', 'onclick' => 'approveRABtn(' . $key . ')'] ) ?></li>
                <?php if ($item->status == \app\modules\eproject\models\RequestAdviser::STATUS_WAITING) { ?>
                    <li class="inline-block"><?= Html::button( '<i class="fa fa-hourglass-half"></i>' . controllers::t( 'label', 'Waiting' ) . '', ['class' => 'btn btn-warning btn-xs white', 'disabled' => 'disabled',] ) ?></li>
                <?php } else { ?>
                    <li class="inline-block"><?= Html::button( '<i class="fa fa-hourglass-1"></i>' . controllers::t( 'label', 'Waiting' ) . '', ['class' => 'btn btn-warning btn-xs white',
                            'id' => 'waitingRABtn', 'onclick' => 'waitingRABtn(' . $key . ')'] ) ?></li>
                <?php } ?>

                <li class="inline-block"><?= Html::button( '<i class="fa fa-remove"></i>' . controllers::t( 'label', 'Reject' ) . '', ['class' => 'btn btn-danger btn-xs white',
                        'id' => 'disapproveRABtn', 'onclick' => 'disapproveRABtn(' . $key . ')'] ) ?></li>
            </ul>
            <!-- /right options -->


        </div>

        <!-- panel content -->
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px"><b><?= controllers::t( 'label', 'Topic' ) ?> : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"><?= $item->topic ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px"><b><?= controllers::t( 'label', 'Owner' ) ?> : </b></p>
                </div>
                <div class="col-xs-8 col-md-9">
                    <p style="margin: 0px">
                        <?php foreach ($item->students as $std) {
                            echo $std->name . '<br>';
                        } ?></p>

                </div>
            </div>

            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px"><b><?= controllers::t( 'label', 'Student Information' ) ?>
                            : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"> <?= $item->detail ?></p>

                </div>
            </div>


            <!-- /panel content -->
        </div>
    </div>

<?php } ?>
<!-- /FORUM 1 -->
<?php foreach ($modelChangeMember as $key => $item) { ?>
    <div class="panel panel-clean" id="panel-misc-portlet-l4">

        <div class="panel-heading">

									<span class="elipsis"><!-- panel title -->
										<strong style="font-size: large"><?= controllers::t( 'label', 'Change Member Request' ) ?></strong>
                                        (<?php echo TimeAgo::widget( ['timestamp' => $item->crtime . "GMT+7", 'language' => Yii::$app->language] ) ?>
                                        )
                                    </span>

            <!-- right options -->
            <ul class="options pull-right relative list-unstyled">

                <?php $form = ActiveForm::begin( ['options' => []] ) ?>
                <li class="hidden"><?= Html::submitButton( '', ['id' => 'CMBtn' . $key, 'value' => $item->id, 'method' => 'post'] ) ?></li>
                <?= Html::input( 'hidden', 'comment', '', ['id' => 'commentCM' . $key] ) ?><?php ActiveForm::end() ?>
                <li class="inline-block"><?= Html::button( '<i class="fa fa-check-square-o"></i>' . controllers::t( 'label', 'Accept' ) . '', ['class' => 'btn btn-success btn-xs white',
                        'id' => 'approveCMBtn', 'onclick' => 'approveCMBtn(' . $key . ')'] ) ?></li>
                <?php if ($item->status == \app\modules\eproject\models\ChangeMemberRequest::STATUS_WAITING) { ?>
                    <li class="inline-block"><?= Html::button( '<i class="fa fa-hourglass-half"></i>' . controllers::t( 'label', 'Waiting' ) . '', ['class' => 'btn btn-warning btn-xs white', 'disabled' => 'disabled',] ) ?></li>
                <?php } else { ?>
                    <li class="inline-block"><?= Html::button( '<i class="fa fa-hourglass-1"></i>' . controllers::t( 'label', 'Waiting' ) . '', ['class' => 'btn btn-warning btn-xs white',
                            'id' => 'waitingCMBtn', 'onclick' => 'waitingCMBtn(' . $key . ')'] ) ?></li>
                <?php } ?>

                <li class="inline-block"><?= Html::button( '<i class="fa fa-remove"></i>' . controllers::t( 'label', 'Reject' ) . '', ['class' => 'btn btn-danger btn-xs white',
                        'id' => 'disapproveCMBtn', 'onclick' => 'disapproveCMBtn(' . $key . ')'] ) ?></li>
            </ul>
            <!-- /right options -->


        </div>

        <!-- panel content -->
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px">
                        <b><?= controllers::t( 'label', 'Project Name (Thai)' ) ?>
                            : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"> <?= $item->project->name_th ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px">
                        <b><?= controllers::t( 'label', 'Project Name (English)' ) ?> : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"> <?= $item->project->name_en ?></p>
                </div>

            </div>

            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px"><b><?= controllers::t( 'label', 'From' ) ?>
                            : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"><?= $item->from ?></p>
                </div>

            </div>

            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px">
                        <b> <?= controllers::t( 'label', 'To' ) ?>
                            : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"> <?= $item->to ?></p>
                </div>

            </div>

            <div class="row">

                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px"><b> <?= controllers::t( 'label', 'Reason' ) ?> : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"><?= $item->reason ?></p>
                </div>
            </div>


        </div>
        <!-- /panel content -->

    </div>
    <!-- /FORUM 2 ขอเปลี่ยนหัวข้อโครงงาน-->
<?php } ?>

<?php foreach ($modelChangeTopic as $key => $item) { ?>
    <div class="panel panel-clean" id="panel-misc-portlet-l4">

        <div class="panel-heading">
            <span class="elipsis">
                <strong style="font-size: large">
                    <?= controllers::t( 'label', 'Change Topic Request' ) ?>
                </strong>
                (<?php echo TimeAgo::widget( ['timestamp' => $item->crtime . "GMT+7", 'language' => Yii::$app->language] ) ?>
                )
            </span>

            <!-- right options -->
            <ul class="options pull-right relative list-unstyled">

                <?php $form = ActiveForm::begin( ['options' => []] ) ?>
                <li class="hidden"><?= Html::submitButton( '', ['id' => 'CTBtn' . $key, 'value' => $item->id, 'method' => 'post'] ) ?></li>
                <?= Html::input( 'hidden', 'comment', '', ['id' => 'commentCT' . $key] ) ?>
                <?php ActiveForm::end() ?>
                <li class="inline-block"><?= Html::button( '<i class="fa fa-check-square-o"></i>' . controllers::t( 'label', 'Accept' ) . '', ['class' => 'btn btn-success btn-xs white',
                        'id' => 'approveCTBtn', 'onclick' => 'approveCTBtn(' . $key . ')'] ) ?></li>

                <?php if ($item->status == \app\modules\eproject\models\ChangeTopicRequest::STATUS_WAITING) { ?>
                    <li class="inline-block"><?= Html::button( '<i class="fa fa-hourglass-half"></i>' . controllers::t( 'label', 'Waiting' ) . '', ['class' => 'btn btn-warning btn-xs white', 'disabled' => 'disabled',] ) ?></li>
                <?php } else { ?>
                    <li class="inline-block"><?= Html::button( '<i class="fa fa-hourglass-1"></i>' . controllers::t( 'label', 'Waiting' ) . '', ['class' => 'btn btn-warning btn-xs white',
                            'id' => 'waitingCTBtn', 'onclick' => 'waitingCTBtn(' . $key . ')'] ) ?></li>
                <?php } ?>

                <li class="inline-block"><?= Html::button( '<i class="fa fa-remove"></i>' . controllers::t( 'label', 'Reject' ) . '', ['class' => 'btn btn-danger btn-xs white',
                        'id' => 'disapproveCTBtn', 'onclick' => 'disapproveCTBtn(' . $key . ')'] ) ?></li>
            </ul>
            <!-- /right options -->
        </div>

        <!-- panel content -->
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px">
                        <b><?= controllers::t( 'label', 'Current Project Name (Thai)' ) ?>
                            : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"> <?= $item->project->name_th ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px">
                        <b><?= controllers::t( 'label', 'Current Project Name (English)' ) ?> : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"> <?= $item->project->name_en ?></p>
                </div>

            </div>
            <div class="row" align="center">
                <i class="fa fa-arrow-down" style="color:red"></i>
            </div>

            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px"><b><?= controllers::t( 'label', 'New Project Name (Thai)' ) ?>
                            : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"> <?= $item->pro_name_th ?></p>
                </div>

            </div>
            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px">
                        <b> <?= controllers::t( 'label', 'New Project Name (English)' ) ?>
                            : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"> <?= $item->pro_name_en ?></p>
                </div>

            </div>
            <hr>
            <div class="row">

                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px"><b> <?= controllers::t( 'label', 'Owner' ) ?> : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"> <?php foreach ($item->project->students as $std) {
                            echo $std->name . '<br>';
                        } ?></p>
                </div>
            </div>
            <div class="row">

                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px"><b> <?= controllers::t( 'label', 'Reason' ) ?> : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"><?= $item->reason ?></p>
                </div>
            </div>


        </div>
        <!-- /panel content -->

    </div>
    <!-- /FORUM 2 ขอเปลี่ยนหัวข้อโครงงาน-->
<?php } ?>
<!-- /FORUM 3 ขอเปลี่ยนอาจารย์ที่ปรึกษา-->
<?php foreach ($modelChangeAdviser
               as $key => $item) { ?>
    <div class="panel panel-clean" id="panel-misc-portlet-l4">

        <div class="panel-heading">

									<span class="elipsis"><!-- panel title -->
										<strong style="font-size: large"><?= controllers::t( 'label', 'Change Adviser Request' ) ?> </strong>
                                        (<?php echo TimeAgo::widget( ['timestamp' => $item->crtime . "GMT+7", 'language' => Yii::$app->language] ) ?>
                                        )
                                    </span>

            <!-- right options -->
            <ul class="options pull-right relative list-unstyled">
                <?php $form = ActiveForm::begin( ['options' => []] ) ?>
                <li class="hidden"><?= Html::submitButton( '', ['id' => 'CABtn' . $key, 'value' => $item->id, 'method' => 'post'] ) ?></li>
                <?= Html::input( 'hidden', 'comment', '', ['id' => 'commentCA' . $key] ) ?>

                <?php ActiveForm::end() ?>
                <li class="inline-block"><?= Html::button( '<i class="fa fa-check-square-o"></i>' . controllers::t( 'label', 'Accept' ) . '', ['class' => 'btn btn-success btn-xs white',
                        'id' => 'approveCABtn', 'onclick' => 'approveCABtn(' . $key . ')'] ) ?></li>

                <?php if ($item->status == \app\modules\eproject\models\ChangeAdviserRequest::STATUS_WAITING_SOURCE || $item->status == \app\modules\eproject\models\ChangeAdviserRequest::STATUS_WAITING_DESTINATION) { ?>
                    <li class="inline-block"><?= Html::button( '<i class="fa fa-hourglass-half"></i>' . controllers::t( 'label', 'Waiting' ) . '', ['class' => 'btn btn-warning btn-xs white', 'disabled' => 'disabled',] ) ?></li>
                <?php } else { ?>
                    <li class="inline-block"><?= Html::button( '<i class="fa fa-hourglass-1"></i>' . controllers::t( 'label', 'Waiting' ) . '', ['class' => 'btn btn-warning btn-xs white',
                            'id' => 'waitingCABtn', 'onclick' => 'waitingCABtn(' . $key . ')'] ) ?></li>
                <?php } ?>

                <li class="inline-block"><?= Html::button( '<i class="fa fa-remove"></i>' . controllers::t( 'label', 'Reject' ) . '', ['class' => 'btn btn-danger btn-xs white',
                        'id' => 'disapproveCABtn', 'onclick' => 'disapproveCABtn(' . $key . ')'] ) ?></li>

            </ul>
            <!-- /right options -->


        </div>

        <!-- panel content -->
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px"><b> <?= controllers::t( 'label', 'Project Name (Thai)' ) ?>
                            : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"> <?= $item->project->name_th ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px">
                        <b><?= controllers::t( 'label', 'Project Name (English)' ) ?> : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"> <?= $item->project->name_en ?></p>
                </div>
            </div>
            <div class="row">

                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px"><b> <?= controllers::t( 'label', 'Owner' ) ?> : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"> <?php foreach ($item->project->students as $std) {
                            echo $std->name . '<br>';
                        } ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px"><b><?= controllers::t( 'label', 'Adviser' ) ?>
                            : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"><?= $item->from0->name ?> <i class="fa fa-arrow-right"
                                                                        style="color:green"></i> <?= $item->to0->name ?>
                    </p>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-4 col-md-3" style="padding: 0px">
                    <p align="right" style="margin: 0px"><b> <?= controllers::t( 'label', 'Reason' ) ?> : </b></p>
                </div>
                <div class="col-xs-8 col-md-9 ">
                    <p style="margin: 0px"><?= $item->reason ?> </p>
                </div>


            </div>
            <!-- /panel content -->
        </div>
    </div>
<?php } ?>

<script>
  function approveCABtn (key) {
    swal({
      title: '<?= controllers::t( 'label', 'Do You Want To Approve Requesting?' ) ?>',
      text: '<?= controllers::t( 'label', 'This Action is not Undo' ) ?>',
      icon: 'warning',
      content: 'input',
      buttons: {
        confirm: '<?= controllers::t( 'label', 'Okay' ) ?>',
        cancel: '<?= controllers::t( 'label', 'Cancel' ) ?>',

      },
    })
      .then((value) => {
        if (value !== null) {
          $('#commentCA' + key).val(value)
          let btn = $('#CABtn' + key)
          btn.attr('name', 'approveCA')
          btn.click()

        }
      })
  }

  function disapproveCABtn (key) {
    swal({
      title: '<?= controllers::t( 'label', 'Do You Want To Disapprove Requesting?' ) ?>',
      text: '<?= controllers::t( 'label', 'This Action is not Undo' ) ?>',
      icon: 'warning',
      content: 'input',
      buttons: {
        confirm: '<?= controllers::t( 'label', 'Okay' ) ?>',
        cancel: '<?= controllers::t( 'label', 'Cancel' ) ?>',

      },
    })
      .then((value) => {
        if (value !== null) {
          $('#commentCA' + key).val(value)
          let btn = $('#CABtn' + key)
          btn.attr('name', 'disapproveCA')
          btn.click()

        }
      })
  }

  function waitingCABtn (key) {
    swal({
      title: '<?= controllers::t( 'label', 'Waiting For Consideration?' ) ?>',
      text: '<?= controllers::t( 'label', 'Message To Student:' ) ?>',
      icon: 'info',
      content: 'input',
      buttons: {
        confirm: '<?= controllers::t( 'label', 'Okay' ) ?>',
        cancel: '<?= controllers::t( 'label', 'Cancel' ) ?>',

      },
    })
      .then((value) => {
        if (value !== null) {

          $('#commentCA' + key).val(value)
          let btn = $('#CABtn' + key)
          btn.attr('name', 'waitingCA')
          btn.click()

        }
      })
  }

  function approveRABtn (key) {
    swal({
      title: '<?= controllers::t( 'label', 'Confirm Approving?' ) ?>',
      text: '<?= controllers::t( 'label', 'Message To Student:' ) ?>',
      icon: 'warning',
      content: 'input',
      buttons: {
        confirm: '<?= controllers::t( 'label', 'Okay' ) ?>',
        cancel: '<?= controllers::t( 'label', 'Cancel' ) ?>',

      },
    })
      .then((value) => {
        if (value !== null) {
          $('#commentRA' + key).val(value)
          let btn = $('#RABtn' + key)
          btn.attr('name', 'approveRA')
          btn.click()

        }
      })
  }

  function waitingRABtn (key) {
    swal({
      title: '<?= controllers::t( 'label', 'Waiting For Consideration?' ) ?>',
      text: '<?= controllers::t( 'label', 'Message To Student:' ) ?>',
      icon: 'info',
      content: 'input',
      buttons: {
        confirm: '<?= controllers::t( 'label', 'Okay' ) ?>',
        cancel: '<?= controllers::t( 'label', 'Cancel' ) ?>',

      },
    })
      .then((value) => {
        if (value !== null) {

          $('#commentRA' + key).val(value)
          let btn = $('#RABtn' + key)
          btn.attr('name', 'waitingRA')
          btn.click()

        }
      })
  }

  function disapproveRABtn (key) {
    swal({
      title: '<?= controllers::t( 'label', 'Confirm Approving?' ) ?>',
      text: '<?= controllers::t( 'label', 'Message To Student:' ) ?>',
      icon: 'warning',
      content: 'input',
      buttons: {
        confirm: '<?= controllers::t( 'label', 'Okay' ) ?>',
        cancel: '<?= controllers::t( 'label', 'Cancel' ) ?>',

      },
    })
      .then((value) => {
        if (value !== null) {

          $('#commentRA' + key).val(value)
          let btn = $('#RABtn' + key)
          btn.attr('name', 'disapproveRA')
          btn.click()

        }
      })
  }

  function approveCTBtn (key) {
    swal({
      title: '<?= controllers::t( 'label', 'Do You Want To Approve Requesting?' ) ?>',
      text: '<?= controllers::t( 'label', 'This Action is not Undo' ) ?>',
      icon: 'warning',
      content: 'input',
      buttons: {
        confirm: '<?= controllers::t( 'label', 'Okay' ) ?>',
        cancel: '<?= controllers::t( 'label', 'Cancel' ) ?>',

      },
    })
      .then((value) => {
        if (value !== null) {
          $('#commentCT' + key).val(value)
          let btn = $('#CTBtn' + key)
          btn.attr('name', 'approveCT')
          btn.click()

        }
      })
  }

  function waitingCTBtn (key) {
    swal({
      title: '<?= controllers::t( 'label', 'Waiting For Consideration?' ) ?>',
      text: '<?= controllers::t( 'label', 'Message To Student:' ) ?>',
      icon: 'info',
      content: 'input',
      buttons: {
        confirm: '<?= controllers::t( 'label', 'Okay' ) ?>',
        cancel: '<?= controllers::t( 'label', 'Cancel' ) ?>',

      },
    })
      .then((value) => {
        if (value !== null) {

          $('#commentCT' + key).val(value)
          let btn = $('#CTBtn' + key)
          btn.attr('name', 'waitingCT')
          btn.click()

        }
      })
  }

  function disapproveCTBtn (key) {
    swal({
      title: '<?= controllers::t( 'label', 'Do You Want To Disapprove Requesting?' ) ?>',
      text: '<?= controllers::t( 'label', 'This Action is not Undo' ) ?>',
      icon: 'warning',
      content: 'input',
      buttons: {
        confirm: '<?= controllers::t( 'label', 'Okay' ) ?>',
        cancel: '<?= controllers::t( 'label', 'Cancel' ) ?>',

      },
    })
      .then((value) => {
        if (value !== null) {
          $('#commentCT' + key).val(value)
          let btn = $('#CTBtn' + key)
          btn.attr('name', 'disapproveCT')
          btn.click()

        }
      })
  }

  function approveCMBtn (key) {
    swal({
      title: '<?= controllers::t( 'label', 'Do You Want To Approve Requesting?' ) ?>',
      text: '<?= controllers::t( 'label', 'This Action is not Undo' ) ?>',
      icon: 'warning',
      content: 'input',
      buttons: {
        confirm: '<?= controllers::t( 'label', 'Okay' ) ?>',
        cancel: '<?= controllers::t( 'label', 'Cancel' ) ?>',

      },
    })
      .then((value) => {
        if (value !== null) {
          $('#commentCM' + key).val(value)
          let btn = $('#CMBtn' + key)
          btn.attr('name', 'approveCM')
          btn.click()

        }
      })
  }

  function waitingCMBtn (key) {
    swal({
      title: '<?= controllers::t( 'label', 'Waiting For Consideration?' ) ?>',
      text: '<?= controllers::t( 'label', 'Message To Student:' ) ?>',
      icon: 'info',
      content: 'input',
      buttons: {
        confirm: '<?= controllers::t( 'label', 'Okay' ) ?>',
        cancel: '<?= controllers::t( 'label', 'Cancel' ) ?>',

      },
    })
      .then((value) => {
        if (value !== null) {

          $('#commentCM' + key).val(value)
          let btn = $('#CMBtn' + key)
          btn.attr('name', 'waitingCM')
          btn.click()

        }
      })
  }

  function disapproveCMBtn (key) {
    swal({
      title: '<?= controllers::t( 'label', 'Do You Want To Disapprove Requesting?' ) ?>',
      text: '<?= controllers::t( 'label', 'This Action is not Undo' ) ?>',
      icon: 'warning',
      content: 'input',
      buttons: {
        confirm: '<?= controllers::t( 'label', 'Okay' ) ?>',
        cancel: '<?= controllers::t( 'label', 'Cancel' ) ?>',

      },
    })
      .then((value) => {
        if (value !== null) {
          $('#commentCM' + key).val(value)
          let btn = $('#CMBtn' + key)
          btn.attr('name', 'disapproveCM')
          btn.click()
        }
      })
  }
</script>